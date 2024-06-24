var g_strHeComment="Copyright (c) Q-Surf Computing Solutions, 2003-05. All rights reserved."
"If you see this message, you have decrypted this file already." +
"QWebEditor is written by a small software company. If you found" +
"it is useful for your project, please purchase the license to" +
"support us. Otherwise, further development is impossible." +
"If you have financial problem and cannot afford to pay the license," +
"please at least keep the license and let others know you use QWebEditor." +
"Thanks!"
//var g_strHeAppName = "QWebEditor "
var g_strHeAppName = " "
var g_strHeVersionPostfix = " "
var g_strHeLicense="Licensed By CHINA."
var g_arrHtmlEdit=new Array()
var g_heElement
var g_lUpdateTimer=-1
var g_hePopup
var g_heAbout
var g_heColor
var g_heSymbol
function HtmlEditFocus(strId){
if(document.frames)
{if (document.frames[strId])document.frames[strId].focus()}
else
document.getElementById(strId).contentWindow.focus()
}
function HtmlEditGetDoc(strId){
var obj=document.getElementById(strId)
if(!obj)return null
if(obj.contentDocument) // if contentDocument exists,W3C compliant (Mozilla)
return obj.contentWindow.document;
else // IE
return document.frames[strId].document;
}
function HtmlEditGetDocParent(strId){
if(document.getElementById(strId).contentDocument)
return document.getElementById(strId).contentWindow;
else // IE
return document.frames[strId];
}
function HtmlEditExecCmd(strId,strCmd,bUI,strParam){
var e,rs
HtmlEditFocus(strId)
try{
HtmlEditGetDoc(strId).execCommand(strCmd,bUI,strParam)
rs=true
}
catch(e){
rs=false
}
HtmlEditHideAllPopup()
HtmlEditPrepareUpdate(strId)
HtmlEditFocus(strId)
return rs
}
function HtmlEditGetCtrlNameFromElement(element){
for (var i=0;i<g_arrHtmlEdit.length;i++)
if(HtmlEditGetDoc(g_arrHtmlEdit[i].strId)==element.ownerDocument)return g_arrHtmlEdit[i].strId
}
function HtmlEditInsertCode(strId,strValue){

if(document.getElementById(strId).contentWindow&&document.getElementById(strId).contentWindow.getSelection){
var sel=document.getElementById(strId).contentWindow.getSelection()
if(sel.rangeCount){
if (!HtmlEditExecCmd(strId,'inserthtml',false,strValue)){
var rng=sel.getRangeAt(0)
rng.deleteContents()
rng.insertNode(rng.createContextualFragment(strValue))
}
}
}
else{
HtmlEditFocus(strId)
var doc=HtmlEditGetDoc(strId)
if(doc.selection.type!="None") doc.execCommand('Delete')
var sel=doc.selection
if(sel!=null){
var rng=sel.createRange()
if(rng!=null) rng.pasteHTML(strValue)
}
}
}
function HtmlEditGetState(id){
var pos=id.indexOf("_i_")
var result=false
try{
if(id.substring(0,5)=="hebtn"&&pos>0){
var cmd=id.substr(pos+3,id.length-pos-3)
var strId=id.substr(5,pos-5)
var doc=HtmlEditGetDoc(strId)
if(doc){
var sel=doc.selection
if(sel&&sel.type!="None"){
var rng=sel.createRange()
if(rng){
if(cmd!="JustifyLeft")
return rng.queryCommandState(cmd)
else
return !rng.queryCommandState("JustifyCenter")&&!rng.queryCommandState("JustifyRight")&&!rng.queryCommandState("JustifyFull")
}
}
else
return HtmlEditGetDoc(strId).queryCommandState(cmd)
}
}
}
catch(exception){}
return result
}
function HtmlEditOutControlControlSub(strId,strHeight,lFlags,obj){
var d=document
d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn"+strId+"_help\" onclick=\"javascript: HtmlEditHelp('" + strId + "') \" src=" + g_strHtmlEditPath + "htmleditimg/help.gif alt=\"" + g_strHeTextHelp + "\" title=\"" + g_strHeTextHelp + "\" width=\"20\" height=\"20\" />")
d.write("</nobr></div>")
d.write("<iframe name=\"" + strId + "\" id=\"" + strId + "\" style=\"background-color: white; width: 100%; height: " + strHeight + "; ")
d.write("\" marginwidth=\""+obj.lMarginWidth+"\" marginheight=\""+obj.lMarginHeight+"\" frameborder=\"no\" ")
if (obj && obj.lTabIndex) d.write(" tabindex=\""+obj.lTabIndex+"\"")
if (is_ie && location.protocol == "https:")d.write(" src=\""+g_strHtmlEditPath+"blank.html\" onload=\"HtmlEditBlankLoaded("+(g_arrHtmlEdit.length - 1)+")\" ")
else {d.write(" src=\"\""); g_arrHtmlEdit[g_arrHtmlEdit.length-1].bBlankLoaded = true}
d.write("></iframe>")
if (!(lFlags & g_lHeCDisableStatusBar)){
d.write("<div style=\"position: relative;\" id=\"hestatusbar_" + strId + "\" unselectable=on class=\"htmledittoolbar\" oncontextmenu=\"return false\">")
d.write("<div unselectable=on class=htmledittext style=\"cursor: pointer; position: absolute; top: 3px; left: 3px;\" onclick=\"javascript: HtmlEditHelp('"+strId+"');\">" + g_strHeAppName + g_strHeVersion + g_strHeVersionPostfix + "</div>")
d.write("<div align=right><table unselectable=on cellpadding=0 cellspacing=0 border=0><tr><td>&nbsp;</td>")
if (is_ie) d.write("<td class=htmleditstatusbox style=\"width: 40px;\" id=\"hestatus_" + strId + "_insert\">" + g_strHeTextInsert + "</td>")
d.write("</tr></table></div>")
d.write("</div>")
}
}
function HtmlEditCreatePopups(strId){
if (g_heAbout) return
g_hePopup=CreatePopup()
//g_heAbout=CreatePopup()
g_heColor=CreatePopup()
g_heSymbol=CreatePopup()
//PopupSetContent(g_heAbout,
//"<DIV " + (!is_ie ? "onclick=\"HtmlEditHideAllPopup()\" " : "") + "oncontextmenu=\"return false\" STYLE=\"border: 1px solid black; background-color: #CDD7FD; height:100%; width:100%; font-family: tahoma, arial, sans-serif; font-size: 8.5pt;\">\n" +
//"<div style=\"padding: 8px; background-color: #133EDD; color: #CDD7FD;\"><span style=\"font-size: 14pt; font-family: tahoma, arial, helvetica, sans-serif; color: white; font-weight: bold;\">" +
//g_strHeAppName + "</span> " + g_strHeVersion + g_strHeVersionPostfix + "</div>" +
//"<div style=\"padding: 8px; \">Copyright (c) <nobr>Q-Surf Computing Solutions</nobr>,<br />2003-05. All rights reserved. "+
//g_strHeLicense  + "<br><br>" +
//"Visit http://www.qwebeditor.com/ for more details.<br /><br />" +
//"</div></div>")
HtmlEditCreatePopupsSub(strId)
}
function RangeGetCurrent(win){
if (!win) return null
if (is_ie) {
var doc = win.document
if(doc.selection.type=="Text" || doc.selection.type=="None") {
var sel=doc.selection
if(sel!=null) return sel.createRange()
}
} else {
var sel=win.getSelection()
if(sel.rangeCount) return sel.getRangeAt(0)
}
return null
}
function RangeGetHtmlText(rng){
if (!rng) return ""
if (is_ie) {
return rng.htmlText
} else {
var docFragment = rng.cloneContents()
var newNode = document.createElement("DIV")
newNode.style.display = "none"
newNode.style.visibility = "hidden"
newNode.appendChild(docFragment)
var str = newNode.innerHTML
return str
}
return ""
}
function RangeSetHtmlText(rng, strText){
if (!rng) return
if (is_ie)
rng.pasteHTML(strText)
else{
rng.deleteContents()
rng.insertNode(rng.createContextualFragment(strText))
}
}
function RangeGetParentNode(rng)
{
if (!rng) return
if (is_ie)
return rng.parentElement()
else
return rng.startContainer ? rng.startContainer : parentNode
}
function GetParentObjectByType(element, arrFind, arrStop)
{
var e=element
while (e) {
for (var i = 0; i < arrFind.length; i ++)
if (e.tagName == arrFind[i]) return e
if (arrStop) for (var i = 0; i < arrStop.length; i ++)
if (e.tagName == arrStop[i]) return null
e=e.parentNode
}
return null
}


