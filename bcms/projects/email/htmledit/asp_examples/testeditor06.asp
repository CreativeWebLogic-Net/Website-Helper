<% Option Explicit %>
<!--- #include file="../browsersniffer.asp" --->
<!--- #include file="../htmledit.asp" --->
<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=ISO-8859-1" />
<title>Example 6</title>
<link type="text/css" href="../style.css" rel="stylesheet" />
<%
    ' output HTML and JavaScript codes to initialize QWebEditor library
	HtmlEditInit2 "/htmledit/", "g_strHtmlEditImgUrl = 'upload/browseimages2.asp';"
%>
</head>
<!-- Custom buttons handler -->
<script language="javascript"><!--
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
	var numitems=3
	
	// construct the menu content
	var str=new String()
	str +=HtmlEditGetMenuItem(
		"Test1",	// menu text
		"HtmlEditPopupInsertCode('"+eventObj.editorId+"', '"+HtmlSpecialChars("Test1")+"')"
		// handler if menu item is selected
		)
	str +=HtmlEditGetMenuItem("Test2","HtmlEditPopupInsertCode('"+eventObj.editorId+"', '"+HtmlSpecialChars("Test2")+"')")
	str +=HtmlEditGetMenuItem("Test3","HtmlEditPopupInsertCode('"+eventObj.editorId+"', '"+HtmlSpecialChars("Test3")+"')")

	// specify content of popup menu
	PopupSetContent(g_hePopup, HtmlEditGetMenuStart() + str + HtmlEditGetMenuEnd())

	// display the popup menu now
	PopupShow(
		g_hePopup, // qwebeditor builtin popup menu object
		0, 		   // x coord relative to target
		24,       // y coord relative to target
		200,      // width of menu
		(is_ie ? (18 * numitems + g_strHeCssMenuBorderWidth * 2 - 2) : (18 * numitems)), 
		          // height of menu. IE's height and gecko's height are a bit different
		eventObj.target
		          // doc element where x and y relative to
		)
}
//--></script>
<body>
<table width=700 align=center><tr><td>
<p>This example demonstrates how to create custom buttons.</p>
<%
	dim html
	set html = new QWebEditor							' Create the form object
	
	html.SetCtrlName "myctrl"							' Set the control name. Control Name is used
														' to control QWebEditor with JavaScript during run-time.
	html.SetFormActionUrl "viewresult3.asp"
	html.SetWidth "650px"
	html.SetHeight "250px"
	html.SetFlags HeCDisableStatusBar or HeCBorder or HeCToTextIfFail or HeCModeStandaloneForm
	html.SetContent "Line 1<br>Line 2<br>Line 3"
	html.SetClassName "example"
	html.SetContent "Line #1<br>Line #2<br>Line #3"   ' Set the initial content of the control
	
	html.addCustomButton "Custom Dlg", "HtmlEditDemoCustomDlg", "10101.gif"
	html.addCustomButton "Custom Menu", "HtmlEditDemoCustomMenu", "10101.gif"

	html.SetOnLoadHandler "new Function("&chr(34)&"HtmlEditFocus("&chr(39)&"myctrl"&chr(39)&")"&chr(34)&")"

	html.CreateControl									' Output the code to create the control
%>
</td></tr></table>
</body>
</html>
