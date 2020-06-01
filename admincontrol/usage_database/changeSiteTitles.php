<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["kadi"])) {
    echo "Session Sorunu <br> Çıkartılıyorsun..";
    header("refresh:2;url=../index.php");
} else {

    require "../model/database.php";
    global $db;




    $title = htmlspecialchars(trim($_POST["title"]));
    $subtitle = htmlspecialchars(trim($_POST["subtitle"]));
//    echo $title . "<br>";
//    echo $subtitle;

    $query = "UPDATE blog_title SET home_title = ?, home_subtitle = ? where id = 1";
    $updateTitles = $db->prepare($query);

    if ($updateTitles->execute(array($title, $subtitle))){
        header("Location:../index.php");
    }
    else{
        echo "Başlıklar Güncellenemedi! <br>";
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']); // hangi sayfadan gelindigi degerini verir.
        echo "<a href='$url'>Önceki Sayfa İçin Tıkla...</a>"; //dugmeye o degeri atiyoruz.
        
    }


}