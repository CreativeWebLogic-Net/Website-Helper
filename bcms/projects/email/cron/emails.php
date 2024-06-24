<?
	include("../DB_Class.php");
	include("../Mail_Class.php");
	include("../GetContact_Class.php");
	include("../MergeEmail_Class.php");
	include("../CountEmails_Class.php");
	
	$m=new SendMail();
	$r=new ReturnRecord();
	$e=new MergeEmail();
	
	
	$rslt=$r->RawQuery("SELECT Name,Body,FromName,FromEmail,FilterList,SType,TemplatesID,EmailQueue.id,ClientsID,AdministratorsID FROM EmailQueue,Email WHERE EmailQueue.EmailID=Email.id AND ToGo<=NOW() AND EmailQueue.Sent='No'");
	while($data=mysql_fetch_array($rslt)){
		
		
		$c=new GetContacts($data[8]);
		$m->From($data[2],$data[3]);
		$m->Subject($data[0]);
		$m->Template("../templates/$data[6]/index.html");
		
		//==============================Filters=====================
		$FilterList=unserialize($data[4]);
		$SType=unserialize($data[5]);
		foreach($FilterList as $key=>$val){
			$c->SearchType($SType[$key],$val);
		};
		$EmailList=$c->Retrieve();
		//==================================set log================================
		$l=new AddToDatabase();
		$l->AddTable("Logs");
		$l->AddExtraFields(array("ClientsID"=>$data[8],"Message"=>$data[1],'MsgType'=>"email","MsgTitle"=>"Delayed Email","AdministratorsID"=>$data[9]));
		$l->AddFunctions(array("MDate"=>"CURDATE()"));
		$l->DoStuff();
		$LogsID=$l->ReturnID();
		
		$EmailCount=new CountEmails($data[8]);
		
		
		$l=new AddToDatabase();
		$l->AddTable("SentMessages");
		//=================================Send Emails================================
		if(is_array($EmailList)){
			foreach($EmailList as $ToEmail){
				if($EmailCount->CanSendMore()){
					$m->To(array(""=>$ToEmail['Email']));
					$NewBody=$data[1]."<br>\n<hr> To Unsubscribe <a href='http://$_SERVER[HTTP_HOST]/unsubscribe.php?ClientsID=$data[8]&Email=$ToEmail[Email]'>Click Here</a> <br>\n To create your own email and sms marketing campaigns go to <a href='http://www.smsmailpro.com'>http://www.smsmailpro.com</a>";
					$NewBody=$e->MergeMember($NewBody,$ToEmail['id']);
					
					$l->Reset();
					$l->AddExtraFields(array("LogsID"=>$LogsID,"MsgID"=>"0","Email"=>$ToEmail['Email']));
					$l->DoStuff();
					$EmailID=$l->ReturnID();
					$NewBody.="<img src='http://$_SERVER[HTTP_HOST]/viewed.php?id=$EmailID'>";
					$m->Merge(array("body"=>$NewBody));
					$m->Send();
					echo "email $ToEmail[Email] <br>";
				};
			}
		}
		$sql=$rslt=$r->RawQuery("UPDATE EmailQueue SET Sent='Yes' WHERE id='$data[7]'");
		
	}

?>