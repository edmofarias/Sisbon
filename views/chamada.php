<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />

	<!-- APLICACAO FRAMEWORK FOUNDATION ZURB -->
		 <script type="text/javascript" src="../helper/foundation/javascripts/jquery.js"></script>
		 <script type="text/javascript" src="../helper/foundation/javascripts/foundation.min.js"></script>
		  <script type="text/javascript" src="../helper/foundation/javascripts/modernizr.foundation.js"></script>
		  <script type="text/javascript" src="../helper/foundation/javascripts/jquery.foundation.forms.js">$(document).foundationCustomForms();</script>
		  <link rel="stylesheet" type="text/css" href="../helper/foundation/stylesheets/foundation.css" />
		  <link rel="stylesheet" type="text/css" href="../helper/foundation/stylesheets/app.css" />
		<!-- FINAL LINKS FRAMEWORK FOUDATION ZURB -->
<style type="text/css">
body{font-family: "Arial", Helvetica, sans-serif; font-size: 10px; width: 100%; height: 100%;}
.titulo, .lista{margin: 8px;}
.titulo_ficha{text-align: center; font-size: 18px; font-weight: bold;}
.subtitulo_ficha{text-align: center; font-size: 15px; font-weight: bold;}
.row{width: 583px;
	min-width: 200px;}
</style>
</head>
<body>
	<?
	require_once("../models/db/TurmaDAO.php");
	
	$daoTurma = new TurmaDAO();
	
	$alunos = $daoTurma -> listarAlunos($_GET['idturma']);
		
	?>
	<table class="titulo">
		<tr>
			<td>
				<div class="logomarca" >
					<img src="imagens/logo_sisbon_small.png" />
				</div>
			</td>
			<td>
				<div class="titulo_ficha">
						Assinatura de alunos por s&eacute;rie/turma. &nbsp;&nbsp; Data: <?= date('d/m/Y');?>
					</div>
					<br/>
					<div class="subtitulo_ficha">
						S&eacute;rie: <?= utf8_encode($alunos[0]['serie'])." ".$alunos[0]['nomeTurma']." - ".$alunos[0]['turno'];?> &nbsp;&nbsp;&nbsp;Disciplina:_______________________
					</div>
			</td>
		</tr>
	</table>
	
	<table class="lista">
	
		<?php 
		$i = 1;
		foreach ($alunos as $aluno){
		
			if(!$aluno['foto']){
				$aluno['foto'] = "semfoto.jpg";
			}
			
			?>
			<tr>
				<td>
					<div class="foto_aluno" >
						<img src="../helper/fotos/<?= $aluno['foto']?>" height="69" width="52" style="padding: 2px;" />
					</div>
				</td>
				<td>
					<div class="row" >
						<div class="one columns">Nº <?= $i ?></div>
						<div class="seven columns"> <?= utf8_decode(utf8_encode($aluno['nome'])) ?></div>
						<div class="four columns">Matr&iacute;cula: <?= utf8_encode($aluno['matricula']) ?></div>
					</div>
					<div class="row" style="font-size: 11px;" >
					&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;&nbsp;8&nbsp;&nbsp;&nbsp;&nbsp;9
					&nbsp;&nbsp;10&nbsp;&nbsp;11&nbsp;&nbsp;12&nbsp;&nbsp;13&nbsp;&nbsp;14&nbsp;&nbsp;15&nbsp;&nbsp;16&nbsp;&nbsp;17&nbsp;&nbsp;18&nbsp;&nbsp;19
					&nbsp;&nbsp;20&nbsp;&nbsp;21&nbsp;&nbsp;22&nbsp;&nbsp;23&nbsp;&nbsp;24&nbsp;&nbsp;25&nbsp;&nbsp;26&nbsp;&nbsp;27&nbsp;&nbsp;28&nbsp;&nbsp;29&nbsp;&nbsp;30&nbsp;&nbsp;31
						<img alt="" src="imagens/grade.jpg" style="border: 1px solid #000; width: 95%;">
					</div>
				</td>
			</tr>
		<?php
			$i++; 
		}
		if($i == 1){
		?>
		<tr>
			<td>Não existe alunos nessa turma.</td>
		</tr>
		<?php }?>
	
	</table>
	
	<script type="text/javascript">
$(window.ready(window.print()));
</script>
	
</body>
</html>
