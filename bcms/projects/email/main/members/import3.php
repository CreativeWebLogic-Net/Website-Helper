<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(4);
	
	if($_POST['Submit']){
		$Contacts=array();
		foreach($_POST['MapTo'] as $key=>$val){
			if($val!=""){
				for($x=1;$x<count($_SESSION['CSVArray']);$x++){
					$tmparr=split(",",$_SESSION['CSVArray'][$x]);
					$Contacts[$x-1][$val].=$tmparr[$key];
				};
			};
		};
		foreach($Contacts as $key=>$val){
			$count=0;
			$TmpTitles="";
			$TmpVals="";
			foreach($val as $key2=>$val2){
				$tmp=($count==0 ? "" : ",");
				$TmpTitles.=$tmp.$key2;
				$TmpVals.=$tmp."'$val2'";
				$count++;
			}
			$SQL="INSERT INTO Members ($TmpTitles,ClientsID) VALUES ($TmpVals,'$ClientsID')";
			//print($SQL."<br>");
			$r->RawQuery($SQL);
			$id=mysql_insert_id();
			
			if(is_array($_SESSION['MemberGroupsID'])){
				foreach($_SESSION['MemberGroupsID'] as $val){
					$SQL="INSERT INTO MemberGroupsLinks  (MembersID,MemberGroupsID) VALUES ('$id','$val')";
					$r->RawQuery($SQL);
				} 
			}
			if(is_array($_SESSION['AR_StreamID'])){
				foreach($_SESSION['AR_StreamID'] as $val){
					$SQL="INSERT INTO AR_Users (QueuePos,AR_StreamID,MembersID) VALUES ('1','$val','$id')";
					$r->RawQuery($SQL);
				}
			} 
		
		}
		
		
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



function CheckAll(){
	XLength=9;
	for(x=1;x<XLength;x++){
		document.getElementById("Perms["+x+"]").checked=true;
	}
}

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
    
    <td align="right" valign="top"><a href="modify.php">Modify/Delete Contacts</a> </td>
  </tr>
  <tr>
    
    <td width="81%" valign="top" class="rightside"><br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
      <tr>
        <td height="50" ><div align="left"><img src="../Pics/SMSMailProHeader.jpg" width="702" height="50" /></div></td>
      </tr>
      <tr>
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Import Contacts CSV </span><span class="RedText"><?php print $Message; ?></span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="top"><table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td valign="top"><form action="import3.php"  method="post" enctype="multipart/form-data" name="form2" id="form2" onsubmit="YY_checkform('form2','Name','#q','0','You must fill in the Field Name.','Email','S','2','Must be a valid Email Address.');return document.MM_returnValue" >
                          <br />
                        Your CSV file has been imported. <br />
                        <br />
                        <br />
                        <br />
                      </form></td>
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
