<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(14);
	
	include("../../functions.inc.php");
	
	if($_SESSION['Account_Max']>$_SESSION['Account_Count']){
		print $_SESSION['MAIL_HOST'][$_SESSION['Account_Count']]."-";
		print $_SESSION['USER_NAME'][$_SESSION['Account_Count']]."<br>";
		$_SESSION['inbox'] = imap_open ("{". $_SESSION['MAIL_HOST'][$_SESSION['Account_Count']] . "/pop3:110}",
		$_SESSION['USER_NAME'][$_SESSION['Account_Count']], $_SESSION['USER_PASS'][$_SESSION['Account_Count']]) or print "error connecting to pop3 server";
		
		// get number of messages
		$_SESSION['total'] = imap_num_msg($_SESSION['inbox']);
		echo "total messages = $_SESSION[total] <br>";
		$_SESSION['Account_Count']++;
	?>
	
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<title>Untitled Document</title>
</head>
<script language="JavaScript" type="text/JavaScript">
<!--
		//document.location.href=document.location.href;

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>

<body onload="document.location.href=document.location.href">
<?
	for($x1=$_SESSION['total']; $x1>0; $x1--)
		{
		  
			// get header and structure
			$headers = imap_header($_SESSION['inbox'], $x1);
			$To= htmlspecialchars($headers->toaddress);
			//print "To: ".$To."<br>";
		  //if (eregi($ServerName, $To)){
			$struct = imap_fetchstructure($_SESSION['inbox'], $x1);
			//$body=imap_body($inbox, $x1);
			//echo"<br>----------Message $x1<br>";
			
			// 
			$From= htmlspecialchars($headers->fromaddress);
			
			$Subject= htmlspecialchars($headers->subject);
			print "Subject: ".$Subject."<br>";
			$Date= date("Y/m/d H:i:s",strtotime(htmlspecialchars($headers->Date)));
			//print "Date: ".$Date."<br>";
			//echo"===============<br>";
			$body="";
			$LTo=split ("@", $To);
			//echo"==$LTo[0]==";
			$UserKey=$AKey;
			$Folder=1;
			//if (eregi($ServerName, $To)){
			/*
			$sql = $r->RawQuery("SELECT Address,ToFolder from Email_Blocks where Eid='$UserKey'",$db);
        	while ($myrow = mysql_fetch_row($sql)) {
				if (eregi($myrow[0],$From)){
					$Folder=$myrow[1];
				};
			};
			*/
			
			$sql = $r->RawQuery("select Max(id) FROM EMessage",$db);
			while ($myrow = mysql_fetch_row($sql)) {
				$MessageKey=$myrow[0]+1;
			};	
			$sql2= "INSERT INTO EMessage (id,Seen,ClientsID,FromAddress,Subject,Date,Email_FoldersID,MTo) VALUES ('$MessageKey','False','$ClientsID','$From','$Subject','$Date','$Folder','$To')";
             		$result = $r->RawQuery($sql2);
			 		if ($result){
						echo"Your Email has been securely delivered<br>";
			 		}else{
						echo"Error-$sql2";
					};
						
			
			$parts = $struct->parts;
			if ($struct->type) {
				for ($x=0;$x<sizeof($parts);$x++) {
					$type = $parts[$x]->type;					
					$mime_type = mimetype($parts[$x]->type) . "/" . strtolower($parts[$x]->subtype);
					//print "Part $x=".$mime_type."<br>";
					$part_needed = ($x + 1);
					if (eregi("html", $mime_type)) {
						if ($parts[$x]->encoding==3){
							$body.=base64_decode(imap_fetchbody($_SESSION['inbox'], $x1, $part_needed, FT_UID));
						}else{
							$body.=imap_fetchbody($_SESSION['inbox'], $x1, $part_needed, FT_UID);
						};	
					};
					if (!eregi("text", $mime_type)) {
						$dpara = $parts[$x]->dparameters;
						for ($v=0;$v<sizeof($dpara);$v++) {
							if (eregi("filename", $dpara[$v]->attribute)) {
								$fname = $dpara[$v]->value;
							};
						};
						if (empty($fname)) {
							$para = $parts[$x]->parameters;
							for ($v=0;$v<sizeof($para);$v++) {
								if (eregi("name", $para[$v]->attribute)) {
									$fname = $para[$v]->value;
								};
							};
						};
						//echo"<br>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br>";
						//print "Part $x=".$mime_type."<br>";
						//echo"<br>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br>";
						$part_needed = ($x + 1);
						//print "File Name=".$fname."<br>";
						//print "Size =".$parts[$x]->bytes."<br>";
						$Att= imap_fetchbody($_SESSION['inbox'], $x1, $part_needed, FT_UID);
						$sql2= "INSERT INTO Attachments (EMessageID,FileName,MimeType,Body) VALUES ('$MessageKey','$fname','$mime_type','$Att')";
             			$result = $r->RawQuery($sql2);
			 			if ($result){
							//echo"Your Attatchment $fname added<br>";
							$fname="";
						};
						//echo"<br>==========================================================<br>";
					};
												
					if ($type == 1) {
						# Multipart in multipart
						$sparts = $parts[$x]->parts;
						for ($c=0;$c<sizeof($sparts);$c++) {
							$mime_type = mimetype($sparts[$c]->type) . "/" . strtolower($sparts[$c]->subtype);
							//print "Part $x.$c=".$mime_type."<br>";
							$part_needed = ($x + 1) . "." . ($c + 1);
							if (eregi("html", $mime_type)) {
								if ($parts[$x]->encoding==3){
									$body.=base64_decode(imap_fetchbody($_SESSION['inbox'], $x1, $part_needed, FT_UID));
								}else{
									$body.=imap_fetchbody($_SESSION['inbox'], $x1, $part_needed, FT_UID);
								};
							};
							if (!eregi("text", $mime_type)) {
								$dpara = $sparts[$c]->dparameters;
								for ($v=0;$v<sizeof($dpara);$v++) {
									if (eregi("filename", $dpara[$v]->attribute)) {
										$fname = $dpara[$v]->value;
									};
								};
								if (empty($fname)) {
									$para = $sparts[$c]->parameters;
									for ($v=0;$v<sizeof($para);$v++) {
										if (eregi("name", $para[$v]->attribute)) {
											$fname = $para[$v]->value;
										};
									};
								};
								//echo"<br>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br>";
								//print "Part $x.$c=".$mime_type."<br>";
								//echo"<br>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br>";
								$part_needed = ($x + 1) . "." . ($c + 1);
								//print "File Name=".$fname."<br>";
								//print "Size =".$sparts[$c]->bytes."<br>";
								$Att= imap_fetchbody($_SESSION['inbox'], $x1, $part_needed, FT_UID);
								$sql2= "INSERT INTO Attachments (EMessageID,FileName,MimeType,Body) VALUES ('$MessageKey','$fname','$mime_type','$Att')";
             					$result = $r->RawQuery($sql2);
			 					if ($result){
									//echo"Your Attatchment $fname added<br>";
									$fname="";
								};
								//echo"<br>==========================================================<br>";
							};		
						};			
					};
				};						
			}else {	
				//echo "Not multipart<br>";
				$body=eregi_replace("\n","<br>",imap_body($_SESSION['inbox'], $x1));			
			};
			//echo"<br>----------------------------------<br>";
			//print $body;
			//echo"<br>----------------------------------<br>";
			$body=addslashes($body);
			$sql2= "UPDATE EMessage set TextBody='$body' WHERE id='$MessageKey'";
            $result = $r->RawQuery($sql2);
			$body="";
			// table rows here
			imap_delete($_SESSION['inbox'], $x1);
			//echo"<br>==========================================================<br>";
			flush();
		   };imap_close($_SESSION['inbox'], CL_EXPUNGE);
?>
</body>
</html>
<?
	}else{
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<title>Untitled Document</title>
</head>
<body>
		Done Downloading Mail
</body>
</html>
		<?
	};	

		
?>
