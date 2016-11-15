
<?php
include_once"../models/Produto.php";
include_once"../models/dao/ProdutoDAO.php";
if(isset($_POST["btn-editar"])){
    echo "botao editar";
    $id = $_POST["id"];
    $codigoBarra = $_POST["codigoBarra"];
    $descricao = $_POST["descricao"];
    $grupoEstoque = $_POST["grupoEstoque"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $unidade = $_POST["unidade"];
    $quantidade = $_POST["quantidade"];
    $valor = $_POST["valor"];
    $estoqueMinimo = $_POST["estoqueMinimo"];
    $valorVenda = $_POST["valorVenda"];
    $nome = $_POST["nome"];
    ProdutoController::editarProduto($id,$codigoBarra,$descricao,$grupoEstoque,$marca,$modelo,$unidade,$quantidade,$valor,$estoqueMinimo,$valorVenda,$nome);
}
class ProdutoController{
    public static function buscaProduto(){
        //echo "buscarProduto<br>";
        if(isset($_POST['buscarProduto'])){
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
        $produtoDAO = new ProdutoDAO();
        $produtos = $produtoDAO->load("*",$add);
        return $produtos;
        
    }
    public static function cadastrarProduto(){
        //echo "entrou no metodo cadastrarProduto";
        if(isset($_POST['btnCadastrarProduto'])){
            try {
                //echo "entrou na funcao";
                $novoProduto = new Produto();
                $novoProduto->setCodigoBarra($_POST['codigoBarra']);
                $novoProduto->setDescricao($_POST['descricao']);
                $novoProduto->setGrupoEstoque($_POST['grupoEstoque']);
                $novoProduto->setMarca($_POST['marca']);
                $novoProduto->setModelo($_POST['modelo']);
                $novoProduto->setUnidade($_POST['unidade']);
                $novoProduto->setQuantidade($_POST['quantidade']);
                $novoProduto->setValor($_POST['valor']);
                $novoProduto->setEstoqueMinimo($_POST['estoqueMinimo']);
                $novoProduto->setValorVenda($_POST["valorVenda"]);
                $novoProduto->setNome($_POST["nome"]);
                //echo $_POST["valorVenda"];
                //var_dump($novoProduto);
                $fields = "codigoBarra, descricao, grupoEstoque, marca, modelo, unidade, quantidade, valor, estoqueMinimo, valorVenda, nome";
                $params = array($novoProduto->getCodigoBarra(),
                                $novoProduto->getDescricao(),
                                $novoProduto->getGrupoEstoque(),
                                $novoProduto->getMarca(),
                                $novoProduto->getModelo(),
                                $novoProduto->getUnidade(),
                                $novoProduto->getQuantidade(),
                                $novoProduto->getValor(),
                                $novoProduto->getEstoqueMinimo(),
                                $novoProduto->getValorVenda(),
                                $novoProduto->getNome()
                                );
                $produtoDAO = new ProdutoDAO();
                if(!empty($produtoDAO->insert($fields, $params))){
                    
                    echo "<div class='alert alert-success' style='margin:10px;'>Produto cadastrado com sucesso!</div>";
                }else{
                    throw new Exception("Não foi possivel cadastrar!");
                }   
                    
            }catch(Exception $e){
                echo "<div class='alert alert-danger' style='margin:10px;'><strong>ERROR:</strong> ".$e->getMessage()."</div>";
            }
        }
    }
    public static function excluirProduto(){
        //echo "excluirProduto<br>";
        if(isset($_POST['btnExcluirProdutoId'])){
           // echo "brnExluir<br>";
            $id=$_POST['id'];
           // echo "excluir id: ".$id."<br>";
            $produtoDAO = new ProdutoDAO();
            $where = "id = ".$id;
            $produtoDAO->delete($where,null);
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
        }
    }
    public static function editarProduto($id,$codigoBarra,$descricao,$grupoEstoque,$marca,$modelo,$unidade,$quantidade,$valor,$estoqueMinimo,$valorVenda,$nome){
        $produtoDAO = new ProdutoDAO();
        $fields = array("codigoBarra","descricao","grupoEstoque","marca","modelo","unidade","quantidade","valor","estoqueMinimo","valorVenda","nome");
        $parans = array($codigoBarra,$descricao,$grupoEstoque,$marca,$modelo,$unidade,$quantidade,$valor,$estoqueMinimo,$valorVenda,$nome);
        $where = "id = $id";
        if($produtoDAO->update($fields,$parans,$where)){
            echo true;
        }else{
            echo false;
        }
        
    }
}

?>