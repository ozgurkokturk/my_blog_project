<?php
//<base href="http://localhost/php/blog/admincontrol/index.php">
if (!isset($_SESSION)){
    session_start();
}

include "../functions.php";
require "model/database.php";
global $db;


if (isset($_SESSION["kadi"])) {
    if (isset($_GET["url"])){
        $url = $_GET["url"];

        switch ($url){
            case "cikis":
                include "model/cikis.php";
                break;


            case "duzenle":
                if(isset($_GET["id"])){
                    $categories = showCategories($db);
                    $content = showContentFromId($db,$_GET["id"]);
                    include "view/updateContent.php";
                }
                break;


            case "sil":
                    if(isset($_GET["id"])){
                        include "usage_database/deleteContent.php";
                    }
                break;


            case "ekle":
                $categories = showCategories($db);
                include "view/add_new_content.php";
                break;


            case "kategori":
                $categories = showCategories($db);
                $notCategories = notInCategories($db);
                $counts = showCategoryCount($db);
                include "view/category.php";
                break;


            case "istatistik":

                if(isset($_GET["tip"])){
                    if($_GET["tip"] == "1"){
                        include "view/istatistikler/istatistik1.php";
                    }
                    else if($_GET["tip"] == "2"){
                        include "view/istatistikler/istatistik2.php";
                    }
                    else if ($_GET["tip"] == "3"){
                        include "view/istatistikler/istatistik3.php";
                    }else{
                        include "view/istatistikler/istatistik1.php";
                    }
                }else{
                    include "view/istatistikler/istatistik1.php";
                }

                break;


            case "ayarlar":
                $userInfo = getUserInfos($db, $_SESSION["id"]);
                $siteTitles = getSiteTitles($db);
                include "view/ayarlar.php";
                break;

            default: echo "404 admin";
        }

    }else{
        include "usage_database/pagination.php";
        // pagination sayfasının devamı...
        //pagination daki asc yada decs olayını da paginationda kontrol ettim
        // search bölümü de pagination'da
        $posts = showPosts($db,$_SESSION["id"],$offset,$gosterilecekAdet,$siralama,$arama);

        include "view/admin_page.php";
    }
}
else{

    include "view/entry.php";
}

