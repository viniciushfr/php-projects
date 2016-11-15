<?php
class Prescricao{
    private $id;
    private $numReceita;
    private $medico;
    private $data;
    private $clienteId;
    
    private $longeOdEsf;
    private $longeOdCil;
    private $longeOdEixo;
    private $longeOdDpn;
    private $longeOdAlt;
    private $longeOeEsf;
    private $longeOeCil;
    private $longeOeEixo;
    private $longeOeDpn;
    private $longeOeAlt;
    
    private $pertoOdEsf;
    private $pertoOdCil;
    private $pertoOdEixo;
    private $pertoOdDpn;
    private $pertoOdAlt;
    private $pertoOeEsf;
    private $pertoOeCil;
    private $pertoOeEixo;
    private $pertoOeDpn;
    private $pertoOeAlt;
    
    private $addPertoOd;
    private $addPertoOe;
    
    
    public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getNumReceita(){
		return $this->numReceita;
	}
	public function setNumReceita($numReceita){
		$this->numReceita = $numReceita;
	}
	public function getMedico(){
		return $this->medico;
	}
	public function setMedico($medico){
		$this->medico = $medico;
	}
	public function getData(){
		return $this->data;
	}
	public function setData($data){
		$this->data = $data;
	}
	public function getClienteId(){
		return $this->clienteId;
	}
	public function setClienteId($clienteId){
		$this->clienteId = $clienteId;
	}
	public function getLongeOdEsf(){
		return $this->longeOdEsf;
	}
	public function setLongeOdEsf($longeOdEsf){
		$this->longeOdEsf = $longeOdEsf;
	}
	public function getLongeOdCil(){
		return $this->longeOdCil;
	}

	public function setLongeOdCil($longeOdCil){
		$this->longeOdCil = $longeOdCil;
	}

	public function getLongeOdEixo(){
		return $this->longeOdEixo;
	}

	public function setLongeOdEixo($longeOdEixo){
		$this->longeOdEixo = $longeOdEixo;
	}

	public function getLongeOdDpn(){
		return $this->longeOdDpn;
	}

	public function setLongeOdDpn($longeOdDpn){
		$this->longeOdDpn = $longeOdDpn;
	}

	public function getLongeOdAlt(){
		return $this->longeOdAlt;
	}

	public function setLongeOdAlt($longeOdAlt){
		$this->longeOdAlt = $longeOdAlt;
	}

	public function getLongeOeEsf(){
		return $this->longeOeEsf;
	}

	public function setLongeOeEsf($longeOeEsf){
		$this->longeOeEsf = $longeOeEsf;
	}

	public function getLongeOeCil(){
		return $this->longeOeCil;
	}

	public function setLongeOeCil($longeOeCil){
		$this->longeOeCil = $longeOeCil;
	}

	public function getLongeOeEixo(){
		return $this->longeOeEixo;
	}

	public function setLongeOeEixo($longeOeEixo){
		$this->longeOeEixo = $longeOeEixo;
	}

	public function getLongeOeDpn(){
		return $this->longeOeDpn;
	}

	public function setLongeOeDpn($longeOeDpn){
		$this->longeOeDpn = $longeOeDpn;
	}

	public function getLongeOeAlt(){
		return $this->longeOeAlt;
	}

	public function setLongeOeAlt($longeOeAlt){
		$this->longeOeAlt = $longeOeAlt;
	}

	public function getPertoOdEsf(){
		return $this->pertoOdEsf;
	}

	public function setPertoOdEsf($pertoOdEsf){
		$this->pertoOdEsf = $pertoOdEsf;
	}

	public function getPertoOdCil(){
		return $this->pertoOdCil;
	}

	public function setPertoOdCil($pertoOdCil){
		$this->pertoOdCil = $pertoOdCil;
	}

	public function getPertoOdEixo(){
		return $this->pertoOdEixo;
	}

	public function setPertoOdEixo($pertoOdEixo){
		$this->pertoOdEixo = $pertoOdEixo;
	}

	public function getPertoOdDpn(){
		return $this->pertoOdDpn;
	}

	public function setPertoOdDpn($pertoOdDpn){
		$this->pertoOdDpn = $pertoOdDpn;
	}

	public function getPertoOdAlt(){
		return $this->pertoOdAlt;
	}

	public function setPertoOdAlt($pertoOdAlt){
		$this->pertoOdAlt = $pertoOdAlt;
	}

	public function getPertoOeEsf(){
		return $this->pertoOeEsf;
	}

	public function setPertoOeEsf($pertoOeEsf){
		$this->pertoOeEsf = $pertoOeEsf;
	}

	public function getPertoOeCil(){
		return $this->pertoOeCil;
	}

	public function setPertoOeCil($pertoOeCil){
		$this->pertoOeCil = $pertoOeCil;
	}

	public function getPertoOeEixo(){
		return $this->pertoOeEixo;
	}

	public function setPertoOeEixo($pertoOeEixo){
		$this->pertoOeEixo = $pertoOeEixo;
	}

	public function getPertoOeDpn(){
		return $this->pertoOeDpn;
	}

	public function setPertoOeDpn($pertoOeDpn){
		$this->pertoOeDpn = $pertoOeDpn;
	}

	public function getPertoOeAlt(){
		return $this->pertoOeAlt;
	}

	public function setPertoOeAlt($pertoOeAlt){
		$this->pertoOeAlt = $pertoOeAlt;
	}

	public function getAddPertoOd(){
		return $this->addPertoOd;
	}

	public function setAddPertoOd($addPertoOd){
		$this->addPertoOd = $addPertoOd;
	}

	public function getAddPertoOe(){
		return $this->addPertoOe;
	}

	public function setAddPertoOe($addPertoOe){
		$this->addPertoOe = $addPertoOe;
	}
    
   
}
?>