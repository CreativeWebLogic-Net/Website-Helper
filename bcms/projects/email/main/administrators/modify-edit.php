<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(2);
	
	$CheckAllNumber=25;
	
	if($_GET['id']) $id=$_GET['id'];
	elseif($_POST['id']) $id=$_POST['id'];
	
	if($_POST['Submit']){
		if(($_POST['Password']==$_POST['Password2'])&&($_POST['Password']!="")){
			$_POST['Crypted']=md5($_POST['UserName'].$_POST['Password']);
		}
		
		$m= new ReturnRecord();
		$m->AddTable("Administrators");
		$m->AddSearchVar($id);
		$Insert=$m->GetRecord();
		if(($_POST['Email']!=$Insert['Email'])||($_POST['Mobile']!=$Insert['Mobile'])){
			$_POST['Verified']="No";
			
		}
		
		$_POST['Password']="";
		$m= new UpdateDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddSkip(array("id"));
		$m->AddTable("Administrators");
		$m->AddNoDupe(array("UserName"));
		$m->AddID($id);
		$m->DoStuff();
		if($m->Errors==""){
			$Message="Administrator Updated";
			
			$d= new DeleteFromDatabase();
			$d->AddIDArray(array($id));
			$d->AddTable("Permissions");
			$d->AltDeleteVar("AdministratorsID");
			$Errors=$d->DoDelete();
			
			require("database.php");
			if(is_array($_POST['Perms'])){
				foreach($_POST['Perms'] as $key => $value){
					$sql= "INSERT INTO Permissions (Code,AdministratorsID) VALUES ('$value','$id')";
					$result = $r->RawQuery($sql);
				}
			};
			if($_POST['SendEmail']){
				$a= new ReturnRecord();
				$a->AddTable("AdminEmails");
				$a->AddSearchVar(1);
				$Insert=$a->GetRecord();
				
				
				$NewBody=' <p> Your Username= '.$_POST['UserName'].'<br>
						Password='.$_POST['Password'].' </p>
						';
				
				$m=new SendMail();
				$m->Body($Simple,$Plain,$HTML);
				$m->From("SMSMailPro Admin",$Insert['General']);
				$m->Subject("SMSMailPro New Login Details");
				$m->Template("../../emailTemplates/template.php");
				$m->To(array($_POST['Name']=>$_POST['Email']));
			
				$m->Merge(array("body"=>$NewBody));
				$m->Send();
			};
		}else{
			$Message=$m->Errors;
		}
	};
	
	
	$m= new ReturnRecord();
	$m->AddTable("Administrators");
	$m->AddSearchVar($id);
	$Insert=$m->GetRecord();
	
	$PArr=array();
	$sq2 = $r->RawQuery("SELECT Code FROM Permissions WHERE AdministratorsID='$id'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$PArr[]=$myrow[0];
	};

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<link href="../../css/general.php" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style2 {color: #FFFFFF}
-->
</style>
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
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

function CheckAll(){
	XLength=<? print $CheckAllNumber; ?>;
	for(x=1;x<XLength;x++){
		document.getElementById("Perms["+x+"]").checked=true;
	}
}

function confirmSubmit()
{
var agree=confirm("Are you sure you wish to continue?");
if (agree)
	return true ;
else
	return false ;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.66
//copyright (c)1998,2002 Yaromat.com
  var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
  for (var i=1; i<args.length;i=i+4){
    if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
    var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
    myV=myObj.value;
    if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
      if (myReq&&myObj.value.length==0){addErr=true}
      if ((myV.length>0)&&(args[i+2]==1)){ //fromto
        var myMa=args[i+1].split('_');if(isNaN(myV)||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==2)){
          var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
      } else if ((myV.length>0)&&(args[i+2]==3)){ // date
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
        if(myAt){
          var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
          var myDate=new Date(myY,myM,myD);
          if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
        }else{addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==4)){ // time
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
      } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
      } else if (myV.length>0&&args[i+2]==6){ // the same
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      }
    } else
    if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
          var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
          var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
      if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
      if (args[i+2]==2){
        var myDot=false;
        for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
        if(!myDot){myErr+='* ' +args[i+3]+'\n'}
      }
    } else if (myObj.type=='checkbox'){
      if(args[i+2]==1&&myObj.checked==false){addErr=true}
      if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
    } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
      if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
    }else if (myObj.type=='textarea'){
      if(myV.length<args[i+1]){addErr=true}
    }
    if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
  }
  if (myErr!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+myErr)}
  document.MM_returnValue = (myErr=='');
}
//-->
</script>
</head>
<body onload="window.defaultStatus='Things Are Looking up!.';">

