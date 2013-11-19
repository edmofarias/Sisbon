<?php 
require_once 'Conexao.php';
class TurmaDAO
{
	
	function inserir($turma)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("INSERT INTO cjaf_turmas (nome,serie,turno) VALUES ('"
									.$turma->getNome()."','"
									.$turma->getSerie()."','"
									.$turma->getTurno()."')");
			$result ->execute();
			
			$id = $conn->lastInsertId();
				
			$materia = $turma->getMaterias();
			$countMat = count($materia);
				
			$i = 0;
			while ($i < $countMat)
			{
				$result = $conn->prepare("INSERT INTO cjaf_turma_materias (turma,materia) VALUES ('"
						.$id."','"
						.$materia[$i]."')");
				$result->execute();
				$i++;
			}
			
			$conn = null;
			echo 1;exit;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function alterar($turma,$id)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("UPDATE cjaf_turmas SET 
									nome = '".$turma->getNome()."',
									serie = '".$turma->getSerie()."',
									turno = '".$turma->getTurno()."'
									WHERE idTurma = '".$id."'");
			$result ->execute();
		
			$result = $conn->prepare("DELETE FROM cjaf_turma_materias WHERE turma = '".$id."'");
			$result->execute();
			
			$materias = $turma->getMaterias();
			$i = 0;
			while($i < count($materias)){
				$result = $conn->prepare("INSERT INTO cjaf_turma_materias (turma, materia) VALUES ('"
						.$id."','"
						.$materias[$i]."')");
				$result->execute();
				$i++;
			}
			
			$conn = null;
			echo 1;exit;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function excluir($id)
	{	
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("DELETE FROM cjaf_turmas WHERE idTurma = '".$id."' ");
			$result->execute();
			
			$result = $conn->prepare("DELETE FROM cjaf_turma_materias WHERE turma = '".$id."' ");
			$result->execute();
			
			echo 1;exit;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listar()
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare('SELECT SE.serie as nomeSerie, T.*
									FROM cjaf_turmas T LEFT JOIN cjaf_series SE ON T.serie = SE.id');
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
				
			$conn = null;
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarPorID($id)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare('SELECT SE.serie as nomeSerie, T.*
									FROM cjaf_turmas T LEFT JOIN cjaf_series SE ON T.serie = SE.id
									WHERE idTurma = "'.$id.'"');
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			$conn = null;
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarAlunos($idTurma)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT A.nome, A.foto, A.id AS idAluno, A.matricula, T.nome AS nomeTurma, SE.serie , T.turno, T.serie as idSerie
				FROM ((cjaf_alunos A LEFT JOIN cjaf_turmas_alunos TA ON A.id = TA.idAluno)
						LEFT JOIN cjaf_turmas T ON T.idTurma = TA.idTurma)
						LEFT JOIN cjaf_series SE ON T.serie = SE.id
				WHERE TA.idTurma = '".$idTurma."' AND TA.status = 1");
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			$conn = null;
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarTurma($idTurma)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT * FROM cjaf_turmas WHERE idTurma = '".$idTurma."'");
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			$conn = null;
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function getQtdAlunos($id)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare('SELECT COUNT(*) as qtd FROM cjaf_turmas_alunos WHERE idTurma = "'.$id.'" AND status != 0');
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			$conn = null;
			return $rs[0]['qtd'];
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarSeries()
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT * FROM cjaf_series");
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			$conn = null;
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarBoletins($idTurma,$etapa,$serie)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT B.*, A.nome,A.matricula
								FROM cjaf_boletins B LEFT JOIN cjaf_turmas_alunos TA ON B.idAluno = TA.idAluno
									 LEFT JOIN cjaf_alunos A ON B.idAluno = A.id
								WHERE TA.status = 1 
									AND TA.idTurma = '".$idTurma."'
									AND B.etapa = '".$etapa."'
									AND B.serie = '".$idTurma."'
								ORDER BY B.mediaEtapa DESC, A.nome ASC");
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
	
			$conn = null;
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarMaterias($idTurma)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare('SELECT MAT.*
					FROM cjaf_materias MAT, cjaf_turma_materias TMT
					WHERE MAT.id = TMT.materia
					AND TMT.turma = "'.$idTurma.'"');
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

?>