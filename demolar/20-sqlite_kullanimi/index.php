<?php

try {


    // Veritabanı bağlantısı
    $db = new PDO ('sqlite:mydatabase.db');


    // Zaman dilimini seçiyoruz
    date_default_timezone_set('Europe/Istanbul');


    // Dosya izinleri
    chmod("mydatabase.db", 0770);
//    exec("cmod 0777 *");


    function zamanAyarla(){
        $dosya = fopen("zaman.txt","w+");

        $tarihNormal = new DateTime('now');
        $tarihNormal =  $tarihNormal->format('Y-m-d H:i:s');

        $tarihUnix = time();

        $yazilacaklar = $tarihUnix . "\n" . $tarihNormal ;
        fwrite($dosya, $yazilacaklar);

        $icerik = file('zaman.txt');
        fclose($dosya);
    }

    //Dosya yoksa oluştur ve verileri çek
    if(file_exists('zaman.txt')){

        if(!filesize('zaman.txt')){
            //echo "dosya boş";
            zamanAyarla();
        }
    }
    else{
        //echo "dosya yok";
        zamanAyarla();
    }

    // Dosyadan değişkenlere aktarım
    $degerler = file('zaman.txt');
    $tarihUnix = $degerler[0];
    $tarihNormal = $degerler[1];


    // Eğer son eklenen kayıt ile şimdi eklenen kayıt arasında 5dk varsa mevcutları sil ve işleme devam et
    // 60*5 = 300 saniye 5dk olarak ayarlandı
    if( (time()-$tarihUnix) > (60*5) ){
        $query = "DELETE FROM todo_list";
        $hepsiniSil = $db->prepare($query);
        $hepsiniSil->execute();
        zamanAyarla();
        header("Refresh:0");
        die();
    }





    // Yapılacaklar bölümü için SELECT sorgusu...
    $query1 = "SELECT * FROM todo_list where done = '0' ORDER BY priority DESC";
    $yapilanlar = $db->query($query1);
    $yapilanlar = $yapilanlar->fetchAll(PDO::FETCH_OBJ);


    // Yapılanlar bölümü için SELECT sorgusu...
    $query2 = "SELECT * FROM todo_list where done = '1' ORDER BY completionDate DESC, priority DESC ";
    $yapilmislar = $db->query($query2);
    $yapilmislar = $yapilmislar->fetchAll(PDO::FETCH_OBJ);



    if (isset($_POST["yapilacak"],$_POST["derece"]) && $_POST["yapilacak"] != "" && $_POST["derece"] != ""){

        $yapilacak = trim(($_POST["yapilacak"]));
        $derece = htmlspecialchars(trim($_POST["derece"]));
        $tarih = date("Y/m/d");

        // 20den fazla kayıt eklenmemesi için...
        $query1 = "SELECT COUNT(id) as number FROM todo_list";
        $yapilanlar = $db->query($query1);
        $yapilanlar = $yapilanlar->fetch(PDO::FETCH_COLUMN);

        // Eğer toplam kayıt 20'den fazla ise yeni kayıt ekleme SQL sorgusunu çalıştırma!
        if($yapilanlar < 20){
            $query3 = "INSERT INTO todo_list (todoName, creationDate, priority, done) VALUES ('$yapilacak','$tarih' ,'$derece', '0')";
            $ekle = $db->prepare($query3);
            $ekle->execute();
            header("Location:index.php");
        }
        else{
            echo "20 den fazla kayıt eklenemez! <br> Bazı kayıtları silin <br><br> Geri yönlendiriliyorsunuz...";
            header("refresh:4;url=index.php");
            die();
        }


    }
    elseif (isset($_GET["islem"],$_GET["id"]) ){

        $id = htmlspecialchars(trim($_GET["id"]));
        $tarih = date("Y/m/d");

        // Eğer islem = done şeklinde GET parametresi gelirse veritabanında UPDATE sorugusunu değişkene at.
        if ($_GET["islem"] == "done"){
           $query = "UPDATE todo_list SET done = '1' , completionDate = '$tarih' where id = $id";
        }
        // Eğer islem = sil şeklinde GET parametresi gelirse veritabanında DELETE sorgusunu değişkene at.
        elseif ($_GET["islem"] == "sil"){
            $query = "DELETE FROM todo_list where id = $id";
        }

        // if else'ler sonucunda gelen query değişkeninin içindeki sorguyu çalıştır.
        $islem = $db->prepare($query);
        $islem->execute();

        // sayfayı yenile yeni kayıt sayfada görünsün.
        header("Location:index.php");

    }


    /*
    * Zaman Farklarını göster
    */
    if (isset($tarihUnix) && isset($tarihNormal)){
        $tarih = new DateTime('now');
        echo "<b>Şu anki Tarih: </b>" . $tarih->format('Y-m-d H:i:s');

        echo "<br>";

        $tarihNormal = new DateTime($tarihNormal);
        echo "<b>Son Kayıt Tarihi: </b>" . $tarihNormal->format('Y-m-d H:i:s');


        // Tarihler arası farkı alıyoruz array olarak
        $fark = $tarih->diff($tarihNormal);

        // Aradaki farkı yıl ay gün saat dikika saniye şeklinde DateTime sınıfının format fonksiyonu sayesinde kullanıyoruz.
        $sayac = $fark->format('%y yıl %m ay %d gün %h saat %i dakika %s saniye');
        // 0 yıl, 0 ay falan yazıyorsa bunları siliyoruz. 'boşluk sıfır ay' olduğuna dikkat et!
        $sayac = str_replace(
            ['0 yıl', ' 0 ay', ' 0 gün', ' 0 saat', ' 0 dakika'],
            "",
            $sayac
        );
        echo "<br>";
        echo $sayac;

        echo "<br> <small> Her 5 dakikada bir kayıtlar otomatik olarak silinir.</small>";
    }







    /*
     * Veritabanında dereceler 1, 2, 3 olarak kayıtlı fakat böyle göstermek yerine "Düşük, "Orta", "Yüksek" şeklinde
     * göstermek için böyle bir metod kullandım.
     */
    $onemDereceleri = array(
        "1" => "Düşük",
        "2" => "Orta",
        "3" => "Yüksek"
    );
    function onemDerecesi($deger){
        // fonksiyonun dışında yer alan $onemDereceleri dizisini fonksiyonun içinde de kullanabilmek için
        // global olarak tanımladık.
        global $onemDereceleri;

        if(array_key_exists($deger, $onemDereceleri)){
            return $onemDereceleri[$deger];
        }else{
            return null;
        }
    }


}catch (PDOException $e){
    echo $e->getMessage();
}

