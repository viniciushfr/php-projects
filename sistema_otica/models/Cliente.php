<?php
class Cliente {
    private $id;
    private $nome;
    private $cpf;
    private $rg;
    private $dataNascimento;
    private $email;
    private $telefone;
    private $celular;
    private $endereco;
    private $numeroCasa;
    private $bairro;
    private $cidade;
    private $cep;
    private $uf;
    
    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }
    
    public function setNome ($nome) {
        $this->nome = $nome;
    }
    public function getNome () {
        return $this->nome;
    }
    public function setCpf ($cpf) {
        $this->cpf = $cpf;
    }
    public function getCpf () {
        return $this->cpf;
    }
    public function setRg ($rg) {
        $this->rg = $rg;
    }
    public function getRg () {
        return $this->rg;
    }
    public function setDataNascimento ($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }
    public function getDataNascimento () {
        return $this->dataNascimento;
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
    public function setNumeroCasa ($numeroCasa) {
        $this->numeroCasa = $numeroCasa;
    }
    public function getNumeroCasa () {
        return $this->numeroCasa;
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



