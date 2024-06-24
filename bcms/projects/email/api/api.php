<?
	include("../DB_Class.php");
	include("../Mail_Class.php");
	include("../MergeEmail_Class.php");
	include("../Template_Class.php");
	include("../GetContact_Class.php");
	include("../CountEmails_Class.php");
	include("../SMS_Class.php");
	
	include("clsAPI.php");
	include("clsParseXML.php");
	include("clsXMLWriter.php");
	
	$r=new ReturnRecord();

	$XML_In=file_get_contents("php://input"); 
	
	$api=new SMSMailProAPI($XML_In);
	$api->Process();
?>
Run