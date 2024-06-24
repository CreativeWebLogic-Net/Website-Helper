// File:            htmledit.js

// Description:     For I4UWebEditor

//





var g_strHeVersion="4.11"
//var g_strHeVersion="3.09"



var g_lHeCModeMask=3

var g_lHeCModeFormElement=0

var g_lHeCModeStandaloneForm=1

var g_lHeCModeStandaloneDialog=2



var g_lHeCResizeToWindow=4



var g_lHeCDisableParagraph=8

var g_lHeCDisableFontSize=16

var g_lHeCDisableFontName=32

var g_lHeCDisableNewBtn=64

var g_lHeCDisableCutCopyPasteBtn=128

var g_lHeCDisableUndoRedoBtn=256

var g_lHeCDisableSourceBtn=512

var g_lHeCDisableForeColor=1024

var g_lHeCDisableBackColor=2048

var g_lHeCDisableAlignBtn=4096

var g_lHeCDisableTableBtn=8192

var g_lHeCDisableImageBtn=16384

var g_lHeCDisableStyleBox=262144



var g_lHeCEnumSysFonts=32768

var g_lHeCBorder=65536

var g_lHeCDetectPlainText=131072

var g_lHeCDisableStatusBar=524288

var g_lHeCToTextIfFail=1048576



var g_lHeCEditPage=2097152



var g_lHeCDisableFormattingBtns1=4194304

var g_lHeCDisableFormattingBtns2=8388608

var g_lHeCDisableFormattingBtns3=16777216

var g_lHeCDisableLinkBtn=33554432

var g_lHeCDisableHorizontalRuleBtn=67108864

var g_lHeCDisableSymbolBtn=134217728

var g_lHeCXHTMLSource=268435456

var g_lHeCUseDivForIE=536870912

var g_lHeCEnableSafeHtml=1073741824



if(typeof(g_bMergedImageDialog)=="undefined") g_bMergedImageDialog=false;



if(typeof(g_strHeCssWindowText)=="undefined") g_strHeCssWindowText="windowtext";

if(typeof(g_strHeCssWindow)=="undefined") g_strHeCssWindow="window";

if(typeof(g_strHeCssThreedFace)=="undefined") g_strHeCssThreedFace="threedface";

if(typeof(g_strHeCssThreedHighlight)=="undefined") g_strHeCssThreedHighlight="threedhighlight";

if(typeof(g_strHeCssThreedShadow)=="undefined") g_strHeCssThreedShadow="threedshadow";

if(typeof(g_strHeCssBtnFaceU)=="undefined") g_strHeCssBtnFaceU="threedface";

if(typeof(g_strHeCssBtnFaceD)=="undefined") g_strHeCssBtnFaceD="threedface";

if(typeof(g_strHeCssBtnHighlight)=="undefined") g_strHeCssBtnHighlight="threedhighlight";

if(typeof(g_strHeCssBtnShadow)=="undefined") g_strHeCssBtnShadow="threedshadow";



if(typeof(g_strHeCssMenuText)=="undefined") g_strHeCssMenuText="windowtext";

if(typeof(g_strHeCssMenuBack)=="undefined") g_strHeCssMenuBack="threedface";

if(typeof(g_strHeCssMenuGrayText)=="undefined") g_strHeCssMenuGrayText="graytext";

if(typeof(g_strHeCssMenuSeparatorTop)=="undefined") g_strHeCssMenuSeparatorTop="threedshadow";

if(typeof(g_strHeCssMenuSeparatorBottom)=="undefined") g_strHeCssMenuSeparatorBottom="threedhighlight";

if(typeof(g_strHeCssMenuTopLeft)=="undefined") g_strHeCssMenuTopLeft="threedhighlight";

if(typeof(g_strHeCssMenuBottomRight)=="undefined") g_strHeCssMenuBottomRight="threedshadow";

if(typeof(g_strHeCssMenuUText)=="undefined") g_strHeCssMenuUText="highlighttext";

if(typeof(g_strHeCssMenuUBack)=="undefined") g_strHeCssMenuUBack="highlight";

if(typeof(g_strHeCssMenuUTopLeft)=="undefined") g_strHeCssMenuUTopLeft="highlight";

if(typeof(g_strHeCssMenuUBottomRight)=="undefined") g_strHeCssMenuUBottomRight="highlight";

if(typeof(g_strHeCssMenuBorderWidth)=="undefined") g_strHeCssMenuBorderWidth=2



var g_lSymbolMenuWidth=50



document.write("<style type=\"text/css\">\n")

document.write(".htmledittoolbar {position: relative; left: 0px; top: 0px; padding: 1px 1px 1px 1px; background-color: " + g_strHeCssThreedFace + "; border-width: 1px; border-style: solid; border-color: " + g_strHeCssThreedShadow + "; border-top-color: " + g_strHeCssThreedHighlight + "; border-left-color: " + g_strHeCssThreedHighlight + "; overflow: hidden; }\n")

document.write(".htmleditbtn {cursor: pointer; padding: 0px 0px 0px 0px; border: solid; border-width: 1px; background-color: " + g_strHeCssThreedFace + "; Border-Top-Color: " + g_strHeCssThreedFace + "; Border-Left-Color: " + g_strHeCssThreedFace + "; Border-Bottom-Color: " + g_strHeCssThreedFace + "; Border-Right-Color: " + g_strHeCssThreedFace + "; }\n")

document.write(".htmledittext {cursor: default; font-family: tahoma, sans-serif; font-size: 8pt; font-color: " + g_strHeCssWindowText + ";}")

document.write("select.htmledittext {cursor: default; font-family: tahoma, sans-serif; font-size: 8pt; background-color: " + g_strHeCssWindow + "; font-color: " + g_strHeCssWindowText + ";}")

document.write(".htmleditstatusbox {cursor: default; font-family: tahoma, sans-serif; color: " + g_strHeCssWindowText + "; background-color: " + g_strHeCssThreedFace + "; font-size: 8pt; border-width: 1px; border-style: solid; border-color: " + g_strHeCssThreedShadow + "; border-right-color: " + g_strHeCssThreedHighlight + "; border-bottom-color: " + g_strHeCssThreedHighlight + "; text-align: center; padding: 0px;}")

document.write("</style>\n")



function HtmlEditOpenEditor(strId, strTitle, strCharset, strThemeFile, lFlags){

	var myTitle=(strTitle?strTitle:"")

	var myCharset=(strCharset?strCharset:"iso-8859-1")

	var o=new Object()

	o.strCharset=myCharset

	o.strTitle=myTitle

	o.strHtmlEditPath=g_strHtmlEditPath

	o.strHtmlEditImgUrl=g_strHtmlEditImgUrl

	o.strHtmlEditLangFile=g_strHtmlEditLangFile

	o.bMergedImageDialog=g_bMergedImageDialog

	o.strThemeFile=strThemeFile

	o.strContent=((document.getElementById) ? document.getElementById(strId).innerHTML : '')

	o.lFlags = lFlags ? lFlags : 0

	str=MyDlgOpen(

		g_strHtmlEditPath+"htmleditpopup.html",

		500,400,

		new Function("HtmlEditOpenEditorReturn('"+strId+"')"),

		o,

		null,true)

}



function HtmlEditOpenEditorReturn(strId){

	result=dialogWin.returnedValue

	if(result!=null&&document.getElementById)document.getElementById(strId).innerHTML=dialogWin.returnedValue

}



function HtmlEditGetState2(id){

	var pos=id.indexOf('_')

	if(id.substring(0,5)=="hebtn"&&pos>0){

		var cmd=id.substr(pos+1,id.length-pos-1)

		var strId=id.substr(5,pos-5)

		switch(cmd){

		case 'src': return HtmlEditIsEditSrc(strId)

		case 'tableborder': return HtmlEditDisplayTableBorder(strId)

		default: return HtmlEditGetState(id)

		}

	}

}



function HtmlEditDrawBtn(obj,state){

	if(!obj||!obj.style)return

	var os=obj.style

	var btc,blc,bbc,brc

	var filter,bgcolor,visibility

	if(!obj.disabled){

		switch(state){

		case "Over":

			bgcolor=g_strHeCssBtnFaceD

			blc=btc=g_strHeCssBtnHighlight

			brc=bbc=g_strHeCssBtnShadow

			break;

		case "Down":

			bgcolor=g_strHeCssBtnFaceD

			blc=btc=g_strHeCssBtnShadow

			brc=bbc=g_strHeCssBtnHighlight

			break;

		default:

			if(HtmlEditGetState2(obj.id)){

				bgcolor=g_strHeCssBtnFaceD

				blc=btc=g_strHeCssBtnShadow

				brc=bbc=g_strHeCssBtnHighlight

			}

			else{

				bgcolor=g_strHeCssBtnFaceU

				brc=bbc=blc=btc=g_strHeCssBtnFaceU

			}

		    break;

		}

		filter=""

		visibility="visible"

	}

	else{

		brc=bbc=blc=btc="threedface"

		bgcolor="red"

		filter="Chroma(Color=red) Alpha(Opacity=25)"

		visibility="hidden"

	}

	if(os.borderTopColor!=btc)os.borderTopColor=btc

	if(os.borderLeftColor!=blc)os.borderLeftColor=blc

	if(os.borderBottomColor!=bbc)os.borderBottomColor=bbc

	if(os.borderRightColor!=brc)os.borderRightColor=brc

	if(is_ie){

		// ie supports filter. use it to gray out button.

		if(os.backgroundColor!=bgcolor)os.backgroundColor=bgcolor

		if(os.filter!=filter)os.filter=filter

	}

	else{

		if(os.backgroundColor!=bgcolor)os.backgroundColor=bgcolor

		if(os.visibility!=visibility)os.visibility=visibility

	}

}



function HtmlEditCmd(strId,strCmd){

	HtmlEditExecCmd(strId,strCmd,false,'')

	if(strCmd=="JustifyLeft"||strCmd=="JustifyCenter"||strCmd=="JustifyRight"||strCmd=="JustifyFull"){

		HtmlEditDrawBtn(document.getElementById("hebtn"+strId+"_i_JustifyLeft",""))

		HtmlEditDrawBtn(document.getElementById("hebtn"+strId+"_i_JustifyCenter",""))

		HtmlEditDrawBtn(document.getElementById("hebtn"+strId+"_i_JustifyRight",""))

		HtmlEditDrawBtn(document.getElementById("hebtn"+strId+"_i_JustifyFull",""))

	}

}



// e for mozilla,window.event for IE

function HtmlEditBtnOver(e){HtmlEditDrawBtn((e)?e.target:window.event.srcElement,"Over")}

function HtmlEditBtnOut(e){HtmlEditDrawBtn((e)?e.target:window.event.srcElement,"Out")}

function HtmlEditBtnDown(e){HtmlEditDrawBtn((e)?e.target:window.event.srcElement,"Down")}

function HtmlEditBtnUp(e){/*HtmlEditDrawBtn((e)?e.target:window.event.srcElement,"Up")*/}



function HtmlEditHideAllPopup(){PopupHide(g_heAbout);PopupHide(g_heColor);PopupHide(g_hePopup)}

function HtmlEditFormatBlock(strId, obj){var val=obj.options[obj.selectedIndex].value;if(val)HtmlEditExecCmd(strId, 'FormatBlock', false, '<'+val+'>')}

function HtmlEditChangeSize(strId, obj){var val=obj.options[obj.selectedIndex].value;if(val)HtmlEditExecCmd(strId,'FontSize',false,val) }

