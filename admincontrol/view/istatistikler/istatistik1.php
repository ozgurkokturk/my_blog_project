
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

                <form action="istatistik_sayfalari/istatistik1.php" method="post">
                    <label for="">Yıllara Göre Ay Ay Ziyaretçi Sayıları</label>
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
                                    // diziyi tersine çevirdik son yıl en yukarda gelsin diye
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
                                        "1" => "Toplam Ziyaretçi Sayısı",
                                        "2" => "Ana Sayfa ve Hakkımda Sayfaları"
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


                <!--   Bu Div olmazsa olmaz !   -->
                <div id="kapsul1" style="width: 100%; height: 400px;margin-top: 50px;"></div>

                <?php
                    // Yıllara Göre Toplam Ziyaretçi Sayısı
                    if (isset($_GET["veriler"],$_GET["aylar"],$_GET["year"])  && $_GET["secim"] =="1" ):
                        $veriler = json_decode($_GET["veriler"]);
                        $aylar = $_GET["aylar"];
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
                                        text: '<?php echo $year; ?>  -  Aylara Göre Ziyaretçi Sayısı'
                                    },
                                    xAxis: {
                                        // categories: ['ocak', 'şubat', 'mart', 'nisan', 'mayıs', 'haziran']
                                        categories: <?php echo $aylar; ?>

                                    },
                                    yAxis: {
                                        title: {
                                            text: 'Ziyaretçi Sayısı'
                                        }
                                    },
                                    series: [{
                                        name: 'Aylar',
                                        // data: [500, 100, 700, 300, 800, 100, 320]
                                        data:  [ <?php
                                            for($i = 0; $i < sizeof($veriler); $i++){
                                                echo $veriler[$i];
                                                if($i != sizeof($veriler)-1){
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



                <?php
                // Yıllara Göre Toplam Ziyaretçi Sayısı
                if (isset($_GET["veriler"],$_GET["title"],$_GET["year"])  && $_GET["secim"] =="2" ):
                    $veriler = json_decode($_GET["veriler"]);
                    $specialPagesTitle = $_GET["title"];
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
                                    text: '<?php echo $year; ?>  -  Ana Sayfa ve Hakkımda Sayfası'
                                },
                                xAxis: {
                                    // categories: ['anasayfa','hakkimda']
                                    categories: <?php echo $specialPagesTitle; ?>

                                },
                                yAxis: {
                                    title: {
                                        text: 'Ziyaretçi Sayısı'
                                    }
                                },
                                series: [{
                                    name: 'Özel Sayfalar',
                                    // data: [500, 100]
                                    data:  [ <?php
                                        for($i = 0; $i < sizeof($veriler); $i++){
                                            echo $veriler[$i];
                                            if($i != sizeof($veriler)-1){
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