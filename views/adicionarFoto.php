<script type="text/javascript" src="js/ajaxfileupload.js"></script>
<script type="text/javascript">
	function ajaxFileUpload()
	{
		/*$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});*/

		$.ajaxFileUpload
		(
			{
				url:'../controllers/enviarfoto.php',
				secureuri:false,
				fileElementId:'foto',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					if(data)
					{
						alert(data);
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;

	}
	</script>	
	<div class="row">
		<div class="four columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Enviar foto do aluno</h3>
		</div>
	</div>
	
	<form action="" method="post" name="formFoto" id="formFoto" accept-charset="utf-8">
	<div class="row">
		<div class="three columns">
			<label>Selecione a foto</label>
			<input id="foto" type="file" name="foto" class="input">
			<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();">Enviar</button>
		</div>
	</div>
	</form>
	
	
	
	
	
