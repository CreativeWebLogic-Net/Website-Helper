<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8" />
<link type="text/css" href="../style.css" rel="stylesheet" />
<title>Example 1</title>
<?php
    require_once("../htmledit.php");
    HtmlEditInit2('/htmledit/'); // Output HTML and JavaScript codes to initialize QWebEditor library.
?>
</head>
<body>

<table width=740 align=center><tr><td>

<p>This example demonstrates using QWebEditor to replace textarea in a form and 
it requires PHP enabled server to view submitted data.</p>

<form name="myform" action="../php_examples/viewresult2.php" method="post">

<b>1. The simplest way to create an editor:</b><pre>
    $html = new CQWebEditor;
    $html->SetElementName('pagecontent1');
    $html->SetWidth('650px');
    $html->CreateControl();
</pre><?php
	$html = new CQWebEditor;
    $html->SetElementName('pagecontent1');
	$html->SetWidth('650px');
	$html->CreateControl();
?><br />

<b>2. Another example demonstrates how to set the initial value and load stylesheets:</b><pre>
    $html = new CQWebEditor;
    $html->SetElementName('pagecontent2');
    $html->SetWidth('650px');
    $html->SetContent("Editor 2");
    $html->SetEditorCssFile(array("../style.css", "../style2.css"));
    $html->CreateControl();
</pre><?php
	$html = new CQWebEditor;
    $html->SetElementName('pagecontent2');
	$html->SetWidth('650px');
	$html->SetContent("Editor 2");
	$html->SetEditorCssFile(array("../style.css", "../style2.css"));
	$html->CreateControl();
?><br />

<b>3. This example creates an editor with "simple" class which is defined in htmledit_styles.js:</b><pre>
    $html = new CQWebEditor;
    $html->SetElementName('pagecontent3');
    $html->SetWidth('650px');
    $html->SetContent("Editor 3");
    $html->SetClassName("simple");
    $html->CreateControl();
</pre><?php
	$html = new CQWebEditor;
    $html->SetElementName('pagecontent3');
	$html->SetWidth('650px');
	$html->SetContent("Editor 3");
	$html->SetClassName("simple");
	$html->CreateControl();
?><br />

<b>4. Another example creates an editor with "example" class which overrides font list, paragraph list and load default stylesheet:</b><pre>
    $html = new CQWebEditor;
    $html->SetElementName('pagecontent4');
    $html->SetWidth('650px');
    $html->SetContent("Editor 4");
    $html->SetClassName("example");
    $html->CreateControl();
</pre><?php
	$html = new CQWebEditor;
    $html->SetElementName('pagecontent4');
	$html->SetWidth('650px');
	$html->SetContent("Editor 4");
	$html->SetClassName("example");
	$html->CreateControl();
?><br />

<b>5. This example demonstrates how to set the base href and the height of the editor:</b><pre>
    $html = new CQWebEditor;
    $html->SetElementName('pagecontent5');
    $html->SetWidth('650px');
    $html->SetHeight('50px');
    $html->SetContent("&lt;img src='images/next.gif' /&gt; Editor 5");
    $html->SetBaseHref("http://www.qwebeditor.com/");
    $html->CreateControl();
</pre><?php
	$html = new CQWebEditor;
    $html->SetElementName('pagecontent5');
	$html->SetWidth('650px');
	$html->SetHeight('50px');
	$html->SetContent("<img src='images/next.gif' /> Editor 5");
	$html->SetBaseHref("http://www.qwebeditor.com/");
	$html->CreateControl();
?>
<p><input type="Submit" name="mysubmit" value="Submit"></p>
</form>

</td></tr></table>

</body>
</html>