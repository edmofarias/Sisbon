<?php 
require_once 'Conexao.php';
class AlunoDAO
{

	function inserir(Aluno $aluno)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("INSERT INTO cjaf_alunos (nome,sexo,dataNascimento,responsavel,matricula,login,turma,telefone,telefoneResp,email,emailResp,senha,cep,endereco,numRes,bairro,cidade,estado,complemento,foto) VALUES ('"
									.$aluno->getNome()."','"
									.$aluno->getSexo()."','"
									.$aluno->getDataNascimento()."','"
									.$aluno->getResponsavel()."','"
									.$aluno->getMatricula()."','"
									.$aluno->getLogin()."','"
									.$aluno->getTurma()."','"
									.$aluno->getTelefone()."','"
									.$aluno->getTelefoneResp()."','"
									.$aluno->getEmail()."','"
									.$aluno->getEmailResp()."','"
									.$aluno->getSenha()."','"
									.$aluno->getCep()."','"
									.$aluno->getRua()."','"
									.$aluno->getNumRes()."','"
									.$aluno->getBairro()."','"
									.$aluno->getCidade()."','"
									.$aluno->getEstado()."','"
									.$aluno->getComplemento()."','"
									.$aluno->getFoto()."')");
			$result ->execute();
			$id = $conn->lastInsertId();
			
			$result = $conn->prepare("INSERT INTO cjaf_turmas_alunos (idTurma, idAluno, status,ano) VALUES ('"
									.$aluno->getTurma()."','"
									.$id."','"
									.$aluno->getStatus()."','"
									.$aluno->getAno()."')");
			$result ->execute();
			
			return $id;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}

	function alterar(Aluno $aluno,$id)
	{
		try
		{
			$foto = "";
			if($aluno->getFoto()){
				$foto = ", foto = '".$aluno->getFoto()."'";
			}
			
			$conn = Conexao::getInstance();
			
			$result = $conn->prepare("UPDATE cjaf_alunos SET
					nome = '".$aluno->getNome()."',
					sexo = '".$aluno->getSexo()."',
					dataNascimento = '".$aluno->getDataNascimento()."',
					responsavel = '".$aluno->getResponsavel()."',
					matricula = '".$aluno->getMatricula()."',
					login = '".$aluno->getLogin()."',
					senha = '".$aluno->getSenha()."',
					telefone = '".$aluno->getTelefone()."',
					telefoneResp = '".$aluno->getTelefoneResp()."',
					email = '".$aluno->getEmail()."',
					emailResp = '".$aluno->getEmailResp()."',
					cep = '".$aluno->getCep()."',
					endereco = '".$aluno->getRua()."',
					numRes = '".$aluno->getNumRes()."',
					complemento = '".$aluno->getComplemento()."',
					bairro = '".$aluno->getBairro()."',
					cidade = '".$aluno->getCidade()."',
					estado = '".$aluno->getEstado()."'".
					$foto."
					WHERE id = '".$id."'");
			$result ->execute();
			
			if($aluno->getTurma()){
				
				$result = $conn->prepare("UPDATE cjaf_turmas_alunos SET
										status = '0'
										WHERE idAluno = '".$id."'");
				$result ->execute();
				
				$result = $conn->prepare("UPDATE cjaf_alunos SET
						turma = '".$aluno->getTurma()."'
						WHERE id = '".$id."'");
				$result ->execute();
				
				$result = $conn->prepare("INSERT INTO cjaf_turmas_alunos (idTurma, idAluno, status,ano) VALUES ('"
										.$aluno->getTurma()."','"
										.$id."','"
										.$aluno->getStatus()."','"
										.$aluno->getAno()."')");
				$result ->execute();
			}else{
				$result = $conn->prepare("UPDATE cjaf_turmas_alunos SET
						status = '".$aluno->getStatus()."',
						ano = '".$aluno->getAno()."'
						WHERE idAluno = '".$id."' 
						  AND idTurma = '".$aluno->getTurmaEscolhida()."'");
				$result ->execute();
			}
			
			return $id;
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
			$result = $conn->prepare("DELETE FROM cjaf_alunos WHERE id = '".$id."' ");
			$result ->execute();
			
			$result = $conn->prepare("DELETE FROM cjaf_turmas_alunos WHERE idAluno = '".$id."' ");
			$result ->execute();
			
			return 1;
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
			$result = $conn->prepare("SELECT DISTINCT ALU.*, tal.ano, tal.status, SE.serie, TUR.idTurma, TUR.serie as idSerie, TUR.nome AS nomeTurma 
					FROM ((cjaf_alunos alu LEFT JOIN cjaf_turmas_alunos tal ON alu.id = tal.idAluno) 
						LEFT JOIN cjaf_turmas tur ON tur.idTurma = tal.idTurma)
						LEFT JOIN cjaf_series SE ON TUR.serie = SE.id
					WHERE tal.status = 1");
			$result ->execute();
				
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
			$result = $conn->prepare("SELECT DISTINCT ALU.*, SE.serie, tal.ano, tal.status, TUR.idTurma, TUR.serie as idSerie, TUR.nome AS nomeTurma
									FROM ((cjaf_alunos ALU LEFT JOIN cjaf_turmas_alunos tal ON ALU.id = tal.idAluno) 
										LEFT JOIN cjaf_turmas TUR ON TUR.idTurma = tal.idTurma)
										LEFT JOIN cjaf_series SE ON TUR.serie = SE.id
									WHERE ALU.id = '".$id."'
									ORDER BY tal.status DESC");
			$result ->execute();
	
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