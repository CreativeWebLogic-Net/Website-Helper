<?php
	session_start();
	if(!$_SESSION['SecureKey']){
		header("Location: ../../index.php");
	};
	include("../../cast128.php");
	$e = new cast128;
	include("../../DB_Class.php");
	$r=new ReturnRecord();
	$e->setkey("kjhnsdf fdsiohjf fasdujhf asduijdsi");
	$TmpKey=split("-",$e->decrypt($_SESSION['SecureKey']));
	$AdminKey=$TmpKey[0];
	$ClientsID=$TmpKey[1];
	$Theme=$TmpKey[2];
	$Add=false;
	$sq2 = $r->RawQuery("SELECT Code FROM Permissions WHERE AdministratorsID='$AdminKey' AND Code='9'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$Add=true;
	};
	
	$sq2 = $r->RawQuery("SELECT Credits,CreditWarning,Name,BillEmail,ApiID,CUsername,CPassword FROM Clients WHERE id='$ClientsID'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$Credits=$myrow[0];
		$CreditWarning=$myrow[1];
		$Name=$myrow[2];
		$BillEmail=$myrow[3];
		$ApiID=$myrow[4];
		$CUsername=$myrow[5];
		$CPassword=$myrow[6];
	};	
		
	if($_POST['Submit']){
		include("../../maillib3.php");
		include("../../maillib.php");
		include("../../DB_Class.php");
		include("../../functions.inc.php");
		$m= new ReturnRecord();
		$m->AddTable("AdminEmails");
		$m->AddSearchVar(1);
		$Insert=$m->GetRecord();
		
		$Prev=array();
		$MembersHorsesIDArray=array();
		$ArtistList2=array();	
		$EmailList=array();
		switch($SType){
			case 0:
				if(is_array($ArtistList)){
					foreach($ArtistList as $val){
						$SArr=split(",",$val);
						$ArtistList2[]=$SArr[0];
						$EmailList[]=$SArr[1];
					}
				};
				break;
			case 6:
				if(is_array($ArtistList)){
					foreach($ArtistList as $val){
						$SArr=split(",",$val);
						$ArtistList2[]=$SArr[0];
						$EmailList[]=$SArr[1];
					}
				};
				break;
			case 1:
				for($x=0;$x<count($ArtistList);$x++){
					$sq2 = $r->RawQuery("Select DISTINCT Mobile,Email FROM Members WHERE PostCode='$ArtistList[$x]' AND ClientsID='$ClientsID'",$db);
					while ($myrow = mysql_fetch_row($sq2)) {
						$ArtistList2[]=$myrow[0];
						$EmailList[]=$myrow[1];
					};
				}
				break;
			case 2:
				for($x=0;$x<count($ArtistList);$x++){
					$sq2 = $r->RawQuery("Select DISTINCT Mobile,Email FROM Members WHERE State='$ArtistList[$x]' AND ClientsID='$ClientsID'",$db);
					while ($myrow = mysql_fetch_row($sq2)) {
						$ArtistList2[]=$myrow[0];
						$EmailList[]=$myrow[1];
					};
				}
				break;
			
						
			case 7:
				for($x=0;$x<count($ArtistList);$x++){
					$sq2 = $r->RawQuery("Select DISTINCT Mobile,Email FROM Members WHERE Suburb='$ArtistList[$x]' AND ClientsID='$ClientsID'",$db);
					while ($myrow = mysql_fetch_row($sq2)) {
						$ArtistList2[]=$myrow[0];
						$EmailList[]=$myrow[1];
					};
				}
				break;
			case 8:
				for($x=0;$x<count($ArtistList);$x++){
					$sq2 = $r->RawQuery("Select DISTINCT Mobile,Email FROM Members WHERE Country='$ArtistList[$x]' AND ClientsID='$ClientsID'",$db);
					while ($myrow = mysql_fetch_row($sq2)) {
						$ArtistList2[]=$myrow[0];
						$EmailList[]=$myrow[1];
					};
				}
				break;
			case 10:
				for($x=0;$x<count($ArtistList);$x++){
					$sq2 = $r->RawQuery("SELECT DISTINCT Mobile,MembersHorses.id,Email FROM Members,MembersHorses WHERE MembersHorses.MembersID=Members.id AND MembersHorses.HorsesID='$ArtistList[$x]'",$db);
					while ($myrow = mysql_fetch_row($sq2)) {
						$ArtistList2[]=$myrow[0];
						$MembersHorsesIDArray[]=$myrow[1];
						$EmailList[]=$myrow[2];
					};
				}
				break;
			case 11:
				for($x=0;$x<count($ArtistList);$x++){
					$sq2 = $r->RawQuery("SELECT DISTINCT Mobile,Email FROM Members,MemberGroupsLinks WHERE Members.id=MemberGroupsLinks.MembersID AND MemberGroupsID='$ArtistList[$x]'",$db);
					while ($myrow = mysql_fetch_row($sq2)) {
						$ArtistList2[]=$myrow[0];
						$EmailList[]=$myrow[2];
					};
				}
				break;
			
			
		}
                        
                        
		
		$sq2 = $r->RawQuery("SELECT Mobile,Email FROM Administrators WHERE id='$AdminKey'",$db);
		while ($myrow = mysql_fetch_row($sq2)) {
			$From=$myrow[0];
			$FromEmail=$myrow[1];
		};
		//Main email sending part
		if($SendEmail){
			$em=new Mail();
			$em->Subject($Subject);
			$em->From($FromEmail);
			$em->To($FromEmail);
			$em->Bcc($EmailList);
			$em->Body($Body);
			$em->Send();
			//print_r($EmailList);
			//echo"=============================================<br>";
			//print_r($ArtistList2);
		}
		
		//Main Sending Code
		
		include("../../SMS_Class.php");
		$ArtistList2=array_merge($QNumbers,$ArtistList2);
		$s= new SMS();
		$s->SetLogin($ApiID,$CUsername,$CPassword);
		$s->SetFrom($From);
		$s->SetMessage($Body);
		for($x=0;$x<count($ArtistList2);$x++){
			$s->AddTo($ArtistList2[$x]);
		};
		$s->Send();
		$Errors=$s->GetErrors();
		$MesgID=$s->GetMsgID();
		
		if($Errors=="") $Message="Messages Sent";
		else $Message=$Errors;
			
		$l=new AddToDatabase();
		$l->AddPosts($_POST,$_FILES);
		$l->AddTable("Logs");
		$l->AddExtraFields(array("ClientsID"=>$ClientsID,"AdministratorsID"=>$AdminKey,"Message"=>$Body));
		$l->AddFunctions(array("MDate"=>"CURDATE()"));
		$l->DoStuff();
		$LogsID=$l->ReturnID();
		
		$l->AddTable("SentMessages");
		foreach($MesgID as $Number => $MsgID){
			$l->Reset();
			$l->AddExtraFields(array("LogsID"=>$LogsID,"MsgID"=>$MsgID,"Number"=>$Number));
			$l->DoStuff();
		};
		
		// delete member horse associations
		if(($Theme==2)&&($SType==10)){
			$m= new DeleteFromDatabase();
			$m->AddIDArray($MembersHorsesIDArray);
			$m->AddTable("MembersHorses");
			$m->DoDelete();
			$m= new DeleteFromDatabase();
			$m->AddIDArray($ArtistList);
			$m->AddTable("Horses");
			$m->DoDelete();
		};
		
		
		/*
		//======================================================
		$First=true;
		$To="";
		$ArtistList2=array_merge($QNumbers,$ArtistList2);
		$SMSCount=0;
		for($x=0;$x<count($ArtistList2);$x++){
			if(!in_array($ArtistList2[$x],$Prev)){
				if($ArtistList2[$x]!=""){
					if($First){
						$To=$ArtistList2[$x];
						$First=false;
					}else{
						$To=$To.",".$ArtistList2[$x];
					}
					$SMSCount++;
				};
				$Prev[]=$ArtistList2[$x];
			};
		};
		if($To!=""){
			//print $To;
			$MsgMultiplier=ceil(strlen($Body)/160);
			$SMSCount=$SMSCount*$MsgMultiplier;
			if($SMSCount<=$Credits){
				// Update credits
				$Credits=$Credits-$SMSCount;
				$sql= "UPDATE Clients SET Credits='$Credits' WHERE id='$ClientsID'";
				$result = $r->RawQuery($sql);
				AddLog($ClientsID,$AdminKey,$SMSCount,$Body);
				include("send-function.php");
				$Message="$SMSCount SMS Sent";
				if($Credits<=$CreditWarning){
					$Message.=", WARNING You Are At 10% Of Credits Since Your Last Purchase";
					// Send Email
					api_email($Name, $BillEmail, "I4U SMS", $Insert['General'],"I4U SMS Warning","WARNING You Are At 10% Of Credits Since Your Last Purchase, You Have $Credits Credits Left","WARNING You Are At 10% Of Credits Since Your Last Purchase, You Have $Credits Credits Left", "WARNING You Are At 10% Of Credits Since Your Last Purchase, You Have $Credits Credits Left"); 
				}
			}else{
				$Message=" Sorry You Wish To Send $SMSCount SMS And You Only Have $Credits Credits Left";
			};
		};
		*/
	};
	require_once("../../SMS_Class.php");
	$tr = new SMS();
	$tr->SetLogin($ApiID,$CUsername,$CPassword);
	$balTemp = $tr->GetBalance();
	$balcred = $balTemp;
	$balcred = substr($balcred,7);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSMailPro - Email and SMS Marketing Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../cssmain.css" rel="stylesheet" type="text/css" />
