<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function getAdvertisements($place)
{
    ob_start();

    ?>
        <?php
        $banners = getBanners("$place");
        if($banners){
        foreach ($banners as $banner){
         if ($banner['url'] != ''){
                    echo '<a rel="nofollow" target="_blank" href="/banner/' . $banner['id'] . '/">'; ?>
                    <img  src="<?= $banner['image'] ?>" alt=""></a>
                <?php
                    }
                    else
                    {
                    ?>
                    <a data-fancybox="gallery" href="<?=$banner['image']?>"  ?><img  src="<?= $banner['image'] ?>"  ?></a>
        <?php
                    }
                }
            }
        ?>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}


function getBestOrganisations()
{
    $noImage = "/assets/img/noImage.png";
    ob_start();
    $mArticles = getModel('articles');
    $articles = $mArticles->getArticlesByParam('best',1,getOption('paginatorBest'),0,1);
    ?>
    <!-- carousel -->
    <div class="companies-carousel owl-carousel owl-theme">
    <?php
    for ($i=0; $i < $count = count($articles); $i+=2) {
    ?>
    <div class="company-block-wrap">
            <div class="company-block">
                <?php
                    if ($articles[$i]['image'] != '') {
                ?>
                <img src="<?=cropImage($articles[$i]['image'],272,188)?>" alt="<?= strip_tags($articles[$i]['short_content'])?>">
                <?php
                    }
                    else
                    {
                ?>
                <img src="<?=cropImage($noImage,272,188)?>" alt="">
                <?php
                    }
                ?>
                <div class="details">
                    <header class="d-header">
                        <img class="icon" src="/assets/img/icon.png" alt="">
                        <h6 class="d-header-title"><?=$articles[$i]['name']?></h6>
                    </header>
                    <div class="d-main">
                        <p class="d-main-text">
                            <?= strip_tags($articles[$i]['short_content'])?>
                        </p>
                     </div>
                    <div class="d-btn">
                        <a href="<?=getFullUrl($articles[$i])?>">Перейти</a>
                    </div>
                </div>
            </div>
            <?php
                $count = count($articles) -1;
                if ($count >= $i+1){
            ?>
            <div class="company-block">
            <?php
                if ($articles[$i+1]['image'] != '') {
            ?>
                <img src="<?=cropImage($articles[$i+1]['image'],272,188)?>" alt="<?= strip_tags($articles[$i]['short_content'])?>">
            <?php
                }
                else
                {
            ?>
                <img src="<?=cropImage($noImage,272,188)?>" alt="">
            <?php
                }
            ?>
                <div class="details">
                    <header class="d-header">
                        <img class="icon" src="/assets/img/icon.png" alt="">
                        <h6 class="d-header-title"><?=$articles[$i+1]['name']?></h6>
                    </header>
                    <div class="d-main">
                        <p class="d-main-text">
                            <?= strip_tags($articles[$i+1]['short_content'])?>
                        </p>
                    </div>
                     <div class="d-btn">
                        <a href="<?=getFullUrl($articles[$i+1])?>">Перейти</a>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
            <?php
                }
            ?>
        </div>
    </div>
    <!-- carousel -->
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getAlfavit()
{
    ob_start();
    $active = true;
    if (!isset($_GET['letter'])) {
        $_GET['letter'] = 123;
    }
    $letters = ['A','B','C','D','E','F','G','H','I','G','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','І','Є','1','2','3','4','5','6','7','8','9','0'
    ];
    ?>
    <a <?=$active?> href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL']?>">Все</a>
    <?php
    foreach ($letters as $letter) {
            if ($letter == $_GET['letter'] ) {
                $active = "class='active'";
            }
            else
            {
                $active = '';
            }
        ?>
            <a <?=$active?> href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?letter='.$letter?>"><?=$letter?></a>
                <?php
            }
$html = ob_get_contents();
ob_clean();
return $html;
}



