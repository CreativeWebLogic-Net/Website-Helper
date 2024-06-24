<html>
<head>
<title>QWebEditor</title>
<base href="http://www.qwebeditor.com" />
</head>
<body>
<p>You have entered the following text:</p>
<div style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<%
    response.write request.form("pagecontent1")
%>
</div><br />
<div style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<%
    response.write request.form("pagecontent2")
%>
</div><br />
<div style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<%
    response.write request.form("pagecontent3")
%>
</div><br />
<div style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<%
    response.write request.form("pagecontent4")
%>
</div><br />
<div style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<%
    response.write request.form("pagecontent5")
%>
</div><br />
</body>
</html>
