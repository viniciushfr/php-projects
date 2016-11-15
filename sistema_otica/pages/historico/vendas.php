
<script type="text/javascript">
    $(document).ready(function(){
        $.datetimepicker.setLocale('pt');
        jQuery('#busca-venda').datetimepicker({
            timepicker:false,
            format:'Y-m-d'
            
        });
    });
    function buscarVendas(){
        var data = $("#busca-venda").val()
        $.post("../controllers/HistoricoController.php",{"buscar-venda":true,"busca":data},function(retorno){
            //alert(retorno);
            $("#venda-table-body").html(retorno);
        })
    
    }
    function exibirVenda(id){
        window.location.href="sessao.php?page=venda/exibir-venda.php&exibir-venda-id="+id;
    }
</script>
 <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control" id="busca-venda" placeholder="Buscar por data">
      <span class="input-group-btn">
        <div class="btn btn-default" type="button" onclick="buscarVendas()">Buscar</div>
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
    <tbody id="venda-table-body">
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
  