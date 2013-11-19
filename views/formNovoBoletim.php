<? if(!$_GET['m']) include("header.php");?>

<?
require_once '../models/db/AlunoDAO.php';
require_once '../models/db/TurmaDAO.php';
$daoAluno = new AlunoDAO();
$daoTurma = new TurmaDAO();

//lista os dados do aluno
if($_GET['idaln'] == null)
{
	header('Location:listaAluno.php');
}
else
{
	$qry2 = $daoAluno->listarPorID($_GET['idaln']);
	$rowAln = $qry2[0];
	//while($rowAln = mysql_fetch_array($qry2))
	//{
		$nomeAluno = $rowAln['nome'];
		$matricula = $rowAln['matricula'];
	//}
}
?>
<script>

$(document).ready(function() {
	 $( ".ui-button-new" ).button({
	        icons: {
	          primary: "ui-icon-arrowthick-1-w"
	        },
	        text: true
	      });
});
</script>
<div class="row">
		<div class="six columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Cadastro de Boletins</h3>
		</div>
</div>

<button class="ui-button-new" onclick="location.href='listaBol.php?idaln=<?php echo $_GET['idaln']?>';" >Boletins do Aluno</button>

	<form action="../controllers/boletim.php?funcao=inserir" method="post" name="formBoletim" id="formBoletim" accept-charset="utf-8">
	<input type="hidden" name="idAluno" value="<?echo $_GET['idaln']?>">
	
	<fieldset>
	<div class="row">
		<div class="twelve columns">
			<strong>Aluno : </strong><?php echo utf8_encode($nomeAluno)?>&nbsp;&nbsp;&nbsp;<strong>Matrícula : </strong><?php echo $matricula?>
		</div>
	</div>
	<br clear="all"/>
	<div class="row">
		<div class="two columns">
		<label>Turma <span> * </span><span id="serie_aviso"></span> </label>
			 <select id="serie" onblur="validarCampo(this,'texto');" obrigatorio="true" onchange="removeAviso(this);" name="serie" >
			 <option value=""></option>
				<?php 
				$result = $daoTurma->listar();
				
				foreach ($result as $linha) {
						echo '<option value="'.utf8_encode($linha['idTurma'].'"> '.$linha['nomeSerie'].' '.$linha['nome']).'</option>';
					}
				?>
			</select>
		</div>
		
		<div class="two columns">
			<label>Etapa <span> * </span><span id="etapa_aviso"></span> </label>
			 <select id="etapa" obrigatorio="true"  onblur="validarCampo(this,'texto');"  onchange="removeAviso(this);" name="etapa">
			 <option value=""></option>
				<option value="1"> 1ᵃ Etapa </option>
				<option value="2"> 2ᵃ Etapa </option>
				<option value="3"> 3ᵃ Etapa </option>
				<option value="4"> 4ᵃ Etapa </option>
			</select>
		</div>
		
		<div class="two columns end">
			<label>Confirmado</label>
				<select id="confirmado" onblur="testaCampo(this, 'texto');" name="confirmado">
					<option value="nao"> Não Confirmado </option>
					<option value="sim"> Confirmado </option>
				</select>
		</div>
		
	</div>
	<br />
	</fieldset>
</form>

<div class="row">
		<div class="one columns end">
            <button id="salvar-button" class="button" 
            	onClick="return verificarCampos('#formBoletim','listaBol.php','enviaFormularioBol');">
              Salvar
            </button>
        </div>
 </div>

<?php include 'footer.php'?>