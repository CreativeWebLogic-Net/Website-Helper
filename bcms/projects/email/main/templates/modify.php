<?php
	include("../Admin_Include.php");
	include("../../functions.inc.php");
	
	$p->CheckPage(20);
	
	if($_POST['Delete']=="Delete"){
		if(is_array($_POST['DFiles'])){
			$m= new DeleteFromDatabase();
			$m->AddTable("Templates");
			foreach($_POST['DFiles'] as $val){ 
				$m->AddIDArray(array($val));
				$Errors=$m->DoDelete();
				recursive_remove_directory("../../templates/$val");
			};
		}else{
			$Message="Nothing selected to delete";
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
    
    <td align="right" ><a href="index.php">Add Templates </a></td>
  </tr>
  <tr>
   
    <td width="81%" valign="top" class="rightside"><table width="469" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20"><img src="../Pics/largeBullet.gif" width="15" height="15" /></td>
        <td width="449"><span class="pagetitle"><span class="pagetitle">Modify / Delete Templates</span></span></td>
      </tr>
    </table>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <table width="636" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="636"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td>            <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr> 
                  <td><form action="modify.php"  method="post" name="form2" >
                      <span class="RedText"><?php print $Message; ?></span><br>
                      <br>
                      <table width="100%" border="0" cellpadding="3" cellspacing="1" >
                        <tr class="header"> 
                          <td width="16%"><strong>Thumbnail </strong></td>
                          <td width="63%"><strong>Name</strong></td>
                          <td width="12%" align="center"><strong>Preview</strong></td>
                        <td width="9%" align="center"><strong>Delete</strong></td>
                        </tr>
                        <?php
					 	$Count=0;
						$sq2 = $r->RawQuery("SELECT id,Name,Thumbnail FROM Templates WHERE ClientsID='$ClientsID'",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							$Count++;
							?>
							 <tr class="<?=(($Count%2)==0 ? "row1" : "row2"); ?>">
							    <td><?
									if($myrow[2]!=""){
									?>
										<img src="../../templates/<?=$myrow[2]?>">
									<?
									};
								?></td>
							    <td><?=$myrow[1]?></td>
							    <td align="center"><a href="../../templates/<?=$myrow[0]?>/" target="_blank"><img src="../../images/select.gif" width="47" height="12" border="0"></a></td>
							    <td><div align="center"><input type="checkbox" name="DFiles[]" value="<?=$myrow[0]?>"></div></td>
							  </tr>
							  <?
						};
					?>
					    
                      <tr align="right" class="header"> 
                          <td colspan="3">&nbsp;</td>
                          <td align="center">
							  <?php
								if($p->CheckCode(21)) echo'<input name="Delete" type="submit" class="formbuttons" id="Delete" value="Delete" onClick="return confirmSubmit()">';
							?>
						  </td>
                        </tr>
                      </table>
                      <strong><br>
                      To Delete an Template:</strong> select the checkbox for 
                      that Template and then choose Delete button. <br>
                      <strong>Tip:</strong> You can select multiple Templates. 
                      <br>
                    </form></td>
                </tr>
            </table></td></tr>
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
