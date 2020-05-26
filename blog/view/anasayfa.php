<?php require "header.php" ?>

<div class="kapsul">
        <div class="col-lg-8 offset-lg-2 mb-2">
            <div class="page-heading">
                <h1><?php echo $titles["home_title"]; ?></h1>
                <hr class="small">
                <span class="page-subheading"><?php echo $titles["home_subtitle"]; ?></span>
            </div>
        </div>

    <div class="container content-height">
        <div class="row">


            <?php foreach ($counts as $count){  ?>

            <div class="col-lg-8 offset-lg-2">
                <h2 class="blog-title"><?php echo mb_convert_case($count->title, MB_CASE_TITLE, "UTF-8"); ?> (<?php echo $count->categoryCount; ?>)</h2>
                <div class="blog-list container-fluid"">

                    <?php
                        $pages = showContent($db, $count->categoryId);
                        foreach ($pages as $page){
                    ?>
                        <article class="row mb-2 blog-headers">
                            <span class="blog-date"><?php echo turkcetarih_formati('j F Y',$page->tarih); ?></span>
                            <div class="blog-content">
                                <a href="index.php?url=sayfa&id=<?php echo $page->id; ?> ">
                                    <span><?php echo mb_convert_case($page->title, MB_CASE_TITLE, "UTF-8"); ?></span>
                                </a>
                            </div>
                        </article>
                            <hr>
                    <?php  }  ?>

                </div>
            </div>

            <?php  }  ?>

       </div>
    </div>
</div>


<?php require "footer.php" ?>