<?php
if(empty($_GET['dev'])) {
    $ip = $_GET['ip'];
    if(empty($ip)) {
        $ip = shell_exec('netstat -rn | head -n 3 | tail -n 1 | cut -d " " -f 10');
        $ip = rtrim($ip, "\n");
    }
    $im = imagecreatefromjpeg("http://".$ip.":8080/stream.jpeg?".rand());
} else {
    $im = imagecreatefromjpeg("tesztkep_".$_GET['dev'].'.jpeg');
}
header('Content-type: image/jpeg');
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$x = 0;
$y = 0;
$height = imagesy($im); //772
$width = imagesx($im); //356
switch($_GET["part"]) {
    case "t":
        $y = floor($height/15); //50
        $height = floor($height/13); //60
        //$x = floor(10); //110
        //$width -= $x;
        break;
    case "ms":
        $x = floor($width/4.74); //75
        $width -= floor($width/2.37); //150
    case "m":
        $y = floor($height/2.57);//300
        $height -= ($y+(floor($height/11))); //y-70
        break;
    case "b":
        $x = floor($width/3.23); //110
        $y = $height - floor($height/13); //height - 60
        $height = floor($height/13); //60
        $width -= floor($width/1.69); //210
        break;
}
$im2 = imagecrop($im, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);
imagejpeg($im2, NULL, 20);
