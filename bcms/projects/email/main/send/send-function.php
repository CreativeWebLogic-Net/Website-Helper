<?
//$user = "smsi4u";
//$password = "internet$4u";
//$api_id = "369305";
$user = "shayhan";
$password = "shayhan";
$api_id = "410101";
$baseurl ="http://api.clickatell.com";
$text = urlencode($Body);
$to = $To;
// auth call
$url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";
// do auth call
$ret = file($url);
// split our response. return string is on first line of the data returned
$sess = split(":",$ret[0]);
if ($sess[0] == "OK") {
$sess_id = trim($sess[1]); // remove any whitespace
$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text&from=$From";
//echo $url;
// do sendmsg call
$ret = file($url);
$send = split(":",$ret[0]);
if ($send[0] == "ID")
echo "success<br>message ID: ". $send[1];
else
echo "send message failed";
} else {
echo "Authentication failure: ". $ret[0];
exit();
}
?>

