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


    if ( isset($_POST["selectCategory"]) && isset($_POST["titleContent"]) && isset($_POST["textareaContent"]) && isset($_POST["labelsContent"]) && isset($_POST["dateContent"]) && isset($_POST["radioContent"])) {

        $titleContent = htmlspecialchars(trim($_POST["titleContent"]));
        $textareaContent = htmlspecialchars(trim($_POST["textareaContent"]));
        $dateContent = htmlspecialchars(trim($_POST["dateContent"]));
        $labelsContent = htmlspecialchars(trim($_POST["labelsContent"]));
        $radioContent = htmlspecialchars(trim($_POST["radioContent"]));
        $selectCategory = htmlspecialchars(trim($_POST["selectCategory"]));

        if($titleContent == "" || $labelsContent == ""){
            $response = array(
                "state" => "false",
                "message" => "Başlık ve etiket kısımları boş olamaz!",
            );
            echo json_encode($response);
        }
        else{
            $query = "INSERT INTO blog_content (title,text,tarih,labels,visibility,category_id) VALUES (:title,:text,:tarih,:labels,:visibility,:category_id)";
            $insert = $db->prepare($query);
            $values = array(
                ":title" => $titleContent,
                ":text" => $textareaContent,
                ":tarih" => $dateContent,
                ":labels" => $labelsContent,
                ":visibility" => $radioContent,
                ":category_id" => $selectCategory
            );
            if ($insert->execute($values)) {
                $contenId = $db->lastInsertId();
                $userId = $_SESSION["id"];
                $query2 = "INSERT INTO blog_posts (user_id,content_id) VALUES (:user,:content)";
                $add = $db->prepare($query2);

                if ($add->execute(array(":user" => $userId, ":content" => $contenId))) {
                    $query3 = "INSERT INTO blog_counter (visitor_ip, device, browser, system, current_page, content_id) VALUES (0, 0, 0, 0, 0, :contentId)";
                    $ekle = $db->prepare($query3);
                    if($ekle->execute(array(":contentId" => $contenId))){
                        $response = array(
                            "state" => "true",
                            "message" => "Ekleme Başarılı <br> Bekleyiniz...",
                            "newUrl" => "index.php"
                        );
                        echo json_encode($response);
                    }
                    else{
                        echo "b_counter eklenirken hata oluştu";
                    }


                }
                else {

                    echo "b_posts eklenirken hata oluştu";
                }

            }
            else {
                echo "b_content'e eklenirken hata oluştu";
            }
        }


    }
    else{
        echo "POST IF'ine girmedi!";
    }

}