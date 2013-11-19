<?php

require_once '../models/db/QuestoesDAO.php';

$dados['nome'] = addslashes($_POST['nome']);
$dados['a'] = addslashes($_POST['a']);
$dados['b'] = addslashes($_POST['b']);
$dados['c'] = addslashes($_POST['c']);
$dados['d'] = addslashes($_POST['d']);
$dados['e'] = addslashes($_POST['e']);
$dados['pontuacao'] = addslashes($_POST['pontuacao']);
$dados['materia'] = addslashes($_POST['materia']);
$dados['serie'] = addslashes($_POST['serie']);
$dados['correta'] = $_POST['correta'];

$dao = new QuestoesDAO();

if($_GET['funcao'] == 'inserir'){
	if(in_array('', $dados))
		echo '<script>alert("Dados incompletos! porfavor preencha-os corretamente");history.back();</script>';
	
	$rs = $dao->salvar($dados);
	echo '<script>alert("Registro salvo com sucesso!");window.location="../views/listaQuestoes.php";</script>';
	
}elseif($_GET['funcao'] == 'alterar'){
	
}elseif($_GET['funcao'] == 'excluir'){
	$id=$_GET['id'];
	$dao->excluir($id);
}

?>