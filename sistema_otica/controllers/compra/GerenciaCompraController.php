<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Produto.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/ProdutoDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/ItemCompra.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/ItemCompraDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Compra.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/CompraDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/FornecedorDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Fornecedor.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Caixa.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/CaixaDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/controllers/PagamentoController.php";

if($_POST["addItemCompra"]){
    //echo "entrou";
    $produtoId = $_POST["produtoId"];
    $quantidade = $_POST["quantidade"];
    GerenciaCompraController::addItemCompra($produtoId,$quantidade);
    
}
if($_POST["attListaCompra"]){
   // echo "attListaCompra";
    //unset($_SESSION["itensCompra"]);
    GerenciaCompraController::attItensCompra();
}
if($_POST["rvmItemCompra"]){
    //echo"rvmItem";
    GerenciaCompraController::rmvItemCompra($_POST["p_id"]);
}
if($_POST["getValorTotal"]){
    session_start();
    //var $data =array("valorTotalCompra"=>15.00);
    $_SESSION["valorT"]["compra"] = money_format("%.2n",$_SESSION["valorT"]["compra"]);
    echo json_encode($_SESSION["valorT"]);
    //echo '15.00';
}
if(isset($_POST["carregar-compra"])){
    GerenciaCompraController::carregarCompra($_POST["carregar-compra"]);
}
if(isset($_POST['btn-salvar-compra'])){
    session_start();
    //echo $_POST['select-fornecedor'] . "  ".$_POST['select-produto'];
    GerenciaCompraController::salvarCompra($_POST['select-fornecedor'],$_POST['data'],$_SESSION["valorT"]["compra"], $_SESSION["caixa"],$_POST['a-vista']);
}

class GerenciaCompraController{
    
    //static $itensCompra =array();
    
