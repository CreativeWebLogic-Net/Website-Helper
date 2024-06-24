<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="wizardStyle">
  <tr>
    <td width="50%"><strong>&nbsp;&nbsp;Logged In As : <?
    	$asql=$r->rawQuery("SELECT Name FROM Administrators WHERE id=$AdminKey");  
	    $adata = mysql_fetch_row($asql);
		print $adata[0];
	
	?></strong></td>
    <td width="50%" align="right"><strong>Credits Available : <?
    	$csql=$r->rawQuery("SELECT EmailCredits FROM Clients WHERE id=$ClientsID");  
	    $cdata = mysql_fetch_row($csql);
		print $cdata[0];
	
	?>&nbsp;&nbsp;</strong></td>
  </tr>
</table>

