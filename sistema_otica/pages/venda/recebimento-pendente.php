<?php
include_once"../controllers/compra/GerenciaCompraController.php";
include_once"../controllers/venda/GerenciaVendaController.php";
include_once"../controllers/orden_servico/GerenciaOrdenServicoController.php";


$vendasPendente = GerenciaVendaController::carregarVendasRecebimentoPendente(null);
$servicosPendente = GerenciaOrdenServicoController::carregarServicosRecebimentoPendente(null);
//var_dump($servicosPendente );

?>
<script type="text/javascript">
    function exibirVenda(id){
        window.location.href="sessao.php?page=venda/exibir-venda.php&exibir-venda-id="+id;
    }
     function exibirServico(id){
        window.location.href="sessao.php?page=orden_servico/exibir-orden-servico.php&exibir-servico-id="+id;
    }
</script>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Vendas à serem recebidas</h2>
    </div> 
</div>
<div class="panel panel-primary">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Valor Total</th>
                <th>Valor Pago</th>
            </tr>
        </thead>
            <?php
            foreach($vendasPendente as $venda){
                echo "<tr onclick=\"exibirVenda('".$venda->getId()."')\">";
                echo    "<td>".$venda->getData()."</td>";
                echo    "<td>R$: ".$venda->getValorTotal()."</td>";
                echo    "<td>R$: ".$venda->getValorRecebido()."</td>";
                echo "</tr>";
            }
            ?>
        <tbody>
            
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Servicos à serem recebidas</h2>
    </div> 
</div>
<div class="panel panel-primary">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Valor Total</th>
                <th>Valor Pago</th>
            </tr>
        </thead>
            <?php
            foreach($servicosPendente as $servico){
                echo "<tr onclick=\"exibirServico('".$servico->getId()."')\">";
                echo    "<td>".$servico->getDataServico()."</td>";
                echo    "<td>R$: ".$servico->getPrecoTotal()."</td>";
                echo    "<td>R$: ".$servico->getValorRecebido()."</td>";
                echo "</tr>";
            }
            ?>
        <tbody>
            
        </tbody>
    </table>
</div>