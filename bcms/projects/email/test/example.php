<?php
   // PhpBarGraph Version 2.0
   // Bar Graph Generator Example for PHP
   // Written By TJ Hunter (tjhunter@ruistech.com)
   // Released Under the GNU Public License.
   // http://www.ruistech.com/phpBarGraph

   // Print out the header to tell the browser we\'re about to send them an image in GIF format.
   // If you\'re having problems, or just want PNG, UNcomment lines 10 and 68 and comment lines 11 and 69
   header("Content-type: image/jpeg");
   //header("Content-type: image/gif");

   // We need to be able to use the bar graph class in phpBarGraph2.php
   require("phpBarGraph2.php");

   // Setup how high and how wide the ouput image is
   $imageHeight = 300;
   $imageWidth = 400;

   // Create a new Image
   $image = imagecreate($imageWidth, $imageHeight);
   // Fill it with your favorite background color..
   $backgroundColor = imagecolorallocate($image, 50, 50, 50);
   imagefill($image, 0, 0, $backgroundColor);

   // Interlace the image..
   imageinterlace($image, 1);


   // Create a new BarGraph..
   $myBarGraph = new PhpBarGraph;
   $myBarGraph->SetX(10);              // Set the starting x position
   $myBarGraph->SetY(10);              // Set the starting y position
   $myBarGraph->SetWidth($imageWidth-20);    // Set how wide the bargraph will be
   $myBarGraph->SetHeight($imageHeight-20);  // Set how tall the bargraph will be
   $myBarGraph->SetNumOfValueTicks(8); // Set this to zero if you don\'t want to show any. These are the vertical bars to help see the values.
   
   
   // You can try uncommenting these lines below for different looks.
   
   // $myBarGraph->SetShowLabels(false);  // The default is true. Setting this to false will cause phpBarGraph to not print the labels of each bar.
   // $myBarGraph->SetShowValues(false);  // The default is true. Setting this to false will cause phpBarGraph to not print the values of each bar.
   // $myBarGraph->SetBarBorder(false);   // The default is true. Setting this to false will cause phpBarGraph to not print the border of each bar.
   // $myBarGraph->SetShowFade(false);    // The default is true. Setting this to false will cause phpBarGraph to not print each bar as a gradient.
   // $myBarGraph->SetShowOuterBox(false);   // The default is true. Setting this to false will cause phpBarGraph to not print the outside box.
   // $myBarGraph->SetBarSpacing(20);     // The default is 10. This changes the space inbetween each bar.

   // Add Values to the bargraph..
   $myBarGraph->AddValue("A",2);  // AddValue(string label, int value)
   $myBarGraph->AddValue("B",4);
   $myBarGraph->AddValue("C",8);
   $myBarGraph->AddValue("D",16);
   $myBarGraph->AddValue("E",32);
   $myBarGraph->AddValue("F",64);
   $myBarGraph->AddValue("G",128);

   // Set the colors of the bargraph..
   $myBarGraph->SetStartBarColor("0000ff");  // This is the color on the top of every bar.
   $myBarGraph->SetEndBarColor("A624A6");    // This is the color on the bottom of every bar. This is not used when SetShowFade() is set to false.
   $myBarGraph->SetLineColor("ffffff");      // This is the color all the lines and text are printed out with.

   // Print the BarGraph to the image..
   $myBarGraph->DrawBarGraph($image);

   // Output the Image to the browser in GIF (or PNG) format
   imagejpeg($image);
   //imagegif($image);
   // Destroy the image.
   imagedestroy($image);


?>