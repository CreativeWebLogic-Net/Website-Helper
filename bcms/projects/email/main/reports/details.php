<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(8);
	
	include("../../functions.inc.php");
		
	if($_GET['id']) $id=$_GET['id'];
	elseif($_POST['id']) $id=$_POST['id'];
	
	$m= new ReturnRecord();
	$m->AddTable("Logs");
	$m->AddSearchVar($id);
	$Log=$m->GetRecord();
	//print_r ($Log);
	$a= new ReturnRecord();
	$a->AddTable("Administrators");
	$a->AddSearchVar($Log['AdministratorsID']);
	$Admin=$a->GetRecord();
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

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
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
        <td height="17" valign="top"><span class="pagetitle">Message Details <strong></strong></span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><form action="details.php"  method="post" name="form2" id="form2" onsubmit="YY_checkform('form2','Name','#q','0','You must fill in the field Name.','Email','#S','2','You must fill in a valid Email Address.');return document.MM_returnValue">
                          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="30%"><span class="pagetitle"></span></td>
                              <td width="31%"><div align="center">
                                  <input name="Button" type="button" class="formbuttons" onclick="MM_openBrWindow('csv.php?id=<? print $id; ?>','csv','')" value="Export" />
                              </div></td>
                              <td width="39%"><div align="center"><span class="pagetitle"><strong>
                                  <input name="Button22" type="button" class="formbuttons" onclick="MM_goToURL('self','index.php');" value="Back To Index" />
                              </strong></span></div></td>
                            </tr>
                          </table>
                        <br />
                          <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                            <tr>
                              <td><strong>Log Title </strong></td>
                              <td><?php print $Log['MsgTitle']; ?></td>
                            </tr>
                            <tr>
                              <td width="163"><strong> Administrator Name</strong></td>
                              <td width="352"><?php print $Admin['Name']; ?></td>
                            </tr>
                            <tr>
                              <td><strong>Message</strong></td>
                              <td><?php print strip_tags($Log['Message']); ?></td>
                            </tr>
                          </table>
                        <div align="center">
                            <p><strong> </strong></p>
                          <table width="100%" border="0" cellpadding="3" cellspacing="1" >
                              <tr class="header">
                                <td width="46%"><strong> Name</strong></td>
                                <td width="44%"><strong>
                                  <? if($Log['MsgType']=="sms"){?>
                                  Number
                                  <? }else{ ?>
                                  Email
                                  <? }; ?>
                                  </strong>
                                    <div align="center"></div></td>
                                <td width="10%" align="center"><strong>
                                  <? if($Log['MsgType']=="sms"){?>
                                  Cost
                                  <? }else{?>
                                  Received
                                  <? };?>
                                </strong></td>
                              </tr>
							  <? 
					 $Total=0;
						  $Count=0; 
						if($Log['MsgType']!="sms"){
							$sq2 = $r->RawQuery("SELECT Number,Cost,Email,EmailReceived FROM SentMessages WHERE LogsID='$id'",$db);
						}else{
							$sq2 = $r->RawQuery("SELECT Mobile,Cost FROM SentSMS WHERE LogsID='$id'",$db);
						}
						while ($myrow = mysql_fetch_row($sq2)) {
							$Count++;
							echo'<tr class="'.(($Count%2)==0 ? "row1" : "row2").'"> ';
							  
							  if($Log['MsgType']=="sms"){
							    echo"<td>".FindNameFromNumber($myrow[0])."</td>";
								echo"<td>$myrow[0]</td>";
							  }else{
								echo"<td>".FindNameFromEmail($myrow[2])."</td>";
								echo"<td>$myrow[2]</td>";
							  };
							  if($Log['MsgType']=="sms"){
							  	echo"<td>$myrow[1]</td>";
							  }else{
							  	echo"<td>$myrow[3]</td>";
							  };
							echo"</tr>";
							$Total+=$myrow[1];
						};?>
					
                              <? if($Log['MsgType']=="sms"){?>
                              <tr align="right" class="header">
                                <td colspan="2"><strong>Total</strong></td>
                                <td align="center"><?php print $Total; ?></td>
                              </tr>
                              <? }; ?>
                            </table>
                          <p><br />
                            </p>
                        </div>
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
