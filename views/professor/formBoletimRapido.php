<? include("headerProf.php");?>

<script>
	function removeBloqCamposBoletim(idCampo){
	   inputs = $('#tr_'+idCampo+' :input');
	   inputs.each(function() {
		   if($(this).attr('type') != 'checkbox'){
		   		$(this).removeAttr('readonly');
		   }
	   });
	}
	function bloqueiaCamposBoletim(idCampo){
	   inputs = $('#tr_'+idCampo+' :input');
	   inputs.each(function() {
		   if($(this).attr('type') != 'checkbox'){
		   		$(this).attr('readonly','readonly');
		   }
	   });
	}
	
	function marcaMateria(idCampo){
		if($('#'+idCampo).is(":checked")){
			$('#tr_'+idCampo).attr('class','trSelecionado');
			removeBloqCamposBoletim(idCampo);
		}else{	
			$('#tr_'+idCampo).removeAttr('class');
			bloqueiaCamposBoletim(idCampo);
		}	
	}

</script>

<?
require_once '../../models/db/BoletimDAO.php';
require_once '../../models/db/AlunoDAO.php';
require_once '../../models/db/TurmaDAO.php';
require_once '../../models/db/MateriaDAO.php';
$daoAluno = new AlunoDAO();
$daoBoletim = new BoletimDAO();
$daoTurma = new TurmaDAO();
$daoMateria = new MateriaDAO();

$rsTurma = $daoTurma->listarPorID($_GET['t']);
$nomeTurma = $rsTurma[0]['nomeSerie'].' '.$rsTurma[0]['nome'];

$rsMateria = $daoMateria->listarPorID($_GET['m']);
$nomeMateria = utf8_decode(utf8_encode($rsMateria[0]['nome']));

?>

<div class="row">
		<div class="four columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Adicionar notas</h3>
		</div>
</div>
<!-- <div class="row">
	<div class="four columns">
		<button class="button" onclick="location.href='index.php';" >Turmas</button>
	</div>
</div> -->

