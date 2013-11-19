<?php 
require_once 'Conexao.php';
class ProfessorDAO
{
	/*function __construct(){
		//conecta com o banco de dados
		$con = new Conexao();
		$con->conectaBD();
		$con->selecionaBD();
	}*/
	
	function inserir(Professor $professor)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("INSERT INTO cjaf_professores (nome,sexo,dataNascimento,telefone,email,login,senha,cep,endereco,numRes,bairro,cidade,estado,complemento) VALUES ('"
									.$professor->getNome()."','"
									.$professor->getSexo()."','"
									.$professor->getDataNascimento()."','"
									.$professor->getTelefone()."','"
									.$professor->getEmail()."','"
									.$professor->getLogin()."','"
									.$professor->getSenha()."','"
									.$professor->getCep()."','"
									.$professor->getRua()."','"
									.$professor->getNumRes()."','"
									.$professor->getBairro()."','"
									.$professor->getCidade()."','"
									.$professor->getEstado()."','"
									.$professor->getComplemento()."')");
			$result->execute();
			
			$id = $conn->lastInsertId();
			
			$materia = $professor->getMaterias();
			$turma = $professor->getTurmas();
			$countMat = count($materia);
			$countTur = count($turma);
			
			$i = 0;
			while ($i < $countMat)
			{
				$result = $conn->prepare("INSERT INTO cjaf_professores_materias (idProfessor,idMateria) VALUES ('"
										.$id."','"
										.$materia[$i]."')");
				$result->execute();
				$i++;
			}
			
			$i = 0;
			while ($i < $countTur)
			{
				$result = $conn->prepare( "INSERT INTO cjaf_turmas_professores (idProfessor,idTurma) VALUES ('"
										.$id."','"
										.$turma[$i]."')");
				$result->execute();
					
				$i++;
			}
				
			echo 1;exit;
			
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function alterar($professor,$id)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("UPDATE cjaf_professores SET 
										nome = '".$professor->getNome()."'
										,email = '".$professor->getEmail()."'
										,login = '".$professor->getLogin()."'
										,senha = '".$professor->getSenha()."'
										,telefone = '".$professor->getTelefone()."'
										,sexo = '".$professor->getSexo()."'
										,dataNascimento = '".$professor->getDataNascimento()."'
										,cep = '".$professor->getCep()."'
										,endereco = '".$professor->getRua()."'
										,numRes = '".$professor->getNumRes()."'
										,complemento = '".$professor->getComplemento()."'
										,bairro = '".$professor->getBairro()."'
										,cidade = '".$professor->getCidade()."'
										,estado = '".$professor->getEstado()."'
										WHERE id = '".$id."'");
			$result->execute();
		
			$result = $conn->prepare("DELETE FROM cjaf_professores_materias WHERE idProfessor = '".$id."'");
			$result->execute();
			
			$materias = $professor->getMaterias();
			$i = 0;
			while($i < count($materias)){
				$result = $conn->prepare("INSERT INTO cjaf_professores_materias (idProfessor, idMateria) VALUES ('"
						.$id."','"
						.$materias[$i]."')");
				$result->execute();
				$i++;
			}
			
			$result = $conn->prepare("DELETE FROM cjaf_turmas_professores WHERE idProfessor = '".$id."'");
			$result->execute();
				
			$turmas = $professor->getTurmas();
			$i = 0;
			while($i < count($turmas)){
				$result = $conn->prepare("INSERT INTO cjaf_turmas_professores (idProfessor, idTurma) VALUES ('"
										.$id."','"
										.$turmas[$i]."')");
				$result->execute();
				$i++;
			}
	
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
			$result = $conn->prepare("DELETE FROM cjaf_turmas_professores WHERE idProfessor = '".$id."' ");
			$result->execute();
			
			$result = $conn->prepare("DELETE FROM cjaf_professores_materias WHERE idProfessor = '".$id."' ");
			$result->execute();
			
			$result = $conn->prepare("DELETE FROM cjaf_professores WHERE id = '".$id."' ");
			$result->execute();
		
			echo 1; exit;
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
			$result = $conn->prepare("SELECT * FROM cjaf_professores");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			
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
			$result = $conn->prepare("SELECT * FROM cjaf_professores WHERE id='".$id."' ");
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
				
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarMaterias($idPro)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare('SELECT MAT.*
									FROM cjaf_materias MAT, cjaf_professores_materias PMT
									WHERE MAT.id = PMT.idMateria
									AND PMT.idProfessor = "'.$idPro.'"');
			$result->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function listarTurmas($idPro)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare('SELECT TUR.*, SE.serie AS nomeSerie
				FROM (cjaf_turmas TUR LEFT JOIN cjaf_turmas_professores TPR ON TUR.idTurma = TPR.idTurma)
					LEFT JOIN cjaf_series SE ON TUR.serie = SE.id
				WHERE TPR.idProfessor = "'.$idPro.'"');
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