function HtmlEditFontName(strId, obj){HtmlEditExecCmd(strId, 'FontName', false, obj.options[obj.selectedIndex].value) }



var g_heColorObj=new Object()

function HtmlEditColor(strId, strType, obj){

	HtmlEditHideAllPopup()

	g_heColorObj.strId=strId

	g_heColorObj.strType=strType

	PopupShow(g_heColor, 

		0,24, 

		(is_ie?104+g_strHeCssMenuBorderWidth*2-4:104), 

		(is_ie?84+g_strHeCssMenuBorderWidth*2-4:84), 

		obj)

}



function HtmlEditColorReturn(result) {

	if (g_heColorObj.strType == "HiliteColor") {

	    HtmlEditExecCmd(g_heColorObj.strId,"useCSS",false,false)

		HtmlEditExecCmd(g_heColorObj.strId,g_heColorObj.strType,false,result)

	    HtmlEditExecCmd(g_heColorObj.strId,"useCSS",false,true)

	}

	else {

		HtmlEditExecCmd(g_heColorObj.strId,g_heColorObj.strType,false,result)

	}

}



function HtmlEditSrcShowHideBtns(strId,obj,bShow){

	if(obj.id&&(obj.tagName=="IMG"||obj.tagName=="SELECT")){

		var name="hebtn"+strId

		name=obj.id.substr(name.length,obj.id.length-name.length)

		switch(name){

		case "_src":

		case "_new":

		case "_save":

		case "_copy":

		case "_cut":

		case "_paste":

		case "_undo":

		case "_redo":

		case "_help":

		    break;

		default:

			// disabled property caused firefox .9 to relayout to a bit bigger size

			obj.disabled=!bShow

		}

	}

	// go through all child objects in the toolbar

	if(obj.tagName=="DIV"||obj.tagName=="NOBR"){

		if(obj.childNodes && obj.childNodes.length){

			var len=obj.childNodes.length

			var childNodes=obj.childNodes

			for(var i=0; i<len; i++)HtmlEditSrcShowHideBtns(strId,childNodes.item(i),bShow)

		}

	}

}



function HtmlEditIsEditSrc(strId){return g_arrHtmlEdit[HtmlEditGetDataFromStrId(strId)].bEditSource}



function HtmlEditSrc(strId){

	HtmlEditFocus(strId)

	HtmlEditHideAllPopup()

	

	var i=HtmlEditGetDataFromStrId(strId)

	var str=HtmlEditGetContent(strId)

	HtmlEditCmd(strId,'selectall')

	HtmlEditCmd(strId,'delete')

	var doc=HtmlEditGetDoc(strId)

	g_arrHtmlEdit[i].bEditSource=!g_arrHtmlEdit[i].bEditSource

	

	if (g_arrHtmlEdit[i].bEditSource) {

		g_arrHtmlEdit[i].styleSheetBasic.disabled=false

		if(g_arrHtmlEdit[i].styleSheetMain)g_arrHtmlEdit[i].styleSheetMain.disabled=true

		g_arrHtmlEdit[i].cssTextBody=ObjGetCssText(doc.body)

		ObjSetCssText(doc.body, "")

		g_arrHtmlEdit[i].body.text=doc.body.getAttribute("text")

		g_arrHtmlEdit[i].body.bgColor=doc.body.getAttribute("bgColor")

		SetRemoveAttr(doc.body,"text","")

		SetRemoveAttr(doc.body,"bgColor","")

	}

	else {

		g_arrHtmlEdit[i].styleSheetBasic.disabled=true

		if(g_arrHtmlEdit[i].styleSheetMain)g_arrHtmlEdit[i].styleSheetMain.disabled=false

		ObjSetCssText(doc.body, g_arrHtmlEdit[i].cssTextBody)

		SetRemoveAttr(doc.body,"text",g_arrHtmlEdit[i].body.text)

		SetRemoveAttr(doc.body,"bgColor",g_arrHtmlEdit[i].body.bgColor)

	}

	

	HtmlEditSrcShowHideBtns(strId,document.getElementById("hetoolbar_"+strId),!g_arrHtmlEdit[i].bEditSource)

	HtmlEditSetContent(strId, str)

	HtmlEditPrepareUpdate(strId)

}



function HtmlEditDisplayTableBorder(strId){return g_arrHtmlEdit[HtmlEditGetDataFromStrId(strId)].bTableBorder}



function HtmlEditTableBorder(strId){

	HtmlEditHideAllPopup()

	var i=HtmlEditGetDataFromStrId(strId)

	g_arrHtmlEdit[i].bTableBorder=!g_arrHtmlEdit[i].bTableBorder

	g_arrHtmlEdit[i].styleSheetTable.disabled=!g_arrHtmlEdit[i].bTableBorder

	HtmlEditPrepareUpdate(strId)

}



function HtmlEditTable(strId){

	HtmlEditHideAllPopup()

	MyDlgOpen(

		g_strHtmlEditPath + "htmledittabledlg.html",

		460, 220,

		HtmlEditTableReturn,

		null,

		new Array(strId))

}



function HtmlEditTableReturn(){

	var result=dialogWin.returnedValue

	var strId=dialogWin.callerdata[0]

	var tblcontent, tblattr

	var id=HtmlEditGetDataFromStrId(strId)

	if(result != null){

		tblattr=""

		if(result.ewidth.length)tblattr+="width=\""+result.ewidth+"\""

		if(result.eborderwidth.length)tblattr+="border=\""+result.eborderwidth+"\""

		if(result.ecellpadding.length)tblattr+="cellpadding=\""+result.ecellpadding+"\""

		if(result.ecellspacing.length)tblattr+="cellspacing=\"" + result.ecellspacing + "\""

		if(result.ebgcolor.length)tblattr+="bgcolor=\"" + result.ebgcolor + "\""

		if(result.ebordercolor.length)tblattr+="bordercolor=\"" + result.ebordercolor + "\""

		if(result.ehalign.length)tblattr+="align=\"" + result.ehalign + "\""

		tblcontent=""

		for(j=0; j < result.erows; j ++){

			tblcontent+="<tr>"

			for(i=0; i < result.ecolumns; i ++)

				tblcontent+=((is_ie && (g_arrHtmlEdit[id].lFlags & g_lHeCUseDivForIE)) ? "<td><div>&nbsp;</div></td>" : "<td>&nbsp;</td>")

			tblcontent+="</tr>"

		}

		HtmlEditInsertCode(strId, "<table " + tblattr + ">" + tblcontent + "</table>");

	}

}



function HtmlEditLink(strId){

	HtmlEditHideAllPopup()

	var obj=new Object()

	obj.link=new String()

	obj.target=new String()

	var element=g_heElement

	var e

	

	// right click wont return exact <a> tag occasionally

	if(!element){

		// not from right click

		var rng=RangeGetCurrent(HtmlEditGetDocParent(strId))

		element=RangeGetParentNode(rng)

	}

	if(element){

		e=GetParentObjectByType(element, new Array("A"))

		if(e){

		    obj.href=e.href

		    obj.target=e.target

		}

	}

	MyDlgOpen(

		g_strHtmlEditPath + "htmleditlinkdlg.php",

		400, 160,

		HtmlEditLinkReturn,

		obj,

		new Array(strId, e))

}



function HtmlEditLinkReturn(){

	var result=dialogWin.returnedValue

	var strId=dialogWin.callerdata[0]

	var element=dialogWin.callerdata[1]

	var id=HtmlEditGetDataFromStrId(strId)

	

	if(result != null){

		var linkattr=new String()

		

		if(result.href.substring(0,4)=="www."){

			result.href="http://" + result.href

		}

		

		if(element){

			element.target=result.target

			element.href=result.href

		}

		else{

			if(result.href){

				// cant set right away

				var str=new String(result.href)

				   var id=HtmlEditGetDataFromStrId(strId)

				if(str.indexOf("/") < 0 && g_arrHtmlEdit[id].strBaseHref){

				    str=g_arrHtmlEdit[id].strBaseHref + str

				}

				window.setTimeout("HtmlEditLinkSub('"+strId+"', '"+str+"', '"+result.target+"')")

			}

		}

	}

}



function HtmlEditLinkSub(strId, href, target){

	if(!HtmlEditExecCmd(strId, "CreateLink", false, href))

		alert(g_strHeTextMsgValidURL)

	else{

		var rng=RangeGetCurrent(HtmlEditGetDocParent(strId))

		var element=RangeGetParentNode(rng)

		if(element){

			var e=GetParentObjectByType(element, new Array("A"))

			if(e)e.target=target

		}

	}

}



function HtmlEditImg(strId){

	if(g_bMergedImageDialog){

	    MyDlgOpen(

			g_strHtmlEditImgUrl,

			580, 460,

			HtmlEditImgReturn,

			null,

			new Array(strId))

	}

	else{

	    MyDlgOpen(

			g_strHtmlEditPath + "htmleditimage.html",

			400, 190,

			HtmlEditImgReturn,

			null,

			new Array(strId))

	}

	HtmlEditHideAllPopup()

}



function HtmlEditImgReturn(){

	var result=dialogWin.returnedValue

	var strId=dialogWin.callerdata[0]

	if(result != null){

		var imgattr=new String()

		if(result.src.length){

			if(result.align.length)imgattr+=" align=\""+result.align+"\""

			if(result.border.length)imgattr+=" border=\""+result.border+"\""

			if(result.alt.length)imgattr+=" alt=\""+HtmlSpecialChars(result.alt)+"\""

			if(result.width&&result.width.length)imgattr+=" width=\""+result.width+"\""

			if(result.height&&result.height.length)imgattr+=" height=\""+result.height+"\""

		}

		var str=new String(result.src)

		var id=HtmlEditGetDataFromStrId(strId)

		if(str.indexOf("/") < 0 && g_arrHtmlEdit[id].strBaseHref){

		    str=g_arrHtmlEdit[id].strBaseHref + str

		}        

		HtmlEditInsertCode(strId, "<img src=\"" + str + "\" " + imgattr + " />");

	}

}



function HtmlEditImageProperties(strId){

	if(g_heElement.tagName=="IMG"){

		var obj=new Object()

		obj.src=new String(g_heElement.src)

		obj.align=new String(g_heElement.align)

		obj.border=new String(g_heElement.border)

		obj.alt=new String(g_heElement.alt)

		obj.width=new String(g_heElement.width)

		obj.height=new String(g_heElement.height)

		

		if(g_bMergedImageDialog){

			MyDlgOpen(

				g_strHtmlEditImgUrl,

				580, 460,

				HtmlEditImagePropertiesReturn,

				obj,

				new Array(strId))

		}

		else{

			MyDlgOpen(

				g_strHtmlEditPath + "htmleditimage.html",

				400, 190,

				HtmlEditImagePropertiesReturn,

				obj,

				new Array(strId))

		}

		HtmlEditHideAllPopup()

	}

}



function HtmlEditImagePropertiesReturn(){

	var r=dialogWin.returnedValue

	var strId=dialogWin.callerdata[0]

	if(r!=null){

		g_heElement.src=r.src

		g_heElement.align=r.align

		g_heElement.border=r.border

		g_heElement.alt=r.alt

		if (r.width.length) g_heElement.width=r.width

		if (r.height.length) g_heElement.height=r.height

	}

}



