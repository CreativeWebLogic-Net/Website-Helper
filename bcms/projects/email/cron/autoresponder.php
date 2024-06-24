#!/usr/bin/php -q
<?
	
	$CurrentDir=dirname(__FILE__);
	
	print $CurrentDir;
	include("../DB_Class.php");
	include("../Mail_Class.php");
	include("../SMS_Class.php");
	include("../MergeEmail_Class.php");
	include("../CountEmails_Class.php");
	
	$r=new ReturnRecord();
	$m=new SendMail();
	$e=new MergeEmail();

	// do email messages
	$rslt=$r->RawQuery("SELECT DISTINCT  AR_Users.id,LastSent,EmailID,MInterval,IntervalType,Members.Email,TemplatesID,Members.Name,FromName,FromEmail,Members.ClientsID,Members.id,AdministratorsID,SMSID,Mobile FROM Members,AR_Users,AR_Messages,AR_Stream WHERE Members.id=AR_Users.MembersID AND AR_Users.AR_StreamID=AR_Messages.AR_StreamID AND  AR_Users.QueuePos=AR_Messages.QueuePos AND AR_Users.AR_StreamID=AR_Stream.id AND Members.Unsubscibe='No'");
	while($myrow=mysql_fetch_array($rslt)){
		
		
		
		$EmailCount=new CountEmails($myrow[10]);
		if($EmailCount->CanSendMore()){
			$DateTimeArray=split(" ",$myrow[1]);
			$DateArray=split("-",$DateTimeArray[0]);
			$Year=$DateArray[0];
			$Month=$DateArray[1];
			$Day=$DateArray[2];
			$TimeArray=split("\:",$DateTimeArray[1]);
			$Hour=$TimeArray[0];
			$Minute=$TimeArray[1];
			$Second=$TimeArray[2];
			$Now=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
			if($myrow[4]=="Hours"){
				$Hour+=$myrow[3];
			}else{
				$Day+=$myrow[3];
			}
			$NextMessage=mktime($Hour,$Minute,$Second,$Month,$Day,$Year);
			if($Now>=$NextMessage){
				
				echo"$myrow[0] $myrow[2] $myrow[5] $myrow[6] SEND";
				$sq2 = $r->RawQuery("SELECT Name,Body FROM Email WHERE id='$myrow[2]'",$db);
				while ($myrow2 = mysql_fetch_row($sq2)) {
					$Subject=$myrow2[0];
					$Body=$myrow2[1];
				};
				//==================================set log================================
				$l=new AddToDatabase();
				$l->AddTable("Logs");
				$l->AddExtraFields(array("ClientsID"=>$myrow[10],"Message"=>$Body,'MsgType'=>"email","MsgTitle"=>"Autoresponder Email","AdministratorsID"=>$myrow[12]));
				$l->AddFunctions(array("MDate"=>"CURDATE()"));
				$l->DoStuff();
				$LogsID=$l->ReturnID();
				$l->AddTable("SentMessages");
				$l->Reset();
				$l->AddExtraFields(array("LogsID"=>$LogsID,"MsgID"=>"0","Email"=>$myrow[5]));
				$l->DoStuff();
				$EmailID=$l->ReturnID();
				//===================================================================
				$m->From($myrow[8],$myrow[9]);
				$m->Subject($Subject);
				$m->Template("../templates/".$myrow[6]."/index.html");
				$m->To(array("$myrow[7]"=>$myrow[5]));
				$NewBody=$Body."<br>\n<hr> To Unsubscribe <a href='http://$_SERVER[HTTP_HOST]/unsubscribe.php?ClientsID=$myrow[10]&Email=$myrow[5]'>Click Here</a> <br>\n To create your own email and sms marketing campaigns go to <a href='http://www.smsmailpro.com'>http://www.smsmailpro.com</a>";
				$NewBody.="<img src='http://$_SERVER[HTTP_HOST]/viewed.php?id=$EmailID'>";
				$NewBody=$e->MergeMember($NewBody,$myrow[11]);
				$m->Merge(array("body"=>$NewBody));
				$m->Send();
				$sq2 = $r->RawQuery("UPDATE AR_Users SET QueuePos=QueuePos+1,LastSent=NOW() WHERE id='$myrow[0]'",$db);
				
				if($myrow[13]>0){
					$sq2 = $r->RawQuery("SELECT Name,Body FROM SMS WHERE id='$myrow[13]'",$db);
					while ($myrow2 = mysql_fetch_row($sq2)) {
						$Subject=$myrow2[0];
						$Body=$myrow2[1];
					};
					
					
					$click=new SMS();
					$FromName="SMSMailPro";//$_SESSION['FromName'];
					$click->SetFrom($FromName);
										
					$click->SetMessage($Body);
					
					$l=new AddToDatabase();
					$l->AddTable("SentSMS");
						if($EmailCount->CanSendMore()){
							$rslt7=$r->RawQuery("SELECT EmailCredits FROM Clients WHERE id=$myrow[10]");
							$data=mysql_fetch_array($rslt7);
							$click->AddTo($myrow[14]);
							$r->RawQuery("UPDATE Clients SET EmailCredits=EmailCredits-20 WHERE id=$myrow[10]");
						};
					}
					$click->Send();
					
					$MsgIds=$click->GetMsgID();
					
					foreach($MsgIds as $key=>$val){
						$l->Reset();
						$l->AddExtraFields(array("LogsID"=>$_SESSION['LogsID'],"MsgID"=>$val,"Mobile"=>$key));
						$l->DoStuff();
					}
				}
			}else{
				echo"$Now $NextMessage $Hour,$Minute,$Second,$Month,$Day,$Year";
				
				
			}
		}
		
	
	
	//mail("dan@iwebbiz.com.au","its running",date("Y-m-d H:i:s"));
?>