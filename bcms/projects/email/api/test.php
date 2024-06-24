<?
	$xml='<?xml version="1.0" encoding="iso-8859-1"?>
<smsmailpro_api>
	<version>1.0</version>
	<authentication>
		<message_id>666</message_id>
		<client_guid>jEKPrnC8rKwfiW8xPqaXyz0bDyhIyQwA</client_guid>
		<username>dan</username>
		<password>tset</password>
		<token>d7m3w9dmjmdudmmeiud</token>
	</authentication>
	<commands>
		
		
		<command>
			<command_request_guid>asdasdacvcxfdsfdsff</command_request_guid>
			<type>send_sms</type>
			<details>
				<from>0433204582</from>
				<send_datetime>2008-06-08 23:00:00</send_datetime>
				<body>xxx</body>
				<log_title>log xxx</log_title>
				<numbers>
					<number number_guid="hydyugdsa7dyxcbjhcx">61433204582</number>
				</numbers>
			</details>
		</command>
		
		
	</commands>
</smsmailpro_api>';
$posturl="http://smsmailpro.com/api/api.php";
	$ch = curl_init ($posturl);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_USERAGENT, "ie");
	//curl_setopt($ch, CURLOPT_PORT, 6020);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $xml);
	//curl_setopt ($ch, CURLOPT_FILE, $fh); 
	$return=curl_exec($ch);
	echo"<br>=xxx====$return======".curl_error($ch);
	curl_close($ch);
	


?>