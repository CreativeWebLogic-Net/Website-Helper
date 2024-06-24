<?php
	
	
	include("DB_Class.php");
	include("functions.inc.php");
	
		
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
<br><table width="98%" height="431" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
  <tr>
    <td height="50"><div align="left"><img src="<?=$Logo;?>"  /></div></td>
    <td align="right"><? include("login-box.php");?></td>
  </tr>
  <tr>
    <td height="263" colspan="2" align="left" valign="top" class="MainLinks"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%" valign="top"><span class="pagetitle">Email &amp; SMS Marketing</span></td>
            <td width="80%" align="left" valign="top"><? include("menu.php");?></td>
          </tr>
          <tr>
            <td height="254" colspan="2" valign="top"><p>&nbsp;</p>
              <?
			  	if($_POST['Submit']){
					if($_POST['Password']==$_POST['Password2']){
					
						$r= new ReturnRecord();
						$rslt=$r->RawQuery("SELECT id,UserName FROM Administrators WHERE Crypted='$_POST[id]'");
						$data=mysql_fetch_row($rslt);
						if($data[0]>0){
							$Crypted=md5($data[1].$_POST['Password']);
							$rslt=$r->RawQuery("UPDATE Administrators SET Crypted='$Crypted' WHERE id=$data[0]");
							?>Password Updated Please Log In<?
						}else{
							?>Invalid User<?
						}
					}else{
						?>Passwords Don't Match<?
					}
				
				}else{
			  ?>
			  <p align="center"><strong>Enter yournew password:-</strong></p>
              <form id="form2" name="form2" method="post" action="change-password.php">
                <table width="62%" border="0" align="center" cellpadding="5" cellspacing="0" class="wizardStyle">
                  <tr>
                    <td width="49%"><strong>New Password </strong></td>
                    <td width="51%"><input name="Password" type="password" id="Password" /></td>
                  </tr>
                  <tr>
                    <td><strong>New Password Again</strong></td>
                    <td><input name="Password2" type="password" id="Password2" /></td>
                  </tr>
                  <tr>
                    <td><input name="id" type="hidden" id="id" value="<?=$_GET['id'];?>" /></td>
                    <td><input name="Submit" type="submit" class="formbuttons" id="Submit" value="Submit" /></td>
                  </tr>
                </table>
              </form>
              <?
			  	};
			  ?></td>
          </tr>
    </table></td>
  </tr>
</table>
<a href="http://www.iwebbiz.com.au">&nbsp;&nbsp;Website Design Development Promotion IWebBiz</a>
</body>
</html>
