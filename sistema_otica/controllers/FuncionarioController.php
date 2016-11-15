
<?php
include_once"../models/Funcionario.php";
include_once"../models/dao/FuncionarioDAO.php";
if(isset($_POST["btn-editar"])){
    echo "botao editar";
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $rg = $_POST["rg"];
    $ctps = $_POST["ctps"];
    $serie = $_POST["serie"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $celular = $_POST["celular"];
    $dataEmissao = $_POST["dataEmissao"];
    $funcao = $_POST["funcao"];
    $salarioInicial = $_POST["salarioInicial"];
    $horasTrabalho = $_POST["horasTrabalho"];
    $situacaoCivil = $_POST["situacaoCivil"];
    $conjuge = $_POST["conjuge"];
    $dependentes = $_POST["dependentes"];
    $endereco = $_POST["endereco"];
    $numeroCasa = $_POST["numeroCasa"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
    $cep = $_POST["cep"];
    $uf = $_POST["uf"];
    FuncionarioController::editarFuncionario($id,$nome,$cpf,$rg,$ctps,$serie,$email,$telefone,$celular,$dataEmissao,$funcao,$salarioInicial,$horasTrabalho,$situacaoCivil,$conjuge,$dependentes,$endereco,$numeroCasa,$bairro,$cidade,$cep,$uf);
    
}
class FuncionarioController{
    public static function buscaFuncionario(){
        
        if(isset($_POST['buscarFuncionario'])){
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
        $funcionarioDAO = new FuncionarioDAO();
        $funcionarios = $funcionarioDAO->load("*",$add);
        return $funcionarios;
       
    }
    public static function cadastrarFuncionario(){
        //echo "entrou no metodo cadastrarFornecedor";
        if(isset($_POST['btnCadastrarFuncionario'])){
            try {
                //echo "entrou na funcao";
                $novoFuncionario = new Funcionario();
                $novoFuncionario->setNome($_POST['nome']);
                $novoFuncionario->setCpf($_POST['cpf']);
                $novoFuncionario->setRg($_POST['rg']);
                $novoFuncionario->setCtps($_POST['ctps']);
                $novoFuncionario->setSerie($_POST['serie']);
                $novoFuncionario->setEmail($_POST['email']);
                $novoFuncionario->setTelefone($_POST['telefone']);
                $novoFuncionario->setCelular($_POST['celular']);
                $novoFuncionario->setDataEmissao($_POST['dataEmissao']);
                $novoFuncionario->setFuncao($_POST['funcao']);
                $novoFuncionario->setSalarioInicial($_POST['salarioInicial']);
                $novoFuncionario->setHorasTrabalho($_POST['horasTrabalho']);
                $novoFuncionario->setSituacaoCivil($_POST['situacaoCivil']);
                $novoFuncionario->setConjuge($_POST['conjuge']);
                $novoFuncionario->setDependentes($_POST['dependentes']);
                $novoFuncionario->setEndereco($_POST['endereco']);
                $novoFuncionario->setNumeroCasa($_POST['numeroCasa']);
                $novoFuncionario->setBairro($_POST['bairro']);
                $novoFuncionario->setCidade($_POST['cidade']);
                $novoFuncionario->setCep($_POST['cep']);
                $novoFuncionario->setUf($_POST['uf']);
                
                $fields = "nome,
                            cpf, 
                            rg, 
                            ctps, 
                            serie,
                            email, 
                            telefone, 
                            celular, 
                            dataEmissao, 
                            funcao, 
                            salarioInicial, 
                            horasTrabalho, 
                            situacaoCivil, 
                            conjuge, 
                            dependentes, 
                            endereco, 
                            numeroCasa, 
                            bairro, 
                            cidade, 
                            cep, 
                            uf";
                $params = array($novoFuncionario->getNome(),
                                $novoFuncionario->getCpf(),
                                $novoFuncionario->getRg(),
                                $novoFuncionario->getCtps(),
                                $novoFuncionario->getSerie(),
                                $novoFuncionario->getEmail(),
                                $novoFuncionario->getTelefone(),
                                $novoFuncionario->getCelular(),
                                $novoFuncionario->getDataEmissao(),
                                $novoFuncionario->getFuncao(),
                                $novoFuncionario->getSalarioInicial(),
                                $novoFuncionario->getHorasTrabalho(),
                                $novoFuncionario->getSituacaoCivil(),
                                $novoFuncionario->getConjuge(),
                                $novoFuncionario->getDependentes(),
                                $novoFuncionario->getEndereco(),
                                $novoFuncionario->getNumeroCasa(),
                                $novoFuncionario->getBairro(),
                                $novoFuncionario->getCidade(),
                                $novoFuncionario->getCep(),
                                $novoFuncionario->getUf()
                                );
                $funcionarioDAO = new FuncionarioDAO();
                if(!empty($funcionarioDAO->insert($fields, $params))){
                    
                    echo "<div class='alert alert-success' style='margin:10px;'> Funcionario cadastrado com sucesso!</div>";
                }else{
                    throw new Exception("Não foi possivel cadastrar!");
                }   
                    
            }catch(Exception $e){
                echo "<div class='alert alert-danger' style='margin:10px;'><strong>ERROR:</strong> ".$e->getMessage()."</div>";
            }
        }
    }
    public static function excluirFuncionario(){
        //echo "excluirFuncionario<br>";
        if(isset($_POST['btnExcluirFuncionarioId'])){
           // echo "brnExluir<br>";
            $id=$_POST['id'];
            //echo "excluir id: ".$id."<br>";
            $funcionarioDAO = new FuncionarioDAO();
            $where = "id = ".$id;
            $funcionarioDAO->delete($where,null);
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
        }
    }
    public static function editarFuncionario($id,$nome,$cpf,$rg,$ctps,$serie,$email,$telefone,$celular,$dataEmissao,$funcao,$salarioInicial,$horasTrabalho,$situacaoCivil,$conjuge,$dependentes,$endereco,$numeroCasa,$bairro,$cidade,$cep,$uf){
        $funcionarioDAO = new FuncionarioDAO();
        $fields = array("nome","cpf","rg","ctps","serie","email","telefone","celular","dataEmissao","funcao","salarioInicial","horasTrabalho","situacaoCivil","conjuge","dependentes","endereco","numeroCasa","bairro","cidade","cep","uf");
        $parans = array($nome,$cpf,$rg,$ctps,$serie,$email,$telefone,$celular,$dataEmissao,$funcao,$salarioInicial,$horasTrabalho,$situacaoCivil,$conjuge,$dependentes,$endereco,$numeroCasa,$bairro,$cidade,$cep,$uf);
        $where = "id = $id";
        if($funcionarioDAO->update($fields,$parans,$where)){
            echo true;
        }else{
            echo false;
        }
        
    }
}
?>