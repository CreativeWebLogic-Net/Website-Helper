<?

	class SMSMailPro{
		var ContactList=array();
		var $posturl="http://www.smsmailpro.com/addcontact.php";
		
		function AddContact($Name,$Email,$Phone,$Group){
			$this->ContactList[]=array("Name"=>$Name,"Email"=>$Email,"Phone"=>$Phone,"Group"=>$Group);
		}
		
		function SendContacts(){
			foreach($this->ContactList as $contact){
				$tmpstr="";
				foreach($contact as $key=>$val){
					$tmpstr.=urlencode($key)."=".urlencode($val)."&";
				}
				Transfer($tmpstr);
			}
		}
		
		
		function Transfer($PostFields){
		
			$ch = curl_init ($this->posturl);
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_USERAGENT, "ie");
			//curl_setopt($ch, CURLOPT_PORT, 6020);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $PostFields);
			//curl_setopt ($ch, CURLOPT_FILE, $fh); 
			$return=curl_exec($ch);
		}
	}

?>