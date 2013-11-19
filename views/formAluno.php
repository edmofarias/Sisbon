<?php include 'header.php';?>
<?		require_once '../models/db/Conexao.php';
		require_once '../models/db/AlunoDAO.php';
		require_once '../models/db/TurmaDAO.php';
		include_once '../helper/Funcoes.php';
		
			
		$dao = new AlunoDAO();
		$qry = $dao->listarPorID($_GET['id']);
		
		$result = $qry[0];
		
		$daoTurma = new TurmaDAO();
		$qryTurma = $daoTurma->listar();
		
			$nome = $result['nome'];
			$responsavel = $result['responsavel'];
			$matricula = $result['matricula'];
			$usuario = $result['login'];
			$senha = $result['senha'];
			$id = $result['id'];
			$nomeTurma = $result['nomeTurma'];
			$serie = $result['serie'];
			$idTurma = $result['idTurma'];
			$telefone = $result['telefone'];
			$telefoneResp = $result['telefoneResp'];
			$email = $result['email'];
			$emailResp = $result['emailResp'];
			
			$rua = ($result['endereco']);
			$numRes =( $result['numRes']);
			$bairro = ($result['bairro']);
			$cidade = ($result['cidade']);
			$estado = ($result['estado']);
			$cep = ($result['cep']);
			$pais = ($result['pais']);
			$complemento = ($result['complemento']);
			
			$foto = ($result['foto']);
			
			$anoAluno = $result['ano'];
			$status = $result['status'];
			
			$sexo = $result['sexo'];
			$dataNascimento = Funcao::dateFormat($result['dataNascimento']);
									
		$funcao = "alterar";
		if (!$_GET['id']) 
			$funcao = "inserir";
		
		?>
	<script>
		function dataPicker()
		{
			$( "#dataNascimento" ).datepicker({ dateFormat: "dd/mm/yy" });
		}
	</script>
		
		
	<div class="row">
		<div class="four columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Cadastro de Alunos</h3>
		</div>
	</div>
	
