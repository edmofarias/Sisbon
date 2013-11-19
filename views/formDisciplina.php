<?php include 'header.php';?>
<?		require_once '../models/db/Conexao.php';
		require_once '../models/db/MateriaDAO.php';
		
			
		$dao = new MateriaDAO();
		$qry = $dao->listarPorID($_GET['id']);
		$result = $qry[0];
		//while ($result = mysql_fetch_array($qry)) {
			
			$nome = $result['nome'];
												
		//}
		
		$funcao = "alterar";
		if (!$_GET['id']) 
			$funcao = "inserir";
		
		?>
		
	<div class="row">
		<div class="six columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Cadastro de Disciplinas</h3>
		</div>
	</div>

<form action="../controllers/materia.php?funcao=<?php echo $funcao ?>" method="post" name="formMat" id="formMat" accept-charset="utf-8">
 <input type="hidden" name="idMat" value="<?echo $_GET['id']?>"/>
  
  <fieldset>

  <legend>Disciplina</legend>
  
  <div class="row">
  	<div class="six columns">
  		<label>Disciplina <span> * </span> <span id="nome_aviso"></label>
  		<input type="text" id="nome" obrigatorio="true" onblur="validarCampo(this,'texto');" onkeyup="removeAviso(this);" validar="nome" Descricao="Nome" value="<?php echo $nome ?>" name="nome" maxlength="100" />
  	</div>
  </div>
 </fieldset>
</form>
<div class="row">
		<div class="one columns">
            <button id="salvar-button" class="button" 
            <?php if($funcao == "inserir"){?>
            	onClick="return verificarCampos('#formMat','listaDisciplina.php','enviaFormulario');"
            <?php }elseif($funcao == "alterar"){?>
            	onClick="return verificarCampos('#formMat','listaDisciplina.php','enviaFormularioEditar');"
            <?php }?>
                >
              Salvar
            </button>
        </div>
        <div class="eleven columns"></div>
 </div>
 
 <?php include 'footer.php';?>