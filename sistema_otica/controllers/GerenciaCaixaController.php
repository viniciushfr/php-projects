<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/controllers/PagamentoController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Pagamento.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/PagamentoDAO.php";


if (file_exists("../models/Caixa.php")){
    include_once "../models/Caixa.php";
}
if (file_exists("../../models/Caixa.php")){
    include_once "../../models/Caixa.php";
}
if (file_exists("../models/dao/CaixaDAO.php")){
    include_once "../models/dao/CaixaDAO.php";
}
if (file_exists("../../models/dao/CaixaDAO.php")){
    include_once "../../models/dao/CaixaDAO.php";
}
if (file_exists("../models/Compra.php")){
    include_once "../models/Compra.php";
}
if (file_exists("../../models/Compra.php")){
    include_once "../../models/Compra.php";
}

if (file_exists("../models/dao/CompraDAO.php")){
    include_once "../models/dao/CompraDAO.php";
}
if (file_exists("../../models/dao/CompraDAO.php")){
    include_once "../../models/dao/CompraDAO.php";
}
if (file_exists("../models/dao/VendaDAO.php")){
    include_once "../models/dao/VendaDAO.php";
}
if (file_exists("../../models/dao/VendaDAO.php")){
    include_once "../../models/dao/VendaDAO.php";
}
if (file_exists("../models/Venda.php")){
    include_once "../models/Venda.php";
}
if (file_exists("../../models/Venda.php")){
    include_once "../../models/Venda.php";
}
if (file_exists("../../models/OrdenServico.php")){
    include_once "../../models/OrdenServico.php";
}
if (file_exists("../models/OrdenServico.php")){
    include_once"../models/OrdenServico.php";
}
if (file_exists("../../models/dao/OrdenServicoDAO.php")){
    include_once "../../models/dao/OrdenServicoDAO.php";
}
if (file_exists("../models/dao/OrdenServicoDAO.php")){
    include_once"../models/dao/OrdenServicoDAO.php";
}

if(isset($_POST['caixa-status'])){
    $caixa = GerenciaCaixaController::caixaAberto();
    if(empty($caixa)){
        echo -1;
    }else{
        echo 0;
        session_start();
        $_SESSION["caixa"] = $caixa->getId();
    }
}
if($_POST['abrir-caixa']){
    //echo "abrir caixa";
    GerenciaCaixaController::abrirCaixa();
}
if($_POST['fechar-caixa']){
    //echo "fechar caixa";
    $valorCaixa=$_POST["valor-caixa"];
    //echo $valorCaixa;
    GerenciaCaixaController::fecharCaixa($valorCaixa);
}
class GerenciaCaixaController{
    public static function abrirCaixa(){
        //echo "abrirCaixa<br>";
        
        if(!empty(GerenciaCaixaController::caixaAberto())){
            echo "Caixa já está aberto!";
        }else{
            $novoCaixa = new Caixa();
            $dt = new DateTime();
            $novoCaixa->setDataAbertura($dt->format('Y-m-d H:i:s'));
            
            $caixaDAO = new CaixaDAO();
            $ultimoCaixa = $caixaDAO->load("*","ORDER BY id DESC LIMIT 1")[0];
            //var_dump($ultimoCaixa);
            $fields = "dataAbertura, valor";
            $params = array($novoCaixa->getDataAbertura(),$ultimoCaixa->getValor());
            $novoCaixa = $caixaDAO->insert($fields, $params);
            if(!empty($novoCaixa)){
                session_start();
                $_SESSION["caixa"] = $novoCaixa;
                echo "Caixa Aberto!".$novoCaixa;
            }else{
                echo "Não foi possível abrir!";
            }   
        }
        
    }
    public static function caixaAberto(){
        $caixaDAO = new CaixaDAO();
        $add = "WHERE  dataFechamento = \"0000-00-00 00:00:00\" LIMIT 1";
        $caixaAberto = $caixaDAO->load("*",$add);
       // var_dump($caixaAberto);
        
        return $caixaAberto[0];
    }
    public static function fecharCaixa($valorCaixa){
        //echo "fecharCaixa<br>";
        echo $valorCaixa;
        $caixaAberto = GerenciaCaixaController::caixaAberto();
        if(empty($caixaAberto)){
             echo "Caixa não está aberto!";
        }else{
            $fields = array("dataFechamento","valor");
            $dt = new DateTime();
            $params = array($dt->format('Y-m-d H:i:s'),$valorCaixa);
            //var_dump($caixaAberto);
            $where = "id = ".$caixaAberto->getId();
            $caixaDAO = new CaixaDAO();
            $caixaDAO->update($fields,$params,$where);
            session_start();
            unset($_SESSION["caixa"]);
            echo "Caixa foi fechado!";
        }
        
    }
    public static function verCaixa(){
        $caixaId = $_SESSION["caixa"];
        $pagamentoDAO = new PagamentoDAO();
        $pagamentos = $pagamentoDAO->load("*","WHERE caixaId = $caixaId ORDER BY dataPagamento" );
        return $pagamentos;
    }
    public static function carregarCaixa($caixaId){
        $informacoesCaixa = array();
        $caixaDAO = new CaixaDAO();
        $caixa = $caixaDAO->load("*","WHERE id = $caixaId")[0];
        $informacoesCaixa["caixa"] = $caixa;
        $pagamentoDAO = new PagamentoDAO();
        $pagamentos = $pagamentoDAO->load("*","WHERE caixaId = $caixaId");
        $informacoesCaixa["pagamentos"] = $pagamentos;
        //var_dump ($informacoesCaixa);
        return $informacoesCaixa;
    }
}
?>