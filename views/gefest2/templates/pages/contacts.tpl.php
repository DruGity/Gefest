<?=getHead($meta)?>
<?=getHeader()?>
<?php
  loadHelper(TEMPLATE);
?>
<div class="container">
  <!-- breadcrumbs -->
  <div class="breadcrumbs-block">
    <a href="/" class="breadcrumb-link">Главная</a>
    <span class="final">Наши контакты</span>
  </div>
  <!-- breadcrumbs -->
</div>
<section class="contacts-block">
  <h1 class="title-main bg-decore">Наши контакты</h1>
  <div class="container">
    <div class="wrap-cols">
      <div class="col contacts">
        <h4 class="title-paragraph">Позвоните нам:</h4>
        <div class="simple-list phones">
          <h5 class="title">Наши телефоны:</h5>
          <ul class="list">
            <li class="itm"><a href="tel:0487035355"><?=getOption('nomer-telefona-1')?></a></li>
            <li class="itm"><a href="tel:0681215355"><?=getOption('nomer-telefona-2')?></a></li>
            <li class="itm"><a href="tel:0951916555"><?=getOption('nomer-telefona-3')?></a></li>
          </ul>
        </div>
        <h4 class="title-paragraph">Приходите к нам:</h4>
        <div class="simple-list">
          <?=$page['content']?>
        </div>
      </div>
      <div class="col form">
        <h4 class="title-paragraph">Напишите нам:</h4>
        <form action="" method="">
          <!-- field -->
          <div class="field-block">
            <p class="label">Ваше имя</p>
            <div class="input-block field">
              <input type="text" name="name" class="input">
            </div>
          </div>
          <!-- field -->
          <div class="field-block">
            <p class="label">Ваш телефон</p>
            <div class="input-block field">
              <input type="text" name="phone" class="input">
            </div>
          </div>
          <!-- field -->
          <div class="field-block">
            <p class="label">Ваш комментарий</p>
            <div class="input-block field">
              <textarea cols="30" rows="5" class="input" name="comment"></textarea>
            </div>
          </div>
          <!-- submit -->
          <div class="field-block">
            <div class="submit-block field">
              <input type="submit" class="submit btn -red">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="map-block">
    <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2747.2118209752507!2d30.73665621580886!3d46.48411797282915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c631981dfcbc61%3A0xee397e13e5dcd70!2z0YPQuy4g0JTQtdGA0LjQsdCw0YHQvtCy0YHQutCw0Y8sINCe0LTQtdGB0YHQsCwg0J7QtNC10YHRgdC60LDRjyDQvtCx0LvQsNGB0YLRjCwgNjUwMDA!5e0!3m2!1sru!2sua!4v1530782538994" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
</section>

<?=getFooter()?>