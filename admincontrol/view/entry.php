<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="admin_assets/admin_entry.css">

    <script src="https://kit.fontawesome.com/19bd3d963f.js" crossorigin="anonymous"></script>
    <title>Shhhh</title>

    <script src="admin_assets/js/jquery-3.4.1.min.js"></script>
    <script src="admin_assets/js/jquery.growl.js"></script>
    <link rel="stylesheet" href="admin_assets/jquery.growl.css">

    <script src="ajaxes/entry.js"></script>



</head>
<body>

<div class="mother">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">

                <form action="usage_database/entry.php" method="POST" id="entryForm">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kullanıcı Adı: </label>
                        <input class="form-control" id="exampleInputEmail1" type="email" name="kadi" placeholder="Ad" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Şifre: </label>
                        <input class="form-control" id="exampleInputPassword1" type="password" name="sfr" required placeholder="Şifre" >
                    </div>

                    <div class="form-group ml-0">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <img src="captcha.php">
                            </div>
                            <div class="form-group col-sm-8">
                                <input type="text" name="control" class="form-control" placeholder="Güvenlik kodu" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="buton">
                        <button class="btn btn-secondary" id="entryBtn" type="submit">Go!</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


</body>
</html>

