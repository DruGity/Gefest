<?=getHead($meta)?>
<?=getHeader()?>
<?php
loadHelper(TEMPLATE);
?>
<div class="container">
  <!-- breadcrumbs -->
  <div class="breadcrumbs-block">
    <a href="/" class="breadcrumb-link">Главная</a>
    <span class="final"><?=$page['name']?></span>
  </div>
  <!-- breadcrumbs -->
  <!-- banner -->
  <div class="banner-main container">
      <img class="banner -desktop" src="<?=getOption('banner-na-glavnoj')?>" alt="Июльские скидки">
      <img class="banner -mobile" src="<?=getOption('banner-na-glavnoj-dlja-mobilnyh')?>" alt="Июльские скидки">
    <a href="#" class="btn -red">Узнать подробнее</a>
  </div>
  <!-- banner -->
</div>
<section class="credit">
  <h1 class="title-main bg-decore"><?=$page['name']?></h1>
  <div class="container credit-block">
    <div class="wrap-table">
      <?=$page['content']?>
    </div>
    <!-- form -->
    <div class="credit-form">
      <div class="title-form">
        <h1 class="title">Подберите себе жилье</h1>
      </div>
      <div class="content">
        <div class="simple-text">
          <p>Для просчета Вашей рассрочки, заполните форму и напишите контактные данные. Мы подберем все возможные варианты. просчитаем и сообщим Вам все подробности рассрочки</p>
        </div>
        <form action="" method="" class="form-block">
          <div class="wrap-cols">
            <div class="col">
              <!-- жк -->
              <div class="field-block">
                <p class="label">Выберите ЖК</p>
                <div class="select-block field">
                    <?php
                    $mProducts= getModel('products');
                    $last = $mProducts->getProductsByCategory(8,1,0,1);
                    if($last[0]){
                        ?>
                  <p class="selected-itm js-toggle-dropdown">ЖК "Акрополь"</p>
                        <?php
                    }
                    ?>
                  <ul class="select-list dropdown-list">
                    <?php
                    $objects = $mProducts->getProductsByCategory(8,500,0,1);
                    if(!empty($objects)) {
                        foreach ($objects as $object) {

                            ?>

                            <li class="itm js-select-itm"><?= $object['name'] ?></li>
                            <?php
                        }
                    }
                            ?>
                  </ul>
                  <input type="hidden" name="name">
                </div>
              </div>
              <!-- жк -->
              <!-- жк -->
              <div class="field-block">
                <p class="label">Выберите количество комнат</p>
                <div class="select-block field">
                  <p class="selected-itm js-toggle-dropdown">1-комнатная</p>
                  <ul class="select-list dropdown-list">
                    <li class="itm js-select-itm">1-комнатная</li>
                    <li class="itm js-select-itm">2-комнатная</li>
                    <li class="itm js-select-itm">3-комнатная</li>
                    <li class="itm js-select-itm">4-комнатная</li>
                  </ul>
                  <input type="hidden" name="name">
                </div>
              </div>
              <!-- жк -->
              <!-- площади -->
              <div class="field-block">
                <p class="label">Выбор площади</p>
                <div class="select-block field">
                  <p class="selected-itm js-toggle-dropdown">20<span> кв.м.</span></p>
                  <ul class="select-list dropdown-list">
                    <li class="itm js-select-itm">20<span> кв.м.</span></li>
                    <li class="itm js-select-itm">25<span> кв.м.</span></li>
                    <li class="itm js-select-itm">15<span> кв.м.</span></li>
                  </ul>
                  <input type="hidden" name="square">
                </div>
              </div>
              <!-- площади -->
              <!-- аванс -->
              <div class="field-block">
                <p class="label">Желаемая сумма аванса</p>
                <div class="select-block field">
                  <p class="selected-itm js-toggle-dropdown">30 000 у.е.</p>
                  <ul class="select-list dropdown-list">
                    <li class="itm js-select-itm">30 000 у.е.</li>
                    <li class="itm js-select-itm">10 000 у.е.</li>
                    <li class="itm js-select-itm">15 000 у.е.</li>
                  </ul>
                  <input type="hidden" name="square">
                </div>
              </div>
              <!-- аванс -->
            </div>
            <div class="col">
              <!-- phone -->
              <div class="field-block">
                <p class="label">Ваш телефон</p>
                <div class="input-block field">
                  <input type="text" name="phone" id="phone" class="input -red" placeholder="+380(__) ___-__-__">
                </div>
              </div>
              <!-- phone -->
              <!-- name -->
              <div class="field-block">
                <p class="label">Ваше имя</p>
                <div class="input-block field">
                  <input type="text" name="clientName" class="input">
                </div>
              </div>
              <!-- submit -->
              <div class="field-block">
                <div class="submit-block field">
                  <input type="submit" class="submit btn -red" value="Расчитайте мне">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- form -->
  </div>
</section>
<!-- objects -->
<section class="object-list">
  <h3 class="title-main bg-decore">Объекты</h3>
  <!-- objects list -->
  <div class="container">
    <div class="wrap-objects">
      <!-- object -->
        <?php
        $model = getModel('products');
        $objects = $model->getRandomProducts(3, 1);
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
      <a href="#" class="btn -grey -small">Смотреть все</a>
    </div>
  </div>
  <!-- objects list -->
</section>
<!-- objects -->
<?=getFooter()?>