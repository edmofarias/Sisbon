<?php include 'header.php';  ?>
<?		require_once '../models/db/Conexao.php';
		require_once '../models/db/TurmaDAO.php';
		
			
		$dao = new TurmaDAO();
		$result0 = $dao->listarSeries();
		if($_GET['id'])
		{
			$qry = $dao->listarPorID($_GET['id']);
			$qtdAlunos = $dao->getQtdAlunos($_GET['id']);
			$result = $qry[0];
			//while ($result = mysql_fetch_array($qry)) {
				
				$nome = $result['nome'];
				$serie = $result['serie'];
				$turno = $result['turno'];
				$id = $result['id'];
			//}
		}
		$funcao = "alterar";
		if (!$_GET['id']) 
			$funcao = "inserir";
		
		?>

	<div class="row">
		<div class="five columns centered">
			<h3 id="titulo_pagina" class="titulo_page">Cadastro de Turmas</h3>
		</div>
	</div>
		 
<form action="../controllers/turma.php?funcao=<?php echo $funcao ?>" method="post" name="formTurma" id="formTurma" accept-charset="utf-8">
  <input type="hidden" name="idTurma" value="<?php echo $_GET['id'] ?>" />
  
  <div class="row">
  	<div class="six columns">
  	 Quantidade de alunos matriculados nesta turma : <?php echo $qtdAlunos;?>
  	</div>
  </div>
  
  <fieldset>

  <legend>Dados da Turma</legend>
  
  <div class="row">
  	<div class="three columns">
  		<label>Série <span> * </span> <span id="serie_aviso"></label>
  		<select id="serie" name="serie" onblur="validarCampo(this,'texto');" obrigatorio="true" onchange="removeAviso(this);">
            <option>  </option>
            <?php foreach ($result0 as $linha) {
            		if($serie == $linha['id']){ ?>
			            <option value="<?php echo $linha['id'] ?>" selected="selected"> <?php echo utf8_encode($linha['serie'])?> </option>
			   		<?php }else {?>
			            <option value="<?php echo $linha['id'] ?>"> <?php echo utf8_encode($linha['serie'])?> </option>
            		<?php }
			}?>
          </select>
  	</div>
  	
  	<div class="three columns">
  	
  	<label>Nome </label>
        <input type="text" id="nome" name="nome" value="<?php echo $nome ?>" />
  	</div>
  	
  	<div class="three columns end">
  	
  	<label>Turno </label>
  	<select name="turno">
  	<?php if(substr($turno, 0,1 ) == "M"){
  		$m = 'selected="selected"';
  	}elseif(substr($turno, 0,1 ) == "T"){
  		$t= 'selected="selected"';
  	}elseif(substr($turno, 0,1 ) == "N"){ 
  		$n = 'selected="selected"';
  	}?>
  	<option value="Manhã" <?= $m?>>Manhã</option>
  	<option value="Tarde" <?= $t?>>Tarde</option>
  	<option value="Noite" <?= $n?>>Noite</option>
  	</select>
  	</div>
  	
  </div>
 </fieldset>
 
 
   <fieldset>
  <legend>Materias <img src="imagens/ajuda.png" data-tooltip class="has-tip tip-top" title="Quando um boletim é criado ele obedecera as matérias associadas a turma referente." /></legend>
  	<div class="row" id="materias">
	  <?php 
			require_once '../models/db/MateriaDAO.php';
			
			$daoMateria = new MateriaDAO();
			$rsMateria = $daoMateria->listar();
			
			$rsMateriasTurma = $dao->listarMaterias($_GET['id']);
			$i = 0;
			$c = 0;
			foreach ($rsMateriasTurma as $materias){
				$materia[$i] = $materias['id'];
				$i++;
			}
			
			foreach ($rsMateria as $value)
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
 
 
</form>
<div class="row">
		<div class="one columns">
            <button id="salvar-button" class="button" 
            <?php if($funcao == "inserir"){?>
            	onClick="return verificarCampos('#formTurma','listaTurma.php','enviaFormularioTurma');"
            <?php }elseif($funcao == "alterar"){?>
            	onClick="return verificarCampos('#formTurma','listaTurma.php','enviaFormularioEditarTurma');"
            <?php }?>
                >
              Salvar
            </button>
        </div>
        <div class="eleven columns"></div>
 </div>
<?php include 'footer.php';  ?>