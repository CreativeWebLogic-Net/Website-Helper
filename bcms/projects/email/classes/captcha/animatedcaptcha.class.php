<?php
/*
 * Animated Captcha version 1.0
 *
 * This script uses GIFEncoder class by László Zsidi, http://gifs.hu
 *
 * Animated Captcha is written by Dicky Kurniawan (xrvel)
 * http://www.tracenic.com
 * http://www.tugasku.com
 *
 * Last update :
 *		November, 7th, 2007.
 */
class animated_captcha {

	var $secret;
	var $auto_lower;
	var $auto_upper;
	var $color;
	var $frame_delay;
	var $frame_number;
	var $font_array;
	var $font_dir;
	var $font_size;
	var $grid_density;
	var $magic_words;
	var $random_angle_factor;
	var $random_y_factor;
	var $randomize_grid;
	var $session_name;
	var $string_length;
	var $temp_dir;
	var $text_space;

	function animated_captcha() {
		$this->auto_lower=false;
		$this->auto_upper=true;
		$this->color=array();
		$this->color['background']=array('FFF1EA');
		$this->color['grid']=array('000000');
		$this->color['text']=array('000000');//#000000 =>black
		$this->font_array=array();
		$this->font_dir=dirname(__FILE__).'/animatedcaptcha_fonts/';
		$this->font_size=16;
		$this->frame_delay=80;
		$this->frame_number=3;
		$this->grid_density=10;
		$this->magic_words='';
		$this->random_angle_factor=10;
		$this->random_y_factor=3;//text y position variance
		$this->randomize_grid=true;
		$this->session_name='turing_string';
		$this->string_length=6;
		$this->temp_dir=dirname(__FILE__).'/animatedcaptcha_temp/';
		$this->text_space=10;
		srand((double)microtime()*1000000);
	}

	function background_color($ar) {
		if (!is_array($ar)) {
			@trigger_error('Argument for &quot;background_color()&quot; must be an array.',E_USER_ERROR);
		} else {
			$this->color['background']=$ar;
		}
	}

