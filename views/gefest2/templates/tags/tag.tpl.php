<?=getHead()?>
<?=getHeader()?>
<?php
$noImage = '/noImage.png';
loadHelper(TEMPLATE);
$category = getModel('categories')->getCategoryById(4);
?>

<div class="ps-hero bg--cover" data-background="<?php if($category['image'] != '') echo $category['image']; ?>">
        <div class="container">
            <h2 class="ps-hero__heading">Новости по тегу <?=$tag['name']?></h2>
            <div class="ps-breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="/"><?=getLine('Главная')?></a></li>
                    <li class="active">Новости по тегу <?=$tag['name']?></li>
                </ol>
            </div>
        </div>
    </div>
    <main class="ps-main">
        <div class="container">
            <div class="ps-blog">
                <div class="ps-blog__category">

                </div>
               
                <div class="ps-blog__posts">
                    
                    <?php
                    
                    if($articles)
                    {
                    foreach ($articles as $article)
                    {
                        $article = translateArticle($article);
                        $day = date('d', $article['date_unix']);
                        $month = date('M', $article['date_unix']);
                        ?>
                        <article class="ps-post--horizontal">
                        <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="<?=getFullUrl($article)?>"></a>


                            <?php
                                 if ($article['image'] != '')
                                    {
                                     ?>
                                     <a href="<?=getFullUrl($article)?>">
                                        <img src="<?=resizeImage($article['image'],'370','250')?>"  alt="<?=$article['name']?> фото">
                                     </a>
                                     <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a href="<?=getFullUrl($article)?>">
                                            <img src="<?=resizeImage($noImage,'370','250')?>"  alt="<?=$article['name']?> фото">
                                        </a>
                                        <?php
                                    }
                                    ?>

                            <div class="ps-post__posted"><span class="date"><?=$day?></span><span class="month"><?=$month?></span></div>
                        </div>
                        <div class="ps-post__content">
                            <h4 class="ps-post__title"><a href="<?=getFullUrl($article)?>"><?=$article['name']?></a></h4>
                            <?=$article['short_content']?><a class="ps-btn--underline ps-post__morelink" href="<?=getFullUrl($article)?>"><?=getLine('Подробнее')?></a>
                        </div>
                    </article>
                    <?php
                    }
                    }
                    ?>

                </div>
            </div>
            
        </div>
    </main>
    <div class="ps-section--instagram">
        <div class="container">
            <div class="ps-section__header">
                <h3><?=getLine('Товары из инстаграма')?></h3>
                <a href="<?=getOption('link_instagram')?>"><p><?=getOption('link_instagram')?></p></a>
            </div>
            <div class="ps-section__content">
                <div class="ps-slider--instagram ps-slider--center owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="3" data-owl-item-sm="4" data-owl-item-md="4" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-nav-left="&lt;i class='exist-leftarrow'&gt;&lt;/i&gt;" data-owl-nav-right="&lt;i class='exist-rightarrow'&gt;&lt;/i&gt;">
                    <a href="<?=getOption('link_instagram')?>"><img src="<?=getOption('foto-instagram-1')?>" alt="instagram arimart 1"></a>
                    <a href="<?=getOption('link_instagram')?>"><img src="<?=getOption('foto-instagram-2')?>" alt="instagram arimart 2"></a>
                    <a href="<?=getOption('link_instagram')?>"><img src="<?=getOption('foto-instagram-3')?>" alt="instagram arimart 3"></a>
                    <a href="<?=getOption('link_instagram')?>"><img src="<?=getOption('foto-instagram-4')?>" alt="instagram arimart 4"></a>
                    <a href="<?=getOption('link_instagram')?>"><img src="<?=getOption('foto-instagram-5')?>" alt="instagram arimart 5"></a>
                    <a href="<?=getOption('link_instagram')?>"><img src="<?=getOption('foto-instagram-6')?>" alt="instagram arimart 6"></a>
                </div>
            </div>
        </div>
    </div>
<?=getFooter()?>
