<?php

$title_min = 10;
$title_max = 70;
$description_min = 50;
$description_max = 160;
$myType = userdata('type');
$languages = $this->model_languages->getLanguages();
$defaultLanguage = $this->model_languages->getDefaultLanguage();
$languagesCount = $this->model_languages->languagesCount(1);
?>
<?= $head ?>

<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/form-select2/select2.css"
      rel="stylesheet">                        <!-- Select2 -->
<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/form-multiselect/css/multi-select.css"
      rel="stylesheet">           <!-- Multiselect -->
<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/form-fseditor/fseditor.css"
      rel="stylesheet">                      <!-- FullScreen Editor -->
<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/form-tokenfield/bootstrap-tokenfield.css"
      rel="stylesheet">        <!-- Tokenfield -->
<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/switchery/switchery.css"
      rel="stylesheet">                            <!-- Switchery -->

<link type="text/css"
      href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css"
      rel="stylesheet"> <!-- Touchspin -->

<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/js/jqueryui.css"
      rel="stylesheet">                                            <!-- jQuery UI CSS -->

<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/iCheck/skins/minimal/_all.css"
      rel="stylesheet">                   <!-- Custom Checkboxes / iCheck -->
<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/iCheck/skins/flat/_all.css" rel="stylesheet">
<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/iCheck/skins/square/_all.css"
      rel="stylesheet">

<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/form-daterangepicker/daterangepicker-bs3.css"
      rel="stylesheet">    <!-- DateRangePicker -->
<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/iCheck/skins/minimal/blue.css"
      rel="stylesheet">                   <!-- Custom Checkboxes / iCheck -->
<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/clockface/css/clockface.css"
      rel="stylesheet">                    <!-- Clockface -->

<!--<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/card/lib/css/card.css" rel="stylesheet">-->                                    <!-- Card -->
<link type="text/css" href="<?= GENERAL_DOMAIN ?>/includes/assets/plugins/form-select2/select2.css"
      rel="stylesheet">                         <!-- Select2 -->
<?= $header ?>

