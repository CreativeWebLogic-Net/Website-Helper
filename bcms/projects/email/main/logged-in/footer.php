<?php
	include("../Admin_Include.php");
	
		
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style></head>

<body>
<table width="100%" height="32" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td valign="middle" background="../Pics/footerBg.gif"><div class="footer">
      
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="53%">&nbsp;Design Development Promotion <a href="#" target="mainFrame">IWebBiz</a>.com.au &amp; LeisureCom.com </td>
            <form action="../logged-in/frameset.php" method="post" name="frmSUClient" target="_top">
			<td width="47%" align="right">
              <?php if($_SESSION['SU']) include("../SU/drop-down.php"); ?>
            </td>
			</form>
          </tr>
        </table>
      
    </div></td>
  </tr>
</table>
</body>
</html>