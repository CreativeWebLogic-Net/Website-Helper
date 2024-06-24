<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(22);
	
	
	if($_POST['Submit']){
		$m= new AddToDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddTable("SMS");
		$m->AddExtraFields(array("ClientsID"=>$ClientsID));
		$m->DoStuff();
		$NewID=$m->ReturnID();
		$Message="SMS Message Added";
		
		
		
		
	};
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />


<script language="JavaScript" type="text/JavaScript">
<!--


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
//-->
</script>
<script language="JavaScript" type="text/JavaScript">
<!--

function Keypressed(){
	var CharSpan=document.getElementById("CharCount");
	var SMSSpan=document.getElementById("SMSCount");
	var DocBody=document.form2.Body.value;
	CharSpan.innerHTML=DocBody.length;
	SMSSpan.innerHTML=Math.ceil(DocBody.length/160);
}

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
    
    <td width="81%" valign="top" class="rightside"><span class="pagetitle"><span class="pagetitle">Add New SMS Message </span><span class="RedText"><?php print $Message; ?></span></h1>
        <table width="685" border="0" align="center" cellpadding="0" cellspacing="0"  id="tablecell">
        <tr>
          <td width="685" height="315"><form action="index.php"  method="post" name="form2" id="form2" onsubmit="YY_checkform('form2','Name','#q','0','You must fill in the field Name.');return document.MM_returnValue" >
            Complete the sms message details below.<br />
            <br />
            <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
            <table width="100%" height="250" border="0" cellpadding="3" cellspacing="1" id="tablecell">
              <tr>
                <td height="28" colspan="5"><strong>Message Name<span class="RedText">*</span></strong></td>
              </tr>
              <tr>
                <td width="270" height="28"><input name="Name" type="text" id="Name" size="45" /></td>
                <td width="184" align="right"><strong>Character Count </strong></td>
                <td width="33" align="center"><span id="CharCount">0</span></td>
                <td width="127" align="right"><strong>SMS Per Contact</strong></td>
                <td width="35" align="center"><span id="SMSCount">0</span></td>
              </tr>
              <tr>
                <td height="20" colspan="5"><strong>Content <span class="RedText">*</span></strong></td>
              </tr>
              <tr>
                <td height="169" colspan="5"><textarea name="Body" cols="80" rows="10" id="Body" onkeyup="Keypressed()"></textarea></td>
              </tr>
            </table>
            <input type="submit" name="Submit" value="Submit" />
          </form></td>
        </tr>
      </table>      </td>
  </tr>
</table>
<div id="midway"></div>
</body>
</html>
