<?
	if(!$_GET['TextColour']){
		$_GET['TextColour']="#FFFFFF";
	}else{
		$_GET['TextColour']="#".$_GET['TextColour'];
	} 
	if(!$_GET['BGColour']){
		$_GET['BGColour']="#666666";
	}else{
		$_GET['BGColour']="#".$_GET['BGColour'];
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style6 {color: <?=$_GET['TextColour'];?>}
.tableborder {border: 1px solid #E1D6C6;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>

<body>
<table width="100%" height="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="tableborder">
  <tr>
    <td align="center" bgcolor="<?=$_GET['BGColour']?>"><form action="http://www.smsmailpro.com/addcontact.php" method="post" name="form1" id="form1">
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="right"><span class="style6">Name : </span></td>
          <td align="center"><input name="Name" type="text" id="Name" size="15" /></td>
        </tr>
        <tr>
          <td align="right"><span class="style6">Email : </span></td>
          <td align="center"><input name="Email" type="text" id="Email" size="15" /></td>
        </tr>
        <tr>
          <td align="right"><span class="style6">Mobile : </span></td>
          <td align="center"><input name="Mobile" type="text" id="Mobile" size="15" /></td>
        </tr>
        <tr>
          <td height="24" colspan="2" align="center" valign="middle"><input type="submit" name="Submit" value="Submit" />
                <input name="Username" type="hidden" value="<?=$_GET['Username'];?>" />
				<input name="Group" type="hidden" value="Developers" />
            <input name="Redirect" type="hidden" value="http://www.smsmailpro.com/codes/standard-added.php" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>
