<?
	class Permissions{
		var $r;
		var $PArr=array();
		
		function Permissions($AdminKey){
			$this->r=new ReturnRecord();
			
			$sq2 = $this->r->RawQuery("SELECT Code FROM Permissions WHERE AdministratorsID='$AdminKey'",$db);
			while ($myrow = mysql_fetch_row($sq2)) {
				$this->PArr[]=$myrow[0];
			};
		}
		
		function CheckCode($Code){
			if(in_array($Code,$this->PArr)) return true;
			else return false;
		}
		
		function CheckPage($Code){
			if(!$this->CheckCode($Code)){
				header("Location: ../logged-in/permdenied.php");
				exit();
			};
		}
	
	}


?>