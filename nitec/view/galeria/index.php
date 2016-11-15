
<?php
include_once"../../controllers/ConexaoController.php";
include_once"../template/header.php";
?>
<script type="text/javascript">

</script>
  <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Galeria</h1>
            </div>
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
        </div>
<?php include_once"../template/footer.php"; ?>