<?php
    function PlainTextToHtml($str)
    {
        $newstr = htmlspecialchars($str);
        $newstr = str_replace("\n", "<br />", $newstr);
        $newstr = str_replace("\t", " &nbsp; &nbsp;", $newstr);
        $newstr = str_replace("  ", " &nbsp;", $newstr);
        return $newstr;
    }
?>
<html>
<head>
<base href="http://www.qwebeditor.com" />
</head>
<body>
<p>You have entered the following text:</p>
<div style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<?php
    if ($HTTP_POST_VARS['pagecontent1_bHtmlEdit'])
        echo $HTTP_POST_VARS['pagecontent1'];
    else
        echo PlainTextToHtml($HTTP_POST_VARS['pagecontent1']);
?>
</div><br />
<div style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<?php
    if ($HTTP_POST_VARS['pagecontent2_bHtmlEdit'])
        echo $HTTP_POST_VARS['pagecontent2'];
    else
        echo PlainTextToHtml($HTTP_POST_VARS['pagecontent2']);
?>
</div><br />
<div style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<?php
    if ($HTTP_POST_VARS['pagecontent3_bHtmlEdit'])
        echo $HTTP_POST_VARS['pagecontent3'];
    else
        echo PlainTextToHtml($HTTP_POST_VARS['pagecontent3']);
?>
</div><br />
<div style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<?php
    if ($HTTP_POST_VARS['pagecontent4_bHtmlEdit'])
        echo $HTTP_POST_VARS['pagecontent4'];
    else
        echo PlainTextToHtml($HTTP_POST_VARS['pagecontent4']);
?>
</div><br />
<div style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<?php
    if ($HTTP_POST_VARS['pagecontent5_bHtmlEdit'])
        echo $HTTP_POST_VARS['pagecontent5'];
    else
        echo PlainTextToHtml($HTTP_POST_VARS['pagecontent5']);
?>
</div><br />
</body>
</html>
