<?
	class SMSMailProAPI{
		var $xmlArray;
		var $xmlResponse;
		var $r;
		var $ClientsID;
		var $AdministratorsID;
		
		
		function SMSMailProAPI($xml){
			$this->r=new ReturnRecord();
			$xml=eregi_replace("><",">\n<",$xml);
			//print $xml;
			$xmlparse = &new ParseXML;
			$this->xmlArray = $xmlparse->GetXMLTree($xml);
		}
		
		
		function Process(){
			$RetArray=array();
			$Columns=array();
			// echo"<pre>";
			//print_r($this->xmlArray);
			//echo"</pre>";
			if($this->xmlArray['SMSMAILPRO_API'][0]['AUTHENTICATION'][0]['CLIENT_GUID'][0]['VALUE']){
				$API_GUID=$this->xmlArray['SMSMAILPRO_API'][0]['AUTHENTICATION'][0]['CLIENT_GUID'][0]['VALUE'];
			}
			if($this->xmlArray['SMSMAILPRO_API'][0]['AUTHENTICATION'][0]['USERNAME'][0]['VALUE']){
				$username=$this->xmlArray['SMSMAILPRO_API'][0]['AUTHENTICATION'][0]['USERNAME'][0]['VALUE'];
			}
			if($this->xmlArray['SMSMAILPRO_API'][0]['AUTHENTICATION'][0]['PASSWORD'][0]['VALUE']){
				$password=$this->xmlArray['SMSMAILPRO_API'][0]['AUTHENTICATION'][0]['PASSWORD'][0]['VALUE'];
			}
			$Crypted=md5($username.$password);
			$SQL="SELECT Clients.id,Administrators.id FROM Clients,Administrators WHERE Clients.id=Administrators.ClientsID AND Crypted='$Crypted' AND API_GUID='$API_GUID'";
			
			$rslt=$this->r->RawQuery($SQL);
			if($rslt){
				$data=mysql_fetch_array($rslt);
				if($data[0]>0){
					$this->ClientsID=$data[0];
					$this->AdministratorsID=$data[1];
					
					if(is_array($this->xmlArray['SMSMAILPRO_API'][0]['COMMANDS'])){
						foreach($this->xmlArray['SMSMAILPRO_API'][0]['COMMANDS'][0]['COMMAND'] as $Command){
							$this->RunCommand($Command);
						}
					}
				}else{
					echo$SQL."<br>Incorrect Authorization<br>".mysql_error();
					print_r($this->xmlArray);
				}
			}
			
			
			
			return $RetArray;
		}
	
		function RunCommand($Command){
			print_r($Command);
			$command_type=$Command['TYPE'][0]['VALUE'];
			switch($command_type){
				case "send_sms":
					$this->RunCommand_send_sms($Command);
				break;
			}
		
		}
		
		
		function RunCommand_send_sms($Command){
			echo"Running Command ->send_sms<br>";
			$body=$Command['DETAILS'][0]['BODY'][0]['VALUE'];
			$log_title=$Command['DETAILS'][0]['LOG_TITLE'][0]['VALUE'];
			
			$l=new AddToDatabase();
			$l->AddPosts($_POST,$_FILES);
			$l->AddTable("Logs");
			$l->AddExtraFields(array("ClientsID"=>$this->ClientsID,"AdministratorsID"=>$this->AdministratorsID,"Message"=>$body,'MsgType'=>"sms","MsgTitle"=>$log_title));
			$l->AddFunctions(array("MDate"=>"CURDATE()"));
			$l->DoStuff();
			$LogsID=$l->ReturnID();
			
			$click=new SMS();
			$FromName="SMSMailPro";
			$click->SetFrom($FromName);
			$click->SetMessage($body);
			$l=new AddToDatabase();
			$l->AddTable("SentSMS");
			$To=array();
			
			
			if(is_array($Command['DETAILS'][0]['NUMBERS'][0]['NUMBER'])){
				foreach($Command['DETAILS'][0]['NUMBERS'][0]['NUMBER'] as $tnumber){
					//print_r($tnumber);
					$number=$tnumber['VALUE'];
					print "----$number-----";
					if(!in_array($number,$To)){
						$rslt=$this->r->RawQuery("SELECT EmailCredits FROM Clients WHERE id=$this->ClientsID");
						$data=mysql_fetch_array($rslt);
						if(($data[0]>19)&&($number!="")){
							$To[]=$number;
							$click->AddTo($number);
							$this->r->RawQuery("UPDATE Clients SET EmailCredits=EmailCredits-20 WHERE id=$this->ClientsID");
						}
					}
				}
			}
			$click->Send();
	
			$MsgIds=$click->GetMsgID();
			print_r($MsgIds);
			foreach($MsgIds as $key=>$val){
				$l->Reset();
				$l->AddExtraFields(array("LogsID"=>$LogsID,"MsgID"=>$val,"Mobile"=>$key));
				$l->DoStuff();
			} 
			echo"sms sent";
		
		}
	
	}




?>