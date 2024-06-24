<?php
	include("../Admin_Include.php");
	
	if($_GET['id']) $id=$_GET['id'];
	elseif($_POST['id']) $id=$_POST['id'];
	
	if($_POST['Submit']){
		//$CreditWarning=$Credits/10;
		$m= new UpdateDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddSkip(array("id"));
		$m->AddTable("Clients");
		
		if($_FILES['Logo']['name']){
			$m->ResizeImage("Logo","../../assets/logos/","229x84");
		}
		//$m->AddExtraFields(array("CreditWarning"=>$CreditWarning));
		$m->AddID($id);
		$m->DoStuff();
		$Message="Client Updated";
	};
	
	
	$m= new ReturnRecord();
	$m->AddTable("Clients");
	$m->AddSearchVar($id);
	$Insert=$m->GetRecord();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<link href="../../css/general.php" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

function CheckAll(){
	XLength=9;
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
<script language="JavaScript" type="text/JavaScript">
<!--



function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
</head>
<body onload="window.defaultStatus='Things Are Looking up!.';">

<div id="skipnav"><a href="#content" tabindex="1" title="Skip Navigation" accesskey="2">Skip Navigation</a></div>
<div id="logo"></div>
<span class="head"></span>
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td width="81%" valign="top" class="rightside"><span class="pagetitle"><span class="pagetitle">Modify Client </span><span class="RedText"><?php print $Message; ?></span></h1>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><form action="modify-edit.php"  method="post" enctype="multipart/form-data" name="form2" id="form2" onsubmit="YY_checkform('form2','Name','#q','0','You must fill in the field Name.','Email','#S','2','You must fill in a valid Email Address.');return document.MM_returnValue">
                      <p><br />
                          <br />
                Complete the client details below.<br />
                <br />
                <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong></p>
                      <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                        <tr>
                          <td width="163"><strong> Full Name<span class="RedText">*</span></strong></td>
                          <td width="352"><input name="Name" type="text" id="Name" value="<?php print $Insert['Name']; ?>" size="45" /></td>
                        </tr>
                        <tr>
                          <td><strong> Email<span class="RedText">*</span></strong></td>
                          <td><input name="Email" type="text" id="Email" value="<?php print $Insert['Email']; ?>" size="45" /></td>
                        </tr>
                        <tr>
                          <td><strong>Billings Email</strong></td>
                          <td><input name="BillEmail" type="text" id="BillEmail" value="<?php print $Insert['BillEmail']; ?>" size="45" /></td>
                        </tr>
                        <tr>
                          <td><strong> Phone <span class="RedText"></span></strong></td>
                          <td><input name="Phone" type="text" id="Phone" value="<?php print $Insert['Phone']; ?>" size="45" /></td>
                        </tr>
                        <tr>
                          <td><strong>Contact Mobile</strong></td>
                          <td><input name="Mobile" type="text" id="Mobile" value="<?php print $Insert['Mobile']; ?>" size="45" /></td>
                        </tr>
                        <tr>
                          <td><strong>Credits </strong></td>
                          <td><input name="EmailCredits" type="text" id="EmailCredits" value="<?php print $Insert['EmailCredits']; ?>" size="45" /></td>
                        </tr>
                        <tr>
                          <td><strong>Logo</strong></td>
                          <td><input name="Logo" type="file" id="Logo" />
                          <br />
						  <img src="/assets/logos/<?=$Insert['Logo'];?>" />
						  </td>
                        </tr>
                      </table>
                      <div align="center"><strong>
                        <input name="Button22" type="button" class="formbuttons" onclick="MM_goToURL('self','modify.php');return document.MM_returnValue;return confirmSubmit()" value="Cancel" />
                        <input name="Submit" type="submit"  class="formbuttons" id="Submit" value="Save" onclick="return confirmSubmit()" />
                        <input name="id" type="hidden" id="id" value="<?php print $id; ?>" />
                        </strong><br />
                      </div>
                  </form></td>
                </tr>
            </table></td>
          </tr>
        </table>
        <p>&nbsp;</p></td>
  </tr>
</table>
<div id="midway"></div>
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td width="81%"><div id="wrapper">
      <div id="content">
        <span class="pagetitle">&nbsp;</h1>
      </div>
      <div id="footer">
        <p>Design and Content &copy; <strong><a href="http://www.iwebbiz.com.au">IWebBiz</a></strong> All rights reserved. </p>
      </div>
    </div></td>
  </tr>
</table>
</body>
</html>
