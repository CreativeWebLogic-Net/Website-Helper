<?php
	include("../Admin_Include.php");
	
	if($_POST['Submit']){
			include("../../maillib3.php");
			
			$c= new ReturnRecord();
			$c->AddTable("Clients");
			$c->AddSearchVar($_SESSION['ClientsID']);
			$Client=$c->GetRecord();
			
			
			api_email("SMSMailPro Support", "info@smsmailpro.biz",$_POST['Name'], $_POST['Email'], "SMSMailPro Support Query","Client=".$Client['Name']." \n Name=$_POST[Name] \n Email=$_POST[Email] \n Problem=$_POST[Body]","Client=".$Client['Name']." \n Name=$_POST[Name] \n Email=$_POST[Email] \n Problem=$_POST[Body]", "Client=".$Client['Name']." <br> Name=$_POST[Name] <br> Email=$_POST[Email] <br> Problem=$_POST[Body]"); 
			$Message="Email Sent we will contact you as soon as possible"; 
			
		};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<link href="../../menu_files/menu.php" rel="stylesheet" type="text/css"> 
<link href="../../css/general.php" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../../menu_files/menu.js"></script>
<script language="JavaScript" src="../../menu_files/menu_items.php"></script>
<script language="JavaScript" src="../../menu_files/menu_tpl.js"></script>
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--


function CheckAll(){
	XLength=9;
	for(x=1;x<XLength;x++){
		document.getElementById("Perms["+x+"]").checked=true;
	}
}

function confirmSubmit()
{
var agree=confirm("Are you sure you wish to continue?");
if (agree)
	return true ;
else
	return false ;
}
//-->
</script>
<script language="JavaScript" type="text/JavaScript">
<!--

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
</head>
<body onload="window.defaultStatus='Things Are Looking up!.';">

<div id="skipnav"><a href="#content" tabindex="1" title="Skip Navigation" accesskey="2">Skip Navigation</a></div>
<div id="logo"></div>
<span class="head"></span>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><br />
    <? include("../credit_meter.php");?><br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
      <tr>
        <td height="50" ><div align="left"><img src="../Pics/SMSMailProHeader.jpg" width="702" height="50" /></div></td>
      </tr>
      <tr>
        <td height="17" valign="top" class="MainLinks"><table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td><form name="form1" method="post" action="index.php">
                  <p><span class="pagetitle">Help &amp; Support </span><span class="RedText"><?php print $Message; ?></span><br>
                    <br>
                    Please fill in the following details and we will get back to you. </p>
                  <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                    <tr>
                      <td colspan="2"><div align="center"><strong>Send Support Email </strong></div></td>
                      </tr>
                    <tr>
                      <td width="163"><strong> Full Name<span class="RedText">*</span></strong></td>
                      <td width="352"><input name="Name" type="text" id="Name" size="45"></td>
                    </tr>
                    <tr>
                      <td><strong> Email<span class="RedText">*</span></strong></td>
                      <td><input name="Email" type="text" id="Email" size="45"></td>
                    </tr>
                    <tr>
                      <td><strong>Problem</strong></td>
                      <td><textarea name="Body" cols="45" rows="10" id="Body"></textarea></td>
                    </tr>
                    <tr>
                      <td height="25" colspan="2"><div align="center">
                        <input name="Submit" type="submit" class="formbuttons" value="Submit">
                      </div></td>
                      </tr>
                  </table>
                  <p>&nbsp;</p>
                  </form></td>
              </tr>
            </table></td>
      </tr>
    </table>
    
    </td>
  </tr>
</table>
</body>
</html>