<div id="wrapper">
    <div id="layout-static">
        <?= $left_sidebar ?>
        <div class="static-content-wrapper">
            <div class="static-content">
                <div class="page-content">
                    <ol class="breadcrumb">

                        <li><a href="/admin/">Главная</a></li>
                        <li><a href="/admin/categories/">Разделы</a></li>
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
                    <?php include(X_PATH . '/application/views/admin/parsers/menu.inc.php'); ?>

                    <div data-widget-group="group1">

                        <div class="panel panel-1" data-widget='{"draggable": "false"}'>

                            <div class="panel-editbox" data-widget-controls=""></div>
                            <div class="panel-body">


                                <form enctype="multipart/form-data" action="<?= $_SERVER['REQUEST_URI'] ?>"
                                      method="post" class="form-horizontal row-border">
                                    <div class="container-fluid">

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">
                                                <div class="row">

                                                    <div class="panel-editbox" data-widget-controls=""></div>
                                                    <div class="panel-body">

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Название *:
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <input required id="inp_name" class="form-control" type="text"
                                                                       name="name"
                                                                       value="<?php if (isset($item['name'])) echo $item['name']; ?>">
                                                            </div>
                                                        </div>

                                                        <?php if($action == 'edit') { ?>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Последняя дата парсинга:
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <?php if (isset($item['last_parse'])) echo $item['last_parse']; else 'Не парсилось'; ?>

                                                            </div>
                                                        </div>
                                                        <?php } ?>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Путь к RSS:
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <input id="inp_rss_url" class="form-control" type="text"
                                                                       name="rss_url"
                                                                       value="<?php if (isset($item['rss_url'])) echo $item['rss_url']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Тип RSS:
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <SELECT id="sel_parse_content_from" name="parse_rss_type"
                                                                        class="form-control">
                                                                    <option<?php if (isset($item['parse_rss_type']) && $item['parse_rss_type'] == 'Yandex News RSS') echo ' selected'; ?> value="Yandex News RSS">Yandex News RSS</option>
                                                                    <option<?php if (isset($item['parse_rss_type']) && $item['parse_rss_type'] == 'RSS 2.0') echo ' selected'; ?> value="RSS 2.0" disabled>RSS 2.0</option>
                                                                </SELECT>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Откуда парсить контент:
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <SELECT id="sel_parse_content_from" name="parse_content_from"
                                                                        class="form-control">
                                                                    <option<?php if (isset($item['parse_content_from']) && $item['parse_content_from'] == 'rss') echo ' selected'; ?> value="rss">из RSS</option>
                                                                    <option<?php if (isset($item['parse_content_from']) && $item['parse_content_from'] == 'url') echo ' selected'; ?> value="url" disabled title="Пока не работает...">по ссылке</option>
                                                                </SELECT>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Шаблон основного контента на странице статьи<br/>(если парсим по ссылке):
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <textarea id="inp_content_template" class="form-control"
                                                                       name="content_template"><?php if (isset($item['content_template'])) echo $item['content_template']; ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Название тега с контентом<br/>(если парсим из RSS):
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <input id="inp_content_tag_name" class="form-control" type="text"
                                                                       name="content_tag_name"
                                                                       value="<?php if (isset($item['content_tag_name'])) echo $item['content_tag_name']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Период между обновлениями:
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <input id="inp_period" class="form-control" type="text"
                                                                       name="period"
                                                                       value="<?php if (isset($item['period'])) echo $item['period']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Парсить контент по ссылке:
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <input type="checkbox" id="inp_active" name="active"
                                                                    <?php
                                                                    if ((isset($item['active']) && $item['active'] == 1) || !isset($item)) echo ' checked ';
                                                                    ?>
                                                                       class="bootstrap-switch switch-alt"
                                                                       data-on-color="success"
                                                                       data-off-color="default" data-on-text="ДА"
                                                                       data-off-text="НЕТ"/>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Парсить все матрериалы в раздел:
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <SELECT id="sel_category_id" onchange="set_parser_type()" name="category_id"
                                                                        class="form-control">
                                                                    <option value="0">- нет -</option>
                                                                    <?php
                                                                    $optionsTree = new AdminElementsTree('category');
                                                                    //$optionsTree->setSelectedOptions($item['parent']);
                                                                    echo $optionsTree->createOptionsTreeForSelect($categories, 0);
                                                                    ?>
                                                                </SELECT>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Тип материалов *:
                                                            </label>
                                                            <div class="col-sm-8">

                                                                <SELECT id="inp_type" name="type" required
                                                                        class="form-control">
                                                                    <option value="">- Тип материалов -</option>
                                                                    <option
                                                                            value="articles"<? if (isset($item['type']) && $item['type'] == 'articles')
                                                                        echo ' selected'; ?>>Статьи
                                                                    </option>
                                                                    <option
                                                                            value="products"<? if (isset($item['type']) && $item['type'] == 'products')
                                                                        echo ' selected'; ?>>Товары
                                                                    </option>
                                                                    <option
                                                                            value="gallery"<? if (isset($item['type']) && $item['type'] == 'gallery')
                                                                        echo ' selected'; ?>>Галерея
                                                                    </option>
                                                                </SELECT>
                                                                <div id="inp_type_text"></div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Если раздел не найден, помещаем в раздел:
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <SELECT id="sel_not_finded_categoty_to_category_id" name="not_finded_categoty_to_category_id"
                                                                        class="form-control">
                                                                    <option value="0">- нет -</option>
                                                                    <?php
                                                                    $optionsTree = new AdminElementsTree('category');
                                                                    //$optionsTree->setSelectedOptions($item['parent']);
                                                                    echo $optionsTree->createOptionsTreeForSelect($categories, 0);
                                                                    ?>
                                                                </SELECT>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Активный:
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <input type="checkbox" id="inp_active" name="active"
                                                                    <?php
                                                                    if ((isset($item['active']) && $item['active'] == 1) || !isset($item)) echo ' checked ';
                                                                    ?>
                                                                       class="bootstrap-switch switch-alt"
                                                                       data-on-color="success"
                                                                       data-off-color="default" data-on-text="ДА"
                                                                       data-off-text="НЕТ"/>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">
                                                                Создавать раздел, если раздел с таким названием не найден:
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <input type="checkbox" id="inp_create_new_category" name="create_new_category"
                                                                    <?php
                                                                    if ((isset($item['create_new_category']) && $item['create_new_category'] == 1)) echo ' checked ';
                                                                    ?>
                                                                       class="bootstrap-switch switch-alt"
                                                                       data-on-color="success"
                                                                       data-off-color="default" data-on-text="ДА"
                                                                       data-off-text="НЕТ"/>
                                                            </div>
                                                        </div>


                                                        <?php
                                                        if(isset($params) && is_array($params) && count($params) > 0){
                                                            foreach ($params as $param) {
                                                                $itemParam = false;
                                                                $paramName = $param['name'];
                                                                if(isset($item['params'][$paramName])) {
                                                                    $itemParam = $item['params'][$paramName];
                                                                } else $itemParam = $param['default'];
                                                                ?>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        <?=$param['rus']?>:
                                                                    </label>
                                                                    <div class="col-sm-8">
                                                                        <?php if($param['type'] == 'Строка'){ ?>
                                                                            <input id="inp_param_<?=$paramName?>" class="form-control" type="text"
                                                                                   name="params[<?=$paramName?>]"
                                                                                   value="<?php if ($itemParam) echo $itemParam; ?>">
                                                                        <?php } elseif($param['type'] == 'Логический'){ ?>
                                                                            <input type="checkbox" id="inp_param_<?=$paramName?>" name="params[<?=$paramName?>]"
                                                                                <?php
                                                                                if ($itemParam == 1 || $itemParam == 'on') echo ' checked ';
                                                                                ?>
                                                                                   class="bootstrap-switch switch-alt"
                                                                                   data-on-color="success"
                                                                                   data-off-color="default" data-on-text="ДА"
                                                                                   data-off-text="НЕТ"/>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>



                                                        <input type="hidden" name="action" value="<?= $action ?>"/>

                                                        <div class="form-group fixed-buttons">
                                                            <input class="form-submit save" type="submit"
                                                                   name="<?= $action ?>"
                                                                   title="Сохранить" value=""/>&nbsp;
                                                            <input class="form-submit save_and_close" type="submit"
                                                                   name="<?= $action ?>_and_close"
                                                                   title="Сохранить и закрыть"
                                                                   value=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                            </div>
                            </form>


                        </div>

                        <?php if (isset($itemegory)) include X_PATH . "/application/views/admin/categories/adding-images.inc.php"; ?>


                        <?php
                        $adding_scripts = '
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-multiselect/js/jquery.multi-select.min.js"></script>  			<!-- Multiselect Plugin -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/quicksearch/jquery.quicksearch.min.js"></script>           			<!-- Quicksearch to go with Multisearch Plugin -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-typeahead/typeahead.bundle.min.js"></script>                 	<!-- Typeahead for Autocomplete -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-select2/select2.min.js"></script>                     			<!-- Advanced Select Boxes -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-autosize/jquery.autosize-min.js"></script>            			<!-- Autogrow Text Area -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-colorpicker/js/bootstrap-colorpicker.min.js"></script> 			<!-- Color Picker -->

<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script> <!-- Touchspin -->

<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-fseditor/jquery.fseditor-min.js"></script>            			<!-- Fullscreen Editor -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-jasnyupload/fileinput.min.js"></script>               			<!-- File Input -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-tokenfield/bootstrap-tokenfield.min.js"></script>     			<!-- Tokenfield -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/switchery/switchery.js"></script>     								<!-- Switchery -->

<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/card/lib/js/card.js"></script> 										<!-- Card -->

<!-- <script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/iCheck/icheck.min.js"></script>  -->    							<!-- iCheck // already included on site-level -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/bootstrap-switch/bootstrap-switch.js"></script>     					<!-- BS Switch -->

<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/jquery-chained/jquery.chained.min.js"></script> 						<!-- Chained Select Boxes -->

<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/jquery-mousewheel/jquery.mousewheel.min.js"></script> <!-- MouseWheel Support -->

<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/demo/demo-formcomponents.js"></script>

<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/wijets/wijets.js"></script>     							<!-- Wijet -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/clockface/js/clockface.js"></script>     								<!-- Clockface -->

<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-colorpicker/js/bootstrap-colorpicker.min.js"></script> 			<!-- Color Picker -->

<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>      			<!-- Datepicker -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>      			<!-- Timepicker -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> 	<!-- DateTime Picker -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-daterangepicker/moment.min.js"></script>              			<!-- Moment.js for Date Range Picker -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-daterangepicker/daterangepicker.js"></script>     				<!-- Date Range Picker -->
<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/jcrop/js/jquery.Jcrop.min.js"></script>  	<!-- Image cropping Plugin -->

<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/dropzone/dropzone.min.js"></script>   	<!-- Dropzone Plugin -->
<link type="text/css" href="' . GENERAL_DOMAIN . '/includes/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet"> <!-- Dropzone Plugin -->

//<script>
//	//Fix since CKEditor can\'t seem to find it\'s own relative basepath
//	CKEDITOR_BASEPATH  =  "' . GENERAL_DOMAIN . '/includes/assets/plugins/form-ckeditor/";
//	CKEDITOR.config.customConfig = "' . GENERAL_DOMAIN . '/includes/assets/plugins/form-ckeditor/my_config.js";
//</script>
//<script type="text/javascript" src="' . GENERAL_DOMAIN . '/includes/assets/plugins/form-ckeditor/ckeditor.js"></script>  	<!-- CKEditor -->

';

                        if (isset($footer)) {
                            $footer = str_replace('[adding_scripts]', $adding_scripts, $footer);
                            echo $footer;
                        }
                        ?>

                        <script>
                            function set_parser_type() {
                                var category_type = $('[name="category_id"] option:selected').attr('category_type');
                                $('#inp_type').val(category_type);
                            }
                        </script>