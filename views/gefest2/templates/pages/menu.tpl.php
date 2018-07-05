<?=getHead($meta)?>
<?=getHeader()?>
<?php
$noImage = getOption('kartinka-zatychka');
loadHelper(TEMPLATE);
?>
<div class="header-page bordered">
  <h1 class="title-main"><?=$page['name']?></h1>
</div>
<!-- menu -->

<!-- кухня -->
<div class="menu-block container">
  <div class="title-memu kitchen">
    <h3 class="title"><?=getLine('Кухня')?></h3>
  </div>
   <div class="menu-carousel menu-list owl-carousel owl-theme common-dish">
    <!-- breakfest -->
    <div class="menu-itm">
      <!-- navs -->
      <p class="nav-next"><?=getLine('Холодные закуски')?></p>
      <!-- navs -->
      <h4 class="title"><?=getLine('Завтраки')?></h4>
      <!-- price-list -->
      <?=getOption('zavtraki'.$GLOBALS['current_lang'])?>
      <!-- ship -->
      <div class="ship"></div>
      <!-- ship -->
    </div>
    <!-- breakfest -->
    <div class="menu-itm">
      <!-- navs -->
      <p class="nav-prev"><?=getLine('Завтраки')?></p>
      <!-- navs -->
      <h4 class="title"><?=getLine('Холодные закуски')?></h4>
      <!-- price-list -->
      <?=getOption('holodnye-zakuski'.$GLOBALS['current_lang'])?>
      <div class="ship"></div>
      <!-- ship -->
    </div>
    <!-- breakfest -->
  </div>
</div>



<!-- бар -->
<div class="menu-block container">
  <div class="title-memu bar">
    <h3 class="title"><?=getLine('Бар')?></h3>
  </div>
   <div class="menu-carousel menu-list owl-carousel owl-theme common-drinks">
    <!-- breakfest -->
    <div class="menu-itm">
      <!-- navs -->
      <p class="nav-next"><?=getLine('Чай')?></p>
      <!-- navs -->
      <h3 class="title-submenu"><?=getLine('Безалкогольные напитки')?></h3>
      <h4 class="title"><?=getLine('Горячие напитки')?></h4>
      <!-- price-list -->
      <?=getOption('holodnye-zakuski'.$GLOBALS['current_lang'])?>
      <!-- ship -->
      <div class="ship"></div>
      <!-- ship -->
    </div>
    <!-- breakfest -->
    <div class="menu-itm">
      <!-- navs -->
      <p class="nav-prev"><?=getLine('Горячие напитки')?></p>
      <p class="nav-next"><?=getLine('Вино')?></p>
      <!-- navs -->
      <h3 class="title-submenu"><?=getLine('Горячие напитки')?></h3>
      <h4 class="title"><?=getLine('Чай')?></h4>
      <!-- price-list -->
      <?=getOption('chaj'.$GLOBALS['current_lang'])?>
      <!-- ship -->
      <div class="ship"></div>
      <!-- ship -->
    </div>
    <!-- breakfest -->
  </div>
</div>



<!-- кальян -->
<div class="menu-block container hookah">
  <div class="title-memu hookah">
    <h3 class="title"><?=getLine('Кальян')?></h3>
  </div>
   <div class="menu-list">
    <!-- breakfest -->
    <div class="menu-itm hookah">
      <h3 class="title-submenu"><?=getLine('Кальянная карта')?></h3>
      <?=getOption('kaljan'.$GLOBALS['current_lang'])?>
    </div>
    <!-- breakfest -->
  </div>
</div>
<!-- menu -->
<?=getFooter()?>