<?php include 'header.php';?>
<?php 
require_once '../models/db/TurmaDAO.php';
require_once '../models/db/MateriaDAO.php';

$daoTurma = new TurmaDAO();
$daoMateria = new MateriaDAO();

$rsMateria = $daoMateria->listar();
$rsTurma = $daoTurma->listarSeries();
?>
<div class="row">
	
	<form action="" method="post">
		
		<div class="row">
			<div class="three columns">
				<label>Quantidade de questões</label>
				<input type="text" name="qtd" required="true" maxlength="2" />
			</div>
			<div class="three columns">
				
				<label> Disciplina</label> 
					<select name="materia">
					<option value="">Selecione a disciplina...</option>
					
					<?php foreach ($rsMateria as $linha){
						
						echo '<option value="'.$linha['id'].'">'.utf8_decode(utf8_encode($linha['nome'])).'</option>';
						
					}?>
					
				</select> 
			</div>
			<div class="three columns end">
				
				<label> Série</label>
				<select name="serie">
					<option value="">Selecione a série...</option>
					
					<?php foreach ($rsTurma as $linha){
						
						echo '<option value="'.$linha['id'].'">'.(utf8_encode($linha['serie'])).'</option>';
						
					}?>
					
				</select> 
			</div>
			<div class="two columns end">
				<label>&nbsp;</label>
				<input class="button" type="submit" value="Gerar Questionario" />
			</div>
		</div>
		
	</form>
	
</div>

<?php

	if($_POST){ ?>
		
		<form action="../controllers/verificarQuestionario.php" method="post">
					
			<input type="hidden" name="qtd" value="<?= $_POST['qtd']?>" />
		
	<?	require_once '../models/db/QuestoesDAO.php';
		$dao = new QuestoesDAO();
		$rs0 = $dao->listar();
		
		//$rs = mysql_fetch_array($rs0);
		
		$qtdRS = count($rs0) - 1;
		//echo $qtdRS;
		if($qtdRS >= 0){
			//echo 'fdknbg';
			$questoesExcluidas = array();
			$i = 1;
			while($i <=	 $_POST['qtd']){ //loop para listar a qtd de questoes que o usuario escolheu 
				$q = mt_rand(0, $qtdRS); // escolho uma questao aleatoria
				//echo $q.'<br>';		
				if(!in_array($q, $questoesExcluidas)){// verifico se ela ja foi listada
					
			?>
			
			<div class="row">
				
					<input type="hidden" name="questao<?= $i ?>" value="<?= $rs[$q]['id']?>" />
					
				<fieldset>
					<legend> Questão <?= $i ?> </legend>
					<div class="row">
						<div class="twelve columns">
							<p><?= $i.') '.$rs[$q]['nome'] ?> </p> 
						</div>
					</div>
					
					<div class="row">
						<div class="twelve columns">
							<p><input type="radio" name="resposta<?=$i?>" id="A" value="A"><?= ' a)'.$rs[$q]['a'] ?> </p> 
						</div>
					</div>
					
					<div class="row">
						<div class="twelve columns">
							<p><input type="radio" name="resposta<?=$i?>" id="B" value="B"><?= ' b)'.$rs[$q]['b'] ?> </p> 
						</div>
					</div>
					
					<div class="row">
						<div class="twelve columns">
							<p><input type="radio" name="resposta<?=$i?>" id="C" value="C"><?= ' c)'.$rs[$q]['c'] ?> </p> 
						</div>
					</div>
					
					<div class="row">
						<div class="twelve columns">
							<p><input type="radio" name="resposta<?=$i?>" id="D" value="D"><?= ' d)'.$rs[$q]['d'] ?> </p> 
						</div>
					</div>
					
					<div class="row">
						<div class="twelve columns">
							<p><input type="radio" name="resposta<?=$i?>" id="E" value="E"><?= ' e)'.$rs[$q]['e'] ?> </p> 
						</div>
					</div>
				</fieldset>
			</div>
			
				
			<?
			$i++;
			}
			
			$questoesExcluidas[] = $q;// adiciono a questao lista no array, para nao ser mais listada
			
		}//while
		?>
		
		<div class="row">
			<div class="two columns">
				<input type="submit" class="button" value="Concluir Questionário" /> 
			</div>
		</div>	
		
<?	}else{?>
		
		Não existe questões!
		
	<? } ?>
		</form>
<?php }// post

?>

<?php include 'footer.php';?>