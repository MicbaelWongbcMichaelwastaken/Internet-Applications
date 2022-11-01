<?php
session_start();
header("Content-Type: image/png");
$im = imagecreatetruecolor(500,200);
 
//define colors
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$yellow = imagecolorallocate($im, 255, 255, 0);
$green = imagecolorallocate($im, 0, 255, 0);
$arrayC = array($white, $black, $yellow);

//define fonts
$font1 = "LaBelleAurore.ttf";
$font2 = "Xerox Sans Serif Narrow.ttf";
$font3 = "Xenotron.ttf";
$arrayF = array($font1, $font2, $font3);

//creating rectangle & border
imagefilledrectangle($im, 0, 0, 500, 200, $yellow);
imagefilledrectangle($im, 8, 8, 492, 192, $green);

//generating random numbers/letters and defining the captcha
$length = 1;
$alphanum = "234567898abcdejghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
$text1 = substr(str_shuffle($alphanum), 0, $length);
$text2 = substr(str_shuffle($alphanum), 0, $length);
$text3 = substr(str_shuffle($alphanum), 0, $length);
$text4 = substr(str_shuffle($alphanum), 0, $length);
$_SESSION["captcha"] = $text1.$text2.$text3.$text4;
$tID = "session id: ". session_id();
$cap = "captcha: ". $text1.$text2.$text3.$text4;

//displaying text w/ random y positions, colors, and fonts
imagettftext($im, 60, 0, 100, rand(100, 120), $arrayC[rand(0, count($arrayC)-1)], $arrayF[rand(0, count($arrayF)-1)], $text1);
imagettftext($im, 60, 20, 200, rand(100, 120), $arrayC[rand(0, count($arrayC)-1)], $arrayF[rand(0, count($arrayF)-1)], $text2);
imagettftext($im, 40, -40, 300, rand(100, 120), $arrayC[rand(0, count($arrayC)-1)], $arrayF[rand(0, count($arrayF)-1)], $text3);
imagettftext($im, 60, -20, 400, rand(100, 120), $arrayC[rand(0, count($arrayC)-1)], $arrayF[rand(0, count($arrayF)-1)], $text4);
imagettftext($im, 10, 0, 10, 175, $black, $font2, $tID);
imagettftext($im, 10, 0, 10, 190, $black, $font2, $cap);

//creating random lines
for($x = 0; $x <= rand(1, 5); $x++){
    imageline($im, rand(20, 480), rand(20, 170), rand(20, 480), rand(20, 170), $black);
    }

imagepng($im);
imagedestroy($im);

?>