    <?php
    require_once '../models/db/Conexao.php';
    require_once '../models/db/AuthDAO.php';
	
	$login = addslashes($_POST['login']);
    $pre = addslashes($_POST['senha']);
    $senha = md5($pre);

    $dao = new AuthDAO();
    $result = $dao->confirma($login, $senha);
	
 //$num = mysql_num_rows($result[1]);
   
    //Verificamos se alguma linha foi afetada, caso sim retornamos suas informações
    if(count($result) > 0){
    	
    	session_start();
		session_register();
		
		$_SESSION['time'] = time();
		$_SESSION['tempoLimite'] = 15 * 60; // segundos
		
  		//while ($linha = mysql_fetch_array($result[1]))
  		//{
			$nome = $result[1]['nome'];
			$id = $result[1]['id'];
			$login = $result[1]['login'];
			$ultimoLogin = $result[1]['ultimoLogin'];
			$matricula = $result[1]['matricula'];//caso o usuario for ALUNO
			$turma = $result[1]['turma'];//caso o usuario for ALUNO
		//}
							
					$_SESSION['id'] = $id;
					$_SESSION['nome'] = $nome;
					$_SESSION['login'] = $login;
					$_SESSION['tipo'] = $result[0];
					$_SESSION['ultimoLogin'] = $ultimoLogin;
					$_SESSION['matricula'] = $matricula; // ALUNO
					$_SESSION['turma'] = $turma; // ALUNO
					
					echo $result[0];exit;
				
 	}else{
	   echo 0;
    }
    ?>
    