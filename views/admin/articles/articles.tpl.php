<?php if(isset($head)) echo $head; ?>
<?php if(isset($header)) echo $header; ?>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<div id="wrapper">
    <div id="layout-static">
        <?php if(isset($left_sidebar)) echo $left_sidebar; ?>
        <div class="static-content-wrapper">
            <div class="static-content">
                <div class="page-content">
                    <ol class="breadcrumb">

                        <li><a href="/">Главная</a></li>
                        <li class="active"><a href="<?= $_SERVER['REQUEST_URI'] ?>"><?= $title ?></a></li>

                    </ol>
                    <div class="page-heading">
                        <h1><?= $title ?></h1>
                        <div class="options">
                            <div class="btn-toolbar">
                                <a title="Настройки полей" href="/admin/articles/settings/" class="btn btn-default"><i
                                        class="fa fa-fw fa-wrench"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php include(X_PATH.'/application/views/admin/'.$type.'/menu.inc.php'); ?>
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <form id="mass_action_form" method="post" class="form-inline mb10">
                                    <input type="hidden" name="back" value="<?= $_SERVER['REQUEST_URI'] ?>"/>


                                    <!--                            START: Массовые действия-->
                                    <div class="form-group pull-left" id="hidden_mass">
                                        <select name="action" id="mass_action" class="form-control">
                                            <option value="">- Массовые действия -</option>
                                            <option value="active">Активировать</option>
                                            <option value="not_active">Деактивировать</option>
                                            <option value="delete">Удалить</option>
                                        </select>

                                        <input id="mass_action_submit" class="btn btn-default" type="button"
                                               name="mass_action" value="Применить">
                                        <script>
                                            $(document).ready(function () {
                                                $("#mass_action_submit").click(function () {
                                                    var send_action = true;
                                                    if ($("#mass_action").val() == 'delete') {
                                                        if (confirm("Вы точно уверены, что хотите удалить выбранные статьи?") == false)
                                                            send_action = false;
                                                    }
                                                    if (send_action == true)
                                                        $("#mass_action_form").submit();
                                                });
                                            });
                                        </script>
                                    </div>
                                    <!--                            END: Массовые действия-->
                                    <!--                            START: Массовые действия-->
                                    <div class="form-group pull-right" >
                                        <select class="form-control" onchange="window.location.href=this.options[this.selectedIndex].value">
                                            <option > Выбрать раздел </option>
                                            <?php
                                            $mCategories = getModel('categories');
                                            $categories = $mCategories->getAllCategories();
                                            foreach ($categories as $category) {
                                                ?>
                                                <option value="<?='//'.$_SERVER['SERVER_NAME']?>/admin/articles/category/<?=$category['id']?>"><?=$category['name']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <!--                            END: Массовые действия-->

                                    <div class="form-group pull-right">
                                        <input type="text" class="form-control" name="search" placeholder="Поиск..."
                                               value="<?= post('search') ?>"/>

                                        <input class="btn btn-default" type="submit" name="categories_action"
                                               value="Искать">
                                    </div>

                                    <!--div class="form-group pull-right" style="margin-right: 10px">
                                        <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
                                            <select onchange="submit()" name="numb-action" id="numb_action" class="form-control">
                                                <option value="35">- Статей на странице -</option>
                                                <option value="10"<?php if ($per_page == '10') echo 'selected'; ?>>10</option>
                                                <option value="35"<?php if ($per_page == '35') echo 'selected'; ?>>35</option>
                                                <option value="50"<?php if ($per_page == '50') echo 'selected'; ?>>50</option>
                                                <option value="100"<?php if ($per_page == '100') echo 'selected'; ?>>100</option>
                                                <option value="all"<?php if ($per_page == 'all') echo 'selected'; ?>>Все</option>
                                            </select>
                                        </form>

                                    </div-->
                                    <div class="clearfix"></div>
                                    <br>


                                    <!--                            <div class="form-group pull-right">-->
                                    <!--                                <select name="category_id" id="categories-list" class="form-control">-->
                                    <!--                                    <option value="">Во всех разделах</option>-->
                                    <!--                                    --><?php
                                    //                                    $optionsTree = new AdminElementsTree('category');
                                    //                                    echo $optionsTree->createOptionsTreeForSelect($categories, 0);
                                    //                                    ?>
                                    <!--                                </select>-->
                                    <!---->
                                    <!--                                <input class="btn btn-default" type="submit" name="categories_action" value="Применить">-->
                                    <!--                            </div>-->

                                    <div class="panel">
                                        <div class="panel-body panel-no-padding">
                                            
                                            <?php
                                            if(count($articles) < 1) echo '<div class="text-info" style="padding-left: 30px">В данном разделе пока ничего нет...</div>';
                                            else {
                                            ?>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="40">
                                                        <!--                                                <div class="icheck checkbox-inline">-->
                                                        <input type="checkbox" name="maincheck" id="maincheck"
                                                               title="Выбрать все"/>
                                                        <!--                                                </div>-->

                                                    <th>Активная</th>
                                                    <th>[ID] Название</th>
                                                    <th>Инфо</th>
                                                    <th>Раздел(ы)</th>
                                                    <?php
                                                    $aitcount = count($admin_in_table);
                                                    for ($aiti = 0; $aiti < $aitcount; $aiti++) {
                                                        $ait = $admin_in_table[$aiti];
                                                        ?>
                                                        <th><?= $ait['rus'] ?></th>
                                                        <?php
                                                    }
                                                    ?>
                                                    <th>Позиция</th>
                                                    <th>Дата</th>
                                                    <th width="125px" align="center">Действия</th>
                                                </tr>
                                                </thead>
                                                <tbody id="page_list">
                                                <?php

                                                // Выводим статьи
                                                if (isset($articles) && ($articles)) {
                                                    $count = count($articles);
                                                    for ($i = 0; $i < $count; $i++) {
                                                        $article = $articles[$i];
                                                        $article = translateArticle($article);

                                                        $name = $article['name'];
                                                        $article_url = getFullUrl($article);
                                                        ?>

                                                        <tr id="<?= $article['id'] ?>"> <!-- tr-<?= $article['id'] ?> -->
                                                            <td>
                                                                <!--                                                        <div class="icheck checkbox-inline">-->
                                                                <input id="list_<?= $article['id'] ?>" class="chkarr"
                                                                       type="checkbox" name="list[]"
                                                                       value="<?= $article['id'] ?>"/>
                                                                <!--                                                        </div>-->
                                                            </td>
                                                            <td style="text-align: center">
                                                                <img class="row-active"
                                                                     src="<?=GENERAL_DOMAIN?>/img/admin/active-<?= $article['active'] ?>.png"
                                                                     type="articles"
                                                                     row_id="<?= $article['id'] ?>"
                                                                     status="<?= $article['active'] ?>"
                                                                     id="row-active-<?= $article['id'] ?>"
                                                                     title="<?= ($article['active'] == 0 ? 'Активировать' : 'Деактивировать'); ?>"/>
                                                            </td>
                                                            <td>
                                                                <!--                                            ID, название, ссылка-->
                                                                <a title="Перейти к редактированию"
                                                                   href="/admin/articles/edit/<?= $article['id'] ?>/">
                                                                    <?= $name ?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a class="mytooltip"><img src="<?=GENERAL_DOMAIN?>/img/admin/info.png"/>
                                                                    <?php
                                                                    // Выводим детальную инфу о статье
                                                                    showAllAboutArticle($article);
                                                                    ?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <!--                                            Раздел-->
                                                                <div id="tree-default">
                                                                    <ul class="categories-list">
                                                                        <?php
                                                                        $catsArr = explode('|', $article['category_id']);
                                                                        if (is_array($catsArr)) {
                                                                            foreach ($catsArr as $cat) {
                                                                                $cat = str_replace('*', '', $cat);
                                                                                $cat = $this->categories->getCategoryById($cat);
                                                                                if($cat)
                                                                                    echo '<li style="list-style: none;padding-left: 24px;content: \'\'"><a href="/admin/categories/edit/' . $cat['id'] . '/" title="Перейти к редактированию раздела">' . $cat['name'] . '</a></li>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                            <!--                                            Поля, выбранные для отображения в общей таблице-->
                                                            <?php
                                                            $aitcount = count($admin_in_table);
                                                            for ($aiti = 0; $aiti < $aitcount; $aiti++) {
                                                                $ait = $admin_in_table[$aiti];
                                                                ?>
                                                                <th><?= $article[$ait['name']] ?></th>
                                                                <?php
                                                            }
                                                            ?>
                                                            <td>
                                                                <!--                                                ПОЗИЦИЯ-->
                                                                <div style="float:left; 75%">
                                                                    <?= $article['num'] ?>
                                                                </div>
                                                                <div
                                                                    style="float: right; text-align: right; width: 25%">
                                                                    <?php
                                                                    if ($article['num'] < ($articlesNewNum - 1)) {
                                                                        ?>
                                                                        <a href="/admin/articles/up/<?= $article['id'] ?>/"><img
                                                                                src="<?=GENERAL_DOMAIN?>/img/uparrow.png" border="0"
                                                                                alt="Вверх"
                                                                                title="Вверх"/></a>
                                                                        <?php
                                                                    } else echo '&nbsp;&nbsp;&nbsp;';

                                                                    if ($article['num'] > 0) {
                                                                        ?>
                                                                        <a href="/admin/articles/down/<?= $article['id'] ?>/"><img
                                                                                src="<?=GENERAL_DOMAIN?>/img/downarrow.png" border="0"
                                                                                alt="Вниз"
                                                                                title="Вниз"/></a>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </td>

                                                            <td><?= $article['date'] ?></td>
                                                            <td>
                                                                <?php
                                                                $url = getFullUrl($article);
                                                                if ($article['active'] != 1) $url .= '?admin_preview'
                                                                ?>
                                                                <a href="<?= $url ?>" target="_blank"
                                                                   class="btn btn-success btn-xs btn-label"><i
                                                                        class="fa fa-search"></i>Просмотр</a><br/>

                                                                <a href="/admin/articles/?clone_id=<?=$article['id']?>"
                                                                   class="btn btn-warning btn-xs btn-label"><i
                                                                        class="fa fa-clone"></i>Дублировать</a><br/>

                                                                <a href="/admin/articles/edit/<?= $article['id'] ?>/"
                                                                   class="btn btn-default btn-xs btn-label"><i
                                                                        class="fa fa-pencil"></i>Редактировать</a><br/>

                                                                <a href="#"
                                                                   class="row-del btn btn-danger btn-xs btn-label"
                                                                   id="del-<?= $article['id'] ?>"
                                                                   type="articles"
                                                                   row_id="<?= $article['id'] ?>"><i
                                                                        class="fa fa-trash-o"></i>Удалить</a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                            <?php } ?>
                                </form>
                            <div class="text-center">
                                 <div class="pagination">
                                     <ul class="pagination">
                             <?php
                            if ($page!=1 && $page != 0) {
                                $previous = $page-1;
                                ?>
                                <li><a href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?page='.$previous?>"><i class="fa fa-angle-left"></i></a></li>
                                <?php
                                }
                            if($page > 3 && $page < $count1){
                                    ?>
                                    <li><a href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?page=1'?>">1..</a></li>
                                    <?php
                                for ($i=$page-3; $i <= $page+3; $i++) {
                                    if ($page == $i) {
                                        ?>
                                        <li class="active"><a href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?page='.$i?>"><?=$i?></a></li>
                                        
                                        <?php
                                    }
                                    else
                                    {
                                   ?>
                                   
                                   <li><a href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?page='.$i?>"><?=$i?></a></li>
                                   <?php
                                   }
                                }
                                ?>
                                 <li><a href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?page='.$count1?>"><?='..'.$count1?></a></li>
                             
                                <?php
                                }
                                elseif($page >= $count1)
                                {
                                   for ($i=$page-3; $i == $count1; $i++) {
                                    if ($page == $i) {
                                        ?>
                                        <li class="active"><a href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?page='.$i?>"><?=$i?></a></li>
                                        <?php
                                    }
                                    else
                                    {
                                   ?>
                                    <li><a href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?page='.$i?>"><?=$i?></a></li>
                                   <?php
                                }
                                }
                                }
                                else
                                {
                                   for ($i=1; $i <= 5; $i++) {
                                    if ($page == $i) {
                                        ?>
                                        <li class="active"><a href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?page='.$i?>"><?=$i?></a></li>
                                        <?php
                                    }
                                    else
                                    {
                                   ?>
                                   <li><a href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?page='.$i?>"><?=$i?></a></li>
                                   <?php
                                }
                                }
                                ?>
                                <li><a href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?page='.$count1?>"><?='..'.$count1?></a></li>
                                <?php
                                }

                                if($page < ($count1))
                                {
                                $next = $page+1;
                                ?>
                                <li><a href="<?='//'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?page='.$next?>"><i class="fa fa-angle-right"></i></a></li>
                               
                                <?php
                                }
                                ?>
                                       </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- .container-fluid -->
        </div> <!-- #page-content -->
    </div>

    <script>
        $("input[type='checkbox']").click(function () {

            if ($('input:checkbox:checked')) {
                $("#hidden_mass").fadeIn("fast");
            } else $("#hidden_mass").fadeOut("fast");

            var selectedItems = new Array();
            $("input[type='checkbox']:checked").each(function () {
                selectedItems.push($(this).val());
            });
            if (selectedItems.length > 0) {
                //$("#hidden_mass").fadeIn("fast");
                //alert(123);
            } else {
                //$("#hidden_mass").fadeOut("fast");
                alert(22222);
            }


            $("input[type='checkbox']").each(function () {
                if ($(this).prop('checked')) {
                    //$("#hidden_mass").fadeIn("fast");
                } else {
                    //$("#hidden_mass").fadeOut("fast");
                }
            });

            if ($('input:checkbox:checked')) {
                $("#hidden_mass").fadeIn("fast");
            } else $("#hidden_mass").fadeOut("fast");
        });
    </script>

<script>
    $(document).ready(function(){
        $( "#page_list" ).sortable({
            placeholder : "ui-state-highlight",
            update  : function(event, ui)
            {
                var page_id_array = new Array();
                $('#page_list tr').each(function(){
                    page_id_array.push($(this).attr("id"));
                });
                $.ajax({
                    url:"/admin/ajax/sort/",
                    method:"POST",
                    data:{
                        page_id_array:page_id_array
                    },
                    success:function(data)
                    {
                        
                    }
                });
            }
        });

    });
</script>