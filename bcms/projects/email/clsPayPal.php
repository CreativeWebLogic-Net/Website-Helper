<?php

class paypal_send{
	var $r;
	var $GatewayUrl;
	var $SuccessUrl;
	var $MerchantAccount;
	var $notify_url;
	
	function paypal_send($GatewayUrl,$MerchantAccount,$SuccessUrl,$NotifyUrl){
		$this->r=new ReturnRecord();
		$this->GatewayUrl=$GatewayUrl;
		$this->MerchantAccount=$MerchantAccount;
		$this->notify_url="http://".$_SERVER['HTTP_HOST'].$NotifyUrl;
		$this->SuccessUrl="http://".$_SERVER['HTTP_HOST'].$SuccessUrl;
	}
	
	function process($item_Number,$amount,$item_name,$currency="AUD",$delivery=0){
		$rslt=$this->r->RawQuery("INSERT INTO paypal_item_table (item_number,mc_gross,mc_currency) VALUES ('$item_Number','$amount','$currency')");
		if($rslt){
			echo'<form action="'.$this->GatewayUrl.'" method="post" name="frmBuy" id="frmBuy">
                <input name="cmd" type="hidden" id="cmd" value="_xclick" />
                <input name="amount" type="hidden" id="amount" value="'.$amount.'" />
                <input name="currency_code" type="hidden" id="currency_code" value="'.$currency.'" />
                <input name="handling" type="hidden" id="handling" value="'.$delivery.'" />
                <input name="notify_url" type="hidden" id="notify_url" value="'.$this->notify_url.'" />
                <input name="item_name" type="hidden" id="amount" value="'.$item_name.'" />
                <input name="item_number" type="hidden" id="item_number" value="'.$item_Number.'" />
                <input name="return" type="hidden" value="'.$this->SuccessUrl.'" />
                <br />
                <input name="business" type="hidden" id="business" value="'.$this->MerchantAccount.'" />
                <input type="submit" name="Submit" value="Click To Enter Payment Gateway" />
                <br />
              </form>';
		}else{
			echo mysql_error();
		}
	}
}

class paypal_receive{
	var $r;
	var $ErrorMail="dan@iwebbiz.com.au";
	
	function paypal_receive(){
		$this->r=new ReturnRecord();
		$this->ErrorMail="dan@iwebbiz.com.au";
	}
	
	function Success($item_number){
		$TmpArr=split("-",$item_number);
		$rslt=$this->r->rawQuery("SELECT NumberOfCredits FROM CreditsCost WHERE id=$TmpArr[0]");
		$data=mysql_fetch_row($rslt);
		$rslt=$this->r->rawQuery("UPDATE Clients SET EmailCredits=EmailCredits+$data[0] WHERE id=$TmpArr[1]");
	}
		
