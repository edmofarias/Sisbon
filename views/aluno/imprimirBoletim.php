<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />

	<!-- APLICACAO FRAMEWORK FOUNDATION ZURB -->
		 <script type="text/javascript" src="../../helper/foundation/javascripts/jquery.js"></script>
		 <script type="text/javascript" src="../../helper/foundation/javascripts/foundation.min.js"></script>
		  <script type="text/javascript" src="../../helper/foundation/javascripts/modernizr.foundation.js"></script>
		  <script type="text/javascript" src="../../helper/foundation/javascripts/jquery.foundation.forms.js">$(document).foundationCustomForms();</script>
		  <link rel="stylesheet" type="text/css" href="../../helper/foundation/stylesheets/foundation.css" />
		  <link rel="stylesheet" type="text/css" href="../../helper/foundation/stylesheets/app.css" />
		<!-- FINAL LINKS FRAMEWORK FOUDATION ZURB -->
</head>
<body>

	<style>
	body{
		font-family: "Arial", Helvetica, sans-serif; font-size: 12px;
		padding: 10px; 
	}
		.tabelas input{
		    border: 0px solid #CCCCCC; 
		    height: 28px; 
		    margin: 2px 0 2px 0;
		    padding: 3px; 
		    font-size: 13px;
		    max-width: 43px;
		    box-shadow: 0 0px 0px rgba(0, 0, 0, 0.1) inset;
		}
		
		.tabela table{
			max-width: 970px;
			border-collapse:collapse;
		}
		/*.tabelas tbody th, tbody td{
			 background-color: white;
		}*/
		.tabela td{
			padding: 2px 2px 2px 3px;
			border:1px solid #777;
		}
		
		.tabela thead tr th{
			font-size: 13px;
		    font-weight: bold;
		    /*padding: 6px;*/
		    border: 1px solid #777;
		    text-align: center;
		    padding: 4px 8px 5px;
		}
		
		.tabelas tbody tr{
			 background-color: white;
		}
				
		.tabela thead th {
			background-image: none;
			background-color: #ccc;
			color:#000;
		}
		
		.tudo{
			width: 800px;
		}
		</style>

<div class="tudo">
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
		$turma = $rs[0]['idTurma'];
		
		$rs0 = $daoAluno->listarPorID($idAluno);
		$nomeAluno =$rs0[0]['nome'];
		$matricula = $rs0[0]['matricula'];
		$responsavel = $rs0[0]['responsavel'];
		$telefoneResp = $rs0[0]['telefoneResp'];
		$foto = $rs0[0]['foto'];
	?>
	
	<div class="row">
		<div class="three columns">
			<img style="padding-left: 30px;" src="../imagens/logo_sisbon_small.png" />
		</div>
		
		<div class="eigth columns">
			<div style="font-size: 20px; font-weight: bold; padding-top: 30px;padding-left: 100px;">BOLETIM DE DESEMPENHO</div>
		</div>
		
		<div class="one columns">
			<img alt="foto" src="../../helper/fotos/<?= $foto ?>">
		</div>
	</div>
	<div class="row" style="font-size: 15px;">
		<div class="five columns" >
			<br clear="all"/>
				<strong> Aluno(a): </strong> <?= $matricula." &nbsp;&nbsp; ".utf8_encode($nomeAluno) ?>
			<br clear="all"/><br clear="all"/>
				<strong> Responsável: </strong> <?= utf8_encode($responsavel) ?>
		</div>
		<div class="two columns" >
		<br clear="all"/>
			<strong>Série:</strong> <?php echo $serie?>
		</div>
		<div class="one columns" >
		<br clear="all"/>
			<strong>Etapa: </strong><?php echo $etapa?>
		</div>
		<div class="three columns" >
		<br clear="all"/>
			<strong>&nbsp;&nbsp;Data: </strong><?php echo $dataFormat?>
		<br clear="all"/><br clear="all"/>
			<strong> Fone: </strong> <?= utf8_encode($telefoneResp) ?>
		</div>
		
		
	</div>
	<br/>
<div class="tabela">
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
		</div>
		
		<!-- <div class="two columns" style="padding-right: 25px;">
		<label> Resultado Final </label>
			<input type="text" name="resultadoFinal" id="resultadoFinal" value="<?//echo $resultadoFinal?>">
		</div> -->
		
		<div class="three columns" style="font-size: 17px;">
		<strong> Média da Etapa: </strong> <?= $mediaEtapa?>
		<!-- <label> Imprimir </label>
			<a href="../../helper/pdf/boletim.php"><img src="../imagens/pdf.png" title="Gerar Boletim em PDF"></a> -->
		</div>
	</div>
	
	<?php 
	
	//array associando Materia a nota array('nome da Materia','Media da turma');
	$dados = array();
	
	$rsTurma = $daoTurma->listarMaterias($turma); // listo todas as materias dessa turma
	foreach($rsTurma as $materia){
		$i = 0;
		$soma = 0;
		//listo todos os alunos dessa turma
		$rsAlunos = $daoTurma->listarAlunos($turma);
		foreach($rsAlunos as $aluno){
			$notas = $daoBoletim->listarNotasBoletim($materia['id'],$etapa,$turma,$aluno['idAluno']);
			if($notas != 0 && $notas != 1){
				$nota = $notas[0]['media'.$etapa.'b'];
				if($nota != '' && $nota != null){
					
					if($aluno['idAluno'] == $idAluno){
						$mediaAluno = $nota;
					}
					
					   $soma += $nota;
					   $i++;
				}
			}
		}
		//depois de pegar todas as notas de todos os alunos, faço o calculo para saber a media dessa materia
		$media = $soma / $i;
		
		//guardo a media num array
		$dados[] = array('materia'=>$materia['nome'],'media'=>number_format($media,2,".","."),'mediaAluno'=>$mediaAluno);
	}
	
	if(count($dados)){
	?>
	
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          <?php
          $var = "['Matéria', 'Média da Turma', 'Média do Aluno'],";
			foreach ($dados as $linha){
				$var .= "['".($linha['materia'])."',  ".$linha['media'].", ".$linha['mediaAluno']."],";
			}
			$var0 = substr($var,0,-1);//removo a ultima virgula para nao dar erro
			echo $var0;
          ?>
        ]);

        var options = {
          title: 'Média em relação a turma',
          hAxis: {title: 'Matéria', titleTextStyle: {color: 'black'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <div id="chart_div" style="width: 830px; height: 440px;"></div>
	<?php }else{ ?>
		<div class="row">
		<div class="five columns">
			Gráfico não disponível
		</div>
		</div>
	<?php 
	}?>
	----------------------------------------------------------------------------------------------------------------------------------------------------------------
	<br clear="all"/>
	<br clear="all"/>
	
	<div class="row">
		<div class="nine columns">
			Declaro que Recebi o Boletim do Aluno: <?= $matricula." &nbsp;&nbsp; ".utf8_encode($nomeAluno) ?>
			
		</div>
		<div class="three columns">
			<strong>Série:</strong> <?php echo $serie?>
		</div>
	</div>
	
	<br clear="all"/>
	<br clear="all"/>
	
	<div class="row">
		<div class="seven columns">
			No dia: _______/________/_________ Referente a <?php echo $etapa?> Etapa
		</div>
		<div class="five columns">
			__________________________________________<br clear="all"/><br clear="all"/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Assinatura do responsável
		</div>
	</div>

</div>
<br clear="all"/>
	<br clear="all"/><br clear="all"/>
	<br clear="all"/>
<script type="text/javascript">
$(window.ready(window.print()));
</script>
	</body>
	</html>