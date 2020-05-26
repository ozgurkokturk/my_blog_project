<?php
/* *** TARİH FORMATLARINI TÜRKÇELEŞTİRMEK İÇİN *** */
function turkcetarih_formati($format, $datetime = 'now'){
    $z = date("$format", strtotime($datetime));
    $gun_dizi = array(
        'Monday'    => 'Pazartesi',
        'Tuesday'   => 'Salı',
        'Wednesday' => 'Çarşamba',
        'Thursday'  => 'Perşembe',
        'Friday'    => 'Cuma',
        'Saturday'  => 'Cumartesi',
        'Sunday'    => 'Pazar',
        'January'   => 'Ocak',
        'February'  => 'Şubat',
        'March'     => 'Mart',
        'April'     => 'Nisan',
        'May'       => 'Mayıs',
        'June'      => 'Haziran',
        'July'      => 'Temmuz',
        'August'    => 'Ağustos',
        'September' => 'Eylül',
        'October'   => 'Ekim',
        'November'  => 'Kasım',
        'December'  => 'Aralık',
        'Mon'       => 'Pts',
        'Tue'       => 'Sal',
        'Wed'       => 'Çar',
        'Thu'       => 'Per',
        'Fri'       => 'Cum',
        'Sat'       => 'Cts',
        'Sun'       => 'Paz',
        'Jan'       => 'Oca',
        'Feb'       => 'Şub',
        'Mar'       => 'Mar',
        'Apr'       => 'Nis',
        'Jun'       => 'Haz',
        'Jul'       => 'Tem',
        'Aug'       => 'Ağu',
        'Sep'       => 'Eyl',
        'Oct'       => 'Eki',
        'Nov'       => 'Kas',
        'Dec'       => 'Ara',
    );
    foreach($gun_dizi as $en => $tr){
        $z = str_replace($en, $tr, $z);
    }
    if(strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
    return $z;
}


/* *** ETİKETLER İÇİN *** */

function etiketDuzenle($labels){
    $labels = explode(",",$labels);
    return $labels;
}






/* *** SAYAÇ İÇİN *** */
function counter($pageId){
    global $db;

    // bu sayfada yer alan fonksiyon aşağıda
    $cihaz = isMobileDevice();

    // tarayıcı ve platform bilgilerini aldık
    $bilgiler = getBrowser();
    $tarayıcı = $bilgiler['name'];
    $sistem =  $bilgiler['platform'];

//    $visitorIp = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
    $visitorIp = $_SERVER["REMOTE_ADDR"];
    $currentPage = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    $pageId = htmlspecialchars(trim($pageId));

//    $checingQuery = "SELECT * FROM blog_counter where visitor_ip = ? and content_id = ?";
//    $check = $db->prepare($checingQuery);
//    $check->execute(array($visitorIp,$pageId));

    // Eğer bu ip ile bu sayfaya daha önce girilmemiş ise sayaça ekle
//    if($check->rowCount() <= 0){

        $query = "INSERT INTO blog_counter (visitor_ip, device, browser, system, current_page, content_id) VALUES (:visitor_ip, :device, :browser, :system, :current_page, :content_id)";
        $insertVisitor = $db->prepare($query);
        $values = array(
            ":visitor_ip" => $visitorIp,
            ":device" => $cihaz,
            ":browser" => $tarayıcı,
            ":system" => $sistem,
            ":current_page" => $currentPage,
            ":content_id" => $pageId
        );
//        $insertVisitor->execute($values);
        if (!$insertVisitor->execute($values)){
            echo "visitor count issue";
        }


//    }
/*
 *  -1 ana sayfa görüntülenmesini
 *  -2 ise hakkımda sayfasının görüntülenmesini ifade eder.
 */


}
// Kullandığı browser ve platformu alır
function getBrowser() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
        $bname = 'internet explorer';
        $ub = "MSIE";
    }elseif(preg_match('/Firefox/i',$u_agent)){
        $bname = 'mozilla firefox';
        $ub = "Firefox";
    }elseif(preg_match('/OPR/i',$u_agent)){
        $bname = 'opera';
        $ub = "Opera";
    }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
        $bname = 'google chrome';
        $ub = "Chrome";
    }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
        $bname = 'apple safari';
        $ub = "Safari";
    }elseif(preg_match('/Netscape/i',$u_agent)){
        $bname = 'netscape';
        $ub = "Netscape";
    }elseif(preg_match('/Edge/i',$u_agent)){
        $bname = 'edge';
        $ub = "Edge";
    }elseif(preg_match('/Trident/i',$u_agent)){
        $bname = 'internet explorer';
        $ub = "MSIE";
    }

    return array(
        'name'      => $bname,
        'platform'  => $platform
    );
}

// Cihazın pc mi yoksa tel mi olduğunu anlıyoruz
function isMobileDevice(){
    $cihaz = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);

    if ($cihaz) {
        $cihaz = "mobile";
    }else {
        $cihaz =   "desktop";
    }
//    echo $cihaz;
    return $cihaz;
}
