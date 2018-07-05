<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function getRightNews($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="post-content">
        <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
        <ul class="post-tags">
            <li><i class="fa fa-clock-o"></i><?=$date?></li>
        </ul>
    </div>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getMainBlock($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
$dateH = date('G',$article['date_unix']).":".date('i',$article['date_unix']).":".date('s',$article['date_unix']);
?>
    <div class="news-post standard-post2">
                            <div class="post-gallery">
                                <?php if ($article['image'] != '') { ?>
                                    <a href="<?= $url ?>">
                                        <img src="<?= cropImage($article['image'], 600, 280) ?>" alt="<?= $article['name'] ?>">
                                    </a>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 600, 280) ?>" alt="<?= $article['name'] ?>"</a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="post-title">
                                <h2><a href="<?= $url ?>"><?= $article['name'] ?></a></h2>
                                <ul class="post-tags">
                                    <li><i class="fa fa-clock-o"></i><?=$date?>&nbsp;&nbsp;<?=$dateH?></li>
                                </ul>
                            </div>
                            <div class="post-content">
                                <p><?= $article['short_content'] ?></p>
                            </div>
    </div>
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

function youMayAlsoLike($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
$dateH = date('G',$article['date_unix']).":".date('i',$article['date_unix']).":".date('s',$article['date_unix']);
?>
    <div class="item news-post image-post3">
        <?php if ($article['image'] != '') { ?>
            <a href="<?= $url ?>">
                <img src="<?= cropImage($article['image'], 320, 210) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 320, 210) ?>" alt="<?= $article['name'] ?>"</a>
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