	function generate() {
		$this->no_cache();
		if (!headers_sent()) {
			header("Content-type: image/gif"); 
		} else {
			@trigger_error('generate() was called after headers already sent.',E_USER_ERROR);
		}
		$this->check();
		$image_string='';
		$image_string.=$this->microseconds();
		$image_string.=date('r');
		$image_string.=$_SERVER['REMOTE_ADDR'];
		$image_string.=$_SERVER['HTTP_X_FORWARDED_FOR'];
		$image_string=md5($image_string);
		$image_string=substr($image_string,1,$this->string_length);

		if ($this->auto_lower) {
			$image_string=strtolower($image_string);
		}
		if ($this->auto_upper) {
			$image_string=strtoupper($image_string);
		}
		session_start();
		$_SESSION[$this->session_name]=$this->string_crypt($image_string);
		$filename=array();
		$frame_delays=array();
		// Define random color, which
		// constant for each letter in each frame
		$ar_char_color=array();
		$max=count($this->color['text']);
		for ($i=0;$i<$this->string_length;$i++) {
			$index=rand(0,$max-1);
			$ar_char_color[]=$this->getRGBCode($this->color['text'][$index]);
		}
		// Random background color
		$ar_grid_color=array();
		$max=count($this->color['background']);
		$index=rand(0,$max-1);
		$ar_background_color[]=$this->getRGBCode($this->color['background'][$index]);
		// Random grid color
		$ar_grid_color=array();
		$max=count($this->color['grid']);
		$index=rand(0,$max-1);
		$ar_grid_color[]=$this->getRGBCode($this->color['grid'][$index]);
		for ($frame_count=1;$frame_count<=$this->frame_number;$frame_count++) {
			// Generate an image for each frame
			$random_font=$this->random_font();
			if ($random_font) {
				$x=(@imagefontwidth($random_font)+4+$this->text_space)*($this->string_length);
				$height=(int)(@imagefontheight($random_font)*$this->font_size/4)+($this->random_y_factor*2);
			} else {
				$x=(imagefontwidth($this->font_size)+$this->text_space)*$this->string_length;
				$height=@imagefontheight($this->font_size)+10+($this->random_y_factor*2);
			}
			$width=$x+20;
			$image=imagecreate($width,$height);
			$border_color=imagecolorallocate($image,0x00,0x00,0x00);
			$background_color=imagecolorallocate($image,$ar_background_color[0][0],$ar_background_color[0][1],$ar_background_color[0][2]);
			$grid_color=imagecolorallocate($image,$ar_grid_color[0][0],$ar_grid_color[0][1],$ar_grid_color[0][2]);
			imagefilledrectangle($image,0,0,$width,$height,$background_color);
			for ($i=0;$i<$this->grid_density;$i++) {
				if ($this->randomize_grid) {
					$i_factor=(rand(1,100)+microtime())%rand(2,100);
					$i_factor++;
					$i_factor2=(rand(1,100)+microtime())%rand(2,100);
					$i_factor2++;
				} else {
					$i_factor=3;
					$i_factor2=3;
				}
				imagesetthickness($image,rand(1,2));
				imageline($image,$i*($width/$i_factor),2,$i*($width/$i_factor2),$height,$grid_color);
			}
			for ($i=0;$i<5;$i++) {
				if ($this->randomize_grid) {
					$i_factor=(rand(1,100)+microtime())%rand(2,100);
					$i_factor++;
					$i_factor2=(rand(1,100)+microtime())%rand(2,100);
					$i_factor2++;
				} else {
					$i_factor=5;
					$i_factor2=5;
				}
				imageline($image,0,$i*($height/$i_factor),$width,$i*($height/$i_factor2),$grid_color);
			}
			if ($this->randomize_grid) {
				for ($i=0;$i<4;$i++) {
					imageline($image,0,$i*($height/3),$width,$i*($height/3),$grid_color);
				}
			}
			imagerectangle($image,0,0,$width-1,$height-1,$border_color);
			$x=sprintf("%d",($width-$x)/2);
			if ($random_font) {
				$y=($height-imagefontheight($random_font))/2;
			} else {
				$y=($height-imagefontheight($this->font_size))/2;
			}
			$offset_x=0;
			$x+=rand(0,2);
			for ($i=0;$i<$this->string_length;$i++) {
				$char=substr($image_string,$i,1);
				$x2=$x+$offset_x-1+rand(0,1);
				$y2=$y-$this->random_y_factor+rand(0,($this->random_y_factor*2));
				$y2=$y+10;
				$foreground_color=@imagecolorallocate($image,$ar_char_color[$i][0],$ar_char_color[$i][1],$ar_char_color[$i][2]);
				if ($random_font) {
					@imagettftext($image,$this->font_size,$this->random_angle(),$x2,$y2,$foreground_color,$this->random_font(),$char);
					$offset_x+=(imagefontwidth($random_font)*$this->font_size/8)+$this->text_space;
				} else {
					@imagestring($image,$this->font_size,$x2,$y2,$char,$foreground_color);
					$offset_x+=imagefontwidth($this->font_size)+$this->text_space;
				}
			}
			$rand_filename=$this->temp_dir.md5(microtime().getenv('REMOTE_ADDR')).rand(1,999).'.txt';
			$fp=fopen($rand_filename,'w+');
			if ($fp) {
				flock($fp,2);
				fwrite($fp,'');
				flock($fp,3);
				fclose($fp);
				imagegif($image,$rand_filename);
				imagedestroy($image);
				array_push($filename,$rand_filename);
				array_push($frame_delays,$this->frame_delay);
			}
		}
		if (count($filename)>0) {
			$angif=new GIFEncoder($filename,$frame_delays,0,2,0,0,0,'url');
			echo($angif->GetAnimation());
			//Remove temp file(s)
			foreach ($filename as $s) {
				@unlink($s);
			}
		}
	}

	function font_size($i) {
		$this->font_size=intval($i);
	}

	function grid_color($ar) {
		if (!is_array($ar)) {
			@trigger_error('Argument for &quot;grid_color()&quot; must be an array.',E_USER_ERROR);
		} else {
			$this->color['grid']=$ar;
		}
	}

	function grid_density($i) {
		$this->grid_density=intval($i);
	}

	function magic_words($s) {
		$this->magic_words=trim($s);
	}

	function random_y_factor($i) {
		$this->random_y_factor=intval($i);
	}

	function randomize_grid($b=true) {
		$this->randomize_grid=$b;
	}

	function string_length($i) {
		$i=intval($i);
		$this->string_length=$i;
	}

	function text_color($ar) {
		if (!is_array($ar)) {
			@trigger_error('Argument for &quot;text_color()&quot; must be an array.',E_USER_ERROR);
		} else {
			$this->color['text']=$ar;
		}
	}

	function text_space($i) {
		$this->text_space=intval($i);
	}

