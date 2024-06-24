<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(14);
	
	include("../../functions.inc.php");
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script>
function SendReply(){
	window.parent.Return();
	alert("<?=$_SESSION['total']?>");
}
</script>
</head>
<body onLoad="SendReply()">
<script>
</script>
</body>
</html>