<?php

if (!isset($_SESSION)){
    session_start();
}

require "../model/database.php";
global $db;


if (isset($_POST["kadi"]) && isset($_POST["sfr"]) && isset($_POST["control"])){

//json'a çevirip en son bu değişkeni göndericez
    $response = array(
        "state" => "",
        "message" => "",
        "guvenlikkontrol" => "",
        "newUrl" => ""

    );

    $kadi = trim(htmlspecialchars($_POST["kadi"]));
    $sfr = trim(htmlspecialchars($_POST["sfr"]));
    $kod = trim(htmlspecialchars($_POST["control"]));


    if ($kod == $_SESSION["guvenlik"]){

        $query = $db->prepare("SELECT * FROM blog_user where email=? and password=?");
        $query->bindParam(1,$kadi,PDO::PARAM_STR);
        $query->bindParam(2,$sfr,PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() <= 0){
            $db = null;
            $response = array(
                "state" => "false",
                "message" => "Kullanıcı bilgileri hatalı!",
                "guvenlikkontrol" => "1"
            );
        }else{

            $info = $query->fetch(PDO::FETCH_OBJ);
            if ($info->email == $kadi && $info->password == $sfr){

                $_SESSION["id"] = $info->id;
                $_SESSION["kadi"] = $info->user_name;
                $_SESSION["yetki"] = $info->yetki;

                $response = array(
                    "state" => "true",
                    "message" => "Giriş Başarılı <br> Yönlendiriliyorsun...",
                    "newUrl" => "index.php"
                );
            }else{
                $response = array(
                    "state" => "false",
                    "message" => "Kullanıcı bilgilerinde bir sorun var.",
                    "guvenlikkontrol" => "1"
                );
            }
        }

    }
    else{
        $response = array(
            "state" => "false",
            "message" => "Güvenlik Kodu hatalı!",
            "guvenlikkontrol" => "0"
        );
    }


    echo json_encode($response);
}