	function validate($image_string='') {
		
		if (headers_sent()) {
			print "xxx";
			@trigger_error('validate() was called after headers already sent.',E_USER_ERROR);
			return(false);
			
		} else {
			if ($this->auto_lower) {
				$image_string=strtolower($image_string);
			}
			if ($this->auto_upper) {
				$image_string=strtoupper($image_string);
			}
			session_start();
			$session_string=strtoupper($_SESSION[$this->session_name]);
			$comparison=$this->string_crypt($image_string);
			return($session_string==$comparison);
		}
	}

	/*
	 * Private methods
	 */
	function check() {
		if ($this->session_name=='') {
			$this->session_name='turing_image';
		}
		$this->grid_density=intval($this->grid_density);
		$this->string_length=intval($this->string_length);
		if ($this->string_length<3) {
			$this->string_length=3;
		} else if ($this->string_length>20) {
			$this->string_length=20;
		}
		if ($this->text_space<1) {
			$this->text_space=1;
		}
		if (!is_dir($this->temp_dir)) {
			@trigger_error($this->temp_dir.' is not a directory.',E_USER_ERROR);
		} else if (!preg_match('/(\\\\|\/)+$/',$this->temp_dir)) {
			$this->temp_dir.='/';
		}
		if (!is_dir($this->font_dir)) {
			@trigger_error($this->font_dir.' is not a directory.',E_USER_ERROR);
		} else {
			$dir=opendir($this->font_dir);
			if ($dir) {
				while ($file=readdir($dir)) {
					if (preg_match("/\.ttf+$/i",$file)) {
						array_push($this->font_array,$this->font_dir.$file);
					}
				}
				closedir($dir);
			}
		}
	}

	function getRGBCode($s) {
		$rgbArr=array();
		$s=str_replace('#','',$s);
		if (strlen($s)==6) {
			$rgbArr[]=hexdec(substr($s,0,2));
			$rgbArr[]=hexdec(substr($s,2,2));
			$rgbArr[]=hexdec(substr($s,4,2));
		}
		return $rgbArr;
	}


	function microseconds() {
		return(substr(microtime(),2,8));
	}

	function no_cache() {
		if (!headers_sent()) {
			header('Cache-Control: private, no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Last-Modified: '.gmdate('D, d M Y H:i:s',time()-60).' GMT');
			header('Pragma: no-cache');
		}
	}

	function random_angle() {
		$i=$this->random_angle_factor-rand(0,($this->random_angle_factor*2));
		return($i);
	}

	function random_font() {
		if (count($this->font_array)>0) {
			$i=rand(0,count($this->font_array)-1);
			$s=$this->font_array[$i];
			//echo($s);
			return($s);
		} else {
			return(false);
		}
	}

