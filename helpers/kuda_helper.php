<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function getSideBar()
{
    ob_start();
    $mArticles = getModel('articles');
    $articles = $mArticles->getArticlesByCategory(4,500,0,1);
    ?>


                <!--Sidebar-->
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <aside class="sidebar">

                        <!-- Search Form -->
                        <div class="sidebar-widget search-box">
                            <form action="/search/" method="post" class="search">
                                <div class="form-group">
                                    <input type="text" name="search" placeholder="Поиск">
                                    <button value="Поиск" type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>

                        </div>

                        <!-- Recent Posts -->
                        <div class="sidebar-widget recent-posts wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="sidebar-title"><h2>Популярные новости</h2></div>
                        <?php
                        $articles1 = $mArticles->getArticlesByCount(3,0,1,4);
                        if ($articles1) {
                            foreach ($articles1 as $article1) {
                        ?>
                            <article class="post">
                                <?php if ($article1['image'] != '') { ?>
                                        <figure class="post-thumb">
                                            <a  href="<?=getFullUrl($article1)?>">
                                            <img src="<?=resizeImage($article1['image'],76,71)?>" alt="<?=$article1['name']?>">
                                            </a>
                                        </figure>
                                            <?php
                                        }
                                        else
                                        {

                                        }
                                        ?>

                                <h4><a href="<?=getFullUrl($article1)?>"><?=$article1['name']?></a></h4>
                            </article>
                            <?php
                            }
                        }
                        ?>

                        </div>

                        <!-- Popular Tags -->
                        <div class="sidebar-widget popular-tags">
                            <div class="sidebar-title"><h2>Теги</h2></div>
                            <?php
                                $mTags = getModel('tags');
                                $tags = $mTags->getTags(20,0);
                                if ($tags) {

                                    foreach ($tags as $tag ) {
                                        //vdd($tag);

                                ?>
                            <a href="<?='//'.$_SERVER['SERVER_NAME'].'/tags/'.$tag['url']?>"><?=$tag['name']?></a>

                            <?php
                            }
                                }
                            ?>

                        </div>

                    </aside>

                </div>
                <!--Sidebar-->
                <?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}