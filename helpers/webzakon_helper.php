<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function getLawerBlock($article)
{
ob_start();
$CI = & get_instance();
$cat = $CI->model_categories->getCategoryById($article['category_id']);
$noImage = "/images/111.png";
$url = getFullUrl($article);
$catUrl = getFullUrl($cat);
$date = date('d',$article['date_unix'])."&nbsp;&nbsp;".date('F',$article['date_unix'])."&nbsp;&nbsp;".date('Y',$article['date_unix']);
?>
    <li class="col-md-4 col-sm-6 mb-xl center isotope-item criminal-law new-york">
    <a href="<?=$url?>">
        <span class="thumb-info thumb-info-centered-info thumb-info-no-borders">
            <span class="thumb-info-wrapper">
                <?php if ($article['image'] != '') { ?>
                    <a href="<?= $url ?>">
                            <img class="img-responsive" src="<?=  cropImage($article['image'], 420, 350) ?>" alt="<?= $article['name'] ?>">
                        </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?= $url ?>"><img class="img-responsive" src="<?= cropImage($noImage, 420, 350) ?>" alt="<?= $article['name'] ?>"</a>
                    <?php
                }
                ?>
                <span class="thumb-info-title">
                    <span class="thumb-info-inner">Подробнее</span>
                </span>
            </span>
        </span>
    </a>
    <h4 class="mt-md mb-none"><?=$article['name']?></h4>
    <p class="mb-none"><?=$cat['name']?></p>
    </li>

<?php
$html = ob_get_contents();
ob_clean();
return $html;
}

