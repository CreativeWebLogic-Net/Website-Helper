<?php
	include("../Admin_Include.php");
	
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<script>
	
var CArr=Array();
<?php
	$m= new ReturnRecord();
	$m->AddTable("Administrators");
	$m->AddSearchVar($AdminKey);
	$Insert=$m->GetRecord();
	
	$sq2=$r->rawQuery("SELECT id,HTML FROM Codes");  
	while ($myrow = mysql_fetch_row($sq2)) {
		$myrow[1]=eregi_replace("\[Username\]",$Insert['UserName'],$myrow[1]);
		echo"CArr[$myrow[0]]='$myrow[1]';";
	};
?>     
	
	
	function SetCodes(){
		var CType=document.getElementById("CType").value;
		
		
		
			if(CType>0){
				var Target=document.getElementById("Preview");
				Target.innerHTML=CArr[CType];
				var Target=document.getElementById("CopyCode");
				Target.value=CArr[CType];
			}else{
				var Target=document.getElementById("Preview");
				Target.innerHTML="Please Select Code Type";
				var Target=document.getElementById("CopyCode");
				Target.value="Please Select Code Type";
			}
		
		
	}
</script>

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
<span class="head"></span>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><br />
    <? include("../credit_meter.php");?>
    <br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
      <tr>
        <td height="50" ><div align="left"><img src="../Pics/SMSMailProHeader.jpg" width="702" height="50" /></div></td>
      </tr>
      <tr>
        <td height="17" valign="top" class="MainLinks"><p class="pagetitle"><br />
          Get Codes For Your Website
</p>
          <table width="81%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="34%"><strong>Code Type</strong></td>
            <td width="66%"><select name="CType" id="CType" class="formFields" onchange="SetCodes();">
              <option value="0">-Please Select Code Type</option>
              <?php
					$sq2=$r->rawQuery("SELECT id,Title FROM Codes");  
					while ($myrow = mysql_fetch_row($sq2)) {
						echo"<option value='$myrow[0]'>$myrow[1]</option>";
					};
				?>
            </select></td>
          </tr>
          <tr>
            <td><strong>Preview</strong></td>
            <td><span id="Preview">Please Select Code Type</span></td>
          </tr>
          <tr>
            <td><strong>Copy Code</strong></td>
            <td>
              <textarea name="CopyCode" cols="70" rows="8" class="formFields" id="CopyCode">Please Select Code Type</textarea>            </td>
          </tr>
        </table></td>
      </tr>
    </table>
    
    </td>
  </tr>
</table>
</body>
</html>
