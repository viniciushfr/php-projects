<?php
class Pagamento{
    private $id;
    private $numPagamento;
    private $valor;
    private $multa;
    private $dataPrevista;
    private $dataPagamento;
    private $valorPago;
    private $compraId;
    private $vendaId;
    private $ordemServicoId;
    private $caixaId;
    private $desconto;
    
    
    public function getDesconto(){
		return $this->desconto;
	}

	public function setDesconto($desconto){
		$this->desconto = $desconto;
	}
    public function getCaixaId(){
		return $this->caixaId;
	}

	public function setCaixaId($caixaId){
		$this->caixaId = $caixaId;
	}

    
    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNumPagamento(){
		return $this->numPagamento;
	}

	public function setNumPagamento($numPagamento){
		$this->numPagamento = $numPagamento;
	}

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

	public function getMulta(){
		return $this->multa;
	}

	public function setMulta($multa){
		$this->multa = $multa;
	}

	public function getDataPrevista(){
		return $this->dataPrevista;
	}

	public function setDataPrevista($dataPrevista){
		$this->dataPrevista = $dataPrevista;
	}

	public function getDataPagamento(){
		return $this->dataPagamento;
	}

	public function setDataPagamento($dataPagamento){
		$this->dataPagamento = $dataPagamento;
	}

	public function getValorPago(){
		return $this->valorPago;
	}

	public function setValorPago($valorPago){
		$this->valorPago = $valorPago;
	}

	public function getCompraId(){
		return $this->compraId;
	}

	public function setCompraId($compraId){
		$this->compraId = $compraId;
	}

	public function getVendaId(){
		return $this->vendaId;
	}

	public function setVendaId($vendaId){
		$this->vendaId = $vendaId;
	}

	public function getOrdemServicoId(){
		return $this->ordemServicoId;
	}

	public function setOrdemServicoId($ordemServicoId){
		$this->ordemServicoId = $ordemServicoId;
	}
}
?>