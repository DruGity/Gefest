<?=$head?>
<?=$header?>
<div id="wrapper">
    <div id="layout-static">
        <?=$left_sidebar?>
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
                                <a href="#" class="btn btn-default"><i class="fa fa-fw fa-wrench"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php include(X_PATH.'/application/views/admin/parsers/menu.inc.php'); ?>
                    <div class="container-fluid">


                        <div class="row">
                            <div class="col-md-12">


                                <?php
                                if ($parsers) {
                                ?>
                                <div id="result"></div>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr bgcolor="#EEEEEE">
                                        <th>ID</th>
                                        <th>Название</th>
                                        <th>Путь</th>
                                        <th>Тип</th>
                                        <th colspan="2" style="text-align: center; width: 100px">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if($parsers) {
                                        foreach ($parsers as $parser) {
                                            ?>
                                            <tr>
                                                <td><?= $parser['id'] ?></td>
                                                <td>
                                                    <a href="/admin/parsers/edit/<?= $parser['id'] ?>/"><?= $parser['name'] ?></a>
                                                </td>
                                                <td><a target="_blank"
                                                       href="<?= $parser['rss_url'] ?>/"><?= $parser['rss_url'] ?></a>
                                                </td>
                                                <td><?= $parser['type'] ?></td>
                                                <td>
                                                    <a href="/admin/parsers/edit/<?= $parser['id'] ?>/"
                                                       class="btn btn-default btn-xs btn-label"><i
                                                            class="fa fa-pencil"></i>Редактировать</a><br/>
                                                    <a href="/admin/menus/add/?from=category&id=<?= $parser['id'] ?>"
                                                       class="btn btn-orange btn-xs btn-label">Добавить в меню</a><br/>
                                                    <a href="#" class="row-del btn btn-danger btn-xs btn-label"
                                                       id="del-<?= $parser['id'] ?>"
                                                       type="parsers"
                                                       row_id="<?= $parser['id'] ?>"><i
                                                            class="fa fa-trash-o"></i>Удалить</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php } else echo 'Тут ещё нет ни одного парсера...';?>
                                <!--                                <div class="text-center">-->
                                <!--                                    <div class="pagination">-->
                                <!--                                        --><?//= $pager ?>
                                <!--                                    </div>-->
                                <!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- .container-fluid -->
        </div> <!-- #page-content -->
    </div>
    <div id="result"></div>

    <?php
    $adding_scripts = "";
    ?>
    <?=$footer?>
