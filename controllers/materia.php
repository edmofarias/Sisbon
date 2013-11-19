<?php 
require_once '../models/db/Conexao.php';
require_once  '../models/Materia.php';
require_once '../models/db/MateriaDAO.php';

$nome = $_POST['nome'];


$materia = new Materia();

$materia->setNome($nome);


$dao = new MateriaDAO();

if($_GET['funcao'] == 'inserir')
{
	$dao->inserir($materia);
}

if($_GET['funcao'] == 'alterar')
{
	$id = $_POST['idMat'];
	$dao->alterar($materia, $id);
}

if($_GET['funcao'] == 'excluir')
{
	$id = $_GET['id'];
	$dao->excluir($id);
}

?>