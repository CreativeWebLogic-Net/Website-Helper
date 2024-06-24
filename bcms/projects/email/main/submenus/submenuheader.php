<?php
	session_start();
	if(!$_SESSION['AdminKey']){
		header("Location: ../index.php");
	};
	include("../../DB_Class.php");
	$r=new ReturnRecord();
	
	
	$AdminKey=$_SESSION['AdminKey'];
	$Theme=$_SESSION['Theme'];
	$ClientsID=$_SESSION['ClientsID'];
	
	include("../../Perms_Class.php");
	$p=new Permissions($AdminKey);
	$NormalServer="http://www.smsmailpro.com";
	$ShowMenu=true;
?>