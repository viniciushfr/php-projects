<?php

include_once"../controllers/ServicoController.php";

?>
<script type="text/javascript">
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
        Cadastrar um novo servico
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <?php
                        ServicoController::cadastrarServico();
                ?>
                <form role="form" method="post">
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <input required name="nome" id="nome" class="form-control">
                            </div>
                        </div>
                    
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor</label>
                                <input required name="valor" id="valor" class="form-control">
                            </div>
                        </div>
                    
                        
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="btnCadastrarServico" class="btn btn-success">Cadastrar</button>
                    <button type="reset" class="btn btn-default">Cancelar</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>



