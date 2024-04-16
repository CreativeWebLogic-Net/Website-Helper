<?php 

// ./adminer-4-sqlite3.php

$_GET['sqlite'] = '';

function adminer_object() {

   require "./plugins/fc-sqlite-connection-without-credentials.php";
   require "./plugins/plugin.php";
  
   $plugins = array(new FCSqliteConnectionWithoutCredentials());
    
   return new AdminerPlugin($plugins);

}

require "./adminer-current.php";