<?php
	session_start();
	if(!$_SESSION['SecureKey']){
		header("Location: ../../index.php");
	};
	include("../../cast128.php");
	$e = new cast128;
	include("../../DB_Class.php");
	$r=new ReturnRecord();
	$e->setkey("kjhnsdf fdsiohjf fasdujhf asduijdsi");
	$TmpKey=split("-",$e->decrypt($_SESSION['SecureKey']));
	$AdminKey=$TmpKey[0];
	$ClientsID=$TmpKey[1];
	$Theme=$TmpKey[2];
	if($_POST['Submit']){
		//   /management/images/logo.jpg
		$m= new UpdateDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddSkip(array("Submit","SetDefaultLogo"));
		$m->AddTable("LookFeel");
		if($SetDefaultLogo==1){
			$m->AddExtraFields(array("Logo"=>"logo.jpg"));
		}else{
			$m->ResizeImage("Logo","../../images/","360x70");
		}
		$m->AddID(1);
		$m->DoStuff();
		$Message="Colour Scheme Updated";
	};
	
	include("database.php");
	$sq2 = $r->RawQuery("SELECT * FROM LookFeel WHERE id='1'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$Page_Heading=$myrow[1];
		$Logo_Bk=$myrow[2];
		$LH_Bk=$myrow[3];
		$RH_Border=$myrow[4];
		$Login_Bk=$myrow[5];
		$Logo=$myrow[6];
		$Menu_Bk=$myrow[7];
		$Menu_Border=$myrow[8];
		$Menu_Text=$myrow[9];
		$Menu_Rollover=$myrow[10];
		$Table_Col=$myrow[11];
		$Button_Bk=$myrow[12];
		$Button_Text=$myrow[13];
	};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../cssmain.css" rel="stylesheet" type="text/css" />
<link href="../../css/general.php" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
<script language=JavaScript src="../../jscript/picker.js"></script>
<script language="Javascript1.2">
<!--

function MM_popupMsg(msg) { //v1.0
  alert(msg);
}

