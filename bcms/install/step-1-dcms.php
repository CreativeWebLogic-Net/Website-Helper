Welcome to the Bubble CMS Install Script.<br>
You are executing this script from:- <br><br> <?php
	print $_POST['server_guid'];
?><br><br>
Hello World

<?php
    $text_data['debug'][]="Hello World";
    
    include($app_data['MODULEBASEDIR']."member/login.php");
?>