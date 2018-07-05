<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function getAdvertisements()
{
ob_start();
?>
<?php
$banners = getBanners('left');
if($banners){
    foreach ($banners as $banner){

        ?>
        <div class="advertisement">

            <div class="desktop-advert">
                <span>Реклама</span>
                <?php if ($banner['url'] != ''){
                    echo '<a rel="nofollow" target="_blank" href="/banner/' . $banner['id'] . '/">'; ?>
                    <img src="<?= cropImage($banner['image'], 240, 240) ?>" alt="">
                    <?php
                }
                else
                {
                    ?>
                    <a data-fancybox="gallery" href="<?=$banner['image']?>"  ?><img src="<?= cropImage($banner['image'], 240, 240) ?>"  ?></a>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}
?>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getCategoryItem($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="news-post article-post">
        <div class="row">
            <div class="col-sm-6">
                <div class="post-gallery">
                    <?php if ($article['image'] != '') { ?>
                        <a href="<?= $url ?>">
                            <img src="<?= cropImage($article['image'], 330, 228) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 330, 228) ?>" alt="<?= $article['name'] ?>"/></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="post-content">
                              <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><?=$date?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getFeatureBlock($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>

    <div class="item news-post image-post3">
        <?php if ($article['image'] != '') { ?>
            <a href="<?= $url ?>">
                <img src="<?= cropImage($article['image'], 330, 228) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 330, 228) ?>" alt="<?= $article['name'] ?>"/></a>
            <?php
        }
        ?>
        <div class="hover-box">
            <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
            <ul class="post-tags">
                <li><i class="fa fa-clock-o"></i><?=$date?></li>
            </ul>
        </div>
    </div>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getBlockOnMain($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="news-post article-post">
        <div class="row">
            <div class="col-sm-6">
                <div class="post-gallery">
                    <?php if ($article['image'] != '') { ?>
                        <a href="<?= $url ?>">
                            <img src="<?= cropImage($article['image'], 430, 328) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 430, 328) ?>" alt="<?= $article['name'] ?>"/></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="post-content">
                    <a class="category-post" href="<?=$catUrl?>"><?=$cat['name']?></a>
                    <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><?=$date?></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>


<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getBannersInFooter()
{
    ob_start();
    ?>
    <?php
    $banners = getBanners('left');
    if($banners){
        foreach ($banners as $banner){
            ?>

            <div class="col-md-3">
                    <?php if ($banner['url'] != ''){
                        echo '<a rel="nofollow" target="_blank" href="/banner/' . $banner['id'] . '/">'; ?>
                        <img src="<?= cropImage($banner['image'], 240, 240) ?>" alt="">
                        <?php
                    }
                    else
                    {
                        ?>
                        <a data-fancybox="gallery" href="<?=$banner['image']?>"  ?><img src="<?= cropImage($banner['image'], 240, 240) ?>"  ?></a>
                    <?php } ?>
            </div>

            <?php
        }
    }
    ?>
    <?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}

function getBannersInCentre($width, $height)
{
    ob_start();
    ?>
    <?php
    $banners = getBanners('centre');
    if ($banners) {
        foreach ($banners as $banner) {
            ?>
            <div class="advertisement">
            <div class="desktop-advert">
            <?php if ($banner['url'] != '') {
                echo '<a rel="nofollow" target="_blank" href="/banner/' . $banner['id'] . '/">'; ?>
                <img src="<?= cropImage($banner['image'], $width, $height) ?>" alt="">
                </div>
                </div>

                <?php
            }
        }
        ?>
        <?php
        $html = ob_get_contents();
        ob_clean();
        return $html;
    }
}