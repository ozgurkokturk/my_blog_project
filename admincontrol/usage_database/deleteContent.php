<?php
/*
 *  Yazı Silme Sayfası
 */
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["kadi"])) {
    echo "Session Sorunu <br> Çıkartılıyorsun..";
    header("refresh:2;url=../index.php");
} else {
    //index sayfasından dahil ettiğimiz için
    // require "model/database.php"; GEREK YOK.
    //global $db; GEREK YOK.
    $contentId = htmlspecialchars(trim($_GET["id"]));
    $query = "DELETE FROM blog_posts where content_id = ?";
    $deleteFromPosts = $db->prepare($query);

    if ($deleteFromPosts->execute(array($contentId))){

        $query2 = "DELETE FROM blog_content where id = ?";
        $deleteFromContent = $db->prepare($query2);
            if ($deleteFromContent->execute(array($contentId))){
                echo "true";
            }else{
                echo "false";
            }

    }else{
        echo "false";
    }


}