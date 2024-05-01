<?php
    //print_r();
    //$text_data['debug'][]=var_export($domain_data,true);
    if($domain_data["dcmshost"]==""){
        
    
?>
Welcome to the Bubble CMS Install Script.<br>
You are executing this script from:- <br><br> <?php
	print $_POST['server_guid'];
?><br><br>
Downloaded Bubble CMS Distributed Install Zip.<br><br>
<?php print $app_data['asset-sever']; ?>downloads/Latest-BCMS_Distributed.zip<br><br>
<a href="/install.php?uri=<?php
	print urlencode('/step-2/');
?>">Unzip Install File</a>
<br><br>
{{message}}

<?php
    }else{
        include($app_data['MODULEBASEDIR']."install/step-1-dcms.php");
    }
        
    
?>