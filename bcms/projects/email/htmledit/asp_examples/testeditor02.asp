<% Option Explicit %>
<!--- #include file="../browsersniffer.asp" --->
<!--- #include file="../htmledit.asp" --->
<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=ISO-8859-1" />
<link type="text/css" href="../style.css" rel="stylesheet" />
<title>Example 2</title>
<%
    ' output HTML and JavaScript codes to initialize QWebEditor library
    HtmlEditInit2 "/htmledit/", ""
%>
<script language="javascript">
function SaveText(strId) {
	// copy content to hidden field and then submit the form
	document.myform.content.value = document.getElementById(strId).innerHTML
	document.myform.submit()
}

</script>
</head>
<body>
<p>This example displays QWebEditor as a popup window. This example requires at least DOM1 compatible
browser to popup the window (Requires document.getElementById() function).</p>

<p>Your browser is: <% =g_hebrowser.GetBrowser() %>&nbsp;<% =g_hebrowser.GetVersion() %>.<br />
It <%
if g_hebrowser.HasHtmlEdit then
    response.write "supports "
else
    response.write "does not support "
end if
%> QWebEditor.</p>

<form name="myform" action="savefile.asp" method="post">
<input type="hidden" name="filename" value="test1.txt" />
<input type="hidden" name="content" />
<input type="hidden" name="returnurl" value="testeditor02.asp" />
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
<% = HtmlEditReadFile("../upload/data/test1.txt") %>
</div>
</body>
</html>
