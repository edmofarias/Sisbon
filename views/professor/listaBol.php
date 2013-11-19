<? include 'headerProf.php';  ?>
		
LISTA DE BOLETINS POR ALUNO<br />
<button class="ui-button" onclick="location.href='index.php';" >Turmas</button>
<button class="ui-button" onclick="location.href='listaAlunoProf.php?turma=<?php echo $_GET['tur'] ?>';" >Alunos</button>
<br />
	<?php
		//lista os dados do aluno
		include_once '../../models/db/AlunoDAO.php';
		$alunoDAO = new AlunoDAO();
		$qry = $alunoDAO->listarPorID($_GET['idaln']);

		while ($linha = mysql_fetch_array($qry)) {
			echo 'Aluno : '.utf8_encode($linha['nome']);//utf8_encode funcao para codificar as acentuaçoes para utf8
			echo '&nbsp;&nbsp;&nbsp';
			echo 'Matrícula : '.$linha['matricula'];
		}
	?>

		<div class="box">
		
		<div class="content3">
<div class="tabelas">
	<table border="1px" >
	<thead>
	<tr>
		<th>Boletim</th>
		<th>Etapa</th>
		<th>Data de Cadastro</th>
		<th>Confirmado</th>
	</tr>
	</thead>
	<?php
	//inclui o arquivo DAO pra listar os boletins
	include_once '../../models/db/BoletimDAO.php';
	$dao = new BoletimDAO();
	$result = $dao->listarBoletimPorAlunoTurma($_GET['idaln'],$_GET['tur']);
	
	//while para listar o retorno do banco de dados
		while ($linha = mysql_fetch_array($result)) {
			$serie = $linha['serie'].' ano';
			
			//formatacao do ano e serie, se for maior que 10 será SERIE em vez de ANO
			if($linha['serie'] == 10){
				$serie = '1ᵃ serie';
			}elseif($linha['serie'] == 11){
				$serie = '2ᵃ serie';
			}elseif($linha['serie'] == 12){
				$serie = '3ᵃ serie';
			}
			
			if($linha['confirmado'] == 1){
				$confirmado = "<td style='color: green;'>Sim</td>";
			}elseif ($linha['confirmado'] == 0){
				$confirmado = "<td style='color: red;'>Nao</td>";
			}
			
			//formatacao da data de Geracao
			$part = explode(' ', $linha['dataGeracao']);
			$data = explode('-', $part[0]);
			$dataFormat = $data[2].'/'.$data[1].'/'.$data[0].' '.$part[1];
			
			//lista os dados na tabela
			echo '<tr>';
			echo "<td><a href='formBoletim.php?id=".$linha["id"]."&idaln=".$linha["idaln"]."'>".$serie."</a></td>";
			echo "<td><a href='formBoletim.php?id=".$linha["id"]."&idaln=".$linha["idaln"]."'>".$linha['etapa']." Etapa</a></td>";
			echo '<td>'.$dataFormat.'</td>';
			echo utf8_encode($confirmado);
			echo '</tr>';
		}
	?>
			</table>
	</div>
</div><!-- content2 -->
			
</div><!-- box -->

<br class="clearfix" />

<? include 'footerProf.php';  ?>