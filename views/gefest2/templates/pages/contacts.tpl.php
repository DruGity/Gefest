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
            <li class="itm"><a href="tel:<?=getOption('nomer-telefona-1')?>"><?=getOption('nomer-telefona-1')?></a></li>
            <li class="itm"><a href="tel:<?=getOption('nomer-telefona-2')?>"><?=getOption('nomer-telefona-2')?></a></li>
            <li class="itm"><a href="tel:<?=getOption('nomer-telefona-3')?>"><?=getOption('nomer-telefona-3')?></a></li>
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
              <input type="submit" class="submit btn -red" value="Отправить">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="map-block">
    <?=getOption('iframe')?>
  </div>
</section>
<!-- .popups -->
<div class="wrap-popup">
  <div class="popup message-success message-simple">
    <i class="fa fa-times js-close-popup close" aria-hidden="true"></i>
    <div class="popup-text">
      <p>Ваш запрос принят.</p>
      <p>В ближайшее время мы с Вами свяжемся!</p>
    </div>
  </div>
</div>
<!-- .popups -->
<?=getFooter()?>