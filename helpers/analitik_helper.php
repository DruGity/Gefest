<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function getTopNew($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="news-post image-post snd-size">
        <?php if ($article['image'] != '') { ?>
            <a href="<?= $url ?>">
                <img src="<?= cropImage($article['image'], 550, 350) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 500, 400) ?>" alt="<?= $article['name'] ?>"</a>
            <?php
        }
        ?>
        <div class="hover-box">
            <div class="inner-hover">
                <a class="category-post" href="<?=$catUrl?>"><?=$cat['name']?></a>
                <h2><a href="<?=$url?>"><?=$article["name"]?></a></h2>
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
    <div class="col-md-3">

        <div class="item news-post standard-post">
            <div class="post-gallery">
                <?php if ($article['image'] != '') { ?>
                    <a href="<?= $url ?>">
                        <img src="<?= cropImage($article['image'], 300, 230) ?>" alt="<?= $article['name'] ?>">
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 300, 230) ?>" alt="<?= $article['name'] ?>"</a>
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

function getBlockOnMainC($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="col-md-3">

        <div class="item news-post standard-post">
            <div class="post-gallery">
                <?php if ($article['image'] != '') { ?>
                    <a href="<?= $url ?>">
                        <img src="<?= cropImage($article['image'], 300, 230) ?>" alt="<?= $article['name'] ?>">
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 300, 230) ?>" alt="<?= $article['name'] ?>"</a>
                    <?php
                }
                ?>
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

function getBannersInFooterF()
{
ob_start();
?>
    <?php
    $banners = getBanners('bottom');
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

function getRightSideBarElement($article)
{
ob_start();
$url = getFullUrl($article);
$noImage = "/images/111.png";
?>
    <li>
        <?php if ($article['image'] != '') { ?>
            <a href="<?= $url ?>">
                <img src="<?= cropImage($article['image'], 109, 109) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 109, 109) ?>" alt="<?= $article['name'] ?>"/></a>
            <?php
        }
        ?>
        <div class="post-content">
            <h2><a href="<?=$url?>"><?= $article['name']?></h2></a>
            <ul class="post-tags">
                <li><i class="fa fa-clock-o"></i><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?></li>
            </ul>
        </div>
    </li>
<?php
$html = ob_get_contents();
ob_clean();
return $html;

}

function getYouMayAlsoLike($article)
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
                <img src="<?= cropImage($article['image'], 240, 170) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 240, 170) ?>" alt="<?= $article['name'] ?>"</a>
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
    <div class="article-inpost">
        <div class="row">
            <div class="col-md-6">
                <div class="image-content">
                    <div class="image-place">
                        <?php if ($article['image'] != '') { ?>
                            <a href="<?= $url ?>">
                                <img src="<?= cropImage($article['image'], 500, 450) ?>" alt="<?= $article['name'] ?>">
                            </a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 500, 450) ?>" alt="<?= $article['name'] ?>"</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-content">
                    <a href="<?= $url ?>">
                    <h2><?=$article['name']?></h2>
                    </a>
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