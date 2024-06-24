<?php
	include("../Admin_Include.php");
	
	$tmparr=split("\.",$_SERVER['HTTP_HOST']);
	if($tmparr[0]!="smsmailpro"){
		$m= new ReturnRecord();
		$m->AddTable("Clients");
		$m->AddSearchVar($_SESSION['ClientsID']);
		$Insert=$m->GetRecord();
		
		if($Insert['Logo']!=""){
			$Logo="/assets/logos/".$Insert['Logo'];
		}else{
			$Logo="../Pics/SMSMailProHeaderSmall.jpg";
		}
	}else{
		$Logo="../Pics/SMSMailProHeaderSmall.jpg";
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SMSMailPro</title>
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />


</head>

<body>
<table width="1006" height="82" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="228" rowspan="2" align="center" valign="middle"><img src="<?=$Logo?>"  /></td>
    <td width="778" height="20" id="main-menu"><a  href="../submenus/home-frame.php" target="TheMainFrame">HOME </a><a  href="/main/payments/index.php" target="TheMainFrame">BUY CREDITS</a><a  href="../submenus/reports-frame.php" target="TheMainFrame">REPORTS</a><a  href="../submenus/administrators-frame.php" target="TheMainFrame">ADMINISTRATORS</a><a  href="../submenus/webmail-frame.php" target="TheMainFrame">WEBMAIL</a><a href="../submenus/autoresponder-frame.php" target="TheMainFrame" >AUTORESPONDER</a><a href="../getcodes/index.php" target="TheMainFrame">GET CODES</a></td>
  </tr>
  <tr>
    <td  height="20" id="main-menu"><a  href="/logout.php" target="_top">LOGOUT</a><a  href="../submenus/setup-frame.php" target="TheMainFrame">SETUP</a><a href="/forum/viewforum.php?f=4" target="TheMainFrame">HELP</a><a  href="../submenus/contacts-frame.php" target="TheMainFrame">CONTACTS</a><a  href="../submenus/templates-frame.php" target="TheMainFrame">TEMPLATES</a><a  href="../submenus/email-frame.php" target="TheMainFrame">EMAIL</a><a   href="../submenus/sms-frame.php" target="TheMainFrame">SMS</a></td>
  </tr>
</table>
</body>
</html>
