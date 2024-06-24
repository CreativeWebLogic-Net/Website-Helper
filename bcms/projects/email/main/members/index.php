<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(4);
	
	if($_POST['Submit']){
		$m= new AddToDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddSkip(array("Submit"));
		$m->AddExtraFields(array("ClientsID"=>$ClientsID));
		$m->AddTable("Members");
		$m->DoStuff();
		$NewID=$m->ReturnID();
		if(is_array($_POST['MemberGroupsID'])){
			foreach($_POST['MemberGroupsID'] as $key =>$val){
				$sql= "INSERT INTO MemberGroupsLinks  (MembersID,MemberGroupsID) VALUES ('$NewID','$val')";
				$result = $r->RawQuery($sql);
			};
		};
		if(is_array($_POST['NewValue'])){
			if($result){
				foreach($_POST['NewValue'] as $key =>$val){
					$sql= "INSERT INTO GroupOptionValues  (MembersID,GroupOptionsID,Value) VALUES ('$NewID','$key','$val')";
					$result = $r->RawQuery($sql);
				};
			};
		};
		$Message="Contact Added";
		//header("Location: modify-edit.php?id=$NewID&Message=$Message");
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
<script>
<!--
function createRequestObject(){
	var request_o; //declare the variable to hold the object.
	var browser = navigator.appName; //find the browser name
	if(browser == "Microsoft Internet Explorer"){
		/* Create the object using MSIE's method */
		request_o = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		/* Create the object using other browser's method */
		request_o = new XMLHttpRequest();
	}
	return request_o; //return the object
}

var http = createRequestObject();

function get(){
	/* Create the request. The first argument to the open function is the method (POST/GET),
		and the second argument is the url... 
		document contains references to all items on the page
		We can reference document.form_category_select.select_category_select and we will
		be referencing the dropdown list. The selectedIndex property will give us the 
		index of the selected item. 
	*/
	document.getElementById("GroupOptions").innerHTML = "Loading....";
	var MemberGroupsID=document.getElementById("MemberGroupsID");
	var string;
	for(x=0;x<MemberGroupsID.length;x++){
		if(MemberGroupsID.options[x].selected==true) string+="_"+MemberGroupsID.options[x].value;
	}
	//alert(string);
	http.open('get', 'ajax-members-groups.php?Groups='+string);
	/* Define a function to call once a response has been received. This will be our
		handleProductCategories function that we define below. */
	http.onreadystatechange = handle; 
	/* Send the data. We use something other than null when we are sending using the POST
		method. */
	http.send(null);
}

/* Function called to handle the list that was returned from the internal_request.php file.. */
function handle(){
	/* Make sure that the transaction has finished. The XMLHttpRequest object 
		has a property called readyState with several states:
		0: Uninitialized
		1: Loading
		2: Loaded
		3: Interactive
		4: Finished */
	if(http.readyState == 4){ //Finished loading the response
		/* We have got the response from the server-side script,
			let's see just what it was. using the responseText property of 
			the XMLHttpRequest object. */
		var response = http.responseText;
		/* And now we want to change the product_categories <div> content.
			we do this using an ability to get/change the content of a page element 
			that we can find: innerHTML. */
		document.getElementById("GroupOptions").innerHTML = response;
	}
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
    
    <td align="right" valign="top"><a href="modify.php">Modify/Delete Contacts</a> </td>
  </tr>
  <tr>
    
    <td width="81%" valign="top" class="rightside"><br><table width="98%" height="98" border="0" align="center" cellpadding="0" cellspacing="5" class="wizardStyle">
      <tr>
        <td height="50" ><div align="left"><img src="../Pics/SMSMailProHeader.jpg" width="702" height="50" /></div></td>
      </tr>
      <tr>
        <td height="17" valign="top" class="MainLinks"><span class="pagetitle"><span class="pagetitle">Add New Contact </span><span class="RedText"><?php print $Message; ?></span></h1>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><form action="index.php"  method="post" name="form2" id="form2" onsubmit="YY_checkform('form2','Name','#q','0','You must fill in the Field Name.','Email','S','2','Must be a valid Email Address.');return document.MM_returnValue" >
                          <br />
                          <br />
                        Complete the member details below.<br />
                        <br />
                        <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
                        <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                          <tr>
                            <td width="98"><strong> Full Name<span class="RedText">*</span></strong></td>
                            <td width="416"><input name="Name" type="text" id="Name" value="<?=$_GET['Name']?>" size="45" /></td>
                          </tr>
                          <tr>
                            <td><strong> Email</strong></td>
                            <td><input name="Email" type="text" id="Email" value="<?=$_GET['Email']?>" size="45" /></td>
                          </tr>
                          <? if($Theme!=2){ ?>
                          <tr>
                            <td valign="top"><strong>Company</strong></td>
                            <td><input name="Company" type="text" id="Company" value="<?=$_GET['Company']?>" size="45" /></td>
                          </tr>
                          <tr>
                            <td valign="top"><strong>Address</strong></td>
                            <td><textarea name="Address" cols="30" rows="3" wrap="virtual" id="Address"></textarea></td>
                          </tr>
                          <tr>
                            <td><strong>Suburb</strong></td>
                            <td><input name="Suburb" type="text" id="Suburb" size="45" /></td>
                          </tr>
                          <tr>
                            <td><strong>Postcode</strong></td>
                            <td><input name="PostCode" type="text" id="PostCode" size="45" /></td>
                          </tr>
                          <tr>
                            <td><strong>State</strong></td>
                            <td><input name="State" type="text" id="State" size="45" /></td>
                          </tr>
                          <tr>
                            <td><strong>Country</strong></td>
                            <td><input name="Country" type="text" id="Country" value="Australia" size="45" /></td>
                          </tr>
                          <tr>
                            <td><strong>Phone</strong></td>
                            <td><input name="Phone" type="text" id="Phone" size="45" /></td>
                          </tr>
                          <tr>
                            <td><strong>Fax</strong></td>
                            <td><input name="Fax" type="text" id="Fax" size="45" /></td>
                          </tr>
                          <? }; ?>
                          <tr>
                            <td><strong>Mobile<span class="RedText">*</span></strong></td>
                            <td><strong><span class="RedText">International Dialing Codes</span> <span class="RedText">Must Be Used</span> and leading zeros or pluses must be removed eg for a mobile in Australia the number would be 61123456789</strong>
                      <input name="Mobile" type="text" id="Mobile" size="45" /></td>
                          </tr>
                          <tr>
                            <td><strong>Member Groups </strong></td>
                            <td><select name="MemberGroupsID[]" size="7" id="MemberGroupsID" multiple="multiple" onchange="get()">
                              <?php
					$sq2 = $r->RawQuery("SELECT id,Name FROM MemberGroups WHERE ClientsID='$ClientsID' ",$db);
					while ($myrow = mysql_fetch_row($sq2)) {
						echo"<option value='$myrow[0]'>$myrow[1]</option>";
					};
				  ?>
                            </select>                            </td>
                          </tr>
                          <tr>
                            <td height="25" colspan="2"><span id="GroupOptions"></span></td>
                          </tr>
                          <tr>
                            <td height="25">&nbsp;</td>
                            <td height="25"><input name="Submit" type="submit" class="formbuttons" value="Save">
                      <input name="CDate" type="hidden" id="CDate" value="<?php print date("Y-m-d");  ?>" /></td>
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
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td width="81%">&nbsp;</td>
  </tr>
</table>
</body>
</html>