function HtmlEditCellProperties(strId){

	var e=GetParentObjectByType(g_heElement, new Array("TD", "TH"))

	if(e&&(e.tagName=="TD"||e.tagName=="TH")){

		MyDlgOpen(

			g_strHtmlEditPath + "htmleditcelldlg.html",

			460, 200,

			HtmlEditCellPropertiesReturn,

			new Array(e.width, e.height, e.align, e.vAlign, e.bgColor),

			new Array(strId))

	    HtmlEditHideAllPopup()

	}

}



function HtmlEditCellPropertiesReturnSub(e,r){

	SetRemoveAttr(e,"width", r[1])

	SetRemoveAttr(e,"height", r[2])

	SetRemoveAttr(e,"align", r[3])

	SetRemoveAttr(e,"vAlign", r[4])

	SetRemoveAttr(e,"bgColor", r[5])

}



function HtmlEditCellPropertiesReturn(){

	var i

	var e=GetParentObjectByType(g_heElement, new Array("TD", "TH"))

	if(e && (e.tagName=="TD" || e.tagName=="TH")){

	    var result=dialogWin.returnedValue

	    var strId=dialogWin.callerdata[0]

	    if(result != null){

	        switch(result[0]){

	        case 0:

	            HtmlEditCellPropertiesReturnSub(e, result)

	            break

	        case 1:

	            for(i=0; i < e.parentNode.cells.length; i ++)

	                HtmlEditCellPropertiesReturnSub(e.parentNode.cells[i], result)

	            break

	        case 2:

	            table=e.parentNode.parentNode

	            for(i=0; i < table.rows.length; i ++)

	                HtmlEditCellPropertiesReturnSub(table.rows[i].cells[e.cellIndex], result)

	            break

	        }

	    }

	}

}



function HtmlEditTableProperties(strId){

	var e=GetParentObjectByType(g_heElement, new Array("TABLE"))

	if(e && e.tagName=="TABLE"){

		var obj=new Object()

		obj.ewidth=e.width

		obj.eborderwidth=e.border

		obj.ecellpadding=e.cellPadding

		obj.ecellspacing=e.cellSpacing

		obj.ebgcolor=e.bgColor

		obj.ebordercolor=e.borderColor

		obj.ehalign=e.align

		MyDlgOpen(g_strHtmlEditPath + "htmledittabledlg.html",

		    460, 220,

		    HtmlEditTablePropertiesReturn,

		    obj, new Array(strId))

		HtmlEditHideAllPopup()

	}

}



function HtmlEditTablePropertiesReturn(){

	var e=GetParentObjectByType(g_heElement,new Array('TABLE'))

	if(e&&e.tagName=="TABLE"){

		var res=dialogWin.returnedValue

		var strId=dialogWin.callerdata[0]

		if(res!=null){

			SetRemoveAttr(e,'width',res.ewidth)

			SetRemoveAttr(e,'border',res.eborderwidth)

			SetRemoveAttr(e,'cellPadding',res.ecellpadding)

			SetRemoveAttr(e,'cellSpacing',res.ecellspacing)

			SetRemoveAttr(e,'bgColor',res.ebgcolor)

			SetRemoveAttr(e,'borderColor',res.ebordercolor)

			SetRemoveAttr(e,'align',res.ehalign)

		}

	}

}



function HtmlEditPageProperties(strId){

	var obj=new Object()

	var doc=HtmlEditGetDoc(strId)

	obj.title=doc.title

	obj.text=doc.body.getAttribute("text")

	obj.bgColor=doc.body.getAttribute("bgcolor")

	obj.background=doc.body.getAttribute("background")

	obj.marginWidth=is_ie ? doc.body.getAttribute("leftmargin") : doc.body.getAttribute("marginwidth")

	obj.marginHeight=is_ie ? doc.body.getAttribute("topmargin") : doc.body.getAttribute("marginheight")

	obj.link=doc.body.getAttribute("link")

	obj.alink=doc.body.getAttribute("aLink")

	obj.vlink=doc.body.getAttribute("vLink")

	MyDlgOpen(g_strHtmlEditPath + "htmleditpageprop.html",

		460, 220,

		HtmlEditPagePropertiesReturn,

		obj, new Array(strId))

	HtmlEditHideAllPopup()

}



function HtmlEditPagePropertiesReturn(){

	var result=dialogWin.returnedValue

	var strId=dialogWin.callerdata[0]

	var doc=HtmlEditGetDoc(strId)

	if(result != null){

		doc.title=result.title

		SetRemoveAttr(doc.body,'text', result.text)

		SetRemoveAttr(doc.body,'bgColor', result.bgColor)

		SetRemoveAttr(doc.body,'link', result.link)

		SetRemoveAttr(doc.body,'aLink', result.alink)

		SetRemoveAttr(doc.body,'vLink', result.vlink)

		SetRemoveAttr(doc.body,'topMargin', result.marginHeight)

		SetRemoveAttr(doc.body,'marginHeight', result.marginHeight)

		SetRemoveAttr(doc.body,'leftMargin', result.marginWidth)

		SetRemoveAttr(doc.body,'marginWidth', result.marginWidth)

	}

}



function HtmlEditOListProperties(){

	var e=GetParentObjectByType(g_heElement, new Array("OL"), new Array("TD", "TH", "TABLE", "UL"))

	if(e){

		MyDlgOpen(g_strHtmlEditPath + "htmleditolpropdlg.html",

			320, 110,

			HtmlEditOListPropertiesReturn,

			new Array(e.type),

			null)

		HtmlEditHideAllPopup()

	}

}



function HtmlEditOListPropertiesReturn(){

	var e=GetParentObjectByType(g_heElement, new Array("OL"), new Array("TD", "TH", "TABLE", "UL"))

	var result=dialogWin.returnedValue

	if(e)SetRemoveAttr(e,'type', result[0])

}



function HtmlEditUListProperties(){

	var e=GetParentObjectByType(g_heElement, new Array("UL"), new Array("TD", "TH", "TABLE", "UL"))

	if(e){

		MyDlgOpen(g_strHtmlEditPath + "htmleditulpropdlg.html",

			320, 110,

			HtmlEditUListPropertiesReturn,

			new Array(e.type),

			null)

		HtmlEditHideAllPopup()

	}

}



function HtmlEditUListPropertiesReturn(){

	var e=GetParentObjectByType(g_heElement, new Array("UL"), new Array("TD", "TH", "TABLE", "UL"))

	result=dialogWin.returnedValue

	if(e)SetRemoveAttr(e,'type', result[0])

}



function HtmlEditUpdateTextarea(strId){

	var strValue=HtmlEditGetDefContent(strId)

	var id=HtmlEditGetDataFromStrId(strId)

	if(g_arrHtmlEdit[id].strTextareaId && document.getElementById(g_arrHtmlEdit[id].strTextareaId))

		document.getElementById(g_arrHtmlEdit[id].strTextareaId).value=strValue

}



function HtmlEditSubmit(strId, strElementName){

	var strValue=HtmlEditGetDefContent(strId)

	document.getElementById(strId+"_"+strElementName).value=strValue

	document.getElementById(strId+"_"+strElementName).form.submit()

}



function HtmlEditSave(strId){MyDlgHandleOK(HtmlEditGetDefContent(strId))}



function HtmlEditHelp(strId){PopupShow(g_heAbout, 0, 0, 250, 160, document.getElementById(strId), true)}



function HtmlEditApplyStyle(strId, selobj){

	HtmlEditFocus(strId)

	var rng=RangeGetCurrent(HtmlEditGetDocParent(strId))

	var doc=HtmlEditGetDoc(strId)

	if(!rng||selobj.value.length==0) return

	var str="<span class=\"" + selobj.value + "\">" + RangeGetHtmlText(rng) + "</span>"

	HtmlEditCmd(strId, "Delete")

	HtmlEditInsertCode(strId, str)

//    RangeSetHtmlText(rng, str)

}



// this function is for IE only for fixing up <div> tag

function HtmlEditProcessKeyPressed(strId){

	if(is_ie && HtmlEditGetDocParent(strId).event.keyCode==13){

		HtmlEditCheckParagraph(strId)

	}

}



function HtmlEditGenButton(strId, name, cmd, img, tip){

	document.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + name + "\" onclick=\"javascript: HtmlEditExecCmd('" + strId + "', '" + cmd + "', false, null)\" src=\"" + g_strHtmlEditPath + "htmleditimg/" + img + "\" alt=\"" + tip + "\" title=\"" + tip + "\" width=\"20\" height=\"20\" />")

}



function HtmlEditCheckParagraph(strId){

	var id=HtmlEditGetDataFromStrId(strId)

	if(is_ie && (g_arrHtmlEdit[id].lFlags & g_lHeCUseDivForIE)){

	var doc=HtmlEditGetDoc(strId)

		switch(doc.queryCommandValue('FormatBlock')){

		case "Normal": // IE name for p and div tag

		case "": // Midas div tag

		case "p": // Midas name

			if(is_ie) HtmlEditExecCmd(strId, 'FormatBlock', false, '<div>')

			break;

		}

	}

}



