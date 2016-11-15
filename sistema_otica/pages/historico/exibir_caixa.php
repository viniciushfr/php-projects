<?php
include_once"../controllers/GerenciaCaixaController.php";
$caixaId = $_GET["exibir-caixa-id"];
$informacoesCaixa = GerenciaCaixaController::carregarCaixa($caixaId);
//ar_dump($informacoesCaixa);
$html ="";
?>
<script type="text/javascript">

    function exibirOperacao(tipoLancamento,id){
        if(tipoLancamento == "compra"){
            window.location.href="sessao.php?page=compra/exibir-compra.php&exibir-compra-id="+id;
        }else if(tipoLancamento == "venda"){
             window.location.href="sessao.php?page=venda/exibir-venda.php&exibir-venda-id="+id;
        }
        else if(tipoLancamento == "servico"){
            window.location.href="sessao.php?page=orden_servico/exibir-orden-servico.php&exibir-servico-id="+id;
        }
    }
        
</script>
<?php
$html.= "<div class='col-lg-12'>";
$html.= "    <div class='row'>";
        
$html.= "<h3 ><span class='label label-default '>numero do caixa:".$informacoesCaixa["caixa"]->getId()."</span></h3>";
$html.= "<h3 ><span class='label label-default '>valor no caixa:  R$ : ".money_format("%.2n",$informacoesCaixa["caixa"]->getValor())."</span></h3>";
       
$html.="   </div>";
$html.="</div>";
$html.="<div class='panel'></div>";
$html.="<div class='panel'></div>";

$html.="<div class='panel panel-default' style='margin-top:30px'>";
$html.="<div class='panel-heading'>";
$html.="    Movimentações";
$html.="</div>";
$html.="<div class'panel-body'>";
$html.="<table class='table table-condensed table-hover table-bordered'>";
$html.="    <thead>";
$html.="        <tr>";
$html.="            <td>Tipo Lancamento</td>";
$html.="            <td>Pagamento</td>";
$html.="            <td>Valor</td>";
$html.="        </tr>";
$html.="    </thead>";
$html.="    <tbody>";
for($i =0;$i < count($informacoesCaixa["pagamentos"]);$i++){
    if($informacoesCaixa["pagamentos"][$i]->getCompraId()!=null){
        $html.= "<tr class='danger' onclick=\"exibirOperacao('compra','".$informacoesCaixa["pagamentos"][$i]->getCompraId()."')\">";
        $html.= "<td>"."Compra"."</td>";
    }else if($informacoesCaixa["pagamentos"][$i]->getVendaId()!=null){
        $html.= "<tr class='success' onclick=\"exibirOperacao('venda','".$informacoesCaixa["pagamentos"][$i]->getVendaId()."')\">";
        $html.= "<td>"."Venda"."</td>";
    }else if($informacoesCaixa["pagamentos"][$i]->getOrdemServicoId()!=null){
        $html.= "<tr class='success' onclick=\"exibirOperacao('servico','".$informacoesCaixa["pagamentos"][$i]->getOrdemServicoId()."')\">";
        $html.= "<td>"."Servico"."</td>";
    }
    $html.= "<td>".$informacoesCaixa["pagamentos"][$i]->getNumPagamento()."</td>";
    $html.= "<td> R$: ".money_format("%.2n",$informacoesCaixa["pagamentos"][$i]->getValorPago())."</td>";
    $html.= "</tr>";
}

        
$html.="    </tbody>";
$html.="</table>";
$html.="</div>";
$html.="</div>";
session_start();
$_SESSION["relatorioCaixa"]["html"] = $html;
echo $html;
 ?>


</div>

<div class="panel">
    <div class="panel-body">
         <a href="historico/relatorio_caixa.php"  class="btn btn-info pull-right btn-lg">Gerar relatório</a>
    </div>
</div>
  