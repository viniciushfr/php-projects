<?php
$albumId = $_GET['id'];
?>
<?php
include_once"../../controllers/ConexaoController.php";
include_once"../template/header.php";
?>
<script type="text/javascript">
$(document).ready(function(){
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