<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function getContactline()
{
ob_start();
?>
    <section id="contact" class="bg-color-red">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-12 text-center">
                <div class="get-tuch">
                    <i class="icon-telephone114"></i>
                    <ul>
                        <li><h4>Phone Number</h4></li>
                        <li><p><?=getOption("nomer-telefona-1")?></p></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 text-center">
                <div class="get-tuch">
                    <i class="icon-telephone114"></i>
                    <ul>
                        <li><h4>Phone Number</h4></li>
                        <li><p><?=getOption("nomer-telefona-2")?></p></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 text-center">
                <div class="get-tuch">
                    <i class="icon-telephone114"></i>
                    <ul>
                        <li><h4>Phone Number</h4></li>
                        <li><p><?=getOption("nomer-telefona-3")?></p></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 text-center">
                <div class="get-tuch">
                    <i class="icon-telephone114"></i>
                    <ul>
                        <li><h4>Phone Number</h4></li>
                        <li><p><?=getOption("nomer-telefona-4")?></p></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 text-center">
                <div class="get-tuch">
                    <i class="icon-telephone114"></i>
                    <ul>
                        <li><h4 class="p-font-17">Viber</h4></li>
                        <li><a href="#."><p><?=getOption("viber")?></p></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 text-center">
                <div class="get-tuch">
                    <i class="icon-icons142"></i>
                    <ul>
                        <li><h4 class="p-font-17">Mail</h4></li>
                        <li><a href="#."><p><?=getOption("mail")?></p></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getListItem($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="property-list-list" data-target="Residential">
                <div class="col-xs-12 col-sm-4 col-md-4 property-list-list-image">
                    <?php if ($article['image'] != '') { ?>
                        <a href="<?= $url ?>">
                            <img src="<?= cropImage($article['image'], 360, 400) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 390, 400) ?>" alt="<?= $article['name'] ?>"</a>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 property-list-list-info">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <br>
                        <a href="<?=$url?>">
                            <h3><?=$article['name']?></h3>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <p class="recent-properties-price"><?=$article['title']?></p>
                        <span class="recent-properties-address"><?=$article['subname']//-цена?></span>
                        <?=$article['short_content']?>
                        <br>
                        <a href="<?=$url?>" class="button-detail">
                           Подробнее
                        </a>
                    </div>
                </div>
            </div>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getStroyaschiesyaItem($category)
{
ob_start();
$noImage = "/images/111.png";
$url = getFullUrl($category);

?>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="property_item heading_space">
            <div class="image">
                <?php if ($category['image'] != '') { ?>
                    <a href="<?= $url ?>">
                        <img src="<?= cropImage($category['image'], 364, 254) ?>" alt="<?= $category['name'] ?>">
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 364, 254) ?>" alt="<?= $category['name'] ?>"</a>
                    <?php
                }
                ?>
                <!-- <div class="overlay"></div> -->
            </div>
            <div class="proerty_content">
                <div class="proerty_text">
                    <h3><a href="<?=$url?>"><?=$category['name']?></a></h3>
                </div>
            </div>
            <!-- <div class="centered"> -->
                <a class="link_arrow blue_border" href="<?=$url?>">
                    Подробнее
                </a>
            <!-- </div> -->
        </div>
    </div>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getGalleryItem($image)
{
ob_start();
?>
    <?php if ($image['image'] != '') { ?>
    <div class="cbp-item latest rent">
        <div class="image">
            <img src="<?= cropImage($image['image'], 360, 260) ?>" alt="">
            <div class="overlay">
                <a data-fancybox="gallery" href="<?=$image['image']?>" > <img src="<?= cropImage($image['image'], 360, 260) ?>"  ></a>
            </div>
        </div>
    </div>
<?php
    }
    ?>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getArticleBlock($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <div class="col-md-4 margin_bottom">
        <div class="image">
            <?php if ($article['image'] != '') { ?>
                <a href="<?= $url ?>">
                    <img src="<?= cropImage($article['image'], 310, 203) ?>" alt="<?= $article['name'] ?>">
                </a>
                <?php
            }
            else
            {
                ?>
                <a href="<?= $url ?>"><img src="<?= cropImage($noImage, 310, 203) ?>" alt="<?= $article['name'] ?>"</a>
                <?php
            }
            ?>
        </div>
        <div class="sim-lar-text">
            <br>
            <a href="<?= $url ?>">
            <h3><?=$article['name']?></h3>
            </a>
            <br>
            <?=$article['short_content']?>
            <a href="<?=$url?>" class="link_arrow top20">Подробнее</a>
        </div>
    </div>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

function getPricesBlocks($category)
{
ob_start();
$CI = & get_instance();
$noImage = "/images/111.png";
$catUrl = getFullUrl($category);
?>
    <div class="col-md-4 col-sm-4 top40">
        <div class="feature_box equal-height">
            <span class="icon"> <i class="fa fa-money"></i></span>
            <div class="description">
                <h4><?=$category['name']?></h4>
                <?=$category['short_content']?>
                <a href="<?=$catUrl?>" class="link_arrow top20">Подробнее</a>
            </div>
        </div>
    </div>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

