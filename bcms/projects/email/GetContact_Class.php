<?
	class GetContacts{
		var $SType=array();
		var $FilterList=array();
		var $r;
		var $EmailList;
		var $ClientsID;
		var $NeedFilterGroupValues=false;
		var $NeedFilterGroups=false;
		
		function GetContacts($ClientsID){
			$this->r=new ReturnRecord();
			$this->ClientsID=$ClientsID;
		}
		
		function SearchType($SType,$FilterList){
			$this->SType[]=$SType;
			$this->FilterList[]=$FilterList;
		}
		
		function AddStartList($List){
			$this->EmailList=$List;
		}
		
		function Retrieve(){
			if(count($this->SType)==0){
				$this->EmailList=$this->RetrieveAll();
			};
			foreach($this->SType as $key=>$val){
				
				$tmpArr=$this->Filter($this->FilterList[$key],$val);
				if(count($this->EmailList)>0){
					$this->EmailList=array_intersect($this->EmailList, $tmpArr);
				}else{
					$this->EmailList=$tmpArr;
				};
			}
			return array_map("unserialize",$this->EmailList);
		}
		
		function NumberOfContactsSelected(){
			if(count($this->SType)==0) return 0;
			
			return count($this->EmailList);
		}
		
		function RetrieveAll(){
			$Count=0;
			$sq2 = $this->r->RawQuery("Select DISTINCT Email,PostCode,State,Suburb,Country,Name,id,Mobile FROM Members WHERE ClientsID='$this->ClientsID' AND Unsubscibe='No'",$db);
			while ($myrow = mysql_fetch_assoc($sq2)) {
				foreach($myrow as $mkey=>$mval){
					$EmailList[$Count][$mkey]=$mval;
					
				};
				$EmailList[$Count]=serialize($EmailList[$Count]);
				$Count++;
			};
			return $EmailList;
		}
		
		
		function Filter($FilterList,$SType){
			//print_r($FilterList);
			//echo"=============$SType===========";
			
			$ClientsID=$this->ClientsID;
			$EmailList=array();
			$Count=0;
			if(eregi("GO_",$SType)){
				$TSType=substr($SType,3);
				if(is_array($FilterList)){
					foreach($FilterList as $val){
						$sq2 = $this->r->RawQuery("SELECT DISTINCT Email,PostCode,State,Suburb,Country,Name,Members.id AS id,Mobile FROM Members,GroupOptionValues WHERE Members.id=GroupOptionValues.MembersID AND Value='$val' AND GroupOptionsID='$TSType' AND Unsubscibe='No'",$db);
						while ($myrow = mysql_fetch_assoc($sq2)) {
							foreach($myrow as $mkey=>$mval){
								$EmailList[$Count][$mkey]=$mval;
								
							};
							$EmailList[$Count]=serialize($EmailList[$Count]);
							$Count++;
						};
					};
				};
			}elseif(is_numeric($SType)){
				switch($SType){
					case 0:
						if(is_array($FilterList)){
							foreach($FilterList as $val){
								//$SArr=split(",",$val['Email']);
								//if(!in_array($SArr[1],$EmailList)){
									$sq2 = $this->r->RawQuery("Select DISTINCT Email,PostCode,State,Suburb,Country,Name,id,Mobile FROM Members WHERE Email='$val' AND ClientsID='$ClientsID' AND Unsubscibe='No'",$db);
									while ($myrow = mysql_fetch_assoc($sq2)) {
										foreach($myrow as $mkey=>$mval){
											$EmailList[$Count][$mkey]=$mval;
											
										};
										$EmailList[$Count]=serialize($EmailList[$Count]);
										$Count++;
									};
								//}
							}
						};
						break;
					case 1:
						for($x=0;$x<count($FilterList);$x++){
							$sq2 = $this->r->RawQuery("Select DISTINCT Email,PostCode,State,Suburb,Country,Name,id,Mobile FROM Members WHERE PostCode='".$FilterList[$x]."' AND ClientsID='$ClientsID' AND Unsubscibe='No'",$db);
							while ($myrow = mysql_fetch_assoc($sq2)) {
								foreach($myrow as $mkey=>$mval){
									$EmailList[$Count][$mkey]=$mval;
									
								};
								$EmailList[$Count]=serialize($EmailList[$Count]);
								$Count++;
							};
						}
						break;
					case 2:
						for($x=0;$x<count($FilterList);$x++){
							$sq2 = $this->r->RawQuery("Select DISTINCT Email,PostCode,State,Suburb,Country,Name,id,Mobile FROM Members WHERE State='".$FilterList[$x]."' AND ClientsID='$ClientsID' AND Unsubscibe='No'",$db);
							while ($myrow = mysql_fetch_assoc($sq2)) {
								foreach($myrow as $mkey=>$mval){
									$EmailList[$Count][$mkey]=$mval;
									
								};
								$EmailList[$Count]=serialize($EmailList[$Count]);
								$Count++;
							};
						}
						break;
					
								
					case 7:
						for($x=0;$x<count($FilterList);$x++){
							$sq2 = $this->r->RawQuery("Select DISTINCT Email,PostCode,State,Suburb,Country,Name,id,Mobile FROM Members WHERE Suburb='".$FilterList[$x]."' AND ClientsID='$ClientsID' AND Unsubscibe='No'",$db);
							while ($myrow = mysql_fetch_assoc($sq2)) {
								foreach($myrow as $mkey=>$mval){
									$EmailList[$Count][$mkey]=$mval;
									
								};
								$EmailList[$Count]=serialize($EmailList[$Count]);
								$Count++;
							};
						}
						break;
					case 8:
						for($x=0;$x<count($FilterList);$x++){
							$sq2 = $this->r->RawQuery("Select DISTINCT Email,PostCode,State,Suburb,Country,Name,id,Mobile FROM Members WHERE Country='".$FilterList[$x]."' AND ClientsID='$ClientsID' AND Unsubscibe='No'",$db);
							while ($myrow = mysql_fetch_assoc($sq2)) {
								foreach($myrow as $mkey=>$mval){
									$EmailList[$Count][$mkey]=$mval;
									
								};
								$EmailList[$Count]=serialize($EmailList[$Count]);
								$Count++;
							};
						}
						break;
					
					case 11:
						
						for($x=0;$x<count($FilterList);$x++){
							
							$sq2 = $this->r->RawQuery("SELECT DISTINCT Email,PostCode,State,Suburb,Country,Name,Members.id AS id,Mobile FROM Members,MemberGroupsLinks WHERE Members.id=MemberGroupsLinks.MembersID AND MemberGroupsID='".$FilterList[$x]."' AND Unsubscibe='No'",$db);
							while ($myrow = mysql_fetch_assoc($sq2)) {
								foreach($myrow as $mkey=>$mval){
									$EmailList[$Count][$mkey]=$mval;
									
								};
								$EmailList[$Count]=serialize($EmailList[$Count]);
								$Count++;
							};
						}
						break;
					case 12:
						//echo "=======================================";
						for($x=0;$x<count($FilterList);$x++){
							
							$sq2 = $this->r->RawQuery("SELECT DISTINCT Members.Email,PostCode,State,Suburb,Country,Members.Name,Members.id,Mobile FROM Logs,SentMessages RIGHT JOIN Members ON (Members.Email=SentMessages.Email) WHERE EmailReceived ='Sent' AND SentMessages.LogsID=Logs.id AND Members.ClientsID='$ClientsID' AND Logs.ClientsID='$ClientsID' AND Members.Unsubscibe='No' AND SentMessages.Email='".$FilterList[$x]."' GROUP BY SentMessages.Email",$db);
							while ($myrow = mysql_fetch_assoc($sq2)) {
								foreach($myrow as $mkey=>$mval){
									$EmailList[$Count][$mkey]=$mval;
								};
								$EmailList[$Count]=serialize($EmailList[$Count]);
								$Count++;
							};
						}
						break;
				}
			};
			return $EmailList;
		}
	
		function GetContactGroups(){
			$sq2 = $this->r->RawQuery("Select DISTINCT id,Name FROM MemberGroups WHERE ClientsID='$this->ClientsID' ORDER BY Name",$db);
			while ($myrow = mysql_fetch_row($sq2)) {
				if($this->DoShowGroup($myrow[0])){
					print("<option value='$myrow[0]'>$myrow[1]</option>");
				};
			};
		}
		
		function GetBouncedEmails(){
			$sq2 = $this->r->RawQuery("SELECT DISTINCT Members.Email,Members.Name FROM Logs,SentMessages RIGHT JOIN Members ON (Members.Email=SentMessages.Email) WHERE EmailReceived ='Sent' AND SentMessages.LogsID=Logs.id AND Members.ClientsID='$this->ClientsID' AND Logs.ClientsID='$this->ClientsID' AND Members.Unsubscibe='No' GROUP BY SentMessages.Email ORDER BY Members.Name",$db);
			while ($myrow = mysql_fetch_row($sq2)) {
				print("<option value='$myrow[0]'>$myrow[1]</option>");
			};
		}
		
		function GetValidContactGroups(){
			$tmpArr=array();
			foreach($this->SType as $key=>$val){
				if(11==$val){
					$this->NeedFilterGroups=true;
					$tmpArr=array_merge($tmpArr,$this->FilterList[$key]);
				}
			}
			return $tmpArr;
		}
		
		function DoShowGroup($Value){
			$retValue=true;
			$ValidArray=$this->GetValidContactGroups();
			if($this->NeedFilterGroups){
				if(!in_array($Value,$ValidArray)){
					$retValue=false;
				}
			}
			return $retValue;
		}
		
		
		function GetGroupOptions($SType){
			$sq2=$this->r->rawQuery("SELECT GroupOptions.id,Question,Type FROM GroupOptions,MemberGroups WHERE GroupOptions.MemberGroupsID=MemberGroups.id AND ClientsID='$this->ClientsID'");  
			while ($myrow = mysql_fetch_row($sq2)) {
				if(($myrow[2]==0)or($myrow[2]==2)or($myrow[2]==3)){
					if(eregi("GO_",$SType)){
						$TSType=substr($SType,3);
					}
					$tmp=($myrow[0]==$TSType ? "selected" :"");
					echo "<option value='GO_$myrow[0]' $tmp>Select By Group Option - $myrow[1]</option>";
				};
			};
		}
		
		function GetValidGroupValues($TSType){
			$tmpArr=array();
			$TSType="GO_".$TSType;
			foreach($this->SType as $key=>$val){
				if($TSType==$val){
					$this->NeedFilterGroupValues=true;
					$tmpArr=array_merge($tmpArr,$this->FilterList[$key]);
				}
			}
			return $tmpArr;
		}
		
		function ShowGroupValue($Value,$TSType){
			
			$retValue=true;
			$ValidArray=$this->GetValidGroupValues($TSType);
			if($this->NeedFilterGroupValues){
				if(!in_array($Value,$ValidArray)){
					$retValue=false;
				}
			}
			return $retValue;
			
		}
		
		function GetGroupValues($TSType){
			$sq2 = $this->r->RawQuery("SELECT DISTINCT Question,InputID,Type,GroupOptions.id,GroupOptions.id,Required FROM MemberGroups,MemberGroupsLinks,GroupOptions LEFT JOIN GroupOptionValues ON (GroupOptions.id=GroupOptionValues.GroupOptionsID ) WHERE GroupOptions.id='$TSType' AND  GroupOptions.MemberGroupsID=MemberGroups.id AND MemberGroups.id=MemberGroupsLinks.MemberGroupsID ORDER BY SOrder",$db);
			while ($myrow = mysql_fetch_row($sq2)) {
				
					switch($myrow[2]){
						case 0:
							$sq4 = $this->r->RawQuery("SELECT Value FROM GroupOptionValues WHERE GroupOptionsID='$myrow[4]' ",$db);
							while ($myrow4 = mysql_fetch_row($sq4)) {
								if($this->ShowGroupValue($myrow4[0],$TSType)){
									echo'<option value="'.$myrow4[0].'" >'.$myrow4[0].'</option>';
								};
							}
						break;
						case 2: // drop down list
									
							$sq3 = $this->r->RawQuery("SELECT DISTINCT DropDown.Value FROM DropDown,GroupOptions WHERE DropDown.GroupOptionsID=GroupOptions.id AND GroupOptionsID='$myrow[4]' ORDER BY Value",$db);
							while ($myrow3 = mysql_fetch_row($sq3)) {
								if($this->ShowGroupValue($myrow3[0],$TSType)){
									echo"<option value=\"$myrow3[0]\" >$myrow3[0]</option>";
								};
							};
						break;
						case 3:
							$sq4 = $this->r->RawQuery("SELECT Value FROM GroupOptionValues WHERE GroupOptionsID='$myrow[4]'",$db);
							while ($myrow4 = mysql_fetch_row($sq4)) {
								if($this->ShowGroupValue($myrow4[0],$TSType)){
									if($myrow4[0]==""){ $STmp="Not Clicked";
									}else{
										//echo"<option value=''>Not Clicked</option>";
										$STmp=$myrow4[0];
									};
									echo'<option value="'.$myrow4[0].'" >'.$STmp.'</option>';
								};
							}
						break;
					
					};
				};
			}
		}
	
	






?>
