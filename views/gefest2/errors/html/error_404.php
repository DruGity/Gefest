<?=getHead()?>
<?=getHeader()?>
<?php
  loadHelper(TEMPLATE);
?>
<!-- content -->
<div class="container not-found">
  <!-- breadcrumbs -->
  <div class="breadcrumbs-block">
    <a href="/" class="breadcrumb-link">Главная</a>
    <span class="final">404</span>
  </div>
  <!-- breadcrumbs -->
  <div class="wrap-cols">
    <div class="col">
      <img src="/assets/img/gefest.png" alt="Гефест">
      <p class="middle-text">
        Гефест — в греческой мифологии бог огня, самый искусный кузнец, покровитель кузнечного ремесла, изобретений, строитель всех зданий на Олимпе, изготовитель молний Зевса.
      </p>
    </div>
    <div class="col">
      <img src="/assets/img/404.png" alt="">
      <p class="text first">Перейдите</p>
      <a href="/" class="btn -red -small">На главную</a>
      <p class="text second">или позвоните нам</p>
      <p class="text third">(Гефест рекомендует)</p>
    </div>
  </div>
</div>
<?=getFooter()?>