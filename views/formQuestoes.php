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
<form action="../controllers/questoes.php?funcao=inserir" method="post">
	
	<h3>Nova Questão</h3>
	
	<fieldset>	
		<div class="row">
			<div class="twelve columns">
				
				<label>Enunciado</label>
				<textarea name="nome" cols="60" rows="6"></textarea>
				
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				
				<label> <input type="radio" name="correta" value="A" /> Alternativa A</label>
				<textarea name="a" cols="60" rows="2"></textarea>
				
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				
				<label> <input type="radio" name="correta" value="B" /> Alternativa B</label>
				<textarea name="b" cols="60" rows="2"></textarea>
				
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				
				<label> <input type="radio" name="correta" value="C" /> Alternativa C</label>
				<textarea name="c" cols="60" rows="2"></textarea>
				
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				
				<label> <input type="radio" name="correta" value="D" /> Alternativa D</label>
				<textarea name="d" cols="60" rows="2"></textarea>
				
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				
				<label> <input type="radio" name="correta" value="E" /> Alternativa E </label> 
				<textarea name="e" cols="60" rows="2"></textarea>
				
			</div>
		</div>
		
		<div class="row">
			<div class="two columns">
				
				<label> Pontos</label> 
					<input type="text" name="pontuacao" onkeyup="Mascara(this, Valor)" />
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
		</div>
		
		<div class="row">
			<div class="two columns">
					
				<input type="submit" class="button" value="Salvar" />
				<br clear="all"/>
				<br clear="all"/>
				
			</div>
		</div>
	</fieldset>
	
</form>
</div>



<?php include 'footer.php';?>
