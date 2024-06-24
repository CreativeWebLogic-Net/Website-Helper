<?php
	session_start();
	if(!$_SESSION['AdminKey']){
		header("Location: ../../index.php");
	};
	include("../../DB_Class.php");
	$r=new ReturnRecord();
	
	
		
	if(($_POST['NewClient'])&&($_SESSION['SU'])){
		$_SESSION['ClientsID']=$_POST['NewClient'];
		$sq2 = $r->RawQuery("SELECT Theme FROM Clients WHERE id='$ClientsID'",$db);
		$myrow=mysql_fetch_assoc($sq2);
		$_SESSION['Theme']=$myrow['Theme'];
	};
	
	$AdminKey=$_SESSION['AdminKey'];
	$Theme=$_SESSION['Theme'];
	$ClientsID=$_SESSION['ClientsID'];
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SMSMailPro - Email And SMS Marketing</title>
</head>

<frameset rows="84,*,32" cols="*" framespacing="0" frameborder="no" border="0" id="VerticalFrameSet">
  <frame src="../logged-in/topframe.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frame src="paymentsuccess.php" name="TheMainFrame" id="TheMainFrame" title="content" />
  <frame src="../logged-in/footer.php" name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" title="footer" />
</frameset>
<noframes><body>
</body>
</noframes></html>
