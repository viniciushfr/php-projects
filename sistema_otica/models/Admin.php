<?php
class Admin {
    private $login;
    private $senha;
    
    public function __construct() {
            $this->login = "admin";
            $this->senha = "admin";
        }
    public function getLogin(){
        return $this->login;
    }
    public function setLogin($login){
        $this->login =$login;
    }
     public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha =$senha;
    }
}