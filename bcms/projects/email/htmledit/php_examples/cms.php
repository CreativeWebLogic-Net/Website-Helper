<?php
	require_once("cmsconfig.php");

    header("pragma: no-cache");

    // avoid users change anything outside allowed directory
    $filename = isset($_POST['filename']) ? $_POST['filename'] : (isset($_GET['filename']) ? $_GET['filename'] : "");
    $filename = str_replace("../", "", $filename);

    if (isset($_POST['addpage']) && $filename)
    {
        touch($path.$filename);
        header("location: cms.php?time=".time());
        exit;
    }
    else if (isset($_GET['deletepage']) && $filename)
    {
        unlink($path.$filename);
        header("location: cms.php?time=".time());
        exit;
    }
?><html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8" />
<title>Simple CMS</title>
<link type="text/css" href="../style.css" rel="stylesheet" />
</head>
<body>
<div class="cmstitle">SimpleCMS</div>

<fieldset class="boxstyle">
<legend>New File</legend>
<form action="cms.php" method="post" style="margin: 10px;">
File Name: <input type="text" name="filename" /><input type="submit" name="addpage" value="Create" />
</form>
</fieldset><br />

<table border=1 cellspacing=0 cellpadding=2 width=770 align=center>
<tr>
	<th class="tablecaption" width=80%>File Name</th>
	<th class="tablecaption" width=20%>Actions</th>
</tr>
<?php
    $num = 0;
    $dh = opendir($path);
    if ($dh)
    {
        while (($file = readdir($dh)) !== false)
        {
            if ($file != "." && $file != ".." && !is_dir($path.$file))
            {
                echo "<tr>";
                echo "<td class=tablebody><a href=\"$path$file\">$file</a></td>";
                echo "<td align=center class=tablebody><a href=\"cmsedit.php?filename=$file\">Edit</a> ";
                echo "<a href=\"cms.php?deletepage=1&filename=$file\" onclick=\"javascript: return confirm('Are you sure to delete this file?')\">Delete</a></td>";
                echo "</tr>";
                $num ++;
            }
        }
        closedir($dh);
    }
?>
</table>
<table width=770 border=0 align=center><tr><td>
<?php echo $num . " file(s) found"; ?>
</td></tr></table>
</body>
</html>
