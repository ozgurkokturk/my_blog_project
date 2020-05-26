<?php

if (!isset($_SESSION["kadi"])){
    echo "Session Sorunu <br> Çıkartılıyorsun..";
    header("refresh:2;url=../index.php");
}else{ ?>

    <?php include "header.php"?>





<div class="container">
    <div class="row">

        <div class="col-lg-5 kategori-divleri-sol">

            <div class="row">

                <div class="col-lg-12">
                    <form action="usage_database/category.php" id="kategoriEkle" method="post">
                        <div class="form-group">
                            <label for="">Yeni Kategori Ekle</label>
                            <input type="text" name="categoryName" class="form-control" id="inputKategori" placeholder="Kategori Ekle" required>
                        </div>
                        <div class="col-auto text-right">
                            <button type="submit" name="addCategory" class="btn btn-success">Ekle</button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-12">
                    <form action="usage_database/category.php" id="kategoriIslemler"  method="post">
                        <div class="form-group">
                            <label for="">Kategori İşlemleri</label>
                            <select id="sectionKategori" class="form-control" name="selectedCategory">
                                <option value="0" selected>Seç</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option data-id="<?php echo $category->id; ?>" value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
                                <?php } ?>
                            </select>
                            <span id="updateWarningSpan" style="display: none; font-size: 12px; color:darkred; font-weight: 600;">Lütfen Kategori Seçin!</span>
                            <div class="updateCategoryDiv">
                                <label id="updateLabel">Kategori Adını Düzenele</label>
                                <input type="text" id="updateCategoryText" class="form-control"  required>
                            </div>
                        </div>
                        <div class="col-auto text-right mt-5">
                            <button type="reset" name="resetCategory" class="btn btn-secondary"> Reset </button>
                            <button type="button" name="deleteCategory" class="btn btn-danger ">Sil</button>
                            <button type="submit" name="updateCategory" class="btn btn-primary ">Düzenle</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>


        <div class="col-lg-7 kategori-divleri-sag">
                <div class="row">

                    <div class="col-lg-7">
                        <ul class="kategori-list">
                            <h5 class="text-center m-2">Kategori Listesi</h5>

                            <?php foreach ($counts as $count) { ?>
                                <b><li  data-id="<?php echo $count->categoryId; ?>" > <?php echo $count->title; ?>  <span>(<?php echo $count->categoryCount; ?>)</span></li></b>
                                <?php
                                    $pages = showContentFromCategoryId($db, $count->categoryId);
                                    foreach ($pages as $page){
                                ?>
                                        <ul>
                                            <li>
                                                <?php  echo mb_convert_case($page->title, MB_CASE_TITLE, "UTF-8"); ?>
                                            </li>
                                        </ul>

                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="col-lg-5">
                        <ul class="kategori-list" id="kategori-list">
                            <h5 class="text-center m-2">Boş Kategoriler</h5>

                            <?php foreach ($notCategories as $not) { ?>
                                <li data-id="<?php echo $not->id; ?>"><b> <?php echo $not->title; ?> </b></li>
                            <?php } ?>
                        </ul>
                    </div>


                </div>
        </div>


    </div> <!-- first .row -->
</div>



    <?php include "footer.php"?>

<?php } ?>