<form action="../controllers/aluno.php?funcao=<?php echo $funcao ?>" method="post" name="formAluno" id="formAluno" enctype="multipart/form-data" accept-charset="utf-8">
  <input type="hidden" name="loginOld" id="loginOld" value="<?php echo $usuario ?>"/>
  <input type="hidden" name="senhaAnt" value="<?php echo $senha ?>"/>
  <input type="hidden" name="idAluno" value="<?php echo $id ?>"/>
  <input type="hidden" name="turmaOld" value="<?php echo $idTurma ?>"/>
  
  <fieldset>

  <legend>Dados do aluno</legend>
  
  <div class="row">
  	<div class="three columns">
  	<label>Matrícula <span> * </span> <span id="matricula_aviso"> </label>
  		<input type="text" id="matricula" obrigatorio="true" onblur="validarCampo(this,'texto');" onkeyup="removeAviso(this);" validar="nome" value="<?php echo $matricula ?>" name="matricula" size="10" />
 	</div>
 </div>
  
  <div class="row">
  	<div class="nine columns">
  		<label>Nome <span> * </span> <span id="nome_aviso"></label>
  		<input type="text" id="nome" obrigatorio="true" onblur="validarCampo(this,'texto');" onkeyup="removeAviso(this);" validar="nome" Descricao="Nome" value="<?php echo $nome ?>" name="nome" maxlength="100" />
  	</div>
  	
  	<div class="three columns">
  	
  	<label>Sexo <span> * </span> <span id="sexo_aviso"></span></label>
         <select class="custom dropdown" id="sexo" name="sexo" onblur="validarCampo(this,'texto');" obrigatorio="true" onchange="removeAviso(this);"> 
			 <option value="<?php echo $sexo?>"><?php echo $sexo?></option>
			  <option value="Masculino" >Masculino</option>
			  <option value="Feminino" >Feminino</option>
		 </select>
  	</div>
  	
  </div>
  <div class="row">
  
   	  <div class="three columns">
		<label>Data de Nascimento<span> * </span></label>
		<input type="text" name="dataNascimento" id="dataNascimento" maxlength="10" obrigatorio="true" onkeydown="Mascara(this,Data)" onkeyup="removeAviso(this);" onclick="dataPicker();" onblur="validarCampo(this,'data');" value="<?php echo $dataNascimento ?>" />
	  </div>
	  
	<div class="six columns">
		<label>E-mail<span> * </span> <span id="email_aviso"></span></label>
		<input id="email" name="email" type="text" maxlength="100" value="<?php echo $email ?>" onblur="validarCampo(this,'email');" onkeyup="removeAviso(this);"/>
	 </div>
	 
	 <div class="three columns">
		<label>Telefone</label>
		<input id="telefone" name="telefone" size="20" maxlength="14" value="<?php echo $telefone ?>" type="text" onkeydown="Mascara(this,Telefone)" onkeypress="Mascara(this,Telefone)" >
	  </div>
	 
	</div>
	
	<div class="row">
	
		<div class="two columns">
		<label>Turma</label>
		 <select class="form-dropdown" id="turma" name="turma" style=" background-color: #FFFFFF; border: 1px solid #DDDDDD;">
            <option value="" > </option>
            <?php foreach ($qryTurma as $result0) {?>
            <?php if($idTurma == $result0['idTurma']){ ?>
            <option value="<?php echo $result0['idTurma'] ?>" selected="selected"> <?php echo utf8_encode($result0['nomeSerie'].' '.$result0['nome'])?> </option>
            <?php }else {?>
            <option value="<?php echo $result0['idTurma'] ?>"> <?php echo utf8_encode($result0['nomeSerie'].' '.$result0['nome'])?> </option>
            <?php }
		}?>
          </select>
		</div>
		
		<div class="two columns">
		<label>Ano</label>
		 <select class="form-dropdown" id="ano" name="ano" style=" background-color: #FFFFFF; border: 1px solid #DDDDDD;">
		 	<?php  
		 	$ano = date('Y');
            $anoLimite = $ano + 5;
            while ($ano <= $anoLimite) {?>
            <?php if($ano == $anoAluno){ ?>
            	<option value="<?= $ano ?>" selected="selected"> <?= $ano ?> </option>
            <?php }else{?>
            	<option value="<?= $ano ?>"> <?= $ano?> </option>
            <?php }
            $ano++;
		}?>
          </select>
		</div>
		
		<div class="three columns end">
		<label>Status</label>
		 <select class="form-dropdown" id="status" name="status" style=" background-color: #FFFFFF; border: 1px solid #DDDDDD;">
           	<option value="0" <?php if($status == 0){ echo 'selected="selected"';}?>> Não matriculado </option>
           	<option value="1" <?php if($status == 1){ echo 'selected="selected"';}?>> Matriculado </option>
          </select>
		</div>
		
	</div>
	<br/>
  </fieldset>
  
  <fieldset>
  
  <legend>Reponsável</legend>
  
  <div class="row">
  	<div class="twelve columns">
  		<label>Nome <span> * </span> <span id="nomeResp_aviso"></label>
  		<input type="text" id="nomeResp" obrigatorio="true" onblur="validarCampo(this,'texto');" onkeyup="removeAviso(this);" validar="nome" Descricao="Nome" value="<?php echo $responsavel ?>" name="nomeResp" maxlength="100" />
  	</div>
  	
  </div>
  <div class="row">
  
	<div class="six columns">
		<label>E-mail</label>
		<input id="emailResp" name="emailResp" type="text" maxlength="100" value="<?php echo $emailResp ?>" onblur="validarCampo(this,'email');" onkeyup="removeAviso(this);"/>
	 </div>
	 
	 <div class="three columns">
		<label>Telefone <span> * </span> <span id="telefoneResp_aviso"></label>
		<input id="telefoneResp" name="telefoneResp" maxlength="14" value="<?php echo $telefoneResp ?>" type="text" onkeydown="Mascara(this,Telefone)" onkeypress="Mascara(this,Telefone)" obrigatorio="true" onblur="validarCampo(this,'texto');" onkeyup="removeAviso(this);" validar="nome" />
	  </div>
	 
	 <div class="three columns">
	  </div>
	 
	</div>
	
  </fieldset>
  
  <fieldset>
  <legend>Endereço</legend>
	<div class="row">
	  <div class="three columns">
		<label>CEP</label>
		<input name="cep" id="cep" maxlength="8" value="<?php echo $cep ?>" type="text"/>
	  </div>
	</div>
	
	<div class="row">
	  <div class="ten columns">
		<label>Rua</label>
		<input name="endereco" id="endereco" value="<?php echo $rua ?>" type="text"/>
	  </div>
	  <div class="two columns">
		<label>Nº</label>
		<input name="numRes" id="numRes" maxlength="5" value="<?php echo $numRes ?>" type="text" />
	  </div>
	</div>
	
	<div class="row">
	  <div class="five columns">
		<label>Bairro</label>
		<input name="bairro" id="bairro" value="<?php echo $bairro ?>" maxlength="100" type="text"/>
	  </div>
	  <div class="five columns">
		<label>Cidade<span> * </span> <span id="cidade_aviso"></span></label>
		<input name="cidade" id="cidade" type="text" value="<?php echo $cidade ?>" onblur="validarCampo(this,'texto');" obrigatorio="true" onkeyup="removeAviso(this);"/>
	  </div>
		<div class="one columns">
		<label>UF<span> * </span></label>
		<input name="estado" id="estado" maxlength="2" value="<?php echo $estado ?>" type="text" onblur="validarCampo(this,'texto');" obrigatorio="true" onkeyup="removeAviso(this);"/>
	  </div>
	  <div class="one columns">
	  </div>
	</div>
	
	<div class="row">
	  <div class="twelve columns">
		<label>Complemento</label>
		<input id="complemento" name="complemento" class="element text medium" type="text" maxlength="255" value="<?php echo $complemento ?>"/>
	  </div>
	</div>
	
	</fieldset>
	
	<div class="row">
		<?php if($foto){?>
		<div class="two columns">
			<center><img alt="Foto do Aluno" src="../helper/fotos/<?= $foto?>"></center>
		</div>
		<?php } ?>
		<div class="seven columns end">
			<label>Foto do aluno (<span style="color:grey;">Tamanho Máximo: 1MB | Altura: 500px | Largura: 500px</span> )</label>
			<input type="file" name="foto" id="foto" />
		</div>
	</div>
	<br/>
	<div class="row">
		<div class="three columns">
		<label>Login</label>
			<input type="text" onblur="verificaLogin(this);" id="login" value="<?php echo $usuario ?>" name="login" maxlength="12" />
		</div>
		
		<div class="three columns end">
		<label>Senha</label>
			 <input type="password" id="senha" name="senha" maxlength="8" />
		</div>
		
	</div>
	
	<div class="row">
		<div class="one columns end">
            <input type="submit" value="Salvar" id="salvar-button" class="button" onClick="return verificarCamposAluno('#formAluno');">
        </div>
 </div>
	
</form>
 
 <!-- <div class="row">
		<div class="one columns end">
            <button id="salvar-button" class="button" 
            <?php //if($funcao == "inserir"){?>
            	onClick="return verificarCampos('#formAluno','adicionarFoto.php','enviaFormulario');"
            <?php //}elseif($funcao == "alterar"){?>
            	onClick="return verificarCampos('#formAluno','listaAluno.php','enviaFormularioEditar');"
            <?php // }?>
                >
              Salvar
            </button>
        </div>
 </div> -->

<?php include 'footer.php';?>
