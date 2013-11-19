<?php
require_once 'Conexao.php';
Class RelatorioDAO
{
	/*function __construct()
	{
		//conecta com o banco de dados
		$con = new Conexao();
		$con->conectaBD();
		$con->selecionaBD();
	}*/
	
	/*todos os alunos por genero*/
	public function TotalPorGenero()
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare('SELECT count(*) as qtd, sexo
									FROM cjaf_alunos 
									GROUP BY sexo');
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
	
	/*todos os alunos por Idade*/
	public function TotalPorIdade()
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare('SELECT count(*) as qtd, dataNascimento
									FROM cjaf_alunos
									GROUP BY DATE_FORMAT(dataNascimento,"%Y-%m")');
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
	
	public function MediaGeral()
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare('SELECT AVG(mediaEtapa) as media, serie
				FROM cjaf_boletins
				WHERE dataGeracao LIKE "'.date('Y').'%"
					AND mediaEtapa != ""
				GROUP BY serie');
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
	
	public function MediaGeralAlunos()
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare('SELECT idAluno, AVG(mediaEtapa)
				FROM cejaf_boletins
				WHERE
				GROUP BY idAluno');
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
	
	public function GeneroPorTurma($idTurma,$ano)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare('SELECT count(*) as qtd, sexo
				FROM cjaf_alunos 
				WHERE 
				GROUP BY sexo');
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
	
}