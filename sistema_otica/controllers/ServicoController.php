<?php
include_once"../models/Servico.php";
include_once"../models/dao/ServicoDAO.php";

class ServicoController{
     public static function cadastrarServico(){
         //echo "entrou no metodo cadastrarProduto";
        if(isset($_POST['btnCadastrarServico'])){
            try {

                //var_dump($novoProduto);
               
                $params = array(null,
                                $_POST['nome'],
                                $_POST['descricao'],
                                $_POST['valor']
                                );
                $servicoDAO = new ServicoDAO();
                if(!empty($servicoDAO->insert("", $params))){
                    
                    echo "<div class='alert alert-success' style='margin:10px;'>Servico cadastrado com sucesso!</div>";
                }else{
                    throw new Exception("Não foi possivel cadastrar!");
                }   
                    
            }catch(Exception $e){
                echo "<div class='alert alert-danger' style='margin:10px;'><strong>ERROR:</strong> ".$e->getMessage()."</div>";
            }
        }
    }
}
?>