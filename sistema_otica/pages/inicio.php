<?php
include_once("../controllers/GerenciaCaixaController.php");
?>
<script type="text/javascript">
    $(document).ready(function(){
      atualizarBotaoCaixa();

      $("#ir-para-venda").onclick=function(){myScript};
    })
    function irParaOrdenDeServico(){
        //alert("indo para orden de servico");
        if($("#io-caixa").html() =="Ver Caixa"){
            window.location.href="sessao.php?page=orden_servico/index.php";
        }else{
            alert ("caixa esta fechado");
        }
    }
    function irParaVenda(){
        //alert("indo para orden de servico");
        if($("#io-caixa").html() =="Ver Caixa"){
            window.location.href="sessao.php?page=venda/venda.php";
        }else{
            alert ("caixa esta fechado");
        }
    }
    
    function irParaCompras(){
        //alert("indo para compra");
        if($("#io-caixa").html() =="Ver Caixa"){
            window.location.href="sessao.php?page=compra/compra.php";
        }else{
            alert ("caixa esta fechado");
        }
        
    }
    function atualizarBotaoCaixa(){
        $.post('../controllers/GerenciaCaixaController.php',{"caixa-status" :true},function(retorno){
            if(retorno>=0){
                $("#io-caixa").html("Ver Caixa");
                $("#caixa").val("abrir-caixa");
            }else{
                $("#io-caixa").html("Abrir Caixa");
                $("#caixa").val("fechar-caixa");
            }
        });
    }
    function abrirFecharCaixa(){
        //alert("abrindo caixa");
        var dados;
        if($("#io-caixa").html() =="Ver Caixa"){
            dados = {"fechar-caixa":true}
        }else{
            dados = {"abrir-caixa":false}
        }
        if($("#io-caixa").html() =="Ver Caixa"){
            window.location.href="sessao.php?page=caixa/index.php";
        }else{
        $.post('../controllers/GerenciaCaixaController.php',dados,function(retorno){
             $("#erro-log").addClass("alert alert-info");
            $("#erro-log").html(retorno);
        });
        window.location.href="sessao.php?page=caixa/index.php";
        }
        atualizarBotaoCaixa();
    }
</script>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Área de gerência</h2>
    </div>
                <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-inbox   fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <h3>Caixa</h3>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer" id="caixa" onclick="abrirFecharCaixa()">
                    <span class="pull-left" id="io-caixa"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div id="erro-log"></div>
    </div>
    
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart   fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <h3>Compras</h3>
                    </div>
                </div>
            </div>
            <a  href="#" id="ir-para-compra" onclick="irParaCompras()">
                <div class="panel-footer">
                    <span class="pull-left">Nova compra</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
                    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        
                        <h3>Vendas</h3>
                    </div>
                </div>
            </div>
            <a  href="#" onclick="irParaVenda()" id="ir-para-venda">
                <div class="panel-footer">
                    <span class="pull-left">Nova venda</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <h3>Serviço</h3>
                    </div>
                </div>
            </div>
            <a  href="#" onclick="irParaOrdenDeServico()" id="ir-para-orden-servico">
                <div class="panel-footer">
                    <span class="pull-left">Nova Orden</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
</div>
