<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(5);
	
	if($_POST['Delete']=="Delete"){
		if(is_array($_POST['DFiles'])){
			$m= new DeleteFromDatabase();
			$m->AddIDArray($_POST['DFiles']);
			$m->AddTable("GroupOptions");
			$Errors=$m->DoDelete();
			$m->AddTable("DropDown");
			$m->AltDeleteVar("GroupOptionsID");
			$Errors.=$m->DoDelete();
			if($Errors==""){
				$Message="Group Options Deleted";
			}else{
				$Message=$Errors;
			};
		}else{
			$Message="No Product Options Selected To Delete";
		};
	};
	if($_POST['Active']=="Activate"){
		if(is_array($_POST['DFiles'])){
			$m= new BulkDBChange();
			$m->AddIDArray($_POST['DFiles']);
			$m->AddTable("ProductOptions");
			$m->WhatToChange('Active',1);
			$Errors=$m->DoChange();
			
			if($Errors==""){
				$Message="Product Options Activated";
			}else{
				$Message=$Errors;
			};
		}else{
			$Message="No Product Options Selected To Activate";
		};
	};
	if($_POST['Active']=="DeActivate"){
		if(is_array($_POST['DFiles'])){
			$m= new BulkDBChange();
			$m->AddIDArray($_POST['DFiles']);
			$m->AddTable("ProductOptions");
			$m->WhatToChange('Active',0);
			$Errors=$m->DoChange();
			
			if($Errors==""){
				$Message="Product Options DeActivated";
			}else{
				$Message=$Errors;
			};
		}else{
			$Message="No Product Options Selected To DeActivate";
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
    
    <td align="right" ><a href="index.php">Add Group Field </a></td>
  </tr>
  <tr>
    
    <td width="81%" valign="top" class="rightside"><table width="469" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20"><img src="../Pics/largeBullet.gif" width="15" height="15" /></td>
        <td width="449"><span class="pagetitle">Modify / Delete Group Fields </span><span class="RedText"><?php print $Message; ?></span></td>
      </tr>
    </table>
    
        <form action="modify.php"  method="post" name="form2" id="form2" >
          <table width="100%" border="0" cellpadding="3" cellspacing="1"  >
            <tr bgcolor="#363E57"  class="header">
              <td width="10%" align="center">Sort Order</td>
              <td width="49%">Question</td>
              <td width="12%">Type</td>
              <td width="9%">Required </td>
              <td width="6%">Active</td>
              <td width="8%" align="center">Modify</td>
              <td width="6%" align="center">Select</td>
            </tr>
            <?php
					  	$Count=0;
					 	$r=new ReturnRecord();
						$sq2=$r->rawQuery("SELECT GroupOptions.id,Question,Type,Required,Active,SOrder FROM GroupOptions,MemberGroups WHERE GroupOptions.MemberGroupsID=MemberGroups.id AND ClientsID='$ClientsID'");  
						while ($myrow = mysql_fetch_row($sq2)) {
						?>
            <tr class="<?=(($Count%2)==0 ? "row1" : "row2"); ?>">
              <td align="center"><?=$myrow[5];?></td>
              <td><?=$myrow[1];?></td>
              <?
				  	switch ($myrow[2]) {
					case 0:
					   $myrow[2]="Text Box";
					   break;
					case 1:
					   $myrow[2]="Text Area";
					   break;
					case 2:
					   $myrow[2]="Drop Down List";
					   break;
					case 3:
					   $myrow[2]="Checkbox";
					   break;
					case 4:
					   $myrow[2]="Radio Button";
					   break;
					case 5:
					   $myrow[2]="Blank";
					   break;
					}
				  ?>
              <td><?=$myrow[2];?></td>
              <td align="center"><?
				  	if($myrow[3]==0){
						echo "No";
					}else{
						echo "Yes";
					};
				  ?></td>
              <td align="center"><?
				  	if($myrow[4]==0){
						echo "No";
					}else{
						echo "Yes";
					};
				  ?></td>
              <td align="center"><a href="modify-edit-options.php?id=<?=$myrow[0];?>"><img src="../../images/modify.gif" width="47" height="12" border="0" /></a></td>
              <td><div align="center">
                  <input name="DFiles[]" type="checkbox" class="checkboxes" value="<?=$myrow[0];?>" />
              </div></td>
            </tr>
            <?
							$Count++;
						};
					?>
            <tr align="right"  class="header">
              <td colspan="7"><input name="Active" type="submit" class="formbuttons" id="Active" value="Activate" onclick="return confirmSubmit()" />
                  <input name="Active" type="submit" class="formbuttons" id="Active" value="DeActivate" onclick="return confirmSubmit()" />
                  <? if($p->CheckCode(6)){?><input name="Delete" type="submit" class="formbuttons" id="Delete" value="Delete" onclick="return confirmSubmit()" /> <? };?>             </td>
            </tr>
          </table>
          <strong><br />
            To Delete an Group Option:</strong> select the checkbox for that Group Option and then choose Delete button. <br />
  <strong>Tip:</strong> You can select multiple Group Options. <br />
        </form>
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
