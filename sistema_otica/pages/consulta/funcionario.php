<?php
    include_once '../models/dao/FuncionarioDAO.php';
    include_once '../models/Funcionario.php';
    include_once '../controllers/FuncionarioController.php';

?>
<script type="text/javascript">
    $(document).ready(function(){
       
        $("#form-editar").on('submit', function (e) {
            //alert("salvar");
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../controllers/FuncionarioController.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        //alert(response);
                        if(response){
                            //alert(response);
                            $("#erro-log").addClass("alert alert-success");
                            $("#erro-log").html("Funcionario Salvo");
                            window.location.reload();
                        }else{
                            $("#erro-log").addClass("alert alert-info");
                            $("#erro-log").html(response);
                        }
                    }
                });
                return false;
            });
    });
    function hide_show(el) {
        var display = document.getElementById(el).style.display;
        document.getElementById(el).colSpan = "5";
        if (display == "none")
            document.getElementById(el).style.display = '';
        else
            document.getElementById(el).style.display = 'none';
    }

    function preencherFormulario(id,nome,cpf,rg,ctps,serie,email,telefone,celular,dataEmissao,funcao,salarioInicial,horasTrabalho,situacaoCivil,conjuge,dependentes,endereco,numeroCasa,bairro,cidade,cep,uf){
       // alert (id+","+nome+","+cpf+","+rg+", "+ctps+","+serie+", "+email+","+telefone+","+celular+","+dataEmissao+","+funcao+","+salarioInicial+","+horasTrabalho+","+situacaoCivil+","+conjuge+","+dependentes+","+endereco+","+numeroCasa+","+bairro+","+cidade+","+cep+","+uf);
        //alert(nome);
        //alert(numeroCasa);
        $("#id").val(id);
        $("#nome").val(nome);
        $("#cpf").val(cpf);
        $("#rg").val(rg);
        $("#ctps").val(ctps);
        $("#serie").val(serie);
        $("#email").val(email);
        $("#telefone").val(telefone);
        $("#celular").val(celular);
        $("#dataEmissao").val(dataEmissao);
        $("#funcao").val(funcao);
        $("#salarioInicial").val(salarioInicial);
        $("#horasTrabalho").val(horasTrabalho);
        $("#situacaoCivil").val(situacaoCivil);
        $("#conjuge").val(conjuge);
        $("#endereco").val(endereco);
        $("#numeroCasa").val(numeroCasa);
        $("#bairro").val(bairro);
        $("#cidade").val(cidade);
        $("#cep").val(cep);
        $("#uf").val(uf).change();
        
    }
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
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Consulta de funcionarios</h2>
        </div>
    </div>
    <div class="well">
        <form class="form-inline" method="post">
            <div class="form-group">
                <label for="busca">Buscar</label>
                <input name="busca" type="text" class="form-control" id="busca">
            </div>
            
    
            <div class="form-group">
                <label for="atributo">Por</label>
                <select name="atributo" class="form-control" id="atributo">
                    <option>nome</option>
                    <option>cpf</option>
                    <option>rg</option>
                    <option>email</option>
                    <option>telefone</option>
                    <option>celular</option>
                </select>
            </div>
            <button name="buscarFuncionario" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        </form>
    </div>    
    <?php
        $funcionarios = FuncionarioController::buscaFuncionario();
         if(!empty($funcionarios)){
            //Imprime tabela
             echo "<table class=\"table table-condensed table-hover table-bordered\">";
                echo "<thead>";
                echo "    <tr>";
                echo "        <th>Nome</th>";
                echo "        <th>Cpf</th>";
                echo "        <th>Rg</th>";
                echo "        <th>Data Emissao</th>";
                echo "        <th></th>";
                echo "        <th></th>";

                echo "    </tr>";
                echo "</thead>";
                echo "<tbody>";
                for($i =0;$i < count($funcionarios);$i++){
                    echo "<tr>";
                    echo "<td  onclick=\"hide_show('".$i."')\">". $funcionarios[$i]->getNome(). "</td>";
                    echo "<td  onclick=\"hide_show('".$i."')\">". $funcionarios[$i]->getCpf(). "</td>";
                    echo "<td  onclick=\"hide_show('".$i."')\">". $funcionarios[$i]->getRg(). "</td>";
                    echo "<td  onclick=\"hide_show('".$i."')\">". $funcionarios[$i]->getDataEmissao(). "</td>";
                    echo "<td>
                            <form method=\"post\">
                                <input hidden=\"hidden\" name=\"id\" value=\"".$funcionarios[$i]->getId()."\">
                                <button name=\"btnExcluirFuncionarioId\"  type=\"submit\" class=\"btn btn-danger btn-circle\">
                                    <span class=\"fa fa-times\"></span>
                                </button>
                            </form>
                            </td>";
                    echo "<td>
                            <div name=\"btn-editar\" data-target='#modal-editar'   data-toggle='modal' class=\"btn btn-warning btn-circle\"
                            onclick=\"preencherFormulario(
                            '".$funcionarios[$i]->getId()."',
                            '".$funcionarios[$i]->getNome()."',
                            '".$funcionarios[$i]->getCpf()."',
                            '".$funcionarios[$i]->getRg()."',
                            '".$funcionarios[$i]->getCtps()."',
                            '".$funcionarios[$i]->getSerie()."',
                            '".$funcionarios[$i]->getEmail()."',
                            '".$funcionarios[$i]->getTelefone()."',
                            '".$funcionarios[$i]->getCelular()."',
                            '".$funcionarios[$i]->getDataEmissao()."',
                            '".$funcionarios[$i]->getFuncao()."',
                            '".$funcionarios[$i]->getSalarioInicial()."',
                            '".$funcionarios[$i]->getHorasTrabalho()."',
                            '".$funcionarios[$i]->getSituacaoCivil()."',
                            '".$funcionarios[$i]->getConjuge()."',
                            '".$funcionarios[$i]->getDependentes()."',
                            '".$funcionarios[$i]->getEndereco()."',
                            '".$funcionarios[$i]->getNumeroCasa()."',
                            '".$funcionarios[$i]->getBairro()."',
                            '".$funcionarios[$i]->getCidade()."',
                            '".$funcionarios[$i]->getCep()."',
                            '".$funcionarios[$i]->getUf()."'
                            )\"
                            >
                                <span class=\"fa fa-pencil\"></span>
                            </div>";
//(id,nome,cpf,rg,ctps,serie,email,telefone,celular,dataEmissao,funcao,salarioInicial,horasTrabalho,situacaoCivil,conjuge,dependentes,endereco,numeroCasa,bairro,cidade,cep,uf)
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr id='$i' style='display: none' >";
                    echo "<td colspan='6' style='width: 100%'>";
                    echo "<div  class=\"\">";
                    echo "<div class=\"well\">";
                    echo "<li>nome:  ".$funcionarios[$i]->getNome()."</li>";
                    echo "<li>cpf:  ".$funcionarios[$i]->getCpf()."</li>";
                    echo "<li>rg:  ".$funcionarios[$i]->getRg()."</li>";
                    echo "<li>ctps:  ".$funcionarios[$i]->getCtps()."</li>";
                    echo "<li>serie:  ".$funcionarios[$i]->getSerie()."</li>";
                    echo "<li>email  :".$funcionarios[$i]-> getEmail()."</li>";
                    echo "<li>telefone:  ".$funcionarios[$i]->getTelefone()."</li>";
                    echo "<li>celular: ".$funcionarios[$i]->getCelular()."</li>";
                    echo "<li>data emissao:  ".$funcionarios[$i]->getDataEmissao()."</li>";
                    echo "<li>funcao:  ".$funcionarios[$i]->getFuncao()."</li>";
                    echo "<li>salario incial:  ".$funcionarios[$i]->getSalarioInicial()."</li>";
                    echo "<li>horas trabalho:  ".$funcionarios[$i]->getHorasTrabalho()."</li>";
                    echo "<li>situacao civil:  ".$funcionarios[$i]->getSituacaoCivil()."</li>";
                    echo "<li>conjuge:  ".$funcionarios[$i]->getConjuge()."</li>";
                    echo "<li>dependentes:  ".$funcionarios[$i]->getDependentes()."</li>";
                    echo "<li>endereco:  ".$funcionarios[$i]->getEndereco()."</li>";
                    echo "<li>bairro:  ".$funcionarios[$i]->getBairro()."</li>";
                    echo "<li>numero:  ".$funcionarios[$i]->getNumeroCasa()."</li>";
                    echo "<li>cidade:  ".$funcionarios[$i]->getCidade()."</li>";
                    echo "<li>uf:  ".$funcionarios[$i]->getUf()."</li>";
                    echo "<li>cep:  ".$funcionarios[$i]->getCep()."</li>";
                    
                    echo "</div>";
                    echo "</div>";
                    echo "</td>";
                    echo "<tr>";
                }
                echo "</tbody>";
                echo "</table>";
                
                
        }else{
            //mensagem de erro
            echo "<div class=\"alert alert-info\" role=\"alert\">";
            echo "        A busca nao retornou nenhum registro.";
            echo "</div>";
        }
        FuncionarioController::excluirFuncionario();
    ?>

