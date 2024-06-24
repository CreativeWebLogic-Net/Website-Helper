// JavaScript Document


/********************************************************************************
Copyright (C) 1999 Thomas Brattli
This script is made by and copyrighted to Thomas Brattli at www.bratta.com
Visit for more great scripts. This may be used freely as long as this msg is intact!
I will also appriciate any links you could give me.
********************************************************************************/
//Default browsercheck, added to all scripts!
function checkBrowser(){
	this.ver=navigator.appVersion
	this.dom=document.getElementById?1:0
	this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom)?1:0;
	this.ie4=(document.all && !this.dom)?1:0;
	this.ns5=(this.dom && parseInt(this.ver) >= 5) ?1:0;
	this.ns4=(document.layers && !this.dom)?1:0;
	this.bw=(this.ie5 || this.ie4 || this.ns4 || this.ns5)
	return this
}
bw=new checkBrowser()
/* Set the variables below.
If you look at the init function you can see that you can also set
these variables different for each menu!

If you only want 1 menu just remove the lines marked with *
in the init function and the divs from the page.
*/

//How many pixels should it move every step? 
var tMove=10;

//At what speed (in milliseconds, lower value is more speed)
var tSpeed=40

//Do you want it to move with the page if the user scroll the page?
var tMoveOnScroll=true

//How much of the menu should be visible in the in state?
var tShow=20

/********************************************************************
Contructs the menuobjects -Object functions
*********************************************************************/
function makeMenu(obj,nest,show,move,speed){
    nest=(!nest) ? '':'document.'+nest+'.'
	this.el=bw.dom?document.getElementById(obj):bw.ie4?document.all[obj]:bw.ns4?eval(nest+'document.'+obj):0;
  	this.css=bw.dom?document.getElementById(obj).style:bw.ie4?document.all[obj].style:bw.ns4?eval(nest+'document.'+obj):0;		
	this.x=(bw.ns4 || bw.ns5)? this.css.left:this.el.offsetLeft;
	this.y=(bw.ns4 || bw.ns5)? this.css.top:this.el.offsetTop;		
	this.state=1; this.go=0; this.mup=b_mup; this.show=show; this.mdown=b_mdown; 
	this.height=bw.ns4?this.css.document.height:this.el.offsetHeight
	this.moveIt=b_moveIt; this.move=move; this.speed=speed
    this.obj = obj + "Object"; 	eval(this.obj + "=this")	
}
function b_moveIt(x,y){this.x=x; this.y=y; this.css.left=this.x; this.css.top=this.y}
//Menu in
function b_mup(){
	if(this.y>-this.height+this.show){
		this.go=1; this.moveIt(this.x,this.y-this.move)
		setTimeout(this.obj+".mup()",this.speed)
	}else{this.go=0; this.state=1}	
}
//Menu out
function b_mdown(){
	if(this.y<eval(scrolled)){
		this.go=1; this.moveIt(this.x,this.y+this.move)
		setTimeout(this.obj+".mdown()",this.speed)
	}else{this.go=0; this.state=0}	
}
/********************************************************************************
Deciding what way to move the menu (this is called onmouseover, onmouseout or onclick)
********************************************************************************/
function moveTopMenu(num){
	if(!oMenu[num].go){
		if(!oMenu[num].state)oMenu[num].mup()	
		else oMenu[num].mdown()
	}
}
/********************************************************************************
Checking if the page is scrolled, if it is move the menu after
********************************************************************************/
function checkScrolled(){
	for(i=0;i<oMenu.length;i++){
		if(!oMenu[i].go){
			y=!oMenu[i].state?eval(scrolled):eval(scrolled)-oMenu[i].height+oMenu[i].show
			oMenu[i].moveIt(oMenu[i].x,y)
		}
	}
	if(bw.ns4) setTimeout('checkScrolled()',40)
}
/********************************************************************************
Inits the page, makes the menu object, moves it to the right place, 
show it
********************************************************************************/
function topMenuInit(){
	oMenu=new Array()
	oMenu[0]=new makeMenu('divMenu0','',tShow,tMove,tSpeed) 
	oMenu[1]=new makeMenu('divMenu1','',tShow,tMove,tSpeed) //*
	//Here's an example of how you can set the properties for each menu: //*
	oMenu[2]=new makeMenu('divMenu2','',20,10,20) //*
	//You can add as many menus you want like the line above.
	//Just remember to add the actual divs in the style and body as well.
	
	scrolled=bw.ns4?"window.pageYOffset":"document.body.scrollTop"
	//Placing and showing menus
	for(i=0;i<oMenu.length;i++){
		oMenu[i].moveIt(oMenu[i].x,-oMenu[i].height+oMenu[i].show)
		oMenu[i].css.visibility='visible'
	}
	if(tMoveOnScroll) bw.ns4?checkScrolled():window.onscroll=checkScrolled;
}

//Initing menu on pageload

