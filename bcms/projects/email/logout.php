<?php

	include("DB_Class.php");
	include("functions.inc.php");
	session_start();
	session_unregister("SecureKey");
	session_unregister("SU");
	session_unregister("Theme");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<META name="keywords" content="sms, email, marketing, autoresponder, filters, groups">
<META name="description" content="SMS / Email Marketing Software">
<meta content=index,follow name=ROBOTS>
<link href="main/css/cssmain.css" rel="stylesheet" type="text/css" />
<? include("topbarlinks.php"); ?>
<script>
<!--


var quirksMode = (top == self);
if(!quirksMode) top.document.location="index.php";
//-->
</script>


<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>
<body onload="window.defaultStatus='Things Are Looking up!.';">
<? include("topbar.php"); ?>
<br><table width="98%" height="104" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
  <tr>
    <td height="50"><div align="left"><img src="<?=$Logo;?>" /></div></td>
    <td><? include("login-box.php");?></td>
  </tr>
  <tr>
    <td height="17" colspan="2" valign="top" class="MainLinks"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20%" valign="top"><span class="pagetitle">SMSMailPro Logout </span></td>
        <td width="80%" align="left" valign="top"><? include("menu.php");?></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><p>&nbsp;</p>
            <p>You are now logged out.</p>
            <p>Thank you for using SMS Mail Pro.  </p></td>
      </tr>
    </table></td>
  </tr>
  
</table>
<a href="http://www.iwebbiz.com.au">&nbsp;&nbsp;Website Design Development Promotion IWebBiz</a>
<? include("analytics.php");?>
</body>
</html>