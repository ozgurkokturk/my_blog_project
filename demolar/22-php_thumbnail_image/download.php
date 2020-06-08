<?php



// Fotoğrafı indir
if(isset($_GET["dosyaadi"],$_GET["extension"])){
    $dosyaAdi = htmlspecialchars($_GET["dosyaadi"]);
    $extension = htmlspecialchars($_GET["extension"]);
    $fullname = $dosyaAdi. ".".$extension;

    if ($extension == "jpeg" || $extension == "jpg" ){
        header("Content-type: image/jpeg");
        header("Content-disposition: attachment; filename={$fullname}");
        readfile("dosyalar/".$fullname);

    }
}

// indirdikten sonra sil
/*
 * Not: header ile delete sayfasına yönlendirince olmuyor
 */
include_once "deleteAll.php";