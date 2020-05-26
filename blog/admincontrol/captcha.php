<?php
session_start();
header('Content-type: image/jpeg');


$kod = substr(md5(mt_rand(0,9999999)),0,4);

$_SESSION["guvenlik"] = $kod;

$resim = imagecreate(90,35);
$arkaplan = imagecolorallocate($resim,254,210,101);
$beyazRenk = imagecolorallocate($resim,54,54,54);

imagestring($resim,25,18,13, $kod, $beyazRenk );

imagejpeg($resim,NULL,100);

imagedestroy($resim);