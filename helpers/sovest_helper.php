<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function getMainBlockS($article)
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
                            <img src="<?= cropImage($article['image'], 400, 280) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 400, 280) ?>" alt="<?= $article['name'] ?>"</a>
                        <?php
                    }
                    ?>
                    <a class="category-post" href="<?=$catUrl?>"><?=$cat['name']?></a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="post-content">
                    <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><?=$date?></li>
                    </ul>
                    <?=$article['short_content']?>
                    <a href="<?=$url?>" class="read-more-button"><i class="fa fa-angle-right"></i><span>Подробнее</span></a>
                </div>
            </div>
        </div>
    </div>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getLeftAdvertisements()
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
                        <img src="<?= cropImage($banner['image'], 300, 250) ?>" alt="">
                        <?php
                    }
                    else
                    {
                        ?>
                        <a data-fancybox="gallery" href="<?=$banner['image']?>"  ><img src="<?= cropImage($banner['image'], 300, 250) ?>" ></a>
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

function getCategoryBlock($article)
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
                            <img src="<?= cropImage($article['image'], 370, 300) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 370, 300) ?>" alt="<?= $article['name'] ?>"</a>
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
                    <?=$article['short_content']?>
                </div>
            </div>
        </div>
    </div>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getSideBarItems($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
        <li>
            <?php if ($article['image'] != '') { ?>
                <a href="<?= $url ?>">
                    <img src="<?= cropImage($article['image'], 370, 300) ?>" alt="<?= $article['name'] ?>">
                </a>
                <?php
            }
            else
            {
                ?>
                <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 370, 300) ?>" alt="<?= $article['name'] ?>"</a>
                <?php
            }
            ?>
            <div class="post-content">
                <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                <ul class="post-tags">
                    <li><i class="fa fa-clock-o"></i><?=$date?></li>
                </ul>
            </div>
        </li>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getCarouselItem($article)
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
                <img src="<?= cropImage($article['image'], 370, 300) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 370, 300) ?>" alt="<?= $article['name'] ?>"</a>
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