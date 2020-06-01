<?php

require "database.php";
include "functions.php";
global $db;



//index.php?url=sayfa&id=

if(isset($_GET["url"])){
    $url = $_GET["url"];
    switch ($url){
        case "hakkimda":
            $about = aboutMe($db);
            //Sayaç eğer hakımdaysa content_id hep -2
            counter(-2);

            include "view/hakkimda.php";
            break;

        case "sayfa":
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                    $contents = showPage($db, $id);

                    //Sayaç için veritabanından content_id geldiğinde
                    counter($contents["id"]);

                    include "view/sayfalar.php";
                }
                else{
                    echo "Nerede geziyon sen?";
                    echo "<br> <br> Dön geri <a href='index.php'>dön!!</a>";
                }
            break;

            default : echo "404";
    }
}
else{
    $titles = showTitles($db);
    $counts = showCategoryCount($db);
    //Sayaç eğer anasayfa ise content_id hep -1
    counter(-1);

    include "view/anasayfa.php";
}