<html>
<body>
<?
require("../htmledit.php");
// Output HTML and JavaScript codes to initialize QWebEditor library.
HtmlEditInit('/htmledit/', 'upload/browseimages.php');

$html = new CQWebEditor;
$html->SetMode(HeCModeFormElement);
?>
<form name="myform" action="viewresult2.php" method="post">
<?
$html->SetHeight('200px');
$html->SetCtrlName("qeheader");
$html->SetElementName("pagecontent1"); // Setting the name attribute of first control
$html->SetContent("test 1"); // Setting the content of first control
$html->SetBaseHref('http://www.qwebeditor.com/htmledit/htmleditimg/');
$html->EnableToTextIfFail(true);
$html->EnableDetectPlainText(true);
$html->EnableStatusBar(false);
$html->SetEditorCssFile("http://localhost/htmledit/style.css");
$html->CreateControl();

$html->SetHeight('200px');
$html->SetCtrlName("qefooter");
$html->SetElementName("pagecontent2"); // Setting the name attribute of first control
$html->SetContent("test 2"); // Setting the content of first control
$html->SetBaseHref('http://www.qwebeditor.com/htmledit/htmleditimg/');
$html->EnableToTextIfFail(true);
$html->EnableDetectPlainText(true);
$html->EnableStatusBar(false);
$html->SetEditorCssFile("http://localhost/htmledit/style.css");
$html->CreateControl();
?>
<input type=submit></form>
</body>
</html>
