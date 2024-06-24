<?
	if(!$_GET['TextColour']) $_GET['TextColour']="#FFFFFF";
	if(!$_GET['BGColour']){
		$_GET['BGColour']="#FFFFFFF";
	}else{
		$_GET['BGColour']="#".$_GET['BGColour'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.tableborder {border: 1px solid #FFFFFF;
}
.style9 {color: #999999}
-->
</style>
</head>

<body>
<table width="92%" border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder">
  <tr>
    <td align="center" bgcolor="<?=$_GET['BGColour'];?>"><form action="http://www.smsmailpro.com/addcontact.php" method="post" name="form1" id="form1">
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right"><span class="style9">Name : </span></td>
          <td align="center"><input name="Name" type="text" id="Name" size="15" /></td>
        </tr>
        <tr>
          <td align="right"><span class="style9">Email : </span></td>
          <td align="center"><input name="Email" type="text" id="Email" size="15" /></td>
        </tr>
        <tr>
          <td align="right"><span class="style9">Mobile : </span></td>
          <td align="center"><input name="Mobile" type="text" id="Mobile" size="15" /></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><a href="javascript: document.form1.submit()"><img src="../images/send.gif" width="68" height="15" border="0" /></a>
            <input name="Username" type="hidden" value="<?=$_GET['Username'];?>" />
                <input name="Redirect" type="hidden" value="http://www.smsmailpro.com/codes/standard-added.php" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>
