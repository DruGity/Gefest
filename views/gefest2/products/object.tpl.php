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
    <a href="/obyekti/" class="breadcrumb-link">Объекты</a>
    <span class="final">ЖК «Акрополь»</span>
  </div>
  <!-- breadcrumbs -->
  <!-- banner -->
  <div class="banner-main">
      <img class="banner -desktop" src="<?=getOption('banner-na-glavnoj')?>" alt="Июльские скидки">
      <img class="banner -mobile" src="<?=getOption('banner-na-glavnoj-dlja-mobilnyh')?>" alt="Июльские скидки">
      <a href="#" class="btn -red">Узнать подробнее</a>
  </div>
  <!-- banner -->
</div>
<section class="single-object">
  <h1 class="title-main bg-decore"><?=$article['name']?></h1>
  <div class="container">
    <div class="main-cols">
      <div class="col object-desc">
        <!-- gallery -->
        <div class="gallery-object slider-for">
            <?php
            $model = getModel('images');
            $images = $model->getByProductId($article['id'],1);
            $i =  0;
            if($images){
                foreach ($images as $image){
                    $i++;
                    //var_dump($images);die();
                    ?>
                    <a data-image="<?=$image['image']?>" href="<?=$image['image']?>" class="fancybox" data-fancybox='works'>
                        <img src="<?=$image['image']?>" alt="">
                    </a>
                    <?php
                }
            }
            ?>


        </div>
        <!-- gallery -->
        <div class="gallery-object slider-nav">
            <?php if($images): ?>
                <?php foreach ($images as $image): ?>
                    <img src="<?=$image['image']?>" alt="">
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text">
          <h4 class="title-paragraph"><?=$article['name']?></h4>
          <div class="simple-text">
            <?=$article['content'] ?>
          </div>
        </div>
      </div>
      <div class="col details">
        <!-- object details -->
        <div class="object-details">
          <div class="title-details">
            <div class="title">Реализованный</div>
            <div class="info">
              <p class="info-title">Срок сдачи:</p>
              <p><?=$article['srok_sdachi']?></p>
            </div>
          </div>
          <div class="content">
            <!-- info -->
            <div class="simple-def">
              <span class="title">Адрес:</span>
              <span class="def"><?=$article['address']?></span>
            </div>

            <?= $article['short_content'] ?>
            <!-- info -->
            <div class="price">
              <span class="title">Цена за м<span class="super">2</span>:</span>
              <span><?=$article['price']?> у.е.</span>
            </div>
          </div>
        </div>
        <!-- object details -->
        <!-- callback/form -->
        <div class="btn-block">
          <div class="half col -grey"><a class="inner" href="#">Узнать о рассрочке</a></div>
          <div class="half col -red"><a class="inner" href="#">Записаться на просмотр</a></div>
        </div>
        <!-- callback/form -->
        <!-- slide list -->
        <div class="slide-list">
          <h5 class="title js-slide">
            План квартир по этажам 1-й дом
            <i class="fa fa-chevron-down icon" aria-hidden="true"></i>
          </h5>
          <ul class="content opened">
            <li class="itm col"><a class="link" href="#">Паркинг Нижний уровень</a></li>
            <li class="itm col"><a class="link" href="#">Этаж 1</a></li>
            <li class="itm col"><a class="link" href="#">Этаж 2</a></li>
            <li class="itm col"><a class="link" href="#">Этаж 3</a></li>
          </ul>
        </div>
        <!-- slide list -->
        <!-- slide list -->
        <div class="slide-list">
          <h5 class="title js-slide">
            План квартир по этажам 2-й дом
            <i class="fa fa-chevron-down icon" aria-hidden="true"></i>
          </h5>
          <ul class="content">
            <li class="itm col"><a class="link" href="#">Паркинг Нижний уровень</a></li>
            <li class="itm col"><a class="link" href="#">Этаж 1</a></li>
            <li class="itm col"><a class="link" href="#">Этаж 2</a></li>
            <li class="itm col"><a class="link" href="#">Этаж 3</a></li>
          </ul>
        </div>
        <!-- slide list -->
      </div>
    </div>
  </div>
</section>
<!-- content -->
<!-- sale -->
<div class="sale-block">
  <div class="container">
    <p class="text col">
      Рассрочка с первым взносом всего от 10%
    </p>
    <div class="col">
      <a href="#" class="btn -white">Узнать больше</a>
    </div>
  </div>
</div>
<!-- sale -->
<!-- objects -->
<section class="object-list page-single">
  <!-- objects list -->
  <div class="container">
    <h4 class="title-paragraph">Другие объекты</h4>
    <div class="wrap-objects">
      <!-- object -->
        <?php
            $model = getModel('products');
            $objects = $model->getRandomProducts(3, 1, $article['id']);
            foreach ($objects as $object) : ?>
               <?php
                    if($object['image'] == '') {
                    $object['image'] = getOption('pustaja-kartinka');
                }?>
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
          <?php endforeach; ?>

    <div class="wrap-btn">
      <a href="/obyekti/" class="btn -grey -small">Смотреть все</a>
    </div>
  </div>
  <!-- objects list -->
</section>
<!-- objects -->
<?=getFooter()?>