<?php

if (!isset($_SESSION["kadi"])){
    echo "Session Sorunu <br> Çıkartılıyorsun..";
    header("refresh:2;url=../index.php");
}else{ ?>

    <?php include "view/header.php"?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-10 mb-5 addTextMotherDiv">
                <h4 id="addTextTitle">İçerik Düzenleme Alanı</h4>

                <form action="usage_database/updateContent.php" method="post">

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label ">Kategori:</label>
                        <div class="col-sm-4">
                            <select name="selectCategory" class="form-control">

                                <!-- Düzenlenen yazının kategorisini seçili getirmek için-->
                                <?php foreach ($categories as $category) {
                                    if($category->id == $content->category_id): ?>
                                        <option selected data-id="<?php echo $category->id ?>" value="<?php echo $category->id ?>"><?php echo $category->title ?></option>
                                    <?php else: ?>
                                    <option data-id="<?php echo $category->id ?>" value="<?php echo $category->id ?>"><?php echo $category->title ?></option>
                                <?php endif;
                                } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Başlık:</label>
                        <div class="col-sm-4">
                            <input type="text" name="titleContent"  class="form-control" maxlength="99" value="<?php echo $content->title; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">İçerik:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="textareaContent" id="textareaEditor">
                                <?php echo $content->text; ?>
                            </textarea>
                                <script>
                                    CKEDITOR.replace( 'textareaEditor', {
                                        extraPlugins: 'codesnippet',
                                        codeSnippet_theme: 'monokai_sublime'
                                        // filebrowserBrowseUrl : '../elFinder/elfinder-cke.html',
                                        // uiColor : '#9AB8F3'
                                    });
                                </script>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Etiketler:</label>
                        <div class="col-sm-8">
                            <input type="text" name="labelsContent" class="form-control" placeholder="Virgül ile kelimeleri ayırın!" value="<?php echo $content->labels; ?>" required>
                            <span class="infoSpan">Sayfanın en altında yer alan konuya ait öz kelimelerdir. Her kelimeden sonra virgül (,) koymayı unutmayın.</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Tarih:</label>
                        <div class="col-sm-3">
                            <input type="date" name="dateContent" class="form-control" value="<?php echo date('Y-m-d',strtotime($content->tarih)); ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label pt-0">Sayfa Durumu:</label>

                        <script>
                                $(document).ready(function () {
                                    radioValue = $("#radioButtonControl").val();
                                    //name'e göre bütün radio'ları gez value'si benim hidden inputtan aldığıma eşit olanı
                                    // checked et
                                    $("input[name='radioContent']").each(function () {
                                        if($(this).val() == radioValue){
                                            $(this).prop("checked", true);
                                        }
                                    });
                                });
                        </script>
                        <input type="hidden" id="radioButtonControl" value="<?php echo $content->visibility; ?>">
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioContent" id="gridRadios1" value="1">
                                <label for="gridRadios1" class="form-check-label">Açık</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioContent" id="gridRadios2" value="0">
                                <label for="gridRadios2" class="form-check-label">Kapalı</label>
                            </div>
                            <br>
                            <span class="infoSpan">Sayfanın sitedeki görünürlük durumunu belirler. Kapalı ise sayfa gizlenir.</span>
                        </div>
                    </div>

                    <input type="hidden" name="contentId" value="<?php echo $content->id; ?>">

                    <div class="text-right">
                        <button type="reset" class="btn btn-secondary">Formu Temizle</button>
                        <button type="submit" class="btn btn-success">Tüm Formu Kaydet</button>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <?php include "view/footer.php"?>



<?php } ?>
