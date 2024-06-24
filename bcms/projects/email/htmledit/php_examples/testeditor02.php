<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=ISO-8859-1" />
<link type="text/css" href="../style.css" rel="stylesheet" />
<title>Example 2</title>
<?php
    require_once("../htmledit.php");
    HtmlEditInit2('/htmledit/'); // Output HTML and JavaScript codes to initialize QWebEditor library.
?>

<script language="javascript">
function SaveText(strId) {
	// copy content to hidden field and then submit the form
	document.myform.content.value = document.getElementById(strId).innerHTML
	document.myform.submit()
}

</script>
</head>
<body>
<p>This example displays QWebEditor as a popup window. Content is loaded from ../upload/data/test1.txt</p>
<?php
    $browser = HtmlEditGetBrowser();                // Collect client browser information
    echo "<p>Your browser is $browser[browser] $browser[version]. It "
        . ($browser['has_htmledit'] ? "supports " : "does not support ")
        . "QWebEditor.</p>";
?>
<form name="myform" action="savefile.php" method="post">
<input type="hidden" name="filename" value="test1.txt" />
<input type="hidden" name="content" />
<input type="hidden" name="returnurl" value="testeditor02.php" />
</form>
<!-- popup the editor, passed the id of the element that contain the content that is needed to be edited -->
<p><a href="javascript: void(HtmlEditOpenEditorFromObj({
	strId:'displaytext',
	width:620,
	height:420,
	strTitle:'Edit Content',
	className:'default',
	onChanged:new Function('SaveText(\'displaytext\')')
}))">
Open editor</a></p>

<div id="displaytext" style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<?php echo file_get_contents("../upload/data/test1.txt"); ?>
</div>
</body>
</html>
