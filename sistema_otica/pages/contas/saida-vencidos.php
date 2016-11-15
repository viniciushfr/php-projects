<?php
include_once("../controllers/PagamentoController.php");
$saidaVencidos = PagamentoController::carregarPagamentosSaidaVencidos();


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

<div class="panel panel-primary" style="margin-top:30px">
    <div class="panel-heading">
        Compras vencidas
    </div>
    <div class="panel-body">
        <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <td>Data de vencimento</td>
                <td>Pagamento</td>
                <td>Valor</td>
            </tr>
        </thead>
            <?php
            
                for($i =0;$i < count($saidaVencidos);$i++){
                    
                   
                    
                    if($saidaVencidos[$i]->getCompraId()!=null){
                        
                        echo "<tr class='' onclick=\"exibirOperacao('compra','".$saidaVencidos[$i]->getCompraId()."')\">";
                        echo "<td>".$saidaVencidos[$i]->getDataPrevista()."</td>";
                    }else if($saidaVencidos[$i]->getVendaId()!=null){
                        
                         echo "<tr class='' onclick=\"exibirOperacao('venda','".$saidaVencidos[$i]->getVendaId()."')\">";
                        echo "<td>".$saidaVencidos[$i]->getDataPrevista()."</td>";
                    }else if($saidaVencidos[$i]->getOrdemServicoId()!=null){
                        
                         echo "<tr class='' onclick=\"exibirOperacao('servico','".$saidaVencidos[$i]->getOrdemServicoId()."')\">";
                        echo "<td>".$saidaVencidos[$i]->getDataPrevista()."</td>";
                    }
                  
                    
                   
                    echo "<td>".$saidaVencidos[$i]->getNumPagamento()."</td>";
                   
                    
                    echo "<td> R$: ".money_format("%.2n",$saidaVencidos[$i]->getValor())."</td>";
                    echo "</tr>";
                }
            ?>
        <tbody>
            
        </tbody>
    </table>
    </div>
</div>











<?php
//var_dump($entradaVencidos);
?>