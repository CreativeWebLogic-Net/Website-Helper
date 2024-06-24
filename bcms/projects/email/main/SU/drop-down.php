
  <select name="NewClient" onChange="this.form.submit()">
    <?php
		$sq2 = $r->RawQuery("SELECT id,Name FROM Clients",$db);
		while ($myrow = mysql_fetch_row($sq2)) {
			if($ClientsID==$myrow[0]){
				echo"<option value=\"$myrow[0]\" selected>$myrow[1]</option>";
			}else{
				echo"<option value=\"$myrow[0]\">$myrow[1]</option>";
			};
		};
	?>
	
  </select>

