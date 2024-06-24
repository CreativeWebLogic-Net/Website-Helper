<?php
	session_start();
	if(!$_SESSION['SecureKey']){
		header("Location: ../../index.php");
	};
	include("../../DB_Class.php");
	$r=new ReturnRecord();								
	$sql = $r->RawQuery("SELECT FileName,MimeType,Body from Attachments where id='$_GET[id]'");
	while ($myrow = mysql_fetch_row($sql)) {
	
		header("Content-Type: " . $myrow[1]);
		header("Content-Disposition: attachment; filename=$myrow[0]");
		$body = base64_decode($myrow[2]); 
		print $body;
	
	};
?>