<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(14);
	
	// get email details
	$From=$_SESSION['FromName'];
	$FromEmail=$_SESSION['FromEmail'];
	$Subject=$_SESSION['Subject'];
	$Body=$_SESSION['Body'];
	
	// add log entry
	$l=new AddToDatabase();
	$l->AddPosts($_POST,$_FILES);
	$l->AddTable("Logs");
	$l->AddExtraFields(array("ClientsID"=>$ClientsID,"AdministratorsID"=>$AdminKey,"Message"=>$Body,'MsgType'=>"webmail","MsgTitle"=>$Subject));
	$l->AddFunctions(array("MDate"=>"CURDATE()"));
	$l->DoStuff();
	$LogID=$l->ReturnID();
	if($EmailCount->CanSendMore()){
		// log email address
		$x=new AddToDatabase();
		$x->AddTable("SentMessages");
		$x->AddExtraFields(array("LogsID"=>$LogID,"MsgID"=>"0","Email"=>$_SESSION['ToEmail']));
		$x->DoStuff();
		$EmailID=$x->ReturnID();
		// send email
	
		$m=new SendMail();
		$m->Body($Simple,$Plain,$HTML);
		$m->From($From,$FromEmail);
		$m->Subject($Subject);
		$m->Template("../../templates/$_SESSION[TemplatesID]/index.html");
		$m->To(array(""=>$_SESSION['ToEmail']));
		$rslt=$r->RawQuery("SELECT FileName,MimeType,Body FROM Attachments WHERE EMessageID='$_SESSION[SentEmailID]'");
		while($myrow=mysql_fetch_array($rslt)){
			$m->MadeAttachments($myrow[0],$myrow[1],$myrow[2]);
		}
		
		$Body.="<img src='http://$_SERVER[HTTP_HOST]/viewed.php?id=$EmailID'>";
		$m->Merge(array("body"=>$Body));
		$m->Send();
	};
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<link href="../../css/general.php" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
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
<span class="head"></span><br />
    <? include("../credit_meter.php");?>
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td width="81%" valign="top" class="rightside"><br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
      <tr>
        <td height="50" ><div align="left"><img src="../Pics/SMSMailProHeader.jpg" width="702" height="50" /></div></td>
      </tr>
      <tr>
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Send Message </span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="636" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="636"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td> Emails Sent.. </td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
            </table>
            <span class="bodytext"></span></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
<div id="midway"></div>
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
   
    <td width="81%">&nbsp;</td>
  </tr>
</table>
</body>
</html>
