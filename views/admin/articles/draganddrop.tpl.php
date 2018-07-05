<?php if(isset($head)) echo $head; ?>
<?php if(isset($header)) echo $header; ?>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <style>
        body
        {
            margin:0;
            padding:0;
            background-color:#f1f1f1;
        }
        .box
        {
            width:1270px;
            padding:20px;
            background-color:#fff;
            border:1px solid #ccc;
            border-radius:5px;
            margin-top:25px;
        }
        #page_list li
        {
            padding:16px;
            background-color:#f9f9f9;
            border:1px dotted #ccc;
            cursor:move;
            margin-top:12px;
        }
        #page_list li.ui-state-highlight
        {
            padding:24px;
            background-color:#ffffcc;
            border:1px dotted #ccc;
            cursor:move;
            margin-top:12px;
        }
    </style>
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
                                   

                                    

                                    <div class="clearfix"></div>
                                    <br>


                                    <div class="panel">
                                        <div class="panel-body panel-no-padding">
                                            <div class="pagination"><?= $pager ?></div>
                                            <ul class="list-unstyled" id="page_list" style="text-align: center; font-size: 20px; color: black">
                                                    <?php
                                                    
                                                    if ($articles)
                                                    {
                                                        foreach ($articles as $article)
                                                        {
                                                        
                                                        ?>
                                                        <li id="<?=$article['id']?>"><?=$article['name']?></li>
                                                    <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo 'У вас пока нет статей!';
                                                    }
                                                    ?>
                                        </ul>
                                        <input type="hidden" name="page_order_list" id="page_order_list" />
                              
                                <div class="text-center">
                                    <div class="pagination">
                                        <?= $pager ?>
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
    $(document).ready(function(){
        $( "#page_list" ).sortable({
            
            
        });

    });
</script>