function HtmlEditOutControlCode(strId,strWidth,strHeight,strValue,lFlags,strFormName,strElementName,strAction,strTarget,obj){

	var str

	var d=document

	var bSomething=false

	

	str=(lFlags & g_lHeCBorder)?"1":"0"

	d.write("<table cellpadding="+str+" cellspacing=0 bgcolor=black style=\"width: " + strWidth + "\"><tr><td>")

	d.write("<div id=\"hetoolbar_" + strId + "\" unselectable=on class=\"htmledittoolbar\" oncontextmenu=\"return false\">")

	

	// toolbars

	d.write("<nobr>")

	if((lFlags & g_lHeCDisableNewBtn)==0){

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_new\" onclick=\"javascript: HtmlEditNew('" + strId + "')\" src=" + g_strHtmlEditPath + "htmleditimg/new.gif alt=\"" + g_strHeTextNew + "\" title=\"" + g_strHeTextNew + "\" width=\"20\" height=\"20\" />")

		bSomething=true

	}

	if((lFlags & g_lHeCModeMask)==g_lHeCModeStandaloneForm){

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_save\" onclick=\"javascript: HtmlEditSubmit('" + strId + "', '" + strElementName + "')\" src=" + g_strHtmlEditPath + "htmleditimg/save.gif alt=\"" + g_strHeTextSave + "\" title=\"" + g_strHeTextSave + "\" width=\"20\" height=\"20\" />")

		bSomething=true

	}

	else if((lFlags & g_lHeCModeMask)==g_lHeCModeStandaloneDialog){

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_save\" onclick=\"javascript: HtmlEditSave('" + strId + "')\" src=" + g_strHtmlEditPath + "htmleditimg/save.gif alt=\"" + g_strHeTextSave + "\" title=\"" + g_strHeTextSave + "\" width=\"20\" height=\"20\" />")

		bSomething=true

	}

	if((lFlags & g_lHeCDisableCutCopyPasteBtn)==0 && is_ie){

		HtmlEditGenButton(strId,"_copy","Copy","copy.gif",g_strHeTextCopy)

		HtmlEditGenButton(strId,"_cut","Cut","cut.gif",g_strHeTextCut)

		HtmlEditGenButton(strId,"_paste","Paste","paste.gif",g_strHeTextPaste)

		bSomething=true

	}

	if(bSomething)d.write("&nbsp;&nbsp;")

	if((lFlags & g_lHeCDisableUndoRedoBtn)==0){

		HtmlEditGenButton(strId,"_undo","Undo","undo.gif",g_strHeTextUndo)

		HtmlEditGenButton(strId,"_redo","Redo","redo.gif",g_strHeTextRedo)

		d.write("&nbsp;&nbsp;")

	}

	d.write("</nobr>")

	

	bSomething=false

	d.write("<nobr>")

	if(!(lFlags & g_lHeCDisableParagraph)){

		d.write("<select class=htmledittext name=\"hedropdown" + strId + "_FormatBlock" + "\" id=\"hedropdown" + strId + "_FormatBlock" + "\" onclick=\"this.selectedIndex=0\" onchange=\"javascript: HtmlEditFormatBlock('" + strId + "', this)\">"+

			"<option value=\"\">" + g_strHeTextStyle + "</option>"+

			"<option value=\""+((is_ie && (lFlags & g_lHeCUseDivForIE))?"div":"p")+"\">"+g_strHeTextStyleParagraph+"</option>"+

			"<option value=\"pre\">"+g_strHeTextStylePreformatted+"</option>"+

			"<option value=\"h1\">"+g_strHeTextStyleHeader1+"</option>"+

			"<option value=\"h2\">"+g_strHeTextStyleHeader2+"</option>"+

			"<option value=\"h3\">"+g_strHeTextStyleHeader3+"</option>"+

			"<option value=\"h4\">"+g_strHeTextStyleHeader4+"</option>"+

			"<option value=\"h5\">"+g_strHeTextStyleHeader5+"</option>"+

			"<option value=\"h6\">"+g_strHeTextStyleHeader6+"</option></select>")

		bSomething=true

	}

	if(!(lFlags & g_lHeCDisableFontSize)){

		d.write("<select class=htmledittext name=\"hedropdown" + strId + "_FormatSize" + "\" id=\"hedropdown" + strId + "_FormatSize" + "\" onchange=\"javascript: HtmlEditChangeSize('" + strId + "', this)\">"+

			"<option value=\"\">" + g_strHeTextFontSize + "</option>"+

			"<option value=\"7\">7 (36pt)</option>"+

			"<option value=\"6\">6 (24pt)</option>"+

			"<option value=\"5\">5 (18pt)</option>"+

			"<option value=\"4\">4 (14pt)</option>"+

			"<option value=\"3\">3 (12pt)</option>"+

			"<option value=\"2\">2 (10pt)</option>"+

			"<option value=\"1\">1 (8pt)</option></select>")

	    bSomething=true

	}

	if(!(lFlags & g_lHeCDisableFontName)){

		d.write("<select class=htmledittext name=\"hedropdown" + strId + "_FormatFont" + "\" id=\"hedropdown" + strId + "_FormatFont" + "\" onchange=\"javascript: HtmlEditFontName('" + strId + "', this)\">")

		d.write("<option value=\"\">"+g_strHeTextChooseFont+"</option></select>")

		bSomething=true

	}

	if(!(lFlags & g_lHeCDisableStyleBox)){

		d.write("<select class=htmledittext name=\"hedropdown" + strId + "_ApplyStyle" + "\" id=\"hedropdown" + strId + "_ApplyStyle" + "\" onchange=\"javascript: HtmlEditApplyStyle('" + strId + "', this)\">")

		d.write("<option value=\"\">" + g_strHeTextStyle + "</option></select>")

		bSomething=true

	}

	if(bSomething) d.write("&nbsp;&nbsp;")

	d.write("</nobr>")

	

	bSomething=false

	d.write("<nobr>")

	if(!(lFlags & g_lHeCDisableForeColor)){

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_ForeColor\" onclick=\"javascript: HtmlEditColor('" + strId + "', 'ForeColor', this)\"  src=" + g_strHtmlEditPath + "htmleditimg/forecolor.gif alt=\"" + g_strHeTextForeColor + "\" title=\"" + g_strHeTextForeColor + "\" width=\"20\" height=\"20\" />")

		bSomething=true

	}

	if(!(lFlags & g_lHeCDisableBackColor)/* && is_ie*/)	{

		var str=is_ie ? "BackColor" : "HiliteColor"

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_BackColor\" onclick=\"javascript: HtmlEditColor('" + strId + "', '"+str+"', this)\"  src=" + g_strHtmlEditPath + "htmleditimg/backcolor.gif alt=\"" + g_strHeTextBackColor + "\" title=\"" + g_strHeTextBackColor + "\" width=\"20\" height=\"20\" />")

		bSomething=true

	}

	

	if(!(lFlags & g_lHeCDisableFormattingBtns1)){

		HtmlEditGenButton(strId,"_i_bold","Bold","bold.gif",g_strHeTextBold)

		HtmlEditGenButton(strId,"_i_Italic","Italic","italic.gif",g_strHeTextItalic)

		HtmlEditGenButton(strId,"_i_Underline","Underline","under.gif",g_strHeTextUnderline)

		bSomething=true

	}

	if(!(lFlags & g_lHeCDisableFormattingBtns2)){

		HtmlEditGenButton(strId,"_i_StrikeThrough","StrikeThrough","strike.gif",g_strHeTextStrikeThru)

		HtmlEditGenButton(strId,"_i_Superscript","Superscript","super.gif",g_strHeTextSuperscript)

		HtmlEditGenButton(strId,"_i_Subscript","Subscript","sub.gif",g_strHeTextSubscript)

		bSomething=true

	}

	if(bSomething)d.write("&nbsp;&nbsp;")

	d.write("</nobr>")

	

	d.write("<nobr>")

	if(!(lFlags & g_lHeCDisableFormattingBtns3)){

		HtmlEditGenButton(strId,"_outindent","Outdent","deindent.gif",g_strHeTextUnindent)

		HtmlEditGenButton(strId,"_inindent","Indent","inindent.gif",g_strHeTextIndent)

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_i_InsertOrderedList\" onclick=\"javascript: HtmlEditExecCmd('" + strId + "', 'InsertOrderedList', false, null); HtmlEditCheckParagraph('" + strId + "')\" src=\"" + g_strHtmlEditPath + "htmleditimg/numlist.gif\" alt=\"" + g_strHeTextNumList + "\" title=\"" + g_strHeTextNumList + "\" width=\"20\" height=\"20\" />")

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_i_InsertUnorderedList\" onclick=\"javascript: HtmlEditExecCmd('" + strId + "', 'InsertUnorderedList', false, null); HtmlEditCheckParagraph('" + strId + "')\" src=\"" + g_strHtmlEditPath + "htmleditimg/bullist.gif\" alt=\"" + g_strHeTextBullList + "\" title=\"" + g_strHeTextBullList + "\" width=\"20\" height=\"20\" />")

		d.write("&nbsp;&nbsp;")

	}

	   

	if(!(lFlags & g_lHeCDisableAlignBtn)){

		HtmlEditGenButton(strId,"_i_JustifyLeft","JustifyLeft","left.gif",g_strHeTextLeftAlign)

		HtmlEditGenButton(strId,"_i_JustifyCenter","JustifyCenter","center.gif",g_strHeTextCenterAlign)

		HtmlEditGenButton(strId,"_i_JustifyRight","JustifyRight","right.gif",g_strHeTextRightAlign)

		HtmlEditGenButton(strId,"_i_JustifyFull","JustifyFull","justify.gif",g_strHeTextJustifyAlign)

		d.write("&nbsp;&nbsp;")

	}

	d.write("</nobr>")

	

	d.write("<nobr>")

	if(!(lFlags & g_lHeCDisableLinkBtn))

	    d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_CreateLink\" onclick=\"javascript: g_heElement=null; HtmlEditLink('" + strId + "') \" src=" + g_strHtmlEditPath + "htmleditimg/link.gif alt=\"" + g_strHeTextHyperlink + "\" title=\"" + g_strHeTextHyperlink + "\" width=\"20\" height=\"20\" />")

	if(!(lFlags & g_lHeCDisableHorizontalRuleBtn))

	    HtmlEditGenButton(strId,"_InsertLine","InsertHorizontalRule","line.gif",g_strHeTextHorzLine)

	if(!(lFlags & g_lHeCDisableTableBtn)){

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_table\" onclick=\"javascript: HtmlEditTable('" + strId + "') \" src=" + g_strHtmlEditPath + "htmleditimg/table.gif alt=\"" + g_strHeTextTable + "\" title=\"" + g_strHeTextTable + "\" width=\"20\" height=\"20\" />")

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_tableborder\" onclick=\"javascript: HtmlEditTableBorder('" + strId + "') \" src=" + g_strHtmlEditPath + "htmleditimg/border.gif alt=\"" + g_strHeTextTable + "\" title=\"" + g_strHeTextTableBorder + "\" width=\"20\" height=\"20\" />")

	}

	if(!(lFlags & g_lHeCDisableImageBtn))

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_image\" onclick=\"javascript: HtmlEditImg('" + strId + "') \" src=" + g_strHtmlEditPath + "htmleditimg/image.gif alt=\"" + g_strHeTextImage + "\" title=\"" + g_strHeTextImage + "\" />")

	if(!(lFlags & g_lHeCDisableSymbolBtn))

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_symbol\" src=" + g_strHtmlEditPath + "htmleditimg/symbol.gif alt=\"" + g_strHeTextSymbol + "\" title=\"" + g_strHeTextSymbol + "\" />")

	if(!(lFlags & g_lHeCDisableSourceBtn))

		d.write("<img align=absmiddle class=\"htmleditbtn\" id=\"hebtn" + strId + "_src\" onclick=\"javascript: HtmlEditSrc('" + strId + "') \" src=" + g_strHtmlEditPath + "htmleditimg/10101.gif alt=\"" + g_strHeTextHTMLSource + "\" title=\"" + g_strHeTextHTMLSource + "\" width=\"20\" height=\"20\" />")

	

	HtmlEditOutControlControlSub(strId, strHeight, lFlags, obj)

	

	if(obj.strPageSrc){

	    d.write("<iframe src=\"" + obj.strPageSrc + "\" name=\"" + strId + "_iframe\" id=\"" + strId + "_iframe\" style=\"display: none; \"")

	    d.write(" onload=\"javascript: HtmlEditFrameLoaded("+(g_arrHtmlEdit.length-1)+")\"")

	    d.write("></iframe>")

	}

	

	d.write("</td></tr></table>")

}



function HtmlEditNew(strId){

	if(window.confirm(g_strHeTextNewMsg)){

		var id=HtmlEditGetDataFromStrId(strId)

		HtmlEditCmd(strId, "SelectAll")

		HtmlEditCmd(strId, "Delete")

		if(is_ie && (g_arrHtmlEdit[id].lFlags & g_lHeCUseDivForIE)) HtmlEditExecCmd(strId, "FormatBlock", false, "<div>")

	}

}



function HtmlEditFrameLoaded(id){g_arrHtmlEdit[id].bFrameLoaded=true}

function HtmlEditBlankLoaded(id){

g_arrHtmlEdit[id].bBlankLoaded=true

}



function HtmlEditUpdateBtnEvents(obj){

	if(!obj)return

	if(obj.id&&obj.id.substring(0,5)=="hebtn"){

		obj.onmouseover=HtmlEditBtnOver

		obj.onmouseout=HtmlEditBtnOut

		obj.onmousedown=HtmlEditBtnDown

		obj.onmouseup=HtmlEditBtnUp

	}

	else{

		var child=obj.firstChild

		while (child){

			HtmlEditUpdateBtnEvents(child)

			child=child.nextSibling

		}

	}

}



