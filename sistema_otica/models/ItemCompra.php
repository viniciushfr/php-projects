
<?php
include_once"Produto.php";
include_once"dao/ProdutoDAO.php";
    class ItemCompra{
        private $id;
        private $produtoId;
        private $subTotal;
        private $precoUnitario;
        private $quantidade;
        private $compraId;
        private $produto;
        
        public function getProduto(){
            if(empty($this->produto)){
            $produtoDAO = new ProdutoDAO();
            $this->produto = $produtoDAO->load("*","WHERE id = '$this->produtoId'")[0];
            }
            //var_dump($this->produto);
            return $this->produto;
        }
        public function setProduto($produto){
            $this->produto = $produto;
        }
        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function getProdutoId(){
            return $this->produtoId;
        }
        public function setProdutoId($produtoId){
            $this->produtoId = $produtoId;
        }
        public function getSubTotal(){
            return $this->subTotal;
        }
        public function setSubTotal($subTotal){
            $this->subtotal = $subTotal;
        }
        public function getPrecoUnitario(){
            return $this->precoUnitario;
        }
        public function setPrecoUnitario($precoUnitario){
            $this->precoUnitario = $precoUnitario;
        }
        public function getQuantidade(){
            return $this->quantidade;
        }
        public function setQuantidade($quantidade){
            $this->quantidade = $quantidade;
        }
        public function getCompraId(){
            return $this->compraId;
        }
        public function setCompraId($compraId){
            $this->compraId = $compraId;
        }
    }
?>