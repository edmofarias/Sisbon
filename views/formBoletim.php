<? if(!$_GET['m'])include("header.php");?>

<script>
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

	$(document).ready(function() {
		 $( ".ui-button-new" ).button({
		        icons: {
		          primary: "ui-icon-arrowthick-1-w"
		        },
		        text: true
		      });
	});
	
</script>

<?
require_once '../models/db/BoletimDAO.php';
require_once '../models/db/AlunoDAO.php';
$daoAluno = new AlunoDAO();
$daoBoletim = new BoletimDAO();

//se o idNota nao estiver nulo lista as notas para editar
if($_GET['idnt'] != null){
	
	$qry = $daoBoletim->listarNota($_GET['idnt']);
	$row = $qry[0];
	//while($row = mysql_fetch_array($qry)){
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
	//}
}

//lista os dados do aluno
if($_GET['idaln'] == null){
	header('Location:listaAluno.php');
}else{
	$qry2 = $daoAluno->listarPorID($_GET['idaln']);
	$rowAln = $qry2[0];
	//while($rowAln = mysql_fetch_array($qry2)){
		$nomeAluno = $rowAln['nome'];
		$matricula = $rowAln['matricula'];
	//}
}

if($_GET['id'] != null){
	$qry3 = $daoBoletim->listarBoletim($_GET['id']);
	$rowBol = $qry3[0];
	//while($rowBol = mysql_fetch_array($qry3)){
		$serie = $rowBol['serie'];
		$etapa = $rowBol['etapa'];
		$mediaEtapa = $rowBol['mediaEtapa'];
		$resultadoFinal = $rowBol['resultadoFinal'];
		$obs = $rowBol['obs'];
		$confirmado = $rowBol['confirmado'];
		$readonly = 'readonly="readonly"';
		
		$dtGeracao = explode(' ', $rowBol['dataGeracao']);
		$geracao = explode('-', $dtGeracao[0]);
		$dataGeracao = $geracao[2].'/'.$geracao[1].'/'.$geracao[0].' '.$dtGeracao[1];
		
		$dataConfiracao = $rowBol['dataConfirmacao'];
	//}
}else{
	header('Location:listaAluno.php');
}
?>

<div class="row">
		<div class="four columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Editar Boletim</h3>
		</div>
	</div>

<div class="row">
		<div class="six columns">
			<button class="ui-button-new" onclick="location.href='listaBol.php?idaln=<?= $_GET['idaln']?>';" >Voltar para os boletins</button>
		</div>
	</div>
