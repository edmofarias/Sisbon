<?php include 'header.php';?>

<div class="row">
		<div class="six columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Importar Dados</h3>
		</div>
	</div>

<form action="../controllers/importar.php?t=<?php echo $_GET['t'] ?>" method="post" name="formAdmin" id="formAdmin" accept-charset="utf-8" enctype="multipart/form-data">

 <fieldset>

  <legend>Importar dados (.csv)</legend>
  
  <div class="row">
  	<div class="five columns">
  		<label>Arquivo <span> * </span> <span id="nome_aviso"></label>
  		<input type="file" id="arquivo" obrigatorio="true" onblur="validarCampo(this,'texto');" onkeyup="removeAviso(this);" validar="nome" Descricao="Nome" value="<?php echo $nome ?>" name="arquivo" />
  	</div>
  	
  </div>
  
  <div class="row">
  <div class="two columns end">
          <input type="submit" class="button" value="Enviar" />
    </div>
  </div>
  </fieldset>

</form>
<?php include 'footer.php';?>