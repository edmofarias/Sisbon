<?php include 'headerProf.php';?>
<script>
function listarAlunos(){
	var x;
	var y;
	var z;
	x = $('#turma').val();
	y = $('#materia').val();
	z = $('#etapa').val();
	window.location="formBoletimRapido.php?t="+x+"&m="+y+"&e="+z;
}
</script>
	<?php 
		require_once '../../models/db/ProfessorDAO.php';
		$dao = new ProfessorDAO();
		$result = $dao->listarTurmas($_SESSION['id']);
		$resultMat = $dao->listarMaterias($_SESSION['id']);
	?>
	
	<div class="row">
		<div class="two columns">
			<label>Turma:</label>
				<select name="turma" id="turma">
				<?php foreach ($result as $linha){?>
					<option value="<?php echo $linha['idTurma'];?>"><?php echo (utf8_encode($linha['nomeSerie'].' '.$linha['nome']));?></option>
				<?php }?>
				</select>
		</div>
		
		<div class="three columns">
		<label>Matéria:</label>
			<select name="materia" id="materia">
			<?php foreach ($resultMat as $linha){?>
				<option value="<?php echo $linha['id'];?>"><?php echo utf8_encode(utf8_decode($linha['nome']));?></option>
			<?php }?>
			</select>
		</div>
		
		<div class="two columns">
			<label>Etapa:</label>
			<select name="etapa" id="etapa">
				<option value="1">1 Etapa</option>
				<option value="2">2 Etapa</option>
				<option value="3">3 Etapa</option>
				<option value="4">4 Etapa</option>
			</select>
		</div>
		<div class="two columns end" style="padding-top: 8px;">
			<button onclick="listarAlunos();" class="button">Listar boletins</button>
		</div>
	</div>
	
	
<?php include 'footerProf.php';?>