
		<?php if(!$_GET['m'])include 'header.php';  ?>
		<h3 id="titulo_pagina" class="titulo_page">Disciplinas</h3>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"sPaginationType": "full_numbers"
				} );
				$( ".ui-button-new" ).button({
			        icons: {
			          primary: "ui-icon-plusthick"
			        },
			        text: true
			      });
				 $('#tabela').dataTable( {
				        "aaSorting": [[ 0, "ASC" ]],
				        "bJQueryUI": true,
				        "sPaginationType": "full_numbers",
				        "bProcessing": true,
				        "bServerSide": true,
				        "sAjaxSource": "../helper/listaMat.php"
				      } );
				 $('#tabela_length select').attr('style','width: 20%; margin-top: 8px;');
				 $('#tabela_length label').attr('style','color:white;');
				 
				 $('#tabela_filter input').attr('style','display: inline; width: 75%; margin: 5px 0 5px 0;');
				 $('#tabela_filter label').attr('style','color:white;');
			} );
		</script>

		<div class="box">
		
	
		<div class="content3">

	<div id="dt_example" class="example_alt_pagination">
		<div id="container">
			
<div id="demo">
<button class="ui-button-new" onclick="location.href='formDisciplina.php';" >Nova Disciplina</button>
<div><br /></div>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabela">
	<thead>
		<tr>
			<th>ID</th>
			
			<th>Nome</th>
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
			
			
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>


		<style type="text/css">
				@import "../examples_support/syntax/css/shCore.css";
			</style>
			<script type="text/javascript" language="javascript" src="../examples_support/syntax/js/shCore.js"></script> 

		</div>
	</div><!-- dt_example -->
	
</div><!-- content2 -->
			
</div><!-- box -->

<br class="clearfix" />

<? include 'footer.php';  ?>
