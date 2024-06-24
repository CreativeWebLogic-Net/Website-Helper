<?
	if($_GET['status']=="004"){
		include("DB_Class.php");
		
		$r=new ReturnRecord();
		
		$sq2 = $r->RawQuery("SELECT SentSMS.id,Clients.id FROM SentSMS,Logs,Clients WHERE SentSMS.LogsID=Logs.id AND Logs.ClientsID=Clients.id AND MsgID='$_GET[apiMsgId]'",$db);
		while ($myrow = mysql_fetch_row($sq2)) {
			$SentMessagesID=$myrow[0];
			$ClientsID=$myrow[1];
		};
		//echo $Credits;
		$ActualCost=$_GET['charge']*8;
		$CreditsCost=20-$ActualCost;
		
		$Body="$ActualCost $CreditsCost\n";
		
		$SQL="UPDATE Clients SET EmailCredits=EmailCredits+$CreditsCost WHERE id=$ClientsID";
		$r->RawQuery($SQL);
		$Body.=$SQL;
		
		$m=new UpdateDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddTable("SentSMS");
		$m->AddID($SentMessagesID);
		$m->AddExtraFields(array("Cost"=>$ActualCost));
		$m->DoStuff();
		
		
	}
	foreach($_GET as $key=>$val){
		$Body.="\n".$key."=".$val;
	}
	mail('dan@iwebbiz.com.au', "sms reply", $Body, $this->headers)
?>