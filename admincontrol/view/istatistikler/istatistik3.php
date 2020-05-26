
<?php

if (!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION["kadi"])){
    echo "Session Sorunu <br> Çıkartılıyorsun..";
    header("refresh:2;url=../index.php");
}else{ ?>

<?php include "view/header.php"; ?>



    <div class="container">
        <div class="row">

            <div class="col-lg-10 offset-1">

                <form action="istatistik_sayfalari/istatistik3.php" method="post">
                    <label for="">Ziyaretçilerin Siteye Bağlandıkları Cihaz Bilgileri</label>
                        <div class="form-row">

                            <div class="col-lg-2">
                                <select name="selectYear" class="form-control">
                                    <?php
                                    // Başlangıç tarihinden geri kalanları otomatik oluşuturup
                                    // Selectlere ekledim
                                    $currentYear = date('Y');
                                    $years = array(2018);
                                    $fark = $currentYear - $years[0];
                                    for ($i=0; $i < $fark; $i++){
                                        $years[] = ($i+1 + $years[0]);
                                    }
                                    // diziyi tersine çeviriyoruz son yıl en yukarda gelsin diye
                                    $years = array_reverse($years,false);
                                    foreach ($years as $year):
                                        if(isset($_GET["year"]) && $_GET["year"] == $year): ?>
                                            <option selected value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php  else: ?>
                                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endif;
                                    endforeach;  ?>
                                </select>
                            </div>

                            <div class="col-lg-8">
                                <select name="selectIstatistik" id="" class="form-control">
                                    <?php
                                        $secenekler = array(
                                            "1" => "Ziyaretçilerin Cihazları",
                                            "2" => "Ziyaretçilerin Tarayıcıları",
                                            "3" =>  "Ziyaretçilerin İşletim Sistemleri"
                                        );
                                        foreach ($secenekler as $val => $secenek):
                                            if(isset($_GET["secim"]) && $_GET["secim"] == $val ):?>
                                                <option selected value="<?php echo $val ?>"> <?php echo $secenek ?> </option>
                                            <?php else: ?>
                                                <option value="<?php echo $val ?>"> <?php echo $secenek ?> </option>
                                            <?php endif;
                                        endforeach;  ?>
                                </select>
                            </div>

                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary form-control">Göster</button>
                            </div>
                        </div>
                </form>




                <!-- Cihaz Bilgilerine Göre-->
                <div id="kapsul1" style="width: 100%; height: 400px;margin-top: 50px;"></div>

                <?php
                    if (isset($_GET["secim"],$_GET["cihazlar"],$_GET["sayilar"],$_GET["year"]) && $_GET["secim"] =="1" ):
                        $cihazTitle = $_GET["cihazlar"];
                        $cihazNumbers = json_decode($_GET["sayilar"]);
                        $year = $_GET["year"];
                ?>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var myChart = Highcharts.chart('kapsul1', {
                                    data: {
                                        table: 'datatable'
                                    },
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: '<?php echo $year; ?> - Ziyaretçilerin Cihaz Bilgileri'
                                    },
                                    xAxis: {
                                         // categories: ['Desktop' , 'mobile']
                                        categories: <?php echo $cihazTitle; ?>

                                    },
                                    yAxis: {
                                        title: {
                                            text: 'Ziyaretçi Sayısı'
                                        }
                                    },
                                    series: [{
                                        name: 'Cihazlar',
                                         // data: [500, 1500]
                                        data:  [ <?php
                                            for($i = 0; $i < sizeof($cihazNumbers); $i++){
                                                echo $cihazNumbers[$i];
                                                if($i != sizeof($cihazNumbers)-1){
                                                    echo ",";
                                                }
                                            } ?>
                                        ]

                                    }]
                                });
                            });

                        </script>
                 <?php
                    endif;
                 ?>



                <!-- Tarayıcı Bilgilerine Göre-->
                <?php
                if (isset($_GET["secim"],$_GET["tarayicilar"],$_GET["sayilar"],$_GET["year"]) && $_GET["secim"] =="2" ):
                    $tarayıcıTitle = $_GET["tarayicilar"];
                    $tarayıcıNumbers = json_decode($_GET["sayilar"]);
                    $year = $_GET["year"];

                    ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var myChart = Highcharts.chart('kapsul1', {
                                data: {
                                    table: 'datatable'
                                },
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: '<?php echo $year; ?> - Ziyaretçilerin Tarayıcı Bilgileri'
                                },
                                xAxis: {
                                    // categories: ['goole chrome' , 'safari']
                                    categories: <?php echo $tarayıcıTitle; ?>

                                },
                                yAxis: {
                                    title: {
                                        text: 'Ziyaretçi Sayısı'
                                    }
                                },
                                series: [{
                                    name: 'Tarayıcılar',
                                    // data: [500, 100]
                                    data:  [ <?php
                                        for($i = 0; $i < sizeof($tarayıcıNumbers); $i++){
                                            echo $tarayıcıNumbers[$i];
                                            if($i != sizeof($tarayıcıNumbers)-1){
                                                echo ",";
                                            }
                                        } ?>
                                    ]

                                }]
                            });
                        });

                    </script>
                <?php
                endif;
                ?>




                <!-- İşletim Sistemi Bilgilerine Göre-->
                <?php
                if (isset($_GET["secim"],$_GET["sistemler"],$_GET["sayilar"],$_GET["year"]) && $_GET["secim"] =="3" ):
                    $sistemTitle = $_GET["sistemler"];
                    $sistemNumbers = json_decode($_GET["sayilar"]);
                    $year = $_GET["year"];

                    ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var myChart = Highcharts.chart('kapsul1', {
                                data: {
                                    table: 'datatable'
                                },
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: '<?php echo $year; ?> - Ziyaretçilerin Tarayıcı Bilgileri'
                                },
                                xAxis: {
                                    // categories: ['goole chrome' , 'safari']
                                    categories: <?php echo $sistemTitle; ?>

                                },
                                yAxis: {
                                    title: {
                                        text: 'Ziyaretçi Sayısı'
                                    }
                                },
                                series: [{
                                    name: 'Sistemler',
                                    // data: [500, 100]
                                    data:  [ <?php
                                        for($i = 0; $i < sizeof($sistemNumbers); $i++){
                                            echo $sistemNumbers[$i];
                                            if($i != sizeof($sistemNumbers)-1){
                                                echo ",";
                                            }
                                        } ?>
                                    ]

                                }]
                            });
                        });

                    </script>
                <?php
                endif;
                ?>










            </div>

        </div>
    </div>





    <?php include "view/footer.php"; ?>

<?php } ?>


<!--// document.addEventListener('DOMContentLoaded', function () {-->
<!--//     var myChart = Highcharts.chart('kapsul', {-->
<!--//         title: {-->
<!--//             text: 'Aylar Göre Toplam Ziyaretçi Sayısı (Son 12 Ay)'-->
<!--//         },-->
<!--//         xAxis: {-->
<!--//             categories: ['ocak', 'şubat', 'mart', 'nisan', 'mayıs', 'haziran']-->
<!--//         },-->
<!--//         yAxis: {-->
<!--//             title: {-->
<!--//                 text: 'Ziyaretçi Sayısı'-->
<!--//             }-->
<!--//         },-->
<!--//         series: [{-->
<!--//             name: 'Aylar',-->
<!--//             data: [500, 490, 700, 600, 800, 750]-->
<!--//         }]-->
<!--//     });-->
<!--// });-->