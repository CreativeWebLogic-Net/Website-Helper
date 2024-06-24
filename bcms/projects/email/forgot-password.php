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
			  	if($_POST['Submit']&&$_POST['Email']!=""){
					include("Mail_Class.php");
					$a= new ReturnRecord();
					$a->AddTable("AdminEmails");
					$a->AddSearchVar(1);
					$Insert=$a->GetRecord();
					
					$r= new ReturnRecord();
					$rslt=$r->RawQuery("SELECT Crypted,UserName,Name FROM Administrators WHERE Email='$_POST[Email]'");
					$data=mysql_fetch_row($rslt);
					if($data[0]!=""){
						$NewBody='Your Username= '.$data[1].'<br>
							Follow link to change password: <a href="http://'.$_SERVER['HTTP_HOST'].'/change-password.php?id='.$data[0].'">http://'.$_SERVER['HTTP_HOST'].'/change-password.php?id='.$data[0].'</a> ';
			
						$m=new SendMail();
						$m->Body($Simple,$Plain,$HTML);
						$m->From("SMSMailPro Admin",$Insert['General']);
						$m->Subject("SMSMailPro Forgot Password Details");
						$m->Template("emailTemplates/template.php");
						$m->To(array($data[2]=>$_POST['Email']));
					
						$m->Merge(array("body"=>$NewBody));
						$m->Send();
						?>
              <strong>An Email Has Been Sent To The Entered Address, Follow The Instructions In The Message.</strong>
              <?
					}else{
						?>
              <strong>Invalid Email Address</strong>
              <?
					}
				
				}else{
			  ?>
			  <p align="center"><strong>Enter your email address and we will sen you a link to change your password:-</strong></p>
              <form id="form2" name="form2" method="post" action="forgot-password.php">
                <table width="62%" border="0" align="center" cellpadding="5" cellspacing="0" class="wizardStyle">
                  <tr>
                    <td width="49%"><strong>Email Address </strong></td>
                    <td width="51%"><input name="Email" type="text" id="Email" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
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
<? include("analytics.php");?>
</body>
</html>
