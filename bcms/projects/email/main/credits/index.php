<?php
	//$SecureKey=base64_decode($SecureKey);
	//print $SecureKey;
	//
	session_start();
	$SecureKey=stripslashes($SKey);
	if(!$_SESSION['SecureKey']){
		header("Location: ../../index.php");
	};
	include("../../cast128.php");
	$e = new cast128;
	$e->setkey("kjhnsdf fdsiohjf fasdujhf asduijdsi");
	$TmpKey=split("-",$e->decrypt($_SESSION['SecureKey']));
	$AdminKey=$TmpKey[0];
	$ClientsID=$TmpKey[1];
	$Theme=$TmpKey[2];
	session_register("SecureKey");
	//print_r($TmpKey);
	
?>
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
<script language="JavaScript" src="../../jscript/validate_card2.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function confirmSubmit()
{
	var agree=confirm("Are you sure you wish to continue?");
	if (agree)
	{
		return true ;
	}
	else
	{
		return false ;
	}
}

function credChange() {
	var newPType = document.getElementById('check');
	var PTypeVal = newPType.checked;
	var cred = document.getElementById('creditIn');
	if(PTypeVal)
	{
		var temcred;
		temcred ='<table width="100%" border="0" cellspacing="1" cellpadding="3" id="tablecell"><tr><td width="186" ><strong>Card Type</strong></td><td width="240"><select name="cc_type" id="cc_type" class="input">';
		temcred +='<option value="MasterCard">MasterCard</option>';
		temcred +='<option value="Visa">VisaCard</option>';
		temcred +='<option value="AmEx">AmExCard</option>';
		temcred +='<option value="Diners Club">DinersClubCard</option>';
		temcred +='<option value="Discover">DiscoverCard</option>'
		temcred +='<option value="enRoute">enRouteCard</option>';
		temcred +='<option value="JCB">JCBCard</option></select></td></tr>';
  		temcred +='<tr><td><strong>Name On Card</strong></td>';
    	temcred +='<td><input name="cc_name" type="text" class="input" size="30"></td></tr>';
		temcred +='<tr><td><strong>Card Number</strong></td>';
		temcred +='<td><input name="cc_number" type="text" class="input" size="30"></td></tr>';
		temcred +='<tr><td><strong>Expiry Date</strong></td>';
		temcred +='<td><select name="cc_expire_month" class="input">';
		temcred +='<option value="00" selected>Month</option>';
		temcred +='<option value="01">01</option>';
		temcred +='<option value="02">02</option>';
		temcred +='<option value="03">03</option>';
		temcred +='<option value="04">04</option>';
		temcred +='<option value="05">05</option>';
		temcred +='<option value="06">06</option>';
		temcred +='<option value="07">07</option>';
		temcred +='<option value="08">08</option>';
		temcred +='<option value="09">09</option>';
		temcred +='<option value="10">10</option>';
		temcred +='<option value="11">11</option>';
		temcred +='<option value="12">12</option></select>';
		temcred +='<select name="cc_expire_year" class="input">';
		temcred +='<option value="00" selected>Year</option>';
		temcred +='<option value="2001">2001</option>';
		temcred +='<option value="2002">2002</option>';
		temcred +='<option value="2003">2003</option>';
		temcred +='<option value="2004">2004</option>';
		temcred +='<option value="2005">2005</option>';
		temcred +='<option value="2006">2006</option>';
		temcred +='<option value="2007">2007</option>';
		temcred +='<option value="2008">2008</option>';
		temcred +='<option value="2009">2009</option>';
		temcred +='<option value="2010">2010</option></select></td></tr></table>';
		cred.innerHTML = temcred;
	}
	else
	{
		cred.innerHTML = "";
	}
}

function determinePayment(formName){
	var newPType = document.getElementById('check');
	var PTypeVal = newPType.checked;
	var succeed = false;
	if(PTypeVal)
	{
			if(CheckCardNumber(formName))
			{
				succeed = true;
			}
			else
			{
				succeed = false;
			}
	}
	else
	{
		succeed = true;
	}
	return succeed;
}
//-->
</script>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td height="1" colspan="2">
      <?php
	include("database.php");
	$sq2 = mysql_query("SELECT * FROM LookFeel WHERE id='1'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$Logo=$myrow[6];
	};
?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="77%" class="head"><img src="../../images/<?php print $Logo; ?>"></td>
		  <td width="23%" align="right" class="head"><?php if($SU) include("../SU/drop-down.php"); ?></td>
        </tr>
      </table></td>
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
          <td> 
		  	  <form action="./buy.php" method="post" onSubmit="return determinePayment(this);return false;return confirmSubmit();">
			  <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td><strong>Request Credits <br>
                  <br>
				  <div align="center">Pay By Credit? <input type="checkbox" id="check" onClick="credChange()"></input></div>
                </strong>
				<span id="creditIn"></span>
				<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" id="tablecell">
                    <tr>
                      <td width="225"><div align="center"><strong>Number Of Credits </strong></div></td>
                      <td width="240"><div align="center"><strong>Cost Per Credit </strong></div></td>
                      <td width="43"><div align="center"><strong>Buy</strong></div></td>
                    </tr>
                    <tr>
                      <td><div align="center">1000 </div></td>
                      <td><div align="center">15c</div></td>
                      <td><input type="radio" name="credAmoun" value="1000#15"></input><!--<a href="buy.php?n=1000"><img src="../../images/select.gif" width="47" height="12" border="0"></a>--></td>
                    </tr>
                    <tr>
                      <td><div align="center">5000</div></td>
                      <td ><div align="center">14c</div></td>
                      <td ><input type="radio" name="credAmoun" value="5000#14"></input><!--<a href="buy.php?n=5000"><img src="../../images/select.gif" width="47" height="12" border="0"></a>--></td>
                    </tr>
                    <tr>
                      <td height="25" ><div align="center">10000 </div></td>
                      <td height="25" ><div align="center">13c</div></td>
                      <td height="25" ><input type="radio" name="credAmoun" value="10000#13"></input><!--<a href="buy.php?n=10000"><img src="../../images/select.gif" width="47" height="12" border="0"></a>--></td>
                    </tr>
                    <tr>
                      <td height="25" ><div align="center">20000</div></td>
                      <td height="25" ><div align="center">12c</div></td>
                      <td height="25" ><input type="radio" name="credAmoun" value="20000#12"></input><!--<a href="buy.php?n=20000"><img src="../../images/select.gif" width="47" height="12" border="0"></a>--></td>
                    </tr>
                  </table>
                <span class="style1">                  </span></td>
              </tr>
            </table>
			<div align="center"><input type="submit" name="submit" value="Submit" class="formbuttons"></div>
			</form>
			</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
