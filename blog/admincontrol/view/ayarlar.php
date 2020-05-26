<?php

if (!isset($_SESSION["kadi"])){
    echo "Session Sorunu <br> Çıkartılıyorsun..";
    header("refresh:2;url=../index.php");
}else{ ?>

    <?php include "header.php"?>



    <div class="container">
        <div class="row">



            <!--    Kullanıcı Bilgileri Alanı  -->
            <div class="col-lg-8">
                <form action="usage_database/changeUserInfos.php?islem=bilgiler" method="post" id="formLeft" class="settingForms">

                    <div style="text-align: right;">
                        <h5 id="addTextTitle">Kullanıcı Bilgileri</h5>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2">Kullanıcı Id</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" name="userId" value="<?php echo $userInfo->id; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-6">Kullanıcı Adı</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="userName" value="<?php echo $userInfo->user_name; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-6">E-posta Adresi</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control"  name="email" value="<?php echo $userInfo->email; ?>" required>
                        </div>
                    </div>

                    <div class="form-group ml-3">
                        <label for="">Şifre</label>
                        <div class="form-row" >
                            <div class="form-group col-sm-6">
                                <input type="password" class="form-control" readonly placeholder="***********">
                            </div>
                            <div class="form-group col-md-2">
                                <button id="changePassword" class="btn btn-warning form-control">Şifre Değiştir</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-6">Hakkımda</label>
                        <div class="col-sm-12">
                            <textarea class="form-control"  name="hakkimda" rows="10" style="font-size:12px;"><?php echo $userInfo->hakkimda; ?></textarea>
                        </div>
                    </div>

                    <div class="col-auto text-right">
                        <button type="reset" class="btn btn-secondary form-control col-sm-2"> Reset </button>
                        <button type="submit" class="btn btn-success form-control col-sm-2">Kaydet</button>
                    </div>


                </form>
            </div>



            <!--    Şifre Değişim Alanı  -->
            <div class="col-lg-4">
                <form action="usage_database/changeUserInfos.php?islem=sifre" method="post"  id="formRight" class="settingForms">

                    <div style="text-align: right;">
                        <h5 id="addTextTitle">Şifre Değişimi</h5>
                    </div>

                    <input type="hidden" class="form-control form-control-sm" name="userId" value="<?php echo $userInfo->id; ?>" readonly>

                    <div class="form-group">
                        <label for="" class="col-sm-6">Eski Şifre</label>
                        <div class="col-sm-10">
                            <input type="password"  name="eskiSifre" class="form-control" minlength="3" maxlength="10" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-6">Yeni Şifre</label>
                        <div class="col-sm-10">
                            <input type="password"  name="yeniSifre" class="form-control" minlength="3" maxlength="10" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-6">Yeni Şifre Tekrar</label>
                        <div class="col-sm-10">
                            <input type="password"  name="yeniSifreIki" class="form-control"  minlength="3" maxlength="10" required>
                            <small id="passwordHelpInline" class="text-muted">
                                Şifre Max. 10 Karekter Olmalı
                            </small>
                        </div>
                    </div>

                    <div class="col-auto">
                        <button type="reset" class="btn btn-secondary form-control col-sm-4"> Reset </button>
                        <button type="submit" class="btn btn-success form-control col-sm-4">Kaydet</button>
                    </div>

                </form>
            </div>





            <?php if($_SESSION["yetki"] == "1"): ?>

                <!--    Site Başıkları  -->
                <div class="col-lg-8 mt-3">
                    <form action="usage_database/changeSiteTitles.php" method="post" class="settingForms">

                        <div style="text-align: right;">
                            <h5 id="addTextTitle">Site Başlıkları</h5>
                        </div>

                        <div class="form-group">
                            <label for="">Ana Başlık</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $siteTitles->home_title; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="">Alt Başlık</label>
                            <input type="text" class="form-control" name="subtitle" value="<?php echo $siteTitles->home_subtitle; ?>" required>
                        </div>

                        <div class="col-auto text-right">
                            <button type="reset" class="btn btn-secondary form-control col-sm-2"> Reset </button>
                            <button type="submit" class="btn btn-success form-control col-sm-2">Kaydet</button>
                        </div>


                    </form>
                </div>

            <?php endif; ?>



        </div> <!-- first .row -->
    </div>








    <?php include "footer.php"?>

<?php } ?>
