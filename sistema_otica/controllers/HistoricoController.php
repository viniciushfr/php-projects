<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/CompraDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/VendaDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/OrdenServicoDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Compra.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Venda.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/OrdenServico.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/Caixa.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/models/dao/CaixaDAO.php";

if($_POST["buscar-compra"]){
    //echo $_POST["busca"];
    HistoricoController::buscarCompras($_POST["busca"]);
}
if($_POST["buscar-venda"]){
    
    //echo $_POST["busca"];
    HistoricoController::buscarVendas($_POST["busca"]);
}
if($_POST["buscar-servico"]){
    //echo $_POST["busca"];
    HistoricoController::buscarServicos($_POST["busca"]);
}
if($_POST["buscar-caixa"]){
    //echo $_POST["busca"];
    HistoricoController::buscarCaixa($_POST["busca"]);
}


class HistoricoController{
    public static function buscarCompras($data){
        $compraDAO = new CompraDAO();
        $compras = $compraDAO->load("*","WHERE data LIKE '$data%' ORDER BY data");
        //var_dump($compras);
        $html= "";
        session_start();
        $_SESSION['relatorioLancamentos']['tipo']="Compras";
        if($data!=null)$_SESSION['relatorioLancamentos']['data']=$data;
        else $_SESSION['relatorioLancamentos']['data']="todas as compras";
        
        foreach($compras as $compra){
            if($compra->getStatus()){
                $html.="<tr onclick=\"exibirCompra('".$compra->getId()."')\" class='success'>";
            }else{
                $html.="<tr onclick=\"exibirCompra('".$compra->getId()."')\" class='warning'>";
            }
            
            $html.= "<td>".$compra->getData()."</td>";
            $html.=  "<td>  R$: ".money_format("%.2n",$compra->getValorTotal())."</td>";
            if($compra->getStatus())$html.= "<td>"."Finalizado"."</td>";
            else $html.= "<td>"."Pendente"."</td>";
            $html.= "</tr>";
        }
        $_SESSION['relatorioLancamentos']["html"] = $html;
        echo $html;
        return $compras;
    }
    public static function buscarVendas($data){
        $vendaDAO = new VendaDAO();
        $vendas = $vendaDAO->load("*","WHERE data LIKE '$data%' ORDER BY data");
        
        $html= "";
        session_start();
        $_SESSION['relatorioLancamentos']['tipo']="Vendas";
        if($data!=null)$_SESSION['relatorioLancamentos']['data']=$data;
        else $_SESSION['relatorioLancamentos']['data']="todas as vendas";
        
        foreach($vendas as $venda){
            if($venda->getStatus()){
                $html.= "<tr onclick=\"exibirVenda('".$venda->getId()."')\" class='success'>";
            }else{
                $html.= "<tr onclick=\"exibirVenda('".$venda->getId()."')\" class='warning'>";
            }
            $html.=  "<td>".$venda->getData()."</td>";
            $html.=  "<td> R$: ".money_format("%.2n",$venda->getValorTotal())."</td>";
            if($venda->getStatus())$html.= "<td>"."Finalizado"."</td>";
            else $html.= "<td>"."Pendente"."</td>";
            
            $html.= "</tr>";
        }
        $_SESSION['relatorioLancamentos']["html"] = $html;
        echo $html;
        return $vendas;
    }
    public static function buscarServicos($data){
        $ordemServicoDAO = new OrdenServicoDAO();
        $servicos = $ordemServicoDAO->load("*","WHERE dataServico LIKE '$data%' ORDER BY dataServico");
        
        $html= "";
        session_start();
        $_SESSION['relatorioLancamentos']['tipo']="Serviços";
        if($data!=null)$_SESSION['relatorioLancamentos']['data']=$data;
        else $_SESSION['relatorioLancamentos']['data']="todos os serviços";
        
        foreach($servicos as $servico){
            if($servico->getStatus()){
                $html.=  "<tr onclick=\"exibirServico('".$servico->getId()."')\" class='success'>";
            }else{
                $html.= "<tr onclick=\"exibirServico('".$servico->getId()."')\" class='warning'>";
            }
            $html.= "<td>".$servico->getDataServico()."</td>";
            $html.= "<td> R$: ".money_format("%.2n",$servico->getPrecoTotal())."</td>";
             if($servico->getStatus())$html.= "<td>"."Finalizado"."</td>";
            else $html.= "<td>"."Pendente"."</td>";
            $html.= "</tr>";
        }
        $_SESSION['relatorioLancamentos']["html"] = $html;
        echo $html;
        return $servicos;
    }
    public static function buscarCaixa($data){
        $caixaDAO = new CaixaDAO();
        $caixas = $caixaDAO->load("*","WHERE dataAbertura LIKE '$data%' ORDER BY id");
        $html= "";
        foreach($caixas as $caixa){
            $html.="<tr onclick=\"exibirCaixa('".$caixa->getId()."')\">";
             $html.="<td>".$caixa->getId()."</td>";
            $html.="<td>".$caixa->getDataAbertura()."</td>";
            $html.="<td>".$caixa->getDataFechamento()."</td>";
            $html.="<td> R$: ". money_format("%.2n",$caixa->getValor())."</td>";
            $html.="</tr>";
        }
        echo $html;
        return $caixas;
    }
    
}









?>