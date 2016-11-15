<?php
include_once"../../controllers/ConexaoController.php";
?>

<?php
$albumId = $_GET['id'];
?>
<?php
include_once"../../controllers/ConexaoController.php";
include_once"../template/header.php";
?>
<script type="text/javascript">
$(document).ready(function(){
  
       
        
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
        alert($("#select-album").val());
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
                        //alert(response);
                        if(response.indexOf("success")>=0){
                            window.location.reload();
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
   
    $(".lighterbox").lighterbox({ overlayColor : "white" });
});
</script>
  <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?php
                    $banco = conectarAoBanco();
                    $sql = "SELECT * FROM `album` WHERE `id` =  $albumId LIMIT 1";
                    $query = $banco->query($sql);
                    echo $query->fetch_array()['nome'];
                    ?>
                </h1>
            </div>
            <div class="btn btn-success" data-toggle="modal" data-target="#modal-inserir-imagens" style="margin-bottom:20px" >
            Inserir fotos</div>
            <article>
                <?php
                    $banco = conectarAoBanco();
                    $sql = "SELECT * FROM `imagem` WHERE `album_id` =  $albumId";
                    $query = $banco->query($sql);
                    while ($dados = $query->fetch_array()) {
                ?>   
                <section>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a href="<?="../..".$dados["diretorio"].$dados["nome"]?>" class="lighterbox thumbnail">
                            <img src="<?="../..".$dados["diretorio"].$dados["nome"]?>" />
                            <h2 class="lighterbox-title"><?=$dados['nome']?></h2>
                            <span class="lighterbox-desc"><?=$dados['descricao']?></span>
                        </a>
                    </div>
                </section>
                <?php } ?>
                
            </article>
        </div>
<?php include_once"../template/footer.php"; ?>

<div id="modal-inserir-imagens" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Inserir Imagens</h4>
      </div>
      <div class="modal-body">
        
                <form id="data" method="post" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Album</label>
                        <input type="text" class="form-control"  name="select-album" value="<?=$albumId ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="">Imagens</label>
                        <input class="file" data-show-upload="false" data-show-preview="false" data-min-file-count="1" show-uploaded-thumbs="false" id="imagens" name="imagens[]" type="file" multiple/>
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
</div>