	function string_crypt($string) {
		$string.=$_SERVER['REMOTE_ADDR'];
		$string.=$_SERVER['HTTP_X_FORWARDED_FOR'];
		$string.=$this->magic_words;
		$string=strtoupper(md5($string));
		return($string);
	}
}
/*
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::
::	GIFEncoder Version 2.0 by László Zsidi, http://gifs.hu
::
::	This class is a rewritten 'GifMerge.class.php' version.
::
::  Modification:
::   - Simplified and easy code,
::   - Ultra fast encoding,
::   - Built-in errors,
::   - Stable working
::
::
::	Updated at 2007. 02. 13. '00.05.AM'
::
::
::
::  Try on-line GIFBuilder Form demo based on GIFEncoder.
::
::  http://gifs.hu/phpclasses/demos/GifBuilder/
::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/
Class GIFEncoder {
	var $GIF = "GIF89a";		/* GIF header 6 bytes	*/
	var $VER = "GIFEncoder V2.05";	/* Encoder version		*/

	var $BUF = Array ( );
	var $LOP =  0;
	var $DIS =  2;
	var $COL = -1;
	var $IMG = -1;

	var $ERR = Array (
		ERR00=>"Does not supported function for only one image!",
		ERR01=>"Source is not a GIF image!",
		ERR02=>"Unintelligible flag ",
		ERR03=>"Does not make animation from animated GIF source",
	);

	/*
	:::::::::::::::::::::::::::::::::::::::::::::::::::
	::
	::	GIFEncoder...
	::
	*/
	function GIFEncoder	(
							$GIF_src, $GIF_dly, $GIF_lop, $GIF_dis,
							$GIF_red, $GIF_grn, $GIF_blu, $GIF_mod
						) {
		if ( ! is_array ( $GIF_src ) && ! is_array ( $GIF_tim ) ) {
			printf	( "%s: %s", $this->VER, $this->ERR [ 'ERR00' ] );
			exit	( 0 );
		}
		$this->LOP = ( $GIF_lop > -1 ) ? $GIF_lop : 0;
		$this->DIS = ( $GIF_dis > -1 ) ? ( ( $GIF_dis < 3 ) ? $GIF_dis : 3 ) : 2;
		$this->COL = ( $GIF_red > -1 && $GIF_grn > -1 && $GIF_blu > -1 ) ?
						( $GIF_red | ( $GIF_grn << 8 ) | ( $GIF_blu << 16 ) ) : -1;

		for ( $i = 0; $i < count ( $GIF_src ); $i++ ) {
			if ( strToLower ( $GIF_mod ) == "url" ) {
				$this->BUF [ ] = fread ( fopen ( $GIF_src [ $i ], "rb" ), filesize ( $GIF_src [ $i ] ) );
			}
			else if ( strToLower ( $GIF_mod ) == "bin" ) {
				$this->BUF [ ] = $GIF_src [ $i ];
			}
			else {
				printf	( "%s: %s ( %s )!", $this->VER, $this->ERR [ 'ERR02' ], $GIF_mod );
				exit	( 0 );
			}
			if ( substr ( $this->BUF [ $i ], 0, 6 ) != "GIF87a" && substr ( $this->BUF [ $i ], 0, 6 ) != "GIF89a" ) {
				printf	( "%s: %d %s", $this->VER, $i, $this->ERR [ 'ERR01' ] );
				exit	( 0 );
			}
			for ( $j = ( 13 + 3 * ( 2 << ( ord ( $this->BUF [ $i ] { 10 } ) & 0x07 ) ) ), $k = TRUE; $k; $j++ ) {
				switch ( $this->BUF [ $i ] { $j } ) {
					case "!":
						if ( ( substr ( $this->BUF [ $i ], ( $j + 3 ), 8 ) ) == "NETSCAPE" ) {
							printf	( "%s: %s ( %s source )!", $this->VER, $this->ERR [ 'ERR03' ], ( $i + 1 ) );
							exit	( 0 );
						}
						break;
					case ";":
						$k = FALSE;
						break;
				}
			}
		}
		GIFEncoder::GIFAddHeader ( );
		for ( $i = 0; $i < count ( $this->BUF ); $i++ ) {
			GIFEncoder::GIFAddFrames ( $i, $GIF_dly [ $i ] );
		}
		GIFEncoder::GIFAddFooter ( );
	}
	/*
	:::::::::::::::::::::::::::::::::::::::::::::::::::
	::
	::	GIFAddHeader...
	::
	*/
	function GIFAddHeader ( ) {
		$cmap = 0;

		if ( ord ( $this->BUF [ 0 ] { 10 } ) & 0x80 ) {
			$cmap = 3 * ( 2 << ( ord ( $this->BUF [ 0 ] { 10 } ) & 0x07 ) );

			$this->GIF .= substr ( $this->BUF [ 0 ], 6, 7		);
			$this->GIF .= substr ( $this->BUF [ 0 ], 13, $cmap	);
			$this->GIF .= "!\377\13NETSCAPE2.0\3\1" . GIFEncoder::GIFWord ( $this->LOP ) . "\0";
		}
	}
	/*
	:::::::::::::::::::::::::::::::::::::::::::::::::::
	::
	::	GIFAddFrames...
	::
	*/
	function GIFAddFrames ( $i, $d ) {

		$Locals_str = 13 + 3 * ( 2 << ( ord ( $this->BUF [ $i ] { 10 } ) & 0x07 ) );

		$Locals_end = strlen ( $this->BUF [ $i ] ) - $Locals_str - 1;
		$Locals_tmp = substr ( $this->BUF [ $i ], $Locals_str, $Locals_end );

		$Global_len = 2 << ( ord ( $this->BUF [ 0  ] { 10 } ) & 0x07 );
		$Locals_len = 2 << ( ord ( $this->BUF [ $i ] { 10 } ) & 0x07 );

		$Global_rgb = substr ( $this->BUF [ 0  ], 13,
							3 * ( 2 << ( ord ( $this->BUF [ 0  ] { 10 } ) & 0x07 ) ) );
		$Locals_rgb = substr ( $this->BUF [ $i ], 13,
							3 * ( 2 << ( ord ( $this->BUF [ $i ] { 10 } ) & 0x07 ) ) );

		$Locals_ext = "!\xF9\x04" . chr ( ( $this->DIS << 2 ) + 0 ) .
						chr ( ( $d >> 0 ) & 0xFF ) . chr ( ( $d >> 8 ) & 0xFF ) . "\x0\x0";

		if ( $this->COL > -1 && ord ( $this->BUF [ $i ] { 10 } ) & 0x80 ) {
			for ( $j = 0; $j < ( 2 << ( ord ( $this->BUF [ $i ] { 10 } ) & 0x07 ) ); $j++ ) {
				if	(
						ord ( $Locals_rgb { 3 * $j + 0 } ) == ( ( $this->COL >> 16 ) & 0xFF ) &&
						ord ( $Locals_rgb { 3 * $j + 1 } ) == ( ( $this->COL >>  8 ) & 0xFF ) &&
						ord ( $Locals_rgb { 3 * $j + 2 } ) == ( ( $this->COL >>  0 ) & 0xFF )
					) {
					$Locals_ext = "!\xF9\x04" . chr ( ( $this->DIS << 2 ) + 1 ) .
									chr ( ( $d >> 0 ) & 0xFF ) . chr ( ( $d >> 8 ) & 0xFF ) . chr ( $j ) . "\x0";
					break;
				}
			}
		}
		switch ( $Locals_tmp { 0 } ) {
			case "!":
				$Locals_img = substr ( $Locals_tmp, 8, 10 );
				$Locals_tmp = substr ( $Locals_tmp, 18, strlen ( $Locals_tmp ) - 18 );
				break;
			case ",":
				$Locals_img = substr ( $Locals_tmp, 0, 10 );
				$Locals_tmp = substr ( $Locals_tmp, 10, strlen ( $Locals_tmp ) - 10 );
				break;
		}
		if ( ord ( $this->BUF [ $i ] { 10 } ) & 0x80 && $this->IMG > -1 ) {
			if ( $Global_len == $Locals_len ) {
				if ( GIFEncoder::GIFBlockCompare ( $Global_rgb, $Locals_rgb, $Global_len ) ) {
					$this->GIF .= ( $Locals_ext . $Locals_img . $Locals_tmp );
				}
				else {
					$byte  = ord ( $Locals_img { 9 } );
					$byte |= 0x80;
					$byte &= 0xF8;
					$byte |= ( ord ( $this->BUF [ 0 ] { 10 } ) & 0x07 );
					$Locals_img { 9 } = chr ( $byte );
					$this->GIF .= ( $Locals_ext . $Locals_img . $Locals_rgb . $Locals_tmp );
				}
			}
			else {
				$byte  = ord ( $Locals_img { 9 } );
				$byte |= 0x80;
				$byte &= 0xF8;
				$byte |= ( ord ( $this->BUF [ $i ] { 10 } ) & 0x07 );
				$Locals_img { 9 } = chr ( $byte );
				$this->GIF .= ( $Locals_ext . $Locals_img . $Locals_rgb . $Locals_tmp );
			}
		}
		else {
			$this->GIF .= ( $Locals_ext . $Locals_img . $Locals_tmp );
		}
		$this->IMG  = 1;
	}
	/*
	:::::::::::::::::::::::::::::::::::::::::::::::::::
	::
	::	GIFAddFooter...
	::
	*/
	function GIFAddFooter ( ) {
		$this->GIF .= ";";
	}
	/*
	:::::::::::::::::::::::::::::::::::::::::::::::::::
	::
	::	GIFBlockCompare...
	::
	*/
	function GIFBlockCompare ( $GlobalBlock, $LocalBlock, $Len ) {

		for ( $i = 0; $i < $Len; $i++ ) {
			if	(
					$GlobalBlock { 3 * $i + 0 } != $LocalBlock { 3 * $i + 0 } ||
					$GlobalBlock { 3 * $i + 1 } != $LocalBlock { 3 * $i + 1 } ||
					$GlobalBlock { 3 * $i + 2 } != $LocalBlock { 3 * $i + 2 }
				) {
					return ( 0 );
			}
		}

		return ( 1 );
	}
	/*
	:::::::::::::::::::::::::::::::::::::::::::::::::::
	::
	::	GIFWord...
	::
	*/
	function GIFWord ( $int ) {

		return ( chr ( $int & 0xFF ) . chr ( ( $int >> 8 ) & 0xFF ) );
	}
	/*
	:::::::::::::::::::::::::::::::::::::::::::::::::::
	::
	::	GetAnimation...
	::
	*/
	function GetAnimation ( ) {
		return ( $this->GIF );
	}
}
?>