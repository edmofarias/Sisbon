<?php 
require_once 'Conexao.php';
class AdminDAO
{
	
	/*function __construct(){
	//conecta com o banco de dados
	$con = new Conexao();
	$con->conectaBD();
	$con->selecionaBD();
	}*/
	
	function inserir($admin)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("INSERT INTO cjaf_admins (nome,login,telefone,email,sexo,senha) VALUES ('"
										.$admin->getNome()."','"
										.$admin->getLogin()."','"
										.$admin->getTelefone()."','"
										.$admin->getEmail()."','"
										.$admin->getSexo()."','"
										.$admin->getSenha()."')");
			$result ->execute();
			echo 1;exit;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	/*function inserir($admin)
	{
			
			$sql = "INSERT INTO cjaf_admins (nome,login,telefone,email,sexo,senha) VALUES ('"
			
			.$admin->getNome()."','"
			.$admin->getLogin()."','"
			.$admin->getTelefone()."','"
			.$admin->getEmail()."','"
			.$admin->getSexo()."','"
			.$admin->getSenha()."' )";
			
			$qry = mysql_query($sql) or die(mysql_error());
			
			echo 1;exit;
	}*/
	
	function alterar($admin,$id)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("UPDATE cjaf_admins SET 
									nome = '".$admin->getNome()."'
									,login = '".$admin->getLogin()."'
									,senha = '".$admin->getSenha()."'
									,telefone = '".$admin->getTelefone()."'
									,email = '".$admin->getEmail()."'
									,sexo = '".$admin->getSexo()."'
									WHERE id = '".$id."'");
			$result ->execute();
			echo 1;exit;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	/*function alterar($admin,$id)
	{
			$sql = "UPDATE cjaf_admins SET 
			nome = '".$admin->getNome()."'
			,login = '".$admin->getLogin()."'
			,senha = '".$admin->getSenha()."'
			,telefone = '".$admin->getTelefone()."'
			,email = '".$admin->getEmail()."'
			,sexo = '".$admin->getSexo()."'
			WHERE id = '".$id."'";
			
			$qry = mysql_query($sql)or die(mysql_error());
			
			echo 1;exit;
	}*/
	
	function excluir($id)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("DELETE FROM cjaf_admins WHERE id = '".$id."' ");
			$result ->execute();
			echo 1;exit;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	/*function excluir($id)
	{
			$sql = "DELETE FROM cjaf_admins WHERE id = '".$id."' ";
			$qry = mysql_query($sql) or die(mysql_error());
			if($qry){
				echo 1;exit;
			}else{
				echo 0;exit;
			}
	}*/
	
	function listar()
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT * FROM cjaf_admins");
			$result ->execute();
			
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	/*function listar()
	{
			$sql = "SELECT * FROM cjaf_admins";
			$qry = mysql_query($sql)or die(mysql_error());
				
			return $qry;
	}*/
	
	function listarPorID($id)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT * FROM cjaf_admins WHERE id = '".$id."' ");
			$result ->execute();
				
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	/*function listarPorID($id)
	{
		$sql = "SELECT * FROM cjaf_admins WHERE id = '".$id."' ";
		$qry = mysql_query($sql)or die(mysql_error());
	
		return $qry;
	}*/
}

?>