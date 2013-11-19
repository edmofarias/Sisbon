<? include("headerProf.php");?>

<script>
	function marcaMateria(idCampo){
		if($('#'+idCampo).is(":checked")){
			$('#tr_'+idCampo).attr('class','trSelecionado');
		}else{	
			$('#tr_'+idCampo).removeAttr('class');
		}	
	}

</script>

<?
require_once '../../models/db/BoletimDAO.php';
require_once '../../models/db/AlunoDAO.php';
$daoAluno = new AlunoDAO();
$daoBoletim = new BoletimDAO();

//se o idNota nao estiver nulo lista as notas para editar
if($_GET['idnt'] != null){
	
	$qry = $daoBoletim->listarNota($_GET['idnt']);
	while($row = mysql_fetch_array($qry)){
		$ac1 = $row['ac1'];
		$ac2 = $row['ac2'];
		$ac3 = $row['ac3'];
		$media = $row['media'];
		$recuperacao = $row['recuperacao'];
		$faltas = $row['faltas'];
		$mediaBimestre1 = $row['media1b'];
		$mediaBimestre2 = $row['media2b'];
		$mediaBimestre3 = $row['media3b'];
		$mediaBimestre4 = $row['media4b'];
		$totalPontos = $row['totalPontos'];
		$mediaAnual = $row['mediaAnual'];
		$provaFinal = $row['provaFinal'];
		$recProvaFinal = $row['recProvaFinal'];
		$mediaFinal = $row['mediaFinal'];
		$situacao = $row['situacao'];
		$idMat = $row['idMat'];
		//$materiaEditar = "<input type='hidden' name='materiaEditar' value='".$idMat."'>";
		$disabled = "disabled='disabled'";
	}
}

//lista os dados do aluno
if($_GET['idaln'] == null){
	header('Location:listaAlunoProf.php');
}else{
	$qry2 = $daoAluno->listarPorID($_GET['idaln']);
	while($rowAln = mysql_fetch_array($qry2)){
		$nomeAluno = $rowAln['nome'];
		$matricula = $rowAln['matricula'];
	}
}