<form name="formBoletim" id="formBoletim" method="post" action="../controllers/boletim.php?funcao=nota" >
		<input type="hidden" id="etapa" name="etapa" value="<?php echo $etapa;?>">
		<input type="hidden" id="serie" name="serie" value="<?php echo $serie;?>">
		<input type="hidden" name="idNota" value="<?echo $_GET['idnt']?>">
		<input type="hidden" name="idBoletim" value="<?echo $_GET['id']?>">
		<input type="hidden" name="idAluno" value="<?echo $_GET['idaln']?>">
		
		<fieldset>
		<legend>Dados do Boletim <img src="imagens/ajuda.png" data-tooltip class="has-tip tip-top" title="Quando um boletim está em estado Confirmado, o aluno poderá acessar o boletim, e o professor NÃO poderá modificar as notas" /></legend>
			<div class="row">
				<div class="twelve columns">
					<label>&nbsp;</label>
					<strong>Aluno :</strong> <?php echo utf8_encode(utf8_decode($nomeAluno))?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Matrícula : </strong><?php echo $matricula?>
				</div>
			</div>
			
			<div class="row">
				<div class="two columns">
				<label>&nbsp;</label>
					<?php 
						require_once '../models/db/TurmaDAO.php';
						$daoTurma = new TurmaDAO();
						$rs = $daoTurma->listarPorID($serie);
						foreach($rs as $rowTurma){
							echo '<strong>S&eacute;rie : </strong>'.utf8_encode($rowTurma['nomeSerie']).' '.$rowTurma['nome'];				
						}
					?>
				</div>
				
				<div class="two columns">
					<label>&nbsp;</label>
					<strong>Etapa : </strong><?php echo $etapa;?>
				</div>
			
				<div class="two columns">
				<label>&nbsp;</label>
					<?php 
						if($confirmado == 1){
							echo 'Confirmado <input type="checkbox" name="confirmado" id="confirmado" value="sim" checked="checked" onclick="confirmaBoletim('.$_GET['id'].',0);"/>';
						}else{
							echo 'Confirmado <input type="checkbox" name="confirmado" id="confirmado" value="sim" onclick="confirmaBoletim('.$_GET['id'].',1);"/>';
						}
					?>
				</div>
				
				<div class="five columns end">
					<label>&nbsp;</label>
					<strong>Data de Criação : </strong> <?php echo $dataGeracao?> 
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
		<br />
		<div class="tabelas row">
		<table>
		<thead>
		<tr>
			<th>Discip.</th>
			<th></th>
			<th>AC1&nbsp;&nbsp;&nbsp;</th>
			<th>AC2&nbsp;&nbsp;&nbsp;</th>
			<th>AC3&nbsp;&nbsp;&nbsp;</th>
			<th>Média</th>
			<th>Recup.</th>
			<th>Faltas</th>
			<th>1ᵒ Bim.&nbsp;&nbsp;</th>
			<th>2ᵒ Bim.&nbsp;&nbsp;</th>
			<th>3ᵒ Bim.&nbsp;&nbsp;</th>
			<th>4ᵒ Bim.&nbsp;&nbsp;</th>
			<th>Total Pontos</th>
			<th>Média Anual</th>
			<th>Prova Final</th>
			<th>Recup. Final</th>
			<th>Média Final</th>
			<th>Situação</th>
		</tr>
		</thead>
		<?php require_once '../models/db/MateriaDAO.php';
			  $materiaDAO = new MateriaDAO();
			  //$result1 = $materiaDAO->listar();
			  $result1 = $daoTurma->listarMaterias($serie);
			  
			  if(count($result1) > 0){
			  
			  foreach($result1 as $linha){
			  
			  	if($_GET['id'] != null){
			  	$mostrou = false;
			  	$result = $daoBoletim->listarNotas($_GET['id']);
			  	foreach ($result as $linhaNotas) {
			  		if($linha['id'] == $linhaNotas['idMat']){
		?>
		<tr id="tr_<?echo $linha['id']?>" class="trSelecionado">
		<td><?php echo utf8_encode(utf8_decode($linha['nome']));?></td>
		<td><input type="checkbox" name="materias[]" checked="checked" id="<?echo $linha['id']?>" onclick="marcaMateria('<?echo $linha['id']?>')" onkeypress="Mascara(this, Valor);" value="<?echo $linha['id']?>" ></td>
			<td><input type="text" maxlength="5" name="ac1_<?echo $linha['id']?>" id="ac1_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);"  value="<?echo $linhaNotas['ac1']?>"></td>
			<td><input type="text" maxlength="5" name="ac2_<?echo $linha['id']?>" id="ac2_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['ac2']?>"></td>
			<td><input type="text" maxlength="5" name="ac3_<?echo $linha['id']?>" id="ac3_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['ac3']?>"></td>
			<td><input type="text" maxlength="5" name="media_<?echo $linha['id']?>" id="media_<?echo $linha['id']?>" onKeyup="mediaAlunoMedia('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['media']?>"></td>
			<td><input type="text" maxlength="5" name="recuperacao_<?echo $linha['id']?>" id="recuperacao_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['recuperacao']?>"></td>
			<td><input type="text" maxlength="5" name="faltas_<?echo $linha['id']?>" id="faltas_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['faltas']?>"></td>
			<td><input type="text" maxlength="5" name="mediaBimestre1_<?echo $linha['id']?>" id="mediaBimestre1_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['media1b']?>"></td>
			<td><input type="text" maxlength="5" name="mediaBimestre2_<?echo $linha['id']?>" id="mediaBimestre2_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['media2b']?>"></td>
			<td><input type="text" maxlength="5" name="mediaBimestre3_<?echo $linha['id']?>" id="mediaBimestre3_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['media3b']?>"></td>
			<td><input type="text" maxlength="5" name="mediaBimestre4_<?echo $linha['id']?>" id="mediaBimestre4_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['media4b']?>"></td>
			<td><input type="text" maxlength="5" name="totalPontos_<?echo $linha['id']?>" id="totalPontos_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['totalPontos']?>"></td>
			<td><input type="text" maxlength="5" name="mediaAnual_<?echo $linha['id']?>" id="mediaAnual_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['mediaAnual']?>"></td>
			<td><input type="text" maxlength="5" name="provaFinal_<?echo $linha['id']?>" id="provaFinal_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);"  onKeyup="mediaAluno('<?echo $linha['id']?>');" value="<?echo $linhaNotas['provaFinal']?>"></td>
			<td><input type="text" maxlength="5" name="recProvaFinal_<?echo $linha['id']?>" id="recProvaFinal_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" onKeyup="mediaAluno('<?echo $linha['id']?>');" value="<?echo $linhaNotas['recProvaFinal']?>"></td>
			<td><input type="text" maxlength="5" name="mediaFinal_<?echo $linha['id']?>" id="mediaFinal_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['mediaFinal']?>"></td>
			<td><input type="text" name="situacao_<?echo $linha['id']?>" id="situacao_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" value="<?echo $linhaNotas['situacao']?>"></td>
		</tr>
		<?php 
				$mostrou = true;
				}
			}
			if($mostrou == false){ ?>
				
		<tr id="tr_<?echo $linha['id']?>" >
		<td><?php echo utf8_encode(utf8_decode($linha['nome']));?></td>
		<td><input type="checkbox" name="materias[]" id="<?echo $linha['id']?>" onclick="marcaMateria('<?echo $linha['id']?>')" value="<?echo $linha['id']?>" ></td>
			<td><input type="text" maxlength="5" name="ac1_<?echo $linha['id']?>" id="ac1_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="ac2_<?echo $linha['id']?>" id="ac2_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="ac3_<?echo $linha['id']?>" id="ac3_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="media_<?echo $linha['id']?>" id="media_<?echo $linha['id']?>" onKeyup="mediaAlunoMedia('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="recuperacao_<?echo $linha['id']?>" id="recuperacao_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="faltas_<?echo $linha['id']?>" id="faltas_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="mediaBimestre1_<?echo $linha['id']?>" id="mediaBimestre1_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="mediaBimestre2_<?echo $linha['id']?>" id="mediaBimestre2_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="mediaBimestre3_<?echo $linha['id']?>" id="mediaBimestre3_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="mediaBimestre4_<?echo $linha['id']?>" id="mediaBimestre4_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="totalPontos_<?echo $linha['id']?>" id="totalPontos_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="mediaAnual_<?echo $linha['id']?>" id="mediaAnual_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="provaFinal_<?echo $linha['id']?>" id="provaFinal_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="5" name="recProvaFinal_<?echo $linha['id']?>" id="recProvaFinal_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="5" name="mediaFinal_<?echo $linha['id']?>" id="mediaFinal_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" name="situacao_<?echo $linha['id']?>" id="situacao_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
		</tr>
				
			<?php }
		}else{?>
			
			
			<tr id="tr_<?echo $linha['id']?>" >
		<td><?php echo utf8_encode(utf8_decode($linha['nome']));?></td>
		<td><input type="checkbox" name="materias[]" id="<?echo $linha['id']?>" onclick="marcaMateria('<?echo $linha['id']?>')" value="<?echo $linha['id']?>" ></td>
			<td><input type="text" maxlength="5" name="ac1_<?echo $linha['id']?>" id="ac1_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="ac2_<?echo $linha['id']?>" id="ac2_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="ac3_<?echo $linha['id']?>" id="ac3_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="media_<?echo $linha['id']?>" id="media_<?echo $linha['id']?>" onKeyup="mediaAlunoMedia('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="recuperacao_<?echo $linha['id']?>" id="recuperacao_<?echo $linha['id']?>" onKeyup="mediaAluno('<?echo $linha['id']?>');" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="faltas_<?echo $linha['id']?>" id="faltas_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="mediaBimestre1_<?echo $linha['id']?>" id="mediaBimestre1_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="mediaBimestre2_<?echo $linha['id']?>" id="mediaBimestre2_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="mediaBimestre3_<?echo $linha['id']?>" id="mediaBimestre3_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="mediaBimestre4_<?echo $linha['id']?>" id="mediaBimestre4_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="totalPontos_<?echo $linha['id']?>" id="totalPontos_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="mediaAnual_<?echo $linha['id']?>" id="mediaAnual_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" maxlength="5" name="provaFinal_<?echo $linha['id']?>" id="provaFinal_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="5" name="recProvaFinal_<?echo $linha['id']?>" id="recProvaFinal_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> onKeyup="mediaAluno('<?echo $linha['id']?>');" value=""></td>
			<td><input type="text" maxlength="5" name="mediaFinal_<?echo $linha['id']?>" id="mediaFinal_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
			<td><input type="text" name="situacao_<?echo $linha['id']?>" id="situacao_<?echo $linha['id']?>" onkeypress="Mascara(this, Valor);" <?php echo $readonly;?> value=""></td>
		</tr>
			
			
		<?php }
	}// fim do foreach de materias da turma
	
	} else {?>
		<tr>
			<td colspan="18"><center>Não existe disciplinas relacionadas com esta turma.</center></td>
		</tr>		
	<?
	$disabled = "disabled";
	}
	?>
		</table>
		</div>
		
	<div class="row">
		<div class="twelve columns">
		<label>Obeservações</label>
			<textarea rows="3" cols="150" name="obs" id="obs"><?php echo $obs?></textarea>
		</div>
	</div>
    
    <div class="row">
		<div class="two columns">
		<label> Média da Etapa </label>
			<input type="text" readonly="readonly" name="mediaEtapa" id="mediaEtapa" value="<?echo $mediaEtapa?>">
		</div>
		
		<div class="two columns end">
		<label> Resultado Final </label>
			<input type="text" name="resultadoFinal" id="resultadoFinal" value="<?echo $resultadoFinal?>">
		</div>
	</div>   
	
	<div class="row">
		<div class="two columns end">
            <button id="salvar-button" class="button" <?= $disabled?>>
              Salvar Notas
            </button>
        </div>
 	</div>

</form>

<? include("footer.php");?>
