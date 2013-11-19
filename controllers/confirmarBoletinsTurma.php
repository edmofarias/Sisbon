<?php
require_once '../models/db/BoletimDAO.php';
require_once '../models/Boletim.php';
require_once '../models/db/TurmaDAO.php';

$boletimDAO = new BoletimDAO();
$turmaDAO = new TurmaDAO();

$rsTurma = $turmaDAO->listarPorID($_POST['turma']);

//captura a avariavel enviada por ajax
$etapa = $_POST['etapa'];
$turma = $_POST['turma'];
$acao = $_POST['acao'];
$serie = $rsTurma[0]['serie'];

$boletim = new Boletim();

//seta os dados no objeto do tipo boletim
$boletim->setConfirmado($acao);
$boletim->setSerie($turma);
$boletim->setEtapa($etapa);

$rsBoletinsTurma = $turmaDAO->listarBoletins($turma, $etapa, $serie);

foreach ($rsBoletinsTurma as $boletim){

	/*Altera o status do boletim para Confirmado/não confirmado*/
	$rsBoletim = $boletimDAO->confirmaBoletim(0, $boletim['id'], $acao);
}

if($acao == 1){
	$a = 'CONFIRMADOS';
}else{
	$a = 'NÃO CONFIRMADOS';
}

$msg = 'Os Boletins da turma '.utf8_encode($rsTurma[0]['nomeSerie']).' '.$rsTurma[0]['nome'].' - '.$etapa.' etapa , foram '.$a;
$array['x'] = 1;
 $array['msg'] = $msg;
echo json_encode($array);exit;

