
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

                <form action="istatistik_sayfalari/istatistik2.php" method="post" autocomplete="off">
                    <label for="">İki Tarih Arasında En Çok Görüntülenen Sayfalar</label>
                        <div class="form-row">


                            <!-- Tarihler -->
                            <?php
                                // Eğer Tarih girilip submit olmuşsa o tarihi tekrar yazdır sıfırlanmasın
                            if(isset($_GET["firstDate"],$_GET["secondDate"])):  ?>
                                <div class="col-lg-2" style="font-size:10px !important;">
                                    <input type="text" class="form-control datepicker" value="<?php echo $_GET["firstDate"]; ?>" placeholder="2019/01/01" name="dateStart" required>
                                </div>
                                <span style="font-weight: 900; margin-top:5px;">-</span>
                                <div class="col-lg-2">
                                    <input type="text"  class="form-control datepicker" value="<?php echo $_GET["secondDate"]; ?>" placeholder="2020/01/01" name="dateFinish" required>
                                </div>
                            <?php  else: ?>
                                <div class="col-lg-2" style="font-size:10px !important;">
                                    <input type="text" class="form-control datepicker" placeholder="2019/01/01" name="dateStart" required>
                                </div>
                                <span style="font-weight: 900; margin-top:5px;">-</span>
                                <div class="col-lg-2">
                                    <input type="text"  class="form-control datepicker" placeholder="2020/01/01" name="dateFinish" required>
                                </div>
                            <?php  endif;  ?>



                            <div class="col-lg-4">
                                <select name="selectIstatistik" id="" class="form-control">
                                    <option value="1">En Çok Görüntülenen Sayfalar</option>
                                </select>
                            </div>


                            <!-- Limit Sayııs-->
                            <?php if(isset($_GET["limit"])): ?>
                                <div class="col-lg-1">
                                    <input type="text" class="form-control" name="pageLimit" value="<?php echo $_GET["limit"]; ?>" required>
                                </div>
                            <?php else: ?>
                                <div class="col-lg-1">
                                    <input type="text" class="form-control" name="pageLimit" value="5" required>
                                </div>
                            <?php endif; ?>



                            <div class="col-lg-2">
                                <button type="submit" id="gonder" class="btn btn-primary form-control">Göster</button>
                            </div>
                        </div>
                </form>


                <div id="kapsul1" style="width: 100%; height: 400px;margin-top: 50px;"></div>

                <?php
                    // Yıllara Göre Toplam Ziyaretçi Sayısı
                    if (isset($_GET["veriler"],$_GET["titles"],$_GET["limit"],$_GET["firstDate"],$_GET["secondDate"])):
                        $veriler = json_decode($_GET["veriler"]);
                        $pageTitles = $_GET["titles"];
                        $pageLimit = $_GET["limit"];

                        $firstDate = $_GET["firstDate"];
                        $secondDate = $_GET["secondDate"];
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
                                        text: '<?php  echo $firstDate. " - ". $secondDate. " Tarihlerine Ait En Çok Ziyaret Edilen " . $pageLimit; ?> Sayfa '
                                    },
                                    xAxis: {
                                        // categories: ['jquery Giriş', 'Merhaba Blog', 'Kıyıköy']
                                        // türkçe karakterler nasıl sorun çıkarmadı bilmiyorum :))
                                        categories:  <?php echo $pageTitles; ?>

                                    },
                                    yAxis: {
                                        title: {
                                            text: 'Ziyaretçi Sayısı'
                                        }
                                    },
                                    series: [{
                                        name: 'Sayfalar',
                                        // data: [900, 800, 700]
                                        data: [ <?php
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