function HtmlEditCreateControlFromObj(obj){

	// create all popup if not ever created

	HtmlEditCreatePopups()

	

	// some defaults

	var strId=obj.strId ? obj.strId : ("htmledit" + g_arrHtmlEdit.length)

	var strWidth=obj.strWidth ? obj.strWidth : '100%'

	var strHeight=obj.strHeight ? obj.strHeight : '100px'

	var strValue

	var lFlags=obj.lFlags ? obj.lFlags : (g_lHeCModeFormElement | g_lHeCBorder)

	

	if(!obj.strCssStyle) lFlags=lFlags | g_lHeCDisableStyleBox

	if(lFlags&g_lHeCResizeToWindow)lFlags&=~g_lHeCBorder

	if(lFlags&g_lHeCEnableSafeHtml)lFlags|=g_lHeCXHTMLSource

	

	// save data in global object

	var id=g_arrHtmlEdit.length

	g_arrHtmlEdit[id]=new Object()

	g_arrHtmlEdit[id].strId=strId

	if(!obj.strPageSrc) g_arrHtmlEdit[id].strValue=obj.strValue ? obj.strValue : ''

	

	g_arrHtmlEdit[id].lFlags=lFlags

	g_arrHtmlEdit[id].strFormName=obj.strFormName

	g_arrHtmlEdit[id].strElementName=obj.strElementName

	g_arrHtmlEdit[id].strCssStyle=obj.strCssStyle

	if(obj.strPageSrc) g_arrHtmlEdit[id].strPageSrc=obj.strPageSrc

	if(obj.strTextareaId) g_arrHtmlEdit[id].strTextareaId=obj.strTextareaId

	g_arrHtmlEdit[id].bEditSource=false

	g_arrHtmlEdit[id].bTableBorder=true

	g_arrHtmlEdit[id].bInit=true

	g_arrHtmlEdit[id].lBlankCount=0

	g_arrHtmlEdit[id].lFrameCount=0

	g_arrHtmlEdit[id].onLoad=obj.onLoad

	g_arrHtmlEdit[id].body=new Object()

	g_arrHtmlEdit[id].bLoaded=false

	if(obj.strBaseHref) g_arrHtmlEdit[id].strBaseHref=obj.strBaseHref

	if(!obj.lMarginWidth) obj.lMarginWidth=5

	if(!obj.lMarginHeight) obj.lMarginHeight=5

	

	// mozilla wants editor creation code in another function, then the editor can be

	// accessed by getElementById()

	HtmlEditOutControlCode(

		strId,

		strWidth,

		strHeight,

		strValue,

		lFlags,

		obj.strFormName,

		obj.strElementName,

		obj.strAction,

		obj.strTarget,

		obj)

	

	// create corresponding form elements

	if((lFlags & g_lHeCModeMask)==g_lHeCModeStandaloneForm && obj.strElementName){

		document.write("<div style=\"overflow: hidden; position: absolute; width: 0px; height: 0px; visibility: hidden;\">")

		document.write("<form method=\"post\"")

		if(obj.strFormName)document.write(" name=\"" + obj.strFormName + "\"")

		if(obj.strAction)document.write(" action=\"" + obj.strAction + "\"")

		if(obj.strTarget)document.write(" target=\"" + obj.strTarget + "\"")

		document.write(">")

		document.write("<input type=\"hidden\" id=\"" + strId + "_" + obj.strElementName + "\" name=\"" + obj.strElementName + "\" />")

		document.write("<input type=\"hidden\" name=\"" + obj.strElementName + "_bHtmlEdit\" value=\"1\" />")

		document.write("</form></div>")

	}

	else if((lFlags&g_lHeCModeMask)==g_lHeCModeFormElement && obj.strElementName){

		document.write("<input type=\"hidden\" id=\"" + strId + "_" + obj.strElementName + "\" name=\"" + obj.strElementName + "\" />")

		document.write("<input type=\"hidden\" name=\"" + obj.strElementName + "_bHtmlEdit\" value=\"1\" />")

		var func=new Function("var obj = document.getElementById('" + strId + "_" + obj.strElementName + "'); if(obj){ obj.value = HtmlEditGetDefContent('" + strId + "');}")

		AttachEventListener(document.getElementById(strId + "_" + obj.strElementName).form, "submit", func)

	}

	

	if(lFlags&g_lHeCResizeToWindow){

		var func = new Function("HtmlEditResize('"+strId+"')")

		AttachEventListener(document.getElementById("hetoolbar_" + strId), "resize", func)

		AttachEventListener(window,"resize",func)

		window.setTimeout("HtmlEditResize('"+strId+"')", 100)

	}



	// ie requires designMode to be on first before initialization	

	if (is_ie) HtmlEditGetDoc(strId).designMode='on'



	// leave remaining initialization in another function to

	// wait for that all objects are accessible

	// better use timer to do initialization after system is ready

	// need to turn on designMode before attach event for IE??

    window.setTimeout("HtmlEditInit('" + id + "')", 1)

}



function HtmlEditCreateControl2(

    strId, strWidth, strHeight, strValue, lFlags,

    strFormName, strElementName, strAction, strTarget){

	var obj = new Object()

	obj.strId = strId

	obj.strWidth = strWidth

	obj.strHeight = strHeight

	obj.strValue = strValue

	obj.lFlags = lFlags

	obj.strFormName = strFormName

	obj.strElementName = strElementName

	obj.strAction = strAction

	obj.strTarget = strTarget

	HtmlEditCreateControlFromObj(obj)

}



function HtmlEditGetDataFromStrId(strId){

	for(var i = 0; i < g_arrHtmlEdit.length; i ++)

		if(g_arrHtmlEdit[i].strId==strId) return i

	return -1

}



function HtmlEditUpdateAllFormElements(){

	if(g_lUpdateTimer >= 0) window.clearTimeout(g_lUpdateTimer)

	for(var i = 0; i < g_arrHtmlEdit.length; i ++){

		// form element?

		if((g_arrHtmlEdit[i].lFlags & g_lHeCModeMask)==g_lHeCModeFormElement){

			var strId = g_arrHtmlEdit[i].strId

			var obj = document.getElementById(strId + "_" + g_arrHtmlEdit[i].strElementName)

			if(obj){

				obj.value = HtmlEditGetDefContent(strId)

				if(g_arrHtmlEdit[i].strTextareaId && document.getElementById(g_arrHtmlEdit[i].strTextareaId))

					document.getElementById(g_arrHtmlEdit[i].strTextareaId).value = obj.value

			}

		}

	}

}



var g_arrContextData

function HtmlEditContextMenu(myEvent, strId){

	if(!myEvent) {

		if (window.event) 

			myEvent=window.event // ie6

		else

			myEvent=window.frames[0].event	// ie5.5

	}

	var element = (myEvent.target) ? myEvent.target : myEvent.srcElement

	if(myEvent.preventDefault) myEvent.preventDefault()

	

	var id=HtmlEditGetDataFromStrId(strId)

	var doc=HtmlEditGetDoc(strId)

	var ctrl=document.getElementById(strId)

	

	var lefter2 = myEvent.clientX

	var topper2 = myEvent.clientY



	var str = ""

	var numitems = 0

	if(is_ie){

		str=str+

			HtmlEditGetMenuItem(g_strHeTextCut, (doc.queryCommandEnabled("Cut") ? "HtmlEditCmd('" + strId + "', 'Cut')" : null)) +

			HtmlEditGetMenuItem(g_strHeTextCopy, (doc.queryCommandEnabled("Copy") ? "HtmlEditCmd('" + strId + "', 'Copy')" : null)) +

			HtmlEditGetMenuItem(g_strHeTextPaste, (doc.queryCommandEnabled("Paste") ? "HtmlEditExecCmd('" + strId + "', 'Paste', false, null)" : null))

		numitems += 3

	}

	

	str = str +

		HtmlEditGetMenuItem(g_strHeTextDelete, (doc.queryCommandEnabled("Delete") ? "HtmlEditCmd('" + strId + "', 'Delete')" : null)) +

		HtmlEditGetMenuItem(g_strHeTextSelectAll, (doc.queryCommandEnabled("SelectAll") ? "HtmlEditCmd('" + strId + "', 'SelectAll')" : null))

	numitems += 2

	if(!HtmlEditIsEditSrc(strId)){

		g_heElement = element

		

		str = str +

			HtmlEditGetMenuSeparator() +

			HtmlEditGetMenuItem(g_strHeTextRemoveFormats, (doc.queryCommandEnabled("RemoveFormat") ? "HtmlEditCmd('" + strId + "', 'RemoveFormat')" : null)) +

			HtmlEditGetMenuItem(g_strHeTextRemoveLink, (doc.queryCommandEnabled("Unlink") ? "HtmlEditCmd('" + strId + "', 'Unlink')" : null)) +

			HtmlEditGetMenuItem(g_strHeTextHyperlink, (doc.queryCommandEnabled("CreateLink") ? "HtmlEditLink('" + strId + "')" : null))

		numitems = numitems + 4

		

		var bSep = false

		if(GetParentObjectByType(element, new Array("TABLE"))){

		    bSep = true

		    str = str +

				HtmlEditGetMenuSeparator() +

				HtmlEditGetMenuItem(g_strHeTextInsColBefore, "HtmlEditInsertColumnBefore('" + strId + "')") +

				HtmlEditGetMenuItem(g_strHeTextInsColAfter, "HtmlEditInsertColumnAfter('" + strId + "')") +

				HtmlEditGetMenuItem(g_strHeTextInsRowAbove, "HtmlEditInsertRowBefore('" + strId + "')") +

				HtmlEditGetMenuItem(g_strHeTextInsRowBelow, "HtmlEditInsertRowAfter('" + strId + "')") +

				HtmlEditGetMenuItem(g_strHeTextDelCol, "HtmlEditDeleteColumn()") +

				HtmlEditGetMenuItem(g_strHeTextDelRow, "HtmlEditDeleteRow()") +

				HtmlEditGetMenuItem(g_strHeTextDeleteTable, "HtmlEditDeleteTable()") +

				HtmlEditGetMenuItem(g_strHeTextTableProp, "HtmlEditTableProperties('" + strId + "')") +

				HtmlEditGetMenuItem(g_strHeTextCellProp, "HtmlEditCellProperties('" + strId + "')")

		    numitems += 10

		}

		

		if(element.tagName=="IMG"){

		    bSep=true

		    str=str+

		        HtmlEditGetMenuSeparator()+

		        HtmlEditGetMenuItem(g_strHeTextImageProp, "HtmlEditImageProperties()")

		    numitems+=2

		}

		

		if(GetParentObjectByType(element, new Array("OL"), new Array("TD", "TH", "TABLE", "UL"))){

		    if(!bSep){ str = str + HtmlEditGetMenuSeparator(); numitems ++; bSep = true}

		    str=str+HtmlEditGetMenuItem(g_strHeTextOListProp, "HtmlEditOListProperties()")

		    numitems++

		}

		

		if(GetParentObjectByType(element, new Array("UL"), new Array("TD", "TH", "TABLE", "OL"))){

		    if(!bSep){ str = str + HtmlEditGetMenuSeparator(); numitems ++; bSep = true}

		    str = str + HtmlEditGetMenuItem(g_strHeTextUListProp, "HtmlEditUListProperties()")

		    numitems ++

		}



		if(g_arrHtmlEdit[id].lFlags&g_lHeCEditPage){

		    str = str +

				HtmlEditGetMenuSeparator() +

				HtmlEditGetMenuItem(g_strHeTextPageProperties, "HtmlEditPageProperties('" + strId + "')")

		    numitems += 2

		}

	}

	

	g_arrContextData = new Array(str, numitems, lefter2, topper2, ctrl)

	window.setTimeout("HtmlEditContextTime()", 1)

	return false

}



