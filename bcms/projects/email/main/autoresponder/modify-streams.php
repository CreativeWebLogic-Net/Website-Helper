<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(17);
	
	if($_GET['id']) $id=$_GET['id'];
	elseif($_POST['id']) $id=$_POST['id'];
	
	if($_POST['Delete']=="Delete"){
		$m= new DeleteFromDatabase();
		$m->AddIDArray($_POST['DFiles']);
		$m->AddTable("AR_Stream");
		$Errors=$m->DoDelete();
		if($Errors==""){
			$Message="Streams Deleted";
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
    
    <td align="right" ><a href="index-streams.php">Add Stream </a></td>
  </tr>
  <tr>
    
    <td width="81%" valign="top" class="rightside"><table width="469" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20"><img src="../Pics/largeBullet.gif" width="15" height="15" /></td>
        <td width="449"><span class="pagetitle"><span class="pagetitle">Modify / Delete Streams</span></span></td>
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
                <td><form action="modify-streams.php"  method="post" name="form2" >
                    <span class="RedText"><?php print $Message; ?></span><br>
                    <br>
                    <table width="100%" border="0" cellpadding="3" cellspacing="1" >
                      <tr class="header"> 
                        <td width="60%"><strong> Name</strong></td>
                        <td width="11%" align="center"><strong>Messages</strong></td>
                        <td width="10%" align="center"><strong>Users</strong></td>
                        <td width="10%" align="center"><strong>Modify</strong></td>
                        <td width="9%" align="center"><strong>Delete</strong></td>
                      </tr>
                      <?php
					  	$Count=0;
					 	$sq2 = $r->RawQuery("SELECT id,Name FROM AR_Stream WHERE ClientsID='$ClientsID'",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							$Count++;
							?>
							<tr class="<?=(($Count%2)==0 ? "row1" : "row2"); ?>">
								<td><?=$myrow[1]?></td>
						    	<td align="center"><a href="modify-messages.php?id=<?=$myrow[0]?>"><img src="../../images/modify.gif" width="47" height="12" border="0" /></a></td>
						    	<td align="center"><a href="modify-users.php?id=<?=$myrow[0]?>"><img src="../../images/modify.gif" width="47" height="12" border="0" /></a></td>
						    	<td align="center"><a href="modify-edit-streams.php?id=<?=$myrow[0]?>"><img src="../../images/modify.gif" width="47" height="12" border="0"></a></td>
							 	<td><div align="center"><input name="DFiles[]" type="checkbox" class="checkboxes" value="<?=$myrow[0]?>">
							 	</div></td>
							</tr>
							<?
						};
					?>
					  
                      <tr align="right" class="header"> 
                        <td colspan="4">&nbsp;</td>
                        <td align="center">
							<?php
								if($p->CheckCode(18)) echo'<input name="Delete" type="submit" class="formbuttons" id="Delete" value="Delete" onClick="return confirmSubmit()">';
							?>
						</td>
                      </tr>
                    </table>
                    <strong><br>
                    To Delete an Stream:</strong> select the checkbox for 
                    that Stream and then choose Delete button. <br>
                    <strong>Tip:</strong> You can select multiple Streams. 
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
</body>
</html>
