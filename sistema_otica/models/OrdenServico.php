<?php
class OrdenServico{
    private $id;
    private $dataServico;
    private $previsaoEntrega;
    private $precoTotal;
    private $clienteId;
    private $vendaId;
    private $valorRecebido;
    private $caixaId;
    private $status;
    
    public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getDataServico(){
		return $this->dataServico;
	}
	public function setDataServico($dataServico){
		$this->dataServico = $dataServico;
	}
	public function getPrevisaoEntrega(){
		return $this->previsaoEntrega;
	}
	public function setPrevisaoEntrega($previsaoEntrega){
		$this->previsaoEntrega = $previsaoEntrega;
	}
	public function getPrecoTotal(){
		return $this->precoTotal;
	}
	public function setPrecoTotal($precoTotal){
		$this->precoTotal = $precoTotal;
	}
	public function getClienteId(){
		return $this->clienteId;
	}
	public function setClienteId($clienteId){
		$this->clienteId = $clienteId;
	}
	public function getVendaId(){
		return $this->vendaId;
	}
	public function setVendaId($vendaId){
		$this->vendaId = $vendaId;
	}
	public function getValorRecebido(){
		return $this->valorRecebido;
	}
	public function setValorRecebido($valorRecebido){
		$this->valorRecebido = $valorRecebido;
	}
	public function getCaixaId(){
		return $this->caixaId;
	}
	public function setCaixaId($caixaId){
		$this->caixaId = $caixaId;
	}
	public function getStatus(){
		return $this->status;
	}
	public function setStatus($status){
		$this->status = $status;
	}
}
?>