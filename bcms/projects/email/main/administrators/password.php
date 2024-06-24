<?php
	include("../Admin_Include.php");
	
	
	if($_POST['Submit']){
		$m= new ReturnRecord();
		$m->AddTable("Administrators");
		$m->AddSearchVar($AdminKey);
		$Insert=$m->GetRecord();
		$Crypted=md5($Insert["UserName"].$_POST['CPassword']);
		if($Crypted==$Insert['Crypted']){
			$Crypted=md5($Insert["UserName"].$_POST['Password']);
			$_POST['Crypted']=$Crypted;
			$_POST['Password']="";
			$m= new UpdateDatabase();
			$m->AddPosts($_POST,$_FILES);
			$m->AddTable("Administrators");
			$m->AddID($AdminKey);
			$m->DoStuff();
			$Message="Password Updated";
		}else{
			$Message="Current Password Incorrect";
		}
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
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
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
<span class="head"></span><br />
    <? include("../credit_meter.php");?>
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td align="right" ><a href="modify.php">Modify / Delete Administrators </a>| <a href="index.php">Add Administrators </a></td>
  </tr>
  
  <tr>
    
    <td width="81%" valign="top" class="rightside"><br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
      <tr>
        <td height="50" ><div align="left"><img src="../Pics/SMSMailProHeader.jpg" width="702" height="50" /></div></td>
      </tr>
      <tr>
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Change Your Password </span><span class="RedText"><?php print $Message; ?></span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><form action="password.php"  method="post" name="form2" id="form2" >
                          <br />
                          <br />
                          <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                            <tr>
                              <td width="140"><strong> Current Password</strong></td>
                              <td width="271"><input name="CPassword" type="password" id="CPassword" size="30" /></td>
                            </tr>
                            <tr>
                              <td><strong>New Password</strong></td>
                              <td><input name="Password" type="password" id="Password" size="30" /></td>
                            </tr>
                            <tr>
                              <td><strong>Retype New Password</strong></td>
                              <td><input name="Password2" type="password" id="Password2" size="30" /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td><input name="Submit" type="submit" class="formbuttons" value="Save" onclick="return confirmSubmit()" /></td>
                            </tr>
                          </table>
                        <br />
                      </form></td>
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
