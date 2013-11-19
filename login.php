<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			
		<title>SisBon</title>
		<link rel="stylesheet" type="text/css" href="views/css/style.css" />	
		<link rel="stylesheet" type="text/css" href="views/css/table.css" />	
		<link rel="stylesheet" type="text/css" href="views/css/demo_table_jui.css" />
		<link rel="stylesheet" type="text/css" href="views/css/dark-theme/jquery-ui-1.8.23.custom.css" />
		
		<!-- APLICACAO FRAMEWORK FOUNDATION ZURB -->
		 <script type="text/javascript" src="helper/foundation/javascripts/jquery.js"></script>
		  <script type="text/javascript" src="helper/foundation/javascripts/foundation.min.js"></script>
		  <script type="text/javascript" src="helper/foundation/javascripts/modernizr.foundation.js"></script>
		  <script type="text/javascript" src="helper/foundation/javascripts/jquery.foundation.forms.js">$(document).foundationCustomForms();</script>
		  <link rel="stylesheet" type="text/css" href="helper/foundation/stylesheets/foundation.css" />
		<!-- FINAL LINKS FRAMEWORK FOUDATION ZURB -->
		
		<script type="text/javascript" language="javascript" src="views/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="views/js/javascript.js"></script>
		<script type="text/javascript" language="javascript" src="views/js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" src="views/js/jquery-ui-1.8.19.custom.min.js"></script>
		<script type="text/javascript" language="javascript" src="views/js/valida.js"></script>
		
	</head>


<body>

<div id="wrapper_login" class="row">

<div class="row">
	<div id="header_login"></div>
</div>
	<div class="row" id="avisos">
		<div id="aviso_formulario" class="ui-state-error row" style="z-index: 1010; margin:0; padding: 0 .7em;">
			    <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em; margin-top:3px;"></span>
			    <strong></strong>
			    <span class="validateTips"></span>
		</div>
	</div>
	<script>
		  $('#avisos').hide();
	</script>
	<br clear="all"/>
	<div class="row">
		<div class="six columns">
			<img style="float: center; padding-left: 74px; padding-top: 5px; max-height: 125px;" src="views/imagens/Logo_sisbon.png">
			<br clear="all" />
			<center>(Sua logomarca aqui)</center>
		</div>
				<div class="two columns" style="color: #777;">
				<br clear="all" />
				Login: admin<br clear="all" />
				Senha: 123
				
				<br clear="all" /><br clear="all" />
				
				Login: professor<br clear="all" />
				Senha: 123
				
				<br clear="all" /><br clear="all" />
				
				Login: aluno<br clear="all" />
				Senha: 123
				
		        </div>
		
		
		<div class="four columns">
			<div class="row">
				<div class="six columns centered">
				<label>Login</label>
					<input type="text" id="login" name="login" maxlength="12" />
				</div>
			</div>
			
			<div class="row">
				<div class="six columns centered">
					<label>Senha</label>
					 <input type="password" id="senha" name="senha" maxlength="8" />
				</div>
			</div>
			<div class="row">
				<div class="two columns centered">
		            <button id="salvar-button" class="button" onclick="logar();">
		              Entrar
		            </button>
		        </div>
			</div>
		</div>
	</div>
	
	<br clear="all"/>
	
</div>

<script>
$('#senha').keyup(function(e) {
    //alert(e.keyCode);
    if(e.keyCode == 13) {
    	logar();
    }
    });
</script>

</body>
</html>