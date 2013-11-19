<?php
require_once '../models/db/AuthDAO.php';
$login = $_GET['login'];
$daoAuth = new AuthDAO();
if(!$daoAuth->verificaLoginIgual($login)){
	echo 'loginIgual';exit;
}else{
	echo 'loginUnico';exit;
}
