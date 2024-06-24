<?
	include("DB_Class.php");
	$r=new ReturnRecord();
	$sq2 = $r->RawQuery("UPDATE Members SET Unsubscribe='Yes' WHERE Email='$_GET[Email]' AND ClientsID='$_GET[ClientsID]'",$db);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Unsubscibe</title>
</head>

<body>
You have been unsubscibed 
</body>
</html>
