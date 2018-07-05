<?=getHead($meta)?>
<?=getHeader()?>
<?php
loadHelper(TEMPLATE);
$noImage = "/assets/img/111.png";
?>
<div class="header-page bordered">
    <h1 class="title-category"><?=$article['name']?></h1>
</div>
<div class="category-gallery">
  <div class="gallery-wrap js-gallery">
<?php
    // Доп фото
    $model = getModel('images');
    $images = $model->getByArticleId($article['id'],1);
    $i =  0;
    if($images){
      foreach ($images as $image){
        $i++;
?>
    <!-- foto -->
    <div class="gallery-itm">
      <img src="<?=resizeImage($image['image'],400,400,false,60)?>" alt="<?=$article['image'].' - '.$i?>">
       <div class="loupe"><a class="fancybox" href="<?=$image['image']?>" data-fancybox="gallery"></a></div>
    </div>
    <!-- foto -->
<?php
      }
} else {
  echo getLine('Альбом пока пуст!');
}
// Доп фото
?>
  </div>
</div>
<?=getFooter()?>