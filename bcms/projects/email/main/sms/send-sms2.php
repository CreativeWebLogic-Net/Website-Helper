<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(11);
	
	
	if($_POST['Submit']){
		if($_POST['When']=="Now"){
			$_SESSION['LogTitle']=$_POST['LogTitle'];
			$_SESSION['FromName']=$_POST['FromName'];
			header("Location: send-sms-now.php");
			exit();
		}else{
			$FList=serialize($_SESSION['FilterList']);
			$Stype=serialize($_SESSION['SSType']);
			$r->RawQuery("INSERT INTO SMSQueue (SMSID,FilterList,SType,ToGo,FromName,AdministratorsID) VALUES('$_SESSION[SMSID]','$FList','$Stype','$_POST[Year]-$_POST[Month]-$_POST[Day] $_POST[Hours]:$_POST[Minutes]:00','$_POST[FromName]','$AdminKey')");
			header("Location: send-sms-future.php");
			exit();
		}
	}
	
	$sq2 = $r->RawQuery("SELECT Name,Email FROM Administrators WHERE id='$AdminKey'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$FromName=$myrow[0];
		$FromEmail=$myrow[1];
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
                            <td> The second step is to select when the emails are sent
                              <table width="616" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="616"><form action="send-sms2.php"  method="post" name="form2" id="form2" >
                                      <br />
                                        <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" id="tablecell">
                                          <tr>
                                            <td height="27" align="center"><strong>Log Title </strong></td>
                                            <td colspan="2"><input name="LogTitle" type="text" id="LogTitle" size="45" /></td>
                                          </tr>
                                          <tr>
                                            <td height="27" align="center"><strong>From Name or Number</strong></td>
                                            <td colspan="2">SMSMailPro<br />
                                              (Because of fraud if you want to have the from name of your choice you must submit a request to us with the required number or string and a reason for it, requests are not guarenteed)</td>
                                          </tr>
                                          <tr>
                                            <td width="23%" height="42" align="center"><strong>Send Now </strong></td>
                                            <td width="6%" align="center"><input name="When" type="radio" value="Now" checked="checked" /></td>
                                            <td width="71%">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="55" align="center"><strong>Send in the future<br />
                                            </strong></td>
                                            <td align="center"><input name="When" type="radio" value="Future" /></td>
                                            <td align="center">Date/Time:
                                              <select name="Day">
                                                  <?php
					for($x=1;$x<32;$x++){
						if($x==$FDay){
							echo'<option value="'.$x.'" selected>'.$x.'</option>';
						}else{
							echo'<option value="'.$x.'">'.$x.'</option>';
						};
					};
				?>
                                                </select>
                                              -
                                              <select name="Month" id="FMonth">
                                                <?php
					for($x=1;$x<13;$x++){
						if($x==$FMonth){
							echo'<option value="'.$x.'" selected>'.$x.'</option>';
						}else{
							echo'<option value="'.$x.'">'.$x.'</option>';
						};
					};
				?>
                                              </select>
                                              -
                                              <select name="Year" id="select2">
                                                <?php
					for($x=2004;$x<2020;$x++){
						if($x==$FYear){
							echo'<option value="'.$x.'" selected>'.$x.'</option>';
						}else{
							echo'<option value="'.$x.'">'.$x.'</option>';
						};
					};
				?>
                                              </select>
                                              /
                                              <select name="Hours" id="Hours">
                                                <?php
					for($x=0;$x<25;$x++){
						if($x==$FYear){
							echo'<option value="'.$x.'" selected>'.$x.'</option>';
						}else{
							echo'<option value="'.$x.'">'.$x.'</option>';
						};
					};
				?>
                                              </select>
                                              :
                                              <select name="Minutes" id="Minutes">
                                                <?php
					for($x=0;$x<61;$x++){
						if($x==$FYear){
							echo'<option value="'.$x.'" selected>'.$x.'</option>';
						}else{
							echo'<option value="'.$x.'">'.$x.'</option>';
						};
					};
				?>
                                              </select>
                                              <br />
                                              (dd-mm-yyyy / hour : Minute ) </td>
                                          </tr>
                                          <tr>
                                            <td height="60" colspan="3"><div align="right">
                                                <input name="EmailID" type="hidden" id="EmailID" value="<?=$EmailID;?>" />
                                                <input type="submit" name="Submit" value="Submit" />
                                            </div></td>
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
