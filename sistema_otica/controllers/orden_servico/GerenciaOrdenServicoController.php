<?php

include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Venda.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Produto.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/ProdutoDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/ItemVenda.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/ItemVendaDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Venda.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/VendaDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/controllers/venda/GerenciaVendaController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/ServicoDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Servico.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/controllers/GerenciaCaixaController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/OrdenServicoDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/OrdenServico.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/ItemServico.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/ItemServicoDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/controllers/PagamentoController.php";



if($_POST["addItemServico"]){
    //echo "entrou";
    $servicoId = $_POST["servicoId"];
    $quantidade = $_POST["quantidade"];
    GerenciaOrdenServicoController::addItemServico($servicoId,$quantidade);
    
}
if($_POST["attListaServico"]){
    //echo "atualizar itens servico";
    GerenciaOrdenServicoController::attItensServico();
}
if($_POST["salvar-orden-servico"]){
    //echo "salvarOrdenServico";
    session_start();
    $clienteId =$_POST['select-cliente'];
    $dataServico =$_POST['data'];
    $previsaoEntrega = $_POST['previsao-entrega'];
    $valorRecebidoServico = $_POST['valor-recebido-servico'];
    $valorRecebidoVenda = $_POST["valor-recebido-venda"];
    $valorTotalServico = $_SESSION["valorT"]["servico"];
    $valorTotalVenda = $_SESSION["valorT"]["venda"];
    $inserirVenda = $_POST["inserir-venda"];
    $caixaId = $_SESSION["caixa"];
    $aVista = $_POST["a-vista"];
    
    //echo "cliente : ".$clienteId."<br>";
    //echo "data Ser: ".$dataServico."<br>";
    //echo "previsao: ".$previsaoEntrega."<br>";
    //echo "valorReS: ".$valorRecebidoServico."<br>";
    //echo "valorReV: ".$valorRecebidoVenda."<br>";
    //echo "totalSer: ".$valorTotalServico."<br>";
    //echo "totalVen: ".$valorTotalVenda."<br>";
    //echo "insVenda: ".$inserirVenda."<br>";
    //echo "caixa id: ".$caixaId."<br>";
    //var_dump($_SESSION["itensServico"]);
    //var_dump($_SESSION["itensVenda"]);
    
    GerenciaOrdenServicoController::salvarOrdenServico($clienteId,$dataServico,$previsaoEntrega,$valorTotalServico,$valorTotalVenda,$inserirVenda,$caixaId,$aVista);
    //echo "depois da funcao";
}
if($_POST["rvmItemServico"]){
    //echo"rvmItem";
    GerenciaOrdenServicoController::rmvItemServico($_POST["s_id"]);
}
if($_POST["getValorTotalOrden"]){
    session_start();
    //echo "valor total";
    
    $retorno["valorT"]["totalordem"] = money_format("%.2n",$_SESSION["valorT"]["servico"]+$_SESSION["valorT"]["venda"]);
    //unset($_SESSION["valorT"]);
    echo json_encode($retorno["valorT"]);

}
if($_POST["getValorServicos"]){
    session_start();
    //echo "valor total";
    $_SESSION["valorT"]["servico"];
    $retorno["valorT"]["servico"] = money_format("%.2n",$_SESSION["valorT"]["servico"]);
    //unset($_SESSION["valorT"]);
    echo json_encode($retorno["valorT"]);

}
if(isset($_POST["carregar-orden-servico"])){
    GerenciaOrdenServicoController::carregarOrdenServico($_POST["carregar-orden-servico"]);
}

class GerenciaOrdenServicoController{

