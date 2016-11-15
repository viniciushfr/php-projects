<?php
//include_once"../controllers/compra/GerenciaCompraController.php";
//GerenciaCompraController::iniciarCompra();
//unset($_SESSION["valorT"]["compra"]);
?>
<script type="text/javascript">
    $(document).ready(function() {
        $.datetimepicker.setLocale('pt');
        jQuery('#data').datetimepicker();
        jQuery('#dataVencimento').datetimepicker();
        attValorTotal();
        carregarListaCompra();
        $.post('../controllers/compra/buscaAjaxFornecedorController.php',function(retorno){
                   $("#select-fornecedor").html(retorno);
        });
        $.post('../controllers/compra/buscaAjaxProdutoController.php',function(retorno){
                   $("#select-produto").html(retorno);
        });
        $("#select-fornecedor").select2({
            theme:"bootstrap",
            placeholder: "Selecione o fornecedor",
            allowClear: true
        });
        $("#select-produto").select2({
            theme:"bootstrap",
            placeholder: "Adicione um produto",
            allowClear: true
        });
        $("#compra-form").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../controllers/compra/GerenciaCompraController.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        //$("#error-log").html(response);
                        //alert(response);
                        if(response.indexOf("success") >= 0){
                            //alert("cadastrado");
                            
                            //$(location).attr('href', "sessao.php?page=compra/exibir-compra.php&exibir-compra-id="+response.str(8));
                            //location.reload();
                            var indexSuccess = response.indexOf("success");
                            window.location.assign("sessao.php?page=compra/exibir-compra.php&exibir-compra-id="+response.toString().substr(indexSuccess+7));
                            $("#error-log").html("<div class='alert alert-success'>Compra Registrada</div>");
                        }else if(response.indexOf("erro") >= 0){
                            $("#error-log").html("<div class='alert alert-danger'>"+response+"</div>");
                        }else{
                             $("#error-log").html("<div class='alert alert-info'>"+response+"</div>");
                        }
                    }
                });
                return false;
            });
    });
    function attValorTotal(){
         $.post('../controllers/compra/GerenciaCompraController.php',{"getValorTotal":true},function(data){
                 $("#valorTotal").val(data.compra);
               },'json');
    }
    function carregarListaCompra(){
        $.post('../controllers/compra/GerenciaCompraController.php',{"attListaCompra":true},function(retorno){
                 $("#l-itens").html(retorno);
               });
    }
    function addItemCompra(){
        var produto = $("#select-produto").val();
        var quantidade = $("#quantidade").val();
        
        var dados = {
                    addItemCompra : true,
                    produtoId : produto,
                    quantidade : quantidade
               }
        $.post('../controllers/compra/GerenciaCompraController.php',dados,function(data){
            //alert(data);
            //alert(data ==1);
            if(data ==true){
               // alert("atualizarLista");
                carregarListaCompra();
            }else{
                $("#l-itens").append(data);
            }
        });
        attValorTotal();
    }
    function rmvItemCompra(p_id){
        var id =p_id;
        //alert(id);
        $.post('../controllers/compra/GerenciaCompraController.php',{"rvmItemCompra":true,"p_id":id},function(data){
        });
        attValorTotal();
    }
    function abrirPanel(id){
        var display = document.getElementById(id).style.display;
        if (display == "none"){
            document.getElementById(id).style.display = '';
   
        }else{
            document.getElementById(id).style.display = 'none';

        }
    }
</script>

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Cadastrar Nova Compra</h2>
    </div> 
</div>

<di class="row">
    <div class="col-lg-6 col-md-6 ">
        <form method="post" id="compra-form">
            <div class="row">
                <div class="col-lg-12">  
                    <div class="form-group">
                        <label for="select-fornecedor">Selecione o fornecedor</label>
                        <select id="select-fornecedor" name="select-fornecedor" class="form-control" ></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">  
                    <div class="form-group">
                        <label for="select-produto">Adicionar produto na compra</label>
                        <select  id="select-produto" name="select-produto" class="form-control" ></select>
                    </div>
                </div>
                <div class="col-lg-2">  
                    <div class="form-group">
                        <label for="quantidade">qtd</label>
                        <input id="quantidade" type="number" value="1" min="1" name="" class="form-control "/>
                    </div>
                </div>
                <div class="col-lg-2">  
                    <div class="form-group">
                         <label for="addItemCompra">&nbsp;</label>
                    <div  id="addItemCompra"onclick="return addItemCompra()" style="margin-top:24px" class="btn btn-info pull-right">Add</div>
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                <strong>Pagamento:</strong>
                </div>
                <div class="col-lg-2">
                   <span class="pull-right">Parcela</span>
                </div>
                 <div class="col-lg-2">
                    <div class="material-switch" style="margin:0 0 30px 20px ">
                       <input type="checkbox" id="a-vista" name="a-vista" value="true" onclick="abrirPanel('pagamento-panel')">
                        <label for="a-vista" class="label-info"></label>
                    </div>
                </div>
                <div class="col-lg-2">
                    A vista
                </div>
                <div class ="col-lg-12">
                   <!-- <input type="checkbox" name="a-vista" id="a-vista"/> A vista-->
                    
                    <div class="panel panel-default" id="pagamento-panel">
                        <div class="panel-body">
                        <div class="form-group" style="margin-top:10px">
                            <label for="numParcelas" style="margin-top:5px">   &nbsp;Numero de parcelas </label>
                            <div class="col-lg-6">
                            <input type="number" name="numParcelas" id="numParcelas" min="1" max="24" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dataVencimento" style="margin-top:5px">   &nbsp;Data de vencimento</label>
                            <div class="col-lg-6">
                            <input type="text" name="dataVencimento" id="dataVencimento" class="form-control"/>
                            </div>
                        </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class ="col-lg-12">
                    <div class ="row">
                        <div class ="col-lg-6">
                            <div class="form-group">
                            <label for="data">Data</label>
                            <input id="data" type="text"  name="data" class="form-control"/>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3"> 
                            <div class="form-group">
                                <label for="valorTotal" style="margin-top:10px">Preço Total:</label>
                            </div>
                        </div>
                        <div class="col-lg-9"> 
                            <div class="form-group input-group">
                                <span class="input-group-addon">R$</span>
                                <input id="valorTotal"  class="form-control input-lg pull-right" disabled/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="row">
                <div class="col-lg-4"> 
                    <input type="submit" value="Concluir" id="btn-salvar-compra" name="btn-salvar-compra" class="form-control  btn btn-primary"/>
                </div>
                <div class="col-lg-8"></div>
            </div>
        </form>
            <div class="error-log" id="error-log" style="margin-top:15px"></div>

    </div>
    <div class="col-lg-6 col-md-6 ">
        <label for="i-compra">Itens da compra</label>
        <div id="i-compra"class="well">
            <div  id="l-itens"></div>
        </div>
    </div>
</di>
