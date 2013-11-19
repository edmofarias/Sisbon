<?php
require_once '../models/db/BoletimDAO.php';
require_once '../models/Boletim.php';

$boletimDAO = new BoletimDAO();

//##################### arrays cada linha é um aluno ################
$alunos = $_POST['materias'];
$idBoletim = array();
$serie = $_POST['turma'];
$etapa = $_POST['etapa'];
$materia = $_POST['materia'];

$i=0;
while($i<count($alunos)){

$idAluno[$i] = $alunos[$i];
$idBoletim[$i] = $_POST['idBoletim_'.$alunos[$i]];
$ac1[$i] = $_POST['ac1_'.$alunos[$i]];
$ac2[$i] = $_POST['ac2_'.$alunos[$i]];
$ac3[$i] = $_POST['ac3_'.$alunos[$i]];
$media[$i] =  $_POST['media_'.$alunos[$i]];
$recuperacao[$i] = $_POST['recuperacao_'.$alunos[$i]];
$faltas[$i] = $_POST['faltas_'.$alunos[$i]];
$mediaBimistre1[$i] = $_POST['mediaBimestre1_'.$alunos[$i]];
$mediaBimistre2[$i] = $_POST['mediaBimestre2_'.$alunos[$i]];
$mediaBimistre3[$i] = $_POST['mediaBimestre3_'.$alunos[$i]];
$mediaBimistre4[$i] = $_POST['mediaBimestre4_'.$alunos[$i]];
$totalPontos[$i] = $_POST['totalPontos_'.$alunos[$i]];
$mediaAnual[$i] = $_POST['mediaAnual_'.$alunos[$i]];
$provaFinal[$i] = $_POST['provaFinal_'.$alunos[$i]];
$recProvaFinal[$i] = $_POST['recProvaFinal_'.$alunos[$i]];
$mediaFinal[$i] = $_POST['mediaFinal_'.$alunos[$i]];
$situacao[$i] = $_POST['situacao_'.$alunos[$i]];
$i++;

}

$obs = $_POST['obs'];

$resultadoFinal = $_POST['resultadoFinal'];

$boletim = new Boletim();

$boletim->setIdBoletim($idBoletim);
$boletim->setIdAluno($idAluno);
$boletim->setIdNota($idNota);
$boletim->setIdMateria($idMaterias);
$boletim->setConfirmado($confirmado);

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

//usado para remover as notas que nao estao marcadas com o checkbox
$x = array();
$x = $_POST['idBoletins'];

$diff = array_diff($x, $idBoletim);
if(count($diff) > 0){
	$boletimDAO->excluirNotas($diff, $materia);
}

$rs = $boletimDAO->inserirNotas($idBoletim,$materia, $boletim);
if($rs == 1){
	print "<script> window.alert('Notas Atualizadas com Sucesso!');	
	window.location='../views/professor/formBoletimRapido.php?t=".$serie."&m=".$materia."&e=".$etapa."'; </script>";
}else{
	print "<script> window.alert('Notas nao atualizadas');
	window.location='../views/professor/formBoletimRapido.php?t=".$serie."&m=".$materia."&e=".$etapa."'; </script>";
}
