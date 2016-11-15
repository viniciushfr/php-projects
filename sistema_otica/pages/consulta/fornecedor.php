<?php
    include_once '../models/dao/FornecedorDAO.php';
    include_once '../models/Fornecedor.php';
    include_once '../controllers/FornecedorController.php';

?>
<script type="text/javascript">
    $(document).ready(function(){
       
        $("#form-editar").on('submit', function (e) {
            //alert("salvar");
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../controllers/FornecedorController.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        //alert(response);
                        if(response){
                            $("#erro-log").addClass("alert alert-success");
                            $("#erro-log").html("Fornecedor Salvo");
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
    function mostrarDados(nome){
        alert(nome);
    }
    
         jQuery(function($){
            $('#cnpj').mask("99.999.999/9999-99"); 
            $('#rg').mask("99.999.999-9");
            $('#cep').mask("99999-999");
            $('#telefone').mask("(99)9999-9999");
            $('#celular').mask("(99)99999-9999");
        });
    function preencherFormulario(id,identificacao,cnpj,inscEstadual,email,telefone,celular,site,endereco,numero,bairro,cidade,cep,uf){
        //alert (id+","+nome+","+cpf+","+rg+",nascimento: "+dataNascimento+",email: "+email+",telefone: "+telefone+","+celular+","+endereco+","+numeroCasa+","+bairro+","+cidade+","+cep+","+uf);
        $("#id").val(id);
        $("#identificacao").val(identificacao);
        $("#cnpj").val(cnpj);
        $("#inscEstadual").val(inscEstadual);
        $("#email").val(email);
        $("#telefone").val(telefone);
        $("#celular").val(celular);
        $("#site").val(site);
        $("#endereco").val(endereco);
        $("#numero").val(numero);
        $("#bairro").val(bairro);
        $("#cidade").val(cidade);
        $("#cep").val(cep);
        $("#uf").val(uf).change();
        
    }
</script>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Consulta de fornecedores</h2>
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
                    <option>identificacao</option>
                    <option>cnpj</option>
                    <option>inscEstadual</option>
                    <option>cidade</option>
                </select>
            </div>
            <button type="submit" name="buscarFornecedor" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        </form>
    </div>
    <?php
        $fornecedores = FornecedorController::buscaFornecedor();
         if(!empty($fornecedores)){
                echo "<table class=\"table table-condensed table-hover table-bordered\">";
                echo "<thead>";
                echo "    <tr>";
                echo "        <th>Nome</th>";
                echo "        <th>Cnpj</th>";
                echo "        <th>Inscicao Estadual</th>";
                echo "        <th>Endereco</th>";
                echo "        <th></th>";
                echo "        <th></th>";
                echo "    </tr>";
                echo "</thead>";
                echo "<tbody>";
                for($i =0;$i < count($fornecedores);$i++){
                    echo "<tr >";
                    echo "<td onclick=\"hide_show('".$i."')\">". $fornecedores[$i]->getIdentificacao(). "</td>";
                    echo "<td onclick=\"hide_show('".$i."')\">". $fornecedores[$i]->getCnpj(). "</td>";
                    echo "<td onclick=\"hide_show('".$i."')\">". $fornecedores[$i]->getInscEstadual(). "</td>";
                    echo "<td onclick=\"hide_show('".$i."')\">". $fornecedores[$i]->getEndereco(). "</td>";
                    echo "<td>
                            <form method=\"post\">
                                <input hidden=\"hidden\" name=\"id\" value=\"".$fornecedores[$i]->getId()."\">
                                <button name=\"btnExcluirFornecedorId\"  type=\"submit\" class=\"btn btn-danger btn-circle\">
                                    <span class=\"fa fa-times\"></span>
                                </button>
                            </form>
                            </td>";
                    echo "<td>
                            <div name=\"btn-editar\" data-target='#modal-editar'   data-toggle='modal' class=\"btn btn-warning btn-circle\"
                            onclick=\"preencherFormulario(
                            '".$fornecedores[$i]->getId()."',
                            '".$fornecedores[$i]->getIdentificacao()."',
                            '".$fornecedores[$i]->getCnpj()."',
                            '".$fornecedores[$i]->getInscEstadual()."',
                            '".$fornecedores[$i]->getEmail()."',
                            '".$fornecedores[$i]->getTelefone()."',
                            '".$fornecedores[$i]->getCelular()."',
                            '".$fornecedores[$i]->getSite()."',
                            '".$fornecedores[$i]->getEndereco()."',
                            '".$fornecedores[$i]->getNumero()."',
                            '".$fornecedores[$i]->getBairro()."',
                            '".$fornecedores[$i]->getCidade()."',
                            '".$fornecedores[$i]->getCep()."',
                            '".$fornecedores[$i]->getUf()."')\"
                            >
                                <span class=\"fa fa-pencil\"></span>
                            </div>";
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr id='$i' style='display: none' >";
                    echo "<td colspan='6' style='width: 100%'>";
                    echo "<div  class=\"\">";
                    echo "<div class=\"well\">";
                    echo "<li>identificacao:  ".$fornecedores[$i]->getIdentificacao()."</li>";
                    echo "<li>cnpj:  ".$fornecedores[$i]->getCnpj()."</li>";
                    echo "<li>incricao estadual:  ".$fornecedores[$i]->getInscEstadual()."</li>";
                    echo "<li>email  :".$fornecedores[$i]-> getEmail()."</li>";
                    echo "<li>telefone:  ".$fornecedores[$i]->getTelefone()."</li>";
                    echo "<li>celular: ".$fornecedores[$i]->getCelular()."</li>";
                    echo "<li>endereco:  ".$fornecedores[$i]->getEndereco()."</li>";
                    echo "<li>bairro:  ".$fornecedores[$i]->getBairro()."</li>";
                    echo "<li>cidade:  ".$fornecedores[$i]->getCidade()."</li>";
                    echo "<li>uf:  ".$fornecedores[$i]->getUf()."</li>";
                    echo "<li>cep:  ".$fornecedores[$i]->getCep()."</li>";
                    
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
            FornecedorController::excluirFornecedor();
    ?>
<!-- Modal -->
<div id="modal-editar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Fornecedor</h4>
      </div>
      <div class="modal-body">
                        
                    <form role="form" id="form-editar"  action="" method="post">
                    <div class="form-group">
                        <input id="id" name="id" hidden="hidden">
                        <label>Identificação</label>
                        <input id="identificacao" name="identificacao" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Inscrição Estadual</label>
                                <input id="inscEstadual" required name="inscEstadual" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Cnpj</label>
                                <input required name="cnpj" id="cnpj" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Site</label>
                        <input id="site" required name="site" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Telefone:</label>
                                <input required name="telefone" id="telefone" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Celular:</label>
                                <input required name="celular" id="celular" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input required name="email" id="email" class="form-control">
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
                            <input required name="numero" id="numero" class="form-control">
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
                                <input required id="cep" name="cep" class="form-control">
                            </div>
                        </div>
                    </div>
                <button type="submit" name="btn-editar" id="btn-editar" value="editar" class="btn btn-success">Salvar</button>
                <button type="reset" class="btn btn-default">Cancelar</button>
                </form>
                    <div id="erro-log" style="margin-top:20px"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    

