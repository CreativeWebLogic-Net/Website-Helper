<?php
//Set the username to the user on the server 
$username="customer";  // home directory
$pgp="/usr/bin/gpg"; // path to gpg binary
// User that is the private key sending the e-mail (In the from address etc..) 
$user="Geoff Toogood <geoff.toogood@hushmail.com>";
//This is the recipients public key 
$recp="geoff.toogood@hushmail.com";
// This is the email receipient of the encryted email
$receipient="Geoff Toogood <geoff.toogood@hushmail.com>";
$bday = date("j/n/Y", date("U") + ($i-1)*24*60*60 );
$data = "Transaction # ".$trans."\n <br> Client=".$Client['Name']." \n wants ".$n." credits \n <br> Credit Card Type = ".$cc_type."\n <br> Credit Card Number = ".$cc_number."\n <br> Expiry = ".$cc_expire_month."/".$cc_expire_year;
$subject="SMSGateway : PGP encryted email ";
$header="From: $user"; 
$homedir = "/root/.gnupg";
$command = 'echo "'.$data.'" | '.$pgp.' --homedir '.$homedir.' -a --always-trust --batch --no-secmem-warning -e -r "'.$recp.'"' ;
$oldhome = getEnv("HOME");
putenv("HOME=$username"); 
$result = exec($command,$encrypted,$errorcode); 
putenv("HOME=$oldhome");
$message = implode("\n", $encrypted);
mail($receipient,$subject,$message,$header); 
?> 
