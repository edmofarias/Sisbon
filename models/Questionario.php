<?php 

class Questionario {
	
	private $id;
	private $enunciado;
	private $a;
	private $b;
	private $c;
	private $d;
	private $correta;
	private $materia;
	private $serie;
	private $pontos;

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}
	
	public function setMateria($materia){
		$this->materia = $materia;
	}
	
	public function getMateria(){
		return $this->materia;
	}
	
	public function setSerie($serie){
		$this->serie = $serie;
	}
	
	public function getSerie(){
		return $this->serie;
	}

	public function setPontos($pontos){
		$this->pontos = $pontos;
	}

	public function getPontos(){
		return $this->pontos;
	}

	public function setEnunciado($enunciado){
		$this->enunciado = $enunciado;
	}

	public function getEnunciado(){
		return $this->enunciado;
	}

	public function setCorreta($correta){
		$this->correta = $correta;
	}

	public function getCorreta(){
		return $this->correta;
	}

	public function setA($a){
		$this->a = $a;
	}

	public function getA(){
		return $this->a;
	}

	public function setB($b){
		$this->b = $b;
	}

	public function getB(){
		return $this->b;
	}

	public function setC($c){
		$this->c = $c;
	}

	public function getC(){
		return $this->c;
	}

	public function setD($d){
		$this->d = $d;
	}

	public function getD(){
		return $this->d;
	}
	
}
?>