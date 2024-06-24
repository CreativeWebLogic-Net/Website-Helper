<?php
require_once(dirname(__FILE__).'/animatedcaptcha.class.php');

$user_guess='';
if (isset($_POST['user_guess'])) {
	$user_guess=$_POST['user_guess'];
}

$img=new animated_captcha();
$img->session_name='my_turing_test';
$img->magic_words('i am cool');

$valid=$img->validate($user_guess);
?>
<html>
<head><title>Animated Captcha Test</title></head>
<body>
<img alt="animated captcha" src="../catcha/animatedcaptcha_generate.php?i=<?php echo(md5(microtime()));?>" />
<form method="post">
Image Text = <input type="text" name="user_guess" autocomplete="off" /><br />
<input type="submit" value="Check" />
</form>
<?php
if ($user_guess=='') {
	echo('<p>Fill the input !</p>');
} else if ($valid) {
	echo('<p>Correct. You are 100% human being !</p>');
} else {
	echo('<p>Invalid text. Are you a human ? Do you eat electricity ?</p>');
}
?>
</html>