	function process($paypal_email){
		
		// email address where script should send notifications
		$error_email = $this->ErrorMail;
		
		// email header
		$em_headers  = "From: SMSMailPro <info@smsmailpro.com>\n";		
		$em_headers .= "Reply-To: info@smsmailpro.com\n";
		$em_headers .= "Return-Path: info@smsmailpro.com\n";
		$em_headers .= "Organization: SMSMailPro\n";
		$em_headers .= "X-Priority: 3\n";
		
		$paypal_info = $_POST;
		$paypal_ipn = new paypal_ipn($paypal_info);
		
		foreach ($paypal_ipn->paypal_post_vars as $key=>$value) {
			if (getType($key)=="string") {
				eval("\$$key=\$value;");
			}
		}
		
		$paypal_ipn->send_response();
		$paypal_ipn->error_email = $error_email;
		
		if (!$paypal_ipn->is_verified()) {
			$paypal_ipn->error_out("Bad order (PayPal says it's invalid)" . $paypal_ipn->paypal_response , $em_headers);
			die();
		}
		
		
		switch( $paypal_ipn->get_payment_status() )
		{
			case 'Pending':
				
				$pending_reason=$paypal_ipn->paypal_post_vars['pending_reason'];
							
				if ($pending_reason!="intl") {
					$paypal_ipn->error_out("Pending Payment - $pending_reason", $em_headers);
					break;
				}
		
		
			case 'Completed':
				
				$qry= "SELECT i.mc_gross, i.mc_currency FROM paypal_item_table as i WHERE i.item_number='$item_number'";
				$res=$this->r->RawQuery($qry);
				$config=mysql_fetch_array($res);
			
				if ($paypal_ipn->paypal_post_vars['txn_type']=="reversal") {
					$reason_code=$paypal_ipn->paypal_post_vars['reason_code'];
					$paypal_ipn->error_out("PayPal reversed an earlier transaction.", $em_headers);
					// you should mark the payment as disputed now
				} else {
							
					if ((strtolower(trim($paypal_ipn->paypal_post_vars['business'])) == $paypal_email) && (trim($mc_currency)==$config['mc_currency']) && (trim($mc_gross)-$tax == $quantity*$config['mc_gross'])) {
		
						$qry="INSERT INTO paypal_table VALUES (0 , '$payer_id', '$payment_date', '$txn_id', '$first_name', '$last_name', '$payer_email', '$payer_status', '$payment_type', '$memo', '$item_name', '$item_number', $quantity, $mc_gross, '$mc_currency', '$address_name', '".nl2br($address_street)."', '$address_city', '$address_state', '$address_zip', '$address_country', '$address_status', '$payer_business_name', '$payment_status', '$pending_reason', '$reason_code', '$txn_type')";
						
						
						if ($this->r->RawQuery($qry)) {
		
							$paypal_ipn->error_out("This was a successful transaction", $em_headers);			
							// you should add your code for sending out the download link to your customer at $payer_email here.
							$this->Success($item_number);
		
						} else {
							$paypal_ipn->error_out("This was a duplicate transaction", $em_headers);
						} 
					} else {
						$paypal_ipn->error_out("Someone attempted a sale using a manipulated URL", $em_headers);
					}
				}
				break;
				
			case 'Failed':
				// this will only happen in case of echeck.
				$paypal_ipn->error_out("Failed Payment", $em_headers);
			break;
		
			case 'Denied':
				// denied payment by us
				$paypal_ipn->error_out("Denied Payment", $em_headers);
			break;
		
			case 'Refunded':
				// payment refunded by us
				$paypal_ipn->error_out("Refunded Payment", $em_headers);
			break;
		
			case 'Canceled':
				// reversal cancelled
				// mark the payment as dispute cancelled		
				$paypal_ipn->error_out("Cancelled reversal", $em_headers);
			break;
		
			default:
				// order is not good
				$paypal_ipn->error_out("Unknown Payment Status - " . $paypal_ipn->get_payment_status(), $em_headers);
			break;
		
		} 

	}
}

class paypal_ipn
{
	var $Target=array("Production"=>array("Domain"=>"www.paypal.com","URI"=>"/cgi-bin/webscr"),"Testing"=>array("Domain"=>"www.sandbox.paypal.com","URI"=>"/cgi-bin/webscr"));
	var $IPNType="Production";// Production or Testing
	var $paypal_post_vars;
	var $paypal_response;
	var $timeout;

	var $error_email;
	
	function paypal_ipn($paypal_post_vars) {
		$this->paypal_post_vars = $paypal_post_vars;
		$this->timeout = 120;
	}

	function send_response()
	{
		$fp = @fsockopen($this->Target[$this->IPNType]["Domain"], 80, $errno, $errstr, 120 ); 

		if (!$fp) { 
			$this->error_out("PHP fsockopen() error: " . $errstr , "");
		} else {
			foreach($this->paypal_post_vars AS $key => $value) {
				if (@get_magic_quotes_gpc()) {
					$value = stripslashes($value);
				}
				$values[] = "$key" . "=" . urlencode($value);
			}

			$response = @implode("&", $values);
			$response .= "&cmd=_notify-validate";

			fputs( $fp, "POST ".$this->Target[$this->IPNType]["URI"]." HTTP/1.0\r\n" ); 
			fputs( $fp, "Content-type: application/x-www-form-urlencoded\r\n" ); 
			fputs( $fp, "Content-length: " . strlen($response) . "\r\n\n" ); 
			fputs( $fp, "$response\n\r" ); 
			fputs( $fp, "\r\n" );

			$this->send_time = time();
			$this->paypal_response = ""; 

			// get response from paypal
			while (!feof($fp)) { 
				$this->paypal_response .= fgets( $fp, 1024 ); 

				if ($this->send_time < time() - $this->timeout) {
					$this->error_out("Timed out waiting for a response from PayPal. ($this->timeout seconds)" , "");
				}
			}

			fclose( $fp );

		}

	}
	
	function is_verified() {
		if( ereg("VERIFIED", $this->paypal_response) )
			return true;
		else
			return false;
	} 

	function get_payment_status() {
		return $this->paypal_post_vars['payment_status'];
	}

	function error_out($message, $em_headers)
	{

		$date = date("D M j G:i:s T Y", time());
		$message .= "\n\nThe following data was received from PayPal:\n\n";

		@reset($this->paypal_post_vars);
		while( @list($key,$value) = @each($this->paypal_post_vars)) {
			$message .= $key . ':' . " \t$value\n";
		}
		mail($this->error_email, "[$date] paypay_ipn notification", $message, $em_headers);

	}
} 

?>