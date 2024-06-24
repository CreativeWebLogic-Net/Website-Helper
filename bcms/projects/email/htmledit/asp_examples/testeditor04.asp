<% Option Explicit %>
<!--- #include file="../browsersniffer.asp" --->
<!--- #include file="../htmledit.asp" --->
<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8" />
<title>Example 4</title>
<link type="text/css" href="../style.css" rel="stylesheet" />
<%
	' output HTML and JavaScript codes to initialize QWebEditor library
	HtmlEditInit2 "/htmledit/", "g_strHtmlEditImgUrl = 'upload/browseimages2.asp';"
%>
</head>
<body>

<table width=740 align=center><tr><td>

<p>This example demonstrates how to edit a HTML page instead of HTML code fragment.
</p>

<p>Your browser is: <% =g_hebrowser.GetBrowser() %>&nbsp;<% =g_hebrowser.GetVersion() %>.<br />
It <%
if g_hebrowser.HasHtmlEdit then
    response.write "supports "
else
    response.write "does not support "
end if
%> QWebEditor.</p>

<div align=center>
<%
	dim html
	set html = new QWebEditor
	html.SetFlags HeCDisableStatusBar or HeCBorder or HeCToTextIfFail or HeCModeStandaloneForm or HeCDetectPlainText or HeCEditPage
	html.SetHeight "250px"											' height of editor (optional)
	html.SetElementName "myelement"									' Setting element name attribute (required)
	html.SetFormActionUrl "../asp_examples/viewresult3.asp"			' Setting form action attribute (required)
	html.SetContentFromUrl "../upload/pages/sample01.html"
	html.CreateControl												' Creating the QWebEditor control
%>
</div>

</td></tr></table>

</body>
</html>