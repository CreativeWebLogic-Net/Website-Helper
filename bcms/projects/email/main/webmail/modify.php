<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(14);
	include("../../functions.inc.php");
	if($_POST['Email_FoldersID']) $Email_FoldersID=$_POST['Email_FoldersID'];
	else $Email_FoldersID=1;
	
	if($_GET['Page']){
		$Page=$_GET['Page'];
	}elseif($_POST['Page']){
		$Page=$_POST['Page'];
	}elseif($_POST['Page2']){
		$Page=$_POST['Page2'];
	}else{
		$Page=1;
	}
	
	if($_POST['Delete']=="Delete"){
		if(is_array($_POST['DFiles'])){
			if($Email_FoldersID==3){	
				$m= new DeleteFromDatabase();
				$m->AddIDArray($_POST['DFiles']);
				$m->AddTable("EMessage");
				$Errors=$m->DoDelete();
				$m->AddTable("Attachments");
				$m->AltDeleteVar("EMessageID");
				$Errors.=$m->DoDelete();
				
			}else{
				$b=new BulkDBChange();
				$b->AddTable("EMessage");
				$b->AddIDArray($_POST['DFiles']);
				$b->WhatToChange("Email_FoldersID",3);
				$b->DoChange();
			}
			$Message="Messages Deleted";
		}else{
			$Message="Nothing selected to delete";
		};
		
	};
	
	if($_POST['CEmail_FoldersID']!=""){
		if(is_array($_POST['DFiles'])){
			$b=new BulkDBChange();
			$b->AddTable("EMessage");
			$b->AddIDArray($_POST['DFiles']);
			$b->WhatToChange("Email_FoldersID",$_POST['CEmail_FoldersID']);
			$b->DoChange();
			$Message="Messages Folders Changes";
		}else{
			$Message="No Messages Selected";
		};
	}
	
	
	$RecordsPerPage=10;
	$StartRecord=($Page-1)*$RecordsPerPage;
	
	if($Email_FoldersID!="All"){
		$FView=" AND Email_FoldersID='$Email_FoldersID' ";
	}
	
	$rset=$r->rawQuery("SELECT COUNT(*) FROM EMessage WHERE ClientsID='$ClientsID' $FView");
	$rdata=mysql_fetch_array($rset);
	$rcount=$rdata[0];
	$SQL="SELECT id,Seen,FromAddress,Subject,Date FROM EMessage WHERE ClientsID='$ClientsID' $FView  LIMIT $StartRecord,$RecordsPerPage";
	$rset=$r->rawQuery($SQL);
	
	$NPPage="Email_FoldersID=$Email_FoldersID";
	$MaxPages=ceil($rcount/$RecordsPerPage);
	
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
    
    <td align="right" ><a href="check-mail.php">Check Mail  </a></td>
  </tr>
  <tr>
   
    <td width="81%" valign="top" class="rightside"><table width="469" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20"><img src="../Pics/largeBullet.gif" width="15" height="15" /></td>
        <td width="449"><span class="pagetitle">View Webmail  <span class="RedText"><?php print $Message; ?></span></span></td>
      </tr>
    </table>
    
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <table width="636" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="636"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td>            <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr> 
                  <td><form action="modify.php"  method="post" name="form2" >
                      <div align="right">
                        View Folder: 
                          <select name="Email_FoldersID" onchange="this.form.submit()">
                          <option value="All" <?=($Email_FoldersID=="All"?"Selected":"")?>>All Folders</option>
						  <option value="1" <?=($Email_FoldersID==1?"Selected":"")?>>Inbox</option>
						  <option value="2" <?=($Email_FoldersID==2?"Selected":"")?>>Sent Messages</option>
						  <option value="3" <?=($Email_FoldersID==3?"Selected":"")?>>Deleted Messages</option>
						  <option value="4" <?=($Email_FoldersID==4?"Selected":"")?>>Spam</option>
                          <?php
					 	$sq2 = $r->RawQuery("SELECT id,Description FROM Email_Folders WHERE ClientsID='$ClientsID'",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							$tmp=($Email_FoldersID==$myrow[0] ? "selected":"");
							echo"<option value='$myrow[0]' $tmp>$myrow[1]</option>";
						};
							?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <table width="100%" border="0" cellpadding="3" cellspacing="1" >
                        <tr class="header">
                          <td colspan="6"><table width="100%"  border="0" cellpadding="4" cellspacing="0" >
                            <tr class="header">
                              <td width="23%" align="left"><? if($Page>1){ ?>
                                  <a href="modify.php?Page=<?=$Page-1;?>&amp;<?=$NPPage?>" >&lt;&lt;Back</a>
                                  <? }; ?></td>
                              <td width="56%" align="center"><? if($MaxPages>1){?>Jump to
                                <select name="Page" id="Page" onchange="this.form.submit()">
                                    <?
					  	for($x=1;$x<=$MaxPages;$x++){
					  		$tmp=($x==$Page ? "selected" : "");
							echo"<option value='$x' $tmp>Page $x</option>";
						};
					  ?>
                                </select><? };?></td>
                              <td width="21%" align="right" valign="middle"><?
						if($Page<$MaxPages){
					?>
                                  <a href="modify.php?Page=<?=$Page+1;?>&amp;<?=$NPPage?>" >Next &gt;&gt; </a>
                                  <?
						};
					?></td>
                            </tr>
                          </table></td>
                          </tr>
                        <tr class="header"> 
                          <td width="8%"><strong>Seen </strong></td>
                          <td width="23%"><strong>From</strong></td>
                          <td width="35%">Subject</td>
                          <td width="13%">Date</td>
                          <td width="12%" align="center"><strong>View</strong></td>
                        <td width="9%" align="center"><strong>Select</strong></td>
                        </tr>
                        <?php
					 	$Count=0;
						
						while ($myrow = mysql_fetch_row($rset)) {
							$Count++;
							?>
							 <tr class="<?=(($Count%2)==0 ? "row1" : "row2"); ?>">
							    <td><?=$myrow[1]?></td>
							    <td><?=$myrow[2]?></td>
							    <td><?=$myrow[3]?></td>
							    <td><?=$myrow[4]?></td>
							    <td align="center"><a href="modify-edit.php?id=<?=$myrow[0]?>"><img src="../../images/select.gif" width="47" height="12" border="0"></a></td>
							    <td><div align="center"><input name="DFiles[]" type="checkbox" class="checkboxes" value="<?=$myrow[0]?>">
							    </div></td>
							  </tr>
							  <?
						};
					?>
					    
                      <tr align="right" class="header"> 
                          <td colspan="5"><select name="CEmail_FoldersID" onchange="this.form.submit()">
                            <option value="" selected>-Move To Folder</option>
							
							  <option value="1">Inbox</option>
							  <option value="2">Sent Messages</option>
							  <option value="3">Deleted Messages</option>
							  <option value="4">Spam</option>
                            <?php
					 	$sq2 = $r->RawQuery("SELECT id,Description FROM Email_Folders WHERE ClientsID='$ClientsID'",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							echo"<option value='$myrow[0]' >$myrow[1]</option>";
						};
							?>
                          </select></td>
                          <td align="center">
							  <?php
								if($p->CheckCode(15)) echo'<input name="Delete" type="submit" class="formbuttons" id="Delete" value="Delete" onClick="return confirmSubmit()">';
							?>						  </td>
                        </tr>
                      <tr align="right" class="header">
                        <td colspan="6"><table width="100%"  border="0" cellpadding="4" cellspacing="0" >
                          <tr >
                            <td width="23%" align="left"><? if($Page>1){ ?>
                                <a href="modify.php?Page=<?=$Page-1;?>&amp;<?=$NPPage?>" >&lt;&lt;Back</a>
                                <? }; ?></td>
                            <td width="56%" align="center"><? if($MaxPages>1){?>Jump to
                              <select name="Page2" id="Page2" onchange="this.form.submit()">
                                  <?
					  	for($x=1;$x<=$MaxPages;$x++){
					  		$tmp=($x==$Page ? "selected" : "");
							echo"<option value='$x' $tmp>Page $x</option>";
						};
					  ?>
                              </select><? }; ?></td>
                            <td width="21%" align="right" valign="middle"><?
						if($Page<$MaxPages){
					?>
                                <a href="modify.php?Page=<?=$Page+1;?>&amp;<?=$NPPage?>" >Next &gt;&gt; </a>
                                <?
						};
					?></td>
                          </tr>
                        </table></td>
                        </tr>
                      </table>
                      <strong><br>
                      To Delete an Email:</strong> select the checkbox for 
                      that Email and then choose Delete button. <br>
                      <strong>Tip:</strong> You can select multiple Emails. 
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
