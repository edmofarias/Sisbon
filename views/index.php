<?php include 'header.php';?>
<?php 
	require_once '../models/db/BoletimDAO.php';
	$daoBoletim = new BoletimDAO();
?>

<div class="row">
		<div class="six columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Últimas Atualizações</h3>
		</div>
	</div>

<fieldset>
	<center><div class="row tabelas">
		<div class="twelve columns">
			<table>
			<thead>
			<tr>
				<th>Data Atualização</th>
				<th>Atualizado Por</th>
				<th>Boletim</th>
				<th>Aluno</th>
			</tr>
			</thead>
				<?php
				$result = $daoBoletim->listarAtualizacoes();
				
				//while para listar o retorno do banco de dados
					foreach ($result as $linha) {
						
						//formatacao da data de Geracao
						$part = explode(' ', $linha['ultimaAtualizacao']);
						$data = explode('-', $part[0]);
						$dataFormat = $data[2].'/'.$data[1].'/'.$data[0].' '.$part[1];
						
						//lista os dados na tabela
						echo '<tr>';
						echo "<td>".$dataFormat."</td>";
						echo "<td>".utf8_encode(utf8_decode($linha['atualizadoPor']))."</td>";
						echo '<td>'.utf8_encode($linha['nomeSerie']).' '.$linha['nometur'].' - '.$linha['etapa'].' etapa </td>';
						echo "<td>".utf8_encode(utf8_decode($linha['nome']))."</td>";
						echo '</tr>';
					}
				?>
				</table>
			</div>
		</div></center>
	</fieldset>
		
<?php include 'footer.php';?>