function HtmlEditContextTime(){

	PopupSetContent(g_hePopup, HtmlEditGetMenuStart() + g_arrContextData[0] + HtmlEditGetMenuEnd())

	PopupShow(g_hePopup, g_arrContextData[2], 

		g_arrContextData[3], 

		160, 

		is_ie ? (18 * g_arrContextData[1] + g_strHeCssMenuBorderWidth * 2 - 2) : (18 * g_arrContextData[1]), 

		g_arrContextData[4]);

}



function HtmlEditResize(strId){

	var docheight,toolbarheight

	var statusbarheight=0

	toolbarheight=document.getElementById("hetoolbar_" + strId).offsetHeight

	if(document.getElementById("hestatusbar_" + strId)){

	    statusbarheight = document.getElementById("hestatusbar_" + strId).offsetHeight

	}

	if(window.innerHeight)

	    docheight = window.innerHeight

	else{

	    if(document.documentElement && document.documentElement.clientHeight){

	        docheight = document.documentElement.clientHeight

	    }

	    else{

	        docheight = document.body.clientHeight

	    }

	}

	docheight = docheight - toolbarheight - statusbarheight

	document.getElementById(strId).style.height = docheight + "px"

}



function HtmlEditPopulateFontListBox(id) {

	var strId=g_arrHtmlEdit[id].strId

	var doc=HtmlEditGetDoc(strId)

	var arr=new Array()

	var fontList



	if (is_ie)

		fontList = document.all("hedropdown" + g_arrHtmlEdit[id].strId + "_FormatFont")

	else 

		fontList = document.getElementById("hedropdown" + g_arrHtmlEdit[id].strId + "_FormatFont")



	if(fontList){

		var dlgObj = document.getElementById("heDlgHelper")

	    if(dlgObj && (g_arrHtmlEdit[id].lFlags & g_lHeCEnumSysFonts)){

	    	var count = dlgObj.fonts.Count

	        for(var i = 1; i < count; i ++) {

	        	var font = heDlgHelper.fonts(i)

	            if(dlgObj.getCharset(font)==g_lHeCharset)

	                arr[arr.length] = font

	        }

	    }

	    else 

	    	arr = g_arrHeFonts

	    arr.sort()

	

	    for(i = 0; i < arr.length; i ++){

	        oOption = document.createElement("OPTION")

	        oOption.text = arr[i]

	        oOption.value = arr[i]

	        ObjSetCssText(oOption, "font-family: " + oOption.value)

	        if(is_ie)

	            fontList.add(oOption)

	        else

	            fontList.appendChild(oOption)

	    }

	}

}



function HtmlEditInit(id){

	var strId=g_arrHtmlEdit[id].strId

	var doc=HtmlEditGetDoc(strId)

	var ss,i

	

	if(!g_arrHtmlEdit[id].bBlankLoaded){

	    if(g_arrHtmlEdit[id].lBlankCount<20){

	        // not loaded yet. check again later

	        window.setTimeout("HtmlEditInit('" + id + "')", g_arrHtmlEdit[id].lBlankCount * 50)

	        g_arrHtmlEdit[id].lBlankCount ++

	        return

	    }

	}



	HtmlEditPopulateFontListBox(id)



	// create style sheet for view source editor

	ss=StyleSheetCreate(doc)

	StyleSheetAddRule(ss, "body", "font-family: lucida console, courier, monospace; font-size: 9pt;")

	StyleSheetAddRule(ss, "p", "padding: 0px; margin: 0px;")

	ss.disabled = true

	g_arrHtmlEdit[id].styleSheetBasic=ss

	

	// create style sheet for table border

	ss=StyleSheetCreate(doc)

	StyleSheetAddRule(ss, "table", "border: 1px dotted black;")

	StyleSheetAddRule(ss, "td", "border: 1px dotted black;")

	StyleSheetAddRule(ss, "th", "border: 1px dotted black;")

	g_arrHtmlEdit[id].styleSheetTable=ss

	

	// user style sheet

	if(g_arrHtmlEdit[id].strCssStyle){

	    g_arrHtmlEdit[id].styleSheetMain=StyleSheetCreateFromUrl(doc, g_arrHtmlEdit[id].strCssStyle)

	    g_arrHtmlEdit[id].lCssCheck = 0

        // must populate style first

		if(!(g_arrHtmlEdit[id].lFlags & g_lHeCDisableStyleBox)){

		    window.setTimeout("HtmlEditInitPopulateStyle('" + id + "')", 10)

		}

	}

    HtmlEditInitSetContent(id)

}



// copy page properties (title, body color, etc.) from dummy iframe to editor iframe

function HtmlEditInitSetContent(id){

	var e,doc,obj

	

	try {

		doc = HtmlEditGetDoc(g_arrHtmlEdit[id].strId)

		obj = HtmlEditGetDoc(g_arrHtmlEdit[id].strId + "_iframe")

	}

	catch (e){}

	

	if(obj){

	    if(g_arrHtmlEdit[id].bFrameLoaded){

			// page loaded. copy body content

			g_arrHtmlEdit[id].strValue = obj.body.innerHTML

			

			// copy body attribute

			for(var i = 0; i < obj.body.attributes.length; i ++){

			    // ie has everything in attributes, even not defined.

			    if(obj.body.attributes[i].value &&

					obj.body.attributes[i].value.length &&

					obj.body.attributes[i].value != "null"){

					var str = obj.body.attributes[i].name

					str = str.toUpperCase()

					switch(str){

					case "ACCESSKEY":

					case "ALINK":

					case "BACKGROUND":

					case "BGCOLOR":

					case "BGPROPERTIES":

					case "BOTTOMMARGIN":

					case "CLASS":

					case "HIDEFOCUS":

					case "ID":

					case "LANG":

					case "LEFTMARGIN":

					case "LINK":

					case "RIGHTMARGIN":

					case "SCROLL":

					case "STYLE":

					case "TABINDEX":

					case "TEXT":

					case "TITLE":

					case "TOPMARGIN":

					case "VLINK":

					case "MARGINWIDTH":

					case "MARGINHEIGHT":

					    SetRemoveAttr(doc.body,obj.body.attributes[i].name, obj.body.attributes[i].value)

					}

			    }

	        }

	        doc.title = obj.title

	    }

	    else if(g_arrHtmlEdit[id].lFrameCount < 15){

			// not loaded yet. check again later

			window.setTimeout("HtmlEditInitSetContent('" + id + "')", g_arrHtmlEdit[id].lFrameCount * 200)

			g_arrHtmlEdit[id].lFrameCount ++

			return

	    }

	    else{

			// give up. dont bother.

			g_arrHtmlEdit[id].strValue = "Unable to download the specified page!"

	    }

	}

	

	if(g_arrHtmlEdit[id].strTextareaId && document.getElementById(g_arrHtmlEdit[id].strTextareaId))

	    g_arrHtmlEdit[id].strValue = document.getElementById(g_arrHtmlEdit[id].strTextareaId).value



    g_arrHtmlEdit[id].strValue = ((g_arrHtmlEdit[id].lFlags & g_lHeCDetectPlainText) && !IsHtmlText(g_arrHtmlEdit[id].strValue)) ? PlainTextToHtml(g_arrHtmlEdit[id].strValue) : g_arrHtmlEdit[id].strValue



	if(g_arrHtmlEdit[id].strBaseHref){

		var base=doc.createElement("base")

		var head=doc.getElementsByTagName("head")

		head[0].appendChild(base)

		SetRemoveAttr(base,"href", g_arrHtmlEdit[id].strBaseHref)

	}



    HtmlEditInit3(id)



    // avoid any focus. otherwise, page will scroll to last element

}



function HtmlEditInit3(id){

	var doc,e,strId

	var strId=g_arrHtmlEdit[id].strId

	try{doc=HtmlEditGetDoc(g_arrHtmlEdit[id].strId)}

	catch(e){}

	doc.body.innerHTML = g_arrHtmlEdit[id].strValue



	// seems firefox not setting design mode properly if done earlier.

	// do it here

	if (!is_ie) doc.designMode='on'



	HtmlEditUpdateBtnEvents(document.getElementById("hetoolbar_"+strId))

	var obj=document.getElementById("hebtn" + strId + "_symbol")

	if(obj)obj.onclick=HtmlEditInsertSymbol



	var docobj

	var func=new Function("return HtmlEditPrepareUpdate('"+strId+"')")

	if(is_ie)docobj=document.frames[strId].document

	else docobj=doc

	AttachEventListener(docobj,"keyup",func)

	AttachEventListener(docobj,"keydown",func)

	AttachEventListener(docobj,"click",func)

	AttachEventListener(docobj,"contextmenu",new Function("return HtmlEditContextMenu(arguments[0], '"+strId+"')"))

	AttachEventListener(docobj,"dblclick",new Function("return HtmlEditDblClick(arguments[0], '"+strId+"')"))

	AttachEventListener(is_ie?window.frames[strId]:docobj,"focus",new Function("HtmlEditInit4("+id+")"))

	if(is_ie)AttachEventListener(docobj,"keydown",new Function("HtmlEditProcessKeyPressed('"+strId+"')"))

	

	// before editor unload, copies content to textarea and let browser remember the content

	if(g_arrHtmlEdit[id].strTextareaId)

	    AttachEventListener(window,(is_ie?"beforeunload":"unload"),new Function("HtmlEditUpdateTextarea('"+strId+"')"))



	g_arrHtmlEdit[id].bLoaded=true

	if(g_arrHtmlEdit[id].onLoad){

	    g_arrHtmlEdit[id].onLoad()

	}

}



function HtmlEditInit4(id){

	if(g_arrHtmlEdit[id].bInit){

		g_arrHtmlEdit[id].bInit=false

		if(is_gecko){

			HtmlEditSetContent(g_arrHtmlEdit[id].strId,g_arrHtmlEdit[id].strValue)

		    HtmlEditExecCmd(g_arrHtmlEdit[id].strId,"useCSS",false,true)

		}

	}

}



// populate style drop down list box

function HtmlEditInitPopulateStyle(id){

	var doc=HtmlEditGetDoc(g_arrHtmlEdit[id].strId)

	var arr=new Array()

	if  (!document.getElementById("hedropdown" + g_arrHtmlEdit[id].strId + "_ApplyStyle")) return

	// populate style drop down list box

	if(g_arrHtmlEdit[id].styleSheetMain){

		var rules = new Array()

        var e

        try {

        // may failed because stylesheet is in other domain

        rules = StyleSheetGetRulesArray(g_arrHtmlEdit[id].styleSheetMain)

        } catch (e) {}

		var obj = document.getElementById("hedropdown" + g_arrHtmlEdit[id].strId + "_ApplyStyle")

		for(var i = 0; i < rules.length; i ++){

		    var selector = rules[i].selectorText

		    if(selector.indexOf(",") < 0 &&

		        selector.indexOf(" ") < 0 &&

		        selector.charAt(0)=="."){

		        arr[arr.length] = new String(selector.substring(1,selector.length))

		    }

		}

		arr.sort()

		for(i = 0; i < arr.length; i ++){

		    oOption = document.createElement("OPTION")

		    oOption.text = arr[i]

		    oOption.value = arr[i]

		    if(document.all)

		        obj.add(oOption)

		    else

		        obj.appendChild(oOption)

		}

	}

	// not loaded yet. try again later but with longer delay

	else if(g_arrHtmlEdit[id].lCssCheck < 15){

	    window.setTimeout("HtmlEditInitPopulateStyle('" + id + "')", g_arrHtmlEdit[id].lCssCheck * 100)

	    g_arrHtmlEdit[id].lCssCheck ++

	}

}



