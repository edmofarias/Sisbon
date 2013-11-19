
		<?php if(!$_GET['m'])include 'header.php';  ?>
		<h3 id="titulo_pagina" class="titulo_page" >Turmas</h3>
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
				$( ".ui-button-list" ).button({
			        icons: {
			          primary: "ui-icon-document"
			        },
			        text: true
			      });
				 $('#tabela').dataTable( {
				        "aaSorting": [[ 0, "ASC" ]],
				        "bJQueryUI": true,
				        "sPaginationType": "full_numbers",
				        "bProcessing": true,
				        "bServerSide": true,
				        "sAjaxSource": "../helper/listaTurma.php"
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
		
			<div id="escolher_etapa" style="display: none;">
				Escolha a etapa
				<select id="etapa_boletins" width="20">
					<option value="1">1 Etapa</option>
					<option value="2">2 Etapa</option>
					<option value="3">3 Etapa</option>
					<option value="4">4 Etapa</option>
				</select>
			</div>
			
			<div id="escolher_acao" style="display: none;">
				Escolha a etapa
				<select id="etapa_confirmar" width="20">
					<option value="1">1 Etapa</option>
					<option value="2">2 Etapa</option>
					<option value="3">3 Etapa</option>
					<option value="4">4 Etapa</option>
				</select>
				<br clear="all">
				Escolha a ação:
				<select id="confirmar_nConfirmar" width="20">
					<option value="0">Não Confirmar</option>
					<option value="1">Confirmar</option>
				</select>
			</div>
			
	<div id="demo">
			<button class="ui-button-new" onclick="location.href='formTurma.php';" >Nova Turma</button>
			<button class="ui-button-list" onclick="listarRanking();" >Ranking de Alunos</button>
			<div><br /></div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabela">
				<thead>
					<tr>
						<th>ID</th>
						<th>Serie</th>
						<th>Nome</th>
						<th>Turno</th>
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
	</div><!-- dt_example -->
	
</div><!-- content2 -->
			
</div><!-- box -->

<br class="clearfix" />

<? include 'footer.php';  ?>
