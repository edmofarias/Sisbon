<?php 
require_once 'Conexao.php';
Class AuthDAO{
	
	function confirma($login, $senha)
	{
		try
		{
			$conn = Conexao::getInstance();
			$result = $conn->prepare("SELECT * FROM cjaf_admins WHERE login = '".$login."' AND senha = '".$senha."' ");
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			
			if (count($rs) > 0)
			{
				$array[0] = $auth = "ADMIN";
				$array[1] = $rs[0];
				
				$result = $conn->prepare("UPDATE cjaf_admins SET ultimoLogin = '".date('Y-m-d H:i:s')."' WHERE login ='".$login."'");
				$result ->execute();
				
				return $array;
			}
			else
			{
				$result = $conn->prepare("SELECT * FROM cjaf_professores WHERE login = '".$login."' AND senha = '".$senha."' ");
				$result ->execute();
				$rs = $result->fetchAll(PDO::FETCH_ASSOC);
				
				if (count($rs) > 0)
				{
					$array[0] = $auth = "PROFESSOR";
					$array[1] = $rs[0];
				
					$result = $conn->prepare("UPDATE cjaf_professores SET ultimoLogin = '".date('Y-m-d H:i:s')."' WHERE login ='".$login."'");
					$result ->execute();
				
					return $array;
				}else{
					
					$result = $conn->prepare("SELECT * FROM cjaf_alunos WHERE login = '".$login."' AND senha = '".$senha."' ");
					$result->execute();
					$rs = $result->fetchAll(PDO::FETCH_ASSOC);
					
					if(count($rs)>0){
						$array[0] = $auth = "ALUNO";
						$array[1] = $rs[0];
						
						$result = $conn->prepare("UPDATE cjaf_alunos SET ultimoLogin = '".date('Y-m-d H:i:s')."' WHERE login ='".$login."'");
						$result ->execute();
						
						return $array;
					}
					
				}
				
			}
			return 0;
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	/*function confirma($login, $senha)
	{
		$sql = "SELECT * FROM cjaf_admins WHERE login = '".$login."' AND senha = '".$senha."' ";
		$qry = mysql_query($sql) or die(mysql_error());
		$count = mysql_num_rows($qry);

		if ($count>0)
		{
			$result[0] = $auth = "ADMIN";
			$result[1] = $qry;
			
			
			$sql = "UPDATE cjaf_admins SET ultimoLogin = '".date('Y-m-d H:i:s')."' WHERE login ='".$login."'";
			$qry = mysql_query($sql) or die(mysql_error());
			
			return $result;
		}else{
			
			$sql = "SELECT * FROM cjaf_professores WHERE login = '".$login."' AND senha = '".$senha."' ";
			$qry = mysql_query($sql) or die(mysql_error());
			$count = mysql_num_rows($qry);
			
			if ($count>0)
			{
				$result[0] = $auth = "PROFESSOR";
				$result[1] = $qry;
				
				$sql = "UPDATE cjaf_professores SET ultimoLogin = '".date('Y-m-d H:i:s')."' WHERE login ='".$login."'";
				$qry = mysql_query($sql) or die(mysql_error());
				
				return $result;
			}else{

				$sql = "SELECT * FROM cjaf_alunos WHERE login = '".$login."' AND senha = '".$senha."' ";
				$qry = mysql_query($sql) or die(mysql_error());
												
					$result[0] = $auth = "ALUNO";
					$result[1] = $qry;
					
					$sql = "UPDATE cjaf_alunos SET ultimoLogin = '".date('Y-m-d H:i:s')."' WHERE login ='".$login."'";
					$qry = mysql_query($sql) or die(mysql_error());
					
					return $result;
			}
		}
	}*/
	
	
	/**
	 * Verifica se ja existe o login digitado
	 * @param String $login
	 * @return boolean
	 */
	function verificaLoginIgual($login)
	{
		try
		{
			$conn = Conexao::getInstance();
			
			$result = $conn->prepare("SELECT count(*) as total FROM cjaf_alunos WHERE login = '".$login."'");
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			$qtd = $rs[0]['total'];
			
			$result = $conn->prepare("SELECT count(*) as total FROM cjaf_professores WHERE login = '".$login."'");
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			$qtd = $rs[0]['total'];
			
			$result = $conn->prepare("SELECT count(*) as total FROM cjaf_admins WHERE login = '".$login."'");
			$result ->execute();
			$rs = $result->fetchAll(PDO::FETCH_ASSOC);
			$qtd = $rs[0]['total'];
			
			if($qtd >= 1 || $qtd1 >= 1 || $qtd2 >= 1){
				return false;
			}else{
				return true;
			}
		}
		catch (PDOException $i)
		{
			Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}
	
	/**
	 * Verifica se ja existe o login digitado
	 * @param String $login
	 * @return boolean
	 */
	/*function verificaLoginIgual($login) {
		$sql = "SELECT count(*) as total FROM cjaf_alunos WHERE login = '".$login."'";
		$qry = mysql_query($sql) or die(mysql_error());
		while($total = mysql_fetch_array($qry)){
			$qtd = $total['total'];
		}
		
		$sql1 = "SELECT count(*) as total FROM cjaf_professores WHERE login = '".$login."'";
		$qry1 = mysql_query($sql1) or die(mysql_error());
		while($total1 = mysql_fetch_array($qry1)){
			$qtd1 = $total1['total'];
		}
		
		$sql2 = "SELECT count(*) as total FROM cjaf_admins WHERE login = '".$login."'";
		$qry2 = mysql_query($sql2) or die(mysql_error());
		while($total2 = mysql_fetch_array($qry2)){
			$qtd2 = $total2['total'];
		}
		
		if($qtd >= 1 or $qtd1 >= 1 or $qtd2 >= 1){
			return false;
		}else{
			return true;
		}
	}*/

}

?>