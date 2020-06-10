<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JQuery File Uploader</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>    <script src="ajax_file_uploader.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <script src="http://malsup.github.com/jquery.form.js"></script>

</head>
<body>


<h2>Php ile Resim Kırpma (Thumbnail oluşturma) Demosu</h2>
<h5>Fotoğrafı seçip genişlik ve yükseklik belirtin</h5>
<small> Sadece jpeg formatı kabul edilir</small>
<hr />
<form action="upload.php" method="post" id="myForm" enctype="multipart/form-data">
    <input type="text" name="dosyaAdi" id="dosya" placeholder="Dosyanın yeni adı" required maxlength="15">
    <input type="number" name="inputWidth" size="5" placeholder="width..." required max="800">
    <input type="number" name="inputHeight" size="5" placeholder="height..." required max="800">
    <input type="file" name="dosya" id="dosyaSec" required/> <br><br>
    <input type="submit" name="sendFile" value="Yükle" />
</form>
<br> <br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <!--    Progress Bar-->
            <div class="progress" style="display: none;">
                <div class="progress-bar progress-bar-striped" role="progressbar">
                </div>
            </div>
            <!--    ../ Progress Bar-->
        </div>
    </div>
</div>

<div class="container-fluid mt-5">
    <div class="row">
        <div id="myDiv1" class="col-md-4">

        </div>
        <div id="myDiv2" class="col-md-8">

        </div>
    </div>

    <hr>

    <div class="row">
        <div id="myDiv3" class="col-md-4">

        </div>
        <div id="myDiv4" class="col-md-8">

        </div>
    </div>

</div>
<br>


</body>
</html>