function HtmlEditPrepareUpdate(strId){

	HtmlEditHideAllPopup()

	if(g_lUpdateTimer>=0)window.clearTimeout(g_lUpdateTimer)

	g_lUpdateTimer=window.setTimeout(new Function("HtmlEditUpdate('"+strId+"')"),160)

}



// trace thru all tool bar buttons and update them

function HtmlEditUpdateBtnState(obj,strElement){

	var i

	if(obj.id){

		var id = obj.id

		if(id.substring(0, 5)=="hebtn" /*&& id.indexOf("_i_") > 0 */&& id.indexOf(strElement) > 0){

		    var pos = id.indexOf("_i_")

		    var str = id.substr(pos + 3, id.length - pos - 3)

		    HtmlEditDrawBtn(obj, "")

		}

	}

	if(obj.tagName=="DIV"||obj.tagName=="NOBR"){

		if(obj.childNodes && obj.childNodes.length)

			for(i=0; i<obj.childNodes.length; i++)

		    	HtmlEditUpdateBtnState(obj.childNodes.item(i), strElement)

	}

}



function HtmlEditUpdate(strId){

	var doc=HtmlEditGetDoc(strId)

	if(!doc)return

	var i,id

	var count = 0

	

	// force IE to use <div> tag if editor contains nothing

	if(is_ie){

	    var id = HtmlEditGetDataFromStrId(strId)

	    if(g_arrHtmlEdit[id].lFlags&g_lHeCUseDivForIE){

			var str=new String(HtmlEditGetContent(strId,true))

			str=Trim(str)

			str=str.toLowerCase()

			if(!g_arrHtmlEdit[id].bEditSource && (str=="" || str=="<p>&nbsp;</p>")){

				HtmlEditCmd(strId,"SelectAll")

				HtmlEditCmd(strId,"Delete")

				HtmlEditExecCmd(strId,"FormatBlock",false,"<div>")

			}

	    }

	}

	

	// button states

	var obj=document.getElementById('hetoolbar_'+strId)

	if(obj&&obj.childNodes)for(i=0;i<obj.childNodes.length;i++)HtmlEditUpdateBtnState(obj.childNodes.item(i),strId)

	

	// update formatting

	obj=document.getElementById("hedropdown"+strId+"_FormatBlock")

	if(obj){

		switch(doc.queryCommandValue('FormatBlock')){

		case "Normal": // IE name for p and div tag

		case "": // Midas div tag

		case "p": // Midas name

		    obj.selectedIndex=1;break;

		case "Formatted": 

		case "pre":

		    obj.selectedIndex=2;break;

		case "Heading 1": 

		case "h1":

		    obj.selectedIndex=3;break;

		case "Heading 2": 

		case "h2":

		    obj.selectedIndex=4;break;

		case "Heading 3": 

		case "h3":

		    obj.selectedIndex=5;break;

		case "Heading 4": 

		case "h4":

		    obj.selectedIndex=6;break;

		case "Heading 5": 

		case "h5":

		    obj.selectedIndex=7;break;

		case "Heading 6": 

		case "h6":

		    obj.selectedIndex=8;break;

		default: 

		    obj.selectedIndex=0;break;

		}

	}

	

	// size

	obj=document.getElementById("hedropdown"+strId+"_FormatSize")

	if(obj){

		var str=doc.queryCommandValue('FontSize')

		var bFound=false

		if(str){

		    for(i = 0; i < obj.options.length; i ++){

		        if(obj.options[i].value==str){

		            obj.selectedIndex = i

		            bFound = true

		            break

		        }

			}

		}

		if(!bFound)obj.selectedIndex=0

	}

	

	// font name

	obj=document.getElementById("hedropdown"+strId+"_FormatFont")

	if(obj){

		var str=doc.queryCommandValue('FontName')

		var bFound=false

		if(str){

		    for(i = 0; i < obj.options.length; i ++){

				var str2=obj.options[i].value

				str2=str2.toLowerCase()

				str=str.toLowerCase()

				if(str2==str){

				    obj.selectedIndex=i

				    bFound=true

				    break

				}

		    }

		}

		if(!bFound)obj.selectedIndex=0

	}

	

	// insert/overwrite

	if(is_ie){

		obj=document.getElementById("hestatus_"+strId+"_insert")

		if(obj)obj.style.color = (doc.queryCommandState("OverWrite")) ? "graytext" : "windowtext"

	}

	

	// style

	var rng=RangeGetCurrent(HtmlEditGetDocParent(strId))

	obj=document.getElementById("hedropdown"+strId+"_ApplyStyle")

	if(rng&&obj){

		var node = RangeGetParentNode(rng)

		var className = null

		var bFound = false

		while(node && !bFound){

		    if(is_ie)

		        className = node.className

		    else if(node.getAttribute)

		        className = node.getAttribute("class")

		    if(className){

				for(i = 0; i < obj.options.length; i ++){

				    if(obj.options[i].value==className){

						obj.selectedIndex=i

						bFound=true

						break

				    }

				}

		    }

		    node=is_ie?node.parentElement:node.parentNode

		}

		if(!bFound)obj.selectedIndex=0

	}

}



function HtmlEditPopupInsertCode(strId, content){

	HtmlEditInsertCode(strId, content)

	HtmlEditFocus(strId)

	HtmlEditHideAllPopup()

}



function HtmlEditInsertSymbol(event){

	// Mozilla pass event thru argument. IE depends on window.event

	if(!event) event=window.event

	var target=(event.target) ? event.target : event.srcElement

	var id=target.id

	var pos=id.indexOf("_")

	var strId

	if(id.substring(0,5)=="hebtn" && pos > 0)

		strId = id.substr(5,pos-5)

	else

		return false

	

	// toolbar offset relative to the page

	var lefter2=0

	var topper2=24

	

	var numitems=g_arrHeCharacterList.length

	g_heElement=null

	var str=new String()

	for(var i = 0; i < g_arrHeCharacterList.length; i ++){

		str = str + HtmlEditGetMenuItem(

		    g_arrHeCharacterList[i],

		    "HtmlEditPopupInsertCode('"+strId+"', '"+HtmlSpecialChars(g_arrHeCharacterList[i])+"')")

	}

	PopupSetContent(g_hePopup, HtmlEditGetMenuStart() + str + HtmlEditGetMenuEnd())

	PopupShow(

		g_hePopup, 

		lefter2, 

		topper2, 

		g_lSymbolMenuWidth, 

		(is_ie ? (18 * numitems + g_strHeCssMenuBorderWidth * 2 - 2) : (18 * numitems)), 

		target)

	return false

}



function HtmlEditGetMenuStart(){

    return "<div oncontextmenu=\"return false\" style=\"position: relative; top:0; left:0; border:"+g_strHeCssMenuBorderWidth+"px solid "+g_strHeCssMenuBottomRight+";  border-top:"+g_strHeCssMenuBorderWidth+"px solid "+g_strHeCssMenuTopLeft+"; border-left:"+g_strHeCssMenuBorderWidth+"px solid "+g_strHeCssMenuTopLeft+"; background: "+g_strHeCssMenuBack+"; height:100%; width:100%; \">\n"

}



function HtmlEditGetMenuItem(strItem, strAction){

	var strParent

	if(window.createPopup)

	    strParent = "parent."

	else

	    strParent = ""

	if(strAction)

	    str =

	        "<div unselectable=on style=\"position:relative; top:0px; left:0px; background:" + g_strHeCssMenuBack + "; height:" + (is_ie ? 18 : 16) + "px; color:windowtext; font-family:sans-serif; padding: 0px 0px 0px 10px; margin: 0px 2px 0px 2px; font-size:8pt; cursor:pointer; border: 1px solid " + g_strHeCssMenuBack + ";\" "

	        + "onmouseover=\"this.style.background='"+g_strHeCssMenuUBack+"'; this.style.color='"+g_strHeCssMenuUText+"'; this.style.borderLeftColor = '"+g_strHeCssMenuUTopLeft+"'; this.style.borderTopColor = '"+g_strHeCssMenuUTopLeft+"'; this.style.borderRightColor = '"+g_strHeCssMenuUBottomRight+"'; this.style.borderBottomColor = '"+g_strHeCssMenuUBottomRight+"'\"; "

	        + "onmouseout=\"this.style.background='"+g_strHeCssMenuBack+"'; this.style.color='"+g_strHeCssMenuText+"'; this.style.borderLeftColor = '"+g_strHeCssMenuBack+"'; this.style.borderTopColor = '"+g_strHeCssMenuBack+"'; this.style.borderRightColor = '"+g_strHeCssMenuBack+"'; this.style.borderBottomColor = '"+g_strHeCssMenuBack+"'\";\" "

	        + "onclick=\"" + strParent + strAction + "\""

	else

	    str = "<div style=\"position:relative; top:0px; left:0px; background:" + g_strHeCssMenuBack + "; height:" + (is_ie ? 18 : 16) + "px; color:" + g_strHeCssMenuGrayText + "; font-family:sans-serif; padding: 0px 0px 0px 10px; border: 1px solid " + g_strHeCssMenuBack + "; font-size:8pt;\" "

	return str + ">" + strItem + "</div>\n"

}



function HtmlEditGetMenuSeparator(){

	return "<div unselectable=on style=\"position:relative; top:0px; left:0px; background: " + g_strHeCssMenuBack + "; height: " + (is_ie ? 18 : 16) + "px; padding: 0px 0px 0px 10px; margin: 0px 2px 0px 2px; border: 1px solid " + g_strHeCssMenuBack + ";\">"

	+"<table cellpadding=0 cellspacing=0 border=0 width=98%>"

	+"<tr><td height=5></td></tr>"

	+"<tr><td height=1 style=\"background-color: " + g_strHeCssMenuSeparatorTop + ";\"></td></tr>"

	+"<tr><td height=1 style=\"background-color: " + g_strHeCssMenuSeparatorBottom + ";\"></td></tr>"

	+"</table></div>"

}



function HtmlEditGetMenuEnd(){return"</div>"}



function HtmlEditGetPage(aID){

	var doc=HtmlEditGetDoc(aID)

	if(doc&&doc.body){

		// change back to editing mode

		if(HtmlEditIsEditSrc(aID)) HtmlEditSrc(aID)

		var str = new String()

		str=str+"<html>\n<head>\n"

		str=str+"<title>"+HtmlSpecialChars(doc.title)+"</title>\n"

		var charset = (document.characterSet) ? document.characterSet : document.charset

		str=str+"<meta HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; CHARSET=" + charset + "\" />\n"

		str=str+"</head>\n<body"

		// copy body attributes

		for(var i = 0; i < doc.body.attributes.length; i ++){

			// ie has everything in attributes, even not defined.

			if(doc.body.attributes[i].value &&

				doc.body.attributes[i].value.length &&

				doc.body.attributes[i].value != "null"){

				var strName = new String(doc.body.attributes[i].name)

				strName = strName.toUpperCase()

				switch(strName){

				// skip the following attributes

				case "DISABLED":

				case "CONTENTEDITABLE":

				    break;

				default:

				    str=str+" "+doc.body.attributes[i].name+"=\""+HtmlSpecialChars(doc.body.attributes[i].value)+"\""

				    break;

				}

			}

		}

		str=str+">\n"

		str=str+HtmlEditGetContent(aID)

		str=str+"\n</body>\n</html>\n"

		return str

	}

	return ""

}