    public static function addItemCompra($produtoId, $quantidade){
        //echo "addItemCompraPHP<br>";
        //salva o id do produto e a quantidade em uma sessao, id como index
        session_start();
        $produtoDAO = new ProdutoDao();
        $p = $produtoDAO->load("*","WHERE id = '$produtoId'")[0];
        if($_SESSION["itensCompra"][$produtoId]==null){
            $_SESSION["itensCompra"][$produtoId]=$quantidade;
            $_SESSION["valorT"]["compra"]+=$p->getValor()*$quantidade;
                echo "<div class='alert  alert-dismissable'>".
                        "<span class = 'badge'>$quantidade</span>  "
                        .$p->getMarca()." - ".$p->getModelo()." - ".$p->getCodigoBarra()." - R$ ".money_format("%.2n",$p->getValor()).
                        "<button value='".$p->getId()."' onclick='rmvItemCompra(this.value)' type = 'button' class = 'close' aria-hidden = 'true' data-dismiss = 'alert' aria-hidden = 'true'>
                         &times;
                        </button>".
                    "</div>";
        }else{
            $ItensQtd = $_SESSION["itensCompra"][$produtoId];
            $qtdAtualizada = $ItensQtd + $quantidade;
            $_SESSION["valorT"]["compra"]+=$p->getValor()*$quantidade;
            $_SESSION["itensCompra"][$produtoId]=$qtdAtualizada;
            //se o item ja esta na lista atualiza a quantidade e o preco e recarrega a pagina
            echo true;
        }
        
    }
    public static function attItensCompra(){
        session_start();
        $produtoDAO = new ProdutoDao();
        //var_dump($_SESSION["itensCompra"]);
        if(!count($_SESSION["itensCompra"])==null){
          //  var_dump($_SESSION["itensCompra"]);
         foreach($_SESSION["itensCompra"] as $p_id => $qtd){
             
            $p = $produtoDAO->load("*","WHERE id = '$p_id'")[0];
            echo "<div class='alert  alert-dismissable'>".
                    "<span class = 'badge'>$qtd</span> "
                     .$p->getMarca()." - ".$p->getModelo()." - ".$p->getCodigoBarra()." - R$ ".money_format("%.2n",$p->getValor()).
                    "<button value='".$p->getId()."' onclick='rmvItemCompra(this.value)' type = 'button' class = 'close' aria-hidden = 'true' data-dismiss = 'alert' aria-hidden = 'true'>
                     &times;
                     </button>".
                    "</div>";
        }
        }
        
    }
    public static function rmvItemCompra($id){
        session_start();
        $produtoDAO = new ProdutoDao();
        $p = $produtoDAO->load("*","WHERE id = '$id'")[0];
        $_SESSION["valorT"]["compra"]-=$p->getValor()*$_SESSION["itensCompra"][$id];
        //echo "remover";
        unset($_SESSION["itensCompra"][$id]);
    }
    public function salvarCompra($fornecedorId,$data,$valorTotal,$caixaId,$aVista){
        $compraDAO = new CompraDAO();
        $filds = "";
        $erro = "";
        if($valorTotal==0){
            $erro = ("erro: nenhum item na compra!");
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
            $parans = array(null,$data,$valorTotal,$status,$fornecedorId,$caixaId);
            $idCompraInserida = $compraDAO->insert($filds,$parans);
           
            
            if(empty($idCompraInserida)){
                $erro = "erro: não foi possivel cadastrar!";
            }else{
                //gerar pagamento
                if($aVista){
                    PagamentoController::gerarPagamentoCompraAvista($idCompraInserida,$valorTotal,$data,$caixaId);
                }else{
                    PagamentoController::gerarPagamentoCompraParcelado($idCompraInserida,$numParcelas,$valorTotal,$vencimentoInicial,$caixaId);
                }
                //adiciona os itens
                $itemCompraDAO = new ItemCompraDAO();
                $produtoDAO = new ProdutoDao();
                foreach($_SESSION["itensCompra"] as $p_id => $qtd){
                    $p = $produtoDAO->load("*","WHERE id = '$p_id'")[0];
                    //atualiza quantidade em estoque
                    $pfields =array("quantidade");
                    $pparans = array($p->getQuantidade()+$qtd);
                    $produtoDAO->update($pfields,$pparans,"id = ".$p->getId()."");
                    $parans = array(null,$p->getValor(),$p->getValor()*$qtd,$qtd,$p->getId(),$idCompraInserida);
                    $item = $itemCompraDAO->insert("",$parans);
                    if(empty($item))$erro = ("erro: não foi possivel inserir o item");
                }
               session_start();
               unset($_SESSION["valorT"]["compra"]);
               $_SESSION["valorT"]["compra"]=0.0;
               unset($_SESSION["itensCompra"]);
               $erro = "success".$idCompraInserida;
           }
           
       }else{
           exit($erro);
       }
       
        exit($erro);
    }
    public function carregarCompra($id){
        $informacoesCompra = array();
        //carrega compra
        $compraDAO = new CompraDAO();
        $compra = $compraDAO->load("*","WHERE id = $id")[0];
        $informacoesCompra["compra"] = $compra;
        //carrega fornecedor
        $fornecedorDAO = new FornecedorDAO();
        $fornecedorId = $compra->getFornecedorId();
        $fornecedor = $fornecedorDAO->load("*","WHERE id =$fornecedorId ")[0];
        $informacoesCompra["fornecedor"] = $fornecedor;
        //carrega caixa
        $caixaDAO = new CaixaDAO();
        $caixaId = $compra->getCaixaId();
        $caixa = $caixaDAO->load("*","WHERE id = $caixaId");
        $informacoesCompra['caixa']=$caixa;
        //carrega itens da compra
        $itemCompraDAO = new ItemCompraDAO();
        $compraId = $compra->getId();
        $itensCompra = $itemCompraDAO->load("*","WHERE compraId = $compraId");
        $informacoesCompra['itensCompra'] = $itensCompra;
        //carregar pagamento
        $informacoesCompra['pagamentos'] = PagamentoController::carregarPagamentosCompra($id);
        //carrega produtos
        $produtoDAO = new ProdutoDAO();
        foreach($itensCompra as $key => $itemCompra){
            $produtoId = $itemCompra->getProdutoId();
            $produto = $produtoDAO->load("*","WHERE id = $produtoId")[0];
            $informacoesCompra["produto"][$key] = $produto;
        }
        return $informacoesCompra;
    }
    public static function carregarComprasPagamentoPendente($data){
        $compraDAO = new CompraDAO();
        if($data == null){
            $compra = $compraDAO->load("*","WHERE status = 0 ORDER BY data");
        }else{
            $compra = $compraDAO->load("*","WHERE status = 0 && data = $data");
        }
        return $compra;
    }
}
?>

























