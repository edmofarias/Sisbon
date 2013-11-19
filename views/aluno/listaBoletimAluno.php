
<?php include 'headerAluno.php';  	?>

	<div class="row">
		<div class="six columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Boletins</h3>
		</div>
	</div>

	<?php
		//lista os dados do aluno
		include_once '../../models/db/AlunoDAO.php';
		require_once '../../models/db/TurmaDAO.php';
		$alunoDAO = new AlunoDAO();
		$daoTurma = new TurmaDAO();
		$qry = $alunoDAO->listarPorID($_SESSION['id']);
		$linha = $qry[0];?>
<fieldset>
<legend>Seus boletins</legend>
	<div class="row">
		<div class="six columns">
			<?php 
				echo '<strong>Aluno :</strong> '.utf8_encode(utf8_decode($linha['nome']));//utf8_encode funcao para codificar as acentuaçoes para utf8
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
				echo '<strong>Matrícula : </strong>'.$linha['matricula'].'';
			?>	
		</div>
	</div>
	<br/>
	<div class="row tabelas">
	<table>
	<thead>
	<tr>
		<th>Boletim</th>
		<th>Etapa</th>
		<th>Data de Cadastro</th>
	</tr>
	</thead>
	<?php
	//inclui o arquivo DAO pra listar os boletins
	include_once '../../models/db/BoletimDAO.php';
	$dao = new BoletimDAO();
	$result = $dao->listarBoletimPorAlunoConfirmado($_SESSION['id']);
	
	if($result){
	//while para listar o retorno do banco de dados
		foreach ($result as $linha) {
			
			$rs = $daoTurma->listarPorID($linha['serie']);
			$serie = $rs[0]['nomeSerie'].' '.$rs[0]['nome'];
			
			//formatacao da data de Geracao
			$part = explode(' ', $linha['dataGeracao']);
			$data = explode('-', $part[0]);
			$dataFormat = $data[2].'/'.$data[1].'/'.$data[0];
			
			//lista os dados na tabela
			echo '<tr>';
			echo "<td><center><a onclick=\"window.location='boletimAluno.php?idBlt=".$linha["id"]."'\" href='#null'>".utf8_encode($serie)."</a></center></td>";
			echo "<td><center><a onclick=\"window.location='boletimAluno.php?idBlt=".$linha["id"]."'\" href='#null'>".$linha['etapa']." Etapa</a></center></td>";
			echo '<td><center>'.$dataFormat.'</center></td>';
			echo '</tr>';
		}
	}else{
	?>
		<tr>
			<td colspan="3">Não existe boletins confirmados</td>
		</tr>
	<?php 
	}
	?>
			</table>
		</div>
	
</fieldset>
	

<? include 'footerAluno.php';  ?>