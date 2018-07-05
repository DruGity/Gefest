<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

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

function getBloackOnMain($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="news-post standard-post3 default-size">
        <div class="post-gallery">
            <?php if ($article['image'] != '') { ?>
                <a href="<?= $url ?>">
                    <img src="<?= cropImage($article['image'], 370, 260) ?>" alt="<?= $article['name'] ?>">
                </a>
                <?php
            }
            else
            {
                ?>
                <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 370, 260) ?>" alt="<?= $article['name'] ?>"</a>
                <?php
            }
            ?>
        </div>
        <div class="post-title">
            <a class="category-post tech" href="<?=$catUrl?>"><?=$cat['name']?></a>
            <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
            <?=$article['short_content']?>
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

function getLastNew($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="col-md-10">
        <div class="title-section">
            <a href="<?= $catUrl ?>">
            <h1><span class="world"><?=$cat['name']?></span></h1>
                <?= getBreadcrumbs() ?>
            </a>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="item news-post standard-post">
                    <div class="post-gallery">
                        <?php if ($article['image'] != '') { ?>
                            <a href="<?= $url ?>">
                                <img src="<?= cropImage($article['image'], 570, 360) ?>" alt="<?= $article['name'] ?>">
                            </a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 570, 360) ?>" alt="<?= $article['name'] ?>"</a>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="post-content">
                        <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                        <?=$article['short_content']?>
                        <ul class="post-tags">
                            <li><i class="fa fa-clock-o"></i><?=$date?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}