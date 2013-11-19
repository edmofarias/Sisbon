<? if(!$_GET['m']) include 'header.php';  ?>

<div class="row">
		<div class="six columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Boletins do Aluno</h3>
		</div>
	</div>
	<?php
		//lista os dados do aluno
		include_once '../models/db/AlunoDAO.php';
		require_once '../models/db/TurmaDAO.php';
		$alunoDAO = new AlunoDAO();
		$daoTurma = new TurmaDAO();
		$qry = $alunoDAO->listarPorID($_GET['idaln']);
		$linha = $qry[0];?>
<fieldset>
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
	<div class="row">
		<div class="twelve columns">
			<button class="ui-button-new" onclick="window.location='formNovoBoletim.php?idaln=<?echo $_GET['idaln'];?>'"> Novo Boletim</button>
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
		<th>Confirmado</th>
		<th>Excluir</th>
	</tr>
	</thead>
	<?php
	//inclui o arquivo DAO pra listar os boletins
	include_once '../models/db/BoletimDAO.php';
	$dao = new BoletimDAO();
	$result = $dao->listarBoletimPorAluno($_GET['idaln']);
	
	//while para listar o retorno do banco de dados
		foreach ($result as $linha) {
			
			if($linha['confirmado'] == 1){
				$confirmado = "<td style='color: green;'><center>Sim</center></td>";
			}elseif ($linha['confirmado'] == 0){
				$confirmado = "<td style='color: red;'><center>Nao</center></td>";
			}
			
			$rs = $daoTurma->listarPorID($linha['serie']);
			//while($rowTurma = mysql_fetch_array($rs)){
				$serie = utf8_encode($rs[0]['nomeSerie']).' '.$rs[0]['nome'];
			//}
			
			//formatacao da data de Geracao
			$part = explode(' ', $linha['dataGeracao']);
			$data = explode('-', $part[0]);
			$dataFormat = $data[2].'/'.$data[1].'/'.$data[0].' '.$part[1];
			
			//lista os dados na tabela
			echo '<tr>';
			echo "<td><center><a href='formBoletim.php?id=".$linha["id"]."&idaln=".$linha["idaln"]."'>".$serie."</a></center></td>";
			echo "<td><center><a href='formBoletim.php?id=".$linha["id"]."&idaln=".$linha["idaln"]."'>".$linha['etapa']." Etapa</a></center></td>";
			echo '<td><center>'.$dataFormat.'</center></td>';
			echo utf8_encode($confirmado);
			echo "<td><center><a href='#null'
					title='Excluir'
					id='excluir_".$linha['id']."' 
					caixa='dialog_excluir' 
					action='../controllers/boletim.php?idBol=".$linha['id']."&funcao=excluir&idaln=".$_GET['idaln']."' 
					resposta='listaBol.php'
					titulo='Excluir Registro' 
					idaluno='".$_GET['idaln']."'
					onClick='excluirCadastro(\"excluir_".$linha['id']."\",\"".$linha['id']."\")'><img src='imagens/delete_1.png' /></a></center></td>";
			echo '</tr>';
		}
	?>
			</table>
		</div>
	
</fieldset>
		
<script type="text/javascript">
	$( ".ui-button-new" ).button({
        icons: {
          primary: "ui-icon-plusthick"
        },
        text: true
      });

</script>
<? include 'footer.php';  ?>