function HtmlEditGetContent(aID,bFast){

	var doc=HtmlEditGetDoc(aID)

	if(doc&&doc.body){

		var id = HtmlEditGetDataFromStrId(aID)

		if(g_arrHtmlEdit[id].bEditSource){

		    if(is_ie)

		        return doc.body.innerText

		    else{

		        var html = doc.body.ownerDocument.createRange()

		        html.selectNodeContents(doc.body);

		        return html.toString();

		    }

		}

		else{

		    if(bFast||(!is_gecko&&!is_ie6up)||!(g_arrHtmlEdit[id].lFlags&g_lHeCXHTMLSource))

		        return doc.body.innerHTML

		    else

		        return GetInnerHtmlFromNode(doc.body,g_arrHtmlEdit[id].strBaseHref,(g_arrHtmlEdit[id].lFlags&g_lHeCEnableSafeHtml))

		}

	}

	return ''

}



function HtmlEditGetDefContent(strId){

	var id = HtmlEditGetDataFromStrId(strId)

	if(id < 0) return ""

	return ((g_arrHtmlEdit[id].lFlags & g_lHeCEditPage) ? HtmlEditGetPage(strId) : HtmlEditGetContent(strId))

}



function HtmlEditSetInsertPoint(aID, bStart){

	var doc = HtmlEditGetDoc(aID)

	if(doc && doc.body){

	    if(is_gecko){

			var sel=document.getElementById(aID).contentWindow.getSelection()

			sel.removeAllRanges()

			var range=doc.createRange()

			

			if(doc.body.childNodes.length > 0){

			    var container = doc.body

			    var pos = 0

			

			    container = bStart ? doc.body.childNodes[0] : doc.body.childNodes[doc.body.childNodes.length - 1]

			    if(container.nodeType==3 ||

					container.tagName=="H1" ||

					container.tagName=="H2" ||

					container.tagName=="H3" ||

					container.tagName=="H4" ||

					container.tagName=="H5" ||

					container.tagName=="H6" ||

					container.tagName=="P" ||

					container.tagName=="DIV"

					){

			        range.setStart(container, 0)

			        range.setEnd(container, 0)

			        // cant set to end!

			    }

			    else{

			        if(bStart){

			            range.setStartBefore(container)

			            range.setEndBefore(container)

			        }

			        else{

			            range.setStartAfter(container)

			            range.setEndAfter(container)

			        }

			    }

			}

			else{

			    range.selectNodeContents(doc.body)

			}

			

			sel.addRange(range)

	    }

	    else{

	        var range = doc.body.createTextRange()

	        range.collapse(bStart)

	        range.select()

	    }

	}

}



function HtmlEditSetContent(aID, strContent){

	var doc=HtmlEditGetDoc(aID)

	if(doc&&doc.body){

		var id=HtmlEditGetDataFromStrId(aID)

		var str

		if(g_arrHtmlEdit[id].bEditSource){

			str = new String(HtmlSpecialChars(Trim(strContent)))

			// convert all forms of EOLN to single linefeed, then convert to br tag

			str = str.replace(/\r\n/g, "\n")

			str = str.replace(/\r/g, "\n")

			str = str.replace(/\n\n/g, "\n")

			str = str.replace(/\n/g, "<br />\n")

		}

		else{

			str = strContent

		}

		

		// for gecko browsers, strValue will be copied to editor

		// for the first focus and therefore better to sync this

		// value when this function is called.

		g_arrHtmlEdit[id].strValue = strContent

		

		// midas not working properly after using innerHTML method for setting content.

		// using execCommand instead (but need to avoid focus problem that cause

		// page scrolling)

		if(is_gecko){

			doc.body.innerHTML = ""

			HtmlEditInsertCode(aID,str)

		}

		else{

			doc.body.innerHTML = str

		}

		HtmlEditSetInsertPoint(aID, true)

	}

}



function HtmlEditInsertColumnBefore(strId){

	var row = g_heElement.parentNode

	var table = row.parentNode

	var index = g_heElement.cellIndex

	var id = HtmlEditGetDataFromStrId(strId)

	for(var i = 0; i < table.rows.length; i ++){

	    var obj = table.rows[i].insertCell(index)

	    if(is_ie && (g_arrHtmlEdit[id].lFlags & g_lHeCUseDivForIE)) 

	        obj.innerHTML = "<div>&nbsp;</div>"

	}

	HtmlEditHideAllPopup()

	PopupSetContent(g_hePopup, '')

}



function HtmlEditInsertColumnAfter(strId){

	var row = g_heElement.parentNode

	var table = row.parentNode

	var index = g_heElement.cellIndex

	var id = HtmlEditGetDataFromStrId(strId)

	for(var i = 0; i < table.rows.length; i ++){

	    var obj = table.rows[i].insertCell(index + 1)

	    if(is_ie && (g_arrHtmlEdit[id].lFlags & g_lHeCUseDivForIE)) 

	        obj.innerHTML = "<div>&nbsp;</div>"

	}

	HtmlEditHideAllPopup()

	PopupSetContent(g_hePopup, '')

}



function HtmlEditInsertRowBefore(strId){

	var row = g_heElement.parentNode

	var table = row.parentNode

	var newrow = table.insertRow(row.rowIndex)

	var id = HtmlEditGetDataFromStrId(strId)

	for(var i = 0; i < row.cells.length; i ++){

	    var obj = newrow.insertCell(-1)

	    if(is_ie && (g_arrHtmlEdit[id].lFlags & g_lHeCUseDivForIE)) 

	        obj.innerHTML = "<div>&nbsp;</div>"

	}

	HtmlEditHideAllPopup()

	PopupSetContent(g_hePopup, '')

}



function HtmlEditInsertRowAfter(strId){

	var row = g_heElement.parentElement

	var table = row.parentElement

	var newrow = table.insertRow(row.rowIndex + 1)

	var id = HtmlEditGetDataFromStrId(strId)

	for(var i = 0; i < row.cells.length; i ++){

	    var obj = newrow.insertCell(-1)

	    if(is_ie && (g_arrHtmlEdit[id].lFlags & g_lHeCUseDivForIE)) 

	        obj.innerHTML = "<div>&nbsp;</div>"

	}

	HtmlEditHideAllPopup()

	PopupSetContent(g_hePopup,'')

}



function HtmlEditDeleteColumn(){

	var row=g_heElement.parentNode

	var index=g_heElement.cellIndex

	var table=row.parentNode

	var e

	if(table.tagName=="TR")table=table.parentNode

	try {

		for(var i=0;i<table.rows.length;i++)

		    table.rows[i].deleteCell(index)

	}

	catch (e) {}

	PopupSetContent(g_hePopup,'')

	HtmlEditHideAllPopup()

}



function HtmlEditDeleteRow(){

	var row=g_heElement.parentNode

	var table=row.parentNode

	table.deleteRow(row.rowIndex)

	HtmlEditHideAllPopup()

}



function HtmlEditDeleteTable(){

	var table=GetParentObjectByType(g_heElement, new Array("TABLE"))

	table.parentNode.removeChild(table)

	HtmlEditHideAllPopup()

}



function HtmlEditDblClick(myEvent, strId){

	if(!myEvent) {

		if (window.event) 

			myEvent=window.event // ie6

		else

			myEvent=window.frames[0].event	// ie5.5

	}

	var element = (myEvent.target) ? myEvent.target : myEvent.srcElement

	

	if(myEvent.preventDefault)myEvent.preventDefault()

	

	var id=HtmlEditGetDataFromStrId(strId)

	

	doc=HtmlEditGetDoc(strId)

	var ctrl=document.getElementById(strId)

	

	g_heElement=null

	

	if(element.tagName=="IMG"){

	    g_heElement=element

	    window.setTimeout("HtmlEditImageProperties('"+strId+"')", 1)

	    return

	}

	g_heElement=GetParentObjectByType(element, new Array("A"))

	if(g_heElement){

	    g_heElement = element

		window.setTimeout("HtmlEditLink('" + strId + "')", 1)

	}

}



function HtmlEditCreatePopupsSub(strId){

	var i,j,strParent,str

	

	// obj for enum sys font

	if(is_ie6up)document.write("<object id=\"heDlgHelper\" CLASSID=\"clsid:3050f819-98b5-11cf-bb82-00aa00bdce0b\" width=\"0px\" height=\"0px\" style=\"position: absolute; left: 0px; top: 0px;\"></object>")

	

	// color dialog

	var arrColor=new Array(

		new Array("ff0000","400000","800000","c00000","ff4040","ff8080","ffc0c0","000000"),

		new Array("ff8000","402000","804000","c06000","ffa040","ffc080","ffe0c0","171717"),

		new Array("ffff00","404000","808000","c0c000","ffff40","ffff80","ffffc0","2e2e2e"),

		new Array("80ff00","204000","408000","60c000","a0ff40","c0ff80","e0ffc0","464646"),

		new Array("00ff00","004000","008000","00c000","40ff40","80ff80","c0ffc0","5d5d5d"),

		new Array("00ff80","004020","008040","00c060","40ffa0","80ffc0","c0ffe0","747474"),

		new Array("00ffff","004040","008080","00c0c0","40ffff","80ffff","c0ffff","8b8b8b"),

		new Array("0080ff","002040","004080","0060c0","40a0ff","80c0ff","c0e0ff","a2a2a2"),

		new Array("0000ff","000040","000080","0000c0","4040ff","8080ff","c0c0ff","b9b9b9"),

		new Array("8000ff","200040","400080","6000c0","a040ff","c080ff","e0c0ff","d1d1d1"),

		new Array("ff00ff","400040","800080","c000c0","ff40ff","ff80ff","ffc0ff","e8e8e8"),

		new Array("ff0080","400020","800040","c00060","ff40a0","ff80c0","ffc0e0","ffffff"));

	str="";

	strParent=(!g_heColor.bDiv)?"parent.":''

	for(i=0;i<arrColor.length;i++){

	    for(j=0;j<arrColor[i].length;j++){

	        var coords=(j*13)+","+(i*7)+","+((j+1)*13)+","+((i+1)*7)

	        str=str+"<area shape=\"rect\" coords=\""+coords

	            +"\" onclick=\"javascript: "+strParent+"HtmlEditColorReturn('#"+arrColor[i][j]+"')\" title=\"#"+arrColor[i][j]+"\" />"

	    }

	}

	PopupSetContent(g_heColor,

	    HtmlEditGetMenuStart() +

	    "<map name=\"colormap\">" + str +"</map>" +

	    "<img src="+g_strHtmlEditPath+"htmleditimg/colortable.gif width=104 height=84 alt=\"\" border=0 usemap=\"#colormap\" style=\"cursor: pointer;\" />" +

	    HtmlEditGetMenuEnd())

	

	// symbol popup

	var numitems = g_arrHeCharacterList.length

	strParent=(!g_heSymbol.bDiv)?"parent.":''

	str=""

	for(i=0;i<g_arrHeCharacterList.length;i++)

	    str=str+HtmlEditGetMenuItem(g_arrHeCharacterList[i],strParent+"HtmlEditPopupInsertCode('" + strId + "', '" + HtmlSpecialChars(g_arrHeCharacterList[i]) + "')")

	PopupSetContent(g_heSymbol,HtmlEditGetMenuStart()+str+HtmlEditGetMenuEnd())

}



function HtmlEditIsLoaded(strId){

	var id=HtmlEditGetDataFromStrId(strId)

	if(id>=0) {

		return g_arrHtmlEdit[id].bLoaded

	}

	else{

		return false

	}

}