<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../assets/bootstrap.css">
    <link rel="stylesheet" href="admin_assets/admin.css">

    <!--    cdn aktif-->
    <script src="https://kit.fontawesome.com/19bd3d963f.js" crossorigin="anonymous"></script>

    <script src="admin_assets/js/jquery-3.4.1.min.js"></script>
    <script src="admin_assets/js/jquery.growl.js"></script>
    <link rel="stylesheet" href="admin_assets/jquery.growl.css">



    <!--ckeditor-->
    <script src="../ckeditor/ckeditor.js"></script>
    <link href="../ckeditor/plugins/codesnippet/lib/highlight/styles/tomorrow-night.css" rel="stylesheet">
    <script src="../ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js"></script>


    <!-- highcharts istatistikler-->
    <script src="istatistik_sayfalari/code/highcharts.js"></script>
    <script src="istatistik_sayfalari/code/modules/exporting.js"></script>
    <script src="istatistik_sayfalari/code/themes/sand-signika.js"></script>

    <!--datepicker-->
    <script src="../datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="../datepicker/locales/bootstrap-datepicker.tr.min.js"></script>
    <link href="../datepicker/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet">


    <!--Benim JSlerim-->
    <script src="ajaxes/category.js"></script>
    <script src="ajaxes/deleteContent.js"></script>
    <script src="ajaxes/add_new_content.js"></script>
    <script src="ajaxes/deleteWithCheckbox.js"></script>
    <script src="ajaxes/pagination.js"></script>
    <script src="ajaxes/settings.js"></script>




    <title>Control-Panel</title>
</head>
<body>

<nav class="nav" id="nav-top">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4 text-md-left text-center">
                <a href="index.php">
                    <i id="header-icon" class="fas fa-user-cog"></i>
                    <span id="header-text">Admin Panel</span>
                </a>
            </div>

            <div class="col-md-8   text-md-right text-center" id="header-exit">
                <span id="header-user"> <?php echo $_SESSION["kadi"]; ?></span>
                <a href="index.php?url=cikis">
                    <i class="fas fa-power-off"></i>
                    <span>Çıkış Yap</span>
                </a>
            </div>

        </div>
    </div>
</nav>




<div id="hiddenBarDiv">
    <a id="hiddenBarIcon" href=""><i class="fas fa-bars"></i></a>
    <script>
        $("#hiddenBarIcon").on("click",function (e) {
            // $("#dropdownMenu").css("display","block");
            $("#nav-left").toggle("slow");
            e.preventDefault();
        });
    </script>
</div>



<nav class="nav" id="nav-left">
<ul class="nav-ul">
    <li>
        <a href="index.php">
            <i id="nav-left-icon" class="fas fa-home"></i>
            Ana Sayfa
        </a>
    </li>
    <li>
        <a href="index.php?url=ekle">
            <i id="nav-left-icon" class="fas fa-plus-square"></i>
            Yeni Yazı Ekle
        </a
    </li>
    <li>
        <a href="index.php?url=kategori">
            <i id="nav-left-icon" class="fas fa-book-open"></i>
            Kategoriler
        </a>
    </li>
<!--    <li>-->
<!--        <a href="">-->
<!--            <i id="nav-left-icon" class="fas fa-folder-open"></i>-->
<!--            Dosyalar-->
<!--        </a>-->
<!--    </li>-->
    <li>


        <a id="dropdownHead" href="">
            <i id="nav-left-icon" class="far fa-chart-bar"></i>
            İstatistikler
            <span style="margin-left:15px; font-size: 15px;"><i class="fas fa-angle-down"></i></span>
        </a>
                <ul id="dropdownMenu">
                    <li>
                        <a href="index.php?url=istatistik&tip=1">+ Yıllık Ziyaretçi Sayısı</a>
                        <a href="index.php?url=istatistik&tip=2">+ En Çok Okunan Sayf.</a>
                        <a href="index.php?url=istatistik&tip=3">+ Ziyaretçi Bilgileri</a>
                    </li>
                </ul>
        <script>
            $("#dropdownHead").on("click",function (e) {
                // $("#dropdownMenu").css("display","block");
                $("#dropdownMenu").toggle("slow");
                e.preventDefault();
            });
        </script>


    </li>
    <li>
        <a href="index.php?url=ayarlar">
            <i id="nav-left-icon" class="fas fa-users-cog"></i>
            Ayarlar
        </a>
    </li>
</ul>
</nav>


