<?php
	
	
	include("DB_Class.php");
	include("functions.inc.php");
	
	$r=new ReturnRecord();
	
	if($_POST['Submit']){
		$AdminKey=GetKeyfromIDPass($_POST['UserName'],$_POST['Password']);
		if($AdminKey>0){ //admin login ok
			
			$sq2 = $r->RawQuery("SELECT SU,ClientsID,Theme FROM Administrators WHERE id='$AdminKey'",$db);
			while ($myrow = mysql_fetch_row($sq2)) {
				if($myrow[0]==1){
					$SU=$myrow[0];
				};
				$Theme=$myrow[2];
				$ClientsID=$myrow[1];
			};
			
					
			session_start();
			$_SESSION['AdminKey']=$AdminKey;
			$_SESSION['Theme']=$Theme;
			$_SESSION['ClientsID']=$ClientsID;
			
			if($SU){
				$_SESSION['SU']=$SU;
			};
			
			header("Location: main/logged-in/smproframes.php");
		}else{	//admin login bad
			$Message="Incorrect User Name or Password";
		};
	}else{
		
	};
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Australian Web Based Email and SMS Marketing Solution</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<META name="keywords" content="australia,sms, email, marketing, autoresponder, filters, groups, Web Based sms">
<META name="description" content="Australian Web Based SMS and Email Marketing Solution">
<meta content=index,follow name=ROBOTS>
<link href="main/css/cssmain.css" rel="stylesheet" type="text/css" />

<script>
<!--


var quirksMode = (top == self);
if(!quirksMode) top.document.location="index.php";
//-->
</script>
<? include("topbarlinks.php"); ?>


<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>
<body onload="window.defaultStatus='Things Are Looking up!.';">
<? include("topbar.php"); ?>
<br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
  <tr>
    <td height="50"><div align="left"><img src="<?=$Logo;?>" /></div></td>
    <td align="right"><? include("login-box.php");?></td>
  </tr>
  <tr>
    <td height="17" colspan="2" align="left" valign="top" class="MainLinks"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%" valign="top"><span class="pagetitle">Links</span></td>
            <td width="80%" align="left" valign="top"><? include("menu.php");?></td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><p>&nbsp;</p>
              <blockquote>
                <p><a href="http://directory.askbee.net" id="R16105C">AskBEE Free Directory</a></p>
                <p>&nbsp;</p>
              </blockquote></td>
        </tr>
    </table></td>
  </tr>
</table>
<a href="http://www.iwebbiz.com.au">&nbsp;&nbsp;Website Design Development Promotion IWebBiz</a>
<? include("analytics.php");?>
</body>
</html>
