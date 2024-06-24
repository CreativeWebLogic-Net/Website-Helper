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
<body>
<p>You have entered the following text:</p>
<div style="border-style: solid; border-width: 1px; border-color: black; padding: 4px 4px 4px 4px;">
<?php
    echo $HTTP_POST_VARS['myelement'];
?>
</div>
</body>
</html>
