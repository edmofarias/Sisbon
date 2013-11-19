<?php
$abraArq = fopen("../helper/uploads/".$nome_final, "r");
if (!$abraArq){
	echo ('<p>Arquivo não encontrado</p>');
}else{
	$valores = fgetcsv ($abraArq, 2048, ";");
	print_r($valores);exit;
	// Caso abra faça isso agora
	/* usando a nova função do php 5 fgetcsv() o 2048
	é apenas para colocar o número máximo de
	caracteres por linha.
	// crie uma variável chamada $valores o que vai corresponder
	pelos valores das colunas para serem inseridas.*/
	while ($valores = fgetcsv ($abraArq, 2048, ";")) {
				$valores[1] . "”,”".$valores[2]."”,”".$valores[3]."”,”".$valores[4]."”,”".$valores[5]."”)";
	}

}
fclose($abraArq);