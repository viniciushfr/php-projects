<?php
    include_once '../models/dao/ProdutoDAO.php';
    include_once '../models/Produto.php';
    include_once '../controllers/ProdutoController.php';
    session_start();
    $_SESSION["relatorioEstoque"]="";
?>
<script type="text/javascript">
    $(document).ready(function(){
       
        $("#form-editar").on('submit', function (e) {
            //alert("salvar");
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../controllers/ProdutoController.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        //alert(response);
                        if(response){
                            //alert(response);
                            $("#erro-log").addClass("alert alert-success");
                            $("#erro-log").html("Produto Salvo");
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

    function preencherFormulario(id,codigoBarra,descricao,grupoEstoque,marca,modelo,unidade,quantidade,valor,estoqueMinimo,valorVenda,nome){
        //alert (id+","+codigoBarra+","+descricao+","+grupoEstoque+", "+marca+","+modelo+", "+unidade+","+quantidade+","+valor+","+estoqueMinimo+","+valorVenda+","+nome);
        //alert(nome);
        $("#id").val(id);
        $("#codigoBarra").val(codigoBarra);
        $("#descricao").val(descricao);
        $("#grupoEstoque").val(grupoEstoque);
        $("#marca").val(marca);
        $("#modelo").val(modelo);
        $("#unidade").val(unidade);
        $("#quantidade").val(quantidade);
        $("#valor").val(valor);
        $("#estoqueMinimo").val(estoqueMinimo);
        $("#valorVenda").val(valorVenda);
        $("#nome").val(nome);
        
        
    }
</script>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Consulta de produtos</h2>
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
                    <option>marca</option>
                    <option>modelo</option>
                    <option>descricao</option>
                </select>
            </div>
            <button name="buscarProduto" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        </form>
    </div>    
    <?php
        $produtos = ProdutoController::buscaProduto();
        if(!empty($produtos)){
            $html = "";        
            //Imprime tabela
            echo "<table class=\"table table-condensed table-hover table-bordered\">";
            $html.= "<table class=\"table table-bordered\">";
                echo "<thead>";
                $html.= "<thead>";
                echo "    <tr>";
                $html.= "    <tr>";
                echo "        <th>Marca</th>";
                $html.="        <th>Marca</th>";
                echo "        <th>Modelo</th>";
                $html.= "        <th>Modelo</th>";
                echo "        <th>Preço</th>";
                $html.="        <th>Preço</th>";
                echo "        <th>Quantidade</th>";
                $html.= "        <th>Quantidade</th>";
                echo "        <th></th>";
                echo "        <th></th>";
                echo "    </tr>";
                $html.="    </tr>";
                echo "</thead>";
                $html.= "</thead>";
                echo "<tbody>";
                $html.="<tbody>";
                for($i =0;$i < count($produtos);$i++){
                    echo "<tr >";
                    $html.= "<tr >";
                    echo "<td  onclick=\"hide_show('".$i."')\">". $produtos[$i]->getMarca(). "</td>";
                    $html.= "<td  onclick=\"hide_show('".$i."')\">". $produtos[$i]->getMarca(). "</td>";
                    echo "<td  onclick=\"hide_show('".$i."')\">". $produtos[$i]->getModelo(). "</td>";
                    $html.="<td  onclick=\"hide_show('".$i."')\">". $produtos[$i]->getModelo(). "</td>";
                    echo "<td  onclick=\"hide_show('".$i."')\"> R$: ". money_format("%.2n",$produtos[$i]->getValor()). "</td>";
                    $html.=  "<td  onclick=\"hide_show('".$i."')\">R$: ".money_format("%.2n",$produtos[$i]->getValor()). "</td>";
                    echo "<td  onclick=\"hide_show('".$i."')\">". $produtos[$i]->getQuantidade(). "</td>";
                    $html.= "<td  onclick=\"hide_show('".$i."')\">". $produtos[$i]->getQuantidade(). "</td>";
                    echo "<td>
                            <form method=\"post\">
                                <input hidden=\"hidden\" name=\"id\" value=\"".$produtos[$i]->getId()."\">
                                <button name=\"btnExcluirProdutoId\"  type=\"submit\" class=\"btn btn-danger btn-circle\">
                                    <span class=\"fa fa-times\"></span>
                                </button>
                            </form>
                            </td>";
                     echo "<td>
                            <div name=\"btn-editar\" data-target='#modal-editar'   data-toggle='modal' class=\"btn btn-warning btn-circle\"
                            onclick=\"preencherFormulario(
                            '".$produtos[$i]->getId()."',
                            '".$produtos[$i]->getCodigoBarra()."',
                            '".$produtos[$i]->getDescricao()."',
                            '".$produtos[$i]->getGrupoEstoque()."',
                            '".$produtos[$i]->getMarca()."',
                            '".$produtos[$i]->getModelo()."',
                            '".$produtos[$i]->getUnidade()."',
                            '".$produtos[$i]->getQuantidade()."',
                            '".money_format("%.2n",$produtos[$i]->getValor())."',
                            '".$produtos[$i]->getEstoqueMinimo()."',
                            '".money_format("%.2n",$produtos[$i]->getValorVenda())."',
                            '".$produtos[$i]->getNome()."'
                            )\"
                            >
                                <span class=\"fa fa-pencil\"></span>
                            </div>";
                    echo "</td>";
                    echo "</tr>";
                     echo "<tr id='$i' style='display: none' >";
                    echo "<td colspan='6' style='width: 100%'>";
                    echo "<div  class=\"\">";
                    echo "<div class=\"well\">";
                    echo "<li>nome:  ".$produtos[$i]->getNome()."</li>";
                    echo "<li>codigo barra:  ".$produtos[$i]->getCodigoBarra()."</li>";
                    echo "<li>grupo estoque:  ".$produtos[$i]->getGrupoEstoque()."</li>";
                    echo "<li>marca:  ".$produtos[$i]->getMarca()."</li>";
                    echo "<li>modelo:  ".$produtos[$i]->getModelo()."</li>";
                    echo "<li>unidade:  ".$produtos[$i]->getUnidade()."</li>";
                    echo "<li>quantidade:  ".$produtos[$i]->getQuantidade()."</li>";
                    echo "<li>valor de compra:  ".$produtos[$i]->getValor()."</li>";
                    echo "<li>estoque minimo:  ".$produtos[$i]->getEstoqueMinimo()."</li>";
                    echo "<li>grupo estoque:  ".$produtos[$i]->getGrupoEstoque()."</li>";
                    echo "<li>valor de venda:  ".$produtos[$i]->getValorVenda()."</li>";
                    echo "<li>descrição:  ".$produtos[$i]->getDescricao()."</li>";
                    
                    echo "</div>";
                    echo "</div>";
                    echo "</td>";
                    echo "<tr>";
                    $html.= "<tr>";
                }
                echo "</tbody>";
                $html.= "</tbody>";
                echo "</table>";
                 $html.= "</table>";
                session_start();
                $_SESSION["relatorioEstoque"]=$html;
        }else{
            //mensagem de erro
            echo "<div class=\"alert alert-info\" role=\"alert\">";
            echo "        A busca nao retornou nenhum registro.";
            echo "</div>";
        }
        ProdutoController::excluirProduto();
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
   
            formulario  
            <form role="form" id="form-editar" name="form-editar" method="post">
                    <div class="form-group">
                        <input name="id" id="id" hidden="hidden">
                        <label>Nome</label>
                        <input required name="nome" id="nome" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Codigo barra</label>
                                <input required name="codigoBarra" id="codigoBarra" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Marca</label>
                                <input required name="marca" id="marca" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Modelo</label>
                                <input required name="modelo" id="modelo" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Grupo no Estoque</label>
                                <input required name="grupoEstoque" id="grupoEstoque" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Unidade</label>
                                <input required name="unidade" id="unidade" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Quantidade</label>
                                <input type="number" id="quantidade"  name="quantidade" min="0" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Compra</label>
                                <input required name="valor" id="valor" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Venda</label>
                                <input required name="valorVenda" id="valorVenda" class="form-control">
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea id="descricao" name="descricao" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" id="btn-editar" name="btn-editar" class="btn btn-success">Salvar</button>
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

<div class="panel">
    <div class="panel-body">
         <a href="consulta/relatorio.php"  class="btn btn-info pull-right btn-lg">Gerar relatorio</a>
    </div>
</div>
   
