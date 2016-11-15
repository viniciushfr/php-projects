
<?php
include_once'../../models/Produto.php';
include_once'../../models/dao/ProdutoDAO.php';
    //echo "<option>entrou</option>";
    $produtoDAO = new ProdutoDAO();
    $resultado = $produtoDAO->load("*","");
    //var_dump($resultado);
    if(!empty($resultado)){
        //echo "<option >nenhum fornecedor</option>";
        for($i=0;$i<count($resultado);$i++){
            if($resultado[$i]->getQuantidade()==0)
            echo "<option disabled='disabled' value='".$resultado[$i]->getId()."'>".$resultado[$i]->getNome()."/".$resultado[$i]->getMarca()."- R$:".money_format("%.2n",$resultado[$i]->getValorVenda())."</option>";
            //echo "<option disabled='disabled' value='".$resultado[$i]->getId()."'>".$resultado[$i]->getNome()."</option>";
            else
            echo "<option value='".$resultado[$i]->getId()."'>".$resultado[$i]->getNome()."/".$resultado[$i]->getMarca()."- R$:".money_format("%.2n",$resultado[$i]->getValorVenda())."</option>";

            //echo "<option value='".$resultado[$i]->getId()."'>".$resultado[$i]->getNome()."</option>";
        }
    }else{
        echo "<option >nenhum produto</option>";
    }
    
?>