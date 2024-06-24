<?php
	include("../Admin_Include.php");
	
	if($_POST['Submit']){

		
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
    <td align="right" valign="top" >&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"  class="rightside"><span class="pagetitle">Select Number Of Credits To Buy </span><span class="RedText"><?php print $Message; ?></span></h1>
      <table width="730" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="730"><form action="gateway.php"  method="post" name="form2" target="_top" id="form2"  >
              1 credit is equal to 1 email<br />
              SMS messages can cost from between 6.5 and 20 credits depending on the destination.<br />
              Credits do not expire. All prices are in Australian Dollars.<br />
              <br />
              <table width="100%" border="0" cellpadding="3" cellspacing="1" >
                <tr  class="header">
                  <td width="17%" rowspan="2"><strong>Number Of Credits</strong></td>
                  <td width="12%" rowspan="2" align="center"> Price </td>
                  <td colspan="2" align="center">  Emails </td>
                  <td height="21" colspan="2" align="center">Maximum SMS</td>
                  <td colspan="2" align="center">Minimum SMS</td>
                  <td width="9%" rowspan="2" align="center"><strong>Select</strong></td>
                </tr>
                <tr  class="header">
                  <td width="12%" align="center">Number</td>
                  <td width="11%" align="center">Cost Each</td>
                  <td width="8%" align="center">Number</td>
                  <td width="11%" align="center">Cost Each</td>
                  <td width="9%" align="center">Number</td>
                  <td width="11%" align="center">Cost Each</td>
                </tr>
                <?php
					 	$Count=0; 
						$sq2 = $r->RawQuery("SELECT id,NumberOfCredits,Cost FROM CreditsCost ORDER BY Cost",$db);
						while ($myrow = mysql_fetch_row($sq2)) {
						$Count++;
							echo'<tr class="'.(($Count%2)==0 ? "row1" : "row2").'"> ';
							  echo"<td>$myrow[1]</td>";
							  echo"<td>\$ ".number_format($myrow[2],0)."</td>";
							  echo"<td align='center'>$myrow[1]</td>";
							  echo"<td align='center'>\$ ".number_format($myrow[2]/$myrow[1],2)."</td>";
							  $MaxNumberSMS=$myrow[1]/6.4;
							  echo"<td align='center'>".number_format($MaxNumberSMS,0)."</td>";
							  echo"<td align='center'>\$ ".number_format($myrow[2]/$MaxNumberSMS,2)."</td>";
							  $MinNumberSMS=$myrow[1]/20;
							  echo"<td align='center'>".number_format($MinNumberSMS,0)."</td>";
							  echo"<td align='center'>\$ ".number_format($myrow[2]/$MinNumberSMS,2)."</td>";
							  echo"<td><div align=\"center\"><input type=\"radio\" name=\"PaymentID\" value=\"$myrow[0]\" class=\"checkboxes\" $tmp ></div></td>";
							echo"</tr>";
						};
					?>
                <tr align="right"  class="header">
                  <td colspan="9"><input type="submit" name="Submit" value="Submit" /></td>
                </tr>
              </table>
            <br />
              <br />
          </form></td>
        </tr>
      </table>
    <p>&nbsp;</p></td>
  </tr>
</table>
<div id="midway"></div>
</body>
</html>
