<script type="text/javascript">
    $(document).ready(function() {
        attValorTotalOrden();
        attValorTotalVenda();
        attValorTotalServicos();
        carregarListaVenda();
        carregarListaServicos();
        $.datetimepicker.setLocale('pt');
        jQuery('#data').datetimepicker();
        jQuery('#dataVencimento').datetimepicker();
        jQuery('#previsao-entrega').datetimepicker();
        $.post('../controllers/venda/buscaAjaxClienteController.php',function(retorno){
                   $("#select-cliente").html(retorno);
        });
        $.post('../controllers/venda/buscaAjaxProdutoController.php',function(retorno){
                   $("#select-produto").html(retorno);
        });
        $.post('../controllers/orden_servico/buscaAjaxServicoController.php',function(retorno){
                //alert(retorno);
                   $("#select-servico").html(retorno);
        });
        $("#select-cliente").select2({
            theme:"bootstrap",
            placeholder: "Selecione o cliente"
        });
        $("#select-produto").select2({
            theme:"bootstrap",
            placeholder: "Adicione um produto",
            allowClear: true
        });
        $("#select-servico").select2({
            theme:"bootstrap",
            placeholder: "Selecione o servico"
        });
        $("#orden-servico-form").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../controllers/orden_servico/GerenciaOrdenServicoController.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        //$("#error-log").html(response);
                        //alert(response);
                        
                        if(response.indexOf("success") >= 0){
                            //location.reload();
                            var indexSuccess = response.indexOf("success");
                            window.location.assign("sessao.php?page=orden_servico/exibir-orden-servico.php&exibir-servico-id="+response.toString().substr(indexSuccess+7));
                            $("#error-log").html("<div class='alert alert-success'>Orden Registrada</div>");
                        }else if(response.indexOf("erro") >= 0){
                            $("#error-log").html("<div class='alert alert-info'>"+response+"</div>");
                        }else{
                             $("#error-log").html("<div class='alert alert-info'>"+response+"</div>");
                        }
                    }
                });
                return false;
            });
    });
    function attValorTotalOrden(){
        //alert("attvalor");
         $.post('../controllers/orden_servico/GerenciaOrdenServicoController.php',{"getValorTotalOrden":true},function(data){
            //alert(data);
            //alert("entrou");
            //alert(data.servico);
           
            
            $("#valor-total").val(data.totalordem);
             },'json');
    }
    function attValorTotalServicos(){
        //alert("attvalor");
        
         $.post('../controllers/orden_servico/GerenciaOrdenServicoController.php',{"getValorServicos":true},function(data){

            $("#valor-total-servicos").val(data.servico);
             },'json');
    }
    function attValorTotalVenda(){
        $.post('../controllers/venda/GerenciaVendaController.php',{"getValorTotal":true},function(data){
                 $("#valor-total-venda").val(data.venda);
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
        attValorTotalOrden();
        attValorTotalVenda();
    }
    function rmvItemVenda(p_id){
        var id =p_id;
        //alert(id);
        $.post('../controllers/venda/GerenciaVendaController.php',{"rvmItemVenda":true,"p_id":id},function(data){
        });
        attValorTotalOrden();
        attValorTotalVenda();
    }
    function abrirPanel(id){
        var display = document.getElementById(id).style.display;
        if (display == "none"){
            document.getElementById(id).style.display = '';
            document.getElementById('v-itens').style.display = '';
        }else{
            document.getElementById(id).style.display = 'none';
            document.getElementById('v-itens').style.display = 'none';
        }
    }
    function addServico(){
        //alert("addServico");
        var servico = $("#select-servico").val();
        var quantidade = 1;
        var dados = {
                    addItemServico : true,
                    servicoId : servico,
                    quantidade : quantidade
               }
         $.post('../controllers/orden_servico/GerenciaOrdenServicoController.php',dados,function(data){
            //alert(data);
            //alert(data ==1);
            if(data ==true){
                //alert("atualizarListaServicos");
                carregarListaServicos();
            }else if(data.indexOf("erro") >= 0){
                 $("#error-log").html("<div class='alert alert-info'>"+data+"</div>");
            }else{
                $("#l-servicos").append(data);
            }
        });
        attValorTotalOrden();
        attValorTotalServicos();
    }
    function carregarListaServicos(){
        $.post('../controllers/orden_servico/GerenciaOrdenServicoController.php',{"attListaServico":true},function(retorno){
                 $("#l-servicos").html(retorno);
               });    
    }
    function rmvItemServico(s_id){
        var id = s_id;
         $.post('../controllers/orden_servico/GerenciaOrdenServicoController.php',{"rvmItemServico":true,"s_id":id},function(data){
        });
        attValorTotalOrden();
        attValorTotalServicos();
    }
    function abrirPanelPagamento(id){
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
        <h2 class="page-header">Nova Ordem Serviço</h2>
    </div> 
</div>

<div class="row">
    <form method="post" id="orden-servico-form">
        <div class="col-lg-6">
             <div class="row">
                    <div class="col-lg-12">  
                        <div class="form-group">
                            <label for="select-cliente">Selecione o cliente</label>
                            
                            <select id="select-cliente" name="select-cliente" class="" style="width: 100%"></select>
                            
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
                            <div class ="col-lg-6">
                                <div class="form-group">
                                 <label for="previsao-entrega">Previsao Entrega</label>
                                <input id="previsao-entrega" type="text"  name="previsao-entrega" class="form-control"/>
                               </div>
                            </div>
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
                       <input type="checkbox" id="a-vista" name="a-vista" value="true" onclick="abrirPanelPagamento('pagamento-panel')">
                        <label for="a-vista" class="label-info"></label>
                    </div>
                </div>
                <div class="col-lg-2">
                    A vista
                </div>
                <div class ="col-lg-12">
                   
                    <div class="panel panel-default" id="pagamento-panel">
                        
                        <div class="form-group" style="margin-top:10px">
                            <label for="numParcelas" style="margin-top:5px">   &nbsp;Numero de parcelas </label>
                            <div class="col-lg-6">
                            <input type="number" name="numParcelas" id="numParcelas" min="1" max="24" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dataVencimento" style="msargin-top:5px">   &nbsp;Data de vencimento</label>
                            <div class="col-lg-6">
                            <input type="text" name="dataVencimento" id="dataVencimento" class="form-control"/>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
                <div class="row">
                        <div class="col-lg-8">  
                            <div class="form-group">
                                <label for="select-servico">Adicionar serviço</label>
                                <select class="" id="select-servico" name="select-servico" class="" style="width: 100%"></select>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">  
                            <div class="form-group">
                                <label for="add-servico"></label>
                            <div  id="add-servico" onclick="addServico()" class="btn btn-info" style="margin-top:24px">Adicionar</div>
                           </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4"> 
                                <div class="form-group">
                                    <label for="valor-total-servicos">Preço serviços:</label>
                                </div>
                            </div>
                            <div class="col-lg-8"> 
                                <div class="form-group input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input id="valor-total-servicos"  class="form-control input-lg pull-right" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4"> 
                                <div class="form-group">
                                    <label for="valor-total">Preço Total:</label>
                                </div>
                            </div>
                            <div class="col-lg-8"> 
                                <div class="form-group input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input id="valor-total"  class="form-control input-lg pull-right" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-lg-12">
                        <label for="" class="pull-right">&nbsp Inserir produtos</label>
                        <div class="material-switch pull-right" style="margin:0 0 30px 20px ">
                        
                            <input type="checkbox" id="inserir-venda" name="inserir-venda" value="true" class="pull-right" onclick="abrirPanel('venda-panel')">
                            <label for="inserir-venda" class="label-primary"></label>
                        </div>
                        
                       <!-- <div class="btn btn-success pull-right" onclick="abrirPanel('venda-panel')">inserir produtos</div>-->
                    </div>
                     
                </div>
                <!--quando adicionar uma venda a orden-->
            <div class="well" style="display: none" id="venda-panel" >
                    <div class="row">
                        <div class="col-lg-6">  
                            <div class="form-group">
                                
                                <label for="select-produto">Adicionar produto na venda</label>
                                <select class="" id="select-produto" name="select-produto" class="" style="width: 100%"></select>
                            </div>
                        </div>
                        <div class="col-lg-4">  
                            <div class="form-group">
                                <label for="quantidade">qtd</label>
                                <input id="quantidade" type="number" value="1" min="1" name="" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-lg-2">  
                            <div class="form-group">
                                 <label for="add-item-venda">&nbsp</label>
                            <div  id="add-item-venda"onclick="return addItemVenda()" class="btn btn-warning">add</div>
                           </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">   
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4"> 
                                    <div class="form-group">
                                        <label for="valor-total-venda">Preço venda:</label>
                                    </div>
                                </div>
                                <div class="col-lg-8"> 
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input id="valor-total-venda"  class="form-control input-lg pull-right" disabled/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
            
                <!--submit da orden-->
                <div class="col-lg-12"> 
                    <div class="row">
                        <div class="col-lg-4"> 
                            <input value="Concluir" type="submit" id="salvar-orden-servico" name="salvar-orden-servico" class="form-control  btn btn-primary"/>
                        </div>
                    </div>
                </div>
                <!--div para exibir erros-->
                <div class="col-lg-12"> 
                    <div class="row">
                        <div class="error-log " id="error-log" style="margin-top:15px"></div>
                    </div>
                </div>
                <!--fim log de erro-->
            </div>
        
        <div class="col-lg-6">
            <label for="l-servicos">Serviços</label>
            <div id="l-servicos" class="well"></div>
            <div id="v-itens"style="display:none">
                <label for="l-itens">Produtos</label>
                <div  id="l-itens" class="well" ></div>
            </div>
            <div class="row">
            
            </div>
        </div>
    </form>
</div>
   