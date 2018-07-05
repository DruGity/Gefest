<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function getCategoryBloacks($article)
{
ob_start();
$url = getFullUrl($article);
$noImage = "/images/111.png";
?>
    <div class="row">
        <div class="col-md-8">
            <div class="news-post standard-post2">
                <div class="post-gallery">
                    <?php if ($article['image'] != '') { ?>
                        <a href="<?= $url ?>">
                            <img src="<?= cropImage($article['image'], 470, 260) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 470, 260) ?>" alt="<?= $article['name'] ?>"</a>
                        <?php
                    }
                    ?>
                </div>
                <div class="post-title">
                    <h2><a href="<?=$url?>"><?=$article['name']?> </a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?></li>
                    </ul>
                </div>
                <div class="post-content">
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

function getNewsLineK($article)
{
    ob_start();
    $url = getFullUrl($article);
    ?>
    <li class="news-item"><span class="time-news"><?=date('H:i',$article['date_unix'])?></span>  <a href="<?=$url?>"><?=$article['name']?></a></li>
    <?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}

function getCarouselItem($article)
{
ob_start();
    $noImage = "/images/111.png";
$url = getFullUrl($article);
?>
    <div class="item news-post image-post3">
        <?php if ($article['image'] != '') { ?>
            <a href="<?= $url ?>">
                <img src="<?= cropImage($article['image'], 270, 200) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 270, 200) ?>" alt="<?= $article['name'] ?>"</a>
            <?php
        }
        ?>
        <div class="hover-box">
            <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
            <ul class="post-tags">
                <li><i class="fa fa-clock-o"></i><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?></li>
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
?>
    <div class="news-post article-post">
        <div class="row">
            <div class="col-sm-5">
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
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 470, 300) ?>" alt="<?= $article['name'] ?>"</a>
                        <?php
                    }
                    ?>
                    <a class="category-post" href="<?=$catUrl?>"><?=$cat['name']?></a>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="post-content">
                    <h2><a href="<?=$url?>"><?= $article['name']?></a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?></li>
                    </ul>
                    <p><?=$article['short_content']?></p>
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

function getActualNews($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
?>
    <li>
        <?php if ($article['image'] != '') { ?>
            <a href="<?= $url ?>">
                <img src="<?= cropImage($article['image'], 100, 80) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 100, 80) ?>" alt="<?= $article['name'] ?>"</a>
            <?php
        }
        ?>
        <div class="post-content">
            <a href="<?=$catUrl?>"><?=$cat['name']?></a>
            <h2><a href="<?=$url?>"><?=$article['name']?></h2>
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

function getLastPost($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="news-post standard-post2">
        <div class="post-gallery">
            <?php if ($article['image'] != '') { ?>
                <a href="<?= $url ?>">
                    <img src="<?= cropImage($article['image'], 370, 200) ?>" alt="<?= $article['name'] ?>">
                </a>
                <?php
            }
            else
            {
                ?>
                <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 370, 200) ?>" alt="<?= $article['name'] ?>"</a>
                <?php
            }
            ?>
            <a class="category-post" href="<?=$catUrl?>"><?=$cat['name']?></a>
        </div>
        <div class="post-title">
            <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
            <ul class="post-tags">
                <li><i class="fa fa-clock-o"></i><?=$date?></li>
            </ul>
        </div>
        <div class="post-content">
            <?=$article['short_content']?>
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



