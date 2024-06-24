<?
	class MergeEmail{
		var $MemberID;
		var $r;
		
		function MergeEmail(){
			$this->r=new ReturnRecord();
		}
		
		function SetMember($Member){
			$this->MemberID=$Member;
		}
		
		function ReturnMatch($Match){
			return $this->MemberID[$Match];
			
		}
		
		
		function MergeMessage($Message){
			$Matches=array();
			preg_match_all("/\[([^\]]*?)\]/",$Message,$Matches);
			//print_r($Matches);
			foreach($Matches[1] as $Key =>$Val){
				//echo"==$Key-$Val==<br>";
				$ToReplace="\[".$Val."\]";
				$Message=eregi_replace($ToReplace,$this->ReturnMatch($Val),$Message);
				
			}
			return $Message;
		}
		
		function RetrieveMember($MemberID){
			$sq2 = $this->r->RawQuery("Select DISTINCT Email,PostCode,State,Suburb,Country,Name,id FROM Members WHERE id='$MemberID'",$db);
			while ($myrow = mysql_fetch_assoc($sq2)) {
				foreach($myrow as $mkey=>$mval){
					$EmailList[$mkey]=$mval;
					
				};
			};
			return $EmailList;
		}
		
		
		function MergeMember($Message,$MemberID){
			
			$this->MemberID=$this->RetrieveMember($MemberID);
			return $this->MergeMessage($Message);
		}
	
	
	
	}

?>
