<?php
include_once"../models/Venda.php";
include_once"../models/ItemVenda.php";
include_once"../models/Cliente.php";
include_once"../models/Produto.php";
include_once"../models/OrdenServico.php";
include_once"../models/Servico.php";
include_once"../models/ItemServico.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/sistema_otica/controllers/venda/GerenciaVendaController.php";

session_start();
$vendaId = $_GET["exibir-venda-id"];
$informacoesVenda = GerenciaVendaController::carregarVenda($vendaId);

?>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
function pagar(){
    var pagamentoId = $("#pagamento-id").html()
    var multa = $("#multa").val();
    var desconto = $("#desconto").val();
    //alert(desconto);
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
            $("#erro-log").html("Pagamento Realizado"+retorno);
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
    //alert (multa);
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
<div class="row" >
    <div class="col-lg-12">
        <h2 class="page-header">Informações da venda</h2>
    </div> 
</div>
<div id="printable">
    <div class="col-lg-12" name="exibir-venda">
        <div class="row">
            <div class="panel panel-yellow">
                <div class="panel-heading not-printable"><h4>Venda</h4></div>
                <div class="panel-body">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <h3>Numero venda</h3>
                        <?php
                        session_start();
                        echo "<p><h5>".$informacoesVenda["venda"]->getId()."</h5></p>";
                        ?>
                        <h3>Data e hora</h3>
                        <?php
                        session_start();
                        echo "<p><h5>".$informacoesVenda["venda"]->getData()."</h5></p>";
                        ?>
                        
                        
                    </div>
                    
                    <div class="col-lg-4 col-md-4  col-sm-6 col-xs-6">
                        <h3>Valor da venda</h3>
                        <?php
                        echo "<p>R$: ".money_format("%.2n",$informacoesVenda["venda"]->getValorTotal())."</p>";
                        ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4  col-sm-6 col-xs-6">
                        <h3>Pagamento</h3>
                        <?php
                        if($informacoesVenda["venda"]->getStatus()){
                            echo "<p>Finalizado.</p>";
                        }else{
                            echo "<p>Inacabado.</p> ";
                           
                        }
                        ?>
                    </div>
                    <div class="col-lg-12 not-printable">
                         <h3>Pagamento</h3>
                        <?php
                            foreach ($informacoesVenda['pagamentos'] as $pagamento) {
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
                                    <h4>numero do pagamento</h4>
                                    <p id="num-pagamento">
                                        <?php
                                        echo $informacoesVenda['pagamentos'][0]->getNumPagamento();
                                        ?>
                                    </p>
                                    <h4>id do pagamento</h4>
                                    <p id="pagamento-id">
                                        <?php
                                         echo $informacoesVenda['pagamentos'][0]->getId();
                                        ?>
                                    </p>
                                    <h4>Desconto</h4>
                                    <p id="d">
                                        <?php
                                         echo "<input type='number' id='desconto' value='".$informacoesVenda['pagamentos'][0]->getDesconto()."' class='form-control' style='width:100px'/>";
                                        ?>
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <h4>Data de vencimento</h4>
                                    <p id="data-vencimento">
                                        <?php
                                         echo $informacoesVenda['pagamentos'][0]->getDataPrevista();
                                        ?>
                                    </p>
                                    <h4>Data de pagamento</h4>
                                    <p id="data-pagamento">
                                        <?php
                                         echo $informacoesVenda['pagamentos'][0]->getDataPagamento();
                                        ?>
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <h4>Valor</h4>
                                    <p id="valor">
                                        <?php
                                         echo "R$: ".money_format("%.2n",$informacoesVenda['pagamentos'][0]->getValor());
                                        ?>
                                    </p>
                                    <h4>Valor Pago</h4>
                                    <p id="valor-pago">
                                        <?php
                                         echo "R$: ".money_format("%.2n",$informacoesVenda['pagamentos'][0]->getValorPago());
                                        ?>
                                    </p>
                                    <h4>Multa</h4>
                                    <p id="multa">
                                        <?php
                                         echo "<input type='number' id='multa' value='".$informacoesVenda['pagamentos'][0]->getMulta()."' class='form-control' style='width:100px'/>";
                                        ?>
                                    </p>
                                    
                                    <div class="btn btn-info btn-lg" onclick="pagar()" id="btn-pagar">Pagar</div>
                                </div>
                                <div class="col-lg-12">
                                    <div id="erro-log"></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-12" id="produtos-comprados">
                        <h3>Produtos vendidos:</h3>
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
                            foreach ($informacoesVenda["itensVenda"] as $key => $itemVenda) {
                                $produto = $informacoesVenda["produto"][$key];
                                echo "<tr>";
                                echo "<td>".$produto->getId()."</td>";
                                echo "<td>".$itemVenda->getQuantidade()."</td>";
                                echo "<td>".$produto->getMarca()."</td>";
                                echo "<td>".$produto->getModelo()."</td>";
                                echo "<td>R$: ".money_format("%.2n",$itemVenda->getPrecoUnitario())."</td>";
                                echo "<td>R$: ".money_format("%.2n",$itemVenda->getSubTotal())."</td>";
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
    
    <div class="col-lg-12 " name="exibir-cliente">
        <div class="row">
            <div class="panel panel-green" >
                <div class="panel-heading not-printable"><h4>Cliente</h4></div>
                <div class="panel-body">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <h3>Nome</h3>
                            <?php
                                echo "<p>".$informacoesVenda["cliente"]->getNome()."</p>";
                            ?>
                        <h3>Email</h3>
                            <?php
                                echo "<p>".$informacoesVenda["cliente"]->getEmail()."</p>";
                            ?>
                       
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                        <h3>Cpf</h3>
                            <?php
                                echo "<p>".$informacoesVenda["cliente"]->getCpf()."</p>";
                            ?>
                        <h3>Telefone</h3>
                            <?php
                                echo "<p>".$informacoesVenda["cliente"]->getTelefone()."</p>";
                            ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <h3>Rg</h3>
                            <?php
                                echo "<p>".$informacoesVenda["cliente"]->getRg()."</p>";
                            ?>
                        <h3>Celular</h3>
                            <?php
                                echo "<p>".$informacoesVenda["cliente"]->getCelular()."</p>";
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="btn btn-info btn-lg" onclick="imprimir()">Imprimir</div>
<div class="alert">&nbsp</div>
<?php
//var_dump($_SESSION["exibir-venda"]);
//if($_SESSION["exibir-venda"]["servico-incluso"]){
  //  var_dump($_SESSION["exibir-orden-servico"]);
    //echo "";
  
//}
  //echo "<h2>RETORNO NO CONTROLLER</h2>";
    //var_dump($informacoesVenda);
?>