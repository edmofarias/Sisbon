<?php 
/**
 * Colocar no arquivo html
  <script type="text/javascript">
    $(document).ready(function() {
      $('#tabela').dataTable( {
        "aaSorting": [[ 5, "DESC" ]],
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "[caminho deste arquivo]/lista.php"
      } );
    } );
  </script>
*/

  
 /* Array of database columns which should be read and sent back to DataTables.
 * Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
  $aColumns =
  array('id','nome');
  
  //{{{ Indexed column (used for fast and accurate table cardinality) 
  $sIndexColumn = "id";
  //}}}
  //{{{ DB table to use 
  $sTable = "cjaf_materias";
  //}}}
  //{{{ Database connection information 

   include 'con.php';
  
  //}}}
  //{{{ MySQL connection
  $gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or die( 'Could not open connection to server' );
  mysql_select_db( $gaSql['db'], $gaSql['link'] ) or die( 'Could not select database '. $gaSql['db'] );
  //}}}
  
  //{{{ Paging
  $sLimit = " LIMIT 0,10 ";
  if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
  {
    $sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".mysql_real_escape_string( $_GET['iDisplayLength'] );
  }
  //}}}
  //{{{Ordering
  if ( isset( $_GET['iSortCol_0'] ) )
  {
    $sOrder = "ORDER BY  ";
    for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
    {
      if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
      {
        $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
      }
    }
    
    $sOrder = substr_replace( $sOrder, "", -2 );
    if ( $sOrder == "ORDER BY" )
    {
      $sOrder = "";
    }
  }
  //$sOrder = "ORDER BY numero DESC ";
  //}}}
 /* {{{ Filtering 
 *   * NOTE this does not match the built-in DataTables filtering which does
 *     it
 *   * word by word on any field. It's possible to do here, but concerned
 *     about efficiency
 *   * on very large tables, and MySQL's regex functionality is very
 *     limited
 */
  $sWhere = "";
  if ( $_GET['sSearch'] != "" )
  {
    $sWhere = "WHERE (";
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
      $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string(
$_GET['sSearch'] )."%' OR ";
    }
    $sWhere = substr_replace( $sWhere, "", -3 );
    $sWhere .= ')';
  }
  
  /* Individual column filtering */
  for ( $i=0 ; $i<count($aColumns) ; $i++ )
  {
    if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
    {
      if ( $sWhere == "" )
      {
        $sWhere = "WHERE ";
      }
      else
      {
        $sWhere .= " AND ";
      }
      $sWhere .= $aColumns[$i]." LIKE'%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
    }
  }
  //}}}
  
 // {{{ SQL queries Get data to display
  $sQuery = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ",$aColumns))." FROM $sTable $sWhere $sOrder $sLimit";
  //echo $sQuery; exit;
  $rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
  
  // {{{ Data set length after filtering 
  $sQuery = "SELECT FOUND_ROWS()";
  $rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
  $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
  $iFilteredTotal = $aResultFilterTotal[0];
  //}}} 
  //{{{ Total data set length
  
  $sQuery = "
    SELECT COUNT(".$sIndexColumn.")
    FROM   $sTable
  ";
  //}}}
  $rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
  $aResultTotal = mysql_fetch_array($rResultTotal);
  $iTotal = $aResultTotal[0];
  //}}}
  
//{{{ Output
  $sOutput = '{';
  $sOutput .= '"sEcho": '.intval($_GET['sEcho']).', ';
  $sOutput .= '"iTotalRecords": '.$iTotal.', ';
  $sOutput .= '"iTotalDisplayRecords": '.$iFilteredTotal.', ';
  $sOutput .= '"aaData": [ ';
  
  while ( $aRow = mysql_fetch_array( $rResult ) )
  {
  //print_r($aRow);
    $arrOutput = array();
    $sOutput .= "[";
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
      if ( $aColumns[$i] == "version" )
      {
        /* Special output formatting for 'version' */
        $sOutput .= ($aRow[ $aColumns[$i] ]=="0") ?
          '"-",' :
          '"'.str_replace('"', '\"', $aRow[ $aColumns[$i] ]).'",';
      }
      else if ( $aColumns[$i] != ' ' )
      {
      	if($aColumns[$i] == 'id'){
      		$valor = '<center>'.$aRow[$aColumns[$i]].'</center>';
      	}else{
        	$valor = $aRow[$aColumns[$i]];
      	}
        array_push($arrOutput,utf8_encode(utf8_decode($valor)));
      }
    }
    
       
    $iEditar = '<a title="Editar" href="formDisciplina.php?id='.$aRow[$aColumns[0]].'" ><img src="imagens/edit_1.png" /></a>';
    //$iRemover = '<a title="Excluir" href="javascript:excluir('.$aRow[$aColumns[0]].') "><img src="imagens/delete_1.png" /></a>';
    $iRemover = '<a title="Excluir" id="excluir_'.$aRow[$aColumns[0]].'" href="#null" resposta="listaDisciplina.php" titulo="Excluir Registro" caixa="dialog_excluir" action="../controllers/materia.php" onclick="excluirCadastro(\'excluir_'.$aRow[$aColumns[0]].'\',\''.$aRow[$aColumns[0]].'\')"><img src="imagens/delete_1.png" /></a>';
    //$sOutput .= '"'.str_replace('"', '\"',''.$iEditar.' '.$iRemover.'').'",';
    
    array_push($arrOutput, '<center>'.$iEditar.' '.$iRemover.'</center>');
    
    $testeArr[] = $arrOutput;
    //$sOutput = substr_replace( $sOutput, "", -1 );
    //$sOutput .= "],";
    
    
  }
  $sOutput = substr_replace( $sOutput, "", -1 );
  $sOutput .= '] }';
  
  $aaData = array('sEcho'=>intval($_GET['sEcho']),'iTotalRecords'=>intval($iTotal),'iTotalDisplayRecords'=>intval($iFilteredTotal),'aaData'=>$testeArr);

	


  $json = json_encode($aaData);
  echo $json;
  //echo $sOutput;exit;
// }}}

?>

