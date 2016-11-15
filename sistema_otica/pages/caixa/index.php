<?php
if (file_exists("../../controllers/GerenciaCaixaController.php")){
    include_once "../../controllers/GerenciaCaixaController.php";
}
if (file_exists("../controllers/GerenciaCaixaController.php")){
    include_once "../controllers/GerenciaCaixaController.php";
}

$caixa = GerenciaCaixaController::caixaAberto();
session_start();
		if (empty($_SESSION['caixa'])){
		   echo " <meta http-equiv='refresh' content=1;url='sessao.php?page=inicio.php'>";
		}

$pagamentos = GerenciaCaixaController::verCaixa();

if(!empty($caixa))
$valorDoCaixa = $caixa->getValor();
else exit();
?>
<script type="text/javascript">
    function fecharCaixa(valorCaixa){
        //alert("abrindo caixa");
        //alert(valorCaixa);
        var dados = {"fechar-caixa":true,"valor-caixa":valorCaixa}
        $.post('../controllers/GerenciaCaixaController.php',dados,function(retorno){
             $("#erro-log").addClass("alert alert-info");
            $("#erro-log").html(retorno);
             window.location.href="sessao.php?page=inicio.php";
        });
    }
    function exibirOperacao(tipoLancamento,id){
        if(tipoLancamento == "compra"){
            window.location.href="sessao.php?page=compra/exibir-compra.php&exibir-compra-id="+id;

             /*$.post('../controllers/compra/GerenciaCompraController.php',{"carregar-compra":id},function(retorno){
                //alert(retorno);
                if(retorno){
                    window.location.href="sessao.php?page=compra/exibir-compra.php&carrega-compra-id="+retorno;
                }else{
                    alert("deu ruim");
                }
            });*/
        }else if(tipoLancamento == "venda"){
             window.location.href="sessao.php?page=venda/exibir-venda.php&exibir-venda-id="+id;
             /*
            $.post('../controllers/venda/GerenciaVendaController.php',{"carregar-venda":id},function(retorno){
                alert(retorno);
                if(retorno){
                    window.location.href="sessao.php?page=venda/exibir-venda.php";
                }else{
                    alert("deu ruim");
                }
            });
            */
        }
        else if(tipoLancamento == "servico"){
            window.location.href="sessao.php?page=orden_servico/exibir-orden-servico.php&exibir-servico-id="+id;
            /*
             $.post('../controllers/orden_servico/GerenciaOrdenServicoController.php',{"carregar-orden-servico":id},function(retorno){
                //alert(retorno);
                if(retorno){
                    window.location.href="sessao.php?page=orden_servico/exibir-orden-servico.php";
                }else{
                    alert("deu ruim");
                }
            });
            */
        }
    }
</script>
<div class="panel panel-primary" style="margin-top:30px">
<div class="panel-heading">
    Movimentações
</div>
<table class="table table-condensed table-hover">
    <thead>
        <tr>
            <td>Tipo Lancamento</td>
            <td>Pagamento</td>
            <td>Valor</td>
        </tr>
    </thead>
        <?php
        
            for($i =0;$i < count($pagamentos);$i++){
                
               
                
                if($pagamentos[$i]->getCompraId()!=null){
                    $valorDoCaixa-=$pagamentos[$i]->getValorPago();
                    echo "<tr class='danger' onclick=\"exibirOperacao('compra','".$pagamentos[$i]->getCompraId()."')\">";
                    echo "<td>"."Compra"."</td>";
                }else if($pagamentos[$i]->getVendaId()!=null){
                    $valorDoCaixa+=$pagamentos[$i]->getValorPago();
                     echo "<tr class='success' onclick=\"exibirOperacao('venda','".$pagamentos[$i]->getVendaId()."')\">";
                    echo "<td>"."Venda"."</td>";
                }else if($pagamentos[$i]->getOrdemServicoId()!=null){
                    $valorDoCaixa+=$pagamentos[$i]->getValorPago();
                     echo "<tr class='success' onclick=\"exibirOperacao('servico','".$pagamentos[$i]->getOrdemServicoId()."')\">";
                    echo "<td>"."Servico"."</td>";
                }
              
                
               
                echo "<td>".$pagamentos[$i]->getNumPagamento()."</td>";
               
                
                echo "<td> R$: ".money_format("%.2n",$pagamentos[$i]->getValorPago())."</td>";
                echo "</tr>";
            }
        ?>
    <tbody>
        
    </tbody>
</table>
</div>
<div class="col-lg-12">
    <div class="row">
        <?php
        echo "<h3 class='pull-left'><span class='label label-default '>numero do caixa:".$_SESSION["caixa"]."</span><br>";
        echo "<h3 class='pull-right'><span class='label label-default '>valor no caixa:  R$ : ".money_format("%.2n",$valorDoCaixa)."</span></h3>";
        ?>
    </div>
</div>
<div class="col-lg-12">
    <div class="row">
        <div class="btn btn-info pull-right" onclick="fecharCaixa('<?= money_format("%.2n",$valorDoCaixa) ?>')" style="margin-top:20px">Fechar caixa</div>
    </div>
</div>
<div class="col-lg-12">
    <div id="erro-log" style="margin-top:20px">
</div>

</div>