<?php 
require_once '../models/db/Conexao.php';
require_once  '../models/Turma.php';
require_once '../models/db/TurmaDAO.php';

$nome = addslashes($_POST[0]['nome']);
$serie = addslashes($_POST[0]['serie']);
$turno = addslashes($_POST[0]['turno']);
$idTurma = addslashes($_POST[0]['idTurma']);

if($_POST[1] == 0)
	$materias = array();
else
	$materias = $_POST[1];

$turma = new Turma();

$turma->setNome($nome);
$turma->setIdTurma($idTurma);
$turma->setTurno($turno);
$turma->setSerie($serie);
$turma->setMaterias($materias);

$dao = new TurmaDAO();

if($_GET['funcao'] == 'inserir')
{
	$dao->inserir($turma);
}

if($_GET['funcao'] == 'alterar')
{
	$dao->alterar($turma, $idTurma);
}

if($_GET['funcao'] == 'excluir')
{
	$id = $_GET['id'];
	$dao->excluir($id);
}

?>