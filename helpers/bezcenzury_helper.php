<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function getPoliticArticle($article)
{
    ob_start();
    $url = getFullUrl($article);
    $noImage = "/images/111.png";
    ?>

    <div class="news-post article-post">
        <div class="row">
            <div class="col-sm-5">
                <div class="post-gallery">
                    <?php if ($article['image'] != '') { ?>
                        <a href="<?= $url ?>">
                            <img src="<?= cropImage($article['image'], 190, 190) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 200, 200) ?>" alt=""/></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="post-content">
                    <h2><a href="<?= $url ?>"><?= $article['name']?></a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?></li>
                        <li><i class="fa fa-user"></i>by <a href="#">John Doe</a></li>
                        <li><a href="#"><i class="fa fa-comments-o"></i><span>23</span></a></li>
                        <li><i class="fa fa-eye"></i>872</li>
                    </ul>
                    <p><?= $article['short_content']?></p>
                </div>
            </div>
        </div>
    </div>

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

function getArticleImages($image)
{
    ob_start();
    ?>
    <?php if ($image['image'] != '') { ?>
            <div class="col-md-6">
                <div class="image-content">
                    <div class="image-place">
                        <img src="<?= cropImage($image['image'], 330, 380) ?>" alt="">
                        <div class="hover-image">
                            <a class="zoom" href="<?=$image['image']?>"><i class="fa fa-arrows-alt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
    <?php }
        ?>
<?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}

function getRecommendedNews($article)
{
    ob_start();
    $url = getFullUrl($article);
    $noImage = "/images/111.png";
    ?>
            <div class="item news-post image-post3">
                <?php if ($article['image'] != '') { ?>
                    <a href="<?= $url ?>">
                        <img src="<?= cropImage($article['image'], 260, 220) ?>" alt="<?= $article['name'] ?>">
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 260, 220) ?>" alt=""/></a>
                    <?php
                }
                ?>
                <div class="hover-box">
                    <h2><a href="<?= $url ?>"><?=$article['name']?></a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?> </li>
                    </ul>
                </div>
            </div>

    <?php
    $html = ob_get_contents();
    ob_clean();
    return $html;

}

function getLastFourNews($article)
{
    ob_start();
    $url = getFullUrl($article);
    $noImage = "/images/111.png";
    ?>

    <div class="news-post image-post default-size">
        <?php if ($article['image'] != '') { ?>
            <a href="<?= $url ?>">
                <img src="<?= cropImage($article['image'], 250, 240) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 250, 240) ?>" alt=""/></a>
            <?php
        }
        ?>
            <div class="hover-box">
                <div class="inner-hover">
                    <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><span><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?></span></li>
                    </ul>

                </div>
            </div>
        </div>

    <?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}


function getLastFourSliderNews($article)
{
    ob_start();
    $url = getFullUrl($article);
    $noImage = "/images/111.png";
    ?>

    <li>
        <div class="news-post image-post">
            <?php if ($article['image'] != '') { ?>
                <a href="<?= $url ?>">
                    <img src="<?= cropImage($article['image'], 650, 414) ?>" alt="<?= $article['name'] ?>">
                </a>
                <?php
            }
            else
            {
                ?>
                <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 650, 414) ?>" alt=""/></a>
                <?php
            }
            ?>
            <div class="hover-box">
                <div class="inner-hover">
                    <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    <?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}

function getLastFourNewsMain($article)
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

function sideBarNews($article)
{
ob_start();
$url = getFullUrl($article);
$noImage = "/images/111.png";
?>
            <li>
            <div class="news-post image-post2">
                <div class="post-gallery">
                    <?php if ($article['image'] != '') { ?>
                        <a href="<?= $url ?>">
                            <img src="<?= cropImage($article['image'], 270, 240) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 270, 240) ?>" alt="<?= $article['name'] ?>"/></a>
                        <?php
                    }
                    ?>
                    <div class="hover-box">
                        <div class="inner-hover">
                            <h2><a href="<?=$url?>"><?=$article['name']?></a></h2>
                            <ul class="post-tags">
                                <li><i class="fa fa-clock-o"></i><?=  date('d',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('F',$article['date_unix']) ?>&nbsp;&nbsp;<?= date('Y',$article['date_unix']) ?></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </li>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function sideBarSmallNews($article)
{
ob_start();
$url = getFullUrl($article);
$noImage = "/images/111.png";
?>
    <li>
        <?php if ($article['image'] != '') { ?>
            <a href="<?= $url ?>">
                <img src="<?= cropImage($article['image'], 270, 240) ?>" alt="<?= $article['name'] ?>">
            </a>
            <?php
        }
        else
        {
            ?>
            <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 270, 240) ?>" alt="<?= $article['name'] ?>"/></a>
            <?php
        }
        ?>
        <div class="post-content">
            <h2><a href="<?= $url ?>"><?=$article['name']?> </a></h2>
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




