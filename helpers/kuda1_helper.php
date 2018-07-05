<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function getLeftSideBarOnMain($place)
{
	ob_start();
	$noImage = "/assets/img/noImage.png";
    ?>
	<div class="col sidebar-left">
			<div class="sidebar-article-wrap">
				<?php
				$mArticles = getModel('articles');
				$interviews = $mArticles->getArticlesByCategory(8,1,0,1);
				if ($interviews) {
				foreach ($interviews as $interview) {
				?>
				<!-- последние интервью -->
				<div class="sidebar-article">
					<div class="img">
						<?php if ($interview['image'] != '') { ?>
                        <a href="<?=getFullUrl($interview)?>">
                            <img src="<?= cropImage($interview['image'], 240,240) ?>" alt="<?= $interview['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?=getFullUrl($interview)?>"><img src="<?= cropImage($noImage, 240, 240) ?>" alt="<?= $interview['name'] ?>"</a>
                        <?php
                    }
                    ?>
					</div>
					<h6 class="title">
						<a href="<?=getFullUrl($interview)?>">
							<?= $interview['name'] ?>
						</a>
					</h6>
				</div>
				<?php
					}
				}
				$articlesM = $mArticles->getArticlesByCategory(7,2,0,1);
				if ($articlesM) {
					foreach ($articlesM as $article) {
				?>
				<!-- последние интервью -->
				<div class="sidebar-article">
					<div class="img">
						<?php if ($article['image'] != '') { ?>
                        <a href="<?=getFullUrl($article)?>">
                            <img src="<?= cropImage($article['image'], 240,240) ?>" alt="<?= $article['name'] ?>">
                        </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="<?=getFullUrl($article)?>"><img src="<?= cropImage($noImage, 240, 240) ?>" alt="<?= $article['name'] ?>"</a>
                        <?php
                    }
                    ?>
					</div>
					<h6 class="title">
						<a href="<?=getFullUrl($article)?>">
							<?= $article['name'] ?>
						</a>
					</h6>
				</div>
				<?php
				}
				}
				?>
			</div>
            <?=getLeftAdvertsOnMain('adv_main_left')?>
	<?php
	$html = ob_get_contents();
	ob_clean();
	return $html;
}

function getLeftAdvertsOnMain($place)
{
	ob_start();
    ?>
            <?php
			        $banners = getBanners("$place");
			        if($banners){
			        foreach ($banners as $banner){
			         if ($banner['url'] != ''){
			                    echo '<a rel="nofollow" target="_blank" href="/banner/' . $banner['id'] . '/" class="institute-itm">'; ?>
			                <div class="adv">
			                    <img  src="<?= $banner['image'] ?>" alt=""></a>
			                </div>
			                <?php
			                    }
			                    else
			                    {
			                    ?>
			                    <div class="adv">
			                    	<a class="adv-itm" data-fancybox="gallery" href="<?=$banner['image']?>"?><img  src="<?= $banner['image'] ?>"  ?></a>
			                    </div>
			        		<?php
			                    }
			                }
			            }
			        ?>
        </div>
    <?php
	$html = ob_get_contents();
	ob_clean();
	return $html;
}

function getRightSideBar($place)
{
	ob_start();
    ?>
	<div class="col sidebar-right">
            <div class="adv">
                <?php
			        $banners = getBanners("$place");
			        if($banners){
			        foreach ($banners as $banner){
			         if ($banner['url'] != ''){
			                    echo '<a rel="nofollow" target="_blank" href="/banner/' . $banner['id'] . '/">'; ?>
			                <div class="adv">
			                    <img  src="<?= $banner['image'] ?>" alt=""></a>
			                </div>
			                <?php
			                    }
			                    else
			                    {
			                    ?>
			                    	<a data-fancybox="gallery" href="<?=$banner['image']?>" ?><img  src="<?= $banner['image'] ?>"  ?></a>
			        		<?php
			                    }
			                }
			            }
			        ?>
            </div>
            <div class="complaint">
                <a href="<?=getOption('ssylka-na-zhalobnuju-knigu')?>"><img src="/assets/img/complaint.jpg" alt=""></a>
            </div>
        </div>
    <?php
	$html = ob_get_contents();
	ob_clean();
	return $html;
}


