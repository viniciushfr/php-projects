<?php
include_once"../../controllers/ConexaoController.php";
?>

<script type="text/javascript">

    $(document).ready(function(){
       
        $("#select-album").select2({
            theme : "bootstrap",
            placeholder: "Selecione o album",
            
        });
        $("#imagens").fileinput({
        language:'br',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions : ['jpg', 'png','gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        allowedFileTypes: ['image' ],
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
	});
        $("form#data").on('submit', function (event) {
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
                    uploadProgress: function(event, position, total, percentComplete) {
                        $('progress').attr('value',percentComplete);
                        $('#porcentagem').html(percentComplete+'%');
                    },
                    success: function (response) {
                        alert(response);
                        if(response == "success"){
                            
                            $("#results").addClass("alert alert-info");
                            $("#results").html("Upload de imagens concluido!");
                            $("form#data").reset();
                        }else{
                            $("#results").html(response);
                        }
                        
                    }
        });
        
        return false;
        });
    });
    function novoAlbum(){
        var nome = $("#nome-album").val();
        $.post("../../controllers/GerenciaController.php",{"novo-album":true,"nome-album":nome},function(retorno){
            window.location.reload();
        });
    }

</script>
<div class="row">
    <?php
        $banco = conectarAoBanco();
        $sql = "SELECT * FROM `album`";
        $query = $banco->query($sql);
        while ($dados = $query->fetch_array()) {
    ?>   
    <div class="col-lg-2 col-md-2 col-xs-6 thumb">
        <a class="thumbnail text-center" href="album.php?id=<?=$dados['id']?>">
            <img  src="../../resources/img/folder_icon_light_blue.png"/>
            <label for=""><?=$dados['nome']?></label>
            
        </a>
    </div>
    <?php } ?>
    <div class="btn btn-info" data-toggle="modal" data-target="#modal-novo-album">Novo Album</div>
</div>

 
<div id="modal-novo-album" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Novo Album</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome-album"/>
        </div>
        
        <div class="btn btn-primary" onclick="novoAlbum()">Criar</div>
      </div>
      
    </div>

  </div>
</div>