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
		$m= new AddToDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddTable("AssetFolders");
		$m->AddExtraFields(array("ClientsID"=>$ClientsID));
		$m->DoStuff();
		$NewID=$m->ReturnID();
		
		
		
		// create template folder
		if(!file_exists("../../assets/$NewID")){
			$oldumask = umask(0);
			mkdir("../../assets/$NewID", 0777); // or even 01777 so you get the sticky bit set
			umask($oldumask);
		}
	};

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Insert Folder</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

<script>
<?
	if($_POST['Submit']){
?>
	opener.location.href=opener.location.href;
<? }; ?>
</script>
</head>

<body>
<form name="form1" method="post" action="create-folder.php">
  <table width="469" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="26" align="center"><img src="../Pics/largeBullet.gif" width="15" height="15" /></td>
      <td width="443"><span class="pagetitle">Insert Folder </span></td>
    </tr>
  </table>
  <br>
  <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0" id="tablecell">
    <tr>
      <td width="45%"><strong>Path</strong></td>
      <td width="55%"><?=ShowPath($Parent,$ClientsID,"create-folder.php");?></td>
    </tr>
    <tr>
      <td><strong>Folder Name </strong></td>
      <td><input name="Name" type="text" id="Name" size="50"></td>
    </tr>
    <tr>
      <td colspan="2"><div align="right">
        <input name="Parent" type="hidden" id="Parent" value="<?=$Parent;?>">
        <input type="submit" name="Submit" value="Submit">
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>
