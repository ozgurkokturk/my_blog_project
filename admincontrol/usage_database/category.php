<?php
/*
 * Kategori İşlemleri
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


    // Ekleme işlemi farklı bir form ile olduğu için basit yöntem
    // Delete ve Update işlemi aynı form üzerinden olduğu için farklı bir yöntem ile yapıldı
    if (isset($_POST["categoryName"])){
        $categoryName = htmlspecialchars(trim($_POST["categoryName"]));
        if($categoryName != ""){
            $query ="INSERT INTO blog_category (title) VALUES (?)";
            $insert = $db->prepare($query);
            $insert->bindParam(1,$categoryName,PDO::PARAM_STR);

            if ($insert->execute()){
                $id = $db->lastInsertId();
                $values = array(
                    "id" => $id,
                    "cetogryName" => $categoryName
                    );
                echo json_encode($values);
            }else{
                echo "execute sorun var";
            }
        }
        else{
            echo "Değer Boş Olamaz";
        }


    }
    elseif (isset($_POST["p"]) && isset($_POST["categoryId"]) && $_POST["p"] == "deleteFromJquery"){
        $categoryId =  htmlspecialchars(trim($_POST["categoryId"]));
        $query = "DELETE FROM blog_category WHERE id = :id";
        $delete = $db->prepare($query);
    //    $delete->bindParam(":id",$selectedCategory,PDO::PARAM_INT);
        if ($delete->execute(array(":id" => $categoryId))){
            echo "true";
        }
        else{
            echo "false";
        }

    }
    elseif (isset($_POST["p"]) && isset($_POST["newCategoryName"]) && isset($_POST["categoryId"]) && $_POST["p"] == "updateFromJquery" ){
        $categoryId =  htmlspecialchars(trim($_POST["categoryId"]));
        $newCategoryName =  htmlspecialchars(trim($_POST["newCategoryName"]));

        $query = "UPDATE blog_category SET title = :title where id = :id";
        $update = $db->prepare($query);
        if ($update->execute(array(":title" => $newCategoryName, ":id" => $categoryId))){
            echo "true";
        }else{
            echo "false";
        }
    }

}
