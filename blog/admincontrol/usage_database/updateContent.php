<?php
/*
 * Yeni Yazı Ekleme
 */
if (!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION["kadi"])){
    echo "Session Sorunu <br> Çıkartılıyorsun..";
    header("refresh:2;url=../index.php");
}else {
    require "../model/database.php";
    global $db;

//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";

    if (isset($_POST["contentId"]) && isset($_POST["selectCategory"]) && isset($_POST["titleContent"]) && isset($_POST["textareaContent"]) && isset($_POST["labelsContent"]) && isset($_POST["dateContent"]) && isset($_POST["radioContent"])) {
        $contentId = htmlspecialchars(trim($_POST["contentId"]));
        $titleContent = htmlspecialchars(trim($_POST["titleContent"]));
        $textareaContent = htmlspecialchars(trim($_POST["textareaContent"]));
        $dateContent = htmlspecialchars(trim($_POST["dateContent"]));
        $labelsContent = htmlspecialchars(trim($_POST["labelsContent"]));
        $radioContent = htmlspecialchars(trim($_POST["radioContent"]));
        $selectCategory = htmlspecialchars(trim($_POST["selectCategory"]));

        $query = "UPDATE blog_content SET title = :title, text = :text, tarih = :tarih, labels = :labels, visibility = :visibility, category_id = :category_id where id = :id";
        $updateContent = $db->prepare($query);
        $values = array(
            "id" => $contentId,
            ":title" => $titleContent,
            ":text" => $textareaContent,
            ":tarih" => $dateContent,
            ":labels" => $labelsContent,
            ":visibility" => $radioContent,
            ":category_id" => $selectCategory
        );
        if ($updateContent->execute($values)){

            header("Location:../index.php");

//            echo "<br><br>GÜNCELLENDİ <br>";
//            echo $contentId ."<br>";
//            echo $titleContent ."<br>";
//            echo $textareaContent ."<br>";
//            echo $dateContent ."<br>";
//            echo $labelsContent ."<br>";
//            echo $radioContent ."<br>";
//            echo $selectCategory ."<br>";
        }else{
            echo "Karater Sınırlamasını geçmiş olabilirsin... Özellikle başlığın 100 karakteri geçmemesine dikkat et!";
            echo "<br> <a href='../index.php'>Ana Sayfaya Dönmek İçin Tıkla</a>";
        }


    }else{
        echo "girmedi";
    }

}