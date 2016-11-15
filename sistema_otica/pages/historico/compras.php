
<script type="text/javascript">
    $(document).ready(function(){
        $.datetimepicker.setLocale('pt');
        jQuery('#busca-compra').datetimepicker({
            timepicker:false,
            format:'Y-m-d'
            
        });
    });
    function buscarCompras(){
        var data = $("#busca-compra").val();
        $.post("../controllers/HistoricoController.php",{"buscar-compra":true,"busca":data},function(retorno){
            //alert(retorno);
            $("#compra-table-body").html(retorno);
        })
    }
    function exibirCompra(id){
        window.location.href="sessao.php?page=compra/exibir-compra.php&exibir-compra-id="+id;
    }
</script>
</script>
 <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control" id="busca-compra" placeholder="Buscar por data">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="buscarCompras()">Buscar</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <div class="alert"></div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Data</th>
        <th>Valor</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="compra-table-body">
      <td colspan="3" class="info">
        Selecione a data acima, deixe em branco para recuperar todos
      </tr>
    </tbody>
  </table>
  
  
  
<div class="panel">
    <div class="panel-body">
         <a href="historico/relatorio.php"  class="btn btn-info pull-right btn-lg">Gerar relatório</a>
    </div>
</div>
  
  
  
  
  