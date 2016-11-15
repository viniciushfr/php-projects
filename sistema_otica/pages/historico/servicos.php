
<script type="text/javascript">
    $(document).ready(function(){
        $.datetimepicker.setLocale('pt');
        jQuery('#busca-servico').datetimepicker({
            timepicker:false,
            format:'Y-m-d'
            
        });
    });
    function buscarServicos(){
        var data = $("#busca-servico").val();
        $.post("../controllers/HistoricoController.php",{"buscar-servico":true,"busca":data},function(retorno){
            //alert(retorno);
            $("#servico-table-body").html(retorno);
        })
    
    }
    
    function exibirServico(id){
        window.location.href="sessao.php?page=orden_servico/exibir-orden-servico.php&exibir-servico-id="+id;
    }
</script>
</script>
 <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control" id="busca-servico" placeholder="Buscar por data">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="buscarServicos()">Buscar</button>
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
    <tbody id="servico-table-body">
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
  