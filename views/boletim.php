<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />

	<!-- APLICACAO FRAMEWORK FOUNDATION ZURB -->
		 <script type="text/javascript" src="../helper/foundation/javascripts/jquery.js"></script>
		 <script type="text/javascript" src="../helper/foundation/javascripts/foundation.min.js"></script>
		  <script type="text/javascript" src="../helper/foundation/javascripts/modernizr.foundation.js"></script>
		  <script type="text/javascript" src="../helper/foundation/javascripts/jquery.foundation.forms.js">$(document).foundationCustomForms();</script>
		  <link rel="stylesheet" type="text/css" href="../helper/foundation/stylesheets/foundation.css" />
		  <link rel="stylesheet" type="text/css" href="../helper/foundation/stylesheets/app.css" />
		<!-- FINAL LINKS FRAMEWORK FOUDATION ZURB -->
</head>
<body>
<div class="row">
		<div class="six columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Boletim</h3>
		</div>
	</div>
	
	<div class="row">
		<div class="six columns">
			<button class="ui-button-new" onclick="location.href='index.php';" >Boletins</button>
		</div>
	</div>
		
	
	<?php
	//inclui o arquivo DAO pra listar os boletins
	include_once '../../models/db/BoletimDAO.php';
	include_once '../../models/db/TurmaDAO.php';
	include_once '../../models/db/AlunoDAO.php';
	$daoBoletim = new BoletimDAO();
	$daoTurma = new TurmaDAO();
	$daoAluno = new AlunoDAO();
	$result = $daoBoletim->listarBoletimConfirmado($_GET['idBlt']);
	
	//while para listar o retorno do banco de dados
		foreach ($result as $linha) {
			$serie = $linha['serie'];
			$mediaEtapa = $linha['mediaEtapa'];
			$resultadoFinal = $linha['resultadoFinal'];
			$etapa = $linha['etapa'];
			$idAluno = $linha['idAluno'];
			
			//formatacao da data de Geracao
			$part = explode(' ', $linha['dataGeracao']);
			$data = explode('-', $part[0]);
			$dataFormat = $data[2].'/'.$data[1].'/'.$data[0];
			
		}
		
		$rs = $daoTurma->listarPorID($serie);
		$serie = utf8_encode($rs[0]['nomeSerie']).' '.$rs[0]['nome'];
		
		$rs0 = $daoAluno->listarPorID($idAluno);
		$nomeAluno =$rs0[0]['nome'];
		$matricula = $rs0[0]['matricula'];
		$responsavel = $rs0[0]['responsavel'];
	?>
	
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
			padding: 2px 2px 2px 3px;
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
		
		.tabelas thead th {
			background-image: none;
			background-color: #ccc;
			color:#000;
		}
		
		</style>
	
	<div class="row">
		<div class="twelve columns">
		<label><center style="font-size: 18px; font-weight: bold;">BOLETIM DE DESEMPENHO</center></label>
		<br clear="all"/>
		<strong> Aluno(a): </strong> <?= $matricula." &nbsp;&nbsp;&nbsp; ".utf8_encode($nomeAluno) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<strong>Série :</strong> <?php echo $serie?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<strong>Etapa : </strong><?php echo $etapa?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<strong>Data Geração : </strong><?php echo $dataFormat?>
		</div>
	</div>
	<br/>
<div class="tabelas">
<table>
		<thead>
		<tr>
			<th>Mat&eacute;ria</th>
			<th>AC1</th>
			<th>AC2</th>
			<th>AC3</th>
			<th>Med.</th>
			<th>Rec.</th>
			<th>Falt.</th>
			<th>Med.1</th>
			<th>Med.2</th>
			<th>Med.3</th>
			<th>Med.4</th>
			<th>Tot. Pnt</th>
			<th>Med. A.</th>
			<th>Prv. F.</th>
			<th>Rec. F.</th>
			<th>Med. F.</th>
			<th>Sit.</th>
		</tr>
		</thead>		
		<?php //$array = array();
		if($_SESSION['id'] != null){
			$result = $daoBoletim->listarNotas($_GET['idBlt']);
			foreach ($result as $linha) {
				
				/*$array[] = array('nome'=>$linha['nome'],
								'ac1'=>$linha['ac1'],
								'ac2'=>$linha['ac2'],
								'ac3'=>$linha['ac3'],
						'media'=>$linha['media'],
						'recuperacao'=>$linha['recuperacao'],
						'faltas'=>$linha['faltas'],
						'media1b'=>$linha['media1b'],
						'media2b'=>$linha['media2b'],
						'media3b'=>$linha['media3b'],
						'media4b'=>$linha['media4b'],
						'totalaPontos'=>$linha['totalPontos'],
						'mediaAnual'=>$linha['mediaAnual'],
						'provaFinal'=>$linha['provaFinal'],
						'recProvaFinal'=>$linha['recProvaFinal'],
						'mediaFinal'=>$linha['mediaFinal'],
						'situacao'=>$linha['situacao'],
						);*/
				
				echo '<tr>';
				echo '<td>'.utf8_encode(utf8_decode($linha['nome'])).'</td>';
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
				echo '</tr>';
			}
			//$_SESSION['notas'] = $array;
			//$_SESSION['complemento'] = array('serie'=>$serie,'etapa'=>$etapa,'mediaEtapa'=>$mediaEtapa,'resultadoFinal'=>$resultadoFinal,'aluno'=>$nomeAluno,'matricula'=>$matricula);
		}
		?>
		</table>
		</div>	
		
	<div class="row">
		<div class="two columns" style="padding-right: 25px;">
		<label> Média da Etapa </label>
			<input type="text" readonly="readonly" name="mediaEtapa" id="mediaEtapa" value="<?echo $mediaEtapa?>">
		</div>
		
		<div class="two columns" style="padding-right: 25px;">
		<label> Resultado Final </label>
			<input type="text" name="resultadoFinal" id="resultadoFinal" value="<?echo $resultadoFinal?>">
		</div>
		
		<div class="two columns end">
		<!-- <label> Imprimir </label>
			<a href="../../helper/pdf/boletim.php"><img src="../imagens/pdf.png" title="Gerar Boletim em PDF"></a> -->
		</div>
	</div>	
</body>
</html>