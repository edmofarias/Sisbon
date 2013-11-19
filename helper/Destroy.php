<?php
    //Inicia a sessão
    
	session_start();
	 session_register();
    //Elimina os dados da sessão
    unset($_SESSION['id']);
    unset($_SESSION['nome']);
    unset($_SESSION['login']);
	     
    //Encerra a sessão
    session_destroy();
   	 header("Location: ../login.php");
    ?>