<?php
session_start();
session_register();
$time = time() - $_SESSION['tempoLimite'];
if($time <= $_SESSION['time']){

	//Verifica se há dados ativos na sessão
	if (empty($_SESSION["nome"]) || empty($_SESSION["login"]) || empty($_SESSION["id"]) ) {
		//Caso não exista dados registrados, exige login
		header("Location:../login.php");
	}
	//permissoes para PROFESSOR E ALUNO
	if($_SESSION['tipo'] == 'PROFESSOR'){
		header('Location: views/professor/index.php');
	}elseif($_SESSION['tipo'] == 'ALUNO'){
		if($index == null){
			header('Location: ../views/aluno/index.php');
		}else{
			header('Location: views/aluno/index.php');
		}
	}
	$_SESSION['time'] = time();
}else{
	include "Destroy.php";
}
?>