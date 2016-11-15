<?php
    class ItemVenda{
        private $id;
        private $produtoId;
        private $subTotal;
        private $precoUnitario;
        private $quantidade;
        private $vendaId;
        
        public function getId(){
            return $this->id;
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
        public function setSubtotal($subtotal){
            $this->subtotal = $subtotal;
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
        public function getVendaId(){
            return $this->vendaId;
        }
        public function setVendaId($vendaId){
            $this->vendaId = $vendaId;
        }
        
    }
?>