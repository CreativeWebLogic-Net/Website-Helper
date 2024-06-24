<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8" />
<title>Example 4</title>
<link type="text/css" href="../style.css" rel="stylesheet" />
<?php
    require("../htmledit.php");
    // Output HTML and JavaScript codes to initialize QWebEditor library.
    HtmlEditInit2('/htmledit/');
?>
</head>
<body>

<table width=740 align=center><tr><td>

<p>This example demonstrates how to edit a HTML page instead of HTML code fragment.
</p>

<?php
    $browser = HtmlEditGetBrowser();                // Collect client browser information
    echo "<p>Your browser is $browser[browser] $browser[version]. It "
        . ($browser['has_htmledit'] ? "supports " : "does not support ")
        . "QWebEditor.</p>";
?>

<div align=center>
<?php

    $html = new CQWebEditor;
	$html->SetFlags(HeCDisableStatusBar | HeCBorder | HeCToTextIfFail | HeCModeStandaloneForm | HeCDetectPlainText | HeCEditPage);
    $html->SetHeight('250px');                      // height of editor (optional)
    $html->SetElementName('myelement');             // Setting element name attribute (required)
    $html->SetFormActionUrl('../php_examples/viewresult3.php');      // Setting form action attribute (required)
    $html->SetContentFromUrl("../upload/pages/sample01.html");
    $html->CreateControl();                         // Creating the QWebEditor control
?>
</div>

</td></tr></table>

</body>
</html>