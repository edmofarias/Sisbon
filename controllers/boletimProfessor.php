<?php
require_once '../models/db/BoletimDAO.php';
require_once '../models/Boletim.php';

$boletimDAO = new BoletimDAO();

$idAluno = $_POST['idAluno'];
$idNota = $_POST['idNota'];
$idMateria = $_POST['materia'];
$idBoletim = $_POST['idBoletim'];

$serie = $_POST['serie1'];
$etapa = $_POST['etapa1'];

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

$obs = $_POST['obs'];

$resultadoFinal = $_POST['resultadoFinal'];

$confirmado = $_POST['confirma'];
if($confirmado == 1)
$confirmado = 1;
elseif($confirmado == 0)
$confirmado = 0;

$boletim = new Boletim();

$boletim->setIdBoletim($idBoletim);
$boletim->setIdAluno($idAluno);
$boletim->setIdNota($idNota);
$boletim->setIdMateria($idMaterias);
$boletim->setConfirmado($confirmado);

//$boletim->setDataGeracao(date('Y-m-d H:i:s'));

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

if($idBoletim != ''){
	if($idNota != ''){
		$boletimDAO->editarNota($boletim, "p");
	}else{
		$boletimDAO->inserirNota($boletim, "p");
	}
}
