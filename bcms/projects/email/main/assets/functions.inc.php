<?
	function ShowPath($Parent,$ClientsID,$BaseUrl){
		$r=new ReturnRecord();
		$rslt=$r->RawQuery("SELECT Name,Parent FROM AssetFolders WHERE ClientsID='$ClientsID' AND id='$Parent'");
		while($data=mysql_fetch_array($rslt)){
			$ret="<a href='$BaseUrl?Parent=$Parent'>$data[0]</a>";
			$ret=showpath($data[1],$ClientsID,$BaseUrl)." / ".$ret;
		}
		return $ret;
	}
	
	function DeleteAsset($id){
		$r=new ReturnRecord();
		$rslt=$r->RawQuery("SELECT FileName,AssetFoldersID FROM Assets WHERE id='$id'");
		while($data=mysql_fetch_array($rslt)){
			unlink("../../assets/$data[1]/$data[0]");
		}
		$r->RawQuery("DELETE FROM Assets WHERE id='$id'");
	}
	
	function DeleteAssetFolder($id){
		$r=new ReturnRecord();
		// get rid of files
		$rslt=$r->RawQuery("SELECT id,FileName FROM Assets WHERE AssetFoldersID='$id'");
		while($data=mysql_fetch_array($rslt)){
			DeleteAsset($data[0]);
		}
		//get rid of child folders
		$rslt=$r->RawQuery("SELECT id FROM AssetFolders WHERE Parent='$id'");
		while($data=mysql_fetch_array($rslt)){
			DeleteAssetFolder($data[0]);
		}
		// remove directory
		$r->RawQuery("DELETE FROM AssetFolders WHERE id='$id'");
		rmdir("../../assets/$id");
	}


?>
