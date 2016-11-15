<?php
include_once("../controllers/PagamentoController.php");
$entradaVencidos = PagamentoController::carregarPagamentosEntradaVencidos();
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
        Vendas vencidas
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
            
                for($i =0;$i < count($entradaVencidos);$i++){
                    
                   
                    
                    if($entradaVencidos[$i]->getCompraId()!=null){
                        echo "<tr class='' onclick=\"exibirOperacao('compra','".$entradaVencidos[$i]->getCompraId()."')\">";
                        echo "<td>".$entradaVencidos[$i]->getDataPrevista()."</td>";
                    }else if($entradaVencidos[$i]->getVendaId()!=null){
                        
                         echo "<tr class='' onclick=\"exibirOperacao('venda','".$entradaVencidos[$i]->getVendaId()."')\">";
                        echo "<td>".$entradaVencidos[$i]->getDataPrevista()."</td>";
                    }else if($entradaVencidos[$i]->getOrdemServicoId()!=null){
                        
                         echo "<tr class='' onclick=\"exibirOperacao('servico','".$entradaVencidos[$i]->getOrdemServicoId()."')\">";
                        echo "<td>".$entradaVencidos[$i]->getDataPrevista()."</td>";
                    }
                  
                    
                   
                    echo "<td>".$entradaVencidos[$i]->getNumPagamento()."</td>";
                   
                    
                    echo "<td> R$: ".money_format("%.2n",$entradaVencidos[$i]->getValor())."</td>";
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