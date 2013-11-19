<?php include '../../helper/authProf.php';?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html class="no-js" lang="pt_br">
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
		<meta name="viewport" content="width=device-width" />
		
		<title>Sisbon - Professores</title>
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
		  <link rel="stylesheet" type="text/css" href="../../helper/foundation/stylesheets/app.css" />
		<!-- FINAL LINKS FRAMEWORK FOUDATION ZURB 
		
		<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>-->
		<script type="text/javascript" language="javascript" src="../js/javascript.js"></script>
		<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" language="javascript" src="../js/valida.js"></script>
		
	<script type="text/javascript" charset="utf-8">

		$(document).ready(function() {
			 $( ".ui-button" ).button({
		          icons: {
		            primary: ""
		          },
		          text: true
		        });
			 $( ".ui-button-menu" ).button({
			        icons: {
			          //primary: "ui-icon-plusthick" 
			        },
			        text: true
			      });
			 });
		
		function mediaAluno(idCampo){

			
        var ac1 = 0;
        var ac2 = 0;
        var ac3 = 0;

         ac1 = $('#ac1_'+idCampo).val();
         ac2 = $('#ac2_'+idCampo).val();
         ac3 = $('#ac3_'+idCampo).val();

         if((ac1 != '' || ac2 != '') || ac3 != ''){
         
         if($('#etapa').val() == "1")
         {
                  var x = 0;
                if(ac1 == ''){
                        ac1 = 0;
                }else{
                        x = x + 1;
                }

                if(ac2 == ''){
                        ac2 = 0;
                }else{
                        x = x + 1;
                }

                if(ac3 == ''){
                        ac3 = 0;
                }else{
                        x = x + 1;
                }
                var soma = parseFloat(ac1) + parseFloat(ac2) + parseFloat(ac3);
                var media = soma / x;
               
                if(x == 0 && soma == 0){
                    media = 0;
                }
                $('#media_'+idCampo).val(media.toFixed(2));
                        if(parseFloat($('#recuperacao_'+idCampo).val()) > parseFloat($('#media_'+idCampo).val()))
                        {
                        $('#mediaBimestre1_'+idCampo).val($('#recuperacao_'+idCampo).val());
                        }else{
                            $('#mediaBimestre1_'+idCampo).val($('#media_'+idCampo).val());
                            }
                  //    alert(x+'-'+ac1+'-'+ac2+'-'+ac3+'-'+);
         }

         if($('#etapa').val() == "2")
         {
                  var x = 0;
                if(ac1 == ''){
                        ac1 = 0;
                }else{
                        x = x + 1;
                }

                if(ac2 == ''){
                        ac2 = 0;
                }else{
                        x = x + 1;
                }

                if(ac3 == ''){
                        ac3 = 0;
                }else{
                        x = x + 1;
                }
                var soma = parseFloat(ac1) + parseFloat(ac2) + parseFloat(ac3);
                var media = soma / x;
                
                if(x == 0 && soma == 0){
                    media = 0;
                }
                
                $('#media_'+idCampo).val(media.toFixed(2));
                        if(parseFloat($('#recuperacao_'+idCampo).val()) > parseFloat($('#media_'+idCampo).val()))
                        {
                        $('#mediaBimestre2_'+idCampo).val($('#recuperacao_'+idCampo).val());
                        }else{
                            $('#mediaBimestre2_'+idCampo).val($('#media_'+idCampo).val());
                            }
                  //    alert(x+'-'+ac1+'-'+ac2+'-'+ac3+'-'+);
         }

         if($('#etapa').val() == "3")
         {
                  var x = 0;
                if(ac1 == ''){
                        ac1 = 0;
                }else{
                        x = x + 1;
                }

                if(ac2 == ''){
                        ac2 = 0;
                }else{
                        x = x + 1;
                }

                if(ac3 == ''){
                        ac3 = 0;
                }else{
                        x = x + 1;
                }
                var soma = parseFloat(ac1) + parseFloat(ac2) + parseFloat(ac3);
                var media = soma / x;

                if(x == 0 && soma == 0){
                    media = 0;
                }
                
                $('#media_'+idCampo).val(media.toFixed(2));
                        if(parseFloat($('#recuperacao_'+idCampo).val()) > parseFloat($('#media_'+idCampo).val()))
                        {
                        $('#mediaBimestre3_'+idCampo).val($('#recuperacao_'+idCampo).val());
                        }else{
                            $('#mediaBimestre3_'+idCampo).val($('#media_'+idCampo).val());
                            }
                  //    alert(x+'-'+ac1+'-'+ac2+'-'+ac3+'-'+);
         }

         if($('#etapa').val() == "4")
         {
                  var x = 0;
                if(ac1 == ''){
                        ac1 = 0;
                }else{
                        x = x + 1;
                }

                if(ac2 == ''){
                        ac2 = 0;
                }else{
                        x = x + 1;
                }

                if(ac3 == ''){
                        ac3 = 0;
                }else{
                        x = x + 1;
                }
                var soma = parseFloat(ac1) + parseFloat(ac2) + parseFloat(ac3);
                var media = soma / x;

                if(x == 0 && soma == 0){
                    media = 0;
                }
                
                $('#media_'+idCampo).val(media.toFixed(2));
                        if(parseFloat($('#recuperacao_'+idCampo).val()) > parseFloat($('#media_'+idCampo).val()))
                        {
                        $('#mediaBimestre4_'+idCampo).val($('#recuperacao_'+idCampo).val());
                        }else{
                            $('#mediaBimestre4_'+idCampo).val($('#media_'+idCampo).val());
                            }
                  //    alert(x+'-'+ac1+'-'+ac2+'-'+ac3+'-'+);
         }

         var ME1 =  $('#mediaBimestre1_'+idCampo).val();
         var ME2 =  $('#mediaBimestre2_'+idCampo).val();
         var ME3 =  $('#mediaBimestre3_'+idCampo).val();
         var ME4 =  $('#mediaBimestre4_'+idCampo).val();


          var x = 0;
        if(ME1 == ''){
               ME1 = 0;
        }else{
                x = x + 1;
        }

        if(ME2 == ''){
            ME2 = 0;
        }else{
                x = x + 1;
        }

        if(ME3 == ''){
            ME3 = 0;
        }else{
                x = x + 1;
        }

        if(ME4 == ''){
            ME4 = 0;
        }else{
                x = x + 1;
        }
		var totalPontos = parseFloat(ME1) + parseFloat(ME2) + parseFloat(ME3) + parseFloat(ME4);
		$('#totalPontos_'+idCampo).val(totalPontos);
        var soma2 = parseFloat(ME1) + parseFloat(ME2) + parseFloat(ME3) + parseFloat(ME4);
        var media2 = soma2 / x;
        $('#mediaAnual_'+idCampo).val(media2.toFixed(2));
                if(parseFloat($('#provaFinal_'+idCampo).val()) > parseFloat($('#mediaAnual_'+idCampo).val()))
                {
                $('#mediaFinal_'+idCampo).val($('#provaFinal_'+idCampo).val());
                }else{
                    $('#mediaFinal_'+idCampo).val($('#mediaAnual_'+idCampo).val());
                    }
                    if( (parseFloat($('#mediaFinal_'+idCampo).val())) >= 7)
                         {
                            $('#situacao_'+idCampo).val('APR');
                          }else{
                                  $('#situacao_'+idCampo).val('REP');
                         }
         }
 }

