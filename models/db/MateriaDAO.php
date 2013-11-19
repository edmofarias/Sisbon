<?php 
require_once 'Conexao.php';
class MateriaDAO
{
	/*function __construct(){
		//conecta com o banco de dados
		$con = new Conexao();
		$con->conectaBD();
		$con->selecionaBD();
	}*/
	
	function inserir($materia)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare( "INSERT INTO cjaf_materias (nome) VALUES ('"
										.$materia->getNome()."')");
			$result->execute();
				
			echo 1; exit;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	function alterar($materia,$id)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("UPDATE cjaf_materias SET 
									nome = '".$materia->getNome()."'
									WHERE id = '".$id."'");
			$result->execute();
		
			echo 1; exit;
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
			$result = $conn->prepare("DELETE FROM cjaf_professores_materias  WHERE idMateria = '".$id."' ");
			$result->execute();
			
			$result = $conn->prepare("DELETE FROM cjaf_materias WHERE id = '".$id."' ");
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
			$result = $conn->prepare("SELECT * FROM cjaf_materias ORDER BY nome ASC");
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
			$result = $conn->prepare("SELECT * FROM cjaf_materias WHERE id = '".$id."'");
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