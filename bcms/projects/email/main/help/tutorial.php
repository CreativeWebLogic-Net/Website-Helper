<?php
	session_start();
	if(!$_SESSION['SecureKey']){
		header("Location: ../../index.php");
	};
	include("../../cast128.php");
	$e = new cast128;
	$e->setkey("kjhnsdf fdsiohjf fasdujhf asduijdsi");
	$TmpKey=split("-",$e->decrypt($_SESSION['SecureKey']));
	$AdminKey=$TmpKey[0];
	$ClientsID=$TmpKey[1];
	$Theme=$TmpKey[2];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/general.php" rel="stylesheet" type="text/css">
<link href="../../menu_files/menu.php" rel="stylesheet" type="text/css"> 
<script language="JavaScript" src="../../menu_files/menu.js"></script>
<script language="JavaScript" src="../../menu_files/menu_items.php"></script>
<script language="JavaScript" src="../../menu_files/menu_tpl.js"></script>
<script language="JavaScript" src="../../jscript/htmlarea.js"></script>

<script language="JavaScript" type="text/JavaScript">
<!--
function confirmSubmit()
{
var agree=confirm("Are you sure you wish to continue?");
if (agree)
	return true ;
else
	return false ;
}
//-->
</script>
<style type="text/css">
<!--
.MsoNormal {font-size:12.0pt;
	font-family:"Times New Roman";}
.Section1 {page:Section1;}
.pagetitle1 {color:black;
	font-weight:bold;}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td height="1" colspan="2">
      <?php
	include("database.php");
	$sq2 = mysql_query("SELECT * FROM LookFeel WHERE id='1'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$Logo=$myrow[6];
	};
?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="77%" class="head"><img src="/images/<?php print $Logo; ?>"></td>
		  <td width="23%" align="right" class="head"><?php if($SU) include("../SU/drop-down.php"); ?></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td width="165" height="99%" valign="top" class="leftside"><!-- #BeginLibraryItem "/Library/mgr-menu.lbi" --><table width="100%" border="0" cellspacing="10" cellpadding="8">
        <tr> 
          <td> <script language="JavaScript">
<!--
	new menu (MENU_ITEMS0, MENU_POS0, null, null, ["fdiv"]);
