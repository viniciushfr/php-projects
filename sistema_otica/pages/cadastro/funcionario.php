<?php
include_once"../controllers/FuncionarioController.php";

?>
<script type="text/javascript">
    $(document).ready(function() {
        $.datetimepicker.setLocale('pt');
        jQuery('#dataEmissao').datetimepicker({
            timepicker:false,
            format:'Y-m-d'
            
        });
    });
     jQuery(function($){
            $('#cpf').mask("999.999.999-99"); 
            $('#rg').mask("99.999.999-9");
            $('#cep').mask("99999-999");
            $('#ctps').mask("999999");
            $('#serie').mask("999-9");
            $('#telefone').mask("(99)9999-9999");
            $('#celular').mask("(99)99999-9999");
        });
        
</script>
<div class="panel panel-primary" style="margin-top:20px">
    <div class="panel-heading">
        Cadastrar um novo funcionario
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <?php
                            FuncionarioController::cadastrarFuncionario();
                    ?>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input required type="text" name="nome" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Identidade</label>
                                    <input required name="rg" id="rg" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Cpf</label>
                                    <input required name="cpf" id="cpf" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Ctps</label>
                                    <input  name="ctps" id="ctps" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>Serie</label>
                                    <input  name="serie" id="serie" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Data Emissão</label>
                                    <input  type="text" id="dataEmissao" name="dataEmissao" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Funcão</label>
                                    <input name="funcao" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Salario Inicial</label>
                                    <input name="salarioInicial" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Horas de trabalho</label>
                                    <input name="horasTrabalho" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Situacao civil</label>
                                    <select data-width="100%" class="form-control" title="Selecione um estado civil" id="estado-civil-input" name="estado-civil-input">
                                    <option value="Solteiro(a)">Solteiro(a)</option>
                                    <option value="Casado(a)">Casado(a)</option>
                                    <option value="Divorciado(a)">Divorciado(a)</option>
                                    <option value="Separado(a)">Separado(a)</option>
                                    <option value="Viúvo(a)">Viúvo(a)</option>
                                    <option value="Companheiro(a)">Companheiro(a)</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Telefone:</label>
                                    <input name="telefone" id="telefone" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Celular:</label>
                                    <input name="celular" id="celular" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input name="email" type="email" id="email" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input name="endereco" id="endereco" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input name="bairro" id="bairro" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>Numero</label>
                                    <input type="number" id="numero" mim="1" name="numeroCasa" class="form-control">
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
                        <button type="submit" name="btnCadastrarFuncionario" class="btn btn-success">Cadastrar</button>
                        <button type="reset" class="btn btn-default">Cancela</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
                
           

        
