<?
	include("DB_Class.php");
	$r=new ReturnRecord();
	
	$Details=array();
	foreach($_GET as $key=>$val){
		$Details[$key]=$val;
	}
	foreach($_POST as $key=>$val){
		$Details[$key]=$val;
	}
	
	//print_r($Details);
	
	if($Details["Username"]){
		$sq2 = $r->RawQuery("SELECT ClientsID FROM Administrators WHERE UserName='$Details[Username]'",$db);
		while ($myrow = mysql_fetch_row($sq2)) {
			//echo"Found User $myrow[0]";
			$m= new AddToDatabase();
			$m->AddPosts($Details,$_FILES);
			$m->AddExtraFields(array("ClientsID"=>$myrow[0]));
			$m->AddTable("Members");
			$m->DoStuff();
			$NewID=$m->ReturnID();
			if($Details["Group"]){
				$Groups=array();
				if(eregi(",",$Details["Group"])){
					$Groups=split(",",$Details["Group"]);
				}else{
					$Groups[]=$Details["Group"];
				}
				foreach($Groups as $val){
					$sq3 = $r->RawQuery("SELECT id FROM MemberGroups WHERE ClientsID='$myrow[0]' and Name='$val'",$db);
					while($data=mysql_fetch_array($sq3)){;
						$sq4 = $r->RawQuery("INSERT INTO MemberGroupsLinks (MembersID,MemberGroupsID) VALUES('$NewID','$data[0]')",$db);
					};
				}
			}
			if($Details["Stream"]){
				$Stream=array();
				if(eregi(",",$Details["Stream"])){
					$Stream=split(",",$Details["Stream"]);
				}else{
					$Stream[]=$Details["Stream"];
				}
				foreach($Stream as $val){
					$sq3 = $r->RawQuery("SELECT id FROM AR_Stream WHERE ClientsID='$myrow[0]' and Name='$val'",$db);
					while($data=mysql_fetch_array($sq3)){
						$sq4 = $r->RawQuery("INSERT INTO AR_Users (QueuePos,MembersID,AR_StreamID) VALUES('1','$NewID','$data[0]')",$db);
					};
				}
			}
		};
		if($Details["Redirect"]){
			header("Location: $Details[Redirect]");
		}else{
			//imagejpeg("images/blank.jpg");
			header('Content-Type: image/jpeg');
			//header('Content-Disposition: inline; filename=blank.jpg');
			$filename = "images/blank.jpg";
			$handle = fopen($filename, "r");
			$contents = fread($handle, filesize($filename));
			fclose($handle);
			print $contents;
			
		}
	}


?>