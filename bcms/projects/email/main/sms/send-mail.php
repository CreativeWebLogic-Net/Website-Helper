<?
	include("../Admin_Include.php");
	
	$p->CheckPage(11);

	$click=new SMS();
	$FromName="SMSMailPro";//$_SESSION['FromName'];
	$click->SetFrom($FromName);
	$sq2 = $r->RawQuery("SELECT Name,Body FROM SMS WHERE id='$_GET[EmailID]'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$Subject=$myrow[0];
		$Body=$myrow[1];
	};
	
	$click->SetMessage($Body);
	
	$l=new AddToDatabase();
	$l->AddTable("SentSMS");
	$End=$_SESSION['Start']+$_GET['interval'];
	$To=array();
	for($x=$_SESSION['Start'];$x<$End;$x++){
		if($EmailCount->CanSendMore()){
			if(!in_array($_SESSION['Emails'][$x]['Mobile'],$To)){
				$rslt=$r->RawQuery("SELECT EmailCredits FROM Clients WHERE id=$_SESSION[ClientsID]");
				$data=mysql_fetch_array($rslt);
				if(($data[0]>19)&&($_SESSION['Emails'][$x]['Mobile']!="")){
					$To[]=$_SESSION['Emails'][$x]['Mobile'];
					$click->AddTo($_SESSION['Emails'][$x]['Mobile']);
					$r->RawQuery("UPDATE Clients SET EmailCredits=EmailCredits-20 WHERE id=$_SESSION[ClientsID]");
				}
			}
		};
	}
	$click->Send();
	
	$MsgIds=$click->GetMsgID();
	
	foreach($MsgIds as $key=>$val){
		$l->Reset();
		$l->AddExtraFields(array("LogsID"=>$_SESSION['LogsID'],"MsgID"=>$val,"Mobile"=>$key));
		$l->DoStuff();
	} 
	
	$_SESSION['Start']+=$_GET['interval'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script>


function SendReply(){
	window.parent.Return();
}
</script>
</head>
<body onLoad="SendReply();">
</body>
</html>
