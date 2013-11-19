<?php
Class Funcao{
	
	function __construct(){
		
	}
	
	public function addMes($date,$meses)
	{
		$thisyear = substr ( $date, 0, 4 );
		$thismonth = substr ( $date, 5, 2 );
		$thisday =  substr ( $date, 8, 2 );
		$nextdate = mktime(0, 0, 0, ($thismonth + $meses), $thisday, $thisyear);
		return strftime("%Y-%m-%d", $nextdate);
	}
	
	public function addDia($date,$dias)
	{
	     $thisyear = substr ( $date, 0, 4 );
	     $thismonth = substr ( $date, 5, 2 );
	     $thisday =  substr ( $date, 8, 2 );
	     $nextdate = mktime ( 0, 0, 0, $thismonth, $thisday + $dias, $thisyear );
	     return strftime("%Y-%m-%d", $nextdate);
	}
	
	public function subDia($date,$dias) 
	{
	     $thisyear = substr ( $date, 0, 4 );
	     $thismonth = substr ( $date, 5, 2 );
	     $thisday =  substr ( $date, 8, 2 );
	     $nextdate = mktime ( 0, 0, 0, $thismonth, $thisday - $dias, $thisyear );
	     return strftime("%Y-%m-%d", $nextdate);
	}
	
	function diffDate($d1, $d2, $type='', $sep='-')
	{
		 $d1 = explode($sep, $d1);
		 $d2 = explode($sep, $d2);
		 switch ($type)
		 {
			 case 'A':
			 	$X = 31536000;
			 break;
			 case 'M':
			 	$X = 2592000;
			 break;
			 case 'D':
			 	$X = 86400;
			 break;
			 case 'H':
			 	$X = 3600;
			 break;
			 case 'MI':
			 	$X = 60;
			 break;
			 default:
			 	$X = 1;
		 }
		 return floor( ( ( mktime(0, 0, 0, $d2[1], $d2[2], $d2[0]) - mktime(0, 0, 0, $d1[1], $d1[2], $d1[0] ) ) / $X ) );
	}
	
	public function dateFormat($date)
	{
		if($date)
		{
			$d = explode('-', $date);
			$data = $d[2].'/'.$d[1].'/'.$d[0];
		}
		return $data;
	}
	
	public function dateFormatBd($date)
	{
		if($date)
		{
			$d = explode('/', $date);
			$data = $d[2].'-'.$d[1].'-'.$d[0];
		}
		return $data;
	}
	
	public function dateTimeFormat($date)
	{
		if($date)
		{
			$part = explode(' ', $date);
	      	$data = explode('-', $part[0]);
	      	$valor = $data[2].'/'.$data[1].'/'.$data[0].' '.$part[1];
		}
      	return $valor;
	}
	
}