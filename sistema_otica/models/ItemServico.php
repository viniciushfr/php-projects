<?php
class ItemServico{
    private $id;
    private $quantidade;
    private $servicoId;
    private $ordenServicoId;
    private $subTotal;
    private $valorUnitario;
    
    
    public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getQuantidade(){
		return $this->quantidade;
	}
	public function setQuantidade($quantidade){
		$this->quantidade = $quantidade;
	}
	public function getServicoId(){
		return $this->servicoId;
	}
	public function setServicoId($servicoId){
		$this->servicoId = $servicoId;
	}
	public function getOrdenServicoId(){
		return $this->ordenServicoId;
	}
	public function setOrdenServicoId($ordenServicoId){
		$this->ordenServicoId = $ordenServicoId;
	}
	public function getSubTotal(){
		return $this->subTotal;
	}
	public function setSubTotal($subTotal){
		$this->subTotal = $subTotal;
	}
	public function getValorUnitario(){
		return $this->valorUnitario;
	}
	public function setValorUnitario($valorUnitario){
		$this->valorUnitario = $valorUnitario;
	}
}
?>