<!-- Modal -->
<div id="modal-editar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Produto</h4>
        </div>
        <div class="modal-body">
            <form role="form" id="form-editar" method="post">
                        <div class="form-group">
                            <input name="id" id="id" hidden="hidden" >
                            <label>Nome</label>
                            <input required type="text" name="nome" id="nome" class="form-control">
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
                                    <input required required name="ctps" id="ctps" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>Serie</label>
                                    <input required  name="serie" id="serie" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Data Emissão</label>
                                    <input required type="date"  name="dataEmissao" id="dataEmissao" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Funcão</label>
                                    <input required name="funcao" id="funcao" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Salario Inicial</label>
                                    <input required name="salarioInicial" id="salarioInicial" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Horas de trabalho</label>
                                    <input required name="horasTrabalho" id="horasTrabalho" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Situacao civil</label>
                                    <select required data-width="100%" class="form-control" title="Selecione um estado civil" id="situacaoCivil" name="situacaoCivil">
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
                                    <input required  name="telefone" id="telefone" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Celular:</label>
                                    <input required name="celular" id="celular" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input required name="email" type="email" id="email" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input required name="endereco" id="endereco" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input required name="bairro" id="bairro" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>Numero</label>
                                    <input required type="number" id="numeroCasa" mim="1" name="numeroCasa" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label>Cidade</label>
                                <input required name="cidade" id="cidade" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                <label>Uf:</label>
                                <select required data-width="100%" class="form-control" title="Selecione um Estado" id="uf" name="uf">
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
                                    <input required name="cep" id="cep" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn-editar" id="btn-editar" class="btn btn-success">Salvar</button>
                        <button type="reset" class="btn btn-default">Cancela</button>
                    </form>
            <div id="erro-log" style="margin-top:20px"></div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>  





        