<?php

try {
    $db = new PDO("mysql:hostname=localhost;dbname=my_blog;charset=utf8","root","");

}catch (PDOException $e){
    echo $e->getMessage();
}

/*  Ana Sayfa İçin Kullanılan Fonksiyonlar */
    function showPosts ($db,$userId,$offset,$gosterilecekAdet, $siralama, $arama){


        if($arama == "yok"){
            if($siralama == "asc") {
                $query = "SELECT  blog_content.id as blogId, blog_content.title as blogTitle, blog_content.text as blogText, blog_content.tarih as blogTarih, blog_content.labels as blogLabels, blog_content.visibility as blogVisibility, blog_category.title as blogCategoryTitle, blog_user.id as userId, count(blog_counter.content_id) as number
                    FROM blog_posts
                    INNER JOIN blog_user ON blog_posts.user_id = blog_user.id
                    INNER join blog_content ON blog_posts.content_id = blog_content.id
                    INNER JOIN blog_category ON blog_category.id = blog_content.category_id
                    INNER JOIN blog_counter ON blog_counter.content_id = blog_content.id
                    where blog_posts.user_id = :userId
                    GROUP BY blog_counter.content_id
                    ORDER BY count(blog_counter.content_id) ASC, blog_content.tarih DESC
                    LIMIT :offset, :gosterilecekAdet";
            }
            else if ($siralama == "desc"){
                $query = "SELECT  blog_content.id as blogId, blog_content.title as blogTitle, blog_content.text as blogText, blog_content.tarih as blogTarih, blog_content.labels as blogLabels, blog_content.visibility as blogVisibility, blog_category.title as blogCategoryTitle, blog_user.id as userId, count(blog_counter.content_id) as number
                    FROM blog_posts
                    INNER JOIN blog_user ON blog_posts.user_id = blog_user.id
                    INNER join blog_content ON blog_posts.content_id = blog_content.id
                    INNER JOIN blog_category ON blog_category.id = blog_content.category_id
                    INNER JOIN blog_counter ON blog_counter.content_id = blog_content.id
                    where blog_posts.user_id = :userId
                    GROUP BY blog_counter.content_id
                    ORDER BY count(blog_counter.content_id) DESC, blog_content.tarih DESC
                    LIMIT :offset, :gosterilecekAdet";
            }
            else{
                // tarihe göre normal hali
                $query = "SELECT  blog_content.id as blogId, blog_content.title as blogTitle, blog_content.text as blogText, blog_content.tarih as blogTarih, blog_content.labels as blogLabels, blog_content.visibility as blogVisibility, blog_category.title as blogCategoryTitle, blog_user.id as userId, count(blog_counter.content_id) as number
                    FROM blog_posts
                    INNER JOIN blog_user ON blog_posts.user_id = blog_user.id
                    INNER join blog_content ON blog_posts.content_id = blog_content.id
                    INNER JOIN blog_category ON blog_category.id = blog_content.category_id
                    INNER JOIN blog_counter ON blog_counter.content_id = blog_content.id
                    where blog_posts.user_id = :userId
                    GROUP BY blog_counter.content_id
                    ORDER BY blog_content.tarih DESC
                    LIMIT :offset, :gosterilecekAdet";
            }
        }else{
            if($siralama == "normal"){
                // normal sıralama ve arama
                $query = "SELECT  blog_content.id as blogId, blog_content.title as blogTitle, blog_content.text as blogText, blog_content.tarih as blogTarih, blog_content.labels as blogLabels, blog_content.visibility as blogVisibility, blog_category.title as blogCategoryTitle, blog_user.id as userId, count(blog_counter.content_id) as number
                    FROM blog_posts
                    INNER JOIN blog_user ON blog_posts.user_id = blog_user.id
                    INNER join blog_content ON blog_posts.content_id = blog_content.id
                    INNER JOIN blog_category ON blog_category.id = blog_content.category_id
                    INNER JOIN blog_counter ON blog_counter.content_id = blog_content.id
                    where blog_posts.user_id = :userId  and blog_content.title LIKE '%$arama%'
                    GROUP BY blog_counter.content_id
                    ORDER BY blog_content.tarih DESC
                    LIMIT :offset, :gosterilecekAdet";
            }
            else if ($siralama == "desc"){
                $query = "SELECT  blog_content.id as blogId, blog_content.title as blogTitle, blog_content.text as blogText, blog_content.tarih as blogTarih, blog_content.labels as blogLabels, blog_content.visibility as blogVisibility, blog_category.title as blogCategoryTitle, blog_user.id as userId, count(blog_counter.content_id) as number
                    FROM blog_posts
                    INNER JOIN blog_user ON blog_posts.user_id = blog_user.id
                    INNER join blog_content ON blog_posts.content_id = blog_content.id
                    INNER JOIN blog_category ON blog_category.id = blog_content.category_id
                    INNER JOIN blog_counter ON blog_counter.content_id = blog_content.id
                    where blog_posts.user_id = :userId  and blog_content.title LIKE '%$arama%'
                    GROUP BY blog_counter.content_id
                    ORDER BY count(blog_counter.content_id) DESC, blog_content.tarih DESC
                    LIMIT :offset, :gosterilecekAdet";
            }
            else if ($siralama == "asc"){
                $query = "SELECT  blog_content.id as blogId, blog_content.title as blogTitle, blog_content.text as blogText, blog_content.tarih as blogTarih, blog_content.labels as blogLabels, blog_content.visibility as blogVisibility, blog_category.title as blogCategoryTitle, blog_user.id as userId, count(blog_counter.content_id) as number
                    FROM blog_posts
                    INNER JOIN blog_user ON blog_posts.user_id = blog_user.id
                    INNER join blog_content ON blog_posts.content_id = blog_content.id
                    INNER JOIN blog_category ON blog_category.id = blog_content.category_id
                    INNER JOIN blog_counter ON blog_counter.content_id = blog_content.id
                    where blog_posts.user_id = :userId  and blog_content.title LIKE '%$arama%'
                    GROUP BY blog_counter.content_id
                    ORDER BY count(blog_counter.content_id) ASC, blog_content.tarih DESC
                    LIMIT :offset, :gosterilecekAdet";
            }
        }


        $posts = $db->prepare($query);

        // array ile yapamadım int'ler sorun çıkardı galiba...
        // o yüzden bindParam kullandım.
        $posts->bindParam(":userId",$userId, PDO::PARAM_INT);
        $posts->bindParam(":offset",$offset, PDO::PARAM_INT);
        $posts->bindParam(":gosterilecekAdet",$gosterilecekAdet, PDO::PARAM_INT);
        $posts->execute();


        // Hiç yazı yoksa counter tablosuyla inner olduğu için anasayfada
        // yazı göstermeyecektir onun için sayfa tazeledeki işlemi yapıyoruz.
        // tabi search esnasında hiçbir sonuç dönmezse de buraya girecek
        // o sebeple arama yapılmamışsa sayfa tazeleme yapmasın
        if ($posts->rowCount() <= 0){
            if ($arama == "yok"){
                header("Location:usage_database/sayfa_tazele.php?durum=kontrol");
            }
            else{
                $posts = $posts->fetchAll(PDO::FETCH_OBJ);
                return $posts;
            }
        }
        else{
            $posts = $posts->fetchAll(PDO::FETCH_OBJ);
            return $posts;
        }


    }


    // Pagination için toplam kayıt sayısı
    function rowCount($db,$userId){
        $query = "SELECT COUNT(id) as sayi from blog_posts where user_id= $userId ";
        $toplamSatir = $db->query($query,PDO::FETCH_OBJ)->fetch();
        return $toplamSatir;
    }


    // Toplam siteyi ziyaret eden tekil ziyaretçi sayısı
    function sumVisitor($db){
        $query = "SELECT * FROM blog_counter GROUP by visitor_ip";
        $sumVisitor = $db->query($query)->rowCount();
        return $sumVisitor;
    }

    // Giriş yapan kişi bazında kişinin en çok okunan yazısı
    function popularPost($db, $userId){
        $query = "SELECT blog_content.title, count(blog_counter.content_id) as number 
                  FROM blog_content 
                  INNER JOIN blog_counter on blog_counter.content_id = blog_content.id
                  INNER JOIN blog_posts on blog_posts.content_id = blog_content.id
                  where blog_posts.user_id =  $userId
                  GROUP BY blog_counter.content_id 
                  ORDER by count(blog_counter.content_id) DESC LIMIT 1";
        $popularPost = $db->prepare($query);
        $popularPost->execute();

        if($popularPost->rowCount() > 0){
            $popularPost = $popularPost->fetch(PDO::FETCH_ASSOC);
            return $popularPost;
        }
    }



