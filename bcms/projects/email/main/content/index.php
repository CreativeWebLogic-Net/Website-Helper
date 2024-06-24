<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/general.php" rel="stylesheet" type="text/css">
<link href="../../menu_files/menu.php" rel="stylesheet" type="text/css"> 
<script language="JavaScript" src="../../menu_files/menu.js"></script>
<script language="JavaScript" src="../../menu_files/menu_items.php"></script>
<script language="JavaScript" src="../../menu_files/menu_tpl.js"></script>
<script language="JavaScript" src="../../jscript/htmlarea.js"></script>


</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td height="1" colspan="2"><!-- #BeginLibraryItem "/Library/mgr-header.lbi" -->
<?php
	include("../../../Library/database.php");
	$sq2 = mysql_query("SELECT * FROM LookFeel WHERE id='1'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$Logo=$myrow[6];
	};
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          
    <td class="head"><img src="/management/images/<?php print $Logo; ?>"></td>
        </tr>
      </table><!-- #EndLibraryItem --></td>
  </tr>
  <tr> 
    <td width="165" height="99%" valign="top" class="leftside"><!-- #BeginLibraryItem "/Library/mgr-menu.lbi" --><table width="100%" border="0" cellspacing="10" cellpadding="8">
        <tr> 
          <td> <script language="JavaScript">
<!--
	new menu (MENU_ITEMS0, MENU_POS0, null, null, ["fdiv"]);
//-->
</script> </td>
        </tr>
      </table><!-- #EndLibraryItem --></td>
    <td width="99%" height="99%" valign="top" class="rightside"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td> <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td><form  method="post" name="form2" >
                    <span class="pagetitle">Modify Content Pages<?php print $Message; ?></span><br>
                    <br>
                    <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                      <tr> 
                        <td><strong> Page Name</strong></td>
                        <td><strong>Title</strong></td>
                        <td align="center"><strong>Page Type</strong></td>
                        <td width="1%" align="center"><strong>Modify</strong></td>
                      </tr>
                      <tr> 
                        <td>About Us</td>
                        <td>Facts</td>
                        <td align="center">HTML</td>
                        <td align="center"><a href="iframe-mod.php?id=1"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                      </tr>
                      <tr> 
                        <td>About Us</td>
                        <td>Mission Statement</td>
                        <td align="center">HTML</td>
                        <td align="center"><a href="iframe-mod.php?id=2"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                      </tr>
                      <tr> 
                        <td>Services</td>
                        <td>Finance - Deposit Bonds</td>
                        <td align="center">HTML</td>
                        <td align="center"><a href="iframe-mod.php?id=3"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                      </tr>
                      <tr> 
                        <td>Services</td>
                        <td>Multi Lingual Speaking Staff</td>
                        <td align="center">HTML</td>
                        <td align="center"><a href="iframe-mod.php?id=4"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                      </tr>
                      <tr> 
                        <td>Services</td>
                        <td>Top Tips</td>
                        <td align="center">HTML</td>
                        <td align="center"><a href="iframe-mod.php?id=5"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                      </tr>
                      <tr> 
                        <td>Gold Coast Information</td>
                        <td>&nbsp;</td>
                        <td align="center">HTML</td>
                        <td align="center"><a href="iframe-mod.php?id=6"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                      </tr>
                      <tr> 
                        <td>Testimonials</td>
                        <td>&nbsp;</td>
                        <td align="center">HTML</td>
                        <td align="center"><a href="iframe-mod.php?id=7"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                      </tr>
                      <tr> 
                        <td>Disclaimer</td>
                        <td>&nbsp;</td>
                        <td align="center">HTML</td>
                        <td align="center"><a href="iframe-mod.php?id=8"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                      </tr>
                      <tr> 
                        <td>Privacy Policy</td>
                        <td>&nbsp;</td>
                        <td align="center">HTML</td>
                        <td align="center"><a href="iframe-mod.php?id=9"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                      </tr>
                    </table>
                    <br>
                    Only parts of the site are editable. To modify a page: clcik 
                    the &quot;Modify&quot; button and the page will open into 
                    a new window. After changes have been made - click the &quot;Save&quot; 
                    button. <br>
                  </form></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