function mediaAlunoMedia(idCampo){

	        var etapa = $('#etapa').val();
	        var media = $('#media_'+idCampo).val();
	                //$('#media_'+idCampo).val(media.toFixed(2));
	                        if(parseFloat($('#recuperacao_'+idCampo).val()) > parseFloat($('#media_'+idCampo).val()))
	                        {
	                        $('#mediaBimestre'+etapa+'_'+idCampo).val($('#recuperacao_'+idCampo).val());
	                        }else{
	                            $('#mediaBimestre'+etapa+'_'+idCampo).val($('#media_'+idCampo).val());
	                        }

	         var ME1 =  $('#mediaBimestre1_'+idCampo).val();
	         var ME2 =  $('#mediaBimestre2_'+idCampo).val();
	         var ME3 =  $('#mediaBimestre3_'+idCampo).val();
	         var ME4 =  $('#mediaBimestre4_'+idCampo).val();


	          var x = 0;
	        if(ME1 == ''){
	               ME1 = 0;
	        }else{
	                x = x + 1;
	        }

	        if(ME2 == ''){
	            ME2 = 0;
	        }else{
	                x = x + 1;
	        }

	        if(ME3 == ''){
	            ME3 = 0;
	        }else{
	                x = x + 1;
	        }

	        if(ME4 == ''){
	            ME4 = 0;
	        }else{
	                x = x + 1;
	        }
			var totalPontos = parseFloat(ME1) + parseFloat(ME2) + parseFloat(ME3) + parseFloat(ME4);
			$('#totalPontos_'+idCampo).val(totalPontos);
	        var soma2 = parseFloat(ME1) + parseFloat(ME2) + parseFloat(ME3) + parseFloat(ME4);
	        var media2 = soma2 / x;
	        $('#mediaAnual_'+idCampo).val(media2.toFixed(2));
	                if(parseFloat($('#provaFinal_'+idCampo).val()) > parseFloat($('#mediaAnual_'+idCampo).val()))
	                {
	                $('#mediaFinal_'+idCampo).val($('#provaFinal_'+idCampo).val());
	                }else{
	                    $('#mediaFinal_'+idCampo).val($('#mediaAnual_'+idCampo).val());
	                    }
	                    if( (parseFloat($('#mediaFinal_'+idCampo).val())) >= 7)
	                         {
	                        $('#media_'+idCampo).val(media.toFixed(2));
	                        if(parseFloat($('#recuperacao_'+idCampo).val()) > parseFloat($('#media_'+idCampo).val()))
	                        {
	                        $('#mediaBimestre1_'+idCampo).val($('#recuperacao_'+idCampo).val());
	                        }else{
	                            $('#mediaBimestre1_'+idCampo).val($('#media_'+idCampo).val());
	                            }
	                  //    alert(x+'-'+ac1+'-'+ac2+'-'+ac3+'-'+);
	         
	                            $('#situacao_'+idCampo).val('APR');
	                          }else{
	                                  $('#situacao_'+idCampo).val('REP');
	                         }
	 }

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
	
