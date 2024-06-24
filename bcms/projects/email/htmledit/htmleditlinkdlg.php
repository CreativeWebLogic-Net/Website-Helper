<?
	session_start();
	
	define('MODULESDIR','../../main/modules/');
	define('BASEURL','/site/');
	
	include("../DB_Class.php");
	include("../Perms_Class.php");
	
	$APerms=new Permissions($_SESSION['AdminKey'],0,$_SESSION['SU']);
	$APerms->CheckAdminSession();
	
	$r= new ReturnRecord();  // base object for returning data or raw queries
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<SCRIPT language="javascript">
var charset = (top.opener.document.characterSet) ? top.opener.document.characterSet : top.opener.document.charset
document.write("<meta HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; CHARSET=" + charset + "\" />")
</SCRIPT>
<SCRIPT id="languagefile" language="javascript"></script>
<SCRIPT language="javascript">
var g_strHtmlEditPath = top.opener.g_strHtmlEditPath
var g_strHtmlEditLangFile = top.opener.g_strHtmlEditLangFile
document.getElementById('languagefile').src = g_strHtmlEditLangFile
</SCRIPT>
<TITLE></TITLE>
<LINK rel=STYLESHEET type="text/css" href="style.css" />
<SCRIPT language="javascript" src="utils.js"></script>
<SCRIPT language="javascript" src="mydlg.js"></script>
</HEAD>
<BODY style="background-color: white;" leftmargin=10 topmargin=10 onload="Initialize()">
<SCRIPT LANGUAGE="JavaScript">
<!--
top.document.title = g_strHeTextHyperlink

document.body.style.backgroundColor = top.opener.g_strHeCssThreedFace
document.body.style.color = top.opener.g_strHeCssWindowText

var BaseUrl='<?=BASEURL;?>';

function Initialize() {
	if (MyDlgGetObj().args) {
	    // href
	    if (MyDlgGetObj().args.href) {
	        str = new String(MyDlgGetObj().args.href)
	        document.tablefrm.urll.value = str
			var strArr=Array();
			strArr=str.split("/");
			Pages=document.tablefrm.PagesID;
			for(x=0;x<Pages.options.length;x++){
				if(Pages.options[x].value==strArr[3]){
					Pages.options[x].selected=true;
					document.tablefrm.SEO.value=strArr[2];
				}
			}
		
		} else {
	        document.tablefrm.urll.value = "http://"
	    }
	
	    // target
	    if (MyDlgGetObj().args.target) {
	        str = new String(MyDlgGetObj().args.target)
	        if (str == "_blank")
	            document.forms[0].target.selectedIndex = 1
	        else if (str == "_parent")
	            document.forms[0].target.selectedIndex = 2
	        else if (str == "_top")
	            document.forms[0].target.selectedIndex = 3
	        else
	            document.forms[0].target.selectedIndex = 0
	
	    } else {
	        document.forms[0].target.selectedIndex = 0
	    }
	}

	document.tablefrm.urll.focus()
}

function OnOk() {

   var obj = new Object()
	if(document.forms[0].PagesID.value==""){
   		obj.href = document.forms[0].urll.value
   	}else{
		obj.href = BaseUrl+document.forms[0].SEO.value+"/"+document.forms[0].PagesID.value+"/"
	}
   obj.target = document.forms[0].target.options[document.forms[0].target.selectedIndex].value
   MyDlgHandleOK(obj) ;
}

function thereturn(CatID,FileName,returncode){
	document.tablefrm.urll.value = "/Assets/"+CatID+"/"+FileName;
	Pages=document.tablefrm.PagesID;
	Pages.options[0].selected=true;
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
// -->
</SCRIPT>
<FORM name=tablefrm>
<fieldset>
        <TABLE width=100% cellpadding=2 cellspacing=0 border=0>
        <TR>
          <TD>Internal Url </TD>
          <TD colspan="2"><select name="PagesID">
            <option value=''>Use External Url</option>
            <?php
			$sq2=$r->rawQuery("SELECT id,Title,APermsID,PageTitle FROM Pages");  
			while ($myrow = mysql_fetch_row($sq2)) {
				if($APerms->HasAPerm($myrow[2])){
					echo"<option value='$myrow[1]'>$myrow[3]</option>";
				};
			};
		?>
          </select></TD>
          </TR>
        <TR>
          <TD>SEO Text </TD>
          <TD width="52%"><input name="SEO" type="text" id="SEO"></TD>
          <TD width="28%" align="center"> <strong><a href="javascript:MM_openBrWindow('../main/assets/select-asset-link.php?returncode=1','selectasset','scrollbars=yes,width=550,height=500')">Select Asset </a></strong></TD>
        </TR>
        <TR>
            <TD width=20%><script language="javascript">document.write(g_strHeTextUrl)</script></TD>
            <TD colspan="2"><INPUT type=text name=urll value="http://" size=50 maxlength=250 /></TD>
        </TR>
        <tr>
           <TD><script language="javascript">document.write(g_strHeTextTarget)</script></TD>
            <TD colspan="2">
                <SELECT name=target >
                    <OPTION value='_self' selected>_self</OPTION>
                    <OPTION value='_blank'>_blank</OPTION>
                    <OPTION value='_parent'>_parent</OPTION>
                    <OPTION value='_top'>_top</OPTION>
                </SELECT></TD>
        </TR>
        </TABLE>
</fieldset>
<TABLE cellpadding=0 cellspacing=0 border=0 align=right>
<TR>
    <TD align=right ><BR /><SCRIPT language="JavaScript" type="text/JavaScript">
                document.write('<INPUT type=button value="' + g_strHeTextOk + '" onclick="javascript: OnOk()" />')
                document.write('<INPUT type=button value="' + g_strHeTextCancel + '" onclick="javascript: MyDlgHandleCancel()" />')
        </SCRIPT></TD>
</TR>
</TABLE>
</FORM>

</body></html>
