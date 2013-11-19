<?php  
require_once '../models/db/Conexao.php';
require_once  '../models/Questionario.php';

$quiz = new Questionario();

$quiz->setEnunciado($_POST['enunciado']);
$quiz->setCorreta($_POST['correta']);
$quiz->setA($_POST['a']);
$quiz->setB($_POST['b']);
$quiz->setC($_POST['c']);
$quiz->setD($_POST['d']);
$quiz->setMateria($_POST['materia']);
$quiz->setSerie($_POST['serie']);
$quiz->setPontos($_POST['pontos']);

$dao = new QuestionarioDAO();

if($_GET['funcao'] == 'inserir')
{
	$dao->inserir($quiz);
}

if($_GET['funcao'] == 'alterar')
{
	$id = $_POST['id'];
	$dao->alterar($quiz, $id);
}

if($_GET['funcao'] == 'excluir')
{
	$id = $_GET['id'];
	$dao->excluir($id);
}

?>