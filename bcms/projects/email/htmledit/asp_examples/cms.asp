<% Option Explicit %>
<!--- #include file="../browsersniffer.asp" --->
<!--- #include file="../htmledit.asp" --->
<!--- #include file="cmsconfig.asp" --->
<%
    dim filename
    dim objFSO
    Dim Filepath

    if len(Request.Form("filename")) then
        filename = Request.Form("filename")
    else
        filename = Request.QueryString("filename")
    end if

    if len(Request.Form("addpage")) then
        HtmlEditSaveFile strPath&filename, ""
    end if
    
    if len(Request.QueryString("deletepage")) then
        Set objFSO = Server.CreateObject("Scripting.FileSystemObject")
        
        Filepath = Server.MapPath(strPath&filename)
        
        if objFSO.FileExists(Filepath) then
            objFSO.deleteFile Filepath
        end if
    end if
%>
<?php
    if ($_GET['deletepage'] && $filename)
    {
        unlink("files/$filename");
        header("location: cms.php");
        exit;
    }
?><html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8" />
<title>Simple CMS</title>
<link type="text/css" href="../style.css" rel="stylesheet" />
</head>
<body marginwidth=10 marginheight=10 leftmargin=10 topmargin=10>
<div class="cmstitle">SimpleCMS</div>

<fieldset class="boxstyle">
<legend>New File</legend>
<form action="cms.asp" method="post" style="margin: 10px;">
File Name: <input type="text" name="filename" /><input type="submit" name="addpage" value="Create" />
</form>
</fieldset><br />

<table border=1 cellspacing=0 cellpadding=2 width=770 align=center>
<tr>
	<th class="tablecaption" width=80%>File Name</th>
	<th class="tablecaption" width=20%>Actions</th>
</tr>
<%
    dim objFolder
    dim objItem
    dim num
    
    num = 0
    Set objFSO = Server.CreateObject("Scripting.FileSystemObject")
    Set objFolder = objFSO.GetFolder(Server.MapPath(strPath))

    For Each objItem In objFolder.Files
            %>
            <TR>
            <TD ALIGN="left" class=tablebody><A HREF="<%= strPath & objItem.Name %>"><%= objItem.Name %></A></TD>
            <td align=center class=tablebody><a href="cmsedit.asp?filename=<%= objItem.Name %>">Edit</a>
            <a href="cms.asp?deletepage=1&filename=<%= objItem.Name %>" onclick="return confirm('Are you sure to delete this file?')">Delete</a></td>
            </TR>
            <%
            num = num + 1
    Next 'objItem

%>
</table>
<table width=770 border=0 align=center><tr><td>
<%= num %> file(s) found
</td></tr></table>
<p>Note: This example demonstrates a simple CMS. The "files" directory must be writable
before you try this example. This example uses relative path ".." to refer other directories
in the development kit. You may need to correct them to absolute path first and otherwise
this example may not work under Windows 2003 Server.</p>
<p>Windows is a registered trademark of Microsoft Corporation.</p>
</body>
</html>
