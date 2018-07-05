<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: XomiaK
 * Date: 23.07.2017
 * Time: 19:12
 */

function getRandWowEffect(){
    $wowArr = array(
        'bounceInDown', 'jackInTheBox','rollIn','zoomInUp','slideInDown','rotateInUpLeft','lightSpeedIn','flipInX','flipInY','flip'
    );
    $randWow = rand(0,count($wowArr)-1);
    return $wowArr[$randWow];
}

function getRandWowAttention(){
    $wowArr = array(
        'pulse', 'wobble','flash','rubberBand','shake','swing','tada','jello'
    );
    $randWow = rand(0,count($wowArr)-1);
    return $wowArr[$randWow];
}

function getArticleBlock($article, $widthLink = true, $wow = 'Top')
{
    ob_start();
    $url = getFullUrl($article);
    ?>
    <div class="apartment-item wow slideIn<?=$wow?>">
        <?php if ($widthLink) echo '<a href="' . $url . '">'; ?>
        <h2 class="item-price"><?= $article['name'] ?></h2>
        <?php if ($widthLink) echo '</a>'; ?>

        <p class="apartment-desc article-desc">
        <span class="date"><?=getWordDate($article['date'], true)?></span>
        <?php if ($article['image'] != '') { ?>
           <img src="<?=CreateThumb(600,400,$article['image'],'articles')?>" class="article-block-img" style="float: left; margin-right: 15px; max-width: 30%" alt="<?=$article['name']?>" />
        <?php } ?>
            <?= $article['short_content'] ?>
        </p>
        <a href="<?=$url?>" class="button" style="float: right;">Читать дальше >></a>
    </div>
    <div style="clear: both"></div>
    <?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}

function getApartmentBlock($article, $widthLink = true, $wow = 'Top')
{
    ob_start();
    $url = getFullUrl($article);
    ?>
    <div class="apartment-item wow slideIn<?=$wow?>">
        <?php if ($widthLink) echo '<a href="' . $url . '">'; ?>
        <h2>
            <span><?= $article['name'] ?></span>
            <?php if($article['subname'] != '') echo ' - '.$article['subname']; ?>
        </h2>
        <?php if ($widthLink) echo '</a>'; ?>

        <p class="item-price"><?= $article['price'] ?></p>
        <!--a href="" class="button">Заказать</a-->
        <p class="apartment-desc">
            <?= $article['short_content'] ?>
        </p>
        <?php
        $model = getModel('images');
        $images = $model->getByArticleId($article['id']);
        //vd($images);
        if ($images) {
            ?>
            <div class="container-full">
                <div class="container-slider">
                    <div class="swiper-container slider-<?= $article['id'] ?>">
                        <div class="swiper-wrapper">
                            <?php
                            $caption = $article['name'] . ' (' . $article['subname'] . ')';
                            $i = 0;
                            foreach ($images as $image) {

                                echo '<div class="swiper-slide">';
                                echo '<a href="' . $image['image'] . '" data-fancybox="images" data-caption="' . $caption . '">';
                                echo '<img src="' . createThumb(400, 420, $image['image'], 'apartments') . '" alt="' . $article['name'] . ' (Фото №' . ($i++) . ')">';
                                echo '</a>';
                                echo '</div>';

                                if($i == 9) break;

                            }
                            ?>
                        </div>


                        <!-- Add Arrows -->

                    </div>
                    <div class="slider-nav slider-button-next slider_<?= $article['id'] ?>-next"></div>
                    <div class="slider-nav slider-button-prev slider_<?= $article['id'] ?>-prev"></div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}

function get_template_block($type, $params)
{
    if ($type == 'gallery' && isset($params['category_id'])) {
        if (isset($params['category_id'])) {
            $model = getModel('images');
            $images = $model->getByCategoryId($params['category_id'], 1);
            $data['images'] = $images;
            $CI = &get_instance();

            $getHtml = false;
            if (isset($params['getHtml']) && $params['getHtml'] == true) $getHtml = true;

            $result = $CI->load->view('blocks/gallereya.tpl.php', $data, $getHtml);
            if ($getHtml) return $result;
        }
    }
}

function getSwiperGallery($images)
{
    ob_start();
    ?>
    <!-- Swiper -->
    <div class="gallery" style="width: 100%; height: 100%; min-height: 200px">
        <div class="swiper-container gallery-top wow slideInLeft" style="height: 80%">
            <div class="swiper-wrapper">
                <?php
                $i = 0;
                foreach ($images as $image) {
                    $caption = "Фото №".(++$i);
                    if(($image['text'] = strip_tags($image['text'])) != '')
                        $caption = $image['text'];
                    ?>

                        <div class="swiper-slide fancybox-slide-div" style="background-image:url(<?= $image['image'] ?>)"></div>

                    <?php
                }
                ?>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-white"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
        </div>
    <div class="swiper-container gallery-thumbs wow slideInRight" style="height: 20%">
        <div class="swiper-wrapper">
            <?php
            foreach ($images as $image) {
                ?>
                <div class="swiper-slide" style="background-image:url(<?= CreateThumb(240,175,$image['image'],'gallery') ?>)"></div>
                <?php
            }
            ?>
        </div>
    </div>
    <link rel="stylesheet" href="/css/gallery.css">
    <script src="/libs/swiper/js/swiper.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var galleryTop = new Swiper('.gallery-top', {
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            spaceBetween: 10,
        });
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 10,
            centeredSlides: true,
            slidesPerView: 5,
            touchRatio: 0.2,
            slideToClickedSlide: true
        });
        galleryTop.params.control = galleryThumbs;
        galleryThumbs.params.control = galleryTop;


    </script>
    <?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}

function getPageSlider($images, $name = ''){
    ob_start();
    if($images){
                ?>
                <div class="container-full">
                    <div class="container-slider">
                        <div class="swiper-container slider-fishing">
                            <div class="swiper-wrapper">
                                <?php
                                $i = 0;
                                foreach ($images as $image){
                                    $alt = $name.'(Фото №'.(++$i).')';
                                    ?>

                                    <div class="swiper-slide wow slideInLeft">
                                        <a href="<?=$image['image']?>" data-fancybox="images" data-caption="<?=$alt?>">
                                            <img src="<?=CreateThumb(400,420,$image['image'],'400x420')?>" alt="<?=$alt?>">
                                        </a>
                                    </div>

                                    <?php
                                }
                                ?>

                            </div>

                            <!-- Add Arrows -->

                        </div>
                        <div class="slider-nav slider-button-next slider_fishing-next"></div>
                        <div class="slider-nav slider-button-prev slider_fishing-prev"></div>
                    </div>
                </div>
                <?php
            }
    $html = ob_get_contents();
    ob_clean();
    return $html;
}