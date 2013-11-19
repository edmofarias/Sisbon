<?php 

class Professor {
	private $id;
	private $login;
	private $senha;
	private $nome;
	private $email;
	private $ultimoLogin;
	private $materias;
	private $turmas;
	private $telefone;

	private $sexo;
	private $dataNascimento;
	
	private $cep;
	private $rua;
	private $numRes;
	private $bairro;
	private $cidade;
	private $estado;
	private $complemento;
	
	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}
	
	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}
	
	public function getTelefone(){
		return $this->telefone;
	}
	
	public function setSexo($sexo){
		$this->sexo = $sexo;
	}
	
	public function getSexo(){
		return $this->sexo;
	}
	
	public function setDataNascimento($dt){
		$this->dataNascimento = $dt;
	}
	
	public function getDataNascimento(){
		return $this->dataNascimento;
	}
	
	public function setMaterias($materias){
		$this->materias = $materias;
	}
	
	public function getMaterias(){
		return $this->materias;
	}
	
	public function setTurmas($turmas){
		$this->turmas = $turmas;
	}
	
	public function getTurmas(){
		return $this->turmas;
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

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setUltimoLogin($ultimoLogin){
		$this->ultimoLogin = $ultimoLogin;
	}

	public function getUltimoLogin(){
		return $this->ultimoLogin;
	}
	
	public function setCep($cep) {
		$this->cep = $cep;
	}
	
	public function getCep() {
		return $this->cep;
	}
	
	public function setRua($rua) {
		$this->rua = $rua;
	}
	
	public function getRua() {
		return $this->rua;
	}
	
	public function setNumRes($numRes) {
		$this->numRes = $numRes;
	}
	
	public function getNumRes() {
		return $this->numRes;
	}
	
	public function setBairro($bairro) {
		$this->bairro = $bairro;
	}
	
	public function getBairro() {
		return $this->bairro;
	}
	
	public function setCidade($cidade) {
		$this->cidade = $cidade;
	}
	
	public function getCidade() {
		return $this->cidade;
	}
	
	public function setEstado($estado) {
		$this->estado = $estado;
	}
	
	public function getEstado() {
		return $this->estado;
	}
	
	public function setComplemento($complemento) {
		$this->complemento = $complemento;
	}
	
	public function getComplemento() {
		return $this->complemento;
	}
}

?>