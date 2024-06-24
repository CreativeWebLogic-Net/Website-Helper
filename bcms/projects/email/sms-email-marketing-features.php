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
<br />
<table width="98%" height="476" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
  <tr>
    <td height="50"><div align="left"><img src="<?=$Logo;?>" /></div></td>
    <td align="right"><? include("login-box.php");?></td>
  </tr>
  <tr>
    <td height="308" colspan="2" valign="top" class="MainLinks"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%" valign="top"><span class="pagetitle">SMSMailPro Features </span></td>
            <td width="80%" class="maintext"><? include("menu.php");?></td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><p>&nbsp;</p>
            <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="middle"><img src="images/customer-database.jpg" alt="SMS Email Marketing" width="342" height="318" /></td>
                <td><h2>Features In SMSMailPro:-</h2>
                  <ul>
                    <li>Easily create newsletters as both sms and emails </li>
                    <li>Multiple administrators per client, each permission based access, allowing you to customize what your employees do </li>
                    <li>Contacts can be grouped together.</li>
                    <li>Emails can be stored to be sent at a later date</li>
                    <li>Groups of contacts can have dynamically created fields associated with them so no matter what info you wish to keep on a contact it can be stored </li>
                    <li>When sending an email, whether it is sent now or later it can be filtered by the contact database fields or by the dynamic fields and groups you have added to them</li>
                    <li>Contacts are searchable and if you have many contacts they are divided into easy to browse pages </li>
                    <li>Dynamically merge stored fields into messages for that personal touch </li>
                    <li>Auto responder allows you to stagger the response from your campaign, send a stream of messages to your contacts at controlled intervals</li>
                    <li>Autoresponder can send emails or SMS or both at once. </li>
                    <li>Web mail allows you to check unlimited pop3/mail accounts on the site, allowing you to funnel your email responses into contacts / groups / auto responder streams</li>
                    <li>Upload your own email templates, design them in HTML, zip them up (including images and folders) and upload them</li>
                    <li>Treat your email images as assets and upload them into your library to be re-used</li>
                    <li>Every message sent by the system is logged and presented in a way you can interpret </li>
                    <li>SMS to any country in the world. </li>
                </ul></td>
              </tr>
            </table>            <p>&nbsp;</p>              </td>
          </tr>
    </table></td>
  </tr>
</table>
<a href="http://www.iwebbiz.com.au">&nbsp;&nbsp;Website Design Development Promotion IWebBiz</a>
<? include("analytics.php");?>
</body>
</html>
