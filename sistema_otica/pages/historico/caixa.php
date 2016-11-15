<script type="text/javascript">
    $(document).ready(function(){
        $.datetimepicker.setLocale('pt');
        jQuery('#busca-caixa').datetimepicker({
            timepicker:false,
            format:'Y-m-d'
            
        });
    });
    function buscarCaixa(){
        var data = $("#busca-caixa").val();
        $.post("../controllers/HistoricoController.php",{"buscar-caixa":true,"busca":data},function(retorno){
            //alert(retorno);
            $("#caixa-table-body").html(retorno);
        })
    }
    function exibirCaixa(id){
        window.location.href="sessao.php?page=historico/exibir_caixa.php&exibir-caixa-id="+id;
    }
</script>
</script>
 <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control" id="busca-caixa" placeholder="Buscar por data">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="buscarCaixa()">Buscar</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  
  <div class="alert"></div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Numero</th>
        <th>Abertura</th>
        <th>Fechamento</th>
        <th>Valor</th>
      </tr>
    </thead>
    <tbody id="caixa-table-body">
      <td colspan="4" class="info">
        Selecione a data acima, deixe em branco para recuperar todos
      </tr>
    </tbody>
  </table>
  