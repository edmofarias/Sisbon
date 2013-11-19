<?php 
require_once 'Conexao.php';
class QuestionarioDAO
{
	/*function __construct(){
		//conecta com o banco de dados
		$con = new Conexao();
		$con->conectaBD();
		$con->selecionaBD();
	}*/
	
	function inserir(Questionario $questionario)
	{
		try
			{
				$conn = Conexao::getInstance();
				$result = $conn->prepare("INSERT INTO cjaf_questionario (enunciado,correta,a,b,c,d,materia,serie,pontos) VALUES ('"
					.$questionario->getEnunciado()."','"
					.$questionario->getCorreta()."','"
					.$questionario->getA()."','"
					.$questionario->getB()."','"
					.$questionario->getC()."','"
					.$questionario->getD()."','"
					.$questionario->getMateria()."','"
					.$questionario->getSerie()."','"
					.$questionario->getPontos()."') ");
				$result->execute();
				echo 1;exit;
			}
			catch (PDOException $i)
			{
				Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
			}
	}
	
	function alterar(Questionario $questionario,$id)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("UPDATE cjaf_questionario SET 
				enunciado = '".$questionario->getEnunciado()."'
				,correta = '".$questionario->getCorreta()."'
				,a = '".$questionario->getA()."'
				,b = '".$questionario->getB()."'
				,c = '".$questionario->getC()."'
				,d = '".$questionario->getD()."'
				,materia = '".$questionario->getMateria()."'
				,serie = '".$questionario->getSerie()."'
				,pontos = '".$questionario->getPontos()."'
				WHERE id = '".$id."'");
			$result->execute();
		
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
			$result = $conn->prepare("DELETE FROM cjaf_questionario WHERE id = '".$id."' ");
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
			$result = $conn->prepare("SELECT * FROM cjaf_questionario");
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
			$result = $conn->prepare("SELECT * FROM cjaf_questionario WHERE id='".$id."' ");
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