<?php 

class Aluno {
	
	private $login;
	private $senha;
	private $nome;
	private $sexo;
	private $dataNascimento;
	private $responsavel;
	private $matricula;
	private $ultimoLogin;
	private $turma;
	private $email;
	private $emailResp;
	private $telefone;
	private $telefoneResp;
	
	private $cep;
	private $rua;
	private $numRes;
	private $bairro;
	private $cidade;
	private $estado;
	private $complemento;
	
	private $foto;
	private $ano;
	private $status;
	
	private $turmaEscolhida;
	
	public function setTurmaEscolhida($a){
		$this->turmaEscolhida = $a;
	}
	
	public function getTurmaEscolhida(){
		return $this->turmaEscolhida;
	}
	
	public function setAno($a){
		$this->ano = $a;
	}
	
	public function getAno(){
		return $this->ano;
	}
	
	public function setStatus($s){
		$this->status = $s;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function setFoto($foto){
		$this->foto = $foto;
	}
	
	public function getFoto(){
		return $this->foto;
	}
	
	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}
	
	public function getTelefone(){
		return $this->telefone;
	}
	
	public function setTelefoneResp($telefoneResp){
		$this->telefoneResp = $telefoneResp;
	}
	
	public function getTelefoneResp(){
		return $this->telefoneResp;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getEmail(){
		return $this->email;
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
	
	public function setEmailResp($emailResp){
		$this->emailResp = $emailResp;
	}
	
	public function getEmailResp(){
		return $this->emailResp;
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

	public function setResponsavel($responsavel){
		$this->responsavel = $responsavel;
	}

	public function getResponsavel(){
		return $this->responsavel;
	}

	public function setMatricula($matricula){
		$this->matricula = $matricula;
	}

	public function getMatricula(){
		return $this->matricula;
	}

	public function setUltimoLogin($ultimoLogin){
		$this->ultimoLogin = $ultimoLogin;
	}

	public function getUltimoLogin(){
		return $this->ultimoLogin;
	}
	
	public function setTurma($turma){
		$this->turma = $turma;
	}
	
	public function getTurma(){
		return $this->turma;
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