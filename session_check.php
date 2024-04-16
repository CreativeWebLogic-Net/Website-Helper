<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dir='/home2/icwl0738/iCWLNet_Application_Code/ICWLNet_Full_Website_Builder/bcms/sessions/';
session_save_path($dir);
session_start();

// Check if the session variable 'count' is set
if (!isset($_SESSION['count'])) {
    // If not set, initialize it to 0
    $_SESSION['count'] = 0;
}

// Increment the session variable 'count'
$_SESSION['count']++;

// Display the updated count
echo "\n Hello Count: {$_SESSION['count']}";
?>