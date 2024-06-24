<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(17);
	
	if($_GET['id']){
		$id=$_GET['id'];
	}elseif($_POST['id']){
		$id=$_POST['id'];
	}
	
	if($_POST['Submit']){
		if(is_array($_POST['MembersID'])){
			foreach($_POST['MembersID'] as $val){
				$sql=$r->RawQuery("INSERT INTO AR_Users (QueuePos,AR_StreamID,MembersID) VALUES ('1','$id','$val')");
				if(!$sql) echo"error";
			}
		};
		$Message="User/s Added";
	};
	
	if($_POST['Delete']=="Delete"){
		$m= new DeleteFromDatabase();
		$m->AddIDArray($_POST['DFiles']);
		$m->AddTable("AR_Users");
		$Errors=$m->DoDelete();
		if($Errors==""){
			$Message="Users Deleted";
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
    
    <td align="right" ><a href="index-streams.php">Add Stream </a> | <a href="modify-streams.php">View Streams</a></td>
  </tr>
  <tr>
    
    <td width="81%" valign="top" class="rightside"><br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
      <tr>
        <td height="50" ><div align="left"><img src="../Pics/SMSMailProHeader.jpg" width="702" height="50" /></div></td>
      </tr>
      <tr>
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Delete / Add Users </span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="636" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="636"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td><form action="modify-users.php"  method="post" name="form2" id="form2" >
                                      <strong>*</strong><strong> Mandatory Fields </strong>
                                      <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                                        <tr>
                                          <td width="185"><strong> Add Contact To Stream <span class="RedText">*</span></strong></td>
                                          <td width="330"><select name="MembersID[]" size="10" multiple="multiple" id="MembersID[]">
                                              <?php
							$sq2 = $r->RawQuery("SELECT id,Name FROM Members WHERE ClientsID='$ClientsID' AND id NOT IN (SELECT MembersID FROM  AR_Users)",$db);
							while ($myrow = mysql_fetch_row($sq2)) {
								echo"<option value='$myrow[0]'>$myrow[1]</option>";
							};
						?>
                                          </select></td>
                                        </tr>
                                        <tr>
                                          <td height="25" colspan="2"><input name="Submit" type="submit"  class="formbuttons" id="Submit" value="Save" onclick="return confirmSubmit()" />
                                              <input name="id" type="hidden" id="id" value="<?=$id;?>" /></td>
                                        </tr>
                                      </table>
                                    <span class="RedText"><?php print $Message; ?></span><br />
                                      <br />
                                      <table width="100%" border="0" cellpadding="3" cellspacing="1">
                                        <tr class="header">
                                          <td width="82%"><strong> Name</strong></td>
                                          <td width="10%" align="center">Modify</td>
                                          <td width="8%" align="center"><strong>Delete</strong></td>
                                        </tr>
                                        <?php
					  	$Count=0;
					 	$sq2 = $r->RawQuery("SELECT AR_Users.id,Name,Members.id FROM AR_Users,Members WHERE AR_Users.MembersID=Members.id AND AR_Users.AR_StreamID='$id'",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							$Count++;
							?>
                                        <tr class="<?=(($Count%2)==0 ? "row1" : "row2"); ?>">
                                          <td><?=$myrow[1]?></td>
                                          <td><a href="../members/modify-edit.php?id=<?=$myrow[2]?>"><img src="../../images/modify.gif" width="47" height="12" border="0" /></a></td>
                                          <td><div align="center">
                                              <input name="DFiles[]" type="checkbox" class="checkboxes" value="<?=$myrow[0]?>" />
                                          </div></td>
                                        </tr>
                                        <?
						};
					?>
                                        <tr align="right" class="header">
                                          <td colspan="2">&nbsp;</td>
                                          <td align="center"><?php
								if($p->CheckCode(18)) echo'<input name="Delete" type="submit" class="formbuttons" id="Delete" value="Delete" onClick="return confirmSubmit()">';
							?>
                                          </td>
                                        </tr>
                                      </table>
                                    <strong><br />
                                      To Delete a User:</strong> select the checkbox for 
                                    that User and then choose Delete button. <br />
                                              <strong>Tip:</strong> You can select multiple Users. <br />
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
