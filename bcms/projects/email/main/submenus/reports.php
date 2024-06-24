<?php
	include("submenuheader.php");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../css/cssmain.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="menu">
        <div id="menu-title">Make Your Selection </div>

        <div id="menu-items">
            <?php 
				if($p->CheckCode(8)){
			?>
			<a href="/main/reports/index.php" target="mainFrame">Logs</a>
            
			<a href="/main/reports/modify.php" target="mainFrame">Un-Received Emails </a>
            <?
				};	
			?>
			<?php if($_SESSION['SU']){ ?>
			<a href="/main/payments/paypal-log.php" target="mainFrame">PayPal Logs </a>
			<?
				};	
			?>
			        </div>

        <div id="menu-title">Help Options</div>

        <div id="menu-items">
            <a href="/forum/viewforum.php?f=4" target="mainFrame">Help</a>
            <a href="../help/index.php" target="mainFrame">Lodge Support Ticket</a>
            <a href="/forum/viewforum.php?f=5" target="mainFrame">Frequently Asked Questions</a>        </div>
</div>
</body>
</html>
