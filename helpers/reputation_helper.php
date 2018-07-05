<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


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
            <div class="col-sm-4">
                <div class="post-gallery">
                    <?php if ($article['image'] != '') { ?>
                        <a href="<?= $url ?>">
                            <img src="<?= cropImage($article['image'], 300, 220) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 300, 220) ?>" alt=""/></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="post-content">
                    <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><?=$date?></li>

                    </ul>
                    <p><?=$article['short_content']?></p>
                </div>
            </div>
        </div>
    </div>

<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getCategoriesBlocks($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
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
    }

    ?>
        <?php
        $html = ob_get_contents();
        ob_clean();
        return $html;
}

function getFeaturedNews($article)
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
                <img src="<?= cropImage($article['image'], 300, 220) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 300, 220) ?>" alt=""/></a>
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

function getMainBlocks($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="item">
        <div class="news-post image-post">
            <div class="post-gallery">
                <?php if ($article['image'] != '') { ?>
                    <a href="<?= $url ?>">
                        <img src="<?= cropImage($article['image'], 390, 400) ?>" alt="<?= $article['name'] ?>">
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 400, 410) ?>" alt="<?= $article['name'] ?>"/></a>
                    <?php
                }
                ?>
                <div class="hover-box">
                    <div class="inner-hover">
                        <a class="category-post" href="<?=$catUrl?>"><?=$cat['name']?></a>
                        <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                        <ul class="post-tags">
                            <li><i class="fa fa-clock-o"></i><?=$date?></li>
                        </ul>
                       <?=$article['short_content']?>

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


function getArticlesBlockByCategory($article)
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
        <div class="news-post standard-post">
            <div class="post-gallery">
                <?php if ($article['image'] != '') { ?>
                    <a href="<?= $url ?>">
                        <img src="<?= cropImage($article['image'], 270, 200) ?>" alt="<?= $article['name'] ?>">
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 270, 200) ?>" alt="<?= $article['name'] ?>"/></a>
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

function getCategoryBlocks($category)
{
ob_start();
?>
    <div class="title-section">
        <h1><span><?=$category['name']?></span></h1>
    </div>

    <div class="row">
        <?php
        $mArticles = getModel('articles');
        $articles = $mArticles->getArticlesByCategory($category['id'],4,0,1);
        if($articles) {
            foreach ($articles as $article)
            {
                echo getArticlesBlockByCategory($article);

            }
        }
        ?>
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


