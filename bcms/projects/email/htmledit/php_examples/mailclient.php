<?php
    # File:             example6_eng.php
    # Programmer:       John Wong
    # Description:      Demonstrates how to use QWebEditor to send HTML email.
    #                   This example uses the htmlMimeMail class from http://www.phpguru.org.
    #                   It assumes you installed QWebEditor to /htmledit of your web server
    #                   document root directory.
    # History:
    #    20031208JW
    #        - Updated to use newer PHP interface.
    #        - Added code to extract text content (stripped HTML) from editor. The text content
    #        is used as text portion of email. JavaScript code is added to retrieve editor
    #        content in run time.
    #        - Added code to determine whether submitted data is from editor, or from replaced
    #        textarea box if client does not support QWebEditor.
    #   20030922JW
    #       Initial version
    #
    # Copyright (c) Q-Surf Computing Solutions, 2003

    require_once("../htmledit.php");
    require_once("htmlMimeMail.php");

    if (isset($_POST['mysubmit']))
    {
        if ($_POST['recipientemail'] && $_POST['mailcontent'])
        {
            /*
            # keep track of script usage
            # just want to prohibit spammer from using the script to send emails
            $logfile = "/tmp/mailform.log";
            $usagefile = "/tmp/mailform_usage.log";
            $maxuse = 50;

            $fh = @fopen($usagefile, 'rt');
            if ($fh)
            {
                while ($line = fgets($fh, 1024)) $arrUsage[trim($line)] ++;
            }
            if ($arrUsage[$_SERVER['REMOTE_ADDR']] >= $maxuse)
            {
                $msg = "You cannot use this script too frequently.<br />";
            }
            else
            */
            {
                $mail = new htmlMimeMail();
                $mail->setTextCharset('utf-8');
                $mail->setHtmlCharset('utf-8');
                $mail->setHeadCharset('utf-8');
                # this variable is set if QWebEditor is created properly.
                if ($_POST['mailcontent_bHtmlEdit'])
                    $mail->setHtml($_POST['mailcontent'], $_POST['mailtext']);
                else
                    $mail->setText($_POST['mailcontent']);
                $mail->setFrom("\"info@qwebeditor.com\" <info@qwebeditor.com>");
                $mail->setSubject("($_SERVER[REMOTE_ADDR] sent this mail) " . $_POST['subject']);
                $mail->send(array($_POST['recipientemail']), 'mail');

                $msg = "Mail has been sent.";
            }
        }
        else
        {
            $msg = "Please fill in all fields.";
        }
    }
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
<link type="text/css" href="../style.css" rel="stylesheet" />
<?php
    HtmlEditInit2("/htmledit/");
?>
</head>
<body bgcolor=white>
<?php
    if (isset($msg) && $msg) echo "<p><font color=red><b>$msg</b></font></p>";
?>
<p>This example demonstrates a practical usage of QWebEditor as a simple mail client.
It uses the free htmlMimeMail class (available from <a href="http://www.phpguru.org/mime.mail.html">www.phpguru.org</a>)
to send the HTML email.
</p><div id="helperdiv" style="display: none; visibility: hidden; height: 1px"></div>
<table cellpadding=1 cellspacing=0 width=100% bgcolor=black border=0>
<tr><td><table cellpadding=4 cellspacing=0 width=100% style="background-color:threedface;"  border=0>
<form name="myform" action="mailclient.php" method="post"
onsubmit="javascript:
    // Is Editor available?
    if (document.getElementById('qwebeditorID'))
    {
        document.getElementById('helperdiv').innerHTML = HtmlEditGetContent('qwebeditorID');
        this.mailtext.value = GetInnerTextById('helperdiv');
    }
    return true;
"><input type=hidden name=mailtext value="" />
<tr><td colspan=2><input type=submit name=mysubmit value="Send Now!" /></td></tr>
<tr><td width=20%>Recipient Email</td><td width=80%><input type=text name=recipientemail style="width: 100%;" /></td></tr>
<tr><td width=20%>Subject</td><td width=80%><input type=text name=subject style="width: 100%;" /></td></tr>
<tr><td colspan=2><?php
    $html = new CQWebEditor;
    $html->SetCtrlName('qwebeditorID');               // Set the control name and it is used to access
                                                      // the control in JavaScript. (optional)
    $html->SetElementName('mailcontent');             // Setting element name attribute (required)
    $html->SetHeight('250px');
	$html->SetClassName('simple');
	$html->SetEditorCssFile('../style.css');
    $html->CreateControl();							// Creating the QWebEditor control
?></td></tr></form></table></td></tr></table>
</html>
