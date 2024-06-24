<?php
	
	
	include("DB_Class.php");
	include("functions.inc.php");
	
	$r=new ReturnRecord();
	
	if($_POST['Submit']||$_COOKIE['Crypt']){
		if($_POST['Submit']){
			$AdminKey=GetKeyfromIDPass($_POST['UserName'],$_POST['Password']);
		}else{
			$AdminKey=GetKeyfromCrypt($_COOKIE['Crypt']);
		}
		if($AdminKey>0){ //admin login ok
			
			if($_POST['Remember']){
				setcookie("Crypt",md5($_POST['UserName'].$_POST['Password']),time()+24*60*60*31,"/",".smsmailpro.com");
			}
			
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
			
			header("Location: main/logged-in/frameset.php");
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
<? include("topbarlinks.php");?>
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
            <td width="80%" align="left" valign="top" class="Main_Menu"><? include("menu.php");?></td>
          </tr>
          <tr>
            <td height="254" colspan="2" valign="top"><p>&nbsp;</p>
              <p><img src="images/nokia_music_store.jpg" alt="SMS Email Marketing" width="349" height="257" hspace="5" vspace="5" align="left" />Welcome to <strong>SMSMailPro</strong> the most advanced web based email &amp; SMS marketing site on the web. Email &amp; SMS Marketing is probably one of the effective way to keep touch with your current customers and to introduce yourself to new ones. <br />
                Our E-mail   and SMS Marketing solution lets you get started building a rapport with your clients with a minimum of effort. You can get started building your mailing list by signing up and adding a few lines of code to your website. <br />
              If you already have a customer database you can easily import it into our system. E-mail and SMS are one of the most cost effective communication mediums you can use, with a high return on investment. <br />
              <span class="RedText"><strong>We dont have any sign up fees or monthly charges</strong></span>, we believe you pay for what you use so we only charge you when you actually send a message.We believe in being a one stop solution for your companies online presense, use our simple to install sign up forms to get those initial sign up details, then add the contact to a staggered response list that sends out messages in customizable time intervals to keep your company fresh in the mind of your customer letting your story unfold over time.Create newsletters for your customer lists and assign a date for them to be sent. <br />
              Use our webmail system to integrate with your companies personal email system so any communication is not lost and add new email addresses directly to your mailing lists with a single click.<br />
              Create your own custom email templates and upload them to the system to add a bit of flourish to your communications. <span class="RedText"><strong>Add a newsletter signup to your website in 5 minutes</strong></span>. </p>
            </td>
          </tr>
    </table></td>
  </tr>
</table>
<a href="http://www.iwebbiz.com.au">&nbsp;&nbsp;Website Design Development Promotion IWebBiz</a>
<? include("analytics.php");?>
</body>
</html>
