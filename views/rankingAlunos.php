<?php if(!$_GET['m'])include 'header.php';  ?>
<?php 
require_once '../models/db/TurmaDAO.php';

$daoTurma = new TurmaDAO();
if(!$_GET['idTurma'])
	echo '<script>alert("Turma inexistente!"); history.back();</script>';

$rsTurma = $daoTurma->listarPorID($_GET['idTurma']);

?>
<h3 id="titulo_pagina" class="titulo_page">Ranking de alunos</h3>
<center><h5>Turma <?= utf8_encode($rsTurma[0]['nomeSerie']).' '.$rsTurma[0]['nome'].' - '.$rsTurma[0]['turno'];?></h5></center>

<?php for ($j=1;$j<=4;$j++){?>

<?php if($j == 1 || $j == 3){?>
<div class="row">
<?php }?>
<div class="six columns">
<center><h5>Etapa <?= $j?></h5>
	<table>
		<thead>
			<th>Pos.</th>
			<th>Matrícula</th>
			<th>Nome</th>
			<th>Media</th>
		</thead>
		
		<tbody>
		<?php $rsBoletins = $daoTurma->listarBoletins($rsTurma[0]['idTurma'], $j, $rsTurma[0]['serie']);
		
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
				<td colspan="4"><center>Não existe boletins nesta estapa</center></td>
		</tr>
		<?php }
		?>
		</tbody>
	</table>
</center>
</div>
<?php if($j == 2 || $j == 4){?>
</div>
<?php }?>

<?php }?>

<? include 'footer.php';  ?>