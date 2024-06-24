<?
	class CountEmails{
		var $ClientsID;
		var $r;
		var $PaymentPlansID;
		var $StartDate;
		var $MaxEmails,$ExtraEmailPrice,$Absolute;
		
		function CountEmails($ClientsID){
			$this->ClientsID=$ClientsID;
			$this->r=new ReturnRecord();
			$this->GetClientsDetails();
		}
		
		function GetClientsDetails(){
			$rslt=$this->r->RawQuery("SELECT EmailCredits FROM Clients WHERE id='$this->ClientsID'");
			$data=mysql_fetch_array($rslt);
			/*
			$this->PaymentPlansID=$data[0];
			$day=$data[1];
			$month=$data[2];
			$year=$data[3];
			
			if($day>28) $day=28;
			$month-=1;
			if($month<1){
				$year-=1;
				$month=12;
			}
			$this->StartDate=$year.":".$month.":".$day;
			
			$rslt=$this->r->RawQuery("SELECT MaxEmails,ExtraEmailPrice,Absolute FROM PaymentPlans WHERE id='$this->PaymentPlansID'");
			$data=mysql_fetch_array($rslt);
			*/
			$this->MaxEmails=$data[0];
			$this->ExtraEmailPrice=999;
			$this->Absolute="Yes";
		}
		
		function GetCount(){
			$rslt=$this->r->RawQuery("SELECT COUNT(SentMessages.id) FROM Logs,SentMessages WHERE Logs.id=SentMessages.LogsID AND (MsgType='email' OR MsgType='webmail') AND ClientsID='$this->ClientsID'");
			$data=mysql_fetch_array($rslt);
			return $data[0];
		}
		
		function CanSendMore(){
			if($this->Absolute=="Yes"){
				if($this->GetCount()>=$this->MaxEmails){
					return false;
				}else{
					return true;
				}
			}else{
				return true;
			};
		}
	}
?>