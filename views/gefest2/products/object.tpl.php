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
    <img class="banner -desktop" src="/assets/img/banners/banner-0.jpg" alt="Июльские скидки">
    <img class="banner -mobile" src="/assets/img/banners/banner-1.jpg" alt="Июльские скидки">
    <a href="#" class="btn -red">Узнать подробнее</a>
  </div>
  <!-- banner -->
</div>
<section class="single-object">
  <h1 class="title-main bg-decore">ЖК «Акрополь»</h1>
  <div class="container">
    <div class="main-cols">
      <div class="col object-desc">
        <!-- gallery -->
        <div class="gallery-object slider-for">
          <a data-image="/assets/img/objects/object-1.jpg" href="/assets/img/objects/objects-1.jpg" class="fancybox" data-fancybox='works'>
            <img src="/assets/img/objects/object-1.jpg" alt="">
          </a>
          <a data-image="/assets/img/objects/object-2.jpg" href="/assets/img/objects/objects-2.jpg" class="fancybox" data-fancybox='works'>
            <img src="/assets/img/objects/object-2.jpg" alt="">
          </a>
          <a data-image="/assets/img/objects/object-3.jpg" href="/assets/img/objects/objects-3.jpg" class="fancybox" data-fancybox='works'>
            <img src="/assets/img/objects/object-3.jpg" alt="">
          </a>
          <a data-image="/assets/img/objects/object-4.jpg" href="/assets/img/objects/objects-4.jpg" class="fancybox" data-fancybox='works'>
            <img src="/assets/img/objects/object-4.jpg" alt="">
          </a>
          <a data-image="/assets/img/objects/object-5.jpg" href="/assets/img/objects/objects-5.jpg" class="fancybox" data-fancybox='works'>
            <img src="/assets/img/objects/object-5.jpg" alt="">
          </a>
          <a data-image="/assets/img/objects/object-6.jpg" href="/assets/img/objects/objects-6.jpg" class="fancybox" data-fancybox='works'>
            <img src="/assets/img/objects/object-6.jpg" alt="">
          </a>
        </div>
        <!-- gallery -->
        <div class="gallery-object slider-nav">
          <img src="/assets/img/objects/object-1.jpg" alt="">
          <img src="/assets/img/objects/object-2.jpg" alt="">
          <img src="/assets/img/objects/object-3.jpg" alt="">
          <img src="/assets/img/objects/object-4.jpg" alt="">
          <img src="/assets/img/objects/object-5.jpg" alt="">
          <img src="/assets/img/objects/object-6.jpg" alt="">
        </div>



      </div>
      <div class="col"></div>
    </div>
  </div>
</section>
<!-- content -->
<?=getFooter()?>