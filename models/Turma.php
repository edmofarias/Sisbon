<?php
Class Turma{
	private $idTurma;
	private $nome;
	private $serie;
	private $sobreNome;
	private $turno;
	private $qtdAlunos;
	private $materias;
	
	public function setMaterias($materias){
		$this->materias = $materias;
	}
	
	public function getMaterias(){
		return $this->materias;
	}
	
	public function setIdTurma($idTurma) {
		$this->idTurma = $idTurma;
	}
	
	public function getIdTurma() {
		return $this->idTurma;
	}
	
	public function setSerie($serie) {
		$this->serie = $serie;
	}
	
	public function getSerie() {
		return $this->serie;
	}
	
	public function setNome($nome) {
		$this->nome = $nome;
	}
	
	public function getNome() {
		return $this->nome;
	}
	
	public function setSobreNome($sobreNome) {
		$this->sobreNome = $sobreNome;
	}
	
	public function getSobreNome() {
		return $this->sobreNome;
	}
	
	public function setTurno($turno) {
		$this->turno = $turno;
	}
	
	public function getTurno() {
		return $this->turno;
	}
	
	public function setQtdAlunos($qtdAlunos) {
		$this->qtdAlunos = $qtdAlunos;
	}
	
	public function getQtdAlunos() {
		return $this->qtdAlunos;
	}
	
	
	
}