<?php
	include("../Admin_Include.php");
	include("../../functions.inc.php");
	
	$p->CheckPage(4);
	
	$CheckAllNumber=13;
	
		if($_POST['Submit']){
		
		$_POST['InputID']=str_makerand(8,8);
		$_POST['DefaultValue']=$_POST['NewValue'][$_POST['Default']];
		$m= new AddToDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddTable("GroupOptions");
		$m->DoStuff();
		$NewID=$m->ReturnID();
		$Message.="Group Field Created";
		
		if(($_POST['Type']==2)or($_POST['Type']==4)){
			for($x=0;$x<count($_POST['NewValue']);$x++){
				$sql= "INSERT INTO DropDown (GroupOptionsID,Value) VALUES ('$NewID','".$_POST['NewValue'][$x]."')";
				$result = $r->RawQuery($sql);
			};
			//$Message.="Group Options Created<br>";
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
<script language="JavaScript" type="text/JavaScript">
<!--

function SetTheButt(){
	var AButt=document.getElementById("AddButt");
	var DFields=document.getElementById("DynFields");
	var SelList=document.form2.Type;
	var Sel=SelList.options[SelList.selectedIndex].value;
	//alert (AButt.innerHTML);
	if((Sel==2)||(Sel==4)){
		AButt.innerHTML='<input name="Add" type="button" id="Add5" onClick="AddField()" value="Add Value"><br>';
	}else{
		AButt.innerHTML="";
		DFields.innerHTML="";
		Count=0;
	}
}

var Count=0;

function AddField(){
	
	var DFields=document.getElementById("DynFields");
	
	DFields.innerHTML=DFields.innerHTML+' Add Value <input type="text" name="NewValue['+Count+']"><input name="Default" type="radio" value="'+Count+'">Default<br>';
	Count++;
	//alert(DFields.innerHTML);
}


function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
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
<span class="head"></span><br />
    <? include("../credit_meter.php");?>
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td align="right" ><a href="modify.php">Modify / Delete Group Fields </a></td>
  </tr>
  <tr>
    
    <td width="81%" valign="top" class="rightside"><br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
      <tr>
        <td height="50" ><div align="left"><img src="../Pics/SMSMailProHeader.jpg" width="702" height="50" /></div></td>
      </tr>
      <tr>
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Add New Group Field </span><span class="RedText"><?php print $Message; ?></span></h1>
            <br />
            <br />
            <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
            <form id="form2" name="form2" method="post" action="index.php">
              <table width="609" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="609"><table width="100%" border="0" cellpadding="3" cellspacing="1"  id="tablecell">
                      <tr>
                        <td valign="top"><strong>Member Group </strong></td>
                        <td><select name="MemberGroupsID">
                            <?
						$sq2 = $r->RawQuery("SELECT id,Name FROM MemberGroups WHERE ClientsID='$ClientsID' ",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							echo "<option value='$myrow[0]'>$myrow[1]</option>";
						};
					
					?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td width="172" valign="top"><p><strong> <span class="RedText"><strong>* </strong></span>Question</strong></p></td>
                        <td width="343"><input name="Question" type="text" id="Question" value="" size="30" /></td>
                      </tr>
                      <tr >
                        <td><strong>Sort Order </strong></td>
                        <td><input name="SOrder" type="text" id="SOrder" value="" size="30" /></td>
                      </tr>
                      <tr >
                        <td><strong>Is it a required response?</strong></td>
                        <td><div align="left">
                            <select name="Required" size="1" id="select5">
                              <option selected="selected">No</option>
                              <option>Yes</option>
                            </select>
                        </div></td>
                      </tr>
                      <tr >
                        <td><strong>Option Kind </strong></td>
                        <td><select name="Type" size="1" id="select9" onchange="SetTheButt()">
                            <option value="3">Check Box</option>
                            <option value="2">Drop Down List</option>
                            <option value="1">Big Text</option>
                            <option value="0">Small Text</option>
                        </select></td>
                      </tr>
                      <tr >
                        <td colspan="2"><div align="center"><span id="AddButt"></span><span id="DynFields"></span> </div></td>
                      </tr>
                      <tr align="center" >
                        <td colspan="2"><div align="center"> </div>
                            <input name="Submit" type="submit" class="formbuttons" id="Submit3" onclick="return confirmSubmit()" value="Save" /></td>
                      </tr>
                  </table></td>
                </tr>
              </table>
            </form>
            <span class="bodytext"></span></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
<div id="midway"></div>
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
   
    <td width="81%">&nbsp;</td>
  </tr>
</table>
</body>
</html>
