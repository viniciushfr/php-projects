<?php
class Venda{
    private $id;
    private $data;
    private $valorTotal;
    private $valorRecebido;
    private $status;
    private $caixaId;
    private $clienteId;
    
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
    public function getValorRecebido(){
        return $this->valorRecebido;
    }
    public function setValorRecebido($valorRecebido){
        $this->valorRecebido;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function getCaixaId(){
        return $this->caixaId;
    }
    public function setCaixaId($caixaId){
        $this->caixaId = $caixaId;
    }
    public function getClienteId(){
        return $this->clienteId;
    }
    public function setClienteId($clienteId){
        $this->clienteId = $clienteId;
    }
}
?>