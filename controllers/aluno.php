<?php 
require_once '../models/db/Conexao.php';
include_once  '../models/Aluno.php';
include_once  '../helper/Funcoes.php';
require_once '../models/db/AlunoDAO.php';
require_once '../models/db/AuthDAO.php';

$foto = $_FILES["foto"];

// Se a foto estiver sido selecionada
if (!empty($foto["name"])) {
	// Largura máxima em pixels
	$largura = 500;
	// Altura máxima em pixels
	$altura = 500;
	// Tamanho máximo do arquivo em bytes
	$tamanho = 1048576; // 1MB

	// Verifica se o arquivo é uma imagem
	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
		$error[1] = " Isso nao é uma imagem.";
	}

	// Pega as dimensões da imagem
	$dimensoes = getimagesize($foto["tmp_name"]);

	// Verifica se a largura da imagem é maior que a largura permitida
	if($dimensoes[0] > $largura) {
		$error[2] = " A largura da imagem nao deve ultrapassar ".$largura." pixels";
	}

	// Verifica se a altura da imagem é maior que a altura permitida
	if($dimensoes[1] > $altura) {
		$error[3] = " A Altura da imagem nao deve ultrapassar ".$altura." pixels";
	}

	// Verifica se o tamanho da imagem é maior que o tamanho permitido
	if($foto["size"] > $tamanho) {
		$error[4] = " A imagem deve ter no maximo ".$tamanho." bytes";
	}

	// Se não houver nenhum erro
	if (count($error) == 0) {

		// Pega extensão da imagem
		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

		// Gera um nome único para a imagem
		//$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
		$nome_imagem = addslashes($_POST['matricula']). "." . $ext[1];
		
		// Caminho de onde ficará a imagem
		$caminho_imagem = "../helper/fotos/" . $nome_imagem;

		// Faz o upload da imagem para seu respectivo caminho
		move_uploaded_file($foto["tmp_name"], $caminho_imagem);
	}else{
		foreach ($error as $erro) {
			$e .= $erro;
		}
		if($e){
			echo "<script Language=JavaScript>alert('".$e."'); history.back();</script>";
			break;
		}
	}
}

$nome = addslashes($_POST['nome']);
$matricula = addslashes($_POST['matricula']);
$usuario = addslashes($_POST['login']);
$usuarioOld = $_POST['loginOld'];
$turma = $_POST['turma'];
$turmaOld = $_POST['turmaOld'];
$email = addslashes($_POST['email']);
$sexo = addslashes($_POST['sexo']);
$dataNascimento = Funcao::dateFormatBd($_POST['dataNascimento']);
$telefone = addslashes($_POST['telefone']);

$responsavel = addslashes($_POST['nomeResp']);
$emailResp = addslashes($_POST['emailResp']);
$telefoneResp = addslashes($_POST['telefoneResp']);

$rua = addslashes($_POST['endereco']);
$numRes =addslashes( $_POST['numRes']);
$bairro = addslashes($_POST['bairro']);
$cidade = addslashes($_POST['cidade']);
$estado = addslashes(strtoupper($_POST['estado']));
$cep = addslashes($_POST['cep']);
$complemento = addslashes($_POST['complemento']);

$ano = addslashes($_POST['ano']);
$status = addslashes($_POST['status']);

$pre = $_POST['senha'];
if($pre != ""){
	$senha = md5($pre);
}else{
	$senha = $_POST['senhaAnt'];
}

if($turma == $turmaOld){
	$turma = '';
}

if($usuario != $usuarioOld){
	$daoAuth = new AuthDAO();
	if(!$daoAuth->verificaLoginIgual($usuario)){
		print "<script> window.alert('O Login digitado ja existe, porfavor mude o login!');
						history.back(); </script>";
		break;
	}
}

$aluno = new Aluno();

$aluno->setNome($nome);
$aluno->setMatricula($matricula);
$aluno->setLogin($usuario);
$aluno->setSenha($senha);
$aluno->setTurma($turma);
$aluno->setSexo($sexo);
$aluno->setDataNascimento($dataNascimento);
$aluno->setTelefone($telefone);
$aluno->setEmail($email);

$aluno->setResponsavel($responsavel);
$aluno->setEmailResp($emailResp);
$aluno->setTelefoneResp($telefoneResp);

$aluno->setComplemento($complemento);
$aluno->setRua($rua);
$aluno->setNumRes($numRes);
$aluno->setBairro($bairro);
$aluno->setCidade($cidade);
$aluno->setEstado($estado);
$aluno->setCep($cep);

$aluno->setAno($ano);
$aluno->setStatus($status);
$aluno->setTurmaEscolhida($_POST['turma']);
$aluno->setFoto($nome_imagem);

$dao = new AlunoDAO();

if($_GET['funcao'] == 'inserir'){
	$id = $dao->inserir($aluno);
	if($id){
		header('Location: ../views/listaAluno.php?al=1');
	}
}elseif($_GET['funcao'] == 'alterar'){
	$id = $_POST['idAluno'];
	$dao->alterar($aluno, $id);
	if($id){
		header('Location: ../views/listaAluno.php?al=1');
	}
}elseif($_GET['funcao'] == 'excluir'){
	$id = $_GET['id'];
	$x = $dao->excluir($id);
	echo $x;exit;
}

?>