<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=ISO-8859-1" />
<title>Example 3</title>
<link type="text/css" href="../style.css" rel="stylesheet" />
<?php
    require_once("../htmledit.php");
    HtmlEditInit2('/htmledit/');
?>
</head>
<body>
<table width=740 align=center><tr><td>

<p>This example demonstrates using QWebEditor as a standalone form.</p>

<div align="center"><?php
	$html = new CQWebEditor;
	$html->SetElementName("myelement");
	$html->SetFormActionUrl("../php_examples/viewresult.php");
	$html->SetWidth("650px");
	$html->SetHeight("250px");
	$html->SetFlags(HeCDisableStatusBar | HeCBorder | HeCToTextIfFail | HeCModeStandaloneForm);
	$html->SetContent("<P>Here is some sample text: <B>bold</B>, <I>italic</I>, <U>underline</U>. </P>"
		."<P align=center>Different fonts, sizes and colors (all in bold):</P>"
		."<P><B><FONT face=arial color=#000066 size=7>arial</FONT>, "
		."<FONT face=\"courier new\" color=#006600 size=6>courier new</FONT>, "
		."<FONT face=georgia color=#006666 size=5>georgia</FONT>," 
		."<FONT face=tahoma color=#660000 size=4>tahoma</FONT>, "
		."<FONT face=\"times new roman\" color=#660066 size=3>times new roman</FONT>, "
		."<FONT face=verdana color=#666600 size=2>verdana</FONT>,"
		."<FONT face=tahoma color=#666666 size=1>tahoma</FONT> </B></P>"
		."<P>Click on <A href=\"http://www.qwebeditor.com/\">this link</A> "
		."and then on the link button to the details ... OR ... select some text and click link to create a <B>new</B> link.</P>");
	$html->CreateControl();
?></div>
</td></tr></table>
</body>
</html>
