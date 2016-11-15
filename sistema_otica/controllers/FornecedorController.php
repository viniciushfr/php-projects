<?php
include_once"../models/Fornecedor.php";
include_once"../models/dao/FornecedorDAO.php";
 

if(isset($_POST["btn-editar"])){
    echo "botao editar";
    
    echo false;
    echo "chamou";
    echo "entrou";
    $id = $_POST["id"];
    $identificacao = $_POST["identificacao"];
    $cnpj = $_POST["cnpj"];
    $inscEstadual = $_POST["inscEstadual"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $celular = $_POST["celular"];
    $site = $_POST["site"];
    $endereco = $_POST["endereco"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
    $cep = $_POST["cep"];
    $uf = $_POST["uf"];
    echo ('ID'.$id."-".$identificacao."-".$cnpj."-".$inscEstadual."-".$email."-".$telefone."-".$celular."-".$site."-".$endereco."-".$numero."-".$bairro."-".$cidade."-".$cep."-".$uf);
    FornecedorController::editarFornecedor($id,$identificacao,$cnpj,$inscEstadual,$email,$telefone,$celular,$site,$endereco,$numero,$bairro,$cidade,$cep,$uf);

}

class FornecedorController{
    public static function buscaFornecedor(){
        // "buscarFornecedor<br>";
        if(isset($_POST['buscarFornecedor'])){
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
            $fornecedorDAO = new FornecedorDAO();
            $fornecedores = $fornecedorDAO->load("*",$add);
            return $fornecedores;
    }
    public static function cadastrarFornecedor(){
        //echo "entrou no metodo cadastrarFornecedor";
        if(isset($_POST['btnCadastrarFornecedor'])){
            try {
                //echo "entrou na funcao";
                $novoFornecedor = new Fornecedor();
                $novoFornecedor->setIdentificacao($_POST['identificacao']);
                $novoFornecedor->setCnpj($_POST['cnpj']);
                $novoFornecedor->setInscEstadual($_POST['inscEstadual']);
                $novoFornecedor->setEmail($_POST['email']);
                $novoFornecedor->setTelefone($_POST['telefone']);
                $novoFornecedor->setCelular($_POST['celular']);
                $novoFornecedor->setSite($_POST['site']);
                $novoFornecedor->setEndereco($_POST['endereco']);
                $novoFornecedor->setNumero($_POST['numero']);
                $novoFornecedor->setBairro($_POST['bairro']);
                $novoFornecedor->setCidade($_POST['cidade']);
                $novoFornecedor->setCep($_POST['cep']);
                $novoFornecedor->setUf($_POST['uf']);
                
                $fields = "identificacao, cnpj, inscEstadual, email, telefone, celular,site, endereco, numero, bairro, cidade, cep, uf";
                $params = array($novoFornecedor->getIdentificacao(),
                                $novoFornecedor->getCnpj(),
                                $novoFornecedor->getInscEstadual(),
                                $novoFornecedor->getEmail(),
                                $novoFornecedor->getTelefone(),
                                $novoFornecedor->getCelular(),
                                $novoFornecedor->getSite(),
                                $novoFornecedor->getEndereco(),
                                $novoFornecedor->getNumero(),
                                $novoFornecedor->getBairro(),
                                $novoFornecedor->getCidade(),
                                $novoFornecedor->getCep(),
                                $novoFornecedor->getUf()
                                );
                $fornecedorDAO = new FornecedorDAO();
                if(!empty($fornecedorDAO->insert($fields, $params))){
                    
                    echo "<div class='alert alert-success' style='margin:10px;'> Fornecedor cadastrado com sucesso!</div>";
                }else{
                    throw new Exception("Não foi possivel cadastrar!");
                }   
                    
            }catch(Exception $e){
                echo "<div class='alert alert-danger' style='margin:10px;'><strong>ERROR:</strong> ".$e->getMessage()."</div>";
            }
        }
    }
    public static function excluirFornecedor(){
        //echo "excluirFornecedor<br>";
        if(isset($_POST['btnExcluirFornecedorId'])){
            //echo "brnExluir<br>";
            $id=$_POST['id'];
            //echo "excluir id: ".$id."<br>";
            $fornecedorDAO = new FornecedorDAO();
            $where = "id = ".$id;
            $fornecedorDAO->delete($where,null);
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
        }
    }
    public static function editarFornecedor($id,$identificacao,$cnpj,$inscEstadual,$email,$telefone,$celular,$site,$endereco,$numero,$bairro,$cidade,$cep,$uf){
        $fornecedorDAO = new FornecedorDAO();
        $fields = array("identificacao","cnpj","inscEstadual","email","telefone","celular","site","endereco","numero","bairro","cidade","cep","uf");
        $parans = array($identificacao,$cnpj,$inscEstadual,$email,$telefone,$celular,$site,$endereco,$numero,$bairro,$cidade,$cep,$uf);
        $where = "id = $id";
        if($fornecedorDAO->update($fields,$parans,$where)){
            echo true;
        }else{
            echo false;
        }
        
    }
}
?>