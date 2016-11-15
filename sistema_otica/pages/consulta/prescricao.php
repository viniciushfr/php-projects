<?php
    include_once '../models/dao/ProdutoDAO.php';
    include_once '../models/Produto.php';
    include_once '../controllers/PrescricaoController.php';
?>
<script type="text/javascript">

     $(document).ready(function() {
          $("#form-editar").on('submit', function (e) {
            //alert("salvar");
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../controllers/PrescricaoController.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        //alert(response);
                        if(response){
                           // alert(response);
                            $("#erro-log").addClass("alert alert-success");
                            $("#erro-log").html("Prescrição Salva");
                            window.location.reload();
                        }else{
                            $("#erro-log").addClass("alert alert-info");
                            $("#erro-log").html(response);
                        }
                    }
                });
                return false;
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
    
    function hide_show(el) {
        var display = document.getElementById(el).style.display;
        document.getElementById(el).colSpan = "5";
        if (display == "none")
            document.getElementById(el).style.display = '';
        else
            document.getElementById(el).style.display = 'none';
    }
    function excluirPrescricao(id){
        $.post("../controllers/PrescricaoController.php",{"excluir":true,"id":id},function(retorno){
            alert(retorno);
            //window.location.reload();
            $("#erro-log").html(retorno);
        });
    }
    function mostrarDados(nome){
        alert(nome);
    }
    function preencherFormulario(id, numReceita, medico, data , longeOdEsf,
                                                                longeOdCil,
                                                                longeOdEixo,
                                                                longeOdDpn,
                                                                longeOdAlt,
                                                                
                                                                longeOeEsf,
                                                                longeOeCil,
                                                                longeOeEixo,
                                                                longeOeDpn,
                                                                longeOeAlt,
                                                                
                                                                pertoOdEsf,
                                                                pertoOdCil,
                                                                pertoOdEixo,
                                                                pertoOdDpn,
                                                                pertoOdAlt,
                                                                
                                                                pertoOeEsf,
                                                                pertoOeCil,
                                                                pertoOeEixo,
                                                                pertoOeDpn,
                                                                pertoOeAlt,
                                                                
                                                                addPertoOd,
                                                                addPertoOe
                                                               ){
                                                                
       // alert (id+","+numReceita+","+medico+","+data+", "+longeOD+","+longeOE+", "+pertoOD+","+pertoOE+","+esfera+","+cilindro+","+eixo+","+dnp+","+aqPertoOD+","+aqPertoOE);
        //alert(nome);
        $("#id").val(id);
        $("#num-receita").val(numReceita);
        $("#medico").val(medico);
        $("#data").val(data);
        
        $("#longe-od-esf").val(longeOdEsf);
        $("#longe-od-cil").val(longeOdCil);
        $("#longe-od-eixo").val(longeOdEixo);
        $("#longe-od-dpn").val(longeOdDpn);
        $("#longe-od-alt").val(longeOdAlt);
        
        $("#longe-oe-esf").val(longeOeEsf);
        $("#longe-oe-cil").val(longeOeCil);
        $("#longe-oe-eixo").val(longeOeEixo);
        $("#longe-oe-dpn").val(longeOeDpn);
        $("#longe-oe-alt").val(longeOeAlt);
        
        $("#perto-od-esf").val(pertoOdEsf);
        $("#perto-od-cil").val(pertoOdCil);
        $("#perto-od-eixo").val(pertoOdEixo);
        $("#perto-od-dpn").val(pertoOdDpn);
        $("#perto-od-alt").val(pertoOdAlt);
        
        $("#perto-oe-esf").val(pertoOeEsf);
        $("#perto-oe-cil").val(pertoOeCil);
        $("#perto-oe-eixo").val(pertoOeEixo);
        $("#perto-oe-dpn").val(pertoOeDpn);
        $("#perto-oe-alt").val(pertoOeAlt);
        
        $("#add-perto-od").val(addPertoOd);
        $("#add-perto-oe").val(addPertoOe);
        
        
    }
</script>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Consulta de prescrições</h2>
        </div>
    </div>
    <div class="well">
        <form class="form form-inline" method="post">
            <div class="form-group">
                <label for="select-cliente">Selecione o cliente: </label>
                <select id="select-cliente" name="busca" style="width:200px"></select>
            </div>
            <div class="form-group">
                <input type="text" hidden="hidden"  value="clienteId" name="atributo"/>
                <button name="buscar-prescricoes" type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </button>
            </div>
        </form>
    </div>    
    <?php
        $prescricoes = PrescricaoController::buscaPrescricao();
                if(!empty($prescricoes)){
            //Imprime tabela
            echo "<table class=\"table table-condensed table-hover table-bordered\">";
                echo "<thead>";
                echo "    <tr>";
                echo "        <th>Numero Receita</th>";
                echo "        <th>Medico</th>";
                echo "        <th>Data</th>";
                echo "        <th></th>";
                echo "        <th></th>";
                echo "    </tr>";
                echo "</thead>";
                echo "<tbody>";
                for($i =0;$i < count($prescricoes);$i++){
                    echo "<tr>";
                    echo "<td onclick=\"hide_show('".$i."')\">". $prescricoes[$i]->getNumReceita(). "</td>";
                    echo "<td onclick=\"hide_show('".$i."')\">". $prescricoes[$i]->getMedico(). "</td>";
                    echo "<td onclick=\"hide_show('".$i."')\">". $prescricoes[$i]->getData(). "</td>";
                    echo "<td>
                                <button onclick=\"excluirPrescricao( '".$prescricoes[$i]->getId()."')\" class='btn btn-danger btn-circle'>
                                    <span class='fa fa-times'></span>
                                </button>
                        </td>";
                    echo "<td>
                            <div name=\"btn-editar\" data-target='#modal-editar'   data-toggle='modal' class=\"btn btn-warning btn-circle\"
                            onclick=\"preencherFormulario(
                            '".$prescricoes[$i]->getId()."',
                            '".$prescricoes[$i]->getNumReceita()."',
                            '".$prescricoes[$i]->getMedico()."',
                            '".$prescricoes[$i]->getData()."',
                            
                            '".$prescricoes[$i]->getLongeOdEsf()."',
                            '".$prescricoes[$i]->getLongeOdCil()."',
                            '".$prescricoes[$i]->getLongeOdEixo()."',
                            '".$prescricoes[$i]->getLongeOdDpn()."',
                            '".$prescricoes[$i]->getLongeOdAlt()."',
                            '".$prescricoes[$i]->getLongeOeEsf()."',
                            '".$prescricoes[$i]->getLongeOeCil()."',
                            '".$prescricoes[$i]->getLongeOeEixo()."',
                            '".$prescricoes[$i]->getLongeOeDpn()."',
                            '".$prescricoes[$i]->getLongeOeAlt()."',
                            
                            '".$prescricoes[$i]->getPertoOdEsf()."',
                            '".$prescricoes[$i]->getPertoOdCil()."',
                            '".$prescricoes[$i]->getPertoOdEixo()."',
                            '".$prescricoes[$i]->getPertoOdDpn()."',
                            '".$prescricoes[$i]->getPertoOdAlt()."',
                            '".$prescricoes[$i]->getPertoOeEsf()."',
                            '".$prescricoes[$i]->getPertoOeCil()."',
                            '".$prescricoes[$i]->getPertoOeEixo()."',
                            '".$prescricoes[$i]->getPertoOeDpn()."',
                            '".$prescricoes[$i]->getPertoOeAlt()."',
                            
                            '".$prescricoes[$i]->getAddPertoOd()."',
                            '".$prescricoes[$i]->getAddPertoOe()."'
                            
                            )\"
                            >
                                <span class=\"fa fa-pencil\"></span>
                            </div>";
//(id, numReceita, medico, data, longeOD,longeOE,pertoOD,pertoOE,esfera,cilindro,eixo,dnp,aqPertoOD,aqPertoOE)
                    echo "</td>";
                    echo "</tr>";
                     echo "<tr id='$i' style='display: none' >";
                    echo "<td colspan='6' style='width: 100%'>";
                    echo "<div  class=\"\">";
                    echo "<div class=\"well\">";
                    echo "<li>Numero receita:  ".$prescricoes[$i]->getNumReceita()."</li>";
                    
                    echo "<li>Medico:  ".$prescricoes[$i]->getMedico()."</li>";
                    echo "<li>Data:  ".$prescricoes[$i]->getData()."</li>";
                    
                    echo "<li>Longe OD Esfera: ".$prescricoes[$i]->getLongeOdEsf()."</li>";
                    echo "<li>Longe OD Cilindro: ".$prescricoes[$i]->getLongeOdCil()."</li>";
                    echo "<li>Longe OD Eixo: ".$prescricoes[$i]->getLongeOdEixo()."</li>";
                    echo "<li>Longe OD Dpn: ".$prescricoes[$i]->getLongeOdDpn()."</li>";
                    echo "<li>Longe OD Altura: ".$prescricoes[$i]->getLongeOdAlt()."</li>";
                    
                    echo "<li>Longe OE Esfera: ".$prescricoes[$i]->getLongeOeEsf()."</li>";
                    echo "<li>Longe OE Cilindro: ".$prescricoes[$i]->getLongeOeCil()."</li>";
                    echo "<li>Longe OE Eixo: ".$prescricoes[$i]->getLongeOeEixo()."</li>";
                    echo "<li>Longe OE Dpn: ".$prescricoes[$i]->getLongeOeDpn()."</li>";
                    echo "<li>Longe OE Altura: ".$prescricoes[$i]->getLongeOeAlt()."</li>";
                    
                    echo "<li>Perto OD Esfera:  ".$prescricoes[$i]->getPertoOdEsf()."</li>";
                    echo "<li>Perto OD Cilindro:  ".$prescricoes[$i]->getPertoOdCil()."</li>";
                    echo "<li>Perto OD Eixo:  ".$prescricoes[$i]->getPertoOdEixo()."</li>";
                    echo "<li>Perto OD Dpn:  ".$prescricoes[$i]->getPertoOdDpn()."</li>";
                    echo "<li>Perto OD Altura:  ".$prescricoes[$i]->getPertoOdAlt()."</li>";
                    
                    echo "<li>Perto OE Esfera:  ".$prescricoes[$i]->getPertoOeEsf()."</li>";
                    echo "<li>Perto OE Cilindro:  ".$prescricoes[$i]->getPertoOeCil()."</li>";
                    echo "<li>Perto OE Eixo:  ".$prescricoes[$i]->getPertoOeEixo()."</li>";
                    echo "<li>Perto OE Dpn:  ".$prescricoes[$i]->getPertoOeDpn()."</li>";
                    echo "<li>Perto OE Altura:  ".$prescricoes[$i]->getPertoOeAlt()."</li>";
                    
                    echo "<li>Adição Perto OD: ".$prescricoes[$i]->getAddPertoOD()."</li>";
                    echo "<li>Adição Perto OE:  ".$prescricoes[$i]->getAddPertoOE()."</li>";
                    
                    

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
            echo "        A busca não retornou nenhum registro.";
            echo "</div>";
        }
        //PrescricaoController::excluirPrescricao();
    ?>

<div id="erro-log"></div>
    
<!-- Modal -->
<div id="modal-editar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Prescrição</h4>
        </div>
        <div class="modal-body">
   
    <form role="form" id="form-editar" method="post">
                    <input required name="id" id="id" style="display:none">
                    
                    <div class="row">
                        
                        <div class="col-md-6">
                            
                                <div class="form-group">
                                    <label>Numero da receita</label>
                                    <input required name="num-receita" id="num-receita" class="form-control">
                                </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                                <div class="form-group">
                                    <label>Medico</label>
                                    <input required name="medico" id="medico" class="form-control">
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
                                            <input required name="longe-od-esf" id="longe-od-esf" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="longe-od-cil" id="longe-od-cil" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="longe-od-eixo" id="longe-od-eixo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="longe-od-dpn" id="longe-od-dpn" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="longe-od-alt" id="longe-od-alt" class="form-control">
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
                                            <input required name="longe-oe-esf" id="longe-oe-esf" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="longe-oe-cil" id="longe-oe-cil" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="longe-oe-eixo" id="longe-oe-eixo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="longe-oe-dpn" id="longe-oe-dpn" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="longe-oe-alt" id="longe-oe-alt" class="form-control">
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
                                            <input required name="perto-od-esf" id="perto-od-esf" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="perto-od-cil" id="perto-od-cil" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="perto-od-eixo" id="perto-od-eixo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="perto-od-dpn" id="perto-od-dpn" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="perto-od-alt" id="perto-od-alt" class="form-control">
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
                                            <input required name="perto-oe-esf" id="perto-oe-esf" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="perto-oe-cil" id="perto-oe-cil" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="perto-oe-eixo" id="perto-oe-eixo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="perto-oe-dpn" id="perto-oe-dpn" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required name="perto-oe-alt" id="perto-oe-alt" class="form-control">
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
                    
                   
                    
                    
                    
                    <button type="submit" name="btn-editar" id="btn-editar" class="btn btn-success">Salvar</button>
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





        