<form name="formBoletim" id="formBoletim" method="post" action="../../controllers/boletimProfRapido.php" >
	<input type="hidden" name="etapa" id="etapa" value="<?echo $_GET['e']?>" />
	<input type="hidden" name="turma" id="turma" value="<?echo $_GET['t']?>" />
	<input type="hidden" name="materia" id="materia" value="<?echo $_GET['m']?>" />
	
	<fieldset>
		<legend>Dados dos Boletins</legend>
			<div class="row">
				<div class="three columns">
					<label>&nbsp;</label>
					<strong>Materia :</strong> <?php echo $nomeMateria;?>
				</div>

				<div class="two columns">
				<label>&nbsp;</label>
					<strong>S&eacute;rie : </strong><?php echo utf8_encode($nomeTurma);?>
				</div>
				
				<div class="two columns end">
					<label>&nbsp;</label>
					<strong>Etapa : </strong><?php echo $_GET['e']?>
				</div>
			</div>
			
			<div class="row">&nbsp;</div>
			
		</fieldset>
	
	
	<style>
		.tabelas input{
		    border: 0px solid #CCCCCC; 
		    height: 28px; 
		    margin: 2px 0 2px 0;
		    padding: 3px; 
		    font-size: 13px;
		    max-width: 43px;
		    box-shadow: 0 0px 0px rgba(0, 0, 0, 0.1) inset;
		}
		
		.tabelas table{
			max-width: 970px;
			border-collapse:collapse;
		}
		/*.tabelas tbody th, tbody td{
			 background-color: white;
		}*/
		.tabelas td{
			padding: 1px 1px 1px 3px;
			border:1px solid #ccc;
		}
		
		.tabelas thead tr th{
			font-size: 13px;
		    font-weight: bold;
		    padding: 6px;
		    border: 1px solid;
		    text-align: center;
		}
		
		.tabelas tbody tr{
			 background-color: white;
		}
		
		.tabelas tbody tr:hover{
				background-color:#E0EEEE;
		}
		.tabelas tr:hover input{
			background-color:#E0EEEE;
		}
		
		.trSelecionado input, .trSelecionado td{
			background-color: #E0EEEE;
		}
		
		.tabelas thead tr {
			background:url("css/dark-theme/images/ui-bg_gloss-wave_35_333333_500x100.png") repeat-x scroll 50% 50% transparent;
			color:#fff
		}
		
		</style>
	
	
		<div class="tabelas row">
		<table>
		<thead>
		<tr>
			<th>Alunos</th>
			<th></th>
			<th>AC1</th>
			<th>AC2</th>
			<th>AC3</th>
			<th>Média</th>
			<th>Recup.</th>
			<th>Faltas</th>
			<th>Média 1ᵒ B.</th>
			<th>Média 2ᵒ B.</th>
			<th>Média 3ᵒ B.</th>
			<th>Média 4ᵒ B.</th>
			<th>Total Pnts</th>
			<th>Média Anual</th>
			<th>Prova Final</th>
			<th>Recup. Final</th>
			<th>Média Final</th>
			<th>Situação</th>
		</tr>
		</thead>
		<?php 
			  $result1 = $daoTurma->listarAlunos($_GET['t']);
			  foreach($result1 as $linha){
				
			  	$confirm = $daoBoletim->verificaBoletimConfirmado($_GET['m'],$_GET['e'],$_GET['t'],$linha['idAluno']);
			  	if($confirm == 1)
			  		$readOnly = 'readonly="readonly"';
			  	else
			  		$readOnly = '';
			  	
			  	$result = $daoBoletim->listarNotasBoletim($_GET['m'],$_GET['e'],$_GET['t'],$linha['idAluno']);
			  	if($result != 0 && $result != 1){
			  		
			  	foreach ($result as $linhaNotas) {
		?>
		<tr id="tr_<?echo $linha['idAluno']?>" class="trSelecionado">
		<td><?php echo utf8_encode(utf8_decode($linha['nome']));?></td>
		<td><input type="checkbox" name="materias[]" checked="checked" id="<?echo $linha['idAluno']?>" <? echo $readOnly;?> onclick="marcaMateria('<?echo $linha['idAluno']?>')" value="<?echo $linha['idAluno']?>" >
			<input type="hidden" name="idBoletim_<?php echo $linha['idAluno']?>" value="<?echo $linhaNotas['idBoletim']?>" <? echo $readOnly;?> >
			<input type="hidden" name="idBoletins[]" value="<?echo $linhaNotas['idBoletim']?>" <? echo $readOnly;?>/></td>
			<td><input type="text" maxlength="5" name="ac1_<?echo $linha['idAluno']?>" id="ac1_<?echo $linha['idAluno']?>" onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['ac1']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="ac2_<?echo $linha['idAluno']?>" id="ac2_<?echo $linha['idAluno']?>" onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['ac2']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="ac3_<?echo $linha['idAluno']?>" id="ac3_<?echo $linha['idAluno']?>" onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['ac3']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="media_<?echo $linha['idAluno']?>" id="media_<?echo $linha['idAluno']?>" onKeyup="mediaAlunoMedia('<?echo $linha['idAluno']?>');" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['media']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="recuperacao_<?echo $linha['idAluno']?>" id="recuperacao_<?echo $linha['idAluno']?>" onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['recuperacao']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="faltas_<?echo $linha['idAluno']?>" id="faltas_<?echo $linha['idAluno']?>" value="<?echo $linhaNotas['faltas']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="mediaBimestre1_<?echo $linha['idAluno']?>" id="mediaBimestre1_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['media1b']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="mediaBimestre2_<?echo $linha['idAluno']?>" id="mediaBimestre2_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['media2b']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="mediaBimestre3_<?echo $linha['idAluno']?>" id="mediaBimestre3_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['media3b']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="mediaBimestre4_<?echo $linha['idAluno']?>" id="mediaBimestre4_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['media4b']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="totalPontos_<?echo $linha['idAluno']?>" id="totalPontos_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['totalPontos']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="mediaAnual_<?echo $linha['idAluno']?>" id="mediaAnual_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['mediaAnual']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="provaFinal_<?echo $linha['idAluno']?>" id="provaFinal_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" value="<?echo $linhaNotas['provaFinal']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="recProvaFinal_<?echo $linha['idAluno']?>" id="recProvaFinal_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" value="<?echo $linhaNotas['recProvaFinal']?>" <? echo $readOnly;?>></td>
			<td><input type="text" maxlength="5" name="mediaFinal_<?echo $linha['idAluno']?>" id="mediaFinal_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['mediaFinal']?>" <? echo $readOnly;?>></td>
			<td><input type="text" name="situacao_<?echo $linha['idAluno']?>" id="situacao_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['situacao']?>" <? echo $readOnly;?>></td>
		</tr>
		<?php 
				}
			  	}elseif($result == 1){
			  	$idBoletimAluno = $daoBoletim->getBoletimAluno($linha['idAluno'],$_GET['t'],$_GET['e']);
		?>
		<tr id="tr_<?echo $linha['idAluno']?>">
		<td><?php echo utf8_encode(utf8_decode($linha['nome']));?></td>
		<td><input type="checkbox" name="materias[]" id="<?echo $linha['idAluno']?>" onclick="marcaMateria('<?echo $linha['idAluno']?>')" value="<?echo $linha['idAluno']?>" >
		<input type="hidden" name="idBoletim_<?php echo $linha['idAluno'];?>" value="<?echo $idBoletimAluno;?>" ></td>
			<td><input type="text" maxlength="5" name="ac1_<?echo $linha['idAluno']?>" id="ac1_<?echo $linha['idAluno']?>" onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="ac2_<?echo $linha['idAluno']?>" id="ac2_<?echo $linha['idAluno']?>" onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="ac3_<?echo $linha['idAluno']?>" id="ac3_<?echo $linha['idAluno']?>" onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="media_<?echo $linha['idAluno']?>" id="media_<?echo $linha['idAluno']?>" onKeyup="mediaAlunoMedia('<?echo $linha['idAluno']?>');" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="recuperacao_<?echo $linha['idAluno']?>" id="recuperacao_<?echo $linha['idAluno']?>" onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="faltas_<?echo $linha['idAluno']?>" id="faltas_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="mediaBimestre1_<?echo $linha['idAluno']?>" id="mediaBimestre1_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="mediaBimestre2_<?echo $linha['idAluno']?>" id="mediaBimestre2_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="mediaBimestre3_<?echo $linha['idAluno']?>" id="mediaBimestre3_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="mediaBimestre4_<?echo $linha['idAluno']?>" id="mediaBimestre4_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="totalPontos_<?echo $linha['idAluno']?>" id="totalPontos_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="mediaAnual_<?echo $linha['idAluno']?>" id="mediaAnual_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="provaFinal_<?echo $linha['idAluno']?>" id="provaFinal_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);"  onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="recProvaFinal_<?echo $linha['idAluno']?>" id="recProvaFinal_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" onKeyup="mediaAluno('<?echo $linha['idAluno']?>');" value="" readonly="readonly"></td>
			<td><input type="text" maxlength="5" name="mediaFinal_<?echo $linha['idAluno']?>" id="mediaFinal_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
			<td><input type="text" name="situacao_<?echo $linha['idAluno']?>" id="situacao_<?echo $linha['idAluno']?>" onkeypress="Mascara(this, Valor);" value="" readonly="readonly"></td>
		</tr>
		<?php 	  		
			  	}elseif($result == 0){
		?>
		
		<tr id="tr_<?echo $linha['idAluno']?>">
			<td><?php echo utf8_encode(utf8_decode($linha['nome']));?></td>
			<td colspan="17">Este aluno não possui boletim nesta turma, para esta etapa</td>
		</tr>
		
		<?php
			  	}
			}
		?>
		</table>
		</div>
		
			<input type="submit" name="submit" value="Adicionar Notas" class="button"/>
</form>

<? include("footerProf.php");?>