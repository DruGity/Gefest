<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function getProductBlock($lastProduct)
{
	ob_start();
	?>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                        <div class="ps-product--1" data-mh="product-item">
                            <div class="ps-product__thumbnail">
                                <?php
                                if($lastProduct['status'] != ''){
                                ?>
                                <div class="ps-badge ps-badge--hot"><span><?=$lastProduct['status']?></span></div>
                                <?php
                                }
                                if($lastProduct['discount'] != '')
                                {
                                ?>
                                <div class="ps-badge ps-badge--sale-off ps-badge--2nd"><span>-<?=$lastProduct['discount']?></span></div>
                                <?php
                                }
                                    if ($lastProduct['image'] != '')
                                    {
                                     ?>
                                     <img src="<?=resizeImage($lastProduct['image'],'415','530')?>"  alt="<?=$lastProduct['name']?> фото">
                                     <?php
                                    }
                                    else
                                    {
                                        ?>
                                    <img src="<?=resizeImage($noImage,'415','530')?>"  alt="<?=$lastProduct['name']?> фото">
                                        <?php
                                    }
                                    ?>
                               
                               <a class="ps-btn ps-product__shopping" href="<?=getFullUrl($lastProduct)?>"><i class="exist-minicart"></i>Перейти</a>
                                
                            </div>
                            <div class="ps-product__content">
                                <a class="ps-product__title" href="<?=getFullUrl($lastProduct)?>">
                                    <?=$lastProduct['name']?>   
                                </a>
                                <span class="ps-product__price">
                                    <?=$lastProduct['price1']?>
                                </span>
                            </div>
                        </div>
                    </div>
	<?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}

function getInTouch()
{
ob_start();
?>
<div class="ps-subscribe--2 bg--cover"  data-background="<?=getOption('fon-bloka-podpiski')?>">
        <div class="container">
            <form class="ps-form--subscribe-2" action="" method="post" id="contact-us-form1">
                <h3 class="ps-heading"><?=getLine('Подписка на новости')?></h3>
                <?=getOption('test-podpiski-na-novosti'.$GLOBALS['current_lang'])?>
                <div class="form-group">
                    <input class="form-control" name="E-mail" type="text" placeholder="<?=getLine('Введите свой e-mail')?>">
                    <button onclick="send_form1(); return false;" class="ps-btn"><?=getLine('Подписаться')?></button>
                </div>
            </form>
        </div>
    </div>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}