<?	
include 'header.php';
require_once '../models/db/Conexao.php';
		require_once '../models/db/ProfessorDAO.php';
		include_once '../helper/Funcoes.php';
	
			
		$dao = new ProfessorDAO();
		$qry = $dao->listarPorID($_GET['id']);
		$result = $qry[0];
		//while ($result = mysql_fetch_array($qry)) {
			
			$nome = $result['nome'];
			$email = $result['email'];
			$usuario = $result['login'];
			$senha = $result['senha'];
			$telefone = $result['telefone'];
			
			$rua = ($result['endereco']);
			$numRes =( $result['numRes']);
			$bairro = ($result['bairro']);
			$cidade = ($result['cidade']);
			$estado = ($result['estado']);
			$cep = ($result['cep']);
			$pais = ($result['pais']);
			$complemento = ($result['complemento']);
			
			$sexo = $result['sexo'];
			$dataNascimento = Funcao::dateFormat($result['dataNascimento']);
												
		//}
		
		$funcao = "alterar";
		if (!$_GET['id']) 
			$funcao = "inserir";
		
		?>

	<div class="row">
		<div class="five columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Cadastro de Professores</h3>
		</div>
	</div>

<form action="../controllers/professor.php?funcao=<?php echo $funcao ?>" method="post" name="formProf" id="formProf" accept-charset="utf-8">
  <input type="hidden" name="loginOld" id="loginOld" value="<?php echo $usuario ?>"/>
  <input type="hidden" name="idProf" id="idProf" value="<?php echo $_GET['id']?>"/>
  <input type="hidden" name="senhaAnt" value="<?php echo $senha ?>"/>
  
  <fieldset>

  <legend>Dados do professor</legend>
  
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
  
   	  <div class="three columns">
		<label>Data de Nascimento<span> * </span><span id="dataNascimento_aviso"></span></label>
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
  
   <fieldset>
  <legend>Materias</legend>
  	<div class="row" id="materias">
	  <?php 
			require_once '../models/db/MateriaDAO.php';
			require_once '../models/db/ProfessorDAO.php';
			
			$dao = new MateriaDAO();
			$result = $dao->listar();
			
			$daoPRO = new ProfessorDAO();
			$resultMAT = $daoPRO->listarMaterias($_GET['id']);
			$i = 0;
			$c = 0;
			foreach ($resultMAT as $materias){
				$materia[$i] = $materias['id'];
				$i++;
			}
			
			foreach ($result as $value)
			{
				if(($c == 0) || ($c%10 == 0))
				{
					echo '
					<div class="three columns end">
						<table>
							<tr>';
				}
				else 
				{
					echo '<tr>';
				}
				
				if($_GET['id'] != null)
				{
					$mostrou = false;
					$materiaLista = $value['id'];
					$i = 0;
					while ($i < count($materia))
					{
						if($materia[$i] == $materiaLista)
						{
							echo '<td><input type="checkbox" id="mat_'.$value['id'].'" name="materias[]" value="'.$value['id'].'" checked="checked" /> '.utf8_encode(utf8_decode($value['nome'])).'</td>';
							$mostrou = true;
						}
						$i++;
					}
					
					if($mostrou == false)
					{
						echo '<td><input type="checkbox" id="mat_'.$value['id'].'" name="materias[]" value="'.$value['id'].'" /> '.utf8_encode(utf8_decode($value['nome'])).'</td>';
					}
				}
				else
				{
					echo '<td><input type="checkbox" id="mat_'.$value['id'].'" name="materias[]" value="'.$value['id'].'" /> '.utf8_encode(utf8_decode($value['nome'])).'</td>';
				}
				
				$c ++;
				if(($c == 0) || ($c%10 == 0))
				{
					echo '</tr>
						</table>
					</div>';
				}
				else 
				{
					echo '</tr>';
				}
			}
			?>
	  </table>
	</div>
  </fieldset>
     
  <fieldset>
  <legend>Turmas</legend>
  	<div class="row" id="turmas">
      <?php 
			require_once '../models/db/TurmaDAO.php';			
			$daoTurma = new TurmaDAO();
			$result = $daoTurma->listar();
			
			$resultTUR = $daoPRO->listarTurmas($_GET['id']);
			
			$i = 0;
			$c = 0;
			foreach ($resultTUR as $turmas)
			{
				$turma[$i] = $turmas['idTurma'];
				$i++;
			}
			
			foreach ($result as $value)
			{
				
				if(($c == 0) || ($c%10 == 0))
				{
					echo '
					<div class="two columns end">
					<table>
					<tr>';
				}
				else
				{
					echo '<tr>';
				}
				
				if($_GET['id'] != null){
				
					$mostrou = false;
					$turmaLista = $value['idTurma'];
					$i = 0;
					while ($i < count($turma)){
						if($turma[$i] == $turmaLista)
						{
							echo '<td><input type="checkbox" class="form-checkbox" id="tur_'.$value['idTurma'].'" name="turmas[]" value="'.$value['idTurma'].'" checked="checked" /> '.utf8_encode($value['nomeSerie'].' '.$value['nome']).'</td>';
							$mostrou = true;
						}
						$i++;
					}
					if($mostrou == false)
					{
						echo '<td><input type="checkbox" class="form-checkbox" id="tur_'.$value['idTurma'].'" name="turmas[]" value="'.$value['idTurma'].'" /> '.utf8_encode($value['nomeSerie'].' '.$value['nome']).'</td>';
					}
				}else{
					echo '<td><input type="checkbox" class="form-checkbox" id="tur_'.$value['idTurma'].'" name="turmas[]" value="'.$value['idTurma'].'" /> '.(utf8_encode($value['nomeSerie'].' '.$value['nome'])).'</td>';
				}
				
				$c++;
				if(($c == 0) || ($c%10 == 0))
				{
					echo '</tr>
					</table>
					</div>';
				}
				else
				{
					echo '</tr>';
				}
				
			}
			?>
			</table>
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
            	onClick="return verificarCampos('#formProf','listaProfessor.php','enviaFormularioProf');"
            <?php }elseif($funcao == "alterar"){?>
            	onClick="return verificarCampos('#formProf','listaProfessor.php','enviaFormularioEditarProf');"
            <?php }?>
                >
              Salvar
            </button>
        </div>
        <div class="eleven columns"></div>
 </div>


<?php include 'footer.php';?>



