<?php
session_start();
session_register();
require_once 'Conexao.php';
/**
 * Classe responsavel por toda a comunicacao com o banco de dados relacionada com o boletim ...
 * @author edmo
 */
Class BoletimDAO{
	
	function inserirNovoBoletim($boletim)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("INSERT INTO cjaf_boletins (idAluno,dataGeracao,dataConfirmacao,confirmado,obs,mediaEtapa,resultadoFinal,serie,etapa) VALUES ('"
									.$boletim->getIdAluno()."','"
									.$boletim->getDataGeracao()."','"
									.$boletim->getDataConfirmacao()."','"
									.$boletim->getConfirmado()."','"
									.$boletim->getObs()."','"
									.$boletim->getMediaEtapa()."','"
									.$boletim->getResultadoFinal()."','"
									.$boletim->getSerie()."','"
									.$boletim->getEtapa()."')");
			$result ->execute();
			$id = $conn->lastInsertId();
			return $id;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function inserirBoletim($boletim)
	{
		try
		{
			$conn = Conexao::getInstance();
			/*Verifica a se existe boletim para esta etapa para esta serie e este aluno*/
			$result = $conn->prepare("SELECT count(*) as qtd FROM cjaf_boletins 
										WHERE idAluno='".$boletim->getIdAluno()."' 
											AND etapa = '".$boletim->getEtapa()."' 
											AND serie='".$boletim->getSerie()."'");
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			
			$qtd = $rs[0]['qtd'];
			
			/*se nao existir nenhum boletim referente cria um novo*/
			if($qtd == 0)
			{
				/*verifica qual o ultimo boletim gerado para este aluno*/
				$result = $conn->prepare("SELECT *
										FROM cjaf_boletins
										WHERE id = (SELECT MAX(id) FROM cjaf_boletins 
													WHERE idAluno='".$boletim->getIdAluno()."' 
													AND serie='".$boletim->getSerie()."')");
				$result ->execute();
				$rs = $result->fetchAll(PDO::FETCH_ASSOC);
				
				// se nao retornar nada cria um novo boletim sem notas anteriores
				if(count($rs) == 0)
				{
					$idBoletim = $this->inserirNovoBoletim($boletim);
					$array['x'] = 1;
					$array['load'] = "formBoletim.php?m=1&id=".$idBoletim."&idaln=".$boletim->getIdAluno();
					echo json_encode($array);exit;
				}
				
				foreach ($rs as $linha)
				{
					/*se o boletim for de 1 etapa nao preciso adicionar as medias da etapa anterior*/
					if($boletim->getEtapa() == 1)
					{
						$idBoletim = $this->inserirNovoBoletim($boletim);
							
						$array['x'] = 1;
						$array['load'] = 'listaBol.php?m=1&idaln='.$boletim->getIdAluno();
						echo json_encode($array);exit;
					}
					elseif($boletim->getEtapa() > 1)
					{
						//insiro os dados na tablela de boletim
						$idBoletim = $this->inserirNovoBoletim($boletim);
						
						//capturo as notas do ultimo boletim gerado para este aluno
						$result0 = $conn->prepare("SELECT *
													FROM cjaf_notas 
													WHERE idBoletim = '".$linha['id']."'");
						$result0 ->execute();
						$rs0 = $result0->fetchAll(PDO::FETCH_ASSOC);
						
						foreach ($rs0 as $linha2){
							
							//insiro as notas na tabela de notas
							$result1 = $conn->prepare("INSERT INTO cjaf_notas (idBoletim, idMateria, media1b,media2b,media3b,media4b) VALUES ('"
													.$idBoletim."','"
													.$linha2['idMateria']."','"
													.$linha2['media1b']."','"
													.$linha2['media2b']."','"
													.$linha2['media3b']."','"
													.$linha2['media4b']."')");
							$result1 ->execute();
							
						}
						
						$array['x'] = 1;
						$array['load'] = 'listaBol.php?m=1&idaln='.$boletim->getIdAluno();
						echo json_encode($array);exit;
					}		
				}
			}
			else/*se ja existir o boletim para este aluno*/
			{
				$array['x'] = 0;
				$array['load'] = 'formNovoBoletim.php?m=1&idaln='.$boletim->getIdAluno();
				echo json_encode($array);exit;
			}
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function inserirBoletimPorTurma($boletim)
	{
		try
		{
			$conn = Conexao::getInstance();
			/*Verifica a se existe boletim para esta etapa para esta serie e este aluno*/
			$result = $conn->prepare("SELECT count(*) as qtd FROM cjaf_boletins
					WHERE idAluno='".$boletim->getIdAluno()."'
					AND etapa = '".$boletim->getEtapa()."'
					AND serie='".$boletim->getSerie()."'");
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
				
			$qtd = $rs[0]['qtd'];
				
			/*se nao existir nenhum boletim referente cria um novo*/
			if($qtd == 0)
			{
				/*verifica qual o ultimo boletim gerado para este aluno*/
				$result = $conn->prepare("SELECT *
						FROM cjaf_boletins
						WHERE id = (SELECT MAX(id) FROM cjaf_boletins
						WHERE idAluno='".$boletim->getIdAluno()."'
						AND serie='".$boletim->getSerie()."')");
				$result ->execute();
				$rs = $result->fetchAll(PDO::FETCH_ASSOC);
	
				/* se nao retornar nada cria um novo boletim sem notas anteriores*/
				if(count($rs) == 0)
				{
					$idBoletim = $this->inserirNovoBoletim($boletim);
					/*$array['x'] = 1;
					$array['load'] = "formBoletim.php?m=1&id=".$idBoletim."&idaln=".$boletim->getIdAluno();
					echo json_encode($array);exit;*/
				}
	
				foreach ($rs as $linha)
				{
					/*se o boletim for de 1 etapa nao preciso adicionar as medias da etapa anterior*/
					if($boletim->getEtapa() == 1)
					{
						$idBoletim = $this->inserirNovoBoletim($boletim);
							
						/*$array['x'] = 1;
						$array['load'] = 'listaBol.php?m=1&idaln='.$boletim->getIdAluno();
						echo json_encode($array);exit;*/
					}
					elseif($boletim->getEtapa() > 1)
					{
						//insiro os dados na tablela de boletim
						$idBoletim = $this->inserirNovoBoletim($boletim);
	
						//capturo as notas do ultimo boletim gerado para este aluno
						$result0 = $conn->prepare("SELECT *
								FROM cjaf_notas
								WHERE idBoletim = '".$linha['id']."'");
						$result0 ->execute();
						$rs0 = $result0->fetchAll(PDO::FETCH_ASSOC);
	
						foreach ($rs0 as $linha2){
								
							//insiro as notas na tabela de notas
							$result1 = $conn->prepare("INSERT INTO cjaf_notas (idBoletim, idMateria, media1b,media2b,media3b,media4b) VALUES ('"
									.$idBoletim."','"
									.$linha2['idMateria']."','"
									.$linha2['media1b']."','"
									.$linha2['media2b']."','"
									.$linha2['media3b']."','"
									.$linha2['media4b']."')");
							$result1 ->execute();
								
						}
	
						/*$array['x'] = 1;
						$array['load'] = 'listaBol.php?m=1&idaln='.$boletim->getIdAluno();
						echo json_encode($array);exit;*/
					}
				}
			}
			else/*se ja existir o boletim para este aluno*/
			{
				/*$array['x'] = 0;
				$array['load'] = 'formNovoBoletim.php?m=1&idaln='.$boletim->getIdAluno();
				echo json_encode($array);exit;*/
			}
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function inserirNota($boletim,$tipo){
		try
		{
			$conn = Conexao::getInstance();
			$idBoletim = $boletim->getIdBoletim();
			$idMateria = $boletim->getIdMateria();//array
			$ac1 = $boletim->getAc1();
			$ac2 = $boletim->getAc2();
			$ac3 = $boletim->getAc3();
			$media = $boletim->getMedia();
			$recuperacao = $boletim->getRecuperacao();
			$faltas = $boletim->getFaltas();
			$media1b = $boletim->getMedia1b();
			$media2b = $boletim->getMedia2b();
			$media3b = $boletim->getMedia3b();
			$media4b = $boletim->getMedia4b();
			$totalPontos = $boletim->getTotalPontos();
			$mediaAnual = $boletim->getMediaAnual();
			$provaFinal = $boletim->getProvaFinal();
			$recProvaFinal = $boletim->getRecProvaFinal();
			$mediaFinal = $boletim->getMediaFinal();
			$situacao = $boletim->getSituacao();
		
			$result = $conn->prepare("DELETE FROM cjaf_notas WHERE idBoletim = '".$idBoletim."'");
			$result ->execute();
			
			/*$sql2 = "DELETE FROM cjaf_notas WHERE idBoletim = '".$idBoletim."'";
			$qry2 = mysql_query($sql2)or die(mysql_error());*/
				
			$i=0;
			while($i < count($idMateria)){
				$result = $conn->prepare("INSERT INTO cjaf_notas (idBoletim,idMateria,ac1,ac2,ac3,media,recuperacao,faltas,media1b,media2b,media3b,media4b,totalPontos,mediaAnual,provaFinal,recProvaFinal,mediaFinal,situacao,ultimaAtualizacao,atualizadoPor) VALUES ('"
						.$idBoletim."','"
						.$idMateria[$i]."','"
						.$ac1[$i]."','"
						.$ac2[$i]."','"
						.$ac3[$i]."','"
						.$media[$i]."','"
						.$recuperacao[$i]."','"
						.$faltas[$i]."','"
						.$media1b[$i]."','"
						.$media2b[$i]."','"
						.$media3b[$i]."','"
						.$media4b[$i]."','"
						.$totalPontos[$i]."','"
						.$mediaAnual[$i]."','"
						.$provaFinal[$i]."','"
						.$recProvaFinal[$i]."','"
						.$mediaFinal[$i]."','"
						.$situacao[$i]."','"
						.date("Y-m-d H:i:s")."','"
						.$_SESSION['nome']."')");
				$result ->execute();
				$i++;
			}
			
			//atualiza a obs
			$result = $conn->prepare("UPDATE cjaf_boletins SET
									obs = '".$boletim->getObs()."',
									confirmado = '".$boletim->getConfirmado()."'
									WHERE id = '".$boletim->getIdBoletim()."'");
			$result ->execute();
			//$qry1 = mysql_query($sql1)or die(mysql_error());
		
			/*calcula a media da etapa ###########################################*/
			$x = 0;
			$soma = 0;
			$qrynotas = $this->listarNotas($boletim->getIdBoletim());
			foreach ($qrynotas as $linha){
				//while($linha = mysql_fetch_array($qrynotas)){
					$mediaBimestre = $linha['media'.$boletim->getEtapa().'b'];
					if($mediaBimestre != ''){
						$soma += $mediaBimestre;
						$x++;
					}
				//}
			}
			$mediaEtapa = $soma / $x;
		
			$result = $conn->prepare("UPDATE cjaf_boletins SET
									mediaEtapa = '".substr($mediaEtapa, 0, 4)."',
									resultadoFinal = '".$boletim->getResultadoFinal()."'
									WHERE id = '".$boletim->getIdBoletim()."'");
			$result ->execute();
			/*calcula a media da etapa ###########################################*/
			
			if($tipo == "a"){
				print "<script> window.alert('Cadastro realizado com sucesso!');
				window.location='../views/formBoletim.php?id=".$boletim->getIdBoletim()."&idaln=".$boletim->getIdAluno()."'; </script>";
			}else{
				print "<script> window.alert('Cadastro realizado com sucesso!');
				window.location='../views/professor/formBoletim.php?id=".$boletim->getIdBoletim()."&idaln=".$boletim->getIdAluno()."'; </script>";
			}
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function editarNota($boletim, $tipo){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("UPDATE cjaf_notas SET 
					ac1 = '".$boletim->getAc1()."',
					ac2 = '".$boletim->getAc2()."',
					ac3 = '".$boletim->getAc3()."',
					media = '".$boletim->getMedia()."',
					recuperacao = '".$boletim->getRecuperacao()."',
					faltas = '".$boletim->getFaltas()."',
					media1b = '".$boletim->getMedia1b()."',
					media2b = '".$boletim->getMedia2b()."',
					media3b = '".$boletim->getMedia3b()."',
					media4b = '".$boletim->getMedia4b()."',
					totalPontos = '".$boletim->getTotalPontos()."',
					mediaAnual = '".$boletim->getMediaAnual()."',
					provaFinal = '".$boletim->getProvaFinal()."',
					recProvaFinal = '".$boletim->getRecProvaFinal()."',
					mediaFinal = '".$boletim->getMediaFinal()."',
					situacao = '".$boletim->getSituacao()."',
					ultimaAtualizacao = '".date("Y-m-d H:i:s")."',
					atualizadoPor = '".$_SESSION['nome']."'
					WHERE id = '".$boletim->getIdNota()."'");
			$result->execute();
			
			$result = $conn->prepare("UPDATE cjaf_boletins SET
								obs = '".$boletim->getObs()."',
								confirmado = '".$boletim->getConfirmado()."'
								WHERE id = '".$boletim->getIdBoletim()."'");
			$result->execute();
			
			$x = 0;
			$soma = 0;
			$qrynotas = $this->listarNotas($boletim->getIdBoletim());
			foreach ($qrynotas as $linha){
			//while($linha = mysql_fetch_array($qrynotas)){
				$mediaBimestre = $linha['media'.$boletim->getEtapa().'b'];
				if($mediaBimestre != ''){
					$soma += $mediaBimestre;
					$x++;
				}
			//}
			}
	
			$mediaEtapa = $soma / $x;
			
			$result = $conn->prepare("UPDATE cjaf_boletins SET
								mediaEtapa = '".substr($mediaEtapa, 0, 3)."',
								resultadoFinal = '".$boletim->getResultadoFinal()."'
								WHERE id = '".$boletim->getIdBoletim()."'");
			$result->execute();
			
			if($tipo == "a"){
				print "<script> window.alert('Cadastro realizado com sucesso!');
								window.location='../views/formBoletim.php?id=".$boletim->getIdBoletim()."&idaln=".$boletim->getIdAluno()."'; </script>";
			}else{
				print "<script> window.alert('Cadastro realizado com sucesso!');
											window.location='../views/professor/formBoletim.php?id=".$boletim->getIdBoletim()."&idaln=".$boletim->getIdAluno()."'; </script>";
			}
		
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}

	function listarNotas($idBoletim){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT NT.* , MAT.id AS idMat, MAT.nome 
									FROM cjaf_notas NT, cjaf_materias MAT 
									WHERE NT.idMateria = MAT.id AND idBoletim = '".$idBoletim."'");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
				
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarNota($idNota){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT NT.* , MAT.id AS idMat, MAT.nome 
									FROM cjaf_notas NT, cjaf_materias MAT 
									WHERE NT.idMateria = MAT.id AND NT.id = '".$idNota."'");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarBoletim($idBoletim){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT * FROM cjaf_boletins WHERE id = '".$idBoletim."'");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarBoletimConfirmado($idBoletim){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT * FROM cjaf_boletins WHERE id = '".$idBoletim."' AND confirmado = '1'");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
				
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function excluir($idBoletim, $idAluno){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("DELETE FROM cjaf_boletins WHERE id = '".$idBoletim."'");
			$result->execute();
			
			$result = $conn->prepare("DELETE FROM cjaf_notas WHERE idBoletim = '".$idBoletim."'");
			$result->execute();
		
			echo 1;exit;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarBoletimPorAluno($idAluno){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT b.serie, b.etapa,b.id,a.nome ,a.id as idaln, b.dataGeracao, b.confirmado
				FROM cjaf_boletins b, cjaf_alunos a
				WHERE b.idAluno = a.id AND b.idAluno = '".$idAluno."'");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarBoletimPorAlunoTurma($idAluno, $turma){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT b.serie, b.etapa,b.id,a.nome ,a.id as idaln, b.dataGeracao, b.confirmado
								FROM cjaf_boletins b, cjaf_alunos a
								WHERE b.idAluno = a.id AND b.idAluno = '".$idAluno."' AND serie='".$turma."'");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarBoletimPorAlunoConfirmado($idAluno){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT b.serie, b.etapa,b.id,a.nome ,a.id as idaln, b.dataGeracao, b.confirmado
					FROM cjaf_boletins b, cjaf_alunos a
					WHERE b.idAluno = a.id AND b.idAluno = '".$idAluno."' AND b.confirmado='1'");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function confirmaBoletim($idAln, $idBol, $val){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("UPDATE cjaf_boletins SET
							confirmado = '".$val."'
							WHERE id = '".$idBol."'");
			$result->execute();
			
			if($idAln){
				if($val == 1)
					print "<script> window.alert('Boletim Confirmado');	window.location='../views/listaBol.php?idaln=".$idAln."'; </script>";
				else 
					print "<script> window.alert('Boletim nao confirmado');	window.location='../views/listaBol.php?idaln=".$idAln."'; </script>";
			}
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarNotasBoletim($materia,$etapa,$turma,$aluno){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT distinct id
									FROM cjaf_boletins
									WHERE idAluno = '".$aluno."' AND serie = '".$turma."' AND etapa = '".$etapa."'");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			$id = $rs[0]['id'];
			
			if($id){
				$result = $conn->prepare("SELECT * 
							FROM cjaf_notas
							WHERE idBoletim = '".$id."' AND idMateria = '".$materia."'");
				$result->execute();
				$rs = $result->fetchAll(PDO::FETCH_ASSOC);
				
				if(count($rs)){
					return $rs;
				}else{
					return 1;
				}
			}else{
				return 0;
			}
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}

	function getBoletimAluno($aluno, $turma, $etapa){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT id
									FROM cjaf_boletins
									WHERE idAluno = '".$aluno."'
									AND serie = '".$turma."'
									AND etapa = '".$etapa."'");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs[0]['id'];
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function verificaBoletimConfirmado($materia,$etapa,$turma,$aluno){
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT distinct id,confirmado
									FROM cjaf_boletins
									WHERE idAluno = '".$aluno."' AND serie = '".$turma."' AND etapa = '".$etapa."'");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs[0]['confirmado'];
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function inserirNotas($idBoletins,$materia,$boletim){
		
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT distinct id,confirmado
					FROM cjaf_boletins
					WHERE idAluno = '".$aluno."' AND serie = '".$turma."' AND etapa = '".$etapa."'");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			$etapa = $boletim->getEtapa();
			$ac1 = $boletim->getAc1();
			$ac2 = $boletim->getAc2();
			$ac3 = $boletim->getAc3();
			$media = $boletim->getMedia();
			$recuperacao = $boletim->getRecuperacao();
			$faltas = $boletim->getFaltas();
			$media1b = $boletim->getMedia1b();
			$media2b = $boletim->getMedia2b();
			$media3b = $boletim->getMedia3b();
			$media4b = $boletim->getMedia4b();
			$totalPontos = $boletim->getTotalPontos();
			$mediaAnual = $boletim->getMediaAnual();
			$provaFinal = $boletim->getProvaFinal();
			$recProvaFinal = $boletim->getRecProvaFinal();
			$mediaFinal = $boletim->getMediaFinal();
			$situacao = $boletim->getSituacao();
			
			for($i=0;$i<count($idBoletins);$i++){
				$result = $conn->prepare("DELETE FROM cjaf_notas 
						WHERE idBoletim = '".$idBoletins[$i]."' 
						AND idMateria = '".$materia."'");
				$result->execute();
				
				$result = $conn->prepare("INSERT INTO cjaf_notas (idBoletim,idMateria,ac1,ac2,ac3,media,recuperacao,faltas,media1b,media2b,media3b,media4b,totalPontos,mediaAnual,provaFinal,recProvaFinal,mediaFinal,situacao,ultimaAtualizacao,atualizadoPor) VALUES ('"
										.$idBoletins[$i]."','"
										.$materia."','"
										.$ac1[$i]."','"
										.$ac2[$i]."','"
										.$ac3[$i]."','"
										.$media[$i]."','"
										.$recuperacao[$i]."','"
										.$faltas[$i]."','"
										.$media1b[$i]."','"
										.$media2b[$i]."','"
										.$media3b[$i]."','"
										.$media4b[$i]."','"
										.$totalPontos[$i]."','"
										.$mediaAnual[$i]."','"
										.$provaFinal[$i]."','"
										.$recProvaFinal[$i]."','"
										.$mediaFinal[$i]."','"
										.$situacao[$i]."','"
										.date("Y-m-d H:i:s")."','"
										.$_SESSION['nome']."')");
				$result->execute();
				
				/*calcula a media da etapa ###########################################*/
				$x = 0;
				$soma = 0;
				$qrynotas = $this->listarNotas($idBoletins[$i]);
				foreach ($qrynotas as $linha){
					//while($linha = mysql_fetch_array($qrynotas)){
					$mediaBimestre = $linha['media'.$etapa.'b'];
					if($mediaBimestre != ''){
						$soma += $mediaBimestre;
						$x++;
					}
					//}
				}
				$mediaEtapa = $soma / $x;
				
				$result = $conn->prepare("UPDATE cjaf_boletins SET
						mediaEtapa = '".substr($mediaEtapa, 0, 4)."',
						resultadoFinal = '".$boletim->getResultadoFinal()."'
						WHERE id = '".$idBoletins[$i]."'");
				$result ->execute();
				/*calcula a media da etapa ###########################################*/
				
				/*calcula a media da etapa
				$x = 0;
				$soma = 0;
				$qrynotas = $this->listarNotas($idBoletins[$i]);
				while($linha = mysql_fetch_array($qrynotas)){
					$mediaBimestre = $linha['media'.$etapa.'b'];
					if($mediaBimestre != ''){
						$soma += $mediaBimestre;
						$x++;
					}
				}
				$mediaEtapa = $soma / $x;
				$sql0 = "UPDATE cjaf_boletins SET
				mediaEtapa = '".substr($mediaEtapa, 0, 4)."',
				resultadoFinal = '".$boletim->getResultadoFinal()."'
				WHERE id = '".$idBoletins[$i]."'";
				$qry0 = mysql_query($sql0)or die(mysql_error());*/
				
			}

			return 1;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function excluirNotas($idBoletins, $materia){
		try
		{
			$conn = Conexao::getInstance();
			$key = array_keys($idBoletins);
	
			for($i=0;$i<count($idBoletins);$i++){
				$result = $conn->prepare("DELETE FROM cjaf_notas
										WHERE idBoletim = '".$idBoletins[$key[$i]]."'
										AND idMateria = '".$materia."'");
				$result->execute();
			}
			
			return 1;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarAtualizacoes(){
		try
		{
			$conn = Conexao::getInstance();
		
			$result = $conn->prepare("SELECT NT.*, ALU.nome,BOL.etapa,TUR.nome as nometur, SE.serie as nomeSerie, TUR.serie
										FROM (((cjaf_notas NT LEFT JOIN cjaf_boletins BOL ON NT.idBoletim = BOL.id) 
											LEFT JOIN cjaf_alunos ALU ON ALU.id = BOL.idAluno) 
											LEFT JOIN cjaf_turmas TUR ON BOL.serie = TUR.idTurma)
											LEFT JOIN cjaf_series SE ON TUR.serie = SE.id
										ORDER BY NT.ultimaAtualizacao DESC
										LIMIT 0 , 30");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
}
