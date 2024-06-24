<?php
	require_once("cmsconfig.php");

	header("pragma: no-cache");

    // avoid users change anything outside allowed directory
    $filename = isset($_POST['filename']) ? $_POST['filename'] : (isset($_GET['filename']) ? $_GET['filename'] : "");
    $filename = str_replace("../", "", $filename);

    if (isset($_REQUEST['pagesrc'])) {
		$content = str_replace("\r\n", "\n", $_REQUEST['pagesrc']);
        // save the file
        $fh = fopen("$path$filename", "wt");
        fputs($fh, $content);
        header("location: cms.php");
        exit;
    }
	else if (isset($_REQUEST['mycancel'])) {
        header("location: cms.php");
        exit;
	}
?><html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8" />
<link type="text/css" href="../style.css" rel="stylesheet" />
<title>SimpleCMS</title>
<?php
    require("../htmledit.php");

    // Output HTML and JavaScript codes to initialize QWebEditor library.
    HtmlEditInit2('/htmledit/');
?>
</head>
<body marginwidth=10 marginheight=10 leftmargin=10 topmargin=10 onload="HtmlEditFocus('myeditor')">
<div class="cmstitle">SimpleCMS</div>
<form action="cmsedit.php?filename=<? echo $filename; ?>" method="post">
<fieldset class="boxstyle">
<legend>Actions</legend>
<div style="margin: 10px;">
<input type="submit" name="mysubmit" value="Save" />
<input type="submit" name="mycancel" value="Cancel" onclick="
if (HtmlEditIsModified('myeditor')) {
	return window.confirm('Your document is modified. Discard changes?')
}
else {
	return true
}
" />
</div>
</fieldset><br />
<?php
if (ereg(".htm", $filename)) {
	echo "<div align=center>";
	$html = new CQWebEditor;
	$html->SetCtrlName('myeditor');
	$html->SetHeight('320px');
	$html->SetWidth('780px');
	$html->SetElementName('pagesrc');
	$html->SetContentFromUrl($path.$filename);
	$html->SetFlags(HeCDisableStatusBar | HeCBorder | HeCToTextIfFail | HeCModeStandaloneForm | HeCDetectPlainText | HeCEditPage);
	$html->CreateControl();
	echo "</div>";
}
else {
?>
<div align=center>
<textarea name="pagesrc" style="width: 770px; height: 250px; padding: 4px;"><?php 
	echo htmlspecialchars(file_get_contents($path.$filename));
?></textarea></div><?
}
?>
</form>
</body>
</html>
