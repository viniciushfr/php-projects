<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Pagamento.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/PagamentoDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/controllers/GerenciaCaixaController.php";

if(isset($_POST["pagar"])){
    $pagamentoId = $_POST["pagamentoId"];
    $multa = $_POST["multa"];
    $desconto = $_POST["desconto"];
    PagamentoController::pagar($pagamentoId,$multa,$desconto);
}

class PagamentoController{
    
    
    public static function gerarPagamentoCompraParcelado($compraId,$numParcelas,$valorCompra,$vencimentoInicial,$caixaId){
        $pagamentoDAO = new PagamentoDAO();
        echo $valorCompra;
        $valorParcela = $valorCompra/$numParcelas;
        $data = $vencimentoInicial;
        $data = new DateTime($data);
        for($i =1;$i<=$numParcelas;$i++){
            $params = array(null,$i,$valorParcela,null,$data->format('Y-m-d H:i:s'),null,null,$compraId,null,null,null,null);
            
            $m = 1;
            echo "<br>".$data->format('Y-m-d H:i:s')."<br>";
            $data->add(new DateInterval('P'.$m.'M'));
            $pagamentoDAO->insert("",$params);
        }
    }
    public static function gerarPagamentoCompraAvista($compraId,$valor,$data,$caixaId){
        $pagamentoDAO = new PagamentoDAO();
        $params = array(null,1,$valor,0,$data,$data,$valor,$compraId,null,null,$caixaId,null);
        $pagamentoId = $pagamentoDAO->insert("",$params);
        if($pagamentoId){
            return true;
        }else{
            return false;
        }
        
    }
    public static function carregarPagamentosCompra($compraId){
        $pagamentoDAO = new PagamentoDAO();
        $pagamentos = $pagamentoDAO->load("*","WHERE compraId = $compraId");
        return $pagamentos;
    }
    public static function pagar($pagamentoId,$multa,$desconto){
        $pagamentoDAO = new PagamentoDAO();
        $pgm = $pagamentoDAO->load("*","WHERE id = $pagamentoId")[0];
        if($pgm->getDataPagamento()==null){
            
            $caixa = GerenciaCaixaController::caixaAberto();
            if($caixa==null){
                echo "Erro: Caixa Fechado";
                return false;
            }else{
                $caixaId = $caixa->getId();
            }
            $fields = array("dataPagamento","caixaId","valorPago","multa","desconto");
            $data = new DateTime();
            $params = array($data->format('Y-m-d'),$caixaId,$pgm->getValor()+$multa-$desconto,$multa,$desconto);
            //echo $pagamentoId."<br>";
            $pagamento = $pagamentoDAO->update($fields,$params,"id = $pagamentoId");
            if($pagamento){
                if($pgm->getVendaId()!=null){
                    echo "e uma venda";
                    if(self::verificarVendaConcluida($pgm->getVendaId())){
                        echo "venda concluida";
                        self::atualizarStatusVenda($pgm->getVendaId());
                    }
                }else if($pgm->getCompraId()!=null){
                    echo "e uma compra";
                    if(self::verificarCompraConcluida($pgm->getCompraId())){
                        echo "venda concluida";
                        self::atualizarStatusCompra($pgm->getCompraId());
                    }
                }else if($pgm->getOrdemServicoId()!=null){
                    echo "e um servico";
                    if(self::verificarServicoConcluido($pgm->getOrdemServicoId())){
                        echo "servico comcluido";
                        self::atualizarStatusOrdemServico($pgm->getOrdemServicoId());
                    }
                }
                echo "success";
                return true;
                
                
            }else{
                
                echo false;
                return false;
            }
        }else{
            echo false;
            echo "Erro: Pagamento ja foi realizado!";
            return false;
        }
    }
    private static function atualizarStatusVenda($vendaId){
        $vendaDAO = new VendaDAO();
        $fields = array("status");
        $params = array('1');
        $vendaDAO->update($fields,$params,"id = $vendaId");
    }
    private static function atualizarStatusCompra($compraId){
        $compraDAO = new CompraDAO();
        $fields = array("status");
        $params = array('1');
        $compraDAO->update($fields,$params,"id = $compraId");
    }
    private static function atualizarStatusOrdemServico($ordemServicoId){
        $ordemServicoDAO = new OrdenServicoDAO();
        $fields = array("status");
        $params = array('1');
        $ordemServicoDAO->update($fields,$params,"id = $ordemServicoId");
    }
    