<div id="skipnav"><a href="#content" tabindex="1" title="Skip Navigation" accesskey="2">Skip Navigation</a></div>
<div id="logo"></div>
<span class="head"></span><br />
    <? include("../credit_meter.php");?>
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td align="right" ><a href="modify.php">Modify / Delete Administrators </a>| <a href="index.php">Add Administrators </a>| <a href="password.php">Change Password</a></td>
  </tr>
  <tr>
    
    <td width="81%" class="rightside"><span class="pagetitle"><span class="pagetitle">Modify Administrator </span><span class="RedText"><?php print $Message; ?></span></h1>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><form action="modify-edit.php"  method="post" name="form2" id="form2" onsubmit="YY_checkform('form2','Name','#q','0','You must fill in the field Name.','Email','S','2','You must fill in a valid Email Address.','Mobile','#q','0','You must fill in a Mobile number. ','UserName','#q','0','You must fill in the field Username.');return document.MM_returnValue">
                      <br />
                    Complete the administrator details below.<br />
                    <br />
                    <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
                    <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                      <tr>
                        <td><strong>Auto-Login</strong></td>
                        <td>http://<?=$_SERVER['HTTP_HOST'];?>/login.php?id=<?=$Insert['Crypted']; ?></td>
                      </tr>
                      <tr>
                        <td width="163"><strong> Full Name<span class="RedText">*</span></strong></td>
                        <td width="352"><input name="Name" type="text" id="Name" value="<?php print $Insert['Name']; ?>" size="45" /></td>
                      </tr>
                      <tr>
                        <td><strong> Email<span class="RedText">*</span></strong></td>
                        <td><input name="Email" type="text" id="Email" value="<?php print $Insert['Email']; ?>" size="45" /></td>
                      </tr>
                      <tr>
                        <td><strong>Mobile<span class="RedText">*</span> (This is the return address on your SMS messages) </strong></td>
                        <td><strong><span class="RedText">International Dialing Codes</span> <span class="RedText">Must Be Used</span> and leading zeros or pluses must be removed eg for a mobile in Australia the number would be 61123456789</strong>
                            <input name="Mobile" type="text" id="Mobile" value="<?php print $Insert['Mobile']; ?>" size="45" /></td>
                      </tr>
                      <tr>
                        <td><strong> Username<span class="RedText">*</span></strong></td>
                        <td><input name="UserName" type="text" id="UserName" value="<?php print $Insert['UserName']; ?>" size="15" /></td>
                      </tr>
                      <tr>
                        <td><strong> New Password<span class="RedText">*</span></strong></td>
                        <td><input name="Password" type="password" id="Password"  size="45" /></td>
                      </tr>
                      <tr>
                        <td><strong> Retype New Password Again<span class="RedText">*</span> </strong></td>
                        <td><input name="Password2" type="password" id="Password2" size="45" /></td>
                      </tr>
                      
                      <tr>
                        <td height="25" colspan="2"><strong>Send Username / Password to Administrator in Email </strong>
                            <input name="SendEmail" type="checkbox" id="SendEmail" value="1" /></td>
                      </tr>
                    </table>
                    <strong><br />
                    Select Permissions for Administrator</strong> <br />
                    <br />
                    The permission below allow an administrator to gain access to specific areas of this Administration Zone. Select the check boxes below to give the administrator you are creating access rights.<br />
                    <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                      <tr>
                        <td colspan="4" bgcolor="#ffffff"> </td>
                      </tr>
                      <tr>
                        <td colspan="4"> <strong>Click Here to Check All</strong>
                            <input name="checkall2" type="checkbox" value="checkbox" onclick="CheckAll();" />                        </td>
                      </tr>
                      <tr>
                        <td width="28%">&nbsp;</td>
                        <td width="18%" align="center"> <strong>Add</strong></td>
                        <td width="17%" align="center"> <strong>Modify/View</strong></td>
                        <td width="18%" align="center"> <strong>Delete</strong></td>
                      </tr>
                      <tr>
                        <td align="left">Administrators </td>
                        <td align="center"><input name="Perms[1]" type="checkbox" id="Perms[1]"  value="1" <?php if(in_array(1,$PArr)){echo"checked";};?> /></td>
                        <td align="center"><input name="Perms[2]" type="checkbox" id="Perms[2]"  value="2" <?php if(in_array(2,$PArr)){echo"checked";};?> /></td>
                        <td align="center"><input name="Perms[3]" type="checkbox" id="Perms[3]"  value="3" <?php if(in_array(3,$PArr)){echo"checked";};?> /></td>
                      </tr>
                      <tr>
                        <td align="left"><span class="style2">Contacts</span></td>
                        <td align="center"><input name="Perms[4]" type="checkbox" id="Perms[4]"  value="4" <?php if(in_array(4,$PArr)){echo"checked";};?> /></td>
                        <td align="center"><input name="Perms[5]" type="checkbox" id="Perms[5]"  value="5" <?php if(in_array(5,$PArr)){echo"checked";};?> /></td>
                        <td align="center"><input name="Perms[6]" type="checkbox" id="Perms[6]"  value="6" <?php if(in_array(6,$PArr)){echo"checked";};?> /></td>
                      </tr>
                      <tr>
                        <td align="left">Send SMS </td>
                        <td align="center"><input name="Perms[9]" type="checkbox" id="Perms[9]"  value="9" <?php if(in_array(9,$PArr)){echo"checked";};?> /></td>
                        <td align="center"><input name="Perms[7]" type="checkbox" id="Perms[7]"  value="7" <?php if(in_array(7,$PArr)){echo"checked";};?> /></td>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left">Send Emails </td>
                        <td align="center"><input name="Perms[10]" type="checkbox" id="Perms[10]"  value="10" <?php if(in_array(10,$PArr)){echo"checked";};?> /></td>
                        <td align="center"><input name="Perms[11]" type="checkbox" id="Perms[11]"  value="11" <?php if(in_array(11,$PArr)){echo"checked";};?> /></td>
                        <td align="center"><input name="Perms[12]" type="checkbox" id="Perms[12]"  value="12" <?php if(in_array(12,$PArr)){echo"checked";};?> /></td>
                      </tr>
                      <tr>
                        <td align="left">Reports</td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><input name="Perms[8]" type="checkbox" id="Perms[8]"  value="8" <?php if(in_array(8,$PArr)){echo"checked";};?> /></td>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left">Webmail</td>
                        <td align="center"><input name="Perms[13]" type="checkbox" id="Perms[13]"  value="13" <?php if(in_array(13,$PArr)){echo"checked";};?>/></td>
                        <td align="center"><input name="Perms[14]" type="checkbox" id="Perms[14]"  value="14" <?php if(in_array(14,$PArr)){echo"checked";};?>/></td>
                        <td align="center"><input name="Perms[15]" type="checkbox" id="Perms[15]"  value="15" <?php if(in_array(15,$PArr)){echo"checked";};?>/></td>
                      </tr>
                      <tr>
                        <td align="left">Autoresponder</td>
                        <td align="center"><input name="Perms[16]" type="checkbox" id="Perms[16]"  value="16" <?php if(in_array(16,$PArr)){echo"checked";};?>/></td>
                        <td align="center"><input name="Perms[17]" type="checkbox" id="Perms[17]"  value="17" <?php if(in_array(17,$PArr)){echo"checked";};?>/></td>
                        <td align="center"><input name="Perms[18]" type="checkbox" id="Perms[18]"  value="18" <?php if(in_array(18,$PArr)){echo"checked";};?>/></td>
                      </tr>
                      <tr>
                        <td align="left">Templates</td>
                        <td align="center"><input name="Perms[19]" type="checkbox" id="Perms[19]"  value="19" <?php if(in_array(19,$PArr)){echo"checked";};?>/></td>
                        <td align="center"><input name="Perms[20]" type="checkbox" id="Perms[20]"  value="20" <?php if(in_array(20,$PArr)){echo"checked";};?>/></td>
                        <td align="center"><input name="Perms[21]" type="checkbox" id="Perms[21]"  value="21" <?php if(in_array(21,$PArr)){echo"checked";};?>/></td>
                      </tr>
                      <tr>
                        <td align="left">SMS</td>
                        <td align="center"><input name="Perms[22]" type="checkbox" id="Perms[22]"  value="22" <?php if(in_array(22,$PArr)){echo"checked";};?>/></td>
                        <td align="center"><input name="Perms[23]" type="checkbox" id="Perms[23]"  value="23" <?php if(in_array(23,$PArr)){echo"checked";};?>/></td>
                        <td align="center"><input name="Perms[24]" type="checkbox" id="Perms[24]"  value="24" <?php if(in_array(24,$PArr)){echo"checked";};?>/></td>
                      </tr>
                      
                      <tr align="center">
                        <td colspan="4"><input name="Button2" type="button" class="formbuttons" onclick="MM_goToURL('self','modify.php');return document.MM_returnValue;return confirmSubmit()" value="Cancel" />
                            <input name="Submit" type="submit"  class="formbuttons" id="Submit3" value="Save" onclick="return confirmSubmit()" />
                            <input name="id" type="hidden" id="id" value="<?php print $id; ?>" /></td>
                      </tr>
                    </table>
                    <br />
                  </form></td>
                </tr>
            </table></td>
          </tr>
      </table>
        </td>
  </tr>
</table>
<div id="midway"></div>
</body>
</html>
