<?php
	
	
	include("DB_Class.php");
	include("functions.inc.php");
	
	
	require_once("fsbb.php");
	if($_POST['Submit']){
		$blocker=new formSpamBotBlocker();
		$blocker->setTimeWindow(2,60); // set the min and max time in seconds for a form to be submitted
		$blocker->setTrap(true,"mail"); // called here, because it has been called on the form page as well (same trap name!)
		$param=false;
		$nospam=false;
			if ($_POST) $param=$_POST;
			elseif ($_GET) $param=$_GET;
			if (!$param) die("This script requires some POST or GET parameters from file");
		$nospam=$blocker->checkTags($param);
		$submissions=$_SESSION[$blocker->sesName];	
		if($submissions>4) exit("no spam");
		
		$Body="Name : $_POST[name] \n";
		$Body.="Email Address : $_POST[email] \n";
		$Body.="Phone : $_POST[phone] \n";
		$Body.="Comments : $_POST[details] \n Recieve info in future: $_POST[Add]";
        //$servermail="info@dalc.info";
		//$servermail="simon@bratpacknewmedia.com";
		$servermail="info@smsmailpro.com";
    	include "maillib.php";
        $m= new Mail;
        $m->From("$_POST[email]");
        $m->To( $servermail );
        $m->Subject("Contact Form");

        $m->Priority(1) ; //high priority
		$m->Body($Body);
		//$m->Attach( "Mail/newmailmsg.html", "text/html" );
	
		// Sending Email.....
		$m->Send();
	
	}else{
	
		$blocker=new formSpamBotBlocker();
		$blocker->setTimeWindow(2,60); // Called for test reasons. It must be actually set on the target page!
		$blocker->setTrap(true,"mail","Do not enter anything in this field!"); // if set here (to change the defaults), then set it again with the same name on the target page!
		$hiddenTags=$blocker->makeTags(); // create the xhtml string containing the required form elements
	}
	
	
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
.FormButtons { font-size: 10px;
 background-color:#333333;
 border: 1px solid #FFFFFF;
 color:#FFFFFF;
 font-family:Arial, Helvetica, sans-serif;
 font-weight:bold;
}
.TableBorder {	border: 1px solid #CCCCCC;
}
.style8 {color: #FFFFFF}
-->
</style>
</head>
<body onload="window.defaultStatus='Things Are Looking up!.';">
<? include("topbar.php"); ?>
<br><table width="100%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
  <tr>
    <td height="50"><div align="left"><img src="<?=$Logo;?>" /></div></td>
    <td align="right"><? include("login-box.php");?></td>
  </tr>
  <tr>
    <td height="17" colspan="2" valign="top" class="MainLinks"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%" valign="top"><span class="pagetitle">SMSMailPro Contact Us</span></td>
            <td width="80%" valign="top" class="maintext"><? include("menu.php");?></td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><p>&nbsp;</p>
              <blockquote>
                <p align="center"><strong>We are based in the Gold Coast, Queensland, Australia and the number you can contact us on is 61-433-204-582 </strong></p>
              </blockquote>
              <div align="center">
                <h2>
                <?
			  	if($_POST['Submit']){
			  ?>
              Thank you for your interest we will contact you as soon as possible.
              <?
			  	}else{
				
			?>
                </h2>
              </div>
              <form action="contact.php" method="post" name="frmContact" id="frmContact">
                <img src="images/contact-us.jpg" alt="SMS Email Marketing" width="320" height="300" hspace="15" align="left" />
              <table width="48%" border="0" align="center" cellpadding="0" cellspacing="3" class="wizardStyle">
                <tr>
                  <td width="42%">Name</td>
                  <td width="58%"><span class="style8">
                    <input name="name" type="text" id="name" size="40" />
                  </span></td>
                </tr>
                <tr>
                  <td height="42">Phone</td>
                  <td><span class="style8">
                    <input name="phone" type="text" id="phone" size="40" />
                  </span></td>
                </tr>
                <tr>
                  <td height="36">Email</td>
                  <td><span class="style8">
                    <input name="email" type="text" id="email" size="40" />
                  </span></td>
                </tr>
                <tr>
                  <td height="129">Details</td>
                  <td><span class="style8">
                    <textarea name="details" cols="40" rows="6" id="details"></textarea>
                  </span></td>
                </tr>
                <tr>
                  <td height="30">Receive Info In The Future</td>
                  <td><input name="Add" type="checkbox" id="Add" value="1" /></td>
                </tr>
                <tr>
                  <td height="22" colspan="2" align="center"><span class="style8"></span><span class="style8"> <?php print $hiddenTags; ?>
                    <input name="Submit" type="submit" class="formbuttons" id="Submit" value="Send" />
                  </span></td>
                </tr>
              </table>
              <p>&nbsp;</p>
            </form>              <? 
			  };
			  ?>            </td>
        </tr>
    </table></td>
  </tr>
</table>
<a href="http://www.iwebbiz.com.au">&nbsp;&nbsp;Website Design Development Promotion IWebBiz</a>
<? include("analytics.php");?>
</body>
</html>
