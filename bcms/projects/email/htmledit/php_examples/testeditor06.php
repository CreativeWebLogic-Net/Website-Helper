<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8" />
<link type="text/css" href="../style.css" rel="stylesheet" />
<title>Example 6</title>
<?php
    require("../htmledit.php");
    // Output HTML and JavaScript codes to initialize QWebEditor library.
    HtmlEditInit2('/htmledit/');
?>
<!-- Custom buttons handler -->
<script language="javascript">

function HtmlEditDemoCustomDlg(eventObj) {
	HtmlEditHideAllPopup()
	MyDlgOpen(
		g_strHtmlEditPath + "html_examples/testdlg.html", // html page used in dialog
		460, // width of dialog
		220, // height of dialog
		HtmlEditDemoCustomDlgReturn,  // function to call after popup dialog called "MyDlgHandleOk()"
		null, // arguments
		eventObj // holding caller data
		)
}

function HtmlEditDemoCustomDlgReturn() {
	var result=dialogWin.returnedValue
	var eventObj=dialogWin.callerdata
	HtmlEditInsertCode(eventObj.editorId, result)
}

function HtmlEditDemoCustomMenu(eventObj) {
	HtmlEditHideAllPopup()
	var str=new String()
	var numitems=3
	// construct the menu content
	str +=HtmlEditGetMenuItem(
		HtmlSpecialChars("[Test1]"),	// menu text
		HtmlSpecialChars("HtmlEditPopupInsertCode('"+eventObj.editorId+"', '"+"[Test1]"+"')")
		// handler if menu item is selected
		)
	str +=HtmlEditGetMenuItem(
		HtmlSpecialChars("[Test2]"),
		HtmlSpecialChars("HtmlEditPopupInsertCode('"+eventObj.editorId+"', '"+"[Test2]"+"')")
		)
	str +=HtmlEditGetMenuItem(
		HtmlSpecialChars("[Test3]"),
		HtmlSpecialChars("HtmlEditPopupInsertCode('"+eventObj.editorId+"', '"+"[Test3]"+"')")
		)
	// specify content of popup menu
	PopupSetContent(g_hePopup, HtmlEditGetMenuStart() + str + HtmlEditGetMenuEnd())
	PopupShow(
		g_hePopup, // qwebeditor builtin popup menu object
		0, 		   // x coord relative to target
		24,       // y coord relative to target
		200,      // width of menu
		(is_ie ? (18 * numitems + g_strHeCssMenuBorderWidth * 2 - 2) : (18 * numitems)), 
		          // height of menu. IE height and gecko height is a bit different
		eventObj.target
		          // doc element where x and y relative to
		)
}

</script>
</head>
<body>
<table width=700 align=center><tr><td>

<p>This example demonstrates how to create custom buttons.
</p>
<?php
    $browser = HtmlEditGetBrowser();                // Collect client browser information
    echo "<p>Your browser is $browser[browser] $browser[version]. It "
        . ($browser['has_htmledit'] ? "supports " : "does not support ")
        . "QWebEditor.</p>";

    $html = new CQWebEditor;
    $html->SetCtrlName('myctrl');
    $html->SetElementName('myelement');
    $html->SetFormActionUrl('viewresult3.php');
    $html->SetWidth('650px');
    $html->SetHeight('250px');
    $html->SetFlags(HeCDisableStatusBar | HeCBorder | HeCToTextIfFail | HeCModeStandaloneForm);
    $html->SetContent("Line 1<br>Line 2<br>Line 3");
	$html->SetClassName("example");						// one of the custom button is loaded from class
	$html->addCustomButton("Custom Dlg", "HtmlEditDemoCustomDlg", "10101.gif");
	$html->addCustomButton("Custom Menu", "HtmlEditDemoCustomMenu", "10101.gif");
	$html->SetOnLoadHandler("new Function(\"HtmlEditFocus('myctrl')\")");
    $html->CreateControl();
?>
</td></tr></table>
</body>
</html>
