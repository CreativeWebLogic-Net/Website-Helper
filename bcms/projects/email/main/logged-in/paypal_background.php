<?
	include("../../DB_Class.php");
	include("../../clsPayPal.php");
	
	$r=new ReturnRecord();
	$r->AddTable("paymentgateway_paypal");
	$r->AddSearchVar(1);
	$Insert=$r->GetRecord();
	
	$paypal=new paypal_receive();
	$paypal->process($Insert['MerchantAccount']);
?>