<?php
	include("../Admin_Include.php");
?>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1">
  <?php 
		
						$MbGroups=split("_",$_GET['Groups']);
						$TCount=0;
						foreach($MbGroups as $key=>$val){
							$sq2 = $r->RawQuery("SELECT Question,InputID,Type,Value,GroupOptions.id,Required FROM GroupOptions LEFT JOIN GroupOptionValues ON (GroupOptions.id=GroupOptionValues.GroupOptionsID AND GroupOptionValues.MembersID='$_GET[id]') WHERE GroupOptions.MemberGroupsID='$val' ORDER BY SOrder",$db);
							while ($myrow = mysql_fetch_row($sq2)) {
							
								if($myrow[5]==1){
									?>
  <tr >
    <td width="54%"><strong><span class="RedText">*</span> <span class="menuitemtext">
      <?=$myrow[0]?>
    </span></strong></td>
    <?
								}else{
									?>
  <tr>
    <td><strong><span class="menuitemtext">
      <?=$myrow[0]?>
    </span></strong></td>
    <?
								}
								?>
    <td width="46%"><?
									switch($myrow[2]){
										case 0: // text box
											echo'<input type="text" name="NewValue['.$myrow[4].']" id="'.$myrow[1].'" value="'.$myrow[3].'" class="menuitemtext">';
											break;
										case 1: // text area
											echo'<textarea name="NewValue['.$myrow[4].']" id="'.$myrow[1].'" class="menuitemtext">'.$myrow[3].'</textarea>';
											break;
										case 2: // drop down list
											echo'<select name="NewValue['.$myrow[4].']" size="1" class="menuitemtext">';
												$sq3 = $r->RawQuery("SELECT DropDown.Value FROM DropDown,GroupOptions WHERE DropDown.GroupOptionsID=GroupOptions.id AND GroupOptionsID='$myrow[4]' ORDER BY Value",$db);
												while ($myrow3 = mysql_fetch_row($sq3)) {
													if($myrow3[0]==$myrow[3]){
														echo"<option value=\"$myrow3[0]\" selected>$myrow3[0]</option>";
													}else{
														echo"<option value=\"$myrow3[0]\">$myrow3[0]</option>";
													};
												};
											echo"</select>";
											break;
										case 3: // check box
											echo'<input name="NewValue['.$myrow[4].']" type="checkbox" value="Clicked" id="'.$myrow[1].'" '.($myrow[3]=="Clicked" ? "checked" : "").'>';
											break;
										case 4: // readio button
											/*$sq3 = $r->RawQuery("SELECT DropDown.Value,DefaultValue,Value FROM DropDown,ProductOptions,ProductDropDown WHERE DropDown.ProductOptionsID=ProductOptions.id AND DropDown.Value=ProductDropDown.DropDownValue AND ProductDropDown.ProductOptionsID=ProductOptions.id AND ProductsID='$key' AND ProductOptions.id='$myrow[4]' ORDER BY DropDown.id",$db);
											while ($myrow3 = mysql_fetch_row($sq3)) {
												if($myrow3[0]==$myrow3[1]){
													echo'<input name="NewValue['.$myrow[4].']" type="radio" value="'.$myrow3[0].'" checked> <span class="menuitemtext">'.$myrow3[2].'</span> ';
												}else{
													echo'<input name="NewValue['.$myrow[4].']" type="radio" value="'.$myrow3[0].'"> <span class="menuitemtext">'.$myrow3[2].'</span> ';
												};
											};*/
											break;
									};
								?></td>
  </tr>
  <?
								$TCount++;
							};
						};
		if($TCount==0){
			?>
			<tr><td>No Group Options</td></tr>
			<?
		};

?>
</table>
