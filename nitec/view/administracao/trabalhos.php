
<?php
include_once"../../controllers/ConexaoController.php";
?>




<script type="text/javascript">
$(document).ready(function(){
  
       
        
        $("#trabalho").fileinput({
        language:'br',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions : ['pdf', 'doc','xdoc'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        allowedFileTypes: ['document' ],
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
	});
        $("form#datatrabalho").on('submit', function (event) {
        
        event.preventDefault();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    console.log(percentComplete);
                    //$("#porcentagem").html(percentComplete);
                    $('.progress-bar').css('width', percentComplete+'%').attr('aria-valuenow', percentComplete); 
                    
                  }
                }, false);
                return xhr;
              },
                    type: "POST",
                    url: "../../controllers/GerenciaController.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        //alert(response);
                        if(response.indexOf("success")>=0){
                            window.location.reload();
                            $("#results").addClass("alert alert-info");
                            $("#results").html("Upload do trabalho concluido!");
                            $("form#data").reset();
                            
                        }else{
                            $("#results").html(response);
                        }
                        
                    }
        });
        
        return false;
        });

});
</script>



<div class="btn btn-primary" data-toggle="modal" data-target="#modal-inserir-trabalho">Enviar trabalho</div>

 <table class="table table-responsive">
    <thead>
      <tr>
        <th>Titulo</th>
        <th>Autor</th>
        <th>Data</th>
        <th>Categoria</th>
        <th>Descrição</th>
      </tr>
    </thead>
    <tbody>
 <?php
    $banco = conectarAoBanco();
    $sql = "SELECT * FROM `trabalhos`";
    $query = $banco->query($sql);
    while ($dados = $query->fetch_array()) {
    ?>   
    <tr>
        <td><a href="../../<?=$dados['url'].$dados['nome']?>"><?=$dados['nome']?></a></td>
        <td><?=$dados['autor']?></td>
        <td><?=$dados['data']?></td>
        <td><?=$dados['tipo']?></td>
        <td><?=$dados['descricao']?></td>
    </tr>
  
    <?php } ?>
 </tbody>
</table>






<div id="modal-inserir-trabalho" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Enviar Trabalho</h4>
      </div>
    <div class="modal-body">
        <form id="datatrabalho" method="post" class="form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Categoria</label>
                <select class="form-control" name="categoria" id="categoria">
                    <option>Eventos</option>
                    <option>Periodicos</option>
                    <option>Teses</option>
                    <option>Entrevistas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Trabalho</label>
                <input class="file" data-show-upload="false" data-show-preview="false" data-min-file-count="1" show-uploaded-thumbs="false" id="trabalho" name="trabalho" type="file" />
            </div>
            <div class="form-group">
                <label for="">Autor</label>
                <input type="text" name="autor" id="autor" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="">Data</label>
                <input type="date" name="data" id="data" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="">Descrição</label>
                <textarea class="form-control" rows="5" id="descricao" name="descricao"></textarea>
            </div>
            <div class="form-group">
                <button class="form-control btn btn-default">Enviar</button>
            </div>
        </form>
        <div class="progress" style="margin-top:20px">
          <div class="progress-bar  progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
        </div>
        <div id="results"></div>
        </div>
    </div>
      
</div>

  </div>