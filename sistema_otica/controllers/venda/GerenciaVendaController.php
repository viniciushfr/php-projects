<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Venda.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Produto.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/ProdutoDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/ItemVendaDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Venda.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/VendaDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/FornecedorDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Fornecedor.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Caixa.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/CaixaDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/ItemVenda.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Cliente.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/ClienteDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/OrdenServicoDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/OrdenServico.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/controllers/orden_servico/GerenciaOrdenServicoController.php";




if($_POST["addItemVenda"]){
    //echo "entrou";
    $produtoId = $_POST["produtoId"];
    $quantidade = $_POST["quantidade"];
    GerenciaVendaController::addItemVenda($produtoId,$quantidade);
    
}
if($_POST["attListaVenda"]){
   // echo "attListaCompra";
    //unset($_SESSION["itensCompra"]);
    GerenciaVendaController::attItensVenda();
}
if($_POST["rvmItemVenda"]){
    //echo"rvmItem";
    GerenciaVendaController::rmvItemVenda($_POST["p_id"]);
}
if($_POST["getValorTotal"]){
    session_start();
    
    $_SESSION["valorT"]["venda"] ;
    $retorno["valorT"]["venda"] = money_format("%.2n",$_SESSION["valorT"]["venda"] );
    echo json_encode($retorno["valorT"]);

}
if(isset($_POST['btn-salvar-venda'])){
    session_start();
    
    GerenciaVendaController::salvarVenda($_POST['select-cliente'],
                                         $_POST['data'],
                                         $_SESSION["valorT"]["venda"], 
                                         $_SESSION["caixa"],
                                         $_POST['a-vista']);
}
if(isset($_POST["carregar-venda"])){
    GerenciaVendaController::carregarVenda($_POST["carregar-venda"]);
}

class GerenciaVendaController{

