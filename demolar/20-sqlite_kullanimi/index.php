<?php

try {

    $db = new PDO ('sqlite:mydatabase.db');

    $query1 = "SELECT * FROM todo_list where done = '0'";
    $yapilanlar = $db->query($query1);
    $yapilanlar = $yapilanlar->fetchAll(PDO::FETCH_OBJ);



    $query2 = "SELECT * FROM todo_list where done = '1'";
    $yapilmislar = $db->query($query2);
    $yapilmislar = $yapilmislar->fetchAll(PDO::FETCH_OBJ);


    if (isset($_POST["yapilacak"],$_POST["derece"]) && $_POST["yapilacak"] != "" && $_POST["derece"] != ""){

        $yapilacak = htmlspecialchars(trim($_POST["yapilacak"]));
        $derece = htmlspecialchars(trim($_POST["derece"]));
        $tarih = date("Y/m/d");

        // 20den fazla kayıt eklenmemesi için
        $query1 = "SELECT COUNT(id) as number FROM todo_list";
        $yapilanlar = $db->query($query1);
        $yapilanlar = $yapilanlar->fetch(PDO::FETCH_COLUMN);

        if($yapilanlar < 20){
            $query = "INSERT INTO todo_list (todoName, creationDate, priority, done) VALUES ('$yapilacak','$tarih' ,'$derece' , '0')";
            $ekle = $db->prepare($query);
            $ekle->execute();
            header("Location:index.php");
        }
        else{
            echo "20 den fazla kayıt eklenemez!";
            header("refresh:2;url=index.php");
            die();
        }
    }elseif (isset($_GET["islem"],$_GET["id"]) ){
        $id = htmlspecialchars(trim($_GET["id"]));
        $tarih = date("Y/m/d");

        if ($_GET["islem"] == "done"){
           $query = "UPDATE todo_list SET done = '1' , completionDate = '$tarih' where id = $id";
        }
        elseif ($_GET["islem"] == "sil"){
            $query = "DELETE FROM todo_list where id = $id";
        }

        $islem = $db->prepare($query);
        $islem->execute();
        header("Location:index.php");

    }







    $onemDereceleri = array(
        "1" => "Düşük",
        "2" => "Orta",
        "3" => "Yüksek"
    );

    function onemDerecesi($deger){
        global $onemDereceleri;
        if(array_key_exists($deger, $onemDereceleri)){
            return $onemDereceleri[$deger];
        }else{
            return null;
        }
        print_r($onemDereceleri);
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

    <title>TodoList</title>

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
            content: " ";
            background-color: #ddd;
            position: absolute;
            width: 1px;
            height: 100%;
            top: 10px;
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
                        <input type="text" class="form-control" name="yapilacak">
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



        <div class="col-lg-6 yapilanlar">
            <h4 class="text-center mb-4">Yapılanlar</h4>
            <div class="row ">
                <div class="col-sm-1 d-none d-sm-block baslik">No</div>
                <div class="col-sm-3 d-none d-sm-block baslik">Yapılacak</div>
                <div class="col-sm-2 d-none d-sm-block baslik">Başlangıç</div>
                <div class="col-sm-2 d-none d-sm-block baslik">Bitiş</div>
                <div class="col-sm-2 d-none d-sm-block baslik">Öncelik</div>
                <div class="col-sm-2 d-none d-sm-block baslik">İşlemler</div>
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