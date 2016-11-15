<?php

class Fornecedor {
    private $id;//ok
    private $identificacao;//ok
    private $cnpj;//ok
    private $inscEstadual;//ok
    private $email;//ok
    private $telefone;//ok
    private $celular;//ok
    private $site;//ok
    private $endereco; //ok
    private $numero; //
    private $bairro;//ok
    private $cidade;//ok
    private $cep;//ok
    private $uf;//ok
    
    public function setId ($id) {
        $this->id = $id;
    }
    public function getId () {
        return $this->id;
    }
    public function setInscEstadual ($inscEstadual) {
        $this->inscEstadual = $inscEstadual;
    }
    public function getInscEstadual () {
        return $this->inscEstadual;
    }
    public function setSite ($site) {
        $this->site = $site;
    }
    public function getSite () {
        return $this->site;
    }
    
    
    public function setIdentificacao ($identificacao) {
        $this->identificacao = $identificacao;
    }
    public function getIdentificacao () {
        return $this->identificacao;
    }
    public function setCnpj ($cnpj) {
        $this->cnpj = $cnpj;
    }
    public function getCnpj () {
        return $this->cnpj;
    }
    
    public function setCelular ($celular) {
        $this->celular = $celular;
    }
    public function getCelular () {
        return $this->celular;
    }
    public function setBairro ($bairro) {
        $this->bairro = $bairro;
    }
    public function getBairro () {
        return $this->bairro;
    }
    public function setNumero ($numero) {
        $this->numero = $numero;
    }
    public function getNumero () {
        return $this->numero;
    }
    public function setCidade ($cidade ){
        $this->cidade = $cidade;
    }
    public function getCidade () {
        return $this->cidade;
    }
    public function setCep($cep) {
        $this->cep = $cep;
    }
    public function getCep() {
        return $this->cep;
    }
    public function setUf ($uf) {
        $this->uf = $uf;
    }
    public function getUf () {
        return $this->uf;
    }
    public function setEndereco ($endereco) {
        $this->endereco = $endereco;
    }
    public function getEndereco () {
        return $this->endereco;
    }
 
    public function setEmail ($email) {
        $this->email = $email;
    }
    public function getEmail () {
        return $this->email;
    }
 
    public function setTelefone ($telefone) {
        $this->telefone = $telefone;
    }
    public function getTelefone () {
        return $this->telefone;
    }
}
?>



