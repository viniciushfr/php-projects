<?php
    class Compra{
        private $id;
        private $data;
        private $valorTotal;
        private $valorPago;
        private $status;
        private $fornecedorId;
        private $caixaId;
        private $itensCompra=array();//array com os itens
        
        public function getId(){
            return $this->id;
        }
        public function getData(){
            return $this->data;
        }
        public function setData($data){
            $this->data = $data;
        }
        
        public function getValorTotal(){
            return $this->valorTotal;
        }
        public function setValorTotal($valorTotal){
            $this->valorTotal = $valorTotal;
        }
        
        public function getValorPago(){
            return $this->valorPago;
        }
        public function setValorPago($valorPago){
            $this->valorPago = $valorPago;
        }
        
        public function getStatus(){
            return $this->status;
        }
        public function setStatus($status){
            $this->status=$status;
        }
        
        public function getFornecedorId(){
            return $this->fornecedorId;
        }
        public function setFornecedorId($fornecedorId){
            $this->fornecedorId = $fornecedorId;
        }
        
        public function getCaixaId(){
            return $this->caixaId;
        }
        public function setCaixaId($caixaId){
            $this->caixaId =$caixaId;
        }
        
        public function getItensCompra(){
            
        }
        public function setItensCompra(){
            
        }
        
        public function addItemCompra($itemCompra){
            $this->itensCompra[]=$itemCompra;
            
        }
    }
    
?>









