<?php
include_once"../controllers/PrescricaoController.php";

?>
<script type="text/javascript">

    $(document).ready(function() {
        
        $.datetimepicker.setLocale('pt');
        jQuery('#data').datetimepicker({
            timepicker:false,
            format:'Y-m-d'
            
        });
    
        $.post('../controllers/venda/buscaAjaxClienteController.php',function(retorno){
                   $("#select-cliente").html(retorno);
        });
        $("#select-cliente").select2({
            theme:"bootstrap",
            placeholder: "Selecione o cliente",
            allowClear: true
        });
    });
     jQuery(function($){
            $('#codigoBarra').mask("999-999-999-999-9"); 
            //$("#valor").maskMoney();
            //$("#valor").maskMoney({symbol:'R$ ', showSymbol:true, thousands:'.', decimal:',', symbolStay: true});})
            $('#telefone').mask("(99)9999-9999");
            $('#celular').mask("(99)99999-9999");
        });
        
</script>
<div class="panel panel-primary" style="margin-top:20px">
    <div class="panel-heading">
        Cadastrar uma nova receita
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="row">
                <?php
                        PrescricaoController::cadastrarPrescricao();
                ?>
                <form role="form" method="post">
                    
                    
                    <div class="row">
                        <div class="col-md-6">
                           
                                <div class="form-group">
                                    <label for="select-cliente">Cliente</label>
                                    <select required id="select-cliente" name="select-cliente" class="" style="width: 100%"></select>
                                </div>
                            
                        </div>
                        <div class="col-md-6">
                            
                                <div class="form-group">
                                    <label>Numero da receita</label>
                                    <input  name="num-receita" id="num-receita" class="form-control">
                                </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                                <div class="form-group">
                                    <label>Medico</label>
                                    <input  name="medico" id="medico" class="form-control">
                                </div>
                    
                        </div>
                        <div class="col-md-6">
                            
                                <div class="form-group">
                                    <label>Data</label>
                                    <input required type="text" name="data" id="data" class="form-control">
                                </div>
                        
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="panel panel-default">
                        <div class="panel-heading">longe</div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Esf.</label>
                                    </div>
                                    <div class="col-md-2">
                                         <label>Cil.</label>
                                    </div>
                                    <div class="col-md-2">
                                         <label>Eixo</label>
                                    </div>
                                    <div class="col-md-2">
                                         <label>Dpn.</label>
                                    </div>
                                    <div class="col-md-2">
                                         <label>Alt.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>OD:</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="longe-od-esf" id="longe-od-esf" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="longe-od-cil" id="longe-od-cil" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="longe-od-eixo" id="longe-od-eixo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="longe-od-dpn" id="longe-od-dpn" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="longe-od-alt" id="longe-od-alt" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>OE:</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="longe-oe-esf" id="longe-oe-esf" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="longe-oe-cil" id="longe-oe-cil" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="longe-oe-eixo" id="longe-oe-eixo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="longe-oe-dpn" id="longe-oe-dpn" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="longe-oe-alt" id="longe-oe-alt" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="panel panel-default">
                        <div class="panel-heading">perto</div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Esf.</label>
                                    </div>
                                    <div class="col-md-2">
                                         <label>Cil.</label>
                                    </div>
                                    <div class="col-md-2">
                                         <label>Eixo</label>
                                    </div>
                                    <div class="col-md-2">
                                         <label>Dpn.</label>
                                    </div>
                                    <div class="col-md-2">
                                         <label>Alt.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>OD:</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="perto-od-esf" id="perto-od-esf" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="perto-od-cil" id="perto-od-cil" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="perto-od-eixo" id="perto-od-eixo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="perto-od-dpn" id="perto-od-dpn" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="perto-od-alt" id="perto-od-alt" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>OE:</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="perto-oe-esf" id="perto-oe-esf" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="perto-oe-cil" id="perto-oe-cil" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="perto-oe-eixo" id="perto-oe-eixo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="perto-oe-dpn" id="perto-oe-dpn" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  name="perto-oe-alt" id="perto-oe-alt" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-heading">adição para lente perto</div>
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                 <label>OD:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input name="add-perto-od" id="add-perto-od" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                 <label>OE:</label>
                                            </div>
                                            <div class="col-md-6">
                                                  <div class="form-group">
                                                    <input name="add-perto-oe" id="add-perto-oe" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                   
                    
                    
                    
                    <button type="submit" name="btn-cadastrar-prescricao" class="btn btn-success">Cadastrar</button>
                    <button type="reset" class="btn btn-default">Cancelar</button>
                    
                </form>
            </div>
        </div>
        </div>
    </div>
</div>