?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>TodoList Projesi</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/19bd3d963f.js" crossorigin="anonymous"></script>

    <style>
        .baslik{
            font-size: 12px;
            font-weight: bold;
        }
        .icerik{
            font-size: 11px;
        }
        .spanler{
            font-weight: bolder;
            width: 60px !important;
        }
        .yapilacak:after{
            /*iki div arası gri çizgi için*/
            content: " ";
            background-color: #ddd;
            position: absolute;
            width: 1px;
            height: 100%;
            top: 0;
            left: 100%;
            display: inline-block;

        }
        .yapilanlar{

        }
    </style>

</head>

<body>
<h1 class="text-center mt-2">Todo List</h1>
<div class="container-fluid mt-5">

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="" method="post">
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="yapilacak" placeholder="Bir yapılacak gir ...">
                    </div>

                    <div class="form-group col-md-3">
                        <select class="form-control"  name="derece">
                            <?php foreach ($onemDereceleri as $key => $deger): ?>
                                <option value="<?php echo $key ?>"><?php echo $deger ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-success form-control">Ekle</button>
                    </div>

                </div>

            </form>
        </div>
    </div>

    <div class="row mt-4">


        <!-- Yapılacaklar Bölümü-->
        <div class="col-lg-6 yapilacak">
            <h4 class="text-center mb-4">Yapılacaklar</h4>
            <div class="row">
                <div class="col-sm-1 d-none d-sm-block baslik">No</div>
                <div class="col-sm-1 d-none d-sm-block baslik">id</div>
                <div class="col-sm-4 d-none d-sm-block baslik">Yapılacak</div>
                <div class="col-sm-2 d-none d-sm-block baslik">Başlangıç</div>
                <div class="col-sm-2 d-none d-sm-block baslik">Öncelik</div>
                <div class="col-sm-2 d-none d-sm-block baslik">İşlemler</div>
            </div>

            <hr>

            <?php foreach ($yapilanlar as $key => $veri ): ?>
                <div class="row">
                    <div class="col-sm-1 icerik "> <span class="d-inline-block d-sm-none spanler">No: </span> <span class="font-weight-bolder"> <?php echo ($key + 1); ?></span> </div>
                    <div class="col-sm-1 icerik"> <span class="d-inline-block d-sm-none spanler">id: </span> <?php echo $veri->id; ?> </div>
                    <div class="col-sm-4 icerik"> <span class="d-inline-block d-sm-none spanler">Yapılacak: </span> <?php echo $veri->todoName; ?> </div>
                    <div class="col-sm-2 icerik"> <span class="d-inline-block d-sm-none spanler">Tarih: </span> <?php echo $veri->creationDate; ?> </div>
                    <div class="col-sm-2 icerik"> <span class="d-inline-block d-sm-none spanler">Öncelik: </span> <?php echo onemDerecesi($veri->priority); ?> </div>
                    <div class="col-sm-2 icerik"> <span class="d-inline-block d-sm-none spanler">İşlemler: </span>   <a href="index.php?islem=done&id=<?php echo $veri->id; ?>" class="mr-2 text-success"><i class="fas fa-check"></i></a>  <a href="index.php?islem=sil&id=<?php echo $veri->id; ?>" class="text-danger"><i class="fas fa-times"></i></a></div>
                </div>
            <hr>
            <?php endforeach; ?>
        </div>




        <!-- Yapılanlar Bölümü-->
        <div class="col-lg-6 yapilanlar">
            <h4 class="text-center mb-4">Yapılanlar</h4>
            <div class="row ">
                <div class="col-sm-1 d-none d-sm-block baslik">No</div>
                <div class="col-sm-3 d-none d-sm-block baslik">Yapılacak</div>
                <div class="col-sm-2 d-none d-sm-block baslik">Başlangıç</div>
                <div class="col-sm-2 d-none d-sm-block baslik">Bitiş</div>
                <div class="col-sm-2 d-none d-sm-block baslik">Öncelik</div>
                <div class="col-sm-2 d-none d-sm-block baslik">İşlem</div>
            </div>

            <hr>

            <?php foreach ($yapilmislar as $key => $veri ): ?>
                <div class="row text-success">
                    <div class="col-sm-1 icerik"> <span class="d-inline-block d-sm-none spanler">No: </span> <span class="font-weight-bolder"> <?php echo ($key + 1); ?></span> </div>
                    <div class="col-sm-3 icerik"> <span class="d-inline-block d-sm-none spanler">Yapılacak: </span> <?php echo $veri->todoName; ?> </div>
                    <div class="col-sm-2 icerik"> <span class="d-inline-block d-sm-none spanler">Tarih: </span> <?php echo $veri->creationDate; ?> </div>
                    <div class="col-sm-2 icerik"> <span class="d-inline-block d-sm-none spanler">Tarih: </span> <?php echo $veri->completionDate; ?> </div>
                    <div class="col-sm-2 icerik"> <span class="d-inline-block d-sm-none spanler">Öncelik: </span> <?php echo onemDerecesi($veri->priority); ?> </div>
                    <div class="col-sm-2 icerik"> <span class="d-inline-block d-sm-none spanler">İşlemler: </span> <a href="index.php?islem=sil&id=<?php echo $veri->id; ?>" class="text-danger"><i class="fas fa-times"></i></a></div>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>


</div>

</body>
</html>