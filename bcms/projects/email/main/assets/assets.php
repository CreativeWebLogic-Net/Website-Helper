<?
	include("../Admin_Include.php");
	
	$p->CheckPage(11);
	
	include("functions.inc.php");
	if($_GET['Parent']){
		$Parent=$_GET['Parent'];
	}elseif($_POST['Parent']){
		$Parent=$_POST['Parent'];
	}else{
		$Parent=0;
	};
	
	if($_GET['field_name']) $_SESSION['field_name']=$_GET['field_name'];
	if($_GET['type']) $_SESSION['type']=$_GET['type'];
	
	if($_POST['Delete']){
		if(is_array($_POST['Items'])){
			foreach($_POST['Items'] as $ItemID){
				DeleteAsset($ItemID);
			}
			$Message="Assets Deleted";
		}
		if(is_array($_POST['Folders'])){
			foreach($_POST['Folders'] as $FolderID){
				DeleteAssetFolder($FolderID);
			}
			$Message.="/ Folders Deleted";
		}
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Asset Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<script>
<!--
function Return(url){
		//alert(url);
		window.opener.CallBackReturn("<?=$_SESSION['field_name'];?>", "http://<?=$_SERVER['HTTP_HOST'];?>/assets/<?=$Parent;?>/"+url);
		window.close();
	}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>

<body>
<form name="form1" method="post" action="assets.php">
  <table width="100%"  border="0" cellspacing="2" cellpadding="2">
    <tr align="center" class="row1">
      <td width="51%"><a href="javascript: MM_openBrWindow('create-folder.php?Parent=<?=$Parent;?>','InsertFolder','width=500,height=200')" >Insert Folder</a></td>
      <td width="49%">
	  <?
	  	if($Parent!=0){
	  ?>
	  <a href="javascript: MM_openBrWindow('upload-file.php?Parent=<?=$Parent;?>','InsertFolder','width=550,height=300')" >Insert File</a> 
	  <?
	  	};
	  ?>
	  </td>
    </tr>
    <tr  class="row2">
      <td colspan="2">Path : <a href="assets.php?Parent=0">Root</a>
        <?=ShowPath($Parent,$ClientsID,"assets.php");?></td>
    </tr>
  </table>
  <input name="Parent" type="hidden" id="Parent" value="<?=$Parent;?>">
  <br>
  <table width="100%" border="0" cellpadding="3" cellspacing="1" id="table">
    <tr class="header">
      <td><input name="Delete" type="submit"  class="formbuttons" id="Submit" onClick="return confirmSubmit()" value="Delete"></td>
      <td width="55"><span class="style3">Select</span></td>
      <td width="155" class="style1 tabletitle"><strong>Name</strong></td>
      <td width="514" class="style1 tabletitle"><strong>Description</strong></td>
    </tr>
    <?php
					  	$Count=0;
					 	$sq2=$r->rawQuery("SELECT id,Name FROM AssetFolders WHERE ClientsID='$ClientsID' AND Parent='$Parent'");  
						while ($myrow = mysql_fetch_row($sq2)) {
							
								$Count++;
						?>
    <tr class="<?=(($Count%2)==0 ? "row1" : "row2"); ?>">
      <td width="52" ><input name="Folders[]" type="checkbox" id="Folders[]" value="<?=$myrow[0];?>"></td>
      <td align="center" ><a href="assets.php?Parent=<?=$myrow[0];?>"><img src="images/folder.gif" width="16" height="15" border="0" title="Folder"></a></td>
      <td><?=$myrow[1];?></td>
      <td >&nbsp;</td>
    </tr>
    <?
					  		
						};
					  ?>
    <?php
					  
					 	$sq2=$r->rawQuery("SELECT id,Filename,Description FROM Assets WHERE AssetFoldersID='$Parent'");  
						while ($myrow = mysql_fetch_row($sq2)) {
							$Count++;
						?>
    <tr class="<?=(($Count%2)==0 ? "row1" : "row2"); ?>">
      <td><input type="checkbox" name="Items[]" value="<?=$myrow[0];?>"></td>
      <td align="center"><a href="javascript:Return('<?=$myrow[1];?>')"><img src="images/item.gif" border="0" title="File"></a></td>
      <td><a href="../../assets/<?=$Parent;?>/<?=$myrow[1];?>" target="_blank"><?=$myrow[1];?></a></td>
      <td><?=$myrow[2];?></td>
    </tr>
    <?
					  		
						};
					  ?>
  </table>
</form>
</body>
</html>
