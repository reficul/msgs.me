<?php
include("msg_config.php");

$codice ="";
if (isset($_GET['codice'])) { 
    $codice = $_GET['codice']; 
} 
$con=mysql_connect('localhost',$DB_USER,$DB_PASS) or die("Attenzione! Non riesco a trovare il server");
mysql_select_db($DB_NAME,$con)or die("Attenzione! Non trovo il database");

if ($codice!="") {

  $qResult = mysql_query ("SELECT * FROM msg WHERE codice='". $codice ."' ORDER BY id ASC");
	if ($codice=="ALL")  $qResult = mysql_query ("SELECT * FROM msg ORDER BY id ASC") ;


	$nRows = mysql_num_rows($qResult); 
	$rString ="<msgs>";

	for ($i=0; $i< $nRows; $i++){ 

		$row = mysql_fetch_array($qResult); 
		
		$rString .= "<msg>"
			. "<id>" . $row['id']. "</id>" 
			. "<codice>" . $row['codice'] . "</codice>" 
			. "<messaggio>" . $row['messaggio'] . "</messaggio>" 
		. "</msg>";

	}
	$rString .= "</msgs>";

	echo $rString ;
}
else {

	echo "<msgs></msgs>" ;
}
?>