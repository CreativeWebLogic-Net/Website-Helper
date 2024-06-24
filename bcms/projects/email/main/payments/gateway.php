<?php
	include("../Admin_Include.php");
	include("../../clsPayPal.php");
	

	if($_POST['Submit']){
		$r=new ReturnRecord();
		$r->AddTable("paymentgateway_paypal");
		$r->AddSearchVar(1);
		$Insert=$r->GetRecord();
		
		$sq2 = $r->RawQuery("SELECT Cost,NumberOfCredits FROM CreditsCost WHERE id=$_POST[PaymentID]",$db);
		$data=mysql_fetch_row($sq2);
		
		$GoodsTotal=$data[0];
		
		$SuccessUrl="/main/payments/frameset.php";
		$NotifyUrl="/main/payments/paypal_background.php";
		
		$Items="$data[1] credits at SMSMailPro.com";
		
		$paypal=new paypal_send($Insert['GatewayUrl'],$Insert['MerchantAccount'],$SuccessUrl,$NotifyUrl);
		
		
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

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
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
<body onload="document.frmBuy.submit()">
<div id="skipnav"><a href="#content" tabindex="1" title="Skip Navigation" accesskey="2">Skip Navigation</a></div>
<div id="logo"></div>
<span class="head"></span><br />
    <? include("../credit_meter.php");?>
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right" valign="top" >&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"  class="rightside"><span class="pagetitle"><span class="pagetitle">Loading Payment Gateway   </span><span class="RedText"><?php print $Message; ?></span></h1>
      <p><span class="tableDecor">
        <? $paypal->process($_POST['PaymentID']."-".$_SESSION['AdminKey'],$GoodsTotal,$Items);?>
    </span></p></td>
  </tr>
</table>
<div id="midway"></div>
</body>
</html>
