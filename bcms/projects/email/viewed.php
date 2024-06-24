<?
	include("DB_Class.php");
	$r=new ReturnRecord();
	
	if($_GET['id']) $id=$_GET['id'];
	$r->RawQuery("UPDATE SentMessages SET EmailReceived='Opened' WHERE id='$id'");
	header("Content-type: image/gif");
    $image = imagecreatetruecolor(1, 1);
	$trans_color = imagecolorallocate($image, 255, 0, 0);
	$color = imagecolorallocate($image, 255, 255, 255);
	imagecolortransparent($image, $trans_color);
	
	imagegif($image);
?>
