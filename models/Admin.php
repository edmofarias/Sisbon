<?php 

class Admin {
	private $nome;
	private $login;
	private $senha;
	private $acsess;
	private $ultimoLogin;
	private $telefone;
	private $email;
	private $sexo;
	
	
	public function setSexo($sexo){
		$this->sexo = $sexo;
	}
	
	public function getSexo(){
		return $this->sexo;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}
	
	public function getTelefone(){
		return $this->telefone;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setAcsess($acsess){
		$this->acsess = $acsess;
	}

	public function getAcsess(){
		return $this->acsess;
	}

	public function setUltimoLogin($ultimoLogin){
		$this->ultimoLogin = $ultimoLogin;
	}

	public function getUltimoLogin(){
		return $this->ultimoLogin;
	}
}

?>