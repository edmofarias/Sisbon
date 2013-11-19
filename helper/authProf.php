<?php
session_start();
session_register();

//Verifica se há dados ativos na sessão
	if (empty($_SESSION["nome"]) || empty($_SESSION["login"]) || empty($_SESSION["id"]) ) {
		//Caso não exista dados registrados, exige login
		header("Location:../../login.php");
	}
	
	if($_SESSION['tipo'] == 'ADMIN'){
		header('Location: ../views/index.php');
	}elseif($_SESSION['tipo'] == 'ALUNO'){
		header('Location: ../views/aluno/index.php');
	}
?>