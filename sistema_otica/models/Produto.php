<?php

class Produto {
    private $id; //ok
    private $codigoBarra;//ok
    private $descricao;//ok
    private $grupoEstoque;
    private $marca;//ok
    private $modelo;//ok
    private $unidade;//ok
    private $quantidade;//ok
    private $valor;//ok
    private $valorVenda;
    private $estoqueMinimo;
    private $nome;
    
    public function setNome ($nome) {
        $this->nome = $nome;
    }
    public function getNome() {
        return $this->nome;
    }
    
    public function setValorVenda ($valorVenda) {
        $this->valorVenda = $valorVenda;
    }
    public function getValorVenda () {
        return $this->valorVenda;
    }
    public function setGrupoEstoque ($grupoEstoque) {
        $this->grupoEstoque = $grupoEstoque;
    }
    public function getGrupoEstoque () {
        return $this->grupoEstoque;
    }
    public function setFornecedorId ($fornecedorId) {
        $this->fornecedorId = $fornecedorId;
    }
    public function getFornecedorId () {
        return $this->fornecedorId;
    }
    public function setEstoqueMinimo ($estoqueMinimo) {
        $this->estoqueMinimo = $estoqueMinimo;
    }
    public function getEstoqueMinimo () {
        return $this->estoqueMinimo;
    }
    public function setValor ($valor) {
        $this->valor = $valor;
    }
    public function getValor () {
        return $this->valor;
    }
    public function setQuantidade ($quantidade) {
        $this->quantidade = $quantidade;
    }
    public function getQuantidade () {
        return $this->quantidade;
    }
    public function setUnidade ($unidade) {
        $this->unidade = $unidade;
    }
    public function getUnidade () {
        return $this->unidade;
    }
    public function setModelo ($modelo) {
        $this->modelo = $modelo;
    }
    public function getModelo () {
        return $this->modelo;
    }
    public function setMarca ($marca) {
        $this->marca = $marca;
    }
    public function getMarca () {
        return $this->marca;
    }
    
    public function setDescricao ($descricao) {
        $this->descricao = $descricao;
    }
    public function getDescricao () {
        return $this->descricao;
    }
    
    public function setId ($id) {
        $this->id = $id;
    }
    public function getId () {
        return $this->id;
    }
    public function setCodigoBarra ($codigoBarra) {
        $this->codigoBarra = $codigoBarra;
    }
    public function getCodigoBarra () {
        return $this->codigoBarra;
    }
}
?>