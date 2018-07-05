<?=getHead($meta)?>
<?=getHeader()?>
<?php
loadHelper(TEMPLATE);
   $noImage = '/noImage.png';
?>
<div class="bordered">
  <div class="header-page gull container">
    <h1 class="title-main"><?=$category['name']?></h1>
  </div>
</div>
<div class="page-category container">
  <!-- filters -->
  <nav class="filters-list">
    <a href="#" class="itm filter" data-filter="*"><?=getLine('Все')?></a>
    <a href="#" class="itm filter" data-filter=".events"><?=getLine('Мероприятия')?></a>
    <a href="#" class="itm filter" data-filter=".decore"><?=getLine('Интерьер')?></a>
    <a href="#" class="itm filter" data-filter=".food"><?=getLine('Еда')?></a>
  </nav>
  <!-- filters -->

  <!-- wrap -->
  <div class="wrap-category js-albums-mix">
    <?php
    if($articles){
    foreach ($articles as $article) {
    ?>
    <!-- album -->
    <div class="category-itm mix col <?=$article['filtr']?>" style="background-image: url(<?=$article['image']?>)">
      <!-- label -->
      <div class="label"><?php if($article['filtr'] == 'events') echo getLine('Мероприятия'); elseif($article['filtr'] == 'decore') echo getline('Интерьер'); elseif($article['filtr'] == 'food') echo getLine('Еда');?></div>
      <!-- label -->
      <div class="wrap-title">
        <h4 class="title">
          <a href="<?=getFullUrl($article)?>"><?=$article['name']?></a>
        </h4>
        <div class="wrap-btn"><a href="<?=getFullUrl($article)?>" class="btn-main"><?=getLine('Посмотреть')?></a></div>
      </div>
    </div>
    <!-- album -->
    <?php
      }
    }
    ?>
  </div>
  <!-- wrap -->
</div>
<?=getFooter()?>