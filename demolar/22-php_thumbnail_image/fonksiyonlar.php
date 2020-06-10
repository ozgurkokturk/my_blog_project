<?php


function turkcelestir($degisken){

    $değişken = trim($degisken);
    $bul	    = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', 'Ö', 'İ', 'Ü', '-');
    $degistir   = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'o', 'i', 'u', ' ');
    $sonuc      = strtolower(str_replace($bul, $degistir, $degisken));
    $sonuc      = str_replace(' ', '-', $sonuc);
    return $sonuc;
}


function ozelKarakterTemizle($veri)
{
    // Bütün boşlukları düz çizgi yap ve tüm harfleri küçült
    $veri = strtolower(str_replace(" ","-",$veri));

    // Regex (regular expression - düzenli ifadeler) kullanarak
    // bütün içeriğin sadece a-z arasında harflerden veya ramaklaradan oluşan kısımlarını al ve bir de nokta ise al
    $veri =  preg_replace('/[^a-z0-9-.\-]/', '-',$veri);


    // Düz çizgi ve artı ne kadar çok olursa olsun sadece bir düz çizgiye dönüştür
    return preg_replace('/-+/', '-', $veri);
}