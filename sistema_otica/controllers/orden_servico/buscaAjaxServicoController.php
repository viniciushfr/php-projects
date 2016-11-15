
<?php
include_once'../../models/Servico.php';
include_once'../../models/dao/ServicoDAO.php';
    //echo "<option>entrou</option>";
    $servicoDAO = new ServicoDAO();
    $resultado = $servicoDAO->load("*","");
    //var_dump($resultado);
    if(!empty($resultado)){
        //echo "<option >nenhum fornecedor</option>";
        for($i=0;$i<count($resultado);$i++){
           
            echo "<option value='".$resultado[$i]->getId()."'>".$resultado[$i]->getNome()." - R$: ".money_format("%.2n",$resultado[$i]->getValor())."</option>";
        }
    }else{
        echo "<option >nenhum servico cadastrado</option>";
    }
    
?>