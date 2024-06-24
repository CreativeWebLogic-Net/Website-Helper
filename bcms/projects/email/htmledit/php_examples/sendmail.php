<?php
    # Copyright (c) Q-Surf Computing Solutions, 2003

    require_once("htmlMimeMail.php");

    $mail = new htmlMimeMail();
    $mail->setTextCharset('utf-8');
    $mail->setHtmlCharset('utf-8');
    $mail->setHeadCharset('utf-8');

    #this variable is set if QWebEditor is created properly.
    if ($_POST['mailcontent_bHtmlEdit'])
        $mail->setHtml($_POST['mailcontent'], $_POST['mailtext']);
    else
        $mail->setText($_POST['mailcontent']);
    $mail->setFrom("\"info@qwebeditor.com\" <info@qwebeditor.com>");
    $mail->setSubject("($_SERVER[REMOTE_ADDR] sent this mail) " . $_POST['subject']);
    $mail->send(array($_POST['recipientemail']), 'mail');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!-- use transitional doctype if possible. IE and Mozilla may not render correctly for strict doctype -->
<html>
<head>
<title>Example 6</title>

<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<!--
    provided language resources are all utf-8 encoded. you can use other encoding but you must provide
    your own language resources or use the default english resources.
-->

<style type="text/css">
<!--
body, td, th, p {font-family: tahoma, arial, sans-serif; font-size: 10pt;}
-->
</style>
</head>
<body bgcolor=white>
<p>Mail sent</p>
</html>
