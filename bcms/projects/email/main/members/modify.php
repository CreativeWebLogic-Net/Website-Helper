<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(5);
	
	if(is_numeric($_POST['MemberGroupsID'])){
		if(is_array($_POST['DFiles'])){
			foreach($_POST['DFiles'] as $key =>$val){
				$r->RawQuery("INSERT INTO MemberGroupsLinks (MemberGroupsID,MembersID) VALUES ('$_POST[MemberGroupsID]','$val')");
			}
		}
		$Message="Members Added To Group";
	}
	
	if(is_numeric($_POST['AR_StreamID'])){
		if(is_array($_POST['DFiles'])){
			foreach($_POST['DFiles'] as $val){
				$sql=$r->RawQuery("INSERT INTO AR_Users (QueuePos,AR_StreamID,MembersID) VALUES ('1','$_POST[AR_StreamID]','$val')");
				if(!$sql) echo"error";
			}
			$Message="Contacts Added To Stream";
		}
	}
	
	if($_POST['Submit']=="Delete"){
		$m= new DeleteFromDatabase();
		$m->AddIDArray($_POST['DFiles']);
		$m->AddTable("Members");
		$m->DoDelete();
		$Message="Contacts Deleted";
	};
	
	
	$RecordsPerPage=10;
	
	if(!empty($_POST['FilterMemberGroupsID'])){
		$FilterMemberGroupsID=$_POST['FilterMemberGroupsID'];
	}else{
		$FilterMemberGroupsID="All";
	};
	
	if($_GET['Page']){
		$Page=$_GET['Page'];
	}elseif($_POST['Page']!=$_POST['CurrentPage']){
		$Page=$_POST['Page'];
	}elseif($_POST['Page2']!=$_POST['CurrentPage']){
		$Page=$_POST['Page2'];
	}else{
		$Page=1;
	}
	
	if($_POST['ListAll']){
		$SString="";
		$SType="Name";
	}else{
		if($_GET['SString']){
			$SString=$_GET['SString'];
		}elseif($_POST['SString']){
			$SString=$_POST['SString'];
		}
		
		if($_GET['SType']){
			$SType=$_GET['SType'];
		}elseif($_POST['SType']){
			$SType=$_POST['SType'];
		}
	};
	
	if(!empty($SString)){
		$SearchSQL="AND $SType LIKE '%$SString%'";
	};
	
	if($FilterMemberGroupsID=="All"){
		$SQL1="SELECT COUNT(*) FROM Members WHERE ClientsID='$ClientsID' $SearchSQL";
		$rset=$r->rawQuery($SQL1);
		$rdata=mysql_fetch_array($rset);
		$rcount=$rdata[0];
		$MaxPages=ceil($rcount/$RecordsPerPage);
		if($Page>$MaxPages) $Page=$MaxPages;
		$StartRecord=($Page-1)*$RecordsPerPage;
		$SQL2="SELECT id,Name,Email,Mobile FROM Members WHERE ClientsID='$ClientsID' $SearchSQL  ORDER BY Name LIMIT $StartRecord,$RecordsPerPage";
	}else{
		$SQL1="SELECT DISTINCT COUNT(Members.id) FROM Members,MemberGroupsLinks WHERE Members.id=MemberGroupsLinks.MembersID AND MemberGroupsID='$FilterMemberGroupsID' AND ClientsID='$ClientsID' $SearchSQL";
		$rset=$r->rawQuery($SQL1);
		$rdata=mysql_fetch_array($rset);
		$rcount=$rdata[0];
		$MaxPages=ceil($rcount/$RecordsPerPage);
		if($Page>$MaxPages) $Page=$MaxPages;
		$StartRecord=($Page-1)*$RecordsPerPage;
		$SQL2="SELECT DISTINCT Members.id,Members.Name,Email,Mobile FROM Members,MemberGroupsLinks WHERE Members.id=MemberGroupsLinks.MembersID AND MemberGroupsID='$FilterMemberGroupsID' AND ClientsID='$ClientsID' $SearchSQL  ORDER BY Name LIMIT $StartRecord,$RecordsPerPage";
	};
	//echo $SQL2;
	
	$rset=$r->rawQuery($SQL2);

	$NPPage="SType=$SType&SString=".urlencode($SString);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--

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
<span class="head"></span><br />
    <? include("../credit_meter.php");?>
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td width="81%" valign="top" class="rightside"><table width="469" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20"><img src="../Pics/largeBullet.gif" width="15" height="15" /></td>
        <td width="449"><span class="pagetitle">Modify / Delete Contacts <span class="RedText"><?php print $Message; ?></span></span></td>
      </tr>
    </table>
    
        <br />
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <table width="653" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="653"><form action="modify.php"  method="post" name="form2" id="form2" >
                  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="4"><strong>Search for Contacts</strong> <br />                        <br /></td>
                      <td colspan="3" align="right">Enter Name/Email/Mobile and click 'Search' </td>
                      </tr>
                    <tr>
                      <td height="33" colspan="4" align="right"><div align="center">
                        <input name="SString" type="text" id="SString" value="<?=$SString?>" />
                      </div></td>
                      <td colspan="2" align="center"><div align="left">
                        <input name="Search" type="submit" class="formbuttons" id="Search" value="Search" />
                      </div></td>
                      <td width="17%"><input name="ListAll" type="submit" class="formbuttons" id="ListAll" value="List All" /></td>
                    </tr>
                    <tr>
                      <td width="16%" height="42">&nbsp;</td>
                      <td width="12%">Search by:</td>
                      <td colspan="2"><select name="SType" id="SType">
                        <option value="Name" <? if($SType=="Name") echo"selected";?>>Name</option>
                        <option value="Email" <? if($SType=="Email") echo"selected";?>>Email</option>
                        <option value="Mobile" <? if($SType=="Mobile") echo"selected";?>>Mobile</option>
                      </select></td>
                      <td width="17%" align="right">Filter By Group: &nbsp;</td>
                      <td width="20%" align="left"><select name="FilterMemberGroupsID" onchange="this.form.submit()">
                        <option value="All">All Groups</option>
                        <?php
					  
							$sq2 = $r->RawQuery("SELECT id,Name FROM MemberGroups WHERE ClientsID='$ClientsID' ",$db);
							while ($myrow = mysql_fetch_row($sq2)) {
								$tmp=($myrow[0]==$FilterMemberGroupsID ? "selected" :"");
								echo"<option value='$myrow[0]' $tmp>$myrow[1]</option>";
							};
						?>
                      </select></td>
                      <td width="17%">&nbsp;</td>
                    </tr>
                  </table>
                  
                  <br />
                  <br />
              <br />
              <?
			  	if($rcount>0){
			  ?>
			  <table width="100%" border="0" cellpadding="3" cellspacing="1" >
                <tr>
                  <td colspan="5"><table width="100%"  border="0" cellpadding="4" cellspacing="0" >
                    <? if($MaxPages>1){?>
					<tr class="header">
                      <td width="23%" align="left"><? if($Page>1){ ?>
                          <a href="modify.php?Page=<?=$Page-1;?>&<?=$NPPage?>" >&lt;&lt;Back</a>
                          <? }; ?></td>
                      <td width="56%" align="center">Jump to
                        <select name="Page" id="Page" onchange="this.form.submit()">
                            <?
					  	for($x=1;$x<=$MaxPages;$x++){
					  		$tmp=($x==$Page ? "selected" : "");
							echo"<option value='$x' $tmp>Page $x</option>";
						};
					  ?>
                                </select>
                        <input name="CurrentPage" type="hidden" id="CurrentPage" value="<?=$Page;?>" /></td>
                      <td width="21%" align="right" valign="middle"><?
						if($Page<$MaxPages){
					?>
                          <a href="modify.php?Page=<?=$Page+1;?>&<?=$NPPage?>" >Next &gt;&gt; </a>
                          <?
						};
					?></td>
                    </tr>
					<? }; ?>
                  </table></td>
                  </tr>
                <tr class="header">
                  <td width="21%"><strong> Name</strong></td>
                  <td width="21%"><strong>Email</strong></td>
                  <td width="44%"><strong>Mobile</strong></td>
                  <td width="7%" align="center"><strong>Modify</strong></td>
                  <td width="7%" align="center"><strong>Select</strong></td>
                </tr>
                <?php
					
					$Count=0;  
			while($myrow=mysql_fetch_row($rset)){
				$Count++;
				echo'<tr class="'.(($Count%2)==0 ? "row1" : "row2").'"> ';
				  echo"<td>$myrow[1]</td>";
          		  echo"<td>$myrow[2]</td>";
				  echo"<td>$myrow[3]</td>";
          		  if($Theme==2){
				  	echo"<td align=\"center\"><a href=\"add-horses.php?MembersID=$myrow[0]\"><img src=\"../../images/modify.gif\" width=\"47\" height=\"12\" border=\"0\"></a></td>";
				  };
				  echo"<td align=\"center\"><a href=\"modify-edit.php?id=$myrow[0]\"><img src=\"../../images/modify.gif\" width=\"47\" height=\"12\" border=\"0\"></a></td>";
          		  echo"<td><div align=\"center\"><input type=\"checkbox\" name=\"DFiles[]\" value=\"$myrow[0]\" class=\"checkboxes\"></div></td>";
				echo"</tr>";
			};
		?>
                <tr class="header">
                  <td colspan="4" align="right"><select name="MemberGroupsID" id="select" onchange="this.form.submit()">
                    <option value="">-Add To Contact Group</option>
                    <?php
					  	$Count=0;
					 	$sq2 = $r->RawQuery("SELECT id,Name FROM MemberGroups WHERE ClientsID='$ClientsID'",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							echo"<option value=\"$myrow[0]\">$myrow[1]</option>";
						};
							?>
                  </select>
                    <select name="AR_StreamID" id="AR_StreamID" onchange="this.form.submit()">
				  <option value="">-Add To Autoresponder Stream</option>
				  <?php
					  	$Count=0;
					 	$sq2 = $r->RawQuery("SELECT id,Name FROM AR_Stream WHERE ClientsID='$ClientsID'",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
							echo"<option value=\"$myrow[0]\">$myrow[1]</option>";
						};
							?>
                  </select>                  </td>
                  <td align="center">
                    <?php
							if($p->CheckCode(6)) echo'<input name="Submit" type="submit" class="formbuttons" value="Delete" onClick="return confirmSubmit()">';
						?>                  </td>
                </tr>
                <tr class="header">
                  <td colspan="6"><table width="100%"  border="0" cellpadding="4" cellspacing="0" >
                     <? if($MaxPages>1){?>
					<tr >
                      <td width="23%" align="left"><? if($Page>1){ ?>
                          <a href="modify.php?Page=<?=$Page-1;?>&<?=$NPPage?>" >&lt;&lt;Back</a>
                          <? }; ?></td>
                      <td width="56%" align="center">Jump to
                        <select name="Page2" id="Page2" onchange="this.form.submit()">
                            <?
					  	for($x=1;$x<=$MaxPages;$x++){
					  		$tmp=($x==$Page ? "selected" : "");
							echo"<option value='$x' $tmp>Page $x</option>";
						};
					  ?>
                                </select></td>
                      <td width="21%" align="right" valign="middle"><?
						if($Page<$MaxPages){
					?>
                          <a href="modify.php?Page=<?=$Page+1;?>&<?=$NPPage?>" >Next &gt;&gt; </a>
                          <?
						};
					?></td>
                    </tr>
					<? }; ?>
                  </table></td>
                  </tr>
              </table>
			  <? }else{?>
			  Please Input Some Contacts or Redifine Your Search
			  <? };?>
              <br />
              <strong>To Delete a Contact:</strong> select the checkbox for that Contact and then choose Delete button. <br />
                                  <strong>Tip:</strong> You can select multiple Contacts. <br />
                                  <br />
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
    
    <td width="81%">&nbsp;</td>
  </tr>
</table>
</body>
</html>
