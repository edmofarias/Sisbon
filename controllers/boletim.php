<?php
require_once '../models/db/BoletimDAO.php';
require_once '../models/Boletim.php';

$boletimDAO = new BoletimDAO();

//captura os dados enviado pelo formulario por post
$idAluno = $_POST['idAluno'];
$idNota = $_POST['idNota'];

$idBoletim = $_POST['idBoletim'];

$serie = $_POST['serie'];
$etapa = $_POST['etapa'];

if($_POST['confirmado'] == 'sim')
	$confirmado = 1;
else 
	$confirmado = 0;

//##################### arrays cada linha é uma materia ################
$materias = $_POST['materias'];

$i=0;
while($i<count($materias)){
$idMaterias[$i] = $materias[$i];
$ac1[$i] = $_POST['ac1_'.$materias[$i]];
$ac2[$i] = $_POST['ac2_'.$materias[$i]];
$ac3[$i] = $_POST['ac3_'.$materias[$i]];
$media[$i] =  $_POST['media_'.$materias[$i]];
$recuperacao[$i] = $_POST['recuperacao_'.$materias[$i]];
$faltas[$i] = $_POST['faltas_'.$materias[$i]];
$mediaBimistre1[$i] = $_POST['mediaBimestre1_'.$materias[$i]];
$mediaBimistre2[$i] = $_POST['mediaBimestre2_'.$materias[$i]];
$mediaBimistre3[$i] = $_POST['mediaBimestre3_'.$materias[$i]];
$mediaBimistre4[$i] = $_POST['mediaBimestre4_'.$materias[$i]];
$totalPontos[$i] = $_POST['totalPontos_'.$materias[$i]];
$mediaAnual[$i] = $_POST['mediaAnual_'.$materias[$i]];
$provaFinal[$i] = $_POST['provaFinal_'.$materias[$i]];
$recProvaFinal[$i] = $_POST['recProvaFinal_'.$materias[$i]];
$mediaFinal[$i] = $_POST['mediaFinal_'.$materias[$i]];
$situacao[$i] = $_POST['situacao_'.$materias[$i]];
$i++;
}
//########## arrays fim ###########################3

$obs = $_POST['obs'];
$resultadoFinal = $_POST['resultadoFinal'];

// //verifica se a materia ja foi adicionada
// $result = $boletimDAO->listarNotas($idBoletim);
// while($linha = mysql_fetch_array($result)){
// 	if($linha['idMateria'] == $idMateria){
// 		print "<script> alert('A materia selecionada ja esta cadastrada e contem notas'); window.location = '../views/formBoletim.php?idaln=".$idAluno."&id=".$idBoletim."';</script>";
// 		$idBoletim= '';
// 	}
// }


$boletim = new Boletim();

//seta os dados no objeto do tipo boletim
$boletim->setIdBoletim($idBoletim);
$boletim->setIdAluno($idAluno);
$boletim->setIdNota($idNota);
$boletim->setIdMateria($idMaterias);
$boletim->setConfirmado($confirmado);

$boletim->setDataGeracao(date('Y-m-d H:i:s'));

$boletim->setSerie($serie);
$boletim->setEtapa($etapa);
$boletim->setObs($obs);

$boletim->setAc1($ac1);
$boletim->setAc2($ac2);
$boletim->setAc3($ac3);
$boletim->setMedia($media);
$boletim->setRecuperacao($recuperacao);
$boletim->setFaltas($faltas);
$boletim->setMedia1b($mediaBimistre1);
$boletim->setMedia2b($mediaBimistre2);
$boletim->setMedia3b($mediaBimistre3);
$boletim->setMedia4b($mediaBimistre4);
$boletim->setMediaFinal($mediaFinal);
$boletim->setTotalPontos($totalPontos);
$boletim->setProvaFinal($provaFinal);
$boletim->setRecProvaFinal($recProvaFinal);
$boletim->setMediaAnual($mediaAnual);
$boletim->setSituacao($situacao);

$boletim->setResultadoFinal($resultadoFinal);

if ($_GET['funcao'] == 'nota')
{
	$boletimDAO->inserirNota($boletim, "a");
}
elseif($_GET['funcao'] == 'inserir')
{
	$boletimDAO->inserirBoletim($boletim);
}
elseif($_GET['funcao'] == 'excluir')
{
	$boletimDAO->excluir($_GET['idBol'], $_GET['idaln']);
}
elseif($_GET['funcao'] == 'confirma')
{
	$boletimDAO->confirmaBoletim($_GET['idaln'], $_GET['id'], $_GET['val']);
}

// if($idBoletim != ''){
// 	if($idNota != ''){
// 		$boletim->setIdMateria($_POST['materiaEditar']);
// 		$boletimDAO->editarNota($boletim, "a");
// 	}else{
		
// 	}
// }
