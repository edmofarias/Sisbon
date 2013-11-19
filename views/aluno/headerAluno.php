<?php include '../../helper/authAluno.php';?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			
		<title>Sisbon - Área do Aluno</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />	
		<link rel="stylesheet" type="text/css" href="../css/table.css" />	
		<link rel="stylesheet" type="text/css" href="../css/demo_table_jui.css" />
		<link rel="stylesheet" type="text/css" href="../css/dark-theme/jquery-ui-1.8.23.custom.css" />
		
		<!-- APLICACAO FRAMEWORK FOUNDATION ZURB -->
		 <script type="text/javascript" src="../../helper/foundation/javascripts/jquery.js"></script>
		  <script type="text/javascript" src="../../helper/foundation/javascripts/foundation.min.js"></script>
		  <script type="text/javascript" src="../../helper/foundation/javascripts/modernizr.foundation.js"></script>
		  <script type="text/javascript" src="../../helper/foundation/javascripts/jquery.foundation.forms.js">$(document).foundationCustomForms();</script>
		  <link rel="stylesheet" type="text/css" href="../../helper/foundation/stylesheets/foundation.css" />
		<!-- FINAL LINKS FRAMEWORK FOUDATION ZURB -->
		
		<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="../js/javascript.js"></script>
		<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" src="../js/jquery-ui-1.8.19.custom.min.js"></script>
		<script type="text/javascript" language="javascript" src="../js/valida.js"></script>
		<script>
		$(document).ready(function() {
			 $( ".ui-button" ).button({
		          icons: {
		            primary: ""
		          },
		          text: true
		        });
			 });
		</script>
		
		
	</head>


<body>
<div class="row" id="master_header">
		<div class="twelve columns">
			<img style="float: left; padding-left: 40px; padding-top: 2px; max-height: 125px;" src="../imagens/Logo_sisbon.png">
		</div> 
	</div>

	<div class="row"> 
		<div class="twelve columns">
				<ul class="nav-bar">
					<li><a href="index.php">Início</a></li>
				</ul>
				
		</div>
	</div>
	<div id="user" class="row">
		<div class="twelve columns">
		<span style="float: right;">
		<?php $part = explode(' ', $_SESSION['ultimoLogin']);
			  $data = explode('-', $part[0]);
			  $dataFormat = $data[2].'/'.$data[1].'/'.$data[0];?>
		Usuário: <b><?php echo  $_SESSION['login'] ?>  &nbsp;&nbsp;&nbsp;&nbsp;</b> Ultimo Login : <b><?php echo $dataFormat.' '.$part[1];?></b> &nbsp;&nbsp;&nbsp;&nbsp; <b><a href="../../helper/Destroy.php">sair</a></b>
		</span>
</div>
	</div>

<div id="dialog_excluir">
	<span id="dialog_excluir_texto"></span>
</div>

<div class="row" id="avisos">
	<div id="aviso_formulario" class="ui-state-highlight row" style="z-index: 1010; margin:0; padding: 0 .7em;">
		    <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em; margin-top:3px;"></span>
		    <strong>Aviso:</strong>
		    <span class="validateTips"></span>
	</div>
</div>
<script>
	  $('#avisos').hide();
</script>
<div id="page" class="row">
		
		