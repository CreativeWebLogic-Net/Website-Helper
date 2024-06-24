<?php
require_once(dirname(__FILE__).'/animatedcaptcha.class.php');

$img=new animated_captcha();

// Session name to store key
$img->session_name='your_turing_test';

// Magic words, used in session encryption
// - optional
// - recommended to fill magic words
//   with your specific words
// - default is empty
$img->magic_words('expianlidocous cool');

// Background color
// Argument must be an array
// Can be used to randomize background color
$img->background_color(array('#FEFDCF','#DFFEFF','#FFEEE1','#E1F4FF'));

// Grid (line) color
// Argument must be an array
// Can be used to randomize grid color
$img->grid_color(array('#FAD1AD','#FFD9FB'));

// Text color
// Argument must be an array
// Can be used to randomize letter color
$img->text_color(array('#801D00','#5C0497','#0289B0'));

// Font size (optional)
$img->font_size(16);

// Grid density
// - optional
// - default is 10
$img->grid_density(10);

// Random letter Y factor.
// Set to high value to cause more Y-position variation
// for every letter.
$img->random_y_factor(4);

// String length
// - optional
// - default is 6
$img->string_length(6);

// Spacing between letters
// - optional
// - default is 10
$img->text_space(10);

// Number of image frames
// - optional
// - default is 3
// Using more frames, causes larger file size
$img->frame_number=3;

// Frame delay
// - optional
// - default is 80
// Small value means faster animation, 
// Higher value means slower animation.
$img->frame_delay=80;

// Required, to generate our image :-)
$img->generate();
?>