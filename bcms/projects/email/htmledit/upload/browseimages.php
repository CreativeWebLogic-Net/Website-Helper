<?
	session_start();
	
	
	define('BASEURL','/site/');
	
	include("../../DB_Class.php");
	include("../../Perms_Class.php");
	
	$APerms=new Permissions($_SESSION['AdminKey'],0,$_SESSION['SU']);
	$APerms->CheckAdminSession();
	
	include("../../main/assets/functions.inc.php");

	$r= new ReturnRecord();
	
	
	
	if($_GET['id']) $id=$_GET['id'];
	
	if($_GET['returncode']) $returncode=$_GET['returncode'];

	if($_GET['cc']) $cc=$_GET['cc'];
	
	
	if(!$cc) $cc=0;
	
	if(!$id){
		$sq2=$r->rawQuery("SELECT MIN(Asset_Instance.id) FROM Asset_Instance,Module_Instance WHERE Asset_Instance.Module_InstanceID=Module_Instance.id");  
		while ($myrow = mysql_fetch_row($sq2)) {
			
				$id=$myrow[0];
			
		};
	};
	
	$imagediruri = $_SERVER["HTTPS"] ? "https://" : "http://";   # probably exported by Apache only ...
	$imagediruri .= $_SERVER["HTTP_HOST"]."/".Assets."/";
	//$imagediruri .= "/".Assets."/";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Add Item</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/management.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../utils.js"></script>
<script language="javascript" src="../mydlg.js"></script>
<script language="javascript">
    top.document.title = "Browse ..."
</script>

<script>
function getSel(){
	var CatID=0;
	if(document.selform.Sel.length>0){
		for(x=0;x<document.selform.Sel.length;x++){
			if(document.selform.Sel[x].checked){
				var Source=document.selform.Sel[x].value;
			}
		}
	}else{
		var Source=document.selform.Sel.value;
	}
	var CatID=document.selform.cc.value;
	
	MyDlgHandleOK('<?=$imagediruri;?>'+CatID+'/'+Source)
	
	//CallReturn(CatID,Source);
}

function CallReturn(CatID,FileName){
	var returncode=document.selform.returncode.value;
	window.opener.thereturn(CatID,FileName,returncode);
	window.close();
}
</script>

</head>

<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><form action="browseimages.php"  method="post" enctype="multipart/form-data" name="selform" id="selform" onSubmit="YY_checkform('form2','Name','#q','0','You must fill in the field Name.','Email','S','2','You must fill in a valid Email Address.','UserName','#q','0','You must fill in the field Username.','Password','#q','0','You must fill in the field Password','Password2','#Password','6','Passwords must match.');return document.MM_returnValue" >
              <table width="100%"  border="0">
                <tr>
                  <td><span class="pageheading">Select Asset </span><span class="RedText"><?php print $Message; ?></span></td>
                  <td><select name="id">
                  	<?php
					  
					 	$sq2=$r->rawQuery("SELECT Asset_Instance.id,Description,APermsID FROM Asset_Instance,Module_Instance WHERE Asset_Instance.Module_InstanceID=Module_Instance.id");  
						while ($myrow = mysql_fetch_row($sq2)) {
							if($APerms->HasAPerm($myrow[2])){
								if($id==$myrow[0]){
									echo"<option value='$myrow[0]' selected>$myrow[1]</option>";
								}else{
									echo"<option value='$myrow[0]'>$myrow[1]</option>";
								}
							};
						};
					?>
				  
				  </select></td>
                </tr>
                <tr>
                  <td width="74%"><br></td>
                  <td width="26%"><div align="center"></div></td>
                </tr>
              </table>
              
              <br>
              <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                <tr>
                  <td width="163"><strong>Category Path </strong></td>
                  <td colspan="2"><a href="browseimages.php?id=<?=$id;?>&cc=0&returncode=<?=$returncode;?>">ROOT</a>
                      <?=showpathSelectImage($id,$cc,$returncode);?></td>
                </tr>
                <tr>
                  <td colspan="3"><div align="center"></div>                    <div align="center">
                  </div>                    
                  <div align="center">
                    <input name="cc" type="hidden" id="returncode22" value="<?=$cc;?>">
                    <input name="returncode" type="hidden" id="returncode" value="<?=$returncode;?>">                      
                    <input name="Select" type="button"  class="formbuttons" id="Select" value="Select Asset" onClick="getSel()">
                    </div></td>
                </tr>
              </table>
              <br>
              <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td width="157"><strong>Name</strong></td>
                  <td width="308"><strong>Description</strong></td>
                </tr>
                <?php
					  
					 	$sq2=$r->rawQuery("SELECT id,Title,APermsID,Description FROM Asset_Categories WHERE Asset_InstanceID='$id' AND ParentID='$cc'");  
						while ($myrow = mysql_fetch_row($sq2)) {
							if($APerms->HasAPerm($myrow[2])){
						?>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td><a href="browseimages.php?id=<?=$id;?>&cc=<?=$myrow[0];?>&returncode=<?=$returncode;?>"><img src="../../main/assets/images/folder.gif" width="16" height="15" border="0" title="Open Folder"></a></td>
                  <td><a href="browseimages.php?id=<?=$id;?>&cc=<?=$myrow[0];?>&returncode=<?=$returncode;?>">
                    <?=$myrow[1];?>
                  </a></td>
                  <td><?=$myrow[3];?></td>
                </tr>
                <?
					  		};
						};
					  ?>
                <?php
					  
					 	$sq2=$r->rawQuery("SELECT id,ScreenName,APermsID,Description,FileName FROM Asset_Items WHERE Asset_InstanceID='$id' AND Asset_CategoriesID='$cc' AND Type='Image'");  
						while ($myrow = mysql_fetch_row($sq2)) {
							if($APerms->HasAPerm($myrow[2])){
						?>
                <tr>
                  <td width="20"><input type="radio" name="Sel" value="<?=$myrow[4];?>"></td>
                  <td><a href="<?=$AssetBasePath.$cc."/".$myrow[4];?>" target="_blank"><img src="../../main/assets/images/item.gif" border="0" title="Open File"></a></td>
                  <td><a href="<?=$AssetBasePath.$cc."/".$myrow[4];?>" target="_blank">
                    <?=$myrow[1];?>
                  </a></td>
                  <td><?=$myrow[3];?></td>
                </tr>
                <?
					  		};
						};
					  ?>
              </table>
              <p><br>
              </p>
              </form></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
