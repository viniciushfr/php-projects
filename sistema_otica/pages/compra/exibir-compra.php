<?php
include_once"../models/Compra.php";
include_once"../models/ItemCompra.php";
include_once"../models/Fornecedor.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/controllers/compra/GerenciaCompraController.php";
$compraId = $_GET["exibir-compra-id"];
$informacoesCompra = GerenciaCompraController::carregarCompra($compraId);

session_start();
$exibirCompra = $_SESSION["exibir-compra"];
//var_dump($exibirCompra);


?>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
function pagar(){
    var pagamentoId = $("#pagamento-id").html()
    var multa = $("#multa").val();
    var dados = {
                    pagar : true,
                    pagamentoId : pagamentoId,
                    multa:multa
                   
               }
    $.post("../controllers/PagamentoController.php",dados,function(retorno){
        //alert(retorno);
        if(retorno.indexOf("success")>=0){
            
            $("#erro-log").addClass("alert alert-success");
            $("#erro-log").html("Pagamento Realizado");
            location.reload();
        }else{
            $("#erro-log").addClass("alert alert-info");
            $("#erro-log").html(retorno);
        }
    })
}
function imprimir(){
    var panel = document.getElementById("printable");
            var printWindow = window.open("about:blank");
            printWindow.document.write('<html><head><title>Imprimir Compra</title>');
            printWindow.document.write("<link href='../css/bootstrap/bootstrap.min.css' rel='stylesheet' type='text/css'/>");
            printWindow.document.write("<link href='../css/print.css' rel='stylesheet' type='text/css'/>");
            

            printWindow.document.write('</head><body >');
            printWindow.document.write(panel.innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            setTimeout(function () {
                printWindow.print();
            }, 500);
}

function exibirInformacoesPagamento(pagamentoId,numPagamento,dataVencimento,dataPagamento,valor,valorPago,multa){
    //alert (multa);
    $("#multa").val(multa);
    $("#pagamento-id").html(pagamentoId);
    $("#num-pagamento").html(numPagamento);
    $("#data-pagamento").html(dataPagamento);
    $("#data-vencimento").html(dataVencimento);
    $("#valor").html("R$: "+valor);
    $("#valor-pago").html("R$: "+valorPago);
}
</script>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Informações da compra</h2>
    </div> 
</div>
<div id="printable">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-yellow">
                <div class="panel-heading not-printable"><h3>Compra</h3></div>
                <div class="panel-body">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <h3>Numero da compra</h3>
                        <?php
                        session_start();
                        echo "<p><h5>".$informacoesCompra["compra"]->getId()."</h5></p>";
                        ?>
                        <h3>Data e hora</h3>
                        <?php
                        session_start();
                        echo "<p><h5>".$informacoesCompra["compra"]->getData()."</h5></p>";
                        ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <h3>Valor da compra</h3>
                        <?php
                        echo "<p>R$: ".money_format("%.2n",$informacoesCompra["compra"]->getValorTotal())."</p>";
                        ?>
                        
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <h3>Status</h3>
                        <?php
                        if($informacoesCompra["compra"]->getStatus()==1){
                            echo "<p>Finalizado</p>";
                        }else{
                            echo "<p>Pendente</p>";
                        }
                        ?>
                    </div>
                    <div class="col-lg-12 col-xl-12 not-printable">
                         <h3>Pagamento</h3>
                        <?php
                            foreach ($informacoesCompra['pagamentos'] as $pagamento) {
                                if($pagamento->getDataPagamento()!=null)
                                echo "<button class='btn btn-success' 
                                                data-placement='top'
                                                title='Pagamento'
                                                data-toggle='popover'
                                                onclick=\"exibirInformacoesPagamento('".$pagamento->getId()."'
                                                                                    ,'".$pagamento->getNumPagamento()."'
                                                                                    ,'".$pagamento->getDataPrevista()."'
                                                                                    ,'".$pagamento->getDataPagamento()."'
                                                                                    ,'".money_format("%.2n",$pagamento->getValor())."'
                                                                                     ,'".money_format("%.2n",$pagamento->getValorPago())."'
                                                                                    ,'".$pagamento->getMulta()."')\"
                                                data-trigger='hover'
                                                data-content='Finalizado, Pago dia:".$pagamento->getDataPagamento().", valor:".money_format("%.2n",$pagamento->getValor())."
                                                '>".$pagamento->getNumPagamento().
                                                "</button>&nbsp;";
                                else
                                echo "<button class='btn btn-default'
                                                data-placement='top'
                                                title='Pagamento'
                                                data-toggle='popover'
                                                onclick=\"exibirInformacoesPagamento('".$pagamento->getId()."'
                                                                                    ,'".$pagamento->getNumPagamento()."'
                                                                                    ,'".$pagamento->getDataPrevista()."'
                                                                                    ,'".$pagamento->getDataPagamento()."'
                                                                                    ,'".money_format("%.2n",$pagamento->getValor())."'
                                                                                    ,'".money_format("%.2n",$pagamento->getValorPago())."'
                                                                                    ,'".$pagamento->getMulta()."')\"
                                                data-trigger='hover'
                                                data-content='Aguardando, vencimento:".$pagamento->getDataPrevista().", valor:".money_format("%.2n",$pagamento->getValor())."
                                                '>".$pagamento->getNumPagamento()."</button>&nbsp;";
                            }
                        ?>
                        <div class="panel panel-default not-printable" id="pagamento" style="margin-top:20px" >
                            <div class="panel-body">
                                <div class="col-lg-4">
                                    <h4>Numero do pagamento</h4>
                                    <p id="num-pagamento">
                                        <?php
                                        echo $informacoesCompra['pagamentos'][0]->getNumPagamento();
                                        ?>
                                    </p>
                                    <h4>Id do pagamento</h4>
                                    <p id="pagamento-id">
                                        <?php
                                         echo $informacoesCompra['pagamentos'][0]->getId();
                                        ?>
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <h4>Data de vencimento</h4>
                                    <p id="data-vencimento">
                                        <?php
                                         echo $informacoesCompra['pagamentos'][0]->getDataPrevista();
                                        ?>
                                    </p>
                                    <h4>Data de pagamento</h4>
                                    <p id="data-pagamento">
                                        <?php
                                         echo $informacoesCompra['pagamentos'][0]->getDataPagamento();
                                        ?>
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <h4>Valor</h4>
                                    <p id="valor">
                                        <?php
                                         echo "R$: ".money_format("%.2n",$informacoesCompra['pagamentos'][0]->getValor());
                                        ?>
                                    </p>
                                    <h4>Valor Pago</h4>
                                    <p id="valor-pago">
                                        <?php
                                         echo "R$: ".money_format("%.2n",$informacoesCompra['pagamentos'][0]->getValorPago());
                                        ?>
                                    </p>
                                    <h4>Multa</h4>
                                    <p id="m">
                                        <?php
                                         echo "<input id='multa' value='".$informacoesCompra['pagamentos'][0]->getMulta()."' class='form-control' style='width:100px'/>";
                                        ?>
                                    </p>
                                    <div class="btn btn-info btn-lg"  onclick="pagar()" id="btn-pagar">Pagar</div>
                                </div>
                                <div class="col-lg-12">
                                    <div id="erro-log" style="margin-top:20px"></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
               
                    <div class="col-lg-12" id="produtos-comprados">
                        <h3>Produtos comprados:</h3>
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Quantidade</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>PrecoUn</th>
                                <th>Subtotal</th>
                                <th>Codigo Barra</th>
                                <th>Grupo Estoque</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                                <?php 
                            foreach ($informacoesCompra["itensCompra"] as $key => $itemCompra) {
                                $produto = $informacoesCompra["produto"][$key];
                                echo "<tr>";
                                echo "<td>".$produto->getId()."</td>";
                                echo "<td>".$itemCompra->getQuantidade()."</td>";
                                echo "<td>".$produto->getMarca()."</td>";
                                echo "<td>".$produto->getModelo()."</td>";
                                echo "<td>R$: ".money_format("%.2n",$itemCompra->getPrecoUnitario())."</td>";
                                echo "<td>R$: ".money_format("%.2n",$itemCompra->getSubTotal())."</td>";
                                echo "<td>".$produto->getCodigoBarra()."</td>";
                                echo "<td>".$produto->getGrupoEstoque()."</td>";
                                echo "</tr>";
                            }
                           
                            ?>
                            </tbody>
                        </table>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-green" >
                <div class="panel-heading not-printable"><h3>Fornecedor</h3></div>
                <div class="panel-body">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <h3>Identificação</h3>
                            <?php
                                echo "<p>".$informacoesCompra["fornecedor"]->getIdentificacao()."</p>";
                            ?>
                        <h3>Email</h3>
                            <?php
                                echo "<p>".$informacoesCompra["fornecedor"]->getEmail()."</p>";
                            ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <h3>Cnpj</h3>
                            <?php
                                echo "<p>".$informacoesCompra["fornecedor"]->getCnpj()."</p>";
                            ?>
                        <h3>Telefone</h3>
                            <?php
                                echo "<p>".$informacoesCompra["fornecedor"]->getTelefone()."</p>";
                            ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <h3>Inscrição estadual</h3>
                            <?php
                                echo "<p>".$informacoesCompra["fornecedor"]->getInscEstadual()."</p>";
                            ?>
                        <h3>Celular</h3>
                            <?php
                                echo "<p>".$informacoesCompra["fornecedor"]->getCelular()."</p>";
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="btn btn-info btn-lg" onclick="imprimir()">Imprimir</div>
<!--
<div class="col-lg-12">
    <div type="button" class="btn btn-warning btn-lg" aria-label="Left Align">
         <span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Alterar
    </div>
    <div type="button" class="btn btn-info btn-lg pull-right" aria-label="Left Align">
        <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir
    </div>
</div>
-->
<div class="alert">&nbsp</div>
<?php
//echo "<h2>RETORNO DO CONTROLLER</h2>";
//var_dump($informacoesCompra);
?>