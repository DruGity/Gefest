<?=getHead($meta)?>
<?=getHeader()?>
<?php
loadHelper(TEMPLATE);
$noImage = '/noImage.png';
?>
<div class="ps-breadcrumb ps-breadcrumb--2">
        <div class="ps-container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                    <ol class="breadcrumb">
                        <li><a href="/<?php if (isset($_GET['lang'])) echo '?lang='.$_GET['lang']?>"><?=getLine('Главная')?></li></a>
                        <li><a href="<?=getFullUrl($category)?>"><?=$category['name']?></a></li>
                        <li class="active"><?=$article['name']?></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="ps-product--detail ps-product--detail-group">
        <div class="ps-container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="ps-product__thumbnail">
                        <div class="ps-product__images-large">
                        	<?php
                    // Доп фото
                            $model = getModel('images');
                            $images = $model->getByProductId($article['id'],1);
                            $i =  0;
                            if($images){
                                foreach ($images as $image){
                                    $i++;
                                    //var_dump($images);die();
                                    ?>
                                    <div class="item"><img src="<?=resizeImage($image['image'], 660, 800) ?>" alt="<?=$article['name']?> (photo №<?=$i?>)"><a class="ps-product__zoom single-image-popup" href="<?= $image['image'] ?>"><i class="exist-zoom"></i></a></div>
                            <?php
                                }
                            }
                                // Доп фото
                                ?>

                        </div>
                        <div class="ps-product__nav">
                        	<?php
                        	if($images){
                                foreach ($images as $image){
                                    $i++;
                                    //var_dump($images);die();
                                    ?>

                                    <div class="item"><img src="<?=resizeImage($image['image'], 660, 800) ?>" alt="<?=$article['name']?> (photo №<?=$i?>)"></div>
                            <?php
                                }
                            }
                                // Доп фото
                                ?>


                        </div>
                        <div class="clearfix"></div>
                        <?php
                        if($article['youtube'] != '')
                        {
                        ?>
                        <div class="ps-product__video"><a class="video-popup" href="<?=$article['youtube']?>"><i class="exist-play"></i>Смотреть видео</a></div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                $mProductMarks = getModel('productmarks');
                $countMarks = $mProductMarks->getMarksPerProductCount($article['id']);
                if($user)
                {
                $is_marked = $mProductMarks->getMarkPerProductUser($article['id'],$user['id']);
                }
                ?>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="ps-product__info">
                        <h1 class="ps-product__title"><?=$article['name']?></h1>
                        <?php
                        if($article['discount'] != '')
                        {
                        ?>
                        <h4 class="ps-product__price"><?=$price = ($article['price1']/100)*(100-$article['discount']).' грн.';?></h4>
                        <span style="font-size: 17px">Старая цена:</span> <del style="font-size: 17px"><?=$article['price1']?></del>
                        <?php
                        }
                        else
                        {
                            ?>
                            <h4 class="ps-product__price"><?=$article['price1']?></h4>
                            <?php
                        }
                        ?>
                      <div class="ps-product__rating">
                            <select class="ps-rating" data-is-marked="<?php if($user) echo $is_marked?>" data-average-count='<?php echo (int)$article['mark']?>' data-product-id='<?=$article['id']?>' data-user-id='<?php if($user) echo $user['id']?>'>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select><span>Оценок (<span class="marks-count"><?=$countMarks?></span>)</span>
                        </div>
                        <div class="ps-product__short-desc">
                            <?=$article['short_content']?>
                        </div>




                       <!--  <p class="ps-product__sharing">Share:<a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></p> -->
                       <div class="share42init"> </div>
                        <div class="ps-product__content">
                            <ul class="tab-list" role="tablist">
                                <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Описание</a></li>

                               <li><a href="#tab_03" aria-controls="tab_03" role="tab" data-toggle="tab">Отзывы(<?=$comments_count?>)</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="tab_01">
                                    <div class="ps-content">
                                        <?=$article['content']?>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="tab_03">
                                   <!--  <p class="mb-20">0 review for <strong>Smocked blouse</strong></p> -->
                                    <div class="ps-comments">
                                        <?php
                                                $mUser = getModel('users');
                                                if ($comments)
                                                {
                                                foreach ($comments as $comment)
                                                {
                                                $user1 = $mUser->getUserById($comment['user_id']);
                                        ?>
                                        <div class="ps-block--comment">
                                            <div class="ps-block__header"><img style="width: 60px; height: 60px;" src="<?=$user1['avatar']?>" alt="<?=$user1['name']?>">
                                                <p><?=$user1['name']?></p><span class="date"> <?=$date = date('d', $comment['date_unix']) . "." . date('m', $comment['date_unix']) . "." . date('Y', $comment['date_unix']);?></span>
                                            </div>
                                            <div class="ps-block__content">
                                                <p><?=$comment['comment']?></p>
                                            </div>
                                        </div>
                                        <?php
                                                }
                                                }
                                                else
                                                {
                                                    echo "У этой новости еще нет комментариев.";
                                                }
                                        ?>
                                    </div>
                                    <!-- comments -->
                                    <?php
                                        if($user)
                                        {
                                    ?>
                                    <form action="" class="ps-form--blog-comment" method="post">
                                        <div class="form-group">
                                                <textarea  name="comment_input" class="form-control" rows="6" placeholder="Оставте тут ваш комментарий"></textarea>
                                        </div>
                                        <div class="form-group text-center">
                                            <button name="add_comment_to_product" class="ps-btn ps-btn--black">Комментировать</button>
                                        </div>
                                    </form>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                    <!-- logIn -->
                                    <div class="logIn" id="logIn">
                                        <p><?=getLine('Для того чтобы оставить комментарий необходимо авторизироваться!')?></p>
                                        <script src="//ulogin.ru/js/ulogin.js"></script>
                                        <div id="uLogin4f2eaecf" data-ulogin="display=panel;fields=first_name,last_name,email;optional=phone,city,country,photo_big,photo,nickname,bdate,sex;verify=1;providers=google,vkontakte,odnoklassniki,facebook,mailru,yandex;hidden=twitter,livejournal,openid,lastfm,linkedin,liveid,soundcloud,steam,flickr,uid,youtube,webmoney,foursquare,tumblr,googleplus,vimeo,instagram,wargaming;redirect_uri=<?=getProtocol()?>%3A%2F%2F<?=$_SERVER['SERVER_NAME']?>%2Flogin%2Fsoc%2F"></div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>

                            </div>

                        </div>
                        <?php
                        if($article['instagram'])
                        {
                        ?>
                         <a href="<?=$article['instagram']?>" style="margin-top: 3%" class="ps-btn ps-btn--black"><i class="exist-minicart mr-5"></i>Узнать цену</a>
                         <?php
                         }
                         ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-section--relate-products">
        <div class="ps-container-fluid">
            <div class="ps-section__header text-center mb-80">
                <h3 class="ps-heading">Похожие товары</h3>
            </div>
            <div class="ps-slider--related-products owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="6" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-nav-left="&lt;i class='exist-leftarrow'&gt;&lt;/i&gt;" data-owl-nav-right="&lt;i class='exist-rightarrow'&gt;&lt;/i&gt;">
                <?php
                $mProducts = getModel('products');
                $relatedProducts = $article['products_id'];
                $relatedProducts = explode('|',$relatedProducts);
                //vdd($relatedProducts);
                if($relatedProducts){
                foreach ($relatedProducts as $related) {
                    $related = trim($related,'*');
                    $relatedProduct = $mProducts->getProductById($related);
                    ?>
                    <div class="ps-product--1" data-mh="product-item">
                    <div class="ps-product__thumbnail">
                        <div class="ps-badge ps-badge--hot"><span><?=$relatedProduct['status']?></span></div>
                        <?php
                                if($relatedProduct['discount'] != '')
                                {
                                ?>
                                <div class="ps-badge ps-badge--sale-off ps-badge--2nd"><span>-<?=$relatedProduct['discount']?></span></div>
                                <?php
                                }
                            if ($relatedProduct['image'] != '')
                                    {
                                     ?>
                                     <img src="<?=resizeImage($relatedProduct['image'],'415','530')?>"  alt="<?=$relatedProduct['name']?> фото">
                                     <?php
                                    }
                                    else
                                    {
                                        ?>
                                    <img src="<?=resizeImage($noImage,'415','530')?>"  alt="<?=$relatedProduct['name']?> фото">
                                        <?php
                                    }
                                    ?>
                             <a class="ps-btn ps-product__shopping" href="<?=getFullUrl($relatedProduct)?>"><i class="exist-minicart"></i>Перейти</a>
                        
                    </div>
                    <div class="ps-product__content"><a class="ps-product__title" href="<?=getFullUrl($relatedProduct)?>"><?=$relatedProduct['name']?></a><span class="ps-product__price"><?=$relatedProduct['price1']?></span>
                    </div>
                </div>
                <?php
                }
                }
                ?>
                       


            </div>
        </div>
    </div>
<?=getInTouch()?>
<?=getFooter()?>
<script type="text/javascript" src="/share42/share42.js"></script>
<!-- logIn -->
<div style="display: none" class="logIn" id="logInModal">
    <p>
        <?=getLine('Для того чтобы оценить товар необходимо авторизироваться!')?>
    </p>
    <script src="//ulogin.ru/js/ulogin.js"></script>
    <div id="uLogin4f2eaecf" data-ulogin="display=panel;fields=first_name,last_name,email;optional=phone,city,country,photo_big,photo,nickname,bdate,sex;verify=1;providers=google,vkontakte,odnoklassniki,facebook,mailru,yandex;hidden=twitter,livejournal,openid,lastfm,linkedin,liveid,soundcloud,steam,flickr,uid,youtube,webmoney,foursquare,tumblr,googleplus,vimeo,instagram,wargaming;redirect_uri=<?=getProtocol()?>%3A%2F%2F<?=$_SERVER['SERVER_NAME']?>%2Flogin%2Fsoc%2F"></div>
</div>