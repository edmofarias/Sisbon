
		<?php if(!$_GET['m'])include 'header.php';?>
		<?php if($_GET['al']){
			echo "<script> mostrarAviso('Registro salvo com sucesso!','aviso');</script>";
		}?>
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
				        "sAjaxSource": "../helper/lista.php"
				      } );
				 $('#tabela_length select').attr('style','width: 20%; margin-top: 8px;');
				 $('#tabela_length label').attr('style','color:white;');
				 
				 $('#tabela_filter input').attr('style','display: inline; width: 75%; margin: 5px 0 5px 0;');
				 $('#tabela_filter label').attr('style','color:white;');
				 
			} );
			
		</script>
		
	<div class="row">
		<div class="four columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Alunos</h3>
		</div>
	</div>
	
	<div class="row">
		<div class="twelve columns content3">
		
		<div id="container">
				
			<button class="ui-button-new" onclick="location.href='formAluno.php';" >Novo Aluno</button>
			<div><br /></div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabela">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nome do Aluno</th>
						<th>Matricula</th>
						<th>Turma</th>
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
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="spacer"></div>
	</div>
	</div>
	
	<br class="clearfix" />

<?php include 'footer.php';?>
