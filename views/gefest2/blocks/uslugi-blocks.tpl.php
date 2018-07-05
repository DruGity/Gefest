<?php
$noImage = "/img/111.png";
?>
<div class="col-md-6">
    <div class="feature-box feature-box-style-2 mb-xl appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="300">
        <div class="feature-box-icon">
            <?php if ($image != '') { ?>
                <a href="<?= $fullUrl ?>">
                    <img class="img-responsive" src="<?= cropImage($image, 150, 150) ?>" alt="<?= $name ?>">
                </a>
                <?php
            }
            else
            {
                ?>
                <a href="<?= $fullUrl ?>">
                    <img class="img-responsive" src="<?= cropImage($noImage, 150, 150) ?>" alt="<?= $name ?>"
                </a>
                <?php
            }
            ?>
        </div>
        <div class="feature-box-info ml-md">
            <h4 class="mb-sm"><?=$name?></h4>
            <?=$short_content?>
            <a class="mt-md" href="<?=$fullUrl?>">Подробнее <i class="fa fa-long-arrow-right"></i></a>
        </div>
    </div>
</div>