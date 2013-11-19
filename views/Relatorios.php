<?php include 'header.php';
require_once '../models/db/TurmaDAO.php';
$daoTurma = new TurmaDAO();?>
<div class="row">
		<div class="four columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Relatórios</h3>
		</div>
	</div>
<form action="" method="post" name="formRelatorio" id="formRelatorio" accept-charset="utf-8">
<fieldset>
	<legend>Relatórios</legend>
	<div class="row">
		<div class="two columns">
		<label>Turma</label>
		<select class="form-dropdown" style="width:100px" id="serie" onblur="testaCampo(this, 'texto');" name="serie">
			<option value="todas">Todas</option>
			<?php 
			$result = $daoTurma->listar();
			
			foreach ($result as $linha) {
				echo '<option value="'.utf8_encode($linha['idTurma'].'"> '.$linha['nomeSerie'].' '.$linha['nome']).'</option>';
			}
			?>
			</select>
		</div>
		
		<div class="two columns end">
		<label>Ano</label>
			<select class="form-dropdown" style="width:100px" id="serie" onblur="testaCampo(this, 'texto');" name="serie">
			<?php 
			$ano = date('Y');		
			while ($ano >= 1990) {
					echo '<option value="'.$ano.'"> '.$ano.'</option>';
					$ano--;
			}
			?>
			</select>
		</div>
	</div>
	<div class="row">&nbsp;</div>
</fieldset>
</form>
<br clear="all"/>

<div class="row">
		<div class="two columns end">
            <button id="salvar-button" class="button">
              Gerar Relatório
            </button>
        </div>
 </div>

<?php include 'footer.php';?>