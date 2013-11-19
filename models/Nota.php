<?php 

class Nota {
	private $idNota;
	private $idMateria;
	private $ac1;
	private $ac2;
	private $ac3;
	private $media;
	private $recuperacao;
	private $faltas;
	private $media1b;
	private $media2b;
	private $media3b;
	private $media4b;
	private $totalPontos;
	private $mediaAnual;
	private $provaFinal;
	private $recProvaFinal;
	private $mediaFinal;
	private $situacao;

	public function setIdNota($idNota){
		$this->idNota = $idNota;
	}

	public function getIdNota(){
		return $this->idNota;
	}
	
	public function setIdMateria($idMateria){
		$this->idMateria = $idMateria;
	}
	
	public function getIdMateria(){
		return $this->idMateria;
	}
	
	public function setAc1($ac1){
		$this->ac1 = $ac1;
	}

	public function getAc1(){
		return $this->ac1;
	}

	public function setAc2($ac2){
		$this->ac2 = $ac2;
	}

	public function getAc2(){
		return $this->ac2;
	}

	public function setAc3($ac3){
		$this->ac3 = $ac3;
	}

	public function getAc3(){
		return $this->ac3;
	}

	public function setMedia($media){
		$this->media = $media;
	}

	public function getMedia(){
		return $this->media;
	}

	public function setRecuperacao($recuperacao){
		$this->recuperacao = $recuperacao;
	}

	public function getRecuperacao(){
		return $this->recuperacao;
	}

	public function setFaltas($faltas){
		$this->faltas = $faltas;
	}

	public function getFaltas(){
		return $this->faltas;
	}

	public function setMedia1b($media1b){
		$this->media1b = $media1b;
	}

	public function getMedia1b(){
		return $this->media1b;
	}

	public function setMedia2b($media2b){
		$this->media2b = $media2b;
	}

	public function getMedia2b(){
		return $this->media2b;
	}

	public function setMedia3b($media3b){
		$this->media3b = $media3b;
	}

	public function getMedia3b(){
		return $this->media3b;
	}

	public function setMedia4b($media4b){
		$this->media4b = $media4b;
	}

	public function getMedia4b(){
		return $this->media4b;
	}

	public function setTotalPontos($totalPontos){
		$this->totalPontos = $totalPontos;
	}

	public function getTotalPontos(){
		return $this->totalPontos;
	}

	public function setMediaAnual($mediaAnual){
		$this->mediaAnual = $mediaAnual;
	}

	public function getMediaAnual(){
		return $this->mediaAnual;
	}

	public function setProvaFinal($provaFinal){
		$this->provaFinal = $provaFinal;
	}

	public function getProvaFinal(){
		return $this->provaFinal;
	}

	public function setRecProvaFinal($recProvaFinal){
		$this->recProvaFinal = $recProvaFinal;
	}

	public function getRecProvaFinal(){
		return $this->recProvaFinal;
	}

	public function setMediaFinal($mediaFinal){
		$this->mediaFinal = $mediaFinal;
	}

	public function getMediaFinal(){
		return $this->mediaFinal;
	}

	public function setSituacao($situacao){
		$this->situacao = $situacao;
	}

	public function getSituacao(){
		return $this->situacao;
	}
}


