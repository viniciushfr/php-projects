<script type="text/javascript">
    $(document).ready(function() {
        attValorTotal();
        carregarListaVenda();
        $.datetimepicker.setLocale('pt');
        jQuery('#data').datetimepicker();
        jQuery('#dataVencimento').datetimepicker();
        $.post('../controllers/venda/buscaAjaxClienteController.php',function(retorno){
                   $("#select-cliente").html(retorno);
        });
        $.post('../controllers/venda/buscaAjaxProdutoController.php',function(retorno){
                   $("#select-produto").html(retorno);
        });
        $("#select-cliente").select2({
            theme:"bootstrap",
            placeholder: "Selecione o cliente",
            allowClear: true
        });
        $("#select-produto").select2({
            theme:"bootstrap",
            placeholder: "Adicione um produto",
            allowClear: true
        });
        $("#venda-form").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../controllers/venda/GerenciaVendaController.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        //$("#error-log").html("<div class='alert alert-info'>"+response+"</div>");
                        if(response.indexOf("success") >= 0){
                            //lert(response);
                            //alert(response.toString().substr(28));
                            var indexSuccess = response.indexOf("success");
                            window.location.assign("sessao.php?page=venda/exibir-venda.php&exibir-venda-id="+response.toString().substr(indexSuccess+7));
                            $("#error-log").html("<div class='alert alert-success'>Venda Registrada</div>");
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
         $.post('../controllers/venda/GerenciaVendaController.php',{"getValorTotal":true},function(data){
                 $("#valor-total").val(data.venda);
               },'json');
    }
    function carregarListaVenda(){
        $.post('../controllers/venda/GerenciaVendaController.php',{"attListaVenda":true},function(retorno){
                 $("#l-itens").html(retorno);
               });
    }
    function addItemVenda(){
        var produto = $("#select-produto").val();
        var quantidade = $("#quantidade").val();
        
        var dados = {
                    addItemVenda : true,
                    produtoId : produto,
                    quantidade : quantidade
               }
        $.post('../controllers/venda/GerenciaVendaController.php',dados,function(data){
            //alert(data);
            //alert(data ==1);
            if(data ==true){
               // alert("atualizarLista");
                carregarListaVenda();
            }else if(data.indexOf("erro") >= 0){
                 $("#error-log").html("<div class='alert alert-info'>"+data+"</div>");
            }else{
                $("#l-itens").append(data);
            }
        });
        attValorTotal();
    }
    function rmvItemVenda(p_id){
        var id =p_id;
        //alert(id);
        $.post('../controllers/venda/GerenciaVendaController.php',{"rvmItemVenda":true,"p_id":id},function(data){
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
        <h2 class="page-header">Cadastrar Nova Venda</h2>
    </div> 
</div>

<di class="row">
    <div class="col-lg-6">
        <form method="post" id="venda-form">
            <div class="row">
                <div class="col-lg-12">  
                    <div class="form-group">
                        <label for="select-cliente">Selecione o cliente</label>
                        <select id="select-cliente" name="select-cliente" class="" style="width: 100%"></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">  
                    <div class="form-group">
                        <label for="select-produto">Adicionar produto na venda</label>
                        <select class="" id="select-produto" name="select-produto" class="" style="width: 100%"></select>
                    </div>
                </div>
                <div class="col-lg-2">  
                    <div class="form-group">
                        <label for="quantidade">qtd</label>
                        <input id="quantidade" type="number" value="1" min="1" name="" class="form-control"/>
                    </div>
                </div>
                <div class="col-lg-2">  
                    <div class="form-group">
                         <label for="add-item-venda">&nbsp;</label>
                    <div  id="add-item-venda"onclick="return addItemVenda()" class="btn btn-info">Add</div>
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                <strong>Pagamento:</strong>
                </div>
                <div class="col-lg-2">
                   Parcela
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
                    <div class="panel panel-default" id="pagamento-panel">
                        <div class="panel-body">
                        <div class="form-group" >
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
                                <label for="valor-total">Preço Total:</label>
                            </div>
                        </div>
                        <div class="col-lg-9"> 
                            <div class="form-group input-group">
                                <span class="input-group-addon">R$</span>
                                <input id="valor-total"  class="form-control input-lg pull-right" disabled/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="row">
                <div class="col-lg-4"> 
                    <input type="submit"  value="Concluir" id="btn-salvar-venda" name="btn-salvar-venda" class="form-control  btn btn-primary"/>
                </div>
                <div class="col-lg-8"></div>
            </div>
        </form>
        
        
            <div class="error-log" id="error-log" style="margin-top:15px"></div>
    </div>
    <div class="col-lg-6">
        <label for="i-venda">Itens da venda</label>
        <div id="i-venda"class="well">
            <div  id="l-itens"></div>
        </div>
    </div>
</di>