/*  ...................................... */



/*  Kategoriler Sayfası İçin Kullanılan Fonksiyonlar */
function showCategories($db){
    $query = "SELECT * FROM blog_category";
    $categories =  $db->query($query,PDO::FETCH_OBJ)->fetchAll();
    return $categories;
}

function notInCategories($db){
    $query = "SELECT * FROM blog_category where NOT id IN (SELECT  blog_content.category_id FROM  blog_category INNER JOIN blog_content ON blog_category.id = blog_content.category_id)";
    $notCategories = $db->query($query,PDO::FETCH_OBJ)->fetchAll();
    return $notCategories;
}


function showCategoryCount($db){
    $query = "SELECT blog_category.title, COUNT(blog_content.category_id) as categoryCount  , blog_content.category_id as categoryId FROM blog_content INNER JOIN blog_category ON blog_content.category_id = blog_category.id GROUP BY blog_content.category_id";
    $counts = $db->query($query,PDO::FETCH_OBJ)->fetchAll();
    return $counts;
}

function showContentFromCategoryId($db, $id){
    $pages = $db->query("SELECT * FROM blog_content where category_id = $id ORDER BY category_id DESC ", PDO::FETCH_OBJ)->fetchAll();
    return $pages;
}
/*  ...................................... */



/*  DÜZENLE Sayfası İçin Kullanılan Fonksiyonlar */
function showContentFromId($db, $id){
    $content = $db->query("SELECT * FROM blog_content where id = $id", PDO::FETCH_OBJ)->fetch();
    return $content;
}
/*  ...................................... */




/*  AYARLAR Sayfası İçin Kullanılan Fonksiyonlar */

// Kullancı Bilgileri İçin
function getUserInfos($db,$id){
    $userInfo = $db->query("SELECT * FROM blog_user where id = $id", PDO::FETCH_OBJ)->fetch();
    return $userInfo;
}



// Site Başlıkları için
function getSiteTitles($db){
    $siteTitles = $db->query("SELECT * FROM blog_title", PDO::FETCH_OBJ)->fetch();
    return $siteTitles;
}


/*  ...................................... */
