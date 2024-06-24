<?php
	function mimetype ($mime) {
		switch ($mime) {
			case 6:
				return "video";
				break;
			case 5:
				return "image";
				break;
			case 4:
				return "audio";
				break;
			case 3:
				return "application";
				break;
			case 2:
				return "message";
				break;
			default:
				return "text";
				break;
		}
	}
	
	
	function GetKeyfromIDPass($UserName,$Password){
		$r=new ReturnRecord();
		$Crypted=md5($UserName.$Password);
		$sql = $r->RawQuery("SELECT id FROM Administrators where Crypted='$Crypted'",$db);
		while ($myrow = mysql_fetch_row($sql)) {
			return $myrow[0];
		};
		return 0;
	};
	
	function GetKeyfromCrypt($Crypted){
		$r=new ReturnRecord();
		$sql = $r->RawQuery("SELECT id FROM Administrators where Crypted='$Crypted'",$db);
		while ($myrow = mysql_fetch_row($sql)) {
			return $myrow[0];
		};
		return 0;
	};
	
	function FindNameFromNumber($Number){
		$r=new ReturnRecord();
		$sq2 = $r->RawQuery("SELECT Name FROM Members WHERE Mobile='$Number'",$db);
		while ($myrow = mysql_fetch_row($sq2)) {
			return $myrow[0];
		}
		$sq2 = $r->RawQuery("SELECT Name FROM Administrators WHERE Mobile='$Number'",$db);
		while ($myrow = mysql_fetch_row($sq2)) {
			return $myrow[0];
		}
	}
	
	function FindNameFromEmail($Email){
		$r=new ReturnRecord();
		$sq2 = $r->RawQuery("SELECT Name FROM Members WHERE Email='$Email'",$db);
		while ($myrow = mysql_fetch_row($sq2)) {
			return $myrow[0];
		}
		$sq2 = $r->RawQuery("SELECT Name FROM Administrators WHERE Email='$Email'",$db);
		while ($myrow = mysql_fetch_row($sq2)) {
			return $myrow[0];
		}
	}
	
		
	
	function str_makerand ($minlength, $maxlength) 
	{ 
		
		//$charset = "abcdefghijklmnopqrstuvwxyz"; 
		$charset .= "ABCDEFGHJKLMNPQRSTUVWXYZ"; 
		$charset .= "23456789"; 
		if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength); 
		else                         $length = mt_rand ($minlength, $maxlength); 
		for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))]; 
		return $key; 
	}




 function recursive_remove_directory($directory, $empty=FALSE)
 {
     // if the path has a slash at the end we remove it here
     if(substr($directory,-1) == '/')
     {
         $directory = substr($directory,0,-1);
     }
  
    // if the path is not valid or is not a directory ...
     if(!file_exists($directory) || !is_dir($directory))
     {
         // ... we return false and exit the function
         return FALSE;
  
     // ... if the path is not readable
     }elseif(!is_readable($directory))
     {
         // ... we return false and exit the function
         return FALSE;
  
     // ... else if the path is readable
     }else{
  
         // we open the directory
         $handle = opendir($directory);
  
         // and scan through the items inside
         while (FALSE !== ($item = readdir($handle)))
        {
             // if the filepointer is not the current directory
             // or the parent directory
             if($item != '.' && $item != '..')
             {
                 // we build the new path to delete
                 $path = $directory.'/'.$item;
  
                 // if the new path is a directory
                 if(is_dir($path)) 
                 {
                     // we call this function with the new path
                     recursive_remove_directory($path);
  
                 // if the new path is a file
                 }else{
                     // we remove the file
                     unlink($path);
                }
             }
         }
         // close the directory
         closedir($handle);
  
         // if the option to empty is not set to true
         if($empty == FALSE)
         {
             // try to delete the now empty directory
             if(!rmdir($directory))
            {
                // return false if not possible
                 return FALSE;
            }
        }
         // return success
         return TRUE;
     }
}



$tmparr=split("\.",$_SERVER['HTTP_HOST']);
if($tmparr[0]!="smsmailpro"){
	$m= new ReturnRecord();
	$m->AddTable("Clients");
	$m->ChangeTarget("Name");
	$m->AddSearchVar($tmparr[0]);
	$Insert=$m->GetRecord();
	
	if($Insert['Logo']!=""){
		$Logo="/assets/logos/".$Insert['Logo'];
	}else{
		$Logo="main/Pics/SMSMailProHeader.jpg";
	}
}else{
	$Logo="main/Pics/SMSMailProHeader.jpg";
}
?>