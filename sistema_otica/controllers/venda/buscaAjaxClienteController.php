<?php
include_once'../../models/Cliente.php';
include_once'../../models/dao/ClienteDAO.php';
    //echo "<option>entrou</option>";
    $clienteDAO = new ClienteDAO();
    $resultado = $clienteDAO->load("*","");
    //var_dump($resultado);
    if(!empty($resultado)){
        //echo "<option >nenhum fornecedor</option>";
        for($i=0;$i<count($resultado);$i++){
            echo "<option value='".$resultado[$i]->getId()."'>".$resultado[$i]->getNome()."</option>";
        }
    }else{
        echo "<option >nenhum fornecedor</option>";
    }
    
?>