    public function addItemServico($servicoId,$quantidade){
        //echo "implemetar addItemServico";
        //echo "$servicoId $quantidade";
        session_start();
        $servicoDAO = new ServicoDao();
        $p = $servicoDAO->load("*","WHERE id = '$servicoId'")[0];
        if($_SESSION["itensServico"][$servicoId]==null){
            $_SESSION["itensServico"][$servicoId]=$quantidade;
            $_SESSION["valorT"]["servico"]+=$p->getValor()*$quantidade;
                echo "<div class='alert  alert-dismissable'>".
                        "<span class = 'badge'>$quantidade</span>  "
                        .$p->getNome()." - ".$p->getDescricao()." - R$ ".money_format("%.2n",$p->getValor()).
                        "<button value='".$p->getId()."' onclick='rmvItemServico(this.value)' type = 'button' class = 'close' aria-hidden = 'true' data-dismiss = 'alert' aria-hidden = 'true'>
                         &times;
                        </button>".
                    "</div>";
        }else{
            $ItensQtd = $_SESSION["itensServico"][$servicoId];
            $qtdAtualizada = $ItensQtd + $servicoId;
            $_SESSION["valorT"]["servico"]+=$p->getValor()*$servicoId;
            $_SESSION["itensServico"][$servicoId]=$qtdAtualizada;
            //se o item ja esta na lta atualiza a quantidade e o preco e recarrega a pagina
            echo true;
        }
    }
    public function rmvItemServico($id){
        session_start();
        $servicoDAO = new ServicoDao();
        $s = $servicoDAO->load("*","WHERE id = '$id'")[0];
        $_SESSION["valorT"]["servico"]-=$s->getValor()*$_SESSION["itensServico"][$id];
        //echo "remover";
        unset($_SESSION["itensServico"][$id]);
    }
    public function salvarOrdenServico($clienteId,$dataServico,$previsaoEntrega,$valorTotalServico,$valorTotalVenda,$inserirVenda,$caixaId,$aVista){
        $erro = "";
        $status=0;
        if($clienteId == null){
            $erro = "erro: selecione um cliente!";
        }else if($dataServico == null){
            $erro = "erro: data do servico nao pode ser nula!";
        }else if($previsaoEntrega == null){
            $erro = "erro: data de entrega nao pode ser nula!";
        }else if($valorTotalServico<=0){
            $erro = "erro: adicione um servico!";
        }else if($caixaId==null){
            $erro = "erro: o caixa esta fechado!";
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
        if($erro ==""){
            if($inserirVenda){
                $retorno = GerenciaVendaController::salvarVenda($clienteId,$dataServico,$valorTotalVenda,$caixaId,$aVista);
                //echo " cadastrar venda :".$retorno;
                $vendaId = substr($retorno,7);
                //echo "venda Id".$vendaId."<br>";
                //$erro = $retorno;
            }
            if((strpos($retorno, 'success') !== false) || !$inserirVenda){
                $ordenServicoDAO = new OrdenServicoDAO();
                //echo "success: pronto para cadastrar orden!";
                //$erro = "erro: pronto pra comecar a implementar";
                $parans = array(null,$dataServico,$previsaoEntrega,$valorTotalServico,$clienteId,$vendaId,$caixaId,$status);
                $idOrdenServicoInserida = $ordenServicoDAO->insert("",$parans);
                //orden inseridaSer
                if(empty($idOrdenServicoInserida)){
                    $erro = "erro: não foi possivel cadastrar!";
                }else{
                     if($aVista){
                        PagamentoController::gerarPagamentoServicoAvista($idOrdenServicoInserida,$valorTotalServico,$dataServico,$caixaId);
                    }else{
                        PagamentoController::gerarPagamentoServicoParcelado($idOrdenServicoInserida,$numParcelas,$valorTotalServico,$vencimentoInicial,$caixaId);
                    }
                    $itemServicoDAO = new ItemServicoDAO();
                    $servicoDAO = new ServicoDao();
                    //para cada item de servico
                    foreach($_SESSION["itensServico"] as $s_id => $qtd){
                        $s = $servicoDAO->load("*","WHERE id = '$s_id'")[0];
        
                        //insere o item
                        $parans = array(null,$qtd,$s->getId(),$idOrdenServicoInserida,$s->getValor()*$qtd,$s->getValor());
                        $itemServico = $itemServicoDAO->insert("",$parans);
                        if(empty($itemServico))$erro = ("erro: não foi possivel inserir o item");
                    }
                    //apaga os dados temporarios em sessao
                    session_start();
                    unset($_SESSION["valorT"]["servico"]);
                    $_SESSION["valorT"]["servico"]=0.0;
                    unset($_SESSION["itensServico"]);
                    
                    $erro = "success".$idOrdenServicoInserida;
                }
            }
        }
            //echo $retorno;
            echo $erro;
            return $erro;
        
    }
    public function attItensServico(){
        session_start();
        $servicoDAO = new ServicoDao();
        //var_dump($_SESSION["itensCompra"]);
        if(!count($_SESSION["itensServico"])<=0){
          //  var_dump($_SESSION["itensCompra"]);
         foreach($_SESSION["itensServico"] as $s_id => $qtd){
             
            $s = $servicoDAO->load("*","WHERE id = '$s_id'")[0];
            echo "<div class='alert  alert-dismissable'>".
                    "<span class = 'badge'>$qtd</span>  "
                     .$s->getNome()." - ".$s->getDescricao()."  R$ ".money_format("%.2n",$s->getValor()).
                    "<button value='".$s->getId()."' onclick='rmvItemServico(this.value)' type = 'button' class = 'close' aria-hidden = 'true' data-dismiss = 'alert' aria-hidden = 'true'>
                     &times;
                     </button>".
                    "</div>";
        }
        }
    }
    public function carregarOrdenServico($id){
        $informacoesServico = array();
        $ordenServicoDAO = new OrdenServicoDAO();
        $ordenServico = $ordenServicoDAO->load("*","WHERE id = $id")[0];
        
        $informacoesServico["orden-servico"] = $ordenServico;
        $clienteDAO = new ClienteDAO();
        $clienteId = $ordenServico->getClienteId();
        
        $cliente = $clienteDAO->load("*","WHERE id =$clienteId ")[0];
        
        $informacoesServico["cliente"] = $cliente;
        
        $caixaDAO = new CaixaDAO();
        $caixaId = $ordenServico->getCaixaId();
        $caixa = $caixaDAO->load("*","WHERE id = $caixaId")[0];

        $informacoesServico["caixa"]=$caixa;
        
        $itemServicoDAO = new ItemServicoDAO();
        $ordenServicoId = $ordenServico->getId();
        $itensOrdenServico = $itemServicoDAO->load("*","WHERE ordenServicoId = $ordenServicoId");
        

        $informacoesServico["itensServico"] = $itensOrdenServico;
        //carregar pagamento
        $informacoesServico['pagamentos'] = PagamentoController::carregarPagamentosServico($id);
        $servicoDAO = new ServicoDAO();
        foreach($itensOrdenServico as $key=>$servico){
            $servicoId = $servico->getServicoId();
            $servico = $servicoDAO->load("*","WHERE id = $servicoId")[0];
            $informacoesServico["servicos"][$key]= $servico;
        }
        
        return $informacoesServico;
            
    }
    public static function carregarServicosRecebimentoPendente($data){
        $ordenServicoDAO = new OrdenServicoDAO();
        if($data == null){
            $servico = $ordenServicoDAO->load("*","WHERE status = 0 ORDER BY dataServico");
        }else{
            $servico = $ordenServicoDAO->load("*","WHERE status = 0 && data = $data");
        }
        return $servico;
    }
}
?>













