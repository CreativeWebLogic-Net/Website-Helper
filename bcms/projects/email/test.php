<?
	include("DB_Class.php");
	$r=new ReturnRecord();
	$rslt=$r->RawQuery("SELECT id,UserName,Password FROM Administrators");
	while($myrow=mysql_fetch_row($rslt)){
		$Crypted=md5($myrow[1].$myrow[2]);
		$SQL="UPDATE Administrators SET Crypted='$Crypted' WHERE id=$myrow[0]";
		$r->RawQuery($SQL);
		echo $SQL."<br>";
	}
?>