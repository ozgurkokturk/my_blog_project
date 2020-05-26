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





    if(@$_GET["islem"] == "bilgiler"){

        $userName = htmlspecialchars(trim($_POST["userName"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $hakkimda = htmlspecialchars(trim($_POST["hakkimda"]));
        $userId = htmlspecialchars(trim($_POST["userId"]));

        if($userName == "" || $email == "" || $hakkimda == ""){
            echo "Girilen Değerler Boş Olamaz! <br>";
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo "<a href='$url'>Önceki Sayfaya Dönmek İçin Tıklayınız...</a>";
        }else{
            $query = "UPDATE blog_user SET user_name = ?, email = ?,  hakkimda = ? where id = ?";
            $updateUserInfos = $db->prepare($query);
            $values = array(
                $userName,
                $email,
                $hakkimda,
                $userId
            );
            if($updateUserInfos->execute($values)){

                $_SESSION["kadi"] = $userName;

                echo "İşlem başarılı <br> Yönlendiriliyorusunuz...";
                header("refresh:2;url=../index.php?url=ayarlar");
            }else{
                echo "Bilgiler Güncellenemedi! <br>";
                $url = htmlspecialchars($_SERVER['HTTP_REFERER']); // hangi sayfadan gelindigi degerini verir.
                echo "<a href='$url'>Önceki Sayfaya Dönmek İçin Tıklayınız...</a>"; //dugmeye o degeri atiyoruz.
            }
        }

    }
    else if(@$_GET["islem"] == "sifre"){

        $eskiSifre = htmlspecialchars(trim($_POST["eskiSifre"]));
        $yeniSifre = htmlspecialchars(trim($_POST["yeniSifre"]));
        $yeniSifreIki = htmlspecialchars(trim($_POST["yeniSifreIki"]));
        $userId = htmlspecialchars(trim($_POST["userId"]));

        if($eskiSifre == "" || $yeniSifre == "" || $yeniSifreIki == ""){
            echo "Girilen Değerler Boş Olamaz! <br>";
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo "<a href='$url'>Önceki Sayfaya Dönmek İçin Tıklayınız...</a>";
        }
        else{
            $userInfo = getUserInfos($db, $_SESSION["id"]);

            if($yeniSifre == $yeniSifreIki && $eskiSifre == $userInfo->password ){

                $query = "UPDATE blog_user SET password = ? where id = ?";
                $updateUserInfos = $db->prepare($query);
                $values = array(
                    $yeniSifre,
                    $userId
                );
                if($updateUserInfos->execute($values)){
                    echo "Şifre değiştirme işlemi başarılı <br> Yönlendiriliyorusunuz...";
                    header("refresh:2;url=../index.php");
                }else{
                    echo "Şifre değiştirme işleminde sorun var <br><br> Şifrenizin 10 karakterden uzun olmadığına emin olun. <br><br>";
                    $url = htmlspecialchars($_SERVER['HTTP_REFERER']); // hangi sayfadan gelindigi degerini verir.
                    echo "<a href='$url'>Önceki Sayfaya Dönmek İçin Tıklayınız...</a>"; //dugmeye o degeri atiyoruz.
                }
            }
            else{
                echo "Girilen Şifre Değerlerinde Yanlışlık Var <br><br>";
                $url = htmlspecialchars($_SERVER['HTTP_REFERER']); // hangi sayfadan gelindigi degerini verir.
                echo "<a href='$url'>Önceki Sayfaya Dönmek İçin Tıklayınız...</a>"; //dugmeye o degeri atiyoruz.
            }

        }


    }
    else{
        echo "GET ile gelen değer farklı !";
        header("refresh:2;url=../index.php");
    }



}