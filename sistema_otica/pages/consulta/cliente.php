<?php
    include_once '../models/dao/ClienteDAO.php';
    include_once '../models/Cliente.php';
    include_once '../controllers/ClienteController.php';
    

?>
<script type="text/javascript">
    //alert("ola");
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
    
    $(document).ready(function(){
        $("#form-editar").on('submit', function (e) {
            //alert("salvar");
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../controllers/ClienteController.php",
                    data: new FormData(this),
                    
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                    //alert(response);
                      if(response){
                          $("#erro-log").addClass("alert alert-success");
                          $("#erro-log").html("Cliente Salvo");
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
    
    function preencherFormulario(id,nome,cpf,rg,dataNascimento,email,telefone,celular,endereco,numeroCasa,bairro,cidade,cep,uf){
        //alert (id+","+nome+","+cpf+","+rg+",nascimento: "+dataNascimento+",email: "+email+",telefone: "+telefone+","+celular+","+endereco+","+numeroCasa+","+bairro+","+cidade+","+cep+","+uf);
        $("#id").val(id);
        $("#nome").val(nome);
        $("#cpf").val(cpf);
        $("#rg").val(rg);
        $("#dataNascimento").val(dataNascimento);
        $("#email").val(email);
        $("#telefone").val(telefone);
        $("#celular").val(celular);
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
            $('#telefone').mask("(99)9999-9999");
            $('#celular').mask("(99)99999-9999");
        });
</script>
    
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Consulta de clientes</h2>
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
                    <option value="nome">nome</option>
                    <option value="cpf">cpf</option>
                    <option>rg</option>
                    <option>email</option>
                    <option>telefone</option>
                    <option>celular</option>
                </select>
            </div>
            <button name="buscarCliente" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        </form>
    </div>
    <?php
        $clientes = ClienteController::buscaCliente();
        if(!empty($clientes)){
                echo "<table class=\"table table-condensed table-hover table-bordered\">";
                echo "<thead>";
                echo "    <tr>";
                echo "        <th>Nome</th>";
                echo "        <th>Cpf</th>";
                echo "        <th>Rg</th>";
                echo "        <th>Nascimento</th>";
                echo "        <th></th>";
                echo "        <th></th>";
                echo "    </tr>";
                echo "</thead>";
                echo "<tbody>";
                for($i =0;$i < count($clientes);$i++){
                    echo "<tr >";
                    echo "<td onclick=\"hide_show('".$i."')\">". $clientes[$i]->getNome(). "</td>";
                    echo "<td onclick=\"hide_show('".$i."')\">". $clientes[$i]->getCpf(). "</td>";
                    echo "<td onclick=\"hide_show('".$i."')\">". $clientes[$i]->getRg(). "</td>";
                    echo "<td onclick=\"hide_show('".$i."')\">". $clientes[$i]->getDataNascimento(). "</td>";
                    echo "<td>
                            <form method=\"post\">
                                <input hidden=\"hidden\" name=\"id\" value=\"".$clientes[$i]->getId()."\">
                                <button name=\"btnExcluirClienteId\"  type=\"submit\" class=\"btn btn-danger btn-circle\">
                                    <span class=\"fa fa-times\"></span>
                                </button>
                            </form>";
                    echo "</td>";
                    echo "<td>
                            <div name=\"btn-editar\" data-target='#modal-editar'   data-toggle='modal' class=\"btn btn-warning btn-circle\"
                            onclick=\"preencherFormulario('".$clientes[$i]->getId()."',
                            '".$clientes[$i]->getNome()."',
                            '".$clientes[$i]->getCpf()."',
                            '".$clientes[$i]->getRg()."',
                            '".$clientes[$i]->getDataNascimento()."',
                            '".$clientes[$i]->getEmail()."',
                            '".$clientes[$i]->getTelefone()."',
                            '".$clientes[$i]->getCelular()."',
                            '".$clientes[$i]->getEndereco()."',
                            '".$clientes[$i]->getNumeroCasa()."',
                            '".$clientes[$i]->getBairro()."',
                            '".$clientes[$i]->getCidade()."',
                            '".$clientes[$i]->getCep()."',
                            '".$clientes[$i]->getUf()."')\"
                            >
                                <span class=\"fa fa-pencil\"></span>
                            </div>";
                    echo "</td>";
                    echo "</tr>";
                     
                    echo "<tr id='$i' style='display: none' >";
                    echo "<td colspan='6' style='width: 100%'>";
                    echo "<div  class=\"\">";
                    echo "<div class=\"well\">";
                    echo "<li>nome:  ".$clientes[$i]->getNome()."</li>";
                    echo "<li>cpf:  ".$clientes[$i]->getCpf()."</li>";
                    echo "<li>rg:  ".$clientes[$i]->getRg()."</li>";
                    echo "<li>data de nascimento: ".$clientes[$i]->getDataNascimento()."</li>";
                    echo "<li>email  :".$clientes[$i]-> getEmail()."</li>";
                    echo "<li>telefone:  ".$clientes[$i]->getTelefone()."</li>";
                    echo "<li>celular: ".$clientes[$i]->getCelular()."</li>";
                    echo "<li>endereco:  ".$clientes[$i]->getEndereco()."</li>";
                    echo "<li>bairro:  ".$clientes[$i]->getBairro()."</li>";
                    echo "<li>cidade:  ".$clientes[$i]->getCidade()."</li>";
                    echo "<li>uf:  ".$clientes[$i]->getUf()."</li>";
                    echo "<li>cep:  ".$clientes[$i]->getCep()."</li>";
                    echo "</div>";
                    echo "</div>";
                    echo "</td>";
                    echo "<tr>";
     
                }
                echo "</tbody>";
                echo "</table>";
                
            }else{
                echo "<div class=\"alert alert-info\" role=\"alert\">";
                echo "        A busca nao retornou nenhum registro.";
                echo "</div>";
            }
            
        ClienteController::excluirCliente();
    ?>

<!-- Modal -->
<div id="modal-editar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Cliente</h4>
      </div>
      <div class="modal-body">
                        
                        <form role="form form-inline" id="form-editar" action="" method="post">
                        <input id="id" name="id" hidden="hidden">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input required id="nome"type="text" name="nome" class="form-control">
                        </div>
                          
                        <div class="form-group">
                            <label>Identidade:</label>
                            <input required id="rg" name="rg" id="rg" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Cpf:</label>
                            <input required id="cpf" name="cpf" id="cpf" class="form-control">
                        </div>
                       
                        <div class="form-group">
                            <label>Nascimento:</label>
                            <input required id="dataNascimento" type="date" name="dataNascimento" class="form-control">
                        </div>
                        
                        
                        <div class="form-group">
                            <label>Telefone:</label>
                            <input required id="telefone" name="telefone"  class="form-control">
                        </div>
                    
                        <div class="form-group">
                            <label>Celular:</label>
                            <input required id="celular" name="celular"  class="form-control">
                        </div>
                        
                        <div class="form-group">
                        <label>Email:</label>
                        <input required id="email" type="email" name="email" class="form-control">
                        </div>
                    
                        <div class="form-group">
                        <label>Endereço</label>
                        <input required id="endereco" name="endereco" class="form-control">
                        </div>
                   
                        <div class="form-group">
                        <label>Bairro</label>
                        <input required id="bairro" name="bairro" class="form-control">
                        </div>
                   
                        <div class="form-group">
                        <label>Numero</label>
                        <input required id="numeroCasa" name="numeroCasa" class="form-control">
                        </div>
                            
                        
                        
                        <div class="form-group">    
                            <label>Cidade</label>
                            <input required id="cidade" name="cidade" class="form-control">
                        </div>
                   
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
                   
                        <div class="form-group">
                            <label>Cep:</label>
                        <input required  name="cep" id="cep" class="form-control">
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
    




        