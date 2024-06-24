<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(8);
	
	if($_POST['Submit']=="Unsubscribe"){
		$m= new BulkDBChange();
		$m->AddIDArray($_POST['DFiles']);
		$m->AddTable("Members");
		$m->WhatToChange("Unsubscibe","Yes");
		$Errors=$m->DoChange();
		if($Errors==""){
			$Message="Members Unsubscribed";
		}else{
			$Message=$Errors;
		};
	};
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

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
    
    <td width="81%" valign="top" class="rightside"><table width="469" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20"><img src="../Pics/largeBullet.gif" width="15" height="15" /></td>
        <td width="449"><span class="pagetitle"><span class="pagetitle">Un-Received Emails</span></span></td>
      </tr>
    </table>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <table width="636" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="636"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td> <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td><form action="modify.php"  method="post" name="form2" >
                    <p><span class="RedText"><?php print $Message; ?></span></p>
                    <p>This area is not 100% accurate as many email programs block the ability to detect whether an email has been delivered.
                    </p>
                    <table width="100%" border="0" cellpadding="3" cellspacing="1">
                      <tr class="header"> 
                        <td width="33%"><strong> Name</strong></td>
                        <td align="left">Email</td>
                        <td align="left">Count</td>
                        <td width="9%" align="center"><strong>Select</strong></td>
                      </tr>
                      <?php
					 	$Count=0;
						$sq2 = $r->RawQuery("SELECT DISTINCT Members.id,Name,SentMessages.Email,Count(SentMessages.id) FROM SentMessages,Logs,Members WHERE EmailReceived ='Sent' AND Members.Email=SentMessages.Email AND SentMessages.LogsID=Logs.id AND Members.ClientsID='$ClientsID' AND Logs.ClientsID='$ClientsID' AND Members.Unsubscibe='No' GROUP BY Email",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							$Count++;
							echo'<tr class="'.(($Count%2)==0 ? "row1" : "row2").'"> ';
							  echo"<td>$myrow[1]</td>";
							  echo"<td>$myrow[2]</td>";
							  echo"<td>$myrow[3]</td>";
							  echo"<td><div align=\"center\"><input type=\"checkbox\" name=\"DFiles[]\" value=\"$myrow[0]\" class=\"checkboxes\"></div></td>";
							echo"</tr>";
						};
					?>
					  
                      <tr align="right" class="header"> 
                        <td colspan="4"><input type="submit" name="Submit" value="Unsubscribe" /></td>
                        </tr>
                    </table>
                    <br>
                  </form></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
                </tr>
            </table></td>
          </tr>
        </table>
    <p>&nbsp;</p></td>
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
