<?php
    include_once"models/Admin.php";
    
    if(isset($_POST['btnLogin'])){
    try {
        
        $admin = new Admin();
        //print_r($_POST);
        $admin->setLogin($_POST['login']);
        if(empty($admin->getLogin())){
            throw new Exception("Campo usuario vazio!");
        }
        $admin->setSenha($_POST['password']);
        if(empty($admin->getSenha())){
            throw new Exception("Campo senha vazio!");
        }
        //print_r($usuario);
        if (verificarLogin($admin)) {
            header("Location: pages/sessao.php");
        } else {
            echo "</br>";
            throw new Exception("Login ou senha invalidos!");
        }
    }catch (Exception $e){
        echo "<div class='alert alert-danger' style='margin:10px;'><strong>ERROR: </strong>".$e->getMessage()."</div>";
    }

}
function verificarLogin($admin){
    if($admin->getLogin() == "admin" && $admin->getSenha() == "admin"){
        session_start();
        $_SESSION['logado'] = true;
        return true;
    }else{
        $_SESSION['logado'] = false;
        return false;
    }
    
}
?>