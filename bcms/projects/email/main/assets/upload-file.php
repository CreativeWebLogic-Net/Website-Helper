<?
	include("../Admin_Include.php");
	
	$p->CheckPage(10);
	
	include("functions.inc.php");
	
	if($_GET['Parent']){
		$Parent=$_GET['Parent'];
	}elseif($_POST['Parent']){
		$Parent=$_POST['Parent'];
	}else{
	 	$Parent=0;
	}
	
	if($_POST['Submit']){
		if(!eregi(".php",$_FILES['FileName']['name'])){
			if(eregi(".swf",$_FILES['FileName']['name'])){
				$Type="flash";
			}else{
				$Type="image";
			}
			
			
			$m= new AddToDatabase();
			$m->AddPosts($_POST,$_FILES);
			$m->AddTable("Assets");
			$m->AddExtraFields(array("AssetFoldersID"=>$Parent,"Type"=>$Type));
			$m->MoveFile("FileName","../../assets/$Parent/");
			$m->DoStuff();
			$NewID=$m->ReturnID();
			$Message="File Uploaded";
		};
	};

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Insert File</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<script>
<?
	if($_POST['Submit']){
?>
	opener.location.href=opener.location.href;
<? }; ?>
</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style></head>

<body>
<form action="upload-file.php" method="post" enctype="multipart/form-data" name="form1">
  <table width="469" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="26" align="center"><img src="../Pics/largeBullet.gif" width="15" height="15" /></td>
      <td width="443"><span class="pagetitle">Insert File <span class="style1"><?=$Message;?></span></span></td>
    </tr>
  </table>
  <br>
  <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0" id="tablecell">
    <tr>
      <td width="51%"><strong>Path</strong></td>
      <td width="49%">
        <?=ShowPath($Parent,$ClientsID,"upload-file.php");?></td>
    </tr>
    <tr>
      <td><strong>File to upload </strong></td>
      <td><input name="FileName" type="file" id="FileName"></td>
    </tr>
    <tr>
      <td valign="top"><strong>Description</strong></td>
      <td><textarea name="Description" cols="50" rows="5" id="Description"></textarea></td>
    </tr>
    <tr align="right">
      <td colspan="2"><input name="Parent" type="hidden" id="Parent" value="<?=$Parent;?>">
      <input type="submit" name="Submit" value="Submit"></td>
    </tr>
  </table>
</form>
</body>
</html>
