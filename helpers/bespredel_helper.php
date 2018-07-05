<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function getCategoryArticleBlock($article)
{
ob_start();
$url = getFullUrl($article);
$noImage = "/images/111.png";
?>
        <div class="latest-articles iso-call">

            <div class="news-post fashion-post full-size">
                <div class="post-gallery">
                    <?php if ($article['image'] != '') { ?>
                        <a href="<?= $url ?>">
                            <img src="<?= cropImage($article['image'], 585, 585) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 585, 585) ?>" alt="<?= $article['name'] ?>"</a>
                        <?php
                    }
                    ?>
                </div>
                <div class="post-content">
                    <h2><a href="<?= $url ?>"><?= $article['name']?></a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?></li>
                    </ul>
                    <p><?= $article['short_content'] ?> </p>
                </div>
            </div>

            <div class="news-post fashion-post default-size">
            </div>

        </div>
    <?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}

function getPhotosBlock($image)
{
    ob_start();
    ?>
            <div class="item news-post fashion-post">
                <div class="post-gallery">
                    <a data-fancybox="gallery" href="<?=$image['image']?>"><img src="<?= cropImage($image['image'], 370, 300) ?>"></a>
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

function getBlockOfNews2($article)
{
    ob_start();
    $url = getFullUrl($article);
    $noImage = "/images/111.png";
    ?>
    <div class="item">
        <div class="news-post image-post2">
            <div class="post-gallery">
                <?php if ($article['image'] != '') { ?>
                    <a href="<?= $url ?>">
                        <img src="<?= cropImage($article['image'], 330, 260) ?>" alt="<?= $article['name'] ?>">
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 330, 260) ?>" alt="<?= $article['name'] ?>"/></a>
                    <?php
                }
                ?>
                <div class="hover-box">
                    <div class="inner-hover">
                        <h2><a href="<?=$url?>"><?=$article['name']?> </a></h2>
                        <ul class="post-tags">
                            <li><i class="fa fa-clock-o"></i><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?></li>
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

function getBlockOfNews($article)
{
    ob_start();
    $url = getFullUrl($article);
    $noImage = "/images/111.png";
    ?>
    <div class="news-post fashion-post default-size">
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
                <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 370, 300) ?>" alt="<?= $article['name'] ?>"/></a>
                <?php
            }
            ?>
        </div>
        <div class="post-content">
            <h2><a href="<?= $url ?>"><?=$article['name']?></a></h2>
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

function getSliderNews($article)
{
    $CI = & get_instance();
    ob_start();
    $url = getFullUrl($article);
    $cat = $CI->model_categories->getCategoryById($article['category_id']);
    $catUrl = getFullUrl($cat);
    $noImage = "/images/111.png";
    ?>
        <div class="item">
            <div class="news-post show-post">
                <div class="post-gallery">
                    <?php if ($article['image'] != '') { ?>
                        <a href="<?= $url ?>">
                            <img src="<?= cropImage($article['image'], 285, 430) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 285, 430) ?>" alt="<?= $article['name'] ?>"/></a>
                        <?php
                    }
                    ?>
                </div>
                <div class="post-content">
                    <a class="category-post" href="<?=$catUrl?>"><?=$cat['name']?></a>
                    <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?></li>
                    </ul>
                </div>
            </div>
        </div>
<?php
$html = ob_get_contents();
$url = getFullUrl($article);
ob_clean();
return $html;
}

function getNewsLine($article)
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
