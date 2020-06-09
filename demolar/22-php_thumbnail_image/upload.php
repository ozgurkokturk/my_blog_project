<?php


include "fonksiyonlar.php";

if (isset($_FILES["dosya"])){

    if (!file_exists("dosyalar")){
        mkdir("dosyalar");
    }else{
        // dosyalar direction'ı zaten varsa içersinideki dosya sayısı 5 ten büyükse sil hepsini
        $icerisi = glob("dosyalar/*");
        if (sizeof($icerisi) >= 5){
            array_map('unlink', glob("dosyalar/*.*"));
        }
    }

//    echo "<pre>";
//    print_r($_POST);
//    print_r($_FILES["dosya"]);
//    echo "</pre>";





    // İzin verilecek dosya türleri
    // Diğer türlerde bazen sorun çıkıyor fotoğraftan kaynaklı
    $izinVeriFormatlar = array(
        "image/jpeg"
    );


    // Dosyanın tipi: image/jpeg
    $type = $_FILES["dosya"]["type"];

    // Değer izin verilen formatlar ARRAY'inde yoksa gelen tür, o  zaman durdur
    if (!in_array($type,$izinVeriFormatlar)){
        $response = array("bilgilerEski" => "hata var dosya türü geçersiz <br> sadece jpg, jpeg");
        echo json_encode($response);
        die();
    }
    else{

        // Inputlar
        $inputWidth = htmlspecialchars($_POST["inputWidth"]);
        $inputHeight = htmlspecialchars($_POST["inputHeight"]);
        $dosyaAdi = ozelKarakterTemizle(turkcelestir(htmlspecialchars($_POST["dosyaAdi"])));



        // Dosyanın boyutu:  ... byte
        $currentSize = $_FILES["dosya"]["size"];
        $currentSize = round($currentSize / 1024);



        // Doysayın tam adı: asddsaasd.jpg
        $fullName = ozelKarakterTemizle(turkcelestir($_FILES["dosya"]["name"]));



        // Dosyanın uzantısını al
        $explodedName = explode(".", $fullName);
        $extension = end($explodedName);

        // Dosyanın local'de aktarıldığı yer: C:\wamp64\tmp\php329F.tmp
        $getFile = $_FILES["dosya"]["tmp_name"];

        // Dosyanın taşınacağı yer
        if (move_uploaded_file($getFile, strtolower('dosyalar/'. $fullName))){


            /* --- KIRPMA İŞLEMİ BAŞLAR... ---*/

                // Taşınan dosyayı al
                $image = imagecreatefromjpeg('dosyalar/'.$fullName);


                // Yeni oluşacak dosyanın kaydedileceği yer
                $filename = 'dosyalar/'.$dosyaAdi.'.'.$extension;

                // Inputlardan girilen değerler
                $thumb_width = $inputWidth;
                $thumb_height = $inputHeight;


                $width = imagesx($image);
                $height = imagesy($image);

                $original_aspect = $width / $height;
                $thumb_aspect = $thumb_width / $thumb_height;

                if ( $original_aspect >= $thumb_aspect )
                {
                    // If image is wider than thumbnail (in aspect ratio sense)
                    $new_height = $thumb_height;
                    $new_width = $width / ($height / $thumb_height);
                }
                else
                {
                    // If the thumbnail is wider than the image
                    $new_width = $thumb_width;
                    $new_height = $height / ($width / $thumb_width);
                }

                // Boş bir resim alanı oluşturuyoruz
                // Yeni oluşacak genişliklerdeki resmi $thumb'a basıcaz.
                $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );


                // Yeniden boyutlandırma ve kırpma işlemi
                imagecopyresampled($thumb,
                    $image,
                    0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                    0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                    0,
                    0,
                    $new_width,
                    $new_height,
                    $width,
                    $height);


                // Oluşan yeni dosyayı jpeg olarak sunar
                imagejpeg($thumb, $filename, 80);

            /* --- KIRPMA İŞLEMİ BİTER... --- */




            // Yeni image dosya boyutunu al
            $newImageSize = filesize("dosyalar/" .$dosyaAdi. ".".$extension);
            $newImageSize = round($newImageSize / 1024);




            $bilgilEski = "
            <h4>Orginal Fotoğraf Bilgileri</h4>
            <ul>
                <li><span class='font-weight-bold'>Orginal width:  </span>".$width."</li>
                <li><span class='font-weight-bold'>Orginal height: </span>".$height."</li>
                <li><span class='font-weight-bold'>Orjinal boyutu: </span>".$currentSize." kb</li>
              
            </ul>
            ";

            $bilgilerYeni = "
             <h4>Şimdiki Fotoğraf Bilgileri</h4>
             <ul>
                <li><span class='font-weight-bold'>Yeni width:  </span>".$thumb_width."</li>
                <li><span class='font-weight-bold'>Yeni height: </span>".$thumb_height."</li>
                <li><span class='font-weight-bold'>Yeni boyutu: </span>".$newImageSize." kb</li>
                  <a href='download.php?dosyaadi={$dosyaAdi}&extension={$extension}'>İndirmek İçin Tıkla</a>
            </ul>
            ";

            $yeiFoto =        "<img src='dosyalar/".$dosyaAdi. "." .$extension. "'>";
            $orginalFoto = "<img src='dosyalar/".$fullName."' width='".$inputWidth."' height='".$inputHeight."'>";

            $response = array(
                "bilgilerEski" => $bilgilEski,
                "orginalFoto" => $orginalFoto,
                "bilgilerYeni" => $bilgilerYeni,
                "yeniFoto" => $yeiFoto
            );

            echo json_encode($response);

        }
        else{
            echo "resim sunucuya yüklenemedi!";
        }

    }


}