<link href="../../css/general.php" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {color: #000000}
.style3 {color: #009900}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function AddNumber(){
	var QNum=document.getElementById("QuickNumbers");
	QNum.innerHTML=QNum.innerHTML+'<input name="QNumbers[]" type="text" value="61"><br>';
}

function Keypressed(){
	var CharSpan=document.getElementById("CharCount");
	var SMSSpan=document.getElementById("SMSCount");
	var DocBody=document.form2.Body.value;
	CharSpan.innerHTML=DocBody.length;
	SMSSpan.innerHTML=Math.ceil(DocBody.length/160);
}

function confirmSubmit()
{

var DocBody=document.form2.Body.value;
var amount =Math.ceil(DocBody.length/160);
if(amount<=0){
	var agree=confirm("Are you sure you wish to continue?");
	if (agree)
		return true ;
	else
		return false ;
}
else{
	var agree=confirm("You are sending "+ amount +" Messages per contact. Are you sure you wish to continue?");
	if (agree)
		return true ;
	else
		return false ;
	}
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
<div id="logo"><img src="../../i/logo.jpg" alt="logoalt" width="340" height="70" /></div>
<span class="head"></span>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="19%" valign="top" ><? include("../../menu_files/menunew.php");?>
<span class="head">
<?php if($SU) include("../SU/drop-down.php"); ?>
</span></td>
    <td width="81%" valign="top" class="rightside"><span class="pagetitle"><span class="pagetitle">Send SMS </span><span class="RedText"><?php print $Message; ?></span></h1>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><form action="index.php"  method="post" name="form2" id="form2" onsubmit="YY_checkform('form2','Name','#q','0','You must fill in the field Name.','Email','#S','2','You must fill in a valid Email Address.');return document.MM_returnValue" >
                      <p>&nbsp;</p>
                      <div align="center"><strong><span class="style3">You Have <?php print $balcred;?> Credits Left </span><br />
                      </strong> </div>
                      <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                        <tr>
                          <td><select name="SType" id="select2" onchange="this.form.submit()">
                              <option value="0" <?php if($SType==0){echo "selected";}; ?>>Select By Name Contacts</option>
                              <option value="6" <?php if($SType==6){echo "selected";}; ?>>Select By Name Administrators</option>
                              <? if($Theme==2){ ?>
                              <option value="10" <?php if($SType==10){echo "selected";}; ?>>Select By Horse</option>
                              <? }else{ ?>
                              <option value="1" <?php if($SType==1){echo "selected";}; ?>>Select By PostCode</option>
                              <option value="2" <?php if($SType==2){echo "selected";}; ?>>Select By State</option>
                              <option value="7" <?php if($SType==7){echo "selected";}; ?>>Select By Suburb</option>
                              <option value="8" <?php if($SType==8){echo "selected";}; ?>>Select By Country</option>
							  <option value="11" <?php if($SType==11){echo "selected";}; ?>>Select By Contact Group</option>
                              <? }; ?>
                          </select></td>
                          <td><strong>Character Count </strong></td>
                          <td width="74"><span id="CharCount">0</span></td>
                          <td width="80"><strong>SMS Per Contact </strong></td>
                          <td width="53"><span id="SMSCount">0</span></td>
                        </tr>
                        <tr>
                          <td width="181" rowspan="4"><select name="ArtistList[]" size="19" multiple="multiple" id="select">
                              <?php
                       require("database.php");
					    switch($SType){
							case 0:
								$sq2 = $r->RawQuery("Select DISTINCT Mobile,Name,Email FROM Members WHERE ClientsID='$ClientsID' ORDER BY Name ",$db);
								break;
							case 6:
								$sq2 = $r->RawQuery("Select DISTINCT Mobile,Name,Email FROM Administrators WHERE ClientsID='$ClientsID' ORDER BY Name ",$db);
								break;
							case 1:
								$sq2 = $r->RawQuery("Select DISTINCT PostCode,PostCode FROM Members WHERE ClientsID='$ClientsID' ORDER BY PostCode",$db);
								break;
							case 2:
								$sq2 = $r->RawQuery("Select DISTINCT State,State FROM Members WHERE ClientsID='$ClientsID' ORDER BY State",$db);
								break;
							
							case 7:
								$sq2 = $r->RawQuery("Select DISTINCT Suburb,Suburb FROM Members WHERE ClientsID='$ClientsID' ORDER BY Suburb",$db);
								break;
							case 8:
								$sq2 = $r->RawQuery("Select DISTINCT Country,Country FROM Members WHERE ClientsID='$ClientsID' ORDER BY Country",$db);
								break;
							case 10:
								$sq2 = $r->RawQuery("Select DISTINCT id,Name FROM Horses ORDER BY Name",$db);
								break;
							case 11:
								$sq2 = $r->RawQuery("Select DISTINCT id,Name FROM MemberGroups WHERE ClientsID='$ClientsID' ORDER BY Name",$db);
								break;
							
						
						}
                        while ($myrow = mysql_fetch_row($sq2)) {
							if(isset($myrow[2])) $myrow[0]=$myrow[0].",".$myrow[2];
							print("<option value='$myrow[0]'>$myrow[1]</option>");
						};
						
                 ?>
                          </select></td>
                          <td valign="top"><strong>Log Title</strong></td>
                          <td colspan="3" valign="top"><input name="MsgTitle" type="text" id="MsgTitle" size="32" /></td>
                        </tr>
                        <tr >
                          <td width="106" valign="top"><strong>Message</strong></td>
                          <td colspan="3" valign="top"><textarea name="Body" cols="32" rows="5" id="textarea" onkeyup="Keypressed()"></textarea></td>
                        </tr>
                        <tr >
                          <td valign="top"><strong>Also Send Email
                                <input name="SendEmail" type="checkbox" id="SendEmail2" value="1" checked="checked" />
                          </strong></td>
                          <td align="left" valign="middle">
                          <div align="center"><strong>Email Subject</strong></div></td>
                          <td colspan="2" align="left" valign="middle"><input name="Subject" type="text" id="Subject" /></td>
                        </tr>
                        <tr >
                          <td valign="top"><div align="center">
                              <?php
							if($Add){
								echo'<strong>Quick Numbers<br>
                        			<input name="Add" type="button" id="Add" value="Add" onClick="AddNumber()"> ';
							};
						?>
                          </div></td>
                          <td colspan="3" align="center" valign="top"><span id="QuickNumbers"></span></td>
                        </tr>
                        <!-- hide this as it isn't used start -->
                        <!-- hide this as it isn't used end -->
                        <tr>
                          <td colspan="5"><div align="center">
                              <input type="submit" name="Submit" value="Send SMS" onclick="return confirmSubmit()" />
                          </div></td>
                        </tr>
                        <!-- hide this as it isn't used start -->
                        <!-- hide this as it isn't used end -->
                    </table>
                      <p><br />
                          <br />
                          <br />
                      </p>
                  </form></td>
                </tr>
            </table></td>
          </tr>
        </table>
        <p>&nbsp;</p></td>
  </tr>
</table>
<div id="midway">
<object type="application/x-shockwave-flash"
data="../../i/glimmer.swf" 
width="344" height="128">
<param name="movie" 
value="../../i/glimmer.swf" />
</object></div>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="19%">&nbsp;</td>
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
