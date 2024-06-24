<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(1);
	
	$CheckAllNumber=25;
	
	if($_POST['Submit']){
		
		$m= new AddToDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddTable("Administrators");
		$m->AddExtraFields(array("ClientsID"=>$ClientsID,"Theme"=>$Theme));
		$m->DoStuff();
		$NewID=$m->ReturnID();
		$Message="Administrator Added";
		
		
		if(is_array($_POST['Perms'])){
			foreach($_POST['Perms'] as $key => $value){
				$sql= "INSERT INTO Permissions (Code,AdministratorsID) VALUES ('$value','$NewID')";
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
.style1 {color: #000000}
-->
</style>
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
//-->
</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.71
//copyright (c)1998,2002 Yaromat.com
  var a=YY_checkform.arguments,oo=true,v='',s='',err=false,r,o,at,o1,t,i,j,ma,rx,cd,cm,cy,dte,at;
  for (i=1; i<a.length;i=i+4){
    if (a[i+1].charAt(0)=='#'){r=true; a[i+1]=a[i+1].substring(1);}else{r=false}
    o=MM_findObj(a[i].replace(/\[\d+\]/ig,""));
    o1=MM_findObj(a[i+1].replace(/\[\d+\]/ig,""));
    v=o.value;t=a[i+2];
    if (o.type=='text'||o.type=='password'||o.type=='hidden'){
      if (r&&v.length==0){err=true}
      if (v.length>0)
      if (t==1){ //fromto
        ma=a[i+1].split('_');if(isNaN(v)||v<ma[0]/1||v > ma[1]/1){err=true}
      } else if (t==2){
        rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-zA-Z]{2,4}$");if(!rx.test(v))err=true;
      } else if (t==3){ // date
        ma=a[i+1].split("#");at=v.match(ma[0]);
        if(at){
          cd=(at[ma[1]])?at[ma[1]]:1;cm=at[ma[2]]-1;cy=at[ma[3]];
          dte=new Date(cy,cm,cd);
          if(dte.getFullYear()!=cy||dte.getDate()!=cd||dte.getMonth()!=cm){err=true};
        }else{err=true}
      } else if (t==4){ // time
        ma=a[i+1].split("#");at=v.match(ma[0]);if(!at){err=true}
      } else if (t==5){ // check this 2
            if(o1.length)o1=o1[a[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!o1.checked){err=true}
      } else if (t==6){ // the same
            if(v!=MM_findObj(a[i+1]).value){err=true}
      }
    } else
    if (!o.type&&o.length>0&&o[0].type=='radio'){
          at = a[i].match(/(.*)\[(\d+)\].*/i);
          o2=(o.length>1)?o[at[2]]:o;
      if (t==1&&o2&&o2.checked&&o1&&o1.value.length/1==0){err=true}
      if (t==2){
        oo=false;
        for(j=0;j<o.length;j++){oo=oo||o[j].checked}
        if(!oo){s+='* '+a[i+3]+'\n'}
      }
    } else if (o.type=='checkbox'){
      if((t==1&&o.checked==false)||(t==2&&o.checked&&o1&&o1.value.length/1==0)){err=true}
    } else if (o.type=='select-one'||o.type=='select-multiple'){
      if(t==1&&o.selectedIndex/1==0){err=true}
    }else if (o.type=='textarea'){
      if(v.length<a[i+1]){err=true}
    }
    if (err){s+='* '+a[i+3]+'\n'; err=false}
  }
  if (s!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+s)}
  document.MM_returnValue = (s=='');
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
    <td align="right" valign="top" ><a href="modify.php">Modify / Delete Administrators </a>| <a href="password.php">Change Password</a> </td>
  </tr>
  <tr>
    <td valign="top"  class="rightside"><br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
      <tr>
        <td height="50" ><div align="left"><img src="../Pics/SMSMailProHeader.jpg" width="702" height="50" /></div></td>
      </tr>
      <tr>
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Add New Administrator </span><span class="RedText"><?php print $Message; ?></span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><form action="index.php"  method="post" name="form2" id="form2" onsubmit="YY_checkform('form2','Name','#q','0','You must fill in the field Name.','Email','S','2','You must fill in a valid Email Address.','Mobile','#q','0','You must fill in a Mobile number.','UserName','#q','0','You must fill in the field Username.','Password','#q','0','You must fill in the field Password','Password2','#Password','6','Passwords must match.');return document.MM_returnValue" >
                          <br />
                          <br />
                        Complete the administrator details below.<br />
                        <br />
                        <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
                        <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                          <tr>
                            <td width="163"><strong> Full Name<span class="RedText">*</span></strong></td>
                            <td width="352"><input name="Name" type="text" id="Name" size="45" /></td>
                          </tr>
                          <tr>
                            <td><strong> Email<span class="RedText">*</span></strong></td>
                            <td><input name="Email" type="text" id="Email" size="45" /></td>
                          </tr>
                          <tr>
                            <td><strong>Mobile<span class="RedText">*</span> (This is the return address on your SMS messages) </strong></td>
                            <td><strong><span class="RedText">International Dialing Codes</span> <span class="RedText">Must Be Used</span> and leading zeros or pluses must be removed eg for a mobile in Australia the number would be 61123456789</strong>
                      <input name="Mobile" type="text" id="Mobile" size="45" /></td>
                          </tr>
                          <tr>
                            <td><strong> Username<span class="RedText">*</span></strong></td>
                            <td><input name="UserName" type="text" id="UserName" size="15" /></td>
                          </tr>
                          <tr>
                            <td><strong>Password<span class="RedText">*</span> </strong></td>
                            <td><input name="Password" type="password" id="Password" size="45" /></td>
                          </tr>
                          <tr>
                            <td><strong> Retype Password Again<span class="RedText">*</span> </strong></td>
                            <td><input name="Password2" type="password" id="Password2" size="45" /></td>
                          </tr>
                          <tr>
                            <td height="25" colspan="2"><?php
							if($SU){
								echo'<strong>SuperUser</strong><input name="SU" type="checkbox" id="SU" value="1">';
							};
						?>
                            </td>
                          </tr>
                          <tr>
                            <td height="25" colspan="2"><strong>Send Username / Password to Administrator in Email </strong>
                      <input name="SendEmail" type="checkbox" id="SendEmail" value="1" checked="checked" /></td>
                          </tr>
                        </table>
                        <br />
                        <strong> Select Permissions for Administrator</strong> <br />
                        <br />
                        The permission below allow an administrator to gain access to specific areas of this Administration Zone. Select the check boxes below to give the administrator you are creating access rights.<br />
                        <br />
                        <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                          <tr>
                            <td colspan="4" bgcolor="#ffffff"></td>
                          </tr>
                          <tr>
                            <td colspan="4"><strong>Click Here to Check All</strong>
                      <input name="checkall" type="checkbox" value="checkbox" onclick="CheckAll();" />
                            </td>
                          </tr>
                          <tr>
                            <td width="28%">&nbsp;</td>
                            <td width="18%" align="center"><strong>Add</strong></td>
                            <td width="17%" align="center"><strong>Modify/View</strong></td>
                            <td width="18%" align="center"><strong>Delete</strong></td>
                          </tr>
                          <tr>
                            <td align="left">Administrators </td>
                            <td align="center"><input name="Perms[1]" type="checkbox" id="Perms[1]"  value="1" /></td>
                            <td align="center"><input name="Perms[2]" type="checkbox" id="Perms[2]"  value="2" /></td>
                            <td align="center"><input name="Perms[3]" type="checkbox" id="Perms[3]"  value="3" /></td>
                          </tr>
                          <tr>
                            <td align="left">Contacts</td>
                            <td align="center"><input name="Perms[4]" type="checkbox" id="Perms[4]"  value="4" /></td>
                            <td align="center"><input name="Perms[5]" type="checkbox" id="Perms[5]"  value="5" /></td>
                            <td align="center"><input name="Perms[6]" type="checkbox" id="Perms[6]"  value="6" /></td>
                          </tr>
                          <tr>
                            <td align="left">Send SMS </td>
                            <td align="center"><input name="Perms[9]" type="checkbox" id="Perms[9]"  value="9" /></td>
                            <td align="center"><input name="Perms[7]" type="checkbox" id="Perms[7]"  value="7" /></td>
                            <td align="center">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left">Send Emails</td>
                            <td align="center"><input name="Perms[10]" type="checkbox" id="Perms[10]"  value="10" /></td>
                            <td align="center"><input name="Perms[11]" type="checkbox" id="Perms[11]"  value="11" /></td>
                            <td align="center"><input name="Perms[12]" type="checkbox" id="Perms[12]"  value="12" /></td>
                          </tr>
                          <tr>
                            <td align="left">Reports</td>
                            <td align="center">&nbsp;</td>
                            <td align="center"><input name="Perms[8]" type="checkbox" id="Perms[8]"  value="8" /></td>
                            <td align="center">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left">Webmail</td>
                            <td align="center"><input name="Perms[13]" type="checkbox" id="Perms[13]"  value="13" /></td>
                            <td align="center"><input name="Perms[14]" type="checkbox" id="Perms[14]"  value="14" /></td>
                            <td align="center"><input name="Perms[15]" type="checkbox" id="Perms[15]"  value="15" /></td>
                          </tr>
                          <tr>
                            <td align="left">Autoresponder</td>
                            <td align="center"><input name="Perms[16]" type="checkbox" id="Perms[16]"  value="16" /></td>
                            <td align="center"><input name="Perms[17]" type="checkbox" id="Perms[17]"  value="17" /></td>
                            <td align="center"><input name="Perms[18]" type="checkbox" id="Perms[18]"  value="18" /></td>
                          </tr>
                          <tr>
                            <td align="left">Templates</td>
                            <td align="center"><input name="Perms[19]" type="checkbox" id="Perms[19]"  value="19" /></td>
                            <td align="center"><input name="Perms[20]" type="checkbox" id="Perms[20]"  value="20" /></td>
                            <td align="center"><input name="Perms[21]" type="checkbox" id="Perms[21]"  value="21" /></td>
                          </tr>
                          <tr>
                            <td align="left">SMS</td>
                            <td align="center"><input name="Perms[22]" type="checkbox" id="Perms[22]"  value="22" /></td>
                            <td align="center"><input name="Perms[23]" type="checkbox" id="Perms[23]"  value="23" /></td>
                            <td align="center"><input name="Perms[24]" type="checkbox" id="Perms[24]"  value="24" /></td>
                          </tr>
                          <tr align="center">
                            <td colspan="4"><input name="Submit" type="submit"  class="formbuttons" id="Submit" value="Save" onclick="return confirmSubmit()" /></td>
                          </tr>
                        </table>
                        <br />
                      </form></td>
                    </tr>
                </table></td>
              </tr>
            </table>
            <span class="bodytext"></span></td>
      </tr>
    </table>
    
    </td>
  </tr>
</table>
<div id="midway"></div>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
