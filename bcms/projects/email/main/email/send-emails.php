<?php
	include("../Admin_Include.php");
	include("functions.inc.php");
	
	$p->CheckPage(11);
	
	$c=new GetContacts($ClientsID);
	
	if($_GET['id']) $_SESSION['EmailID']=$_GET['id'];
	
	if($_POST['SType']) $SType=$_POST['SType'];
	else $SType=0;
	
	if($_POST['Submit']){
		$_SESSION['FilterList'][]=$_POST['FilterList'];
		$_SESSION['SSType'][]=$_POST['SType'];
		header("Location: send-emails2.php");
		exit();
	}elseif($_POST['Filter']){
		$_SESSION['FilterList'][]=$_POST['FilterList'];
		$_SESSION['SSType'][]=$_POST['SType'];
		foreach($_SESSION['FilterList'] as $key=>$val){
			$c->SearchType($_SESSION['SSType'][$key],$val);
		};
		
		$ShowNow=$c->Retrieve();
		$Message="Filter Applied";
	}elseif(!$_POST['Posted']){
		unset($_SESSION['FilterList']);
		unset($_SESSION['SSType']);
		$_SESSION['FilterList']=array();
		$_SESSION['SSType']=array();
		//$c->SearchType(0,array());
		$ShowNow=$c->Retrieve();
	}else{
		if(is_array($_SESSION['FilterList'])){
			foreach($_SESSION['FilterList'] as $key=>$val){
				$c->SearchType($_SESSION['SSType'][$key],$val);
			};
			$ShowNow=$c->Retrieve();
		}else{
			//$c->SearchType(0,array());
			$ShowNow=$c->Retrieve();
		}
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
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Send Messages - Step 1 </span><span class="RedText"><?php print $Message; ?></span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="636" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="636"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td> The first step is to select who the emails are going to
                              <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td><form action="send-emails.php"  method="post" enctype="application/x-www-form-urlencoded" name="form2" id="form2" >
                                        <div align="center"><br />
                                          Number Of Contacts Selected =
                              <?=$c->NumberOfContactsSelected();?>
                                          <br />
                              <br />
                                        </div>
                                      <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" id="tablecell">
                                          <tr>
                                            <td>Filter Type </td>
                                            <td><select name="SType" id="select3" onchange="this.form.submit()">
                                                <option value="0" <?php if($SType==0){echo "selected";}; ?>>Select By Name Contacts</option>
                                                <option value="1" <?php if($SType==1){echo "selected";}; ?>>Select By PostCode</option>
                                                <option value="2" <?php if($SType==2){echo "selected";}; ?>>Select By State</option>
                                                <option value="7" <?php if($SType==7){echo "selected";}; ?>>Select By Suburb</option>
                                                <option value="8" <?php if($SType==8){echo "selected";}; ?>>Select By Country</option>
                                                <option value="12" <?php if($SType==12){echo "selected";}; ?>>Select By Bounced Emails</option>
                                                <option value="11" <?php if($SType==11){echo "selected";}; ?>>Select By Contact Group</option>
                                                <?
							$c->GetGroupOptions($SType);
						?>
                                            </select></td>
                                          </tr>
                                          <tr>
                                            <td>Select from the filter output </td>
                                            <td><select name="FilterList[]" size="19" multiple="multiple" id="select4">
                                                <?php
						  $Previous=array();
                     if(eregi("GO_",$SType)){
						$TSType=substr($SType,3);
						
						$c->GetGroupValues($TSType);
						
						
					}elseif(is_numeric($SType)){
					   
					   
					   switch($SType){
							case 0:
								

								usort($ShowNow, "Name_compare");
								foreach($ShowNow as $val){
									if(!in_array($val['Email'],$Previous)){
										print("<option value='$val[Email]'>$val[Name]</option>");
										$Previous[]=$val['Email'];
									}
								}
							break;
							case 1:
								usort($ShowNow, "PostCode_compare");
								foreach($ShowNow as $val){
									if(!in_array($val['PostCode'],$Previous)){
										print("<option value='$val[PostCode]'>$val[PostCode]</option>");
										$Previous[]=$val['PostCode'];
									}
								}
							break;
							case 2:
								usort($ShowNow, "State_compare");
								foreach($ShowNow as $val){
									if(!in_array($val['State'],$Previous)){
										print("<option value='$val[State]'>$val[State]</option>");
										$Previous[]=$val['State'];
									}
								}
							break;
							case 7:
								usort($ShowNow, "Suburb_compare");
								foreach($ShowNow as $val){
									if(!in_array($val['Suburb'],$Previous)){
										print("<option value='$val[Suburb]'>$val[Suburb]</option>");
										$Previous[]=$val['Suburb'];
									}
								}
							break;
							case 8:
								usort($ShowNow, "Country_compare");
								foreach($ShowNow as $val){
									if(!in_array($val['Country'],$Previous)){
										print("<option value='$val[Country]'>$val[Country]</option>");
										$Previous[]=$val['Country'];
									}
								}
							break;
							
							case 12:
								$c->GetBouncedEmails();
							break;
							
							
							case 11:
								$c->GetContactGroups();
								break;
							default:
							
							
								
								break;
						
						}
                       };
						
						
						
                 ?>
                                            </select></td>
                                          </tr>
                                          <tr>
                                            <td align="left"><input type="submit" name="Submit" value="Submit" />
                                            </td>
                                            <td align="right"><input name="Posted" type="hidden" id="Posted" value="1" />
                                                <input name="Filter" type="submit" id="Filter" value="Filter Again" /></td>
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
