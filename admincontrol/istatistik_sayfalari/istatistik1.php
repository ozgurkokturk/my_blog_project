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


//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
//    die();



    /*
     * view/istatistik.php sayfasından direkt olarak bu sayfaya gelen post değerlerini alıp işleyip
     * gönderiyorum ama direkt değil index.php?url=istatistik üzerinden
     */
    if(isset($_POST["selectYear"],$_POST["selectIstatistik"]) && $_POST["selectIstatistik"] == "1"){

        $year = htmlspecialchars($_POST["selectYear"]);
        $aylar = array(
            'ocak',
            'subat',
            'mart',
            'nisan',
            'mayis',
            'haziran',
            'temmuz',
            'agustos',
            'eylul',
            'ekim',
            'kasim',
            'aralik'
        );

        for($i = 0; $i < sizeof($aylar); $i++){
//        echo $aylar[$i] . " = " . ($i+1) . "<br>";
            $query = "SELECT COUNT(id) as id FROM blog_counter WHERE MONTH(tarih) = ($i+1) AND YEAR(tarih) = $year";
            $degerler[$i] = $db->query($query,PDO::FETCH_OBJ)->fetchAll();
        }

        for($i = 0; $i < sizeof($degerler); $i++){
            foreach ($degerler[$i] as $deger)
                echo $deger->id . "<br>";
            $veriler [] = $deger->id;
        }

        $veriler = json_encode($veriler);
        $aylar = json_encode($aylar);

        header("Location:../index.php?url=istatistik&tip=1&secim=1&veriler=$veriler&aylar=$aylar&year=$year");
    }


    if(isset($_POST["selectYear"],$_POST["selectIstatistik"]) && $_POST["selectIstatistik"] == "2"){

        $year = htmlspecialchars($_POST["selectYear"]);

        $query = "SELECT content_id, COUNT(content_id) as countNumber FROM blog_counter 
                    WHERE YEAR(tarih) = $year and content_id = '-1' OR content_id = '-2'
                    GROUP BY content_id
                    ORDER BY content_id DESC";
        $veriler = $db->query($query, PDO::FETCH_OBJ)->fetchAll();


        foreach ($veriler as $veri){
            $pageNumbers [] = $veri->countNumber;
        }

        $specialPagesTitle  = array("anasayfa","hakkimda");

        $specialPagesTitle = json_encode($specialPagesTitle);
        $pageNumbers = json_encode($pageNumbers);


        header("Location:../index.php?url=istatistik&tip=1&secim=2&veriler=$pageNumbers&title=$specialPagesTitle&year=$year");
    }






}