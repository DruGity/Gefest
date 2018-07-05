<?=getHead($meta)?>
<?=getHeader()?>
<?php
$noImage = '/noImage.png';
loadHelper(TEMPLATE);
?>
<div class="bordered">
  <div class="header-page gull container">
    <h1 class="title-main"><?=$category['name']?></h1>
  </div>
</div>
<?php
$mArticles = getModel('articles');
$articles3 = $mArticles-> getLastAkcii();
$lastAkciya = array_pop($articles3);

?>
<div class="page-category container">
  <!-- banner -->
  <div class="banner-sale">
    <div class="label"><?=getLine('Акция')?></div>
    <a href="<?=getFullUrl($lastAkciya)?>">
      <img src="<?=$lastAkciya['image']?>" alt="<?=getLine($lastAkciya['name'])?>">
    </a>
     <div class="wrap-btn"><a href="<?=getFullUrl($lastAkciya)?>" class="btn-main"><?=getLine('Подробнее')?></a></div>
  </div>
  <!-- banner -->
  <!-- wrap -->
  <div class="wrap-category js-wrap-news">

    <!-- news -->

    <div class="category-footer js-footer-news">
      <div class="loader"><img src="/assets/img/loader.gif" alt=""></div>
      <div class="wrap-bt load-more"><a href="#" class="btn-main"><?=getLine('Смотреть больше')?></a></div>
    </div>
  </div>
  <!-- wrap -->
</div>
<?=getFooter()?>
<div id="hiddenBlock" style="display: none"></div>
<script>
  $(window).on("load", function() {
// start script
var start = 0;
var id = <?=$category['id']?>;
$(".load-more a").addClass("disable");

$.ajax({
  type: "GET",
  url: "/ajax/load/more/articles/?start="+start+"&id="+id,
  contentType: "application/json",
  data: '',
  success: function(data) {
    render(JSON.parse(data), ".js-footer-news");
    start += 2;
  },
  error: function(xhr) {
    console.log("Something went wrong!");
    console.log(xhr);
    console.log(xhr.responseText);
  }
});

$(".load-more a").click(function(e){
  e.preventDefault();
  if(!$(this).hasClass("disable")) {
    $.ajax({
      type: "GET",
      url: "/ajax/load/more/articles/?start="+start+"&id="+id,
      processData: false,
      contentType: "application/json",
      data: '',
      success: function(data) {
        var data = JSON.parse(data);
        if(!(data.length === 0)) {
          render(data, ".js-footer-news");
          start += 2;
          $(".loader").show();
        } else {
          $(".js-footer-news").remove();
        }
      },
      error: function(xhr) {
        console.log("Something went wrong!");
        console.log(xhr);
        console.log(xhr.responseText);
      }
    });
  }
});
// end script
});
</script>
<script id="product" type="text/x-jquery-tmpl">
<div class="category-itm col" style="background-image: url(${image})">
      <!-- label -->
      <div class="label">${text}</div>
      <!-- label -->
      <div class="wrap-title">
        <h4 class="title">
          <a href="${url_cache}">${name}</a>
        </h4>
        <div class="wrap-btn"><a href="${url_cache}" class="btn-main"><?=getLine('Посмотреть')?></a></div>
      </div>
    </div>
</script>