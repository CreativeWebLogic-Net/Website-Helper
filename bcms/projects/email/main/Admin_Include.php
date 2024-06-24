<?
	session_start();
	if(!$_SESSION['AdminKey']){
		header("Location: ../../index.php");
	};
	include("../../DB_Class.php");
	include("../../Perms_Class.php");
	include("../../Mail_Class.php");
	include("../../MergeEmail_Class.php");
	include("../../Template_Class.php");
	include("../../GetContact_Class.php");
	include("../../CountEmails_Class.php");
	include("../../SMS_Class.php");
	
	
	$r=new ReturnRecord();
	
	$AdminKey=$_SESSION['AdminKey'];
	$Theme=$_SESSION['Theme'];
	$ClientsID=$_SESSION['ClientsID'];
	
	$p=new Permissions($AdminKey);
	$EmailCount=new CountEmails($ClientsID);


?>