    public static function gerarPagamentoVendaParcelado($vendaId,$numParcelas,$valorVenda,$vencimentoInicial,$caixaId){
        $pagamentoDAO = new PagamentoDAO();
        echo $valorVenda;
        $valorParcela = $valorVenda/$numParcelas;
        $data = $vencimentoInicial;
        $data = new DateTime($data);
        for($i =1;$i<=$numParcelas;$i++){
            $params = array(null,$i,$valorParcela,null,$data->format('Y-m-d H:i:s'),null,null,null,$vendaId,null,null,null);
            $m = 1;
            echo "<br>".$data->format('Y-m-d H:i:s')."<br>";
            $data->add(new DateInterval('P'.$m.'M'));
            $pagamentoDAO->insert("",$params);
        }
    }
    public static function gerarPagamentoVendaAvista($vendaId,$valor,$data,$caixaId){
        $pagamentoDAO = new PagamentoDAO();
        $params = array(null,1,$valor,0,$data,$data,$valor,null,$vendaId,null,$caixaId,null);
        $pagamentoId = $pagamentoDAO->insert("",$params);
        if($pagamentoId){
            return true;
        }else{
            return false;
        }
        
    }
    public static function carregarPagamentosVenda($vendaId){
        $pagamentoDAO = new PagamentoDAO();
        $pagamentos = $pagamentoDAO->load("*","WHERE vendaId = $vendaId");
        return $pagamentos;
    }
    
    private static function verificarVendaConcluida($vendaId){
        $pagamentoDAO = new PagamentoDAO();
        $pagamentos = $pagamentoDAO->load("*","WHERE vendaId = $vendaId && dataPagamento is null");
        if(empty($pagamentos)){
            return true;
        }else{
            return false;
        }
    }
    private static function verificarCompraConcluida($compraId){
        $pagamentoDAO = new PagamentoDAO();
        $pagamentos = $pagamentoDAO->load("*","WHERE compraId = $compraId && dataPagamento is null");
        if(empty($pagamentos)){
            return true;
        }else{
            return false;
        }
    }
    private static function verificarServicoConcluido($ordemServicoId){
        $pagamentoDAO = new PagamentoDAO();
        $pagamentos = $pagamentoDAO->load("*","WHERE ordemServicoId = $ordemServicoId && dataPagamento is null");
        if(empty($pagamentos)){
            return true;
        }else{
            return false;
        }
    }
    
    
    
    public static function gerarPagamentoServicoParcelado($servicoId,$numParcelas,$valorServico,$vencimentoInicial,$caixaId){
        $pagamentoDAO = new PagamentoDAO();
        echo $valorServico;
        $valorParcela = $valorServico/$numParcelas;
        $data = $vencimentoInicial;
        $data = new DateTime($data);
        for($i =1;$i<=$numParcelas;$i++){
            $params = array(null,$i,$valorParcela,null,$data->format('Y-m-d H:i:s'),null,null,null,null,$servicoId,null,null);
            $m = 1;
            echo "<br>".$data->format('Y-m-d H:i:s')."<br>";
            $data->add(new DateInterval('P'.$m.'M'));
            $pagamentoDAO->insert("",$params);
        }
    }
    public static function gerarPagamentoServicoAvista($servicoId,$valor,$data,$caixaId){
        $pagamentoDAO = new PagamentoDAO();
        $params = array(null,1,$valor,0,$data,$data,$valor,null,null,$servicoId,$caixaId,null);
        $pagamentoId = $pagamentoDAO->insert("",$params);
        if($pagamentoId){
            return true;
        }else{
            return false;
        }
        
    }
    public static function carregarPagamentosServico($servicoId){
        $pagamentoDAO = new PagamentoDAO();
        $pagamentos = $pagamentoDAO->load("*","WHERE ordemServicoId  = $servicoId");
        return $pagamentos;
    }
    public static function carregarPagamentosEntradaVencidos(){
        $pagamentoDAO = new PagamentoDAO();
        $vencidos = $pagamentoDAO->load("*","WHERE (vendaId is not null || ordemServicoId is not null) && dataPrevista <= CURRENT_DATE && dataPagamento is null");
        return $vencidos;
    }
    public static function carregarPagamentosSaidaVencidos(){
        $pagamentoDAO = new PagamentoDAO();
        $vencidos = $pagamentoDAO->load("*","WHERE compraId is not null && dataPrevista <= CURRENT_DATE && dataPagamento is null");
        return $vencidos;
    }
}


?>