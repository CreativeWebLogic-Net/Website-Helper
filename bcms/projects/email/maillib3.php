<?php 

/*$to_name = 'Daniel Ruul'; 
$to_email = 'dan@i4u.com.au'; 
$from_name = 'Your Name'; 
$from_email = 'you@youremail.com'; 
$subject = 'Mail Subject'; 
$body_simple = 'Simple content for non-mime-compliant clients'; 
$body_plain = 'Plain text content'; 
$body_html = '<html><head></head><body>html content</body></html>'; */

//echo api_email($to_name, $to_email, $from_name, $from_email, 
//$subject, $body_simple, $body_plain, $body_html); 

// mime email 
function api_email($to_name, $to_email, $from_name, $from_email, 
$subject, $body_simple, $body_plain, $body_html,$file="") 
{ 
//echo $to_name; 

$boundary = api_password(16);
$boundary2 = api_password(16);   
//$boundary ="----=_NextPart_000_00DC_01C470C1.AC59C5A0";
//$boundary2 ="----=_NextPart_001_00DD_01C470C1.AC59C5A0"; 
$headers = "From: \"".$from_name."\" <".$from_email.">\n"; 
//$headers .= "To: \"".$to_name."\" <".$to_email.">\n"; 
$headers .= "Return-Path: <".$from_email.">\n"; 
$headers .= "MIME-Version: 1.0\n"; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"\n\n"; 
//$headers .= "Content-Type: multipart/mixed;\n boundary=\"".$boundary."\"\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: Microsoft Outlook Express 6.00.2800.1106\nX-MimeOLE: Produced By Microsoft MimeOLE V6.00.2800.1106\n"; 
$headers .= $body_simple."\n\nThis is a multi-part message in MIME format.\n"; 
$headers .= "--".$boundary."\n"; 
$headers .="Content-Type: multipart/alternative;\n boundary=\"".$boundary2."\"\n\n";
$headers .= "--".$boundary2."\n"; 
$headers .= "Content-Type: text/plain;\n charset=\"ISO-8859-1\"\n"; 
//$headers .= "Content-Transfer-Encoding: 8bit\n\n";
$headers .= "Content-Transfer-Encoding: 8bit\n\n"; 
$headers .= $body_plain."\n"; 
$headers .= "--".$boundary2."\n"; 
$headers .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n"; 
$headers .= "Content-Transfer-Encoding: 8bit\n\n"; 
$headers .= $body_html."\n"; 
$headers .= "--".$boundary2."--\n"; 
if($file['name']){
	$headers .= "--".$boundary."\n"; 
	//echo "-------".$file['name'];
	$headers.="Content-Type: image/jpeg;\n name=\"".$file['name']."\"\nContent-Transfer-Encoding: base64\nContent-Disposition: attachment;\n  filename=\"".$file['name']."\"\n\n";
	$linesz= filesize( $file['tmp_name'])+1;
	$fp= fopen($file['tmp_name'], 'r' );
	$headers .= chunk_split(base64_encode(fread( $fp, $linesz)))."\n";
	fclose($fp);
	
}
$headers .= "--".$boundary."--\n"; 


mail($to_email, $subject, '', $headers); 


} 

// Generate random alphanumeric password 
function api_password($length = 8) 
{ 
srand((double) microtime() * 1000000); 
$alpha = array('a','b','c','d','e','f','g','h','i','j','k','l', 
'm','n','o','p','q','r','s','t','u','v','w','x','y','z'); 
$options = array('alpha','number'); 

for ($i = 0; $i < $length; $i++) 
{ 
$char = array_rand($options,1); 
if ($options[$char] == 'alpha') 
{ 
$random_letter = rand (0,25); 
$password .= $alpha[$random_letter]; 
} 
else 
{ 
$random_number = rand (0,9); 
$password .= $random_number; 
} 
} 
return $password; 
} 

?>
