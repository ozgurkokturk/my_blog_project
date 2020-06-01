<?php

if (isset($_POST["limit"])){
    setcookie("gosterLimit", $_POST["limit"]);
}

if(!isset($_COOKIE["gosterLimit"])){
    $gosterilecekAdet = 5;
}
else{
    $gosterilecekAdet = $_COOKIE["gosterLimit"];
}

$toplamSatir = rowCount($db,$_SESSION["id"]);
$toplamSatirSayisi = $toplamSatir->sayi;
$paginationCount = ceil($toplamSatirSayisi / $gosterilecekAdet);



//başlangıç limitini belirlemek için
if (isset($_GET["sayfa"])){
    $pageNo =  $_GET["sayfa"];
}else{
    $pageNo = 1;
}

if($pageNo < 1) $pageNo = 1;
if($pageNo > $paginationCount) $pageNo = $paginationCount;

$offset = ($pageNo - 1) * $gosterilecekAdet;

// Devamı anasayfada...


// siralama işlemini de kontrol edelim burada ek sayfa açmaya gerek yok
if(isset($_GET["order"])) {
    if ($_GET["order"] == "asc") {
        $siralama = "asc";
    }
    else if($_GET["order"] == "desc"){
        $siralama = "desc";
    }
    else{
        $siralama = "normal";
    }
}else{
    $siralama = "normal";
}

// arama bölümü
if(isset($_GET["search"])){
    $arama = htmlspecialchars(trim($_GET["search"]));
}else{
    $arama = "yok";
}