<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(11);
	
	if($_GET['id']) $id=$_GET['id'];
	elseif($_POST['id']) $id=$_POST['id'];
	
	if($_POST['Submit']){
		$_POST['Body']=eregi_replace("/assets/","http://".$_SERVER['HTTP_HOST']."/assets/",$_POST['Body']);
		$_POST['Body']=eregi_replace("\.\.\/\.\.\/","http://".$_SERVER['HTTP_HOST']."/",$_POST['Body']);
		
		$m= new UpdateDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddSkip(array("id"));
		$m->AddTable("Email");
		$m->AddID($id);
		$m->DoStuff();
		$Message="Message Updated";
		
			
	};
	
	
	$m= new ReturnRecord();
	$m->AddTable("Email");
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
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
<script language="javascript" type="text/javascript" src="../../tinymce/jscripts/tiny_mce/tiny_mce_src.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "dynfields,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu",
		theme_advanced_buttons1_add_before : "dynfields,save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		content_css : "example_full.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade]",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		flash_external_list_url : "example_flash_list.js",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;"
	});
	
	var FileWindow;
	
	function fileBrowserCallBack(field_name, url, type, win) {
		FileWindow=win;
		// This is where you insert your custom filebrowser logic
		//alert("Filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);
		window.open('../../../../../main/assets/assets.php?field_name='+ field_name +"&type=" + type,'Assets','width=600,height=600');
		// Insert new URL, this would normaly be done in a popup
		//win.document.forms[0].elements[field_name].value ="" ;
	}
	function CallBackReturn(field_name, url){
		FileWindow.document.forms[0].elements[field_name].value =url ;
	}
</script>
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


function confirmSubmit()
{
var agree=confirm("Are you sure you wish to continue?");
if (agree)
	return true ;
else
	return false ;
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
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
    
    <td width="81%" class="rightside"><br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
      <tr>
        <td height="50" ><div align="left"><img src="../Pics/SMSMailProHeader.jpg" width="702" height="50" /></div></td>
      </tr>
      <tr>
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Modify Message </span><span class="RedText"><?php print $Message; ?></span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><form action="modify-edit.php"  method="post" name="form2" id="form2" onsubmit="YY_checkform('form2','Name','#q','0','You must fill in the field Name.');return document.MM_returnValue">
                          <br />
                        Complete the Message details below.<br />
                        <br />
                        <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
                        <table width="100%" height="669" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                          <tr>
                            <td height="28"><strong>Message Name<span class="RedText">*</span></strong></td>
                          </tr>
                          <tr>
                            <td width="592" height="28"><input name="Name" type="text" id="Name" value="<?=$Insert['Name']?>" size="45" /></td>
                          </tr>
                          <tr>
                            <td height="20"><strong>Content <span class="RedText">*</span></strong></td>
                          </tr>
                          <tr>
                            <td height="451"><textarea name="Body" cols="80" rows="35" id="Body"><?=$Insert['Body']?>
</textarea>
                      <input name="id" type="hidden" id="id2" value="<?php print $id; ?>" /></td>
                          </tr>
                        </table>
                        <div align="right"><br />
                  <input name="Button2" type="button" class="formbuttons" onclick="MM_goToURL('self','modify.php');return document.MM_returnValue;return confirmSubmit()" value="Cancel" />
                  <input name="Submit" type="submit"  class="formbuttons" id="Submit" value="Save" onclick="return confirmSubmit();" />
                  <br />
                        </div>
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
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td width="81%">&nbsp;</td>
  </tr>
</table>
</body>
</html>
