<?php

include("msg_config.php");

$codice="";
$messaggio="";
$messaggiocompleto="";
$ip="";
$esegui = 0;

$ip = getenv('REMOTE_ADDR');
if (isset($_REQUEST['codice'])) { 
    $codice = $_REQUEST['codice']; 
  $esegui = $esegui+1;
} 
if (isset($_REQUEST['messaggio'])) { 
    $messaggio = $_REQUEST['messaggio'];
	$messaggiocompleto = "<invio>".date('Y-m-d H:i:s')."</invio><ip>".$ip."</ip>".$messaggio;
	$esegui = $esegui+1;
} 


if ($esegui == 2) {
		$con=mysql_connect('localhost',$DB_USER,$DB_PASS) or die("Attenzione! Non riesco a trovare il server");
		mysql_select_db($DB_NAME,$con)or die("Attenzione! Non trovo il database");

		$messaggiocompleto = mysql_real_escape_string($messaggiocompleto); //fix apostrofi e altre schifezze.
		
		$sql ="INSERT INTO msg ( codice, messaggio)  values "  ;		
		$sql .= " ( '" . $codice . "','" . $messaggiocompleto. "') ";
		$qResult = mysql_query ($sql);
		if (!$qResult) {	
			echo "NO" ; //$sql;
			die('Invalid query: ' . mysql_error());
		}
		else echo "OK" ; 
}
else {
	echo "NO" ;
}
?>