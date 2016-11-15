<?php
class Caixa{
    private $id;
    private $dataAbertura;
    private $dataFechamento;
    private $valor;
    private $tipoLancamento;
    private $nome;
    
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setTipoLancamento ($tipoLancamento) {
        $this->tipoLancamento = $tipoLancamento;
    }
    public function getTipoLancamento () {
        return $this->tipoLancamento;
    }
    public function setValor ($valor) {
        $this->valor = $valor;
    }
    public function getValor () {
        return $this->valor;
    }
    public function setDataAbertura ($dataAbertura) {
        $this->dataAbertura = $dataAbertura;
    }
    public function getDataAbertura () {
        return $this->dataAbertura;
    }
    public function getDataFechamento () {
        return $this->dataFechamento;
    }
    public function setDataFechamento ($dataFechamento) {
        $this->dataFechamento = $dataFechamento;
    }
    public function getNome () {
        return $this->nome;
    }
    


    
}

?>