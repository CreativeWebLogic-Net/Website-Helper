<?php
	$sq2 = $r->RawQuery("SELECT Name FROM Clients WHERE id='$ThisClientsID'",$db);
	while ($myrow2 = mysql_fetch_row($sq2)) {
		print "<br>$myrow2[0]";
	};	
?>

<?
	$SearchString="";
	if($_SESSION['FYear']){
		$SearchString="AND MDate>='$_SESSION[FYear]-$_SESSION[FMonth]-$_SESSION[FDay]' AND MDate<='$_SESSION[TYear]-$_SESSION[TMonth]-$_SESSION[TDay]'";
	};  
	$Count=0; 
	$sq2 = $r->RawQuery("SELECT Logs.id,Name,MDate,MsgTitle,MsgType FROM Administrators,Logs WHERE Administrators.id=Logs.AdministratorsID AND Logs.ClientsID='$ThisClientsID' $SearchString",$db);
	if(mysql_num_rows($sq2)>0){
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" >
  <tr class="header">
    <td width="30%"><strong> Administrator Name</strong></td>
    <td width="17%"><strong>Log Title </strong></td>
    <td width="18%"><strong>Msg Type </strong></td>
    <td width="25%"><div align="center"><strong>Date</strong></div></td>
    <td width="10%" align="center"><strong>Detail</strong></td>
  </tr>
  <?php
					  include("database.php");
					 	$Total=0;
						
						while ($myrow2 = mysql_fetch_row($sq2)) {
							$Count++;
							echo'<tr class="'.(($Count%2)==0 ? "row1" : "row2").'"> ';
							  echo"<td>$myrow2[1]</td>";
							  echo"<td>$myrow2[3]</td>";
							  echo"<td>$myrow2[4]</td>";
							  echo"<td>$myrow2[2]</td>";
							  echo"<td align=\"center\"><a href=\"details.php?id=$myrow2[0]\"><img src=\"../../images/select.gif\" width=\"47\" height=\"12\" border=\"0\"></a></td>";
							  
							echo"</tr>";
							$Total+=$myrow2[2];
						};
					?>
  
</table>
<? }else{?>
->No Results<br />
<? };?>

