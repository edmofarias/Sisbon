<?php
require_once '../models/db/BoletimDAO.php';
require_once '../models/Boletim.php';
require_once '../models/db/TurmaDAO.php';

$boletimDAO = new BoletimDAO();
$turmaDAO = new TurmaDAO();

//captura a avariavel enviada por ajax
$etapa = $_POST['etapa'];
$turma = $_POST['turma'];

$boletim = new Boletim();

//seta os dados no objeto do tipo boletim
$boletim->setConfirmado(0);
$boletim->setSerie($turma);
$boletim->setEtapa($etapa);

$rsAlunosTurma = $turmaDAO->listarAlunos($turma);

foreach ($rsAlunosTurma as $aluno){
	$boletim->setIdAluno($aluno['idAluno']);
	$boletim->setDataGeracao(date('Y-m-d H:i:s'));

	/*insere os boletins de todos os alunos da turma*/
	$rsBoletim = $boletimDAO->inserirBoletimPorTurma($boletim);
}

$rsTurma = $turmaDAO->listarPorID($turma);
$msg = 'Os Boletins da turma '.utf8_encode($rsTurma[0]['nomeSerie']).' '.$rsTurma[0]['nome'].' - '.$etapa.' etapa foram gerados com sucesso!';
$array['x'] = 1;
 $array['msg'] = $msg;
echo json_encode($array);exit;