if($_GET['id'] != null){
	$qry3 = $daoBoletim->listarBoletim($_GET['id']);
	while($rowBol = mysql_fetch_array($qry3)){
		$serie = $rowBol['serie'];
		$etapa = $rowBol['etapa'];
		$mediaEtapa = $rowBol['mediaEtapa'];
		$resultadoFinal = $rowBol['resultadoFinal'];
		$obs = $rowBol['obs'];
		$confirmado = $rowBol['confirmado'];
		
		$dtGeracao = explode(' ', $rowBol['dataGeracao']);
		$geracao = explode('-', $dtGeracao[0]);
		$dataGeracao = $geracao[2].'/'.$geracao[1].'/'.$geracao[0].' '.$dtGeracao[1];
		
		$dataConfiracao = $rowBol['dataConfirmacao'];
	}
}else{
	header('Location:listaAlunoProf.php');
}
?>
<button class="ui-button" onclick="location.href='index.php';" >Turmas</button>
<br />
<div id="form">
EDITAR BOLETIM
<form name="formBoletim" id="formBoletim" method="post" action="../../controllers/boletimProfessor.php?funcao=nota" >
	<ul>
	<li class="aluno">
			Aluno : <?php echo utf8_encode($nomeAluno)?>&nbsp;&nbsp;&nbsp;Matrícula : <?php echo $matricula?> &nbsp;&nbsp;&nbsp;&nbsp; Data de Criação : <?php echo $dataGeracao?> 
		</li>
	
		<li class="etapa">
		<input type="hidden" name="serie1" value="<?php echo $serie ?>">
		Série <select name="serie" id="serie" disabled="disabled">
		<?php 
		for ($i = 1; $i <= 12; $i++) {
			if($i == 10){
				if($serie == $i){
					echo '<option value="10" selected> 1ᵃ serie </option>';
				}else{
					echo '<option value="10"> 1ᵃ serie </option>';
				}
			}elseif($i == 11){
				if($serie == $i){
					echo '<option value="11" selected> 2ᵃ serie </option>';
				}else{
					echo '<option value="11"> 2ᵃ serie </option>';
				}
			}elseif ($i == 12){
				if($serie == $i){
					echo '<option value="12" selected> 3ᵃ serie </option>';
				}else{
					echo '<option value="12"> 3ᵃ serie </option>';
				}
			}else{
				if($serie == $i){
					echo '<option value="'.$i.'" selected> '.$i.'ᴼ ano </option>';
				}else{
					echo '<option value="'.$i.'"> '.$i.'ᴼ ano </option>';
				}
			}
		}
		?>
		</select>
		</li>
		<li class="etapa">
		<input type="hidden" name="etapa1" value="<?php echo $etapa ?>">
		Etapa <select name="etapa" id="etapa" disabled="disabled">
		<?php 
		for ($i = 1; $i <= 4; $i++) {
			if($etapa == $i){
				echo '<option value="'.$i.'" selected> '.$i.'ᵃ etapa </option>';
			}else{
				echo '<option value="'.$i.'"> '.$i.'ᵃ etapa </option>';
			}
		}
		?>
		</select>
		</li>
			<li class="etapa">
			<?php 
			if($confirmado == 1){
				echo 'Confirmado <input type="checkbox" disabled="disabled" name="confirmado" id="confirmado" value="sim" checked="checked" onclick="confirmaBoletim('.$_GET['id'].',0);"/>';
			}else{
				echo 'Confirmado <input type="checkbox" disabled="disabled" name="confirmado" id="confirmado" value="sim" onclick="confirmaBoletim('.$_GET['id'].',1);"/>';
			}
			?>
		</li>
		
		
		
		<input type="hidden" name="idNota" value="<?echo $_GET['idnt']?>">
		<input type="hidden" name="idBoletim" value="<?echo $_GET['id']?>">
		<input type="hidden" name="idAluno" value="<?echo $_GET['idaln']?>">
		<br />
		<br />
		<br />
		<div class="tabelas">
		<table  border="1px" class="tabela" >
		<thead>
		<tr>
			<th>Materias</th>
			<th></th>
			<th>AC1</th>
			<th>AC2</th>
			<th>AC3</th>
			<th>Média</th>
			<th>Recup.</th>
			<th>Faltas</th>
			<th>Média 1ᵒ Bim.</th>
			<th>Média 2ᵒ Bim.</th>
			<th>Média 3ᵒ Bim.</th>
			<th>Média 4ᵒ Bim.</th>
			<th>Total Pontos</th>
			<th>Média Anual</th>
			<th>Prova Final</th>
			<th>Recup. Final</th>
			<th>Média Final</th>
			<th>Situação</th>
		</tr>
		</thead>
		<?php require_once '../../models/db/ProfessorDAO.php';
			  $professorDAO = new ProfessorDAO();
			  $result1 = $professorDAO->listarMaterias($_SESSION['id']);
			  while($linha = mysql_fetch_array($result1)){
			  
			  	if($_GET['id'] != null){
			  	$mostrou = false;
			  	$result = $daoBoletim->listarNotas($_GET['id']);
			  	while ($linhaNotas = mysql_fetch_array($result)) {
			  		if($linha['id'] == $linhaNotas['idMat']){
		?>
		<tr id="tr_<?echo $linha['id']?>" class="trSelecionado">
		<td><?php echo utf8_encode($linha['nome']);?></td>
		<td><input type="checkbox" name="materias[]" checked="checked" id="<?echo $linha['id']?>" onclick="marcaMateria('<?echo $linha['id']?>')" value="<?echo $linha['id']?>" ></td>
			<td><input type="text" maxlength="4" name="ac1_<?echo $linha['id']?>" id="ac1_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');"  value="<?echo $linhaNotas['ac1']?>"></td>
			<td><input type="text" maxlength="4" name="ac2_<?echo $linha['id']?>" id="ac2_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" value="<?echo $linhaNotas['ac2']?>"></td>
			<td><input type="text" maxlength="4" name="ac3_<?echo $linha['id']?>" id="ac3_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" value="<?echo $$linhaNotas['ac3']?>"></td>
			<td><input type="text" maxlength="4" name="media_<?echo $linha['id']?>" id="media_<?echo $linha['id']?>" value="<?echo $linhaNotas['media']?>"></td>
			<td><input type="text" maxlength="4" name="recuperacao_<?echo $linha['id']?>" id="recuperacao_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" value="<?echo $linhaNotas['recuperacao']?>"></td>
			<td><input type="text" maxlength="4" name="faltas_<?echo $linha['id']?>" id="faltas_<?echo $linha['id']?>" value="<?echo $linhaNotas['faltas']?>"></td>
			<td><input type="text" maxlength="4" name="mediaBimestre1_<?echo $linha['id']?>" id="mediaBimestre1_<?echo $linha['id']?>" value="<?echo $linhaNotas['media1b']?>"></td>
			<td><input type="text" maxlength="4" name="mediaBimestre2_<?echo $linha['id']?>" id="mediaBimestre2_<?echo $linha['id']?>" value="<?echo $linhaNotas['media2b']?>"></td>
			<td><input type="text" maxlength="4" name="mediaBimestre3_<?echo $linha['id']?>" id="mediaBimestre3_<?echo $linha['id']?>" value="<?echo $linhaNotas['media3b']?>"></td>
			<td><input type="text" maxlength="4" name="mediaBimestre4_<?echo $linha['id']?>" id="mediaBimestre4_<?echo $linha['id']?>" value="<?echo $linhaNotas['media4b']?>"></td>
			<td><input type="text" maxlength="5" name="totalPontos_<?echo $linha['id']?>" id="totalPontos_<?echo $linha['id']?>" value="<?echo $linhaNotas['totalPontos']?>"></td>
			<td><input type="text" maxlength="4" name="mediaAnual_<?echo $linha['id']?>" id="mediaAnual_<?echo $linha['id']?>" value="<?echo $linhaNotas['mediaAnual']?>"></td>
			<td><input type="text" maxlength="4" name="provaFinal_<?echo $linha['id']?>" id="provaFinal_<?echo $linha['id']?>"  onKeyup="mediaAluno('<?echo $linha['id']?>');" value="<?echo $linhaNotas['provaFinal']?>"></td>
			<td><input type="text" maxlength="4" name="recProvaFinal_<?echo $linha['id']?>" id="recProvaFinal_<?echo $linha['id']?>"  onKeyup="mediaAluno('<?echo $linha['id']?>');" value="<?echo $linhaNotas['recProvaFinal']?>"></td>
			<td><input type="text" maxlength="4" name="mediaFinal_<?echo $linha['id']?>" id="mediaFinal_<?echo $linha['id']?>" value="<?echo $linhaNotas['mediaFinal']?>"></td>
			<td><input type="text" name="situacao_<?echo $linha['id']?>" id="situacao_<?echo $linha['id']?>" value="<?echo $linhaNotas['situacao']?>"></td>
		</tr>
		<?php 
				$mostrou = true;
				}
			}
			if($mostrou == false){ ?>
				
		<tr id="tr_<?echo $linha['id']?>" >
		<td><?php echo utf8_encode($linha['nome']);?></td>
		<td><input type="checkbox" name="materias[]" id="<?echo $linha['id']?>" onclick="marcaMateria('<?echo $linha['id']?>')" value="<?echo $linha['id']?>" ></td>
			<td><input type="text" maxlength="4" name="ac1_<?echo $linha['id']?>" id="ac1_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');"  value=""></td>
			<td><input type="text" maxlength="4" name="ac2_<?echo $linha['id']?>" id="ac2_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="4" name="ac3_<?echo $linha['id']?>" id="ac3_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="4" name="media_<?echo $linha['id']?>" id="media_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="recuperacao_<?echo $linha['id']?>" id="recuperacao_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="4" name="faltas_<?echo $linha['id']?>" id="faltas_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="mediaBimestre1_<?echo $linha['id']?>" id="mediaBimestre1_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="mediaBimestre2_<?echo $linha['id']?>" id="mediaBimestre2_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="mediaBimestre3_<?echo $linha['id']?>" id="mediaBimestre3_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="mediaBimestre4_<?echo $linha['id']?>" id="mediaBimestre4_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="5" name="totalPontos_<?echo $linha['id']?>" id="totalPontos_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="mediaAnual_<?echo $linha['id']?>" id="mediaAnual_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="provaFinal_<?echo $linha['id']?>" id="provaFinal_<?echo $linha['id']?>"  onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="4" name="recProvaFinal_<?echo $linha['id']?>" id="recProvaFinal_<?echo $linha['id']?>"  onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="4" name="mediaFinal_<?echo $linha['id']?>" id="mediaFinal_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" name="situacao_<?echo $linha['id']?>" id="situacao_<?echo $linha['id']?>" value=""></td>
		</tr>
				
			<?php }
		}else{?>
			
			
			<tr id="tr_<?echo $linha['id']?>" >
		<td><?php echo utf8_encode($linha['nome']);?></td>
		<td><input type="checkbox" name="materias[]" id="<?echo $linha['id']?>" onclick="marcaMateria('<?echo $linha['id']?>')" value="<?echo $linha['id']?>" ></td>
			<td><input type="text" maxlength="4" name="ac1_<?echo $linha['id']?>" id="ac1_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');"  value=""></td>
			<td><input type="text" maxlength="4" name="ac2_<?echo $linha['id']?>" id="ac2_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="4" name="ac3_<?echo $linha['id']?>" id="ac3_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="4" name="media_<?echo $linha['id']?>" id="media_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="recuperacao_<?echo $linha['id']?>" id="recuperacao_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="4" name="faltas_<?echo $linha['id']?>" id="faltas_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="mediaBimestre1_<?echo $linha['id']?>" id="mediaBimestre1_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="mediaBimestre2_<?echo $linha['id']?>" id="mediaBimestre2_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="mediaBimestre3_<?echo $linha['id']?>" id="mediaBimestre3_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="mediaBimestre4_<?echo $linha['id']?>" id="mediaBimestre4_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="5" name="totalPontos_<?echo $linha['id']?>" id="totalPontos_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="mediaAnual_<?echo $linha['id']?>" id="mediaAnual_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" maxlength="4" name="provaFinal_<?echo $linha['id']?>" id="provaFinal_<?echo $linha['id']?>"  onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="4" name="recProvaFinal_<?echo $linha['id']?>" id="recProvaFinal_<?echo $linha['id']?>"  onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="4" name="mediaFinal_<?echo $linha['id']?>" id="mediaFinal_<?echo $linha['id']?>" value=""></td>
			<td><input type="text" name="situacao_<?echo $linha['id']?>" id="situacao_<?echo $linha['id']?>" value=""></td>
		</tr>
			
			
		<?php }
	}?>
		</table>
		</div>
		
		<br clear="all"/>
		<li>
			Obs.: <textarea rows="3" cols="100" name="obs" id="obs"><?php echo $obs?></textarea> 
		</li>
		<br clear="all"/>
		<li>
			<input type="submit" name="submit" value="Adicionar Notas"/>
		</li>
		
		<li>
			Media Etapa <br /><input type="text" readonly="readonly" name="mediaEtapa" id="mediaEtapa" value="<?echo $mediaEtapa?>">
		</li>
		<li >
			Resultado Final <br /><input type="text" name="resultadoFinal" id="resultadoFinal" value="<?echo $resultadoFinal?>">
		</li>
		
	</ul>
</form>
</div>

<? include("footerProf.php");?>
