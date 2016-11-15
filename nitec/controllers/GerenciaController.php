<?php
include_once"ConexaoController.php";
//echo "fkjdnvknsdkfn";
if(isset($_FILES['imagens'])){
    //echo "entrou funcao";
    //print_r($_FILES);
    $descricao = $_POST['descricao'];
    //echo $descricao;
    $album = $_POST['select-album'];
    //echo $album;
    uploadImagens($_FILES['imagens'],$descricao,$album);
}
if(isset($_POST['novo-album'])){
    novoAlbum($_POST["nome-album"]);
}
if(isset($_FILES['trabalho'])){
    $trabalho = $_FILES['trabalho'];
    $autor = $_POST['autor'];
    $data = $_POST['data'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    echo $trabalho ."  ".$autor."    ".$data."   ".$descricao;
    uploadTrabalhos($trabalho,$autor,$data,$descricao,$categoria);
}
function uploadTrabalhos($trabalho,$autor,$data, $descricao,$categoria){
    $dir = '../resources/trabalhos/';

        $erro = move_uploaded_file($trabalho['tmp_name'], $dir.$trabalho['name']);
        //echo $erro;
        if($erro){
            $banco = conectarAoBanco();
            $data = new DateTime();
            $sql = "INSERT INTO trabalhos VALUES(null,'/resources/trabalhos/','".$trabalho['name']."','$autor','".$data->format("Y-m-d")."','$descricao','$categoria')";
            $query = $banco->query($sql);
        }
    
    if($erro){
        if($query)
        echo "success";
        else
        echo "erro";
    }else{
        echo "erro";
    }

}
function uploadImagens($imagens,$descricao,$album){
    $dir = '../resources/img/';
    //print_r($imagens);
   // echo $descricao. " ". $album;
    for($i = 0; $i < count($imagens['tmp_name']); $i++){
        //echo "tem imagem";
        $erro = move_uploaded_file($imagens['tmp_name'][$i], $dir.$imagens['name'][$i]);
        //echo $erro;
        if($erro){
            $banco = conectarAoBanco();
            $data = new DateTime();
            $sql = "INSERT INTO imagem VALUES(null,'".$imagens["name"][$i]."','$descricao','".$data->format("Y-m-d")."','/resources/img/','$album')";
            $query = $banco->query($sql);
            //echo $query;
        }
    }
    if($erro){
        if($query)
        echo "success";
        else
        echo "erro";
    }else{
        echo "erro";
    }
    //echo "imagens carregadas";
}

function novoAlbum($nome){
    $banco = conectarAoBanco();
    $sql = "INSERT INTO album VALUES(null,'$nome')";
            $query = $banco->query($sql);
    if($query)echo "success";
    else echo "error";
}
?>