<?php
	include("../../functions.inc.php");
	
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="report.csv"');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	echo"Name,Number,Cost\n";
	
	require("database.php");
	$sq2 = mysql_query("SELECT Number,Cost FROM SentMessages WHERE LogsID='$id'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		echo FindNameFromNumber($myrow[0]);
		echo",".$myrow[0];
		echo",".$myrow[1]."\n";
	}
?>