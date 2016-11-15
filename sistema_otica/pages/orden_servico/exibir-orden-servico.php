<?php
include_once"../models/Venda.php";
include_once"../models/ItemVenda.php";
include_once"../models/Cliente.php";
include_once"../models/Produto.php";
include_once"../models/OrdenServico.php";
include_once"../models/Servico.php";
include_once"../models/ItemServico.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/controllers/orden_servico/GerenciaOrdenServicoController.php";

$servicoId = $_GET["exibir-servico-id"];
$informacoesServico = GerenciaOrdenServicoController::carregarOrdenServico($servicoId);

?>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
function pagar(){
    var pagamentoId = $("#pagamento-id").html()
    var multa = $("#multa").val();
    var desconto = $("#desconto").val();
    // alert(desconto);
    var dados = {
                    pagar : true,
                    pagamentoId : pagamentoId,
                    multa:multa,
                    desconto:desconto
                   
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
            printWindow.document.write('<html><head><title>Imprimir Venda</title>');
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

function exibirInformacoesPagamento(pagamentoId,numPagamento,dataVencimento,dataPagamento,valor,valorPago,desconto,multa){
//alert ("dlcnvsikdnj");
    $("#multa").val(multa);
    $("#desconto").val(desconto);
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
        <h2 class="page-header">Informações do Serviço</h2>
    </div> 
</div>
<div id="printable">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-yellow">
                <div class="panel-heading not-printable"><h4>Serviços</h4></div>
                <div class="panel-body">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <h3>Data e hora</h3>
                        <?php
                        session_start();
                        echo "<p><h5>".$informacoesServico["orden-servico"]->getDataServico()."</h5></p>";
                        ?>
                        <h3>Numero da Ordem Serviço</h3>
                        <?php
                        session_start();
                        echo "<p><h5>".$informacoesServico["orden-servico"]->getId()."</h5></p>";
                        ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <h3>Valor do serviço</h3>
                        <?php
                        echo "<p>R$: ".money_format("%.2n",$informacoesServico["orden-servico"]->getPrecoTotal())."</p>";
                        ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <h3>Pagamento</h3>
                        <?php
                        if($informacoesServico["orden-servico"]->getStatus()){
                            echo "<p>Finalizado.</p>";
                        }else{
                            echo "<p>Inacabado.</p> ";
                        
                        }
                        ?>
                    </div>
                   
                   <div class="col-lg-12 not-printable">
                         <h3>Pagamento</h3>
                        <?php
                            foreach ($informacoesServico['pagamentos'] as $pagamento) {
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
                                                                                    ,'".$pagamento->getDesconto()."'
                                                                                    ,'".$pagamento->getMulta()."')\" 
                                                data-trigger='hover'
                                                data-content='Finalizado, Pago dia:".$pagamento->getDataPagamento().", valor:".$pagamento->getValor()."
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
                                                                                    ,'".$pagamento->getDesconto()."'
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
                                        echo $informacoesServico['pagamentos'][0]->getNumPagamento();
                                        ?>
                                    </p>
                                    <h4>Id do pagamento</h4>
                                    <p id="pagamento-id">
                                        <?php
                                         echo $informacoesServico['pagamentos'][0]->getId();
                                        ?>
                                    </p>
                                    <h4>Desconto</h4>
                                    <p id="d">
                                        <?php
                                         echo "<input type='number' id='desconto' value='".$informacoesServico['pagamentos'][0]->getDesconto()."' class='form-control' style='width:100px'/>";
                                        ?>
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <h4>Data de vencimento</h4>
                                    <p id="data-vencimento">
                                        <?php
                                         echo $informacoesServico['pagamentos'][0]->getDataPrevista();
                                        ?>
                                    </p>
                                    <h4>Data de pagamento</h4>
                                    <p id="data-pagamento">
                                        <?php
                                         echo $informacoesServico['pagamentos'][0]->getDataPagamento();
                                        ?>
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <h4>Valor</h4>
                                    <p id="valor">
                                        <?php
                                         echo "R$: ". money_format("%.2n",$informacoesServico['pagamentos'][0]->getValor());
                                        ?>
                                    </p>
                                    <h4>Valor Pago</h4>
                                    <p id="valor-pago">
                                        <?php
                                         echo "R$: ".money_format("%.2n",$informacoesServico['pagamentos'][0]->getValorPago());
                                        ?>
                                    </p>
                                    <h4>Multa</h4>
                                    <p id="m">
                                        <?php
                                         echo "<input id='multa' value='".$informacoesServico['pagamentos'][0]->getMulta()."' class='form-control' style='width:100px'/>";
                                        ?>
                                    </p>
                                    <div class="btn btn-info btn-lg" onclick="pagar()" id="btn-pagar">Pagar</div>
                                </div>
                                <div class="col-lg-12">
                                    <div id="erro-log" style="margin-top:20px"></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
               
                   
                   
                   
                    <div class="col-lg-12" id="produtos-comprados">
                        <h3>Serviços realizados:</h3>
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Quantidade</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>PrecoUn</th>
                                <th>Subtotal</th>
                               
                              </tr>
                            </thead>
                            <tbody>
                              
                                <?php 
                            foreach ($informacoesServico["itensServico"] as $key => $itemServico) {
                                $servico = $informacoesServico["servicos"][$key];
                                echo "<tr>";
                                echo "<td>".$servico->getId()."</td>";
                                echo "<td>".$itemServico->getQuantidade()."</td>";
                                echo "<td>".$servico->getNome()."</td>";
                                echo "<td>".$servico->getDescricao()."</td>";
                                echo "<td>R$: ".money_format("%.2n",$itemServico->getValorUnitario())."</td>";
                                echo "<td>R$: ".money_format("%.2n",$itemServico->getSubTotal())."</td>";
                
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
                <div class="panel-heading not-printable"><h4>Cliente</h4></div>
                <div class="panel-body">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <h3>Nome</h3>
                            <?php
                                echo "<p>".$informacoesServico["cliente"]->getNome()."</p>";
                            ?>
                        <h3>Email</h3>
                            <?php
                                echo "<p>".$informacoesServico["cliente"]->getEmail()."</p>";
                            ?>
                       
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <h3>Cpf</h3>
                            <?php
                                echo "<p>".$informacoesServico["cliente"]->getCpf()."</p>";
                            ?>
                        <h3>Telefone</h3>
                            <?php
                                echo "<p>".$informacoesServico["cliente"]->getTelefone()."</p>";
                            ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <h3>Rg</h3>
                            <?php
                                echo "<p>".$informacoesServico["cliente"]->getRg()."</p>";
                            ?>
                        <h3>Celular</h3>
                            <?php
                                echo "<p>".$informacoesServico["cliente"]->getCelular()."</p>";
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
<div class ="alert">&nbsp</div>
<?php
//echo "<h2>RETORNO DO CONTROLLER</h2>";
//var_dump($informacoesServico);
?>