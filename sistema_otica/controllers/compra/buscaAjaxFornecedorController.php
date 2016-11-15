
<?php
include_once'../../models/Fornecedor.php';
include_once'../../models/dao/FornecedorDAO.php';
    //echo "<option>entrou</option>";
    $fornecedorDAO = new FornecedorDAO();
    $resultado = $fornecedorDAO->load("*","");
    //var_dump($resultado);
    if(!empty($resultado)){
        //echo "<option >nenhum fornecedor</option>";
        for($i=0;$i<count($resultado);$i++){
            echo "<option value='".$resultado[$i]->getId()."'>".$resultado[$i]->getIdentificacao()."</option>";
        }
    }else{
        echo "<option >nenhum fornecedor</option>";
    }
    
?>