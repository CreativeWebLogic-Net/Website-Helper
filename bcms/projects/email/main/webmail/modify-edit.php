<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(14);
	
	if($_GET['id']) $id=$_GET['id'];
	elseif($_POST['id']) $id=$_POST['id'];
	
	if($_POST['Email_FoldersID']){
		$r->RawQuery("UPDATE EMessage SET Email_FoldersID='$_POST[Email_FoldersID]' WHERE id='$id'");
		$Message="Folder Updated";
	};
	
	$r->RawQuery("UPDATE EMessage SET Seen='True' WHERE id='$id'");
	
	$m= new ReturnRecord();
	$m->AddTable("EMessage");
	$m->AddSearchVar($id);
	$Insert=$m->GetRecord();
	
	$TmpA=urlencode($Insert['FromAddress']);
	$tmp=split("\+\%26lt\%3B",$TmpA);
	$FromName=trim($tmp[0]);
	$tmp2=split("\%26gt\%3B",$tmp[1]);
	$FromEmail=$tmp2[0];
	
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
    
    <td align="right" ><a href="modify.php">Inbox </a></td>
  </tr>
  <tr>
   
    <td width="81%" valign="top" class="rightside"><br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
      <tr>
        <td height="50" ><div align="left"><img src="../Pics/SMSMailProHeader.jpg" width="702" height="50" /></div></td>
      </tr>
      <tr>
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">View Message </span><span class="RedText"><?php print $Message; ?></span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><form action="modify-edit.php"  method="post" name="form2" id="form2" onsubmit="YY_checkform('form2');return document.MM_returnValue">
                          <br />
                          <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                            <tr>
                              <td colspan="2"><input name="Button" type="button" onclick="MM_goToURL('self','index.php?ReplyID=<?=$id?>');return document.MM_returnValue" value="Reply" />
                                  <input type="button" name="Button3" onclick="MM_goToURL('self','index.php?ForwardID=<?=$id?>');return document.MM_returnValue" value="Forward" />
                                  <input name="Button4" type="button" onclick="MM_goToURL('self','../members/index.php?Name=<?=$FromName?>&amp;Email=<?=$FromEmail?>');return document.MM_returnValue" value="Add Sender To Contacts" />
                                  <select name="Email_FoldersID" onchange="this.form.submit()">
                                    <option value="">-Move To Folder</option>
                                    <option value="1">Inbox</option>
                                    <option value="2">Sent Messages</option>
                                    <option value="3">Deleted Messages</option>
                                    <option value="4">Spam</option>
                                    <?php
					 	$sq2 = $r->RawQuery("SELECT id,Description FROM Email_Folders WHERE ClientsID='$ClientsID'",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							$tmp=($Email_FoldersID==$myrow[0] ? "selected":"");
							echo"<option value='$myrow[0]' $tmp>$myrow[1]</option>";
						};
							?>
                                </select></td>
                            </tr>
                            <tr>
                              <td><strong>To</strong></td>
                              <td><?php print $Insert['MTo']; ?></td>
                            </tr>
                            <tr>
                              <td><strong>From</strong></td>
                              <td><?php print $Insert['FromAddress']; ?></td>
                            </tr>
                            <tr>
                              <td><strong>Subject</strong></td>
                              <td><?php print $Insert['Subject']; ?></td>
                            </tr>
                            <tr>
                              <td width="163"><strong> Date <span class="RedText"></span></strong></td>
                              <td width="352"><?php print $Insert['Date']; ?></td>
                            </tr>
                            <tr>
                              <td height="25"><strong>Attachments</strong></td>
                              <td height="25"><?
				  	$rslt=$r->RawQuery("SELECT id,FileName FROM Attachments WHERE EMessageID='$id'");
					while($myrow=mysql_fetch_row($rslt)){
						echo"<a href='attachment.php?id=$myrow[0]' target='_blank'>$myrow[1] </a><input type='hidden' name='Attachment[]' value='$myrow[0]'>";
					}
				  ?></td>
                            </tr>
                            <tr>
                              <td height="25" colspan="2"><p><strong>Message:</strong><br />
                                      <iframe src="view-message.php?id=<?=$id?>" width="550" marginwidth="0" height="300" marginheight="0" scrolling="Auto" frameborder="0"></iframe>
                              </p></td>
                            </tr>
                            <tr>
                              <td height="25" colspan="2"><input name="Button2" type="button" class="formbuttons" onclick="MM_goToURL('self','modify.php');return document.MM_returnValue;return confirmSubmit()" value="Cancel" />
                                  <input name="id" type="hidden" id="id" value="<?php print $id; ?>" /></td>
                            </tr>
                          </table>
                        <strong><br />
                          </strong><br />
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
