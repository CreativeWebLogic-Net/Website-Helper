<?php
	class SMS{
		var $user = "dalcclick12";
		var $password = "CLMOrz02";
		var $api_id = "3060829";
		var $baseurl ="https://api.clickatell.com";
		var $sess_id;
		var $text;
		var $to = array();
		var $ToString;
		var $errors;
		var $from;
		var $text;
		var $MsgID=array();
		var $CallBack=3;
		var $Concatonation=3;
		var $deliv_ack=1;
		
		function SMS(){
			
		}
		function SetLogin($id,$user,$password){
			$this->api_id=$id;
			$this->user=$user;
			$this->password=$password;
		}
		
		function GetSession(){
			//echo"=========Get Session=========<br>";
			$url = "$this->baseurl/http/auth?api_id=$this->api_id&user=$this->user&password=$this->password";
			//echo $url;
			//$ret = file($url);
			$ch = curl_init ($url);
				curl_setopt ($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_USERAGENT, "ie");
				$ret=curl_exec($ch);
				//echo $ret;
				curl_close($ch);
			$sess = split(":",$ret);
			if ($sess[0] == "OK") {
				$this->sess_id = trim($sess[1]); // remove any whitespace
			}else{
				$this->errors.= "Authentication failure: ".$ret;
			}
		}
		
		function BuildToString(){
			$First=true;
			foreach($this->to as $val){
				if($First) $this->ToString=$val;
				else $this->ToString.=",".$val;
				$First=false;
			}
		}
		
		function AddTo($to){
			if((!in_array($to,$this->to))&&($to!="")){
				$this->to[]=$to;
			}
		}
		
		function SetFrom($from){
			$this->from=$from;
		}
		
		function SetMessage($mess){
			$this->text=urlencode($mess);
		}
		function GetErrors(){
			return $this->errors;
		}
		function GetMsgID(){
			return $this->MsgID;
		}
		
		function GetCost(){
			$Cost=0;
			//echo"<br>=========Message Array=========<br>";
			//print_r($this->MsgID);
			foreach($this->MsgID as $Number => $id){
				$url="$this->baseurl/http/getmsgcharge?api_id=$this->api_id&user=$this->user&password=$this->password&apimsgid=$id";
				//$ret = file($url);
				//echo"<br>=========Return Message Array=========<br>";
				//print_r($ret);
				$ch = curl_init ($url);
				curl_setopt ($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_USERAGENT, "ie");
				$ret=curl_exec($ch);
				curl_close($ch);
				$TmpCost=split(":",$ret);
				$Cost+=trim(eregi_replace("status","",$TmpCost[2]));
			};
			return $Cost;
		}
		
		function GetBalance(){
			$this->GetSession();
			$url = "$this->baseurl/http/getbalance?session_id=$this->sess_id";
			//$ret = file($url);
			$ch = curl_init ($url);
				curl_setopt ($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_USERAGENT, "ie");
				$ret=curl_exec($ch);
				curl_close($ch);
			return $ret;
		}
		
		function Send(){
			$this->GetSession();
			$this->BuildToString();
			if($this->ToString!=""){
				
				$url = "$this->baseurl/http/sendmsg?session_id=$this->sess_id&to=$this->ToString&text=$this->text&from=$this->from&callback=$this->CallBack&concat=$this->Concatonation&deliv_ack=$this->deliv_ack";
				//echo "<br>".$url."<br>";
				/*
				//$ret = file($url);
				
				mail('dan@iwebbiz.com.au', "sms url", $url, $this->headers);
				*/
				$ch = curl_init ($url);
					curl_setopt ($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_HEADER, false);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
					curl_setopt($ch, CURLOPT_USERAGENT, "ie");
					$ret=curl_exec($ch);
					curl_close($ch);
				$ret = split("\n",$ret);
				//echo"<br>=========Return Array=========<br>";
				//print_r($ret);
				if(count($ret)>1){ // multiple returns
					foreach($ret as $line){
						$reArr=split(" ",$line);
						if($reArr[0]=="ID:"){
							$this->MsgID[eregi_replace("\n","",$reArr[3])]=$reArr[1];
						}else{
							$this->errors.=" / ".$line;
						}
					}
				}else{
					$send = split(":",$ret[0]);
					if ($send[0] == "ID"){
						$this->MsgID[$this->ToString]=trim($send[1]);
					}else{
						$this->errors.=" / ".$ret;
					}
				}
			}
		}
	
	}
?>