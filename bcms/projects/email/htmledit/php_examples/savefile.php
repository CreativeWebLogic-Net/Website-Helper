<?
$filename = $_REQUEST["filename"];
$filename = str_replace("..", "", $filename);
$filename = str_replace("/", "", $filename);
$filename = str_replace("\\", "", $filename);

$fh = @fopen("../upload/data/$filename", "w+");
if ($fh) {
	fputs($fh, $_REQUEST["content"]);
	fclose($fh);
}
header("location: " . $_REQUEST["returnurl"]);
?>