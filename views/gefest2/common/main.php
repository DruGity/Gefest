<?=getHead($meta)?>
<?=getHeader()?>
<?php
loadHelper(TEMPLATE);
?>
<!-- banner -->
<div class="banner-main container">
    <img class="banner -desktop" src="<?=getOption('banner-na-glavnoj')?>" alt="Июльские скидки">
    <img class="banner -mobile" src="<?=getOption('banner-na-glavnoj-dlja-mobilnyh')?>" alt="Июльские скидки">
    <a href="<?=getOption('ssylka-bannera')?>" class="btn -red">Узнать подробнее</a>
</div>
<!-- banner -->
<!-- form -->
<div class="container">
  <div class="title-form -mobile js-open-form">
    <h1 class="title">Подберите себе жилье</h1>
    <i class="fa fa-angle-down icon" aria-hidden="true"></i>
  </div>
  <div class="wrap-fit-object">
    <form class="fit-object form" action="" method="POST">
      <div class="half">
        <div class="title-form -desktop">
          <h1 class="title">Подберите себе жилье</h1>
        </div>
        <div class="wrap-fields">
          <!-- жк -->
          <div class="field-block js-step" data-next-step=".js-second-step">
            <p class="label">Выберите ЖК</p>
            <div class="select-block field">
                <?php
                $mProducts= getModel('products');
                $last = $mProducts->getProductsByCategory(8,1,0,1);
                if($last[0]){
                    ?>
                        <p class="selected-itm js-toggle-dropdown"><?=$last[0]['name']?></p><!--первый жк из списка-->
                    <?php
                    }
                    ?>
                 <ul class="select-list dropdown-list">
                  <?php
                    $objects = $mProducts->getProductsByCategory(8,500,0,1);
                    if(!empty($objects)){
                        foreach($objects as $object){
                             if($object['image'] == '') {
                                $object['image'] = getOption('pustaja-kartinka');
                             }?>
                             <li class="itm js-select-itm js-show-object" data-target="<?=$object['image']?>"><?=$object['name']?></li>
                        <?php } ?>
                    <?php } ?>

              </ul>
              <input type="hidden" name="type">
            </div>
          </div>
          <!-- жк -->
          <!-- картинки -->
          <div class="gallery-block js-gallery">
              <?php if($last[0]['image'] == '') {
                  $last[0]['image'] = getOption('pustaja-kartinka');
              }?>
            <img class="itm hidden" src="<?=$last[0]['image']?>" alt="<?=$last[0]['name']?>”"> <!--первый жк из списка-->
            <img class="itm target" src="" alt="ЖК Родос">
          </div>
          <!-- картинки -->
          <!-- тип -->
          <div class="field-block js-step js-second-step" data-next-step=".js-third-step">
            <p class="label">Тип помещения</p>
            <div class="select-block field">
              <p class="selected-itm js-toggle-dropdown disabled">Жилое</p>
              <ul class="select-list dropdown-list">
                <li class="itm js-select-itm">Жилое</li>
                <li class="itm js-select-itm">Офисное</li>
                <li class="itm js-select-itm">Техническое</li>
              </ul>
              <input type="hidden" name="name">
            </div>
          </div>
          <!-- тип -->
          <!-- площади -->
          <div class="field-block js-step js-third-step">
            <p class="label">Выбор площади</p>
            <div class="select-block field">
              <p class="selected-itm js-toggle-dropdown disabled">20<span> кв.м.</span></p>
              <ul class="select-list dropdown-list">
                <li class="itm js-select-itm">20<span> кв.м.</span></li>
                <li class="itm js-select-itm">25<span> кв.м.</span></li>
                <li class="itm js-select-itm">15<span> кв.м.</span></li>
              </ul>
              <input type="hidden" name="square">
            </div>
          </div>
        </div>
      </div>
      <div class="full">
        <!-- phone -->
        <div class="field-block col">
          <p class="label">Ваш телефон</p>
          <div class="input-block field">
            <input type="text" name="phone" id="phone" class="input -red" placeholder="+380(__) ___-__-__">
          </div>
        </div>
        <!-- name -->
        <div class="field-block col">
          <p class="label">Ваше имя</p>
          <div class="input-block field">
            <input type="text" name="clientName" class="input">
          </div>
        </div>
        <!-- submit -->
        <div class="field-block col">
          <div class="submit-block field">
            <input type="submit" class="submit btn -red">
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- form -->
<!-- objects -->

<section class="object-list">
  <h3 class="title-main bg-decore">Объекты</h3>
  <!-- objects list -->
  <div class="container">
    <div class="wrap-objects">

      <?php foreach($objects as $object): ?>
          <?php if($object['image'] == '') {
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
    <?php endforeach; ?>
    <div class="wrap-btn">
      <a href="	/obyekti/" class="btn -grey -small">Все объекты</a>
    </div>
  </div>
  <!-- objects list -->
</section>
<!-- objects -->
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
<!-- about -->
<section class="about-block">
  <h3 class="title-main bg-decore">Объекты</h3>
  <div class="container">
    <div class="content simple-text">
        <?=getOption('tekst-na-glavnoj')?>
    </div>
  </div>
</section>
<!-- about -->

<?=getFooter()?>