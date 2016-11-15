<?php

include_once"../controllers/ClienteController.php";

?>
<script type="text/javascript">
    $(document).ready(function() {
        $.datetimepicker.setLocale('pt');
        jQuery('#dataNascimento').datetimepicker({
            timepicker:false,
            format:'Y-m-d'
            
        });
    });
    
    
     jQuery(function($){
            $('#cpf').mask("999.999.999-99"); 
            $('#rg').mask("99.999.999-9");
            $('#cep').mask("99999-999");
            $('#telefone').mask("(99)9999-9999");
            $('#celular').mask("(99)99999-9999");
        });
        
</script>
<div class="panel panel-primary " style="margin-top:20px">
    <div class="panel-heading">
        Cadastrar um novo cliente
    </div>
    <div class="row">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                    <?php 
                            ClienteController::cadastrarCliente();
                    ?>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input required type="text" name="nome" class="form-control">
                        </div>
                        <div class="row">
                        <div class="col-lg-4">    
                        <div class="form-group">
                            <label>Identidade:</label>
                            <input required name="rg" id="rg" class="form-control">
                        </div>
                        </div>
                        <div class="col-lg-4">
                        <div class="form-group">
                            <label>Cpf:</label>
                            <input required name="cpf" id="cpf" class="form-control">
                        </div>
                        </div>
                        <div class="col-lg-4">
                        <div class="form-group">
                            <label>Nascimento:</label>
                            <input required type="text" name="dataNascimento" id="dataNascimento" class="form-control">
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Telefone:</label>
                                <input name="telefone" id="telefone" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Celular:</label>
                                <input name="celular" id="celular" class="form-control">
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="row">
                        
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label>Endereço</label>
                                <input name="endereco" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                <label>Bairro</label>
                                <input name="bairro" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                <label>Numero</label>
                                <input name="numeroCasa" class="form-control">
                                </div>
                            </div>
                        
                        </div>
                        <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">    
                                <label>Cidade</label>
                                <input name="cidade" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Uf:</label>
                                <select data-width="100%" class="form-control" title="Selecione um Estado" id="uf" name="uf">
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PR">PR</option>
                                    <option value="PB">PB</option>
                                    <option value="PA">PA</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SE">SE</option>
                                    <option value="SP">SP</option>
                                    <option value="TO">TO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Cep:</label>
                                <input name="cep" id="cep" class="form-control">
                            </div>
                        </div>
                        
                        </div>
                        <button type="submit" name="btnCadastrarCliente" value="cadastrar" class="btn btn-success">Cadastrar</button>
                        <button type="reset" class="btn btn-default">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
