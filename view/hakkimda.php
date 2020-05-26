<?php require "header.php" ?>
<div class="kapsul">
    <div class="container content-height">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 mb-2">
                <div class="about-heading">
<!--                    <h1>--><?php //echo mb_convert_case($about["user_name"], MB_CASE_TITLE, "UTF-8")?><!--</h1>-->
                    <h1>Hakkımda</h1>
                    <hr class="small">
                </div>
                <p>
                    <div class="about-content"><?php echo htmlspecialchars_decode($about["hakkimda"]); ?></div>
                </p>
            </div>

        </div>
    </div>
</div>


<?php require "footer.php" ?>