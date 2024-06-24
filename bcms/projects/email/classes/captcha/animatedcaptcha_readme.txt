Animated Captcha version 1.0

This script uses GIFEncoder class by László Zsidi, http://gifs.hu

Animated Captcha is written by Dicky Kurniawan (xrvel)
http://www.tracenic.com
http://www.tugasku.com

Last update :
		November, 7th, 2007.

=====================================

User Guide :

1. Ensure that your PHP supports GD.

====== File & Directory Related

2. Ensure that temporary directory
   ("/animatedcaptcha_temp/", can be modified later by changing "temp_dir" attribute)
   exists at the same level with "animatedcaptcha.class.php"

3. Do not forget to CHMOD your temporary directory to 777, because we will write and unlink
   some files there every time an image is generated.

4. Ensure that directory "/animatedcaptcha_fonts/"
   exists at the same level with "animatedcaptcha.class.php"
   and you place at least 1 True Type Font file (*.ttf) there.

====== Script Related

5. Always call "validate()" function before output is sent to client.

6. Magic words and session name settings between 
	image-generating page
		and
	image-validating form (main page)
   must be equal before you call "validate()" function.