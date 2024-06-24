<?php
	include("../Admin_Include.php");
	include("../functions.inc.php");
	
	if($_POST['SendCode']){
		$_POST['EmailCode']=str_makerand(5,5);
		$_POST['MobileCode']=str_makerand(5,5);
		$m= new UpdateDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddSkip(array("id"));
		$m->AddTable("Administrators");
		$m->AddID($_SESSION['AdminKey']);
		$m->DoStuff();
		if($m->Errors==""){
			$Message="Codes Sent To Your Email Address And Mobile Number";
						
			$a= new ReturnRecord();
			$a->AddTable("AdminEmails");
			$a->AddSearchVar(1);
			$Insert=$a->GetRecord();
			
			
			$NewBody='Verification Code='.$_POST['EmailCode'];
			
			$m=new SendMail();
			$m->Body($Simple,$Plain,$HTML);
			$m->From("SMSMailPro Admin",$Insert['General']);
			$m->Subject("SMSMailPro Verification Code");
			$m->Template("../../emailTemplates/template.php");
			$m->To(array($Insert['Name']=>$_POST['Email']));
		
			$m->Merge(array("body"=>$NewBody));
			$m->Send();
			
			$Body="Verification Code=".$_POST['MobileCode'];
			$click=new SMS();
			$FromName="SMSMailPro";//$_SESSION['FromName'];
			$click->SetFrom($FromName);
			$click->SetMessage($Body);
			$click->AddTo($_POST['Mobile']);
			$click->Send();
		}else{
			$Message=$m->Errors;
		}
	}
	
	if($_POST['Submit']){
		$m= new ReturnRecord();
		$m->AddTable("Administrators");
		$m->AddSearchVar($_SESSION['AdminKey']);
		$Insert=$m->GetRecord();
		
		if(($_POST['EmailCode']==$Insert['EmailCode'])&&($_POST['MobileCode']==$Insert['MobileCode'])){
			$m->RawQuery("UPDATE Administrators SET Verified='Yes' WHERE id=$_SESSION[AdminKey]");
			header("Location: frameset.php");
			exit();
		}else{
			$Message="Codes do not match";
		}	
	}
	
	$m= new ReturnRecord();
	$m->AddTable("Administrators");
	$m->AddSearchVar($_SESSION['AdminKey']);
	$Insert=$m->GetRecord();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

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
<style type="text/css">
<!--
.style1 {color: #BDCFFF}
-->
</style>
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
        <td height="17" valign="top" class="MainLinks">
                   
            <span class="bodytext">Welcome To SMSMailPro, you must verify your account details.<br />
            </span>
			<span class="RedText"><?=$Message;?></span>
          <form id="form1" name="form1" method="post" action="verify.php">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="59%" height="129"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" class="wizardStyle">
                  <tr>
                    <td colspan="2" align="center" class="RedText"><h2>Step 1 </h2></td>
                    </tr>
                  <tr>
                    <td width="24%" align="center"><strong>Current Email</strong></td>
                    <td width="24%" align="center"><input name="Email" type="text" id="Email" value="<?=$Insert['Email'];?>" /></td>
                    </tr>
                  
                  <tr>
                    <td align="center"><strong>Current Mobile</strong></td>
                    <td align="center"><input name="Mobile" type="text" id="Mobile" value="<?=$Insert['Mobile'];?>" /></td>
                    </tr>
                  <tr>
                    <td colspan="2" align="center"><strong><span class="RedText">International Dialing Codes</span> <span class="RedText">Must Be Used</span> and leading zeros or pluses must be removed eg for a mobile in Australia the number would be 61123456789</strong></td>
                    </tr>
                  <tr>
                    <td height="28" colspan="2" align="center"><input name="SendCode" type="submit" id="SendCode" value="Send Codes To You" /></td>
                    </tr>
                </table></td>
                <td width="41%"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="wizardStyle">
                  <tr>
                    <td colspan="2" align="center" class="RedText"><h2 >Step 2 </h2></td>
                  </tr>
                  <tr>
                    <td width="26%" align="center"><strong>Enter Email Code </strong></td>
                    <td width="26%" align="center"><input name="EmailCode" type="text" id="EmailCode" /></td>
                  </tr>
                  <tr>
                    <td height="54" align="center"><strong>Enter Mobile Code </strong></td>
                    <td align="center"><input name="MobileCode" type="text" id="MobileCode" /></td>
                  </tr>
                  <tr>
                    <td height="30" colspan="2" align="center"><input name="Submit" type="submit" id="Submit" value="Submit Codes For Verification" /></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </form>          
          <p>&nbsp;</p></td>
      </tr>
    </table>
    
    </td>
  </tr>
</table>
</body>
</html>
