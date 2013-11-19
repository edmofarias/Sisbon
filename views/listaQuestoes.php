<?php include_once 'header.php'; ?>

<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				 $( ".ui-button-new" ).button({
				        icons: {
				          primary: "ui-icon-plusthick"
				        },
				        text: true
				      });

				$('#example').dataTable( {
					"sPaginationType": "full_numbers"
				} );

				 $('#tabela').dataTable( {
				        "aaSorting": [[ 0, "ASC" ]],
				        "bJQueryUI": true,
				        "sPaginationType": "full_numbers",
				        "bProcessing": true,
				        "bServerSide": true,
				        "sAjaxSource": "../helper/GridListaQuestoes.php"
				      } );
				 $('#tabela_length select').attr('style','width: 20%; margin-top: 8px;');
				 $('#tabela_length label').attr('style','color:white;');
				 
				 $('#tabela_filter input').attr('style','display: inline; width: 75%; margin: 5px 0 5px 0;');
				 $('#tabela_filter label').attr('style','color:white;');
				 
			} );
			
		</script>
		
	<div class="row">
		<div class="four columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Questões</h3>
		</div>
	</div>
	
	<div class="row">
		<div class="twelve columns content3">
		
		<div id="container">
				
			<button class="button" onclick="location.href='formQuestoes.php';" >Nova Questão</button>
			<div><br /></div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabela">
				<thead>
					<tr>
						<th>Id</th>
						<th>Enunciado da Questão</th>
						<th>Correta</th>
						<th>Pontuação</th>
						<th>Disciplina</th>
						<th>Operações</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	</div>
	
<?php include_once 'footer.php';?>
