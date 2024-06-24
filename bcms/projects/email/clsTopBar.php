<?
	class TopBar{
		var $posturl="http://www.bubblecms.net/jscript/cssmenu/menuitems.php";
		
		function TopBar(){
		
		}
		
		function ReadFromCache($filename){
			$handle = fopen($filename, "r");
			if(filesize($filename)>0){
				$contents = fread($handle, filesize($filename));
			}
			fclose($handle);
			return $contents;
		}
		
		function SaveToCache($somecontent,$filename){
			 
			// Let's make sure the file exists and is writable first.
			if (is_writable($filename)) {
			
				// In our example we're opening $filename in append mode.
				// The file pointer is at the bottom of the file hence
				// that's where $somecontent will go when we fwrite() it.
				if (!$handle = fopen($filename, 'w')) {
					 echo "Cannot open file ($filename)";
					 exit;
				}
			
				// Write $somecontent to our opened file.
				if (fwrite($handle, $somecontent) === FALSE) {
					echo "Cannot write to file ($filename)";
					exit;
				}
			
				//echo "Success, wrote ($somecontent) to file ($filename)";
			
				fclose($handle);
			
			} else {
				echo "The file $filename is not writable";
			}
		}
		
		function GetMenu(){
			
			$ch = curl_init ($this->posturl);
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_USERAGENT, "ie");
			//curl_setopt($ch, CURLOPT_PORT, 6020);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, "");
			//curl_setopt ($ch, CURLOPT_FILE, $fh); 
			$return=curl_exec($ch);
			//echo"<br>=xxx====$return======".curl_error($ch);
			//echo"downloading menu";
			$CurrentTime=mktime(date("H"),date("i"),date("s"),date("M"),date("d"),date("Y"));
			$this->SaveToCache($CurrentTime,'time.cache');
			$this->SaveToCache($return,'menu.cache');
			//print $return;
			curl_close($ch);
		}
		
		
		function ShowMenu(){
			$CacheTime=$this->ReadFromCache('time.cache');
			$CurrentTime=mktime(date("H"),date("i"),date("s"),date("M"),date("d"),date("Y"));
			if(($CurrentTime-$CacheTime)>(60*60)){
				$this->GetMenu();
			}
			return  $this->ReadFromCache('menu.cache');
		}
	}
?>