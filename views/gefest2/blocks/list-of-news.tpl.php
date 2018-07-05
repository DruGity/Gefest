<?php
$noImage = "/img/111.png";
$date = date('d',$date_unix)."&nbsp;&nbsp;".date('F',$date_unix)."&nbsp;&nbsp;".date('Y',$date_unix);
?>

<div class="row mt-xl">
    <div class="col-md-12">
        <span class="thumb-info thumb-info-side-image thumb-info-no-zoom mt-xl">
            <span class="thumb-info-side-image-wrapper p-none hidden-xs">

                    <?php if ($image != '') { ?>
                    <a href="<?= $fullUrl ?>">
                        <img class="img-responsive" src="<?= cropImage($image, 195, 235) ?>" alt="<?= $name ?>">
                    </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $fullUrl ?>">
                        <img class="img-responsive" src="<?= cropImage($noImage, 195, 235) ?>" alt="<?= $name ?>"
                        </a>
                        <?php
                    }
                    ?>

            </span>
            <span class="thumb-info-caption">
                <span class="thumb-info-caption-text">
                    <h2 class="mb-md mt-xs"><a title="" class="text-dark" href="<?= $fullUrl ?>"><?=$name?></a></h2>
                    <span class="post-meta">
                        <span><?=$date?></span>
                    </span>
                    <p class="font-size-md"><?=strip_tags($short_content)?></p>
                    <a class="mt-md" href="<?=$fullUrl?>">Подробнее<i class="fa fa-long-arrow-right"></i></a>
                </span>
            </span>
        </span>
    </div>
</div>
