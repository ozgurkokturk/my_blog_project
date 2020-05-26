<?php
/*
 * İstatistikler
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


    echo "<pre>";
    print_r($_POST);
    echo "</pre>";


    if (isset($_POST["dateStart"],$_POST["dateFinish"], $_POST["pageLimit"]) &&  $_POST["pageLimit"] <=25 && $_POST["pageLimit"] > 0 && $_POST["selectIstatistik"] == "1"){

        if ($_POST["dateStart"] < $_POST["dateFinish"]) {
            $firstDate = $_POST["dateStart"];
            $secondDate = $_POST["dateFinish"];
        }else{
            $firstDate = $_POST["dateFinish"];
            $secondDate = $_POST["dateStart"];
        }
        $pageLimit = $_POST["pageLimit"];



        $query = "SELECT blog_content.title, COUNT(blog_counter.content_id) as countNumber, blog_content.tarih 
                    FROM blog_counter
                    INNER JOIN blog_content ON blog_content.id = blog_counter.content_id
                    WHERE blog_content.tarih BETWEEN  '$firstDate' AND '$secondDate'
                    GROUP BY blog_counter.content_id
                    ORDER BY COUNT(blog_counter.content_id) DESC
                    LIMIT $pageLimit";
        $mostPages = $db->query($query, PDO::FETCH_OBJ)->fetchAll();

        echo "<pre>";
        print_r($mostPages);
        echo "</pre>";

        foreach ($mostPages as $mostPage){
            $pageTitles [] = $mostPage->title;
        }

        foreach ($mostPages as $mostPage){
            $pageNumbers [] = $mostPage->countNumber;
        }


        $pageTitles = json_encode($pageTitles);
        $pageNumebrs = json_encode($pageNumbers);


        header("Location:../index.php?url=istatistik&tip=2&veriler=$pageNumebrs&titles=$pageTitles&limit=$pageLimit&firstDate=$firstDate&secondDate=$secondDate");
    }else{
        echo "limit 25'e eşit yada küçük olmalı! veya sıfırdan büyük!";
    }




}