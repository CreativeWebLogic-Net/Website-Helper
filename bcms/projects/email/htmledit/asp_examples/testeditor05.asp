<% Option Explicit %>
<!--- #include file="../browsersniffer.asp" --->
<!--- #include file="../htmledit.asp" --->
<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8" />
<title>Example 5</title>
<link type="text/css" href="../style.css" rel="stylesheet" />
<%
	' output HTML and JavaScript codes to initialize QWebEditor library
	HtmlEditInit2 "/htmledit/", "g_strHtmlEditLangFile='lang_cht.js';g_strHtmlEditImgUrl = 'upload/browseimages2.asp';"
%>
</head>
<body>
<table width=740 align=center><tr><td>

<p>This example displays the default configuration of QWebEditor in a stand-alone form but using the Chinese
language resource. Please click the "Save" button to submit.</p>

<p>Your browser is: <% =g_hebrowser.GetBrowser() %>&nbsp;<% =g_hebrowser.GetVersion() %>.<br />
It <%
if g_hebrowser.HasHtmlEdit then
    response.write "supports "
else
    response.write "does not support "
end if
%> QWebEditor.</p>

<div align="center"><%
	dim html
	set html = new QWebEditor
	html.SetElementName "myelement"
	html.SetFormActionUrl "../asp_examples/viewresult.asp"
	html.SetWidth "650px"
	html.SetHeight "250px"
	html.SetFlags HeCDisableStatusBar or HeCBorder or HeCToTextIfFail or HeCModeStandaloneForm
	html.SetContent "<P>Here is some sample text: <B>bold</B>, <I>italic</I>, <U>underline</U>. </P>" _
		&"<P align=center>Different fonts, sizes and colors (all in bold):</P>" _
		&"<P><B><FONT face=arial color=#000066 size=7>arial</FONT>, " _
		&"<FONT face='courier new' color=#006600 size=6>courier new</FONT>, " _
		&"<FONT face=georgia color=#006666 size=5>georgia</FONT>," _
		&"<FONT face=tahoma color=#660000 size=4>tahoma</FONT>, " _
		&"<FONT face='times new roman' color=#660066 size=3>times new roman</FONT>, " _
		&"<FONT face=verdana color=#666600 size=2>verdana</FONT>," _
		&"<FONT face=tahoma color=#666666 size=1>tahoma</FONT> </B></P>" _
		&"<P>Click on <A href='http://www.qwebeditor.com/'>this link</A> " _
		&"and then on the link button to the details ... OR ... select some text and click link to create a <B>new</B> link.</P>"
	html.CreateControl
%></div>

</td></tr></table>
</body>
</html>
