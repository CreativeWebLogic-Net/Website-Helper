<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(11);
	
	$EmailID=$_SESSION['SMSID'];
	$c=new GetContacts($ClientsID);
	
	$sq2 = $r->RawQuery("SELECT Name,Body FROM SMS WHERE id='$EmailID'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$Subject=$myrow[0];
		$Body=$myrow[1];
	};
	$l=new AddToDatabase();
	$l->AddPosts($_POST,$_FILES);
	$l->AddTable("Logs");
	$l->AddExtraFields(array("ClientsID"=>$ClientsID,"AdministratorsID"=>$AdminKey,"Message"=>$Body,'MsgType'=>"sms","MsgTitle"=>$_SESSION['LogTitle']));
	$l->AddFunctions(array("MDate"=>"CURDATE()"));
	$l->DoStuff();
	$_SESSION['LogsID']=$l->ReturnID();
	$_SESSION['Start']=0;
	foreach($_SESSION['FilterList'] as $key=>$val){
		$c->SearchType($_SESSION['SSType'][$key],$val);
	};
	$_SESSION['Emails']=$c->Retrieve();
	$TotalCount=count($_SESSION['Emails']);
		
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
.style2 {font-size: 10px}
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
var Total=<?=$TotalCount;?>;
var CurrentPercent=0;
var TotalDone=0;
var interval=Math.ceil(Total/10);
function startsending(){
	document.getElementById("Sender").src="send-mail.php?interval="+interval+"&EmailID=<?=$EmailID;?>";
}

function Return(){
	TotalDone=TotalDone+interval;
	var TotalN=Math.round(TotalDone/Total*100);
	if(TotalN>100){
	 TotalN=100;
	}
	document.getElementById("Percent").innerHTML=TotalN;
	if(TotalDone<Total){
		startsending();
	}
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
</head>
<body onload="window.defaultStatus='Things Are Looking up!.';startsending()">
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
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Send Messages - Sending Now </span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td>Percentage done <span id="Percent">0</span>%
                  <iframe src="" name="Sender" width="0" marginwidth="0" height="0" marginheight="0" scrolling="Auto" id="Sender" style="display:none"></iframe></td>
              </tr>
            </table>
            <p></p>
            <div align="center"><span class="RedText style2">You are charged at the maximum rate untill we recieve a report of the actual cost and then you are credited the difference. </span></div></td>
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
