<?php

require_once 'Conexao.php';

Class QuestoesDAO 
{

	function salvar($questao)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("INSERT INTO cjaf_questoes (nome,a,b,c,d,e,pontos,materia,serie,correta) VALUES ('"
									.$questao['nome']."','"
									.$questao['a']."','"
									.$questao['b']."','"
									.$questao['c']."','"
									.$questao['d']."','"
									.$questao['e']."','"
									.$questao['pontuacao']."','"
									.$questao['materia']."','"
									.$questao['serie']."','"
									.$questao['correta']."')");
			$result ->execute();
				
			$conn = null;
			return 1;
		}
		catch (Exception $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}

	function listar()
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT * FROM cjaf_questoes");
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
	
	function excluir($id)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("DELETE FROM cjaf_questoes WHERE id = '".$id."'");
			$result ->execute();
			
			$conn = null;
			echo 1;exit;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function getPaises()
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT * FROM paises ORDER BY Portugues");
			$result ->execute();
			
			$conn = null;
			return $result;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function getNomePais($id)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT * FROM paises WHERE id = '".$id."'");
			$result ->execute();
			$rsPais = $result->fetchAll(PDO::FETCH_ASSOC);
			$conn = null;
			return $rsPais;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
}
?>