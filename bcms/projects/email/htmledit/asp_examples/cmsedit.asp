<% Option Explicit %>
<!--- #include file="../browsersniffer.asp" --->
<!--- #include file="../htmledit.asp" --->
<!--- #include file="cmsconfig.asp" --->
<%
	' File: cmsedit.asp
	' Programmer: John Wong
	' Description:
	'   Demonstrates a simple CMS system.
	dim filename
	
	if len(Request.Form("filename")) then
		filename = Request.Form("filename")
	else
		filename = Request.QueryString("filename")
	end if
	
	if len(Request.Form("mysubmit")) then
		HtmlEditSaveFile strPath&filename, Request.Form("pagesrc")
		Response.Redirect "cms.asp"
	elseif len(Request.Form("mycancel")) then
		Response.Redirect "cms.asp"
	end if
%>
<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8" />
<link type="text/css" href="../style.css" rel="stylesheet" />
<title>CMS</title>
<%
    ' output HTML and JavaScript codes to initialize QWebEditor library
    HtmlEditInit2 "/htmledit/", "var g_strHtmlEditImgUrl = 'upload/browseimages2.asp';"
%>
</head>
<body marginwidth=10 marginheight=10 leftmargin=10 topmargin=10 onload="HtmlEditFocus('myeditor')">
<div class="cmstitle">SimpleCMS</div>
<form action="cmsedit.asp?filename=<% = filename %>" method="post">
<fieldset class="boxstyle">
<legend>Actions</legend>
<div style="margin: 10px;">
<input type="submit" name="mysubmit" value="Save" />
<input type="submit" name="mycancel" value="Cancel" onclick="
if (HtmlEditIsModified('myeditor')) {
	return window.confirm('Your document is modified. Discard changes?')
}
else {
	return true
}
" />
</div>
</fieldset><br />
<%
	dim regEx
	set regEx = new RegExp
	regEx.Pattern = ".htm"
	
	if regEx.Test(filename) then
	
		Response.Write "<div align=center>"
		dim html
		set html = new QWebEditor
		html.SetCtrlName "myeditor"
		html.SetElementName "pagesrc"
		html.SetHeight "320px"
		html.SetWidth "780px"
		html.SetContentFromUrl strPath&filename
		html.SetFlags HeCDisableStatusBar or HeCBorder or HeCToTextIfFail or HeCModeStandaloneForm or HeCDetectPlainText or HeCEditPage
		html.CreateControl
		Response.Write "</div>"
		
	else
%>
<div align=center>
<textarea name="pagesrc" style="width: 770px; height: 250px; padding: 4px;"><%
	Response.Write Server.HtmlEncode(HtmlEditReadFile(strPath & filename))
%></textarea></div>
<% 
	End if 
%>
</form>
</body>
</html>
