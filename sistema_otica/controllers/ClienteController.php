<?php
include_once"../models/Cliente.php";
include_once"../models/dao/ClienteDAO.php";

 
if(isset($_POST["teste"])){
    echo "teste";
}
if(isset($_POST["btn-editar"])){
    echo false;
    //echo "chamou";
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $rg = $_POST["rg"];
    $dataNascimento = $_POST["dataNascimento"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $celular = $_POST["celular"];
    $endereco = $_POST["endereco"];
    $numeroCasa = $_POST["numeroCasa"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
    $cep = $_POST["cep"];
    $uf = $_POST["uf"];
    echo ($id."-".$nome."-".$cpf."-".$rg."-".$dataNascimento."-".$email."-".$telefone."-".$celular."-".$endereco."-".$numeroCasa."-".$bairro."-".$cidade."-".$cep."-".$uf);
    ClienteController::editarCliente($id,$nome,$cpf,$rg,$dataNascimento,$email,$telefone,$celular,$endereco,$numeroCasa,$bairro,$cidade,$cep,$uf);
}
class ClienteController{
    
    public static function buscaCliente(){
         if(isset($_POST['buscarCliente'])){
            //echo "entrou no post buscaCliente <br>";
            $busca = $_POST['busca'];
            $atributo = $_POST['atributo'];
            $add = "WHERE ".$atributo." LIKE "."\"%".$busca."%\"";
            //echo $add ."<br>";
            $obs = "*busca por \"".$busca."\" em ".$atributo;
         }else{
             $obs ="*ultimos 10 registros";
             $add = "ORDER BY id DESC LIMIT 10";
         }
            echo $obs . "<br>";
            $clienteDAO = new ClienteDAO();
            $clientes = $clienteDAO->load("*",$add);
            return $clientes;
    }
    public static function cadastrarCliente(){
        //echo "entrou no metodo cadastrarCliente";
        if(isset($_POST['btnCadastrarCliente'])){
            try {
                //echo "entrou na funcao";
                $novoCliente = new Cliente();
                $novoCliente->setNome($_POST['nome']);
                $novoCliente->setCpf($_POST['cpf']);
                $novoCliente->setRg($_POST['rg']);
                $novoCliente->setDataNascimento($_POST['dataNascimento']);
                $novoCliente->setEmail($_POST['email']);
                $novoCliente->setTelefone($_POST['telefone']);
                $novoCliente->setCelular($_POST['celular']);
                $novoCliente->setEndereco($_POST['endereco']);
                $novoCliente->setNumeroCasa($_POST['numeroCasa']);
                $novoCliente->setBairro($_POST['bairro']);
                $novoCliente->setCidade($_POST['cidade']);
                $novoCliente->setCep($_POST['cep']);
                $novoCliente->setUf($_POST['uf']);
                
                $fields = "nome, cpf, rg, dataNascimento, email, telefone, celular, endereco, numeroCasa, bairro, cidade, cep, uf";
                $params = array($novoCliente->getNome(),
                                $novoCliente->getCpf(),
                                $novoCliente->getRg(),
                                $novoCliente->getDataNascimento(),
                                $novoCliente->getEmail(),
                                $novoCliente->getTelefone(),
                                $novoCliente->getCelular(),
                                $novoCliente->getEndereco(),
                                $novoCliente->getNumeroCasa(),
                                $novoCliente->getBairro(),
                                $novoCliente->getCidade(),
                                $novoCliente->getCep(),
                                $novoCliente->getUf()
                                );
                $ClienteDAO = new ClienteDAO();
                if(!empty($ClienteDAO->insert($fields, $params))){
                    
                    echo "<div class='alert alert-success' style='margin:10px;'><strong>SUCESSO:</strong> Cliente cadastrado com sucesso!</div>";
                }else{
                    throw new Exception("Não foi possivel cadastrar!");
                }   
                    
            }catch(Exception $e){
                echo "<div class='alert alert-danger' style='margin:10px;'><strong>ERROR:</strong> ".$e->getMessage()."</div>";
            }
        }
    }
    public static function excluirCliente(){
       // echo "excluirCliente<br>";
        if(isset($_POST['btnExcluirClienteId'])){
            //echo "brnExluir<br>";
            $id=$_POST['id'];
            //echo "excluir id: ".$id."<br>";
            $clienteDAO = new ClienteDAO();
            $where = "id = ".$id;
            $clienteDAO->delete($where,null);
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
        }
    }
    public static function editarCliente($id,$nome,$cpf,$rg,$dataNascimento,$email,$telefone,$celular,$endereco,$numeroCasa,$bairro,$cidade,$cep,$uf){
        $clienteDAO = new ClienteDAO();
        $fields = array("nome","cpf","rg","dataNascimento","email","telefone","celular","endereco","numeroCasa","bairro","cidade","cep","uf");
        $parans = array($nome,$cpf,$rg,$dataNascimento,$email,$telefone,$celular,$endereco,$numeroCasa,$bairro,$cidade,$cep,$uf);
        $where = "id = $id";
        if($clienteDAO->update($fields,$parans,$where)){
            echo true;
        }else{
            echo false;
        }
        
    }
}



?>