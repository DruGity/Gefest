<?=getHead($meta)?>
<?=getHeader()?>
<?php
loadHelper(TEMPLATE);
?>
<!-- content -->
<div class="container">
  <!-- breadcrumbs -->
  <div class="breadcrumbs-block">
    <a href="/" class="breadcrumb-link">Главная</a>
    <span class="final">Объекты</span>
  </div>
  <!-- breadcrumbs -->
  <!-- banner -->
  <div class="banner-main container">
    <img class="banner -desktop" src="/assets/img/banners/banner-0.jpg" alt="Июльские скидки">
    <img class="banner -mobile" src="/assets/img/banners/banner-1.jpg" alt="Июльские скидки">
    <a href="#" class="btn -red">Узнать подробнее</a>
  </div>
  <!-- banner -->
</div>
<secton class="page-objects">
  <h1 class="title-main bg-decore">Объекты</h1>
  <div class="container">
    <div class="filters-block">
      <a href="#" class="itm-filter active">Все</a>
      <a href="#" class="itm-filter">Реализованный</a>
      <a href="#" class="itm-filter">В продаже</a>
    </div>
    <div class="wrap-objects">
    <?php
    $mProducts= getModel('products');
    $objects = $mProducts->getProductsByCategory(8,500,0,1);
    if(!empty($objects)){
    foreach($objects as $object){
        if($object['image'] == '') {
            $object['image'] = getOption('pustaja-kartinka');
        }?>
        <!-- object -->
        <div class="itm-object col">
            <h4 class="title"><?=$object['name']?></h4>
            <div class="photo labeled">
                <div class="label">Реализованный</div>
                <img src="<?=$object['image']?>" alt="<?=$object['name']?>">
            </div>
            <div class="wrap-desc">
                <div class="desc-block">
                    <span class="strong">Адрес: </span><?=$object['address']?>
                </div>
                <div class="desc-block">
                    <span class="strong">Срок сдачи: </span><?=$object['srok_sdachi']?>
                </div>
            </div>
            <div class="wrap-btn">
                <a href="<?=getFullUrl($object)?>" class="btn -red -small">Подробнее</a>
            </div>
        </div>
        <?php } ?>

    <?php } ?>
    </div>
  </div>
</secton>
<!-- content -->
<?=getFooter()?>