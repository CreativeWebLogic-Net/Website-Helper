<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(17);
	
	if($_GET['id']) $id=$_GET['id'];
	elseif($_POST['id']) $id=$_POST['id'];
	
	if($_POST['Submit']){
		
		$m= new AddToDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddTable("AR_Messages");
		$m->AddSkip(array("id"));
		$m->AddExtraFields(array("AR_StreamID"=>$id));
		$m->DoStuff();
		$NewID=$m->ReturnID();
		$Message="Message Added";
	};
	
	if($_POST['Delete']=="Delete"){
		$m= new DeleteFromDatabase();
		$m->AddIDArray($_POST['DFiles']);
		$m->AddTable("AR_Messages");
		$Errors=$m->DoDelete();
		if($Errors==""){
			$Message="Messages Deleted";
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
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Delete / Add Messages </span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="636" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="636"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td><form action="modify-messages.php"  method="post" name="form2" id="form2" >
                                      <strong>*</strong><strong> Mandatory Fields </strong>
                                      <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                                        <tr>
                                          <td><strong>Queue Position </strong></td>
                                          <td><input name="QueuePos" type="text" id="QueuePos" size="10" /></td>
                                        </tr>
                                        <tr>
                                          <td><strong>Time Since Last Message </strong></td>
                                          <td><input name="MInterval" type="text" id="MInterval" size="10" />
                                              <select name="IntervalType" id="IntervalType">
                                                <option value="Hours" selected="selected">Hours</option>
                                                <option value="Days">Days</option>
                                            </select></td>
                                        </tr>
                                        <tr>
                                          <td width="185"><strong> Add Email Message To Stream <span class="RedText">*</span></strong></td>
                                          <td width="330"><select name="EmailID" id="EmailID">
										  <option value="">-No Email</option>
                                              <?php
							$sq2 = $r->RawQuery("SELECT id,Name FROM Email WHERE ClientsID='$ClientsID'",$db);
							while ($myrow = mysql_fetch_row($sq2)) {
								echo"<option value='$myrow[0]'>$myrow[1]</option>";
							};
						?>
                                          </select></td>
                                        </tr>
                                        <tr>
                                          <td><strong>Add SMS To Stream </strong></td>
                                          <td><select name="SMSID" id="SMSID">
										  <option value="">-No SMS</option>
                                            <?php
							$sq2 = $r->RawQuery("SELECT id,Name FROM SMS WHERE ClientsID='$ClientsID'",$db);
							while ($myrow = mysql_fetch_row($sq2)) {
								echo"<option value='$myrow[0]'>$myrow[1]</option>";
							};
						?>
                                                                                    </select></td>
                                        </tr>
                                        <tr>
                                          <td><strong>Email Template</strong></td>
                                          <td><select name="TemplatesID" id="TemplatesID">
                                              <?php
							$sq2 = $r->RawQuery("SELECT id,Name FROM Templates WHERE (ClientsID='$ClientsID' OR Public='Yes')",$db);
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
                                      <table width="100%" border="0" cellpadding="3" cellspacing="1" >
                                        <tr class="header">
                                          <td width="78%"><strong> Name - Email / SMS </strong></td>
                                          <td width="6%"><strong>Queue Position </strong></td>
                                          <td width="7%"><strong>Time Interval</strong> </td>
                                          <td width="9%" align="center"><strong>Delete</strong></td>
                                        </tr>
                                        <?php
					  $Count=0;
					 	$sq2 = $r->RawQuery("SELECT AR_Messages.id,QueuePos,MInterval,IntervalType,SMSID,EmailID FROM AR_Messages WHERE AR_Messages.AR_StreamID='$id' ORDER BY QueuePos",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							$Count++;
							?>
                                        <tr class="<?=(($Count%2)==0 ? "row1" : "row2"); ?>">
                                          <td>
										  <?php
											  $sq3 = $r->RawQuery("SELECT Name FROM Email WHERE id='$myrow[5]' ",$db);
											  $data = mysql_fetch_row($sq3);
											  $sq3 = $r->RawQuery("SELECT Name FROM SMS WHERE id='$myrow[4]' ",$db);
											  $data2 = mysql_fetch_row($sq3);
													
													?>
										  
										  <?=$data[0]?> / <?=$data2[0]?>
										  
										  </td>
                                          <td><?=$myrow[1]?></td>
                                          <td><?=$myrow[2]?>
                                              <?=$myrow[3]?></td>
                                          <td><div align="center">
                                              <input name="DFiles[]" type="checkbox" class="checkboxes" value="<?=$myrow[0]?>" />
                                          </div></td>
                                        </tr>
                                        <?
						};
					?>
                                        <tr align="right" class="header">
                                          <td colspan="3">&nbsp;</td>
                                          <td align="center"><?php
								if($p->CheckCode(18)) echo'<input name="Delete" type="submit" class="formbuttons" id="Delete" value="Delete" onClick="return confirmSubmit()">';
							?>
                                          </td>
                                        </tr>
                                      </table>
                                    <strong><br />
                                      To Delete a Message:</strong> select the checkbox for 
                                    that Message and then choose Delete button. <br />
                                              <strong>Tip:</strong> You can select multiple Messages. <br />
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
