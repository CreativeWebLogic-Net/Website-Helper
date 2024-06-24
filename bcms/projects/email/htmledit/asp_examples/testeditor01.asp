<% Option Explicit %>
<!--- #include file="../browsersniffer.asp" --->
<!--- #include file="../htmledit.asp" --->
<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8" />
<link type="text/css" href="../style.css" rel="stylesheet" />
<title>Example 1</title>
<%
	' output HTML and JavaScript codes to initialize QWebEditor library
	HtmlEditInit2 "/htmledit/", "g_strHtmlEditImgUrl = 'upload/browseimages2.asp';"
%>
</head>
<body>

<table width=740 align=center><tr><td>

<p>This example demonstrates using QWebEditor to replace textarea in a form and 
it requires PHP enabled server to view submitted data.</p>

<p>Your browser is: <% =g_hebrowser.GetBrowser() %>&nbsp;<% =g_hebrowser.GetVersion() %>.<br />
It <%
if g_hebrowser.HasHtmlEdit then
    response.write "supports "
else
    response.write "does not support "
end if
%> QWebEditor.</p>

<form name="myform" action="../asp_examples/viewresult2.asp" method="post">

<b>1. The simplest way to create an editor:</b><pre>
    dim html
    set html = new QWebEditor
    html.SetElementName "pagecontent1"
    html.SetWidth "650px"
    html.CreateControl
</pre><%
	dim html
	set html = new QWebEditor
	html.SetElementName "pagecontent1"
	html.SetWidth "650px"
	html.CreateControl
%><br />

<b>2. Another example demonstrates how to set the initial value and load stylesheets:</b><pre>
    dim html
    dim css(2)
    set html = new QWebEditor
    html.SetElementName "pagecontent2"
    html.SetWidth "650px"
    html.SetContent "Editor 2"
    css(0)="../style.css"
    css(1)="../style2.css"
    html.SetEditCssFile css
    html.CreateControl
</pre><%
	dim css(2)
	set html = new QWebEditor
	html.SetElementName "pagecontent2"
	html.SetWidth "650px"
	html.SetContent "Editor 2"
	css(0)="../style.css"
	css(1)="../style2.css"
	html.SetEditorCssFile css
	html.CreateControl
%><br />

<b>3. This example creates an editor with "simple" class which is defined in htmledit_styles.js:</b><pre>
    dim html
    set html = new QWebEditor
    html.SetElementName "pagecontent3"
    html.SetWidth "650px"
    html.SetContent "Editor 3"
    html.SetClassName "simple"
    html.CreateControl
</pre><%
    set html = new QWebEditor
    html.SetElementName "pagecontent3"
    html.SetWidth "650px"
    html.SetContent "Editor 3"
    html.SetClassName "simple"
    html.CreateControl
%><br />

<b>4. Another example creates an editor with "example" class (defined in htmledit_styles.js) which overrides font list, paragraph list and load default stylesheet:</b><pre>
    dim html
    set html = new QWebEditor
    html.SetElementName "pagecontent4"
    html.SetWidth "650px"
    html.SetContent "Editor 4"
    html.SetClassName "example"
    html.CreateControl
</pre><%
    set html = new QWebEditor
    html.SetElementName "pagecontent4"
    html.SetWidth "650px"
    html.SetContent "Editor 4"
    html.SetClassName "example"
    html.CreateControl
%><br />

<b>5. This example demonstrates how to set the base href and the height of the editor:</b><pre>
    dim html
    set html = new QWebEditor
    html.SetElementName "pagecontent5"
    html.SetWidth "650px"
    html.SetContent "Editor 5"
    html.SetContent "&lt;img src='images/next.gif' /&gt; Editor 5"
    html.SetBaseHref "http://www.qwebeditor.com/"
    html.CreateControl
</pre><%
    set html = new QWebEditor
    html.SetElementName "pagecontent5"
    html.SetWidth "650px"
    html.SetContent "Editor 5"
    html.SetContent "<img src='images/next.gif' /> Editor 5"
    html.SetBaseHref "http://www.qwebeditor.com/"
    html.CreateControl
%>

<p><input type="Submit" name="mysubmit" value="Submit"></p>
</form>

</td></tr></table>

</body>
</html>