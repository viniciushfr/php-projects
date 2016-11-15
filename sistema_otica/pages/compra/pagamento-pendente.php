<?php
include_once"../controllers/compra/GerenciaCompraController.php";

$pagamentoPendente = GerenciaCompraController::carregarComprasPagamentoPendente(null);

//var_dump($pagamentoPendente);




?>
<script type="text/javascript">
    function exibirCompra(id){
        window.location.href="sessao.php?page=compra/exibir-compra.php&exibir-compra-id="+id;
    }
</script>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Compras à serem pagas</h2>
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
            foreach($pagamentoPendente as $compra){
                echo "<tr onclick=\"exibirCompra('".$compra->getId()."')\">";
                echo    "<td>".$compra->getData()."</td>";
                echo    "<td>R$: ".$compra->getValorTotal()."</td>";
                echo    "<td>R$: ".$compra->getValorPago()."</td>";
                echo "</tr>";
            }
            ?>
        <tbody>
            
        </tbody>
    </table>
</div>