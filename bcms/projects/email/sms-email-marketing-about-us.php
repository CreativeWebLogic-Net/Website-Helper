<?php
	
	
	include("DB_Class.php");
	include("functions.inc.php");
	
	?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
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
<br><table width="98%" height="362" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
  <tr>
    <td width="78%" height="50"><div align="left"><img src="<?=$Logo;?>" /></div></td>
    <td width="22%" align="right"><? include("login-box.php");?></td>
  </tr>
  <tr>
    <td height="194" colspan="2" valign="top" class="MainLinks"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%" valign="top"><span class="pagetitle">SMSMailPro About Us</span> </td>
            <td width="80%" valign="top"><? include("menu.php");?></td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><p>&nbsp;</p>
            <p><img src="images/mobile_marketing.jpg" alt="SMS Email Marketing" width="141" height="141" align="left" />IWebBiz is a group of individuals who will see a problem and solve it. We have put a fair amount of time producing an SMS/Email product for the average user. We cater for the people who aren't experts but want the functionality of a complex situation where the answer comes easily. SMS/Email Messages are a new tool to the end user and they want to utilise the technology with a minimum of fuss. In our program we have designed an SMS/Email gateway that will cover all your needs in the modern marketplace. As well as sending SMS Messages our tool can also send a Email to the selected contacts to make sure they get the message. You can filter through your contacts by factors such as postcode or state, sending SMS/Email Messages to select areas. Your company can have multiple administrators who can organise contacts or send messages. There is a simple permissions system where with the click of a mouse one of your administrators can be locked out of an area, usefull for stoping some administrators from emailing non work related contacts. </p></td>
        </tr>
    </table></td>
  </tr>
</table>
<a href="http://www.iwebbiz.com.au">&nbsp;&nbsp;Website Design Development Promotion IWebBiz</a>
<? include("analytics.php");?>
</body>
</html>
