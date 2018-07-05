<?=getHead($meta)?>
<?=getHeader()?>
<?php
loadHelper(TEMPLATE);
  $noImage = '/noImage.png';
?>
<div class="bordered">
  <!-- brreadcrumbs -->
  <div class="breadcrumbs container">
    <a class="link" href="/"><?=getLine('Главаня')?></a>
    <a class="link" href="<?=getFullUrl($category)?>"><?=$category['name']?></a>
    <span class="final"><?=$article['name']?></span>
  </div>
  <!-- brreadcrumbs -->
</div>
<!-- single new -->
<div class="wrap-sidebar container">
  <div class="news-single col">
    <div class="title"><?=$article['name']?></div>
    <?php
    $day = date('d', $article['date_unix']);
    $month = date('m', $article['date_unix']);
    $year = date('Y', $article['date_unix']);
    ?>
    <div class="date"><?=$year.'-'.$month.'-'.$day?></div>
    <!-- content -->
    <div class="news-content">
      <img src="<?=$article['image']?>" alt="<?=$article['name']?>">
     <?=$article['content']?>
    </div>
    <!-- content -->
    <!-- subscribe -->
    <div class="subscribe-block">
      <div class="share42init"></div>
    </div>
    <!-- subscribe -->
  </div>
  <div class="news-sidebar col gull">
    <h4 class="title"><?=getLine('Другие новости')?></h4>
    <div class="wrap-itms">
      <?php
      $mArticles = getModel('articles');
      $articles = $mArticles->getArticlesByCategory($category['id'],3,0,1);
      if($articles)
      {
      foreach($articles as $article1)
      {
      ?>
      <!-- article -->
      <div class="sidebar-itm">
        <?php
        if($article1['image'] != ''){
        ?>
        <a href="<?=getFullUrl($article1)?>">
          <img src="<?=$article1['image']?>" alt="<?=$article1['name']?>">
        </a>
        <?php
        }
        else
        {
          ?>
          <a href="<?=getFullUrl($article1)?>">
            <img src="<?=$noImage?>" alt="<?=$article1['name']?>">
          </a>
        <?php
        }
        ?>
        <h5 class="title"><a href="<?=getFullUrl($article1)?>"><?=$article1['name']?></a></h5>
      </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
</div>
<!-- single new -->
<?=getFooter()?>
<script src="/assets/libs/share42/share42.js"></script>