    public function addItemVenda($produtoId,$quantidade){
        //echo "implementar adicionar item";
         session_start();
        $produtoDAO = new ProdutoDao();
        $p = $produtoDAO->load("*","WHERE id = '$produtoId'")[0];
        
        if($_SESSION["itensVenda"][$produtoId]==null){
            if($p->getQuantidade()>=$quantidade){
                $_SESSION["itensVenda"][$produtoId]=$quantidade;
                
                $_SESSION["valorT"]["venda"]+=$p->getValorVenda()*$quantidade;
                    echo "<div class='alert  alert-dismissable'>";
                    echo    "<span class = 'badge'>$quantidade</span>  ";
                    echo        $p->getMarca()." - ".$p->getModelo()." - ".$p->getCodigoBarra()." - R$: ".money_format("%.2n",$p->getValorVenda());
                    echo    "<button value='".$p->getId()."' onclick='rmvItemVenda(this.value)' type = 'button' class = 'close' aria-hidden = 'true' data-dismiss = 'alert' aria-hidden = 'true'>";
                    echo    "&times;";
                    echo    "</button>";
                    echo    "</div>";
            }else{
                exit ("erro: produto não possui essa quantidade em estoque.");
            }
        }else{
            $ItensQtd = $_SESSION["itensVenda"][$produtoId];
            $qtdAtualizada = $ItensQtd + $quantidade;
            if($p->getQuantidade()>=$qtdAtualizada){
                $_SESSION["valorT"]["venda"]+=$p->getValorVenda()*$quantidade;
                $_SESSION["itensVenda"][$produtoId]=$qtdAtualizada;
                //se o item ja esta na lista atualiza a quantidade e o preco e recarrega a pagina
                echo true;
            }else{
                exit ("erro: a quantidade desejada ultrapassou a em estoque.");
            }
        }
    }
    public function rmvItemVenda($id){
        session_start();
        $produtoDAO = new ProdutoDao();
        $p = $produtoDAO->load("*","WHERE id = '$id'")[0];
        $_SESSION["valorT"]["venda"]-=$p->getValorVenda()*$_SESSION["itensVenda"][$id];
        //echo "remover";
        unset($_SESSION["itensVenda"][$id]);
    }
    public function salvarVenda($clienteId,$data,$valorTotal,$caixaId,$aVista){
        //echo "erro: implementar metodo salvar";
        $vendaDAO = new VendaDAO();
        $erro = "";
        if($valorTotal==0){
            $erro = ("erro: nenhum item na venda!");
        }else if(empty($data)){
            $erro = ("erro: campo 'data' não pode ser nulo!");
        }else if($caixaId == null){
            $erro = "erro: caixa fechado.";
        }else if($aVista){
            $status = 1;
        }else{
            $status = 0;
        }
        $numParcelas = $_POST["numParcelas"];
        $vencimentoInicial = $_POST["dataVencimento"];
        if($numParcelas==null and !$aVista){
            $erro = "erro: preencha o numero de parcelas.";
        }else if($vencimentoInicial == null and !$aVista){
            $erro = "erro: selecione a data do vencimento.";
        }
        if($erro==""){
            //$erro = "erro: pronto pra comecar a implementar";
            $fields = "";
            $parans = array(null,$data,$valorTotal,$status,$caixaId,$clienteId);
            $idVendaInserida = $vendaDAO->insert($fields,$parans);
            if(empty($idVendaInserida)){
                $erro = "erro: não foi possivel cadastrar!";
            }else{
                //gerar pagamento
                if($aVista){
                    PagamentoController::gerarPagamentoVendaAvista($idVendaInserida,$valorTotal,$data,$caixaId);
                }else{
                    PagamentoController::gerarPagamentoVendaParcelado($idVendaInserida,$numParcelas,$valorTotal,$vencimentoInicial,$caixaId);
                }
                $itemVendaDAO = new ItemVendaDAO();
                $produtoDAO = new ProdutoDao();
                //para cada item
                foreach($_SESSION["itensVenda"] as $p_id => $qtd){
                    $p = $produtoDAO->load("*","WHERE id = '$p_id'")[0];
                    //atualiza quantidade em estoque
                    $pfields =array("quantidade");
                    $pparans = array($p->getQuantidade()-$qtd);
                    $produtoAtualizado = $produtoDAO->update($pfields,$pparans,"id = ".$p->getId()."");
                    if(empty($produtoAtualizado))$erro = "erro: estoque não foi atualizado";
                    //insere o item
                    $parans = array(null,$p->getValorVenda(),$p->getValorVenda()*$qtd,$qtd,$p->getId(),$idVendaInserida);
                    $item = $itemVendaDAO->insert("",$parans);
                    if(empty($item))$erro = ("erro: não foi possivel inserir o item");
                }
                //apaga os dados temporarios em sessao
                session_start();
                unset($_SESSION["valorT"]["venda"]);
                $_SESSION["valorT"]["venda"]=0.0;
                unset($_SESSION["itensVenda"]);
                $erro = "success".$idVendaInserida;
            }
        }
        echo $erro;
        return $erro;
    }
    public function attItensVenda(){
        //echo "implementar metodo atualizar lista";
        session_start();
        $produtoDAO = new ProdutoDao();
        //var_dump($_SESSION["itensCompra"]);
        if(!count($_SESSION["itensVenda"])==null){
          //  var_dump($_SESSION["itensCompra"]);
         foreach($_SESSION["itensVenda"] as $p_id => $qtd){
             
            $p = $produtoDAO->load("*","WHERE id = '$p_id'")[0];
            echo "<div class='alert  alert-dismissable'>".
                    "<span class = 'badge'>$qtd</span>  "
                     .$p->getMarca()." - ".$p->getModelo()." - ".$p->getCodigoBarra()."  - R$: ".money_format("%.2n",$p->getValorVenda()).
                    "<button value='".$p->getId()."' onclick='rmvItemVenda(this.value)' type = 'button' class = 'close' aria-hidden = 'true' data-dismiss = 'alert' aria-hidden = 'true'>
                     &times;
                     </button>".
                    "</div>";
        }
        }
    }
    public function carregarVenda($id){
        $informacoesVenda =array();
        //carrega venda
        $vendaDAO = new VendaDAO();
        $venda = $vendaDAO->load("*","WHERE id = $id")[0];
        $informacoesVenda["venda"]=$venda;
        //carrega cliente
        $clienteDAO = new ClienteDAO();
        $clienteId = $venda->getClienteId();
        $cliente = $clienteDAO->load("*","WHERE id =$clienteId ")[0];
        $informacoesVenda["cliente"] =$cliente;
        //carrega caixa
        $caixaDAO = new CaixaDAO();
        $caixaId = $venda->getCaixaId();
        $caixa = $caixaDAO->load("*","WHERE id = $caixaId")[0];
        $informacoesVenda['caixa']=$caixa;
        //carrega itens da venda
        $itemVendaDAO = new ItemVendaDAO();
        $vendaId = $venda->getId();
        $itensVenda = $itemVendaDAO->load("*","WHERE vendaId = $vendaId");
        $informacoesVenda["itensVenda"] = $itensVenda;
        //carregar pagamento
        $informacoesVenda['pagamentos'] = PagamentoController::carregarPagamentosVenda($id);
        //carrega produtos da venda
        $produtoDAO = new ProdutoDAO();
        foreach($itensVenda as $key =>$itemVenda){
            $produtoId = $itemVenda->getProdutoId();
            $produto = $produtoDAO->load("*","WHERE id = $produtoId")[0];
            $informacoesVenda["produto"][$key] = $produto;
        }
        return $informacoesVenda;
    }
    public static function carregarVendasRecebimentoPendente($data){
        $vendaDAO = new VendaDAO();
        if($data == null){
            $venda = $vendaDAO->load("*","WHERE status = 0 ORDER BY data");
        }else{
            $venda = $vendaDAO->load("*","WHERE status = 0 && data = $data");
        }
        return $venda;
    }
}
?>