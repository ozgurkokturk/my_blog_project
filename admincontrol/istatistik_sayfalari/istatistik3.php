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

    /* Cihaz Bilgileri Alanı */
    if(isset($_POST["selectYear"],$_POST["selectIstatistik"]) && $_POST["selectIstatistik"] == "1"){

        $year = htmlspecialchars($_POST["selectYear"]);

            $query = "SELECT blog_counter.device, count(blog_counter.device) as devicesNumber FROM `blog_counter`
                        WHERE YEAR(tarih) = $year and device <> '0'
                        GROUP BY blog_counter.device
                        ORDER BY devicesNumber DESC";
            $cihazlar = $db->query($query,PDO::FETCH_OBJ)->fetchAll();

            foreach ( $cihazlar as $cihaz) {
                $cihazTitle [] = $cihaz->device;
                $cihazNumbers [] = $cihaz->devicesNumber;
            }

            $cihazTitle = json_encode($cihazTitle);
            $cihazNumbers = json_encode($cihazNumbers);

//            print_r($cihazTitle);
//            print_r($cihazNumbers);
//            die();

        header("Location:../index.php?url=istatistik&tip=3&secim=1&cihazlar=$cihazTitle&sayilar=$cihazNumbers&year=$year");
    }
    /* Tarayıcı Bilgileri Alanı */
    else if(isset($_POST["selectYear"],$_POST["selectIstatistik"]) && $_POST["selectIstatistik"] == "2"){

        $year = htmlspecialchars($_POST["selectYear"]);

        $query = "SELECT blog_counter.browser, count(blog_counter.browser) as browsersNumber FROM blog_counter 
                    WHERE YEAR(tarih) = $year and blog_counter.browser <> '0'
                    GROUP BY blog_counter.browser 
                    ORDER BY browsersNumber DESC";
        $tarayıcılar = $db->query($query,PDO::FETCH_OBJ)->fetchAll();

        foreach ( $tarayıcılar as $tarayıcı) {
            $tarayıcıTitle [] = $tarayıcı->browser;
            $tarayıcıNumbers [] = $tarayıcı->browsersNumber;
        }

        $tarayıcıTitle = json_encode($tarayıcıTitle);
        $tarayıcıNumbers = json_encode($tarayıcıNumbers);

//            print_r($tarayıcıTitle);
//            print_r($tarayıcıNumbers);
//            die();

        header("Location:../index.php?url=istatistik&tip=3&secim=2&tarayicilar=$tarayıcıTitle&sayilar=$tarayıcıNumbers&year=$year");

    }
    /* İşletim Sistemleri Alanı */
    else if(isset($_POST["selectYear"],$_POST["selectIstatistik"]) && $_POST["selectIstatistik"] == "3"){

        $year = htmlspecialchars($_POST["selectYear"]);

        $query = "SELECT blog_counter.system, count(blog_counter.system) as systemNumber FROM blog_counter 
                    WHERE YEAR(tarih) = $year and blog_counter.system <> '0'
                    GROUP BY blog_counter.system 
                    ORDER BY systemNumber DESC";
        $sistemler = $db->query($query,PDO::FETCH_OBJ)->fetchAll();

        foreach ( $sistemler as $sistem) {
            $sistemTitle [] = $sistem->system;
            $sistemNumbers [] = $sistem->systemNumber;
        }

        $sistemTitle = json_encode($sistemTitle);
        $sistemNumbers = json_encode($sistemNumbers);

//            print_r($sistemTitle);
//            print_r($sistemNumbers);
//            die();

        header("Location:../index.php?url=istatistik&tip=3&secim=3&sistemler=$sistemTitle&sayilar=$sistemNumbers&year=$year");
    }
    else{
        echo "Post değerinde sorun var";
    }





}