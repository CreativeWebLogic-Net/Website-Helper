<% Option Explicit %>
<!--- #include file="../browsersniffer.asp" --->
<!--- #include file="../htmledit.asp" --->
<%
HtmlEditSaveFile "../upload/data/"&Request.Form("filename"), Request.Form("content")
Response.Redirect Request.Form("returnurl")
%>