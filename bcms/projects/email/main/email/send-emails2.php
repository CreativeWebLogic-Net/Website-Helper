<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(11);
	
	
	if($_POST['Submit']){
			$_SESSION['TemplatesID']=$_POST['TemplatesID'];
			header("Location: send-emails3.php");
			exit();
		
	}
	
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
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Send Messages - Step 2 </span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="636" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="636"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td> The second step is to select a template
                              <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td><form action="send-emails2.php"  method="post" enctype="application/x-www-form-urlencoded" name="form2" id="form2" >
                                        <br />
                                        <table width="100%" border="0" cellpadding="3" cellspacing="1" >
                                          <tr class="header">
                                            <td width="16%"><strong>Thumbnail </strong></td>
                                            <td width="63%"><strong>Name</strong></td>
                                            <td width="12%" align="center"><strong>Preview</strong></td>
                                            <td width="9%" align="center"><strong>Select</strong></td>
                                          </tr>
                                          <?php
					 	$Count=0;
						$sq2 = $r->RawQuery("SELECT id,Name,Thumbnail FROM Templates WHERE ClientsID='$ClientsID' OR Public='Yes'",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							$Count++;
							$tmp=($Count==1 ? 'checked="checked"' : "");
							?>
                                          <tr class="<?=(($Count%2)==0 ? "row1" : "row2")?>">
                                            <td><?
									if($myrow[2]!=""){
									?>
                                                <img src="../../templates/<?=$myrow[2]?>" />
                                                <?
									};
								?></td>
                                            <td><?=$myrow[1]?></td>
                                            <td align="center"><a href="../../templates/<?=$myrow[0]?>/" target="_blank"><img src="../../images/select.gif" width="47" height="16" border="0" /></a></td>
                                            <td><div align="center">
                                                <input type="radio" name="TemplatesID" value="<?=$myrow[0]?>" <?=$tmp?> />
                                            </div></td>
                                          </tr>
                                          <?
						};
					?>
                                          <tr align="right" class="header">
                                            <td colspan="3"><input name="EmailID" type="hidden" id="EmailID" value="<?=$EmailID;?>" /></td>
                                            <td align="center"><input type="submit" name="Submit" value="Submit" />
                                            </td>
                                          </tr>
                                        </table>
                                      <br />
                                        <br />
                                    </form></td>
                                  </tr>
                              </table></td>
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
