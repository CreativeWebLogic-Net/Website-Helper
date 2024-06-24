/*
   Deluxe Menu Data File
   Created by Deluxe Tuner v2.4
   http://deluxe-menu.com
*/


// -- Deluxe Tuner Style Names
var itemStylesNames=["Top Item",];
var menuStylesNames=["Top Menu",];
// -- End of Deluxe Tuner Style Names

//--- Common
var isHorizontal=1;
var smColumns=1;
var smOrientation=0;
var smViewType=0;
var dmRTL=0;
var pressedItem=-2;
var itemCursor="default";
var itemTarget="_self";
var statusString="link";
var blankImage="/jscript/menu/images/blank.gif";

//--- Dimensions
var menuWidth="";
var menuHeight="";
var smWidth="";
var smHeight="";

//--- Positioning
var absolutePos=0;
var posX="10";
var posY="10";
var topDX=0;
var topDY=1;
var DX=-5;
var DY=0;

//--- Font
var fontStyle="normal 11px Trebuchet MS, Tahoma";
var fontColor=["#163443","#FFFFFF"];
var fontDecoration=["none","none"];
var fontColorDisabled="#8FC1DA";

//--- Appearance
var menuBackColor="#B9CCE3";
var menuBackImage="";
var menuBackRepeat="repeat";
var menuBorderColor="#789FC7";
var menuBorderWidth=1;
var menuBorderStyle="solid";

//--- Item Appearance
var itemBackColor=["#DAE3FA","#D9CE00"];
var itemBackImage=["",""];
var itemBorderWidth=1;
var itemBorderColor=["#DAE3FA","#FFFA1C"];
var itemBorderStyle=["solid","solid"];
var itemSpacing=1;
var itemPadding="5px 5px 5px 10px";
var itemAlignTop="left";
var itemAlign="left";
var subMenuAlign="";

//--- Icons
var iconTopWidth=16;
var iconTopHeight=16;
var iconWidth=16;
var iconHeight=16;
var arrowWidth=7;
var arrowHeight=7;
var arrowImageMain=["arrv_white.gif",""];
var arrowImageSub=["arr_black.gif","arr_white.gif"];

//--- Separators
var separatorImage="";
var separatorWidth="100%";
var separatorHeight="3";
var separatorAlignment="left";
var separatorVImage="";
var separatorVWidth="3";
var separatorVHeight="100%";
var separatorPadding="0px";

//--- Floatable Menu
var floatable=0;
var floatIterations=6;
var floatableX=1;
var floatableY=1;

//--- Movable Menu
var movable=0;
var moveWidth=12;
var moveHeight=20;
var moveColor="#DECA9A";
var moveImage="";
var moveCursor="move";
var smMovable=0;
var closeBtnW=15;
var closeBtnH=15;
var closeBtn="";

//--- Transitional Effects & Filters
var transparency="85";
var transition=11;
var transOptions="";
var transDuration=350;
var transDuration2=200;
var shadowLen=3;
var shadowColor="#B1B1B1";
var shadowTop=0;

//--- CSS Support (CSS-based Menu)
var cssStyle=0;
var cssSubmenu="";
var cssItem=["",""];
var cssItemText=["",""];

//--- Advanced
var dmObjectsCheck=0;
var saveNavigationPath=1;
var showByClick=0;
var noWrap=1;
var pathPrefix_img="/jscript/menu/images/vista2/";
var pathPrefix_link="";
var smShowPause=200;
var smHidePause=1000;
var smSmartScroll=1;
var smHideOnClick=1;
var dm_writeAll=1;

//--- AJAX-like Technology
var dmAJAX=0;
var dmAJAXCount=0;

//--- Dynamic Menu
var dynamic=0;

//--- Keystrokes Support
var keystrokes=0;
var dm_focus=1;
var dm_actKey=113;

var itemStyles = [
    ["itemWidth=92px","itemHeight=21px","itemBorderWidth=0","fontStyle=normal 11px Tahoma","fontColor=#FFFFFF,#000000","itemBackImage=btn_green.gif,btn_yellow.gif"],
];
var menuStyles = [
    ["menuBackColor=solid","menuBorderWidth=0","itemSpacing=1","itemPadding=0px 5px 0px 5px"],
];

var menuItems = [

    ["IWebBiz Home","http://www.iwebbiz.com.au", , , , , "0", "0", , ],
    ["Products","", , , , , "0", , , ],
        ["|Web Design","http://www.iwebbiz.com.au/site/Website-Development-Design-promotion/Crafting-Websites/", , , , , , , , ],
       
        ["|Application Programming","http://www.iwebbiz.com.au/site/application-design-development-programming/Dot-Net/", , , , , , , , ],
        ["|Website Marketing Promotion","http://www.iwebbiz.com.au/site/search-engine-optimization/website-promotion/", , , , , , , , ],
        
    ["Web Services","", , , , , "0", , , ],
        ["|Affiliate Marketing","http://www.partnerspro.biz", , , , , , , , ],
        ["|SMS Email Marketing","http://www.smsmailpro.com/", , , , , , , , ],
	["Developers","", , , , , "0", , , ],
        ["|PHP Development","http://www.developing-php.com/", , , , , , , , ],
        ["|Dot Net Development","http://www.smsmailpro.com/", , , , , , , , ],
        
    ["Contact Us","http://iwebbiz.com.au/site/main/contact-us/", , , , , "0", , , ],
];

dm_init();