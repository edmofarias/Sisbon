<?php
require_once 'Nota.php';
/**
 * Classe reponsavel por gerenciar Boletim, onde a mesma extende da classe Nota.php herdando todos seus metodos e atributos
 * @author edmo
 */
Class Boletim extends Nota {
	
	private $idBoletim;
	private $idAluno;
	private $dataGeracao;
	private $dataConfirmacao;
	private $confirmado;
	private $obs;
	private $mediaEtapa;
	private $resultadoFinal;
	private $serie;
	private $etapa;
	
	public function setIdBoletim($idBoletim){
		$this->idBoletim = $idBoletim;
	}
	
	public function getIdBoletim(){
		return $this->idBoletim;
	}
	
	public function setIdAluno($idAluno){
		$this->idAluno = $idAluno;
	}
	
	public function getIdAluno(){
		return $this->idAluno;
	}
	
	public function setDataGeracao($dataGeracao){
		$this->dataGeracao = $dataGeracao;
	}
	
	public function getDataGeracao(){
		return $this->dataGeracao;
	}
	
	public function setDataConfirmacao($dataConfirmacao){
		$this->dataConfirmacao = $dataConfirmacao;
	}
	
	public function getDataConfirmacao(){
		return $this->dataConfirmacao;
	}
	
	public function setConfirmado($confirmado){
		$this->confirmado = $confirmado;
	}
	
	public function getConfirmado(){
		return $this->confirmado;
	}
	
	public function setObs($obs){
		$this->obs = $obs;
	}
	
	public function getObs(){
		return $this->obs;
	}
	
	public function setMediaEtapa($mediaEtapa){
		$this->mediaEtapa = $mediaEtapa;
	}
	
	public function getMediaEtapa(){
		return $this->mediaEtapa;
	}
	
	public function setResultadoFinal($resultadoFinal){
		$this->resultadoFinal = $resultadoFinal;
	}
	
	public function getResultadoFinal(){
		return $this->resultadoFinal;
	}
	
	public function setSerie($serie){
		$this->serie = $serie;
	}
	
	public function getSerie(){
		return $this->serie;
	}
	
	public function setEtapa($etapa){
		$this->etapa = $etapa;
	}
	
	public function getEtapa(){
		return $this->etapa;
	}
}