//-->
</script> </td>
        </tr>
      </table><!-- #EndLibraryItem --></td>
    <td width="99%" height="99%" valign="top" class="rightside"><h2 align="center"><b><u>i4U SMS TUTORIAL</u></b></h2>
      <div class=Section1>
        <h3>Adding Administrators</h3>
        <p>Administrators are users of the SMS service that can access your SMS account. These administrators can write the text messages and emails that are sent to your contacts. </p>
        <p>The checkboxes for this are located in the permissions section of the "Add New Administrator" form.&nbsp; When you add a new administrator you are giving them access to your SMS credits and the contacts that are on your list. There are various access and viewing settings that you can have your administrators set on depending on what actions permissions you want your administrators to have when they log in.</p>
        <h3>Filling out the "Add New Administrator" form</h3>
        <p><b>1.</b> Go through and fill out the mandatory fields. Firstly enter the full name of the new administrator and their email address. (A correct email address for your administrator is very important)</p>
        <p><b>2.</b>When entering the Mobile number remember International Dialling Codes must be used. For example the mobile number 0405653487 would be entered as; 61405653487. The mobile number you enter will be the number that your contacts will see they got the SMS from.</p>
        <p><b>3.</b> Choose the Username and Password. This is how your new administrator will log into your SMS account. </p>
        <p><b>4.</b> If you tick the checkbox an the new administrators Username and Password will be emailed to the email address that is entered on the form. </p>
        <div align=center> </div>
        <p><b>5. </b><u>Permissions for your administrator</u>: This section is <b>very</b> important as this is the setting that allows your administrators permission to access specific areas of your SMS administration area. When all the checkboxes are ticked in the three areas of Add, Modify/View and Delete, thismeans that your administrator has access to all areas.</p>
        <p>&nbsp;&nbsp; <u>Administrators -</u> By selecting the "Add" checkbox you are giving your administrators permission to enter in new administrators giving them access to your SMS account. By selecting the "Modify/View" checkbox this gives the administrators permission to see the details of other administrators and view and modify there details. If you select the "Delete" checkbox this gives the administrators permission to delete other administrators. </p>
        <p>(b)&nbsp;&nbsp; <u>Contacts- </u>The same goes for your contacts by either selecting or not selecting the "Add", "Modify/View" and "Delete" checkboxes you are choosing whether to give your administrators the capability to add, alter or delete entries in your contact list. </p>
        <p>(c)&nbsp;&nbsp;&nbsp; <u>Send SMS</u>- When ticking the checkboxes in this section your selecting whether or not you want your administrators to have ability "Add" extra quick numbers to your contacts list. (so they can send to mobile numbers that aren't in your contact list) By selecting "Modify/View" your administrator can write SMS to send to your contacts. If the "Modify/View" checkbox is not selected then the administrator cannot create and send SMS.</p>
        <p align="center"><strong><img width=578 height=430
src="./i4U%20SMS%20TUTORIALrev_files/image002.jpg" ></strong></p>
        <p><b>6. </b>When you have completed the form click "Save" and continue. You have successfully added a New Administrator.</p>
        <h3>Adding New Contacts</h3>
        <p><b>1.</b> First enter your new contacts Full Name, Email, Address, Phone and Fax.</p>
        <p>The only mandatory fields<span class="RedText">*</span> are Full Name and Mobile Number, so if other details are not available it will still work.</p>
        <p><b>2. </b>When entering your Contacts Mobile Number remember International Dialling Codes must be used. For example the mobile number 0405653487 would be entered as; 61405653487. The mobile number you enter will be the number that the SMS will be sent to. </p>
        <p><b>3.</b> Finally press "Save" and you have successfully added a new contact.</p>
        <div align="center"><<img
src="./i4U%20SMS%20TUTORIALrev_files/image004.jpg" width=576 height=514 border="1">  </div>
        <h3>Modify / Delete Contacts</h3>
        <p><b>1.</b> To Modify/Delete contacts you can go into your contact list and&nbsp; change the contact details of people entered into your Contact List. For example if you didn't enter the address of a New Contact when you added them and want to do this now if you click on "Modify" you can go into the contact details and add or change the current details that were initially entered in. </p>
        <p><b>2. </b>If you want to Delete a contact from your Contact List simply tick the Delete checkbox next to their name and then click the "Delete" button. </p>
        <div align="center"><img
src="./i4U%20SMS%20TUTORIALrev_files/image006.jpg" width=576 height=375 border="1" > </div>
        <h3>Sending SMS</h3>
        <p><b>1.</b> First select which Name Contacts you want to send the SMS to. Your contacts are in the box on the left hand side. You can also select on the drop down menu from a variety of different data sorting, you can select by Name Administrator, Post Code, State, Suburb and Country. By doing this you can isolate different target areas. If you want to send the SMS to mulitple contacts hold down the <i>Ctrl Key + Left Click on your Mouse</i> then click on each of the contacts you want to send SMS to.</p>
        <p><b>2.</b> Enter in a "Log Title" this is for your reference in the "Reports" this will enable you to keep track of what SMS you have sent. For example if it was for the "Christmas Special" to your SMS contacts you might put "Christmas Special" in the Log Title so in the future you will remember what the SMS was for. </p>
        <p><b>3. </b>Type the SMS in the "Message" box, this is what will be sent to the Contacts you have selected. Please note that the maximum characters in one SMS is 160 characters, once this number is surpassed it sends 2 broken SMS to the recipients.</p>
        <p><b>4. </b>If you select the "Also Send Email" checkbox an exact copy of the SMS typed in the "Message" box will also be sent to the Contacts. The "Email Subject" will be sent as well. For example, you might just put "Christmas Special" again.</p>
        <p><b>5. </b>There is also the "Quick Numbers" function. This allows you to enter in mobile numbers that are not in your Contact List. Simply drop the first zero and type the Mobile Number in the box after the 61 that comes up after you click the "Quick Numbers" button.</p>
        <p><b>6. </b>Finally click the "Send SMS" button to send to the selected contacts.</p>
        <p><b><i>**Please note the timestamp on the SMS will be sent is GMT + 2 hours**</i></b></p>
        <p align="center"><b><span lang=EN-US style='font-family:Arial;color:black'><img 
src="./i4U%20SMS%20TUTORIALrev_files/image008.jpg" border="1" > </b></p>
        <h3><b>Administrator Reports</b></h3>
        <p>Administrator Reports allow you to see what messages have been sent, who sent them and how much many credits they cost. You can set the dates of what month or date you want to view. By clicking on the &ldquo;Select&rdquo; button you can view all of this information in detail.</p>
        <p align="center"><b><img
src="./i4U%20SMS%20TUTORIALrev_files/image010.jpg" width=576 height=315 border="1" ></b> </p>
        <h3><b>To Purchase Additional Credits</b></h3>
        <p><b>1.</b>If you have run out of credits or need some extra one, simply order via the website by clicking on the "Credits" button in main page menu.&nbsp; </p>
        <p><b>2.</b>Then select how many you want to order in the table below. </p>
        <p><b>3. </b>Lastly click the "Submit" button </p>
        <p align="center"><b> <img
src="./i4U%20SMS%20TUTORIALrev_files/image012.jpg" width=576 height=261 border="1" ></b></p>
      </div>
      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
