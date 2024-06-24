<?php
	include("../Admin_Include.php");
	
	if($_POST['Delete']=="Delete"){
		$m= new DeleteFromDatabase();
		$m->AddIDArray($_POST['DFiles']);
		$m->AddTable("Clients");
		$Errors=$m->DoDelete();
		if($Errors==""){
			$Message="Clients Deleted";
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

<link href="../../css/general.php" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
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
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td width="81%" valign="top" class="rightside"><span class="pagetitle">Modify / Delete Clients </span><span class="RedText"><?php print $Message; ?></span></h1>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><form action="modify.php"  method="post" name="form2" id="form2" >
                      <br />
                      <br />
                      <table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr  class="header">
                          <td><strong> Name</strong></td>
                          <td><strong>Email</strong></td>
                          <td width="1%" align="center"><strong>Modify</strong></td>
                          <td width="1%" align="center"><strong>Delete</strong></td>
                        </tr>
                        <?php
					  include("database.php");
					 	$Count=0;		  
						$sq2 = $r->RawQuery("SELECT id,Name,Email FROM Clients",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							$Count++;
							echo'<tr class="'.(($Count%2)==0 ? "row1" : "row2").'"> ';
							  echo"<td>$myrow[1]</td>";
							  echo"<td>$myrow[2]</td>";
							  echo"<td align=\"center\"><a href=\"modify-edit.php?id=$myrow[0]\"><img src=\"../../images/modify.gif\" width=\"47\" height=\"12\" border=\"0\"></a></td>";
							  echo"<td><div align=\"center\"><input type=\"checkbox\" name=\"DFiles[]\" value=\"$myrow[0]\" class=\"checkboxes\"></div></td>";
							echo"</tr>";
						};
					?>
                        <tr align="right"  class="header">
                          <td colspan="3">&nbsp;</td>
                          <td align="center">
                            <input name="Delete" type="submit" class="formbuttons" id="Delete" value="Delete" onclick="return confirmSubmit()" />
                          </td>
                        </tr>
                      </table>
                      <strong><br />
              To Delete an Administrator:</strong> select the checkbox for that Administrator and then choose Delete button. <br />
                                  <strong>Tip:</strong> You can select multiple Administrators. <br />
                  </form></td>
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
    
    <td width="81%"><div id="wrapper">
      <div id="content">
        <span class="pagetitle">&nbsp;</h1>
      </div>
      <div id="footer">
        <p>Design and Content &copy; <strong><a href="http://www.iwebbiz.com.au">IWebBiz</a></strong> All rights reserved. </p>
      </div>
    </div></td>
  </tr>
</table>
</body>
</html>
