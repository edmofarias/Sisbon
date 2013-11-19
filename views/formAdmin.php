<?php include 'header.php';?>
<?		require_once '../models/db/Conexao.php';
		require_once '../models/db/AdminDAO.php';
		
			
		$dao = new AdminDAO();
		$qry = $dao->listarPorID($_GET['id']);
		$result = $qry[0];
		//while ($result = mysql_fetch_array($qry)) {
			
			$nome = $result['nome'];
			$usuario = $result['login'];
			$senha = $result['senha'];
			$id = $result['id'];
			$sexo = $result['sexo'];
			$telefone = $result['telefone'];
			$email = $result['email'];
									
		//}
		
		$funcao = "alterar";
		if (!$_GET['id']) 
			$funcao = "inserir";
		
		?>


	<div class="row">
		<div class="six columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Cadastro de Administradores</h3>
		</div>
	</div>

<form action="../controllers/admin.php?funcao=<?php echo $funcao ?>" method="post" name="formAdmin" id="formAdmin" accept-charset="utf-8">
   <input type="hidden" name="idAdmin" value="<?echo $_GET['id']?>"/>
  <input type="hidden" name="senhaAnt" value="<?php echo $senha ?>"/>
	<input type="hidden" name="loginOld" id="loginOld" value="<?php echo $usuario ?>"/>
  
  <fieldset>

  <legend>Dados do Administrador</legend>
  
  <div class="row">
  	<div class="nine columns">
  		<label>Nome <span> * </span> <span id="nome_aviso"></label>
  		<input type="text" id="nome" obrigatorio="true" onblur="validarCampo(this,'texto');" onkeyup="removeAviso(this);" validar="nome" Descricao="Nome" value="<?php echo $nome ?>" name="nome" maxlength="100" />
  	</div>
  	
  	<div class="three columns">
  	
  	<label>Sexo <span> * </span> <span id="sexo_aviso"></span></label>
         <select id="sexo" name="sexo" onblur="validarCampo(this,'texto');" obrigatorio="true" onchange="removeAviso(this);"> 
			 <option value="<?php echo $sexo?>"><?php echo $sexo?></option>
			  <option value="Masculino" >Masculino</option>
			  <option value="Feminino" >Feminino</option>
		 </select>
  	</div>
  	
  </div>
  
  <div class="row">
  
	<div class="six columns">
		<label>E-mail<span> * </span> <span id="email_aviso"></span></label>
		<input id="email" name="email" type="text" maxlength="100" value="<?php echo $email ?>" onblur="validarCampo(this,'email');" onkeyup="removeAviso(this);"/>
	 </div>
	 
	 <div class="three columns">
		<label>Telefone</label>
		<input id="telefone" name="telefone" size="20" maxlength="14" value="<?php echo $telefone ?>" type="text" onkeydown="Mascara(this,Telefone)" onkeypress="Mascara(this,Telefone)" >
	  </div>
	 
	 <div class="three columns">
	  </div>
	 
	</div>
	
  </fieldset>

  <div class="row">
		<div class="three columns">
		<label>Login</label>
			<input type="text" onblur="verificaLogin(this);" id="login" value="<?php echo $usuario ?>" name="login" maxlength="12" />
		</div>
		
		<div class="three columns">
		<label>Senha</label>
			 <input type="password" id="senha" name="senha" maxlength="8" />
		</div>
		
		<div class="six columns">
		</div>
	</div>
</form>

<div class="row">
		<div class="one columns">
            <button id="salvar-button" class="button" 
            <?php if($funcao == "inserir"){?>
            	onClick="return verificarCampos('#formAdmin','listaAdmin.php','enviaFormulario');"
            <?php }elseif($funcao == "alterar"){?>
            	onClick="return verificarCampos('#formAdmin','listaAdmin.php','enviaFormularioEditar');"
            <?php }?>
                >
              Salvar
            </button>
        </div>
        <div class="eleven columns"></div>
 </div>


<?php include 'footer.php';?>
