<?
	class Template{
		var $HTML;
		var $RootPath;
		
		
		function RootPath($RP){
			$this->RootPath=$RP;
		}
		function Insert($HTML){
			$this->HTML=$HTML;
		}
		
		function unzip($src_file, $extract_dir)
		{
		 copy($src_file , $extract_dir . "temp.zip" );
		 $tmpdir=getcwd();
		 chdir($extract_dir);
		 shell_exec("unzip temp.zip");
		 chdir($tmpdir);
		}
		
		function Convert($DestDir,$File){
			$this->unzip($File["tmp_name"], $DestDir);
			$filename=$DestDir."index.html";
			if(file_exists($filename)){
				$fh = fopen($filename,"r");
				$this->HTML = fread($fh,filesize($filename));
				//echo $this->HTML;
				fclose($fh);
				$this->HTML=$this->Merge($DestDir);
				$handle = fopen($filename, 'w');
				fwrite($handle, $this->HTML);
				fclose($handle);
			}
		}
		
		function Merge($DestDir){
			$sarray=array('"',"'");
			foreach($sarray as $splitval){
				$temparr=split($splitval,$this->HTML);
				if(is_array($temparr)){
					for($x=0;$x<count($temparr);$x++){
						if(eregi(".gif|.jpg|.png|.css|.bmp|.GIF|.JPG|.PNG|.CSS|.BMP",$temparr[$x])){
							if(file_exists($DestDir.$temparr[$x])){
								$temparr[$x]=$this->RootPath.$temparr[$x];
							}
							
						}
					}
					$this->HTML=join($temparr,$splitval);
				}
			}
			return $this->HTML;
			
		}
	
	
	}



?>