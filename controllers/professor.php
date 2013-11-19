<?php 
require_once '../models/db/Conexao.php';
include_once '../models/Professor.php';
require_once '../models/db/ProfessorDAO.php';
require_once '../models/db/AuthDAO.php';
include_once '../helper/Funcoes.php';

$nome = addslashes($_POST[0]['nome']);
$endereco = addslashes($_POST[0]['endereco']);
$sexo = addslashes($_POST[0]['sexo']);

$dataNascimento = Funcao::dateFormatBd($_POST[0]['dataNascimento']);
$email = addslashes($_POST[0]['email']);
$telefone = addslashes($_POST[0]['telefone']);

$usuario = addslashes($_POST[0]['login']);
$usuarioOld = addslashes($_POST[0]['loginOld']);

$rua = addslashes($_POST[0]['endereco']);
$numRes =addslashes( $_POST[0]['numRes']);
$bairro = addslashes($_POST[0]['bairro']);
$cidade = addslashes($_POST[0]['cidade']);
$estado = addslashes(strtoupper($_POST[0]['estado']));
$cep = addslashes($_POST[0]['cep']);
$complemento = addslashes($_POST[0]['complemento']);

if($_POST[1] == 0)
	$materias = array();
else
	$materias = $_POST[1];

if($_POST[2] == 0)
	$turmas = array();
else
	$turmas = $_POST[2];

$pre = $_POST[0]['senha'];
if($pre != ""){
	$senha = md5($pre);
}else{
	$senha = $_POST[0]['senhaAnt'];
}

if($usuario != $usuarioOld){
	$daoAuth = new AuthDAO();
	if(!$daoAuth->verificaLoginIgual($usuario)){
		print "<script> window.alert('O Login digitado ja existe, porfavor mude o login!');
						window.location = '../views/formProfessor.php?id=".$_POST[0]['id']."'; </script>";
		$_GET['funcao'] = '';
	}
}

$professor = new Professor();

$professor->setNome($nome);
$professor->setEmail($email);
$professor->setLogin($usuario);
$professor->setSenha($senha);
$professor->setMaterias($materias);
$professor->setTurmas($turmas);

$professor->setSexo($sexo);
$professor->setDataNascimento($dataNascimento);
$professor->setTelefone($telefone);
$professor->setComplemento($complemento);
$professor->setRua($rua);
$professor->setNumRes($numRes);
$professor->setBairro($bairro);
$professor->setCidade($cidade);
$professor->setEstado($estado);
$professor->setCep($cep);

$dao = new ProfessorDAO();

if($_GET['funcao'] == 'inserir')
{
	$dao->inserir($professor);
}

if($_GET['funcao'] == 'alterar')
{
	$id = $_POST[0]['idProf'];
	$dao->alterar($professor, $id);
}

if($_GET['funcao'] == 'excluir')
{
	$id = $_GET['id'];
	$dao->excluir($id);
}

?>