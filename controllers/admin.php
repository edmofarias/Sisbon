<?php  
require_once '../models/db/Conexao.php';
include  '../models/Admin.php';
require_once '../models/db/AdminDAO.php';
require_once '../models/db/AuthDAO.php';

$nome = $_POST['nome'];
$usuario = $_POST['login'];
$usuarioOld = $_POST['loginOld'];
$pre = $_POST['senha'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

if($pre != ""){
	$senha = md5($pre);
}else{
	$senha = $_POST['senhaAnt'];
}

if($usuarioOld != ""){
if($usuario != $usuarioOld){
	$daoAuth = new AuthDAO();
	if(!$daoAuth->verificaLoginIgual($usuario)){
		print "<script> window.alert('O Login digitado ja existe, porfavor mude o login!'); history.back();</script>";
		exit;
	}
	exit;	
}
}
$admin = new Admin();

$admin->setNome($nome);
$admin->setLogin($usuario);
$admin->setSenha($senha);
$admin->setSexo($sexo);
$admin->setTelefone($telefone);
$admin->setEmail($email);

$dao = new AdminDAO();

if($_GET['funcao'] == 'inserir')
{
	$dao->inserir($admin);
}

if($_GET['funcao'] == 'alterar')
{
	$id = $_POST['idAdmin'];
	$dao->alterar($admin, $id);
}

if($_GET['funcao'] == 'excluir')
{
	$id = $_GET['id'];
	$dao->excluir($id);
}

?>