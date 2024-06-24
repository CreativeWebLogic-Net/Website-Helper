<?php
	
	
	include("DB_Class.php");
	include("functions.inc.php");
	
	require_once('classes/captcha/animatedcaptcha.class.php');
			
	$img=new animated_captcha();
	$img->session_name='your_turing_test';
	$img->magic_words('expianlidocous cool');
	$user_guess='';
	$valid=false;
	if (isset($_POST['Picture_Text'])) {
		$user_guess=$_POST['Picture_Text'];
		$valid=$img->validate($user_guess);
	}
	
	?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<META name="keywords" content="sms, email, marketing, autoresponder, filters, groups">
<META name="description" content="SMS / Email Marketing Software">
<meta content=index,follow name=ROBOTS>
<link href="main/css/cssmain.css" rel="stylesheet" type="text/css" />
<? include("topbarlinks.php"); ?>
<script>
<!--


var quirksMode = (top == self);
if(!quirksMode) top.document.location="index.php";
//-->
</script>


<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>
<body onload="window.defaultStatus='Things Are Looking up!.';">
<? include("topbar.php"); ?>
<br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
  <tr>
    <td height="50"><div align="left"><img src="<?=$Logo;?>" /></div></td>
    <td align="right"><? include("login-box.php");?></td>
  </tr>
  <tr>
    <td height="17" colspan="2" valign="top" class="MainLinks"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%" valign="top"><span class="pagetitle">SMSMailPro Signup </span></td>
            <td width="80%" class="maintext"><? include("menu.php");?></td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><?
		
		$r=new ReturnRecord();
		
		$Continue=false;
		if($_POST['Submit']){
			if($_POST['Password']==$_POST['Password2']){
				$rslt=$r->RawQuery("SELECT COUNT(UserName) FROM Administrators WHERE UserName='$_POST[UserName]'");
				$data=mysql_fetch_array($rslt);
				if($data[0]==0){
					$Continue=true;
				}else{
					$Continue=false;
					$Message="UserName Already Taken";
				}
			}else{
				$Continue=false;
				$Message="Passwords Don't Match";
			}
			
			foreach($_POST as $key=>$val){
				if($val==""){
					$Continue=false;
					$Message.=" / Field $key invalid";
				}
			}
		}
		
		
		
		if(($Continue)&&($valid)){
			
			$m= new AddToDatabase();
			$PostArray=$_POST;
			$PostArray['Name']=$PostArray['Company'];
			$PostArray['BillEmail']=$PostArray['Email'];
			$_POST['Company']=eregi_replace(" ","_",$_POST['Company']);
			$_POST['Crypted']=md5($_POST['UserName'].$_POST['Password']);
			$_POST['Password']="";
			$m->AddPosts($PostArray,$_FILES);
			$m->AddTable("Clients");
			$m->AddExtraFields(array("PaymentPlansID"=>4,"EmailCredits"=>20));
			$m->AddFunctions(array("Expiry"=>"DATE_ADD(NOW(),INTERVAL 1 MONTH)"));
			$m->DoStuff();
			$NewID=$m->ReturnID();
			$x= new AddToDatabase();
			$x->AddPosts($_POST,$_FILES);
			$x->AddTable("Administrators");
			$x->AddExtraFields(array("ClientsID"=>$NewID));
			$x->DoStuff();
			$AdminID=$x->ReturnID();
			
			
			for($x=1;$x<25;$x++){
				$sql= "INSERT INTO Permissions (Code,AdministratorsID) VALUES ('$x','$AdminID')";
				$result = $r->RawQuery($sql);
			}
			
			?>
				<p><strong>You have been added please login</strong>
			      <!-- Google Code for SMSMailPro Lead Conversion Page -->
				    <script language="JavaScript" type="text/javascript">
				<!--
				var google_conversion_id = 1058609096;
				var google_conversion_language = "en_AU";
				var google_conversion_format = "1";
				var google_conversion_color = "ffffff";
				if (0) {
				  var google_conversion_value = 0;
				}
				var google_conversion_label = "0d0iCMadThDIr-T4Aw";
				//-->
				  </script>
				    <script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
				  </script>
			  </p>
				<noscript>
				<p><img height="1" width="1" border="0" src="http://www.googleadservices.com/pagead/conversion/1058609096/?value=0&amp;label=0d0iCMadThDIr-T4Aw&amp;script=0">
			    </p>
				</noscript>
	
			    <p>
		<?
			}else{
				if(($Continue)&&(!$valid)){
					$Message="Invalid Picture Text";
				}
		?>
		        </p>
			    <p>&nbsp;              </p>
			    <p><span class="RedText">
		        <?=$Message?>
			      </span>
		        </p>
			    <p align="center">&nbsp;              </p>
              <form name="form1" id="form1" method="post" action="signup.php">
                <div align="center"></div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="43%" align="center" valign="middle"><h3><img src="images/pic_signup.jpg" alt="SMS Email Marketing Signup" width="261" height="377" vspace="5" align="middle" /><br />
                        <span class="RedText"><strong>Sign Up Now For Free And Begin Managing Your Online SMS And Email Marketing Campaigns </strong></span></h3></td>
                    <td width="57%"><div align="center">
                      <p><strong>Please Fill In The Following Details To Join:-<br />
                        <span class="RedText">*</span> Required </strong><br />
                        <br />
                      </p>
                      </div>
                      <table width="81%"  border="0" align="center" cellpadding="2" cellspacing="0"   id="tablecell">
                      <tr >
                        <td width="43%"><strong>Full Name <span class="RedText">*</span></strong></td>
                        <td width="57%" ><input name="Name" type="text" id="Name" value="<?=$_POST['Name']?>" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>Company <span class="RedText">*</span></strong></td>
                        <td ><input name="Company" type="text" id="Company" value="<?=$_POST['Company']?>" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>Mobile <span class="RedText">*</span></strong></td>
                        <td ><input name="Mobile" type="text" id="Mobile" value="<?=$_POST['Mobile']?>" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>Email <span class="RedText">*</span></strong></td>
                        <td ><input name="Email" type="text" id="Email" value="<?=$_POST['Email']?>" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>Street Address <span class="RedText">*</span></strong></td>
                        <td ><input name="Street" type="text" id="Street" value="<?=$_POST['Street']?>" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>Suburb <span class="RedText">*</span></strong></td>
                        <td ><input name="Suburb" type="text" id="Suburb" value="<?=$_POST['Suburb']?>" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>City <span class="RedText">*</span></strong></td>
                        <td ><input name="City" type="text" id="City" value="<?=$_POST['City']?>" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>State <span class="RedText">*</span></strong></td>
                        <td ><input name="State" type="text" id="State" value="<?=$_POST['State']?>" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>Country <span class="RedText">*</span></strong></td>
                        <td ><input name="Country" type="text" id="Country" value="<?=$_POST['Country']?>" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>Postcode <span class="RedText">*</span></strong></td>
                        <td ><input name="Postcode" type="text" id="Postcode" value="<?=$_POST['Postcode']?>" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>Username <span class="RedText">*</span></strong></td>
                        <td ><input name="UserName" type="text" id="UserName" value="<?=$_POST['UserName']?>" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>Password <span class="RedText">*</span></strong></td>
                        <td ><input name="Password" type="password" id="Password" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>Password Again <span class="RedText">*</span></strong></td>
                        <td ><input name="Password2" type="password" id="Password22" size="40" /></td>
                      </tr>
                      <tr >
                        <td><strong>Enter Text From Picture <span class="RedText">*</span></strong></td>
                        <td align="left" ><img alt="animated captcha" src="/classes/captcha/animatedcaptcha_generate.php?i=<?php echo(md5(microtime()));?>" /><br />
						<input name="Picture_Text" type="text" id="Picture_Text" autocomplete="off" /></td>
                      </tr>
                      <tr >
                        <td>&nbsp;</td>
                        <td align="right" ><input name="Submit" type="submit" class="formbuttons" id="Submit" value="Submit" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
              </form><? }; ?></td>
          </tr>
    </table></td>
  </tr>
</table>
<a href="http://www.iwebbiz.com.au">&nbsp;&nbsp;Website Design Development Promotion IWebBiz</a>
<? include("analytics.php");?>
</body>
</html>
