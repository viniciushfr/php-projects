<?php
include_once"../../controllers/ConexaoController.php";
include_once"../template/header.php"; 
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

</script>

    <div class="col-lg-12">
        <h1 class="page-header">Gerencia</h1>
    </div>

<div class="col-md-12 row">
    <div class="tabbable" id="tabs-160309">
				<ul class="nav nav-tabs">
					<li >
						<a href="#panel-1" data-toggle="tab">Galeria</a>
					</li>
					<li class="active">
						<a href="#panel-2" data-toggle="tab">Trabalhos</a>
					</li>
					<li>
						<a href="#panel-3" data-toggle="tab">Publicacoes</a>
					</li>
					<li>
						<a href="#panel-4" data-toggle="tab">#</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane " id="panel-1">
						<p>
							<?php include_once"galeria.php"; ?>
						</p>
					</div>
					<div class="tab-pane active" id="panel-2">
						<p>
						    <?php include_once"trabalhos.php"; ?>
							
						</p>
					</div>
					<div class="tab-pane" id="panel-3">
						<p>
							<div class="alert alert-info">Aguardando implementação</div>
						</p>
					</div>
					<div class="tab-pane" id="panel-4">
						<p>
							<div class="alert alert-info">Função em aberto</div>
						</p>
					</div>
				</div>
			</div>
    
   
</div>

</body>
</html>
 
<?php
/*
   if(isset($_FILES['fileUpload']))
   {
 
      $dir = '../../resources/img/'; //Diretório para uploads
     for($i = 0; $i < count($_FILES['fileUpload']['tmp_name']); $i++) //passa por todos os arquivos
      {
      move_uploaded_file($_FILES['fileUpload']['tmp_name'][$i], $dir.$_FILES['fileUpload']['name'][$i]); //Fazer upload do arquivo
      }
   }
   */
?>
  
  <?php include_once"../template/header.php";?>