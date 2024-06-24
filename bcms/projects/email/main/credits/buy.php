<?php
	session_start();
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
	if($credAmoun){
		include("../../maillib3.php");
		include("../../DB_Class.php");
		
		$cred = explode("#",$credAmoun);
		$n = $cred[0];
		
		$c= new ReturnRecord();
		$c->AddTable("Clients");
		$c->AddSearchVar($ClientsID);
		$Client=$c->GetRecord();
		
		if($cc_type)
		{
			include("../../functions.inc.php");
			$trans = str_makerand(5,10);
			include("./testgpg.php");
			$mess = "Client=".$Client['Name']." \n wants ".$n." credits \n <br> Payed By Credit Card (Check Hushmail Account) \n <br> Transaction # ".$trans;
			/*If payed by credit*/ api_email("I4U SMS Requests","sms@internet4u.com.au",$Client['Name'],$Client['Email'], "I4U SMS Credit Request",strip_tags($mess),strip_tags($mess),$mess);
		}
		else
		{
			//accounts@i4u.com.au
			api_email("I4U SMS Requests", "accounts@i4u.com.au",$Client['Name'], $Client['Email'], "I4U SMS Credit Request","Client=".$Client['Name']." \n wants $n credits","Client=".$Client['Name']." \n wants $n credits", "Client=".$Client['Name']." <br> wants $n credits"); 
		} 
		$Message="Email Sent we will contact you as soon as possible"; 
		
	};
	
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
          <td> <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td><div align="left"><strong>Thank you for your order an invoice for the credits has been issued, on payment your credits will be activated.  </strong></div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
