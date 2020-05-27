<?php
/*
 * Sayfadaki bütün counter tablosu bilgileri silinirse tekrar sıfır sıfır oluşturmak için yoksa
 * anasayfada hiç bir yazı yokmuş gibi görünüyor.
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

    echo "<h1> Yapay Ziyaretçi Verileri Ekleme Alanı </h1>";

    if (isset($_GET) && $_GET["durum"] == "kontrol") {

        // Satir saymanın iki farklı ihtimalini de kullandım !


        // sorguyu çalıştırıp dönen toplam satır sayısına bakıyorum
        $query = "SELECT id FROM blog_content";
        $contentSonuc = $db->query($query);

        // sorguyu çalıştırıp cevabı çekiyorum ama sorgumda zaten count kullandığım için
//        $query2 = "SELECT COUNT(id) as counterSayisi FROM blog_counter";
//        $counterSonuc = $db->query($query2, PDO::FETCH_OBJ)->fetch();

//        echo $contentSonuc->rowCount() . "<br>";
//        echo $counterSonuc->counterSayisi;

        // content tablosunda yazı varsa ve counter ise boşsa yap bu işlemi
        if ($contentSonuc->rowCount() > 0) {
            $satirlar = $contentSonuc->fetchAll(PDO::FETCH_OBJ);

            echo "Veritabanındaki ziyaretçi sayaç tablosundaki bazı veya tüm veriler silinmiş<br>
                  içeriklerin görüntülenebilmesi için mevcut yazılara yapay ziyaretçi verileri eklenecektir.<br><br>";
            foreach ($satirlar as $satir) {
                $query3 = "INSERT INTO blog_counter (visitor_ip, device, browser, system, current_page, content_id) VALUES (0, 0, 0, 0, 0, :contentId)";
                $ekle = $db->prepare($query3);
                if ($ekle->execute(array(":contentId" => $satir->id))) {
                    echo  $satir->id . " id nolu yazıya yapay veri eklendi <br>";
                }
            }

            echo "<br> İçerikleri görüntüleyebilmen için yapay olarak veriler eklendi!<br>";
            echo "<a href='../index.php'>Ana Sayfaya dönmek için Tıkla...</a><br><br>";
            echo "<a href='../index.php?url=cikis'>Çıkış yapmak için...</a>";

        }
    }


}