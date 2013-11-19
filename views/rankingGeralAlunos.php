<?php if(!$_GET['m'])include 'header.php';  ?>
<?php 
require_once '../models/db/TurmaDAO.php';

$daoTurma = new TurmaDAO();
if(!$_GET['etapa'])
	echo '<script>alert("etapa inexistente!"); history.back();</script>';

?>
<h3 id="titulo_pagina" class="titulo_page">Ranking de alunos</h3>
<center><h5>Etapa <?= $_GET['etapa'] ?></h5></center>
<?php 

$rsTurmas = $daoTurma->listar();

	foreach ($rsTurmas as $turma){
?>

<div class="row">
<div class="nine columns centered">
<center><h5>Turma <?= utf8_encode($turma['nomeSerie']).' '.$turma['nome'].' - '.($turma['turno'])?></h5>
	<table>
		<thead>
			<th>Posição</th>
			<th>Matrícula</th>
			<th>Nome</th>
			<th>Média</th>
		</thead>
		
		<tbody>
		<?php $rsBoletins = $daoTurma->listarBoletins($turma['idTurma'], $_GET['etapa'], $turma['serie']);
		
		if(count($rsBoletins)){
			$i=1;
			foreach ($rsBoletins as $boletim){
		?>
		<tr>
			<td><center><?= $i?></center></td>
			<td><center><?= $boletim['matricula']?></center></td>
			<td><?= $boletim['nome']?></td>
			<td><center><?= $boletim['mediaEtapa']?></center></td>
		</tr>
		
		<?php $i++; }
		}else{?>
			<tr>
				<td colspan="4"><center>Não existe boletins nesta turma</center></td>
		</tr>
		<?php }
		?>
		</tbody>
	</table>
</center>
</div>
</div>

<?php }?>
<? include 'footer.php';  ?>