function SetDefaults(){
	var form=document.form2;
	form.Page_Heading.value="#000000";
	form.Logo_Bk.value="#121212";
	form.LH_Bk.value="#CCCCCC";
	form.RH_Border.value="#666666";
	form.Login_Bk.value="#cccccc";
	form.Menu_Bk.value="#F7F7F7";
	form.Menu_Border.value="#333333";
	form.Menu_Text.value="#000000";
	form.Menu_Rollover.value="#EEF2F9";
	form.Table_Col.value="#f3f3f3";
	form.Button_Bk.value="#003366";
	form.Button_Text.value="#FFFFFF";
	form.SetDefaultLogo.checked=true;
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
<div id="logo"><img src="../../i/logo.jpg" alt="logoalt" width="340" height="70" /></div>
<span class="head"></span>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="19%" valign="top" ><? include("../../menu_files/menunew.php");?>
<span class="head">
<?php if($SU) include("../SU/drop-down.php"); ?>
</span></td>
    <td width="81%" valign="top" class="rightside"><span class="pagetitle"><span class="pagetitle">Setup Administration Colour Scheme </span><span class="RedText"><?php print $Message; ?></span></h1>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><form action="colour-scheme.php"  method="post" enctype="multipart/form-data" name="form2" id="form2" >
                      <p>                You can define the colour scheme used within the Administration area. <br />
                Enter a Hex value eg; 003366 or use the colour picker by selecting the palette icon <img src="../../images/sel.gif" width="15" height="13" />. </p>
                      <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                        <tr>
                          <td width="172" height="25"><strong>Page Heading colour</strong></td>
                          <td width="343" height="25"><input name="Page_Heading" type="text" id="Page_Heading" value="<?php print $Page_Heading; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['Page_Heading'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25"><strong>Logo background colour</strong></td>
                          <td height="25"><input name="Logo_Bk" type="text" id="Logo_Bk" value="<?php print $Logo_Bk; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['Logo_Bk'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25"><strong>Left hand background colour</strong></td>
                          <td height="25"><input name="LH_Bk" type="text" id="LH_Bk" value="<?php print $LH_Bk; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['LH_Bk'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25"><strong>Right hand side border colour</strong></td>
                          <td height="25"><input name="RH_Border" type="text" id="RH_Border" value="<?php print $RH_Border; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['RH_Border'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25"><strong>Login/Logout background colour</strong></td>
                          <td height="25"><input name="Login_Bk" type="text" id="Login_Bk" value="<?php print $Login_Bk; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['Login_Bk'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25" valign="top"><strong>Upload logo (~360 x 70) <a href="javascript:;" onclick="MM_popupMsg('The logo appears at the top of the Admin area and the log in and log out pages.\r\rThe image should be 70 pixels high.\r\rTo preview: click the Preview icon.\rTo remove: click the Remove icon.')"><img src="../../images/help-button.gif" width="13" height="11" border="0" /></a></strong></td>
                          <td height="25"><input name="Logo" type="file" id="Logo" />
                              <br />
                              <a href="../../images/<?php print $Logo; ?>" target="_blank"><?php print $Logo; ?> <img src="../../images/preview.gif" alt="Preview" width="13" height="10" border="0" /></a><a href="#"><img src="../../images/remove.gif" alt="REMOVE" width="13" height="10" border="0" /></a> <br />
                              <input name="SetDefaultLogo" type="checkbox" id="SetDefaultLogo" value="1" />
                    Set Default Logo</td>
                        </tr>
                        <tr>
                          <td height="25"><strong>Menu background colour</strong></td>
                          <td height="25"><input name="Menu_Bk" type="text" id="Menu_Bk" value="<?php print $Menu_Bk; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['Menu_Bk'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25"><strong>Menu border colour</strong></td>
                          <td height="25"><input name="Menu_Border" type="text" id="Menu_Border" value="<?php print $Menu_Border; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['Menu_Border'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25"><strong>Menu text colour</strong></td>
                          <td height="25"><input name="Menu_Text" type="text" id="Menu_Text" value="<?php print $Menu_Text; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['Menu_Text'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25"><strong>Menu rollover colour</strong></td>
                          <td height="25"><input name="Menu_Rollover" type="text" id="Menu_Rollover" value="<?php print $Menu_Rollover; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['Menu_Rollover'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25"><strong>Table colour</strong></td>
                          <td height="25"><input name="Table_Col" type="text" id="Table_Col" value="<?php print $Table_Col; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['Table_Col'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25"><strong>Button colour</strong></td>
                          <td height="25"><input name="Button_Bk" type="text" id="Button_Bk" value="<?php print $Button_Bk; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['Button_Bk'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25"><strong>Button text colour</strong></td>
                          <td height="25"><input name="Button_Text" type="text" id="Button_Text" value="<?php print $Button_Text; ?>" size="10" />
                              <a href="javascript:TCP.popup(document.forms['form2'].elements['Button_Text'])"><img src="../../images/sel.gif" width="15" height="13" border="0" /></a> </td>
                        </tr>
                        <tr>
                          <td height="25">&nbsp;</td>
                          <td height="25"><input name="Button" type="button" class="formbuttons" value="Reset to Defaults" onclick="SetDefaults()" />
                              <input name="Submit" type="submit" class="formbuttons" id="Submit" value="Save" onclick="return confirmSubmit()" />
                              <a href="javascript:;" onclick="MM_popupMsg('Reset to Defaults button: resets colour scheme to the default colours. \r\rSave button: saves current colour scheme settings.')"><img src="../../images/help-button.gif" width="13" height="11" border="0" /></a></td>
                        </tr>
                      </table>
                  </form></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
            </table></td>
          </tr>
        </table>
        <p>&nbsp;</p></td>
  </tr>
</table>
<div id="midway">
<object type="application/x-shockwave-flash"
data="../../i/glimmer.swf" 
width="344" height="128">
<param name="movie" 
value="../../i/glimmer.swf" />
</object></div>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="19%">&nbsp;</td>
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
