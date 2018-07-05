<?=getHead($meta)?>
<?=getHeader()?>

    <div class="ps-hero bg--cover" data-background="<?php if($category['image'] != '') echo $category['image'];?>">
        <div class="container">
            <h2 class="ps-hero__heading"><?=$category['name']?></h2>
            <div class="ps-breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="/<?php if (isset($_GET['lang'])) echo '?lang='.$_GET['lang']?>"><?=getLine('Главная')?></a></li>
                    <li class="active"><?=$category['name']?></li>
                </ol>
            </div>
        </div>
    </div>
    <main class="ps-main">
        <div class="container">
            <div class="ps-shop">
                <!-- product list -->
            </div>

        </div>
        <div class="ps-shop__morelink text-center mt-30 load-more" ><a class="ps-btn ps-btn--black" href="#">Показать еще</a></div>
    </main>


<script type="text/template" id="product_tpl">
<div class="ps-product-column">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
        <div class="ps-product--1" data-mh="product-item">
            <div class="ps-product__thumbnail">
                <!-- status -->
                <!-- duscount -->
                <img src=""  alt="" class="image">
                <a class="ps-btn ps-product__shopping url_cache" href="">
                    <i class="exist-minicart"></i>Перейти
                </a>
            </div>
            <div class="ps-product__content">
                <a class="ps-product__title url_cache name" href=""></a>
                <span class="ps-product__price">
                    <span class="price1"></span>
                    <span class="old"></span>
                </span>
            </div>
        </div>
    </div>
</div>
</script>
<?=getInTouch()?>
<?=getFooter()?>