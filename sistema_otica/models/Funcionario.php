<?php
class Funcionario {
    private $id;//ok
    private $nome;//ok
    private $cpf;//ok
    private $rg;//ok
    private $ctps;
    private $serie;
    private $email;//ok
    private $telefone;//ok
    private $celular;//ok
    private $dataEmissao;//ok
    private $funcao;//ok
    private $salarioInicial;//ok
    private $horasTrabalho;//ok
    private $situacaoCivil;//ok
    private $conjuge;//ok
    private $dependentes;
    private $endereco; //ok
    private $numeroCasa; //ok
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
    public function setCtps ($ctps) {
        $this->ctps = $ctps;
    }
    public function getCtps () {
        return $this->ctps;
    }
    public function setDependentes ($dependentes) {
        $this->dependentes = $dependentes;
    }
    public function getDependentes () {
        return $this->dependentes;
    }
    public function setConjuge ($conjuge) {
        $this->conjuge = $conjuge;
    }
    public function getConjuge () {
        return $this->conjuge;
    }
    public function setSituacaoCivil ($situacaoCivil) {
        $this->situacaoCivil = $situacaoCivil;
    }
    public function getSituacaoCivil () {
        return $this->situacaoCivil;
    }
    public function setHorasTrabalho ($horasTrabalho) {
        $this->horasTrabalho = $horasTrabalho;
    }
    public function getHorasTrabalho () {
        return $this->horasTrabalho;
    }
    public function setSalarioInicial ($salarioInicial) {
        $this->salarioInicial = $salarioInicial;
    }
    public function getSalarioInicial () {
        return $this->salarioInicial;
    }
    
    public function setFuncao ($funcao) {
        $this->funcao = $funcao;
    }
    public function getFuncao () {
        return $this->funcao;
    }
    public function setDataEmissao ($dataEmissao) {
        $this->dataEmissao = $dataEmissao;
    }
    public function getDataEmissao () {
        return $this->dataEmissao;
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
    public function setSerie ($serie) {
        $this->serie = $serie;
    }
    public function getSerie () {
        return $this->serie;
    }
}
?>



