<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function getMainBlock($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="col-md-4">
        <div class="news-post standard-post">
            <div class="post-gallery">
                <?php if ($article['image'] != '') { ?>
                    <a href="<?= $url ?>">
                        <img src="<?= cropImage($article['image'], 300, 240) ?>" alt="<?= $article['name'] ?>">
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 300, 240) ?>" alt="<?= $article['name'] ?>"</a>
                    <?php
                }
                ?>
                <a class="category-post" href="<?=$catUrl?>"><?=$cat['name']?></a>
            </div>
            <div class="post-content">
                <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                <ul class="post-tags">
                    <li><i class="fa fa-clock-o"></i><?=$date?></li>
                </ul>
            </div>
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

            <?php if ($banner['url'] != '') {
                echo '<a rel="nofollow" target="_blank" href="/banner/' . $banner['id'] . '/">'; ?>
                <img src="<?= cropImage($banner['image'], $width, $height) ?>" alt="">


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

function getBannersTopRight($width, $height)
{
    ob_start();
    ?>
    <?php
    $banners = getBanners('topright');
    if ($banners) {
        foreach ($banners as $banner) {
            ?>

            <?php if ($banner['url'] != '') {
                echo '<a rel="nofollow" target="_blank" href="/banner/' . $banner['id'] . '/">'; ?>
                <img src="<?= cropImage($banner['image'], $width, $height) ?>" alt="">


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

function getMainBlockForCategory($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="col-md-4">
        <div class="news-post standard-post">
            <div class="post-gallery">
                <?php if ($article['image'] != '') { ?>
                    <a href="<?= $url ?>">
                        <img src="<?= cropImage($article['image'], 300, 240) ?>" alt="<?= $article['name'] ?>">
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 300, 240) ?>" alt="<?= $article['name'] ?>"</a>
                    <?php
                }
                ?>
            </div>
            <div class="post-content">
                <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                <ul class="post-tags">
                    <li><i class="fa fa-clock-o"></i><?=$date?></li>
                </ul>
                <br>
                <?=$article['short_content']?>
            </div>
        </div>
    </div>
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
                <img src="<?= cropImage($article['image'], 300, 240) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 300, 240) ?>" alt="<?= $article['name'] ?>"</a>
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