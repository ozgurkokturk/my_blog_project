<?php

try {
    $db = new PDO("mysql:hostname=localhost;dbname=my_blog;charset=utf8","root","");

}catch (PDOException $e){
    echo $e->getMessage();
}


 /*  Ana Sayfa İçin Kullanılan Fonksiyonlar */
    function showTitles($db){
        //Tek SATIR Çekmek İçin bunun kullanımı array gibi
        $query = "SELECT * FROM blog_title LIMIT 1";
        $titles = $db->query($query)->fetch();
        return $titles;
    }

    function showCategoryCount($db){
        $query = "SELECT blog_category.title, COUNT(blog_content.category_id) as categoryCount  , blog_content.category_id as categoryId FROM blog_content INNER JOIN blog_category ON blog_content.category_id = blog_category.id WHERE blog_content.visibility=1 GROUP BY blog_content.category_id";
        $counts = $db->query($query,PDO::FETCH_OBJ)->fetchAll();
        return $counts;
    }

    function showContent($db, $id){
        $pages = $db->query("SELECT * FROM blog_content where category_id = $id and blog_content.visibility=1 ORDER BY tarih DESC", PDO::FETCH_OBJ)->fetchAll();
        return $pages;
    }
/*  ...................................... */



/*  Sayfalar İçin Kullanılan Fonksiyonlar */
    function showPage($db, $id){

        // Get ile aldığımız $id sadece sayılardan mı oluşuyor kontrolü yapıyoruz
        if(!ctype_digit($id)){
            header("Location:index.php?url=hakkimda");
        }
        else{
            $queryContent = $db->prepare("SELECT blog_content.*, blog_category.title as categorytitle FROM blog_content INNER JOIN blog_category ON blog_content.category_id=blog_category.id where blog_content.id=$id and blog_content.visibility=1");
            $queryContent->execute();
            if($queryContent->rowCount() == 0){
                header("Location:index.php");
            }else{
                $contents = $queryContent->fetch(PDO::FETCH_ASSOC);
                return $contents;
            }
        }

    }
/*  ...................................... */





/*  Hakkımda İçin Kullanılan Fonksiyonlar */
    function aboutMe($db){
        $query = $db->prepare("SELECT user_name,hakkimda FROM blog_user ");
        $query->execute();

        if ($query->rowCount() > 0){
            $about = $query->fetch(PDO::FETCH_ASSOC);
            return $about;
        }
    }
/*  ...................................... */