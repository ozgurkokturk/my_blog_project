<?php require "header.php" ?>

<?php
//    echo "<pre>";
//    print_r($contents);
//?>
<div class="kapsul">
    <header>
        <div class="container mb-2">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
<!--                    <h1 class="content-title">--><?php //echo mb_convert_case($contents["title"] , MB_CASE_TITLE, "UTF-8")?><!--</h1>-->
                    <h1 class="content-title"><?php echo $contents["title"]; ?></h1>

                    <div class="row">
                        <div class="col-md-6 col-sm-12 sayfaBilgileri">
                            <strong>Tarih: </strong>
                            <i><?php echo turkcetarih_formati('j F Y',$contents["tarih"]) ?></i>
                        </div>
                        <div class="col-md-6 col-sm-12 text-md-right text-left sayfaBilgileri">
                            <strong>Kategori: </strong>
                            <i><?php echo mb_convert_case($contents["categorytitle"], MB_CASE_TITLE, "UTF-8") ?></i>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </header>

    <div class="container content-text">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <article class="post-content">
                    <p><?php echo htmlspecialchars_decode($contents["text"]); ?></p>
                </article>
            </div>
        </div>
    </div>


        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <?php
                        $labels = etiketDuzenle($contents["labels"]);
                        foreach ($labels as $label){ ?>
                            <span class="content-labels">
                                <?php echo $label; ?>
                            </span>
                      <?php  }   ?>
                </div>
            </div>
        </div>
</div>

<?php require "footer.php" ?>