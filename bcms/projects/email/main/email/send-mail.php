<?
	include("../Admin_Include.php");
	
	$p->CheckPage(11);
	
	$Merge=new MergeEmail();
		
	$From=$_SESSION['FromName'];
	$FromEmail=$_SESSION['FromEmail'];
	
	$sq2 = $r->RawQuery("SELECT Name,Body FROM Email WHERE id='$_GET[EmailID]'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$Subject=$myrow[0];
		$Body=$myrow[1];
	};
	
	
	
	$m=new SendMail();
	$m->Body($Simple,$Plain,$HTML);
	$m->From($From,$FromEmail);
	$m->Subject($Subject);
	$m->Template("../../templates/$_SESSION[TemplatesID]/index.html");
	$l=new AddToDatabase();
	$l->AddTable("SentMessages");
	$End=$_SESSION['Start']+$_GET['interval'];
	for($x=$_SESSION['Start'];$x<$End;$x++){
		if($EmailCount->CanSendMore()){
			$Merge->SetMember($_SESSION['Emails'][$x]);
			$m->To(array(""=>$_SESSION['Emails'][$x]['Email']));
			$NewBody=$Body."<br>\n<hr> To Unsubscribe <a href='http://$_SERVER[HTTP_HOST]/unsubscribe.php?ClientsID=$ClientsID&Email=".$_SESSION['Emails'][$x]['Email']."'>Click Here</a> <br>\n To create your own email and sms marketing campaigns go to <a href='http://www.smsmailpro.com'>http://www.smsmailpro.com</a>";
			$NewBody=$Merge->MergeMessage($NewBody);
			
			$l->Reset();
			$l->AddExtraFields(array("LogsID"=>$_SESSION['LogsID'],"MsgID"=>"0","Email"=>$_SESSION['Emails'][$x]['Email']));
			$l->DoStuff();
			$EmailID=$l->ReturnID();
			$NewBody.="<img src='http://$_SERVER[HTTP_HOST]/viewed.php?id=$EmailID'>";
			$m->Merge(array("body"=>$NewBody));
			$m->Send();
		};
		
		
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
