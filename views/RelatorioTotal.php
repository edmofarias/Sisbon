<?php include 'header.php';
	include '../helper/Funcoes.php';
	require_once '../models/db/RelatorioDAO.php';
	require_once '../models/db/TurmaDAO.php';
	$daoR = new RelatorioDAO();
	$daoT = new TurmaDAO();?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.arrayToDataTable([
          ['Task', 'Genero'],
          <?php
          	$var = '';
			$total = 0;
			$rs = $daoR->totalPorGenero();
			foreach ($rs as $linha)
			{
				$genero = $linha['sexo'];
				$qtd = $linha['qtd'];
				$total += $linha['qtd']; 
				$var .= "['$genero',$qtd],";
			}
			$var = substr($var,0,-1);
			echo $var;
          ?>
        ]);
        
        var options = {
          title: 'Gênero [Total de Alunos - <?php echo $total;?>]',
          fontSize: '13',
          chartArea: {top: 30,width:"100%",height:"100%"},
          is3D: true
        };
        
var chart = new google.visualization.PieChart(document.getElementById('genero'));
chart.draw(data, options);
}
</script>
<div id="genero" align="center" style="width: 600px; height: 300px; padding-left: 250px;"></div>
<br/>

<script type="text/javascript">
    
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
	var data = new google.visualization.arrayToDataTable([
	['Task', 'Idade'],
    <?php
    $var = '';
	$total = 0;
	$rs = $daoR->TotalPorIdade();
	foreach ($rs as $linha)
	{
		$idade = Funcao::diffDate($linha['dataNascimento'],date('Y-m-d'),'A');
		$qtd = $linha['qtd'];
		$total += $linha['qtd']; 
		$var .= "['$idade anos',$qtd],";
	}
	$var = substr($var,0,-1);
	echo $var;
    ?>
        ]);
        
        var options = {
          title: 'Idade [Total de Alunos - <?php echo $total;?>]',
          fontSize: '13',
          chartArea: {top: 30,width:"100%",height:"100%"},
          is3D: true
        };
        
var chart = new google.visualization.PieChart(document.getElementById('idade'));
        chart.draw(data, options);
      }
</script>
<div id="idade" align="center" style="width: 600px; height: 300px; padding-left: 250px;"></div>
<br/>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Média'],
          <?php
        		    $var = '';
        			$rs = $daoR->MediaGeral();
        			foreach ($rs as $linha)
        			{
        				$media = $linha['media'];
        				$serie = $linha['serie'];
        				$rsT = $daoT->listarPorID($serie);
        				$result = mysql_fetch_array($rsT);
        				$nomeSerie = $result['nomeSerie'].' '.$result['nome'];
        				$var .= "['$nomeSerie',$media],";
        			}
        			$var = substr($var,0,-1);
        			echo $var;
        		    ?>
        ]);

        var options = {
          title: 'Média das Turmas',
          hAxis: {title: 'Turmas', titleTextStyle: {color: 'black'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('media'));
        chart.draw(data, options);
      }
    </script>
<div id="media" align="center" style="width: 600px; height: 300px; padding-left: 150px;"></div>


<br clear="all"/>
<?include 'footer.php';?>