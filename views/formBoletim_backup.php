<? include("header.php");?>

<script>
function enviar(){
	$('#formBoletim').submit();
}
function validaMateria(){
	if (document.formBoletim.materia.value == "vazio"){
	    alert("Selecione a materia");
	    document.formBoletim.materia.focus();
	return false;}else{
	enviar();
		}
}



function confirmaBoletim(idBol, val) {
	if(val == 0){
		msg = "Tem certeza que deseja nao confirmar este boletim ?!";
	}else{
		msg = "Tem certeza que deseja confirmar este boletim ?!";
		}
	if (window.confirm(msg)){
		window.location.href = "../controllers/boletim.php?funcao=confirma&idaln=<?php echo $_GET['idaln']?>&id=" + idBol + "&val="+val;
	} else {
		if($('#confirmado').is(":checked")){
			$('#confirmado').attr('checked',false);
		}else{	
			$('#confirmado').attr('checked',true);
		}
	 }
	}

</script>

<?
require_once '../models/db/BoletimDAO.php';
require_once '../models/db/AlunoDAO.php';
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
		$materiaEditar = "<input type='hidden' name='materiaEditar' value='".$idMat."'>";
		$disabled = "disabled='disabled'";
	}
}

//lista os dados do aluno
if($_GET['idaln'] == null){
	header('Location:listaAluno.php');
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
	header('Location:listaAluno.php');
}
?>
<div id="form">
EDITAR BOLETIM
<form name="formBoletim" id="formBoletim" method="post" action="../controllers/boletim.php" >
	<ul>
	<li class="aluno">
			Aluno : <?php echo utf8_encode($nomeAluno)?>&nbsp;&nbsp;&nbsp;Matrícula : <?php echo $matricula?> &nbsp;&nbsp;&nbsp;&nbsp; Data de Criação : <?php echo $dataGeracao?> 
		</li>
	
		<li class="etapa">
		<select name="serie" id="serie">
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
		<select name="etapa" id="etapa">
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
				echo 'Confirmado <input type="checkbox" name="confirmado" id="confirmado" value="sim" checked="checked" onclick="confirmaBoletim('.$_GET['id'].',0);"/>';
			}else{
				echo 'Confirmado <input type="checkbox" name="confirmado" id="confirmado" value="sim" onclick="confirmaBoletim('.$_GET['id'].',1);"/>';
			}
			?>
		</li>
		
		<li class="etapa">
		
		<input type="hidden" name="idNota" value="<?echo $_GET['idnt']?>">
		<input type="hidden" name="idBoletim" value="<?echo $_GET['id']?>">
		<input type="hidden" name="idAluno" value="<?echo $_GET['idaln']?>">
		
		<select name="materia" id="materia" <?php echo $disabled?>>
		<option value="vazio">Selecione a materia...</option>
		<?php 
			//lista as materias cadastradas no banco de dados
			require_once '../models/db/MateriaDAO.php';
			$daoMat = new MateriaDAO();
			$rs = $daoMat->listar();
			while ($result = mysql_fetch_array($rs)) {
			//se a materia listada for igual a materia da nota para editar, mostra a materia selecionada
			if($idMat == $result['id']){
				echo '<option value="'.$result['id'].'" selected>'.utf8_encode($result['nome']).'</option>';
			}else{
				echo '<option value="'.$result['id'].'">'.utf8_encode($result['nome']).'</option>';
			}
			}
		?>
			</select>
			<?php echo $materiaEditar;?>
		</li>
		
		
		<br clear="all"/>
		<li class="notas">
			AC1 <br /> <input style="width:40px;" type="text" maxlength="5" name="ac1" id="ac1" onKeyDown="mediaAluno();" onKeyPress="mediaAluno();" onKeyup="mediaAluno();"  value="<?echo $ac1?>">
		</li>
		<li class="notas">
			AC2 <br /><input style="width:40px;" type="text" maxlength="5" name="ac2" id="ac2"  onKeyDown="mediaAluno();" onKeyPress="mediaAluno();" onKeyup="mediaAluno();" value="<?echo $ac2?>">
		</li>
		<li class="notas">
			AC3 <br /><input style="width:40px;" type="text" maxlength="5" name="ac3" id="ac3"  onKeyDown="mediaAluno();" onKeyPress="mediaAluno();" onKeyup="mediaAluno();" value="<?echo $ac3?>">
		</li>
		<li class="notas">
			Média <br /><input style="width:40px;" type="text" maxlength="5" name="media" maxlength="3" id="media" value="<?echo $media?>">
		</li>
		<li class="notas">
			Recuperação <br /><input style="width:40px;" type="text" maxlength="5" name="recuperacao" id="recuperacao"  onKeyDown="mediaAluno();" onKeyPress="mediaAluno();" onKeyup="mediaAluno();" value="<?echo $recuperacao?>">
		</li>
		<li class="notas">
			Faltas <br /><input style="width:40px;" type="text" maxlength="5" name="faltas" id="faltas" value="<?echo $faltas?>">
		</li>
		<li class="notas">
			Media 1 Bimestre <br /><input style="width:40px;" type="text" maxlength="5" name="mediaBimestre1" id="mediaBimestre1" value="<?echo $mediaBimestre1?>">
		</li>
		<li class="notas">
			Media 2 Bimestre <br /><input style="width:40px;" type="text" maxlength="5" name="mediaBimestre2" id="mediaBimestre2" value="<?echo $mediaBimestre2?>">
		</li>
		<li class="notas">
			Media 3 Bimestre <br /><input style="width:40px;" type="text" maxlength="5"  name="mediaBimestre3" id="mediaBimestre3" value="<?echo $mediaBimestre3?>">
		</li>
		<li class="notas">
			Media 4 Bimestre <br /><input style="width:40px;" type="text" maxlength="5"  name="mediaBimestre4" id="mediaBimestre4" value="<?echo $mediaBimestre4?>">
		</li>
		<li class="notas">
			Total Pontos <br /><input style="width:40px;" style="width:40px;" type="text" maxlength="5" name="totalPontos" id="totalPontos" value="<?echo $totalPontos?>">
		</li>
		<li class="notas">
			Media Anual <br /><input style="width:40px;" type="text" maxlength="5" name="mediaAnual" id="mediaAnual" value="<?echo $mediaAnual?>">
		</li>
		<li class="notas">
			Prova Final <br /><input style="width:40px;" type="text" maxlength="5" name="provaFinal" id="provaFinal"  onKeyDown="mediaAluno();" onKeyPress="mediaAluno();" onKeyup="mediaAluno();" value="<?echo $provaFinal?>">
		</li>
		<li class="notas">
			Rec. Prova Final <br /><input style="width:40px;" type="text" maxlength="5" name="recProvaFinal" id="recProvaFinal"  onKeyDown="mediaAluno();" onKeyPress="mediaAluno();" onKeyup="mediaAluno();" value="<?echo $recProvaFinal?>">
		</li>
		<li class="notas">
			Media Final <br /><input style="width:40px;" type="text" maxlength="5" name="mediaFinal" id="mediaFinal" value="<?echo $mediaFinal?>">
		</li>
		<li class="notas">
			Situacao <br /><input style="width:40px;" type="text" name="situacao" id="situacao" value="<?echo $situacao?>">
		</li>
		<br clear="all"/>
		<li class="notas">
			Obs.: <textarea rows="3" cols="100" name="obs" id="obs"><?php echo $obs?></textarea> 
		</li>
		<br clear="all"/>
		<li>
			<input type="submit" name="submit" value="Adicionar Notas" onclick="validaMateria(); return false;" />
		</li>
		
		<li>
		
		<table border="1px" >
		<thead>
		<tr>
			<th>Materia</th>
			<th>AC1</th>
			<th>AC2</th>
			<th>AC3</th>
			<th>Média</th>
			<th>Rec.</th>
			<th>Faltas</th>
			<th>Media 1b</th>
			<th>Media 2b</th>
			<th>Media 3b</th>
			<th>Media 4b</th>
			<th>Total Pontos</th>
			<th>Media Anual</th>
			<th>Prova Final</th>
			<th>Rec. Final</th>
			<th>Media Final</th>
			<th>Situacao</th>
			<th>Editar</th>
		</tr>
		</thead>		
		<?php
		if($_GET['id'] != null){
		 	
			$result = $daoBoletim->listarNotas($_GET['id']);
			while ($linha = mysql_fetch_array($result)) {
				
				echo '<tr>';
				echo '<td>'.utf8_encode($linha['nome']).'</td>';
				echo '<td>'.$linha['ac1'].'</td>';
				echo '<td>'.$linha['ac2'].'</td>';
				echo '<td>'.$linha['ac3'].'</td>';
				echo '<td>'.$linha['media'].'</td>';
				echo '<td>'.$linha['recuperacao'].'</td>';
				echo '<td>'.$linha['faltas'].'</td>';
				echo '<td>'.$linha['media1b'].'</td>';
				echo '<td>'.$linha['media2b'].'</td>';
				echo '<td>'.$linha['media3b'].'</td>';
				echo '<td>'.$linha['media4b'].'</td>';
				echo '<td>'.$linha['totalPontos'].'</td>';
				echo '<td>'.$linha['mediaAnual'].'</td>';
				echo '<td>'.$linha['provaFinal'].'</td>';
				echo '<td>'.$linha['recProvaFinal'].'</td>';
				echo '<td>'.$linha['mediaFinal'].'</td>';
				echo '<td>'.$linha['situacao'].'</td>';
				echo '<td><a href="formBoletim.php?idnt='.$linha['id'].'&id='.$_GET['id'].'&idaln='.$_GET['idaln'].'">Editar</a></td>';
				echo '</tr>';
			}
		}
		?>
		</table>	
		</li>
		
		<li class="notas">
			Media Etapa <br /><input type="text" readonly="readonly" name="mediaEtapa" id="mediaEtapa" value="<?echo $mediaEtapa?>">
		</li>
		<li class="notas">
			Resultado Final <br /><input type="text" name="resultadoFinal" id="resultadoFinal" value="<?echo $resultadoFinal?>">
		</li>
		
	</ul>
</form>
</div>

<? include("footer.php");?>
