<?php if(isset($head)) echo $head; ?>
<?php if(isset($header)) echo $header; ?>
<?php
//include("application/views/admin/common/head.php");
//include("application/views/admin/common/header.php");
?>
    <div id="wrapper">
    <div id="layout-static">
<?php if(isset($left_sidebar)) echo $left_sidebar; ?>
    <div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">

            <div class="page-heading">
                <h1>Панель администратора</h1>
                <div class="options">
                    <div class="btn-toolbar">
                        <a href="/admin/main/edit/" class="btn btn-default"><i class="fa fa-fw fa-wrench"></i></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">


                <div data-widget-group="group1">
                    <?php if(!isset($msg)){ ?>
                    <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
                        <div class="row">
                            <h2>Форма связи с техподдержкой</h2>
                        </div>
                        <div class="row">
                            Ваше имя:
                            <input class="form-control" required type="text" name="name" value="<?=$user['name']?>" id="inp_url">
                        </div>
                        <div class="row">
                            Ваш тел:
                            <input class="form-control" required type="text" name="tel" value="<?=$user['tel']?>" id="inp_url">
                        </div>
                        <div class="row">
                            Ваш e-mail:
                            <input class="form-control" required type="email" name="email" value="<?=$user['email']?>" id="inp_url">
                        </div>
                        <div class="row">
                            Причина обращения:
                            <input class="form-control" required type="text" name="subject" id="inp_url">
                        </div>

                        <div class="row">
                            Текст:
                            <textarea  class="form-control" id="editor1" name="message" required></textarea>
                        </div>
                        <div class="row">
                            <input class="form-control" type="submit" name="send" value="Отправить!" />
                        </div>
                    </form>
                    <?php } else echo '<div class="message">'.$msg.'</div>';?>
                    <script>

                    </script>





                </div>


            </div> <!-- .container-fluid -->
        </div> <!-- #page-content -->
    </div>

    <?php
    $adding_scripts = '
<script type="text/javascript" src="'.GENERAL_DOMAIN.'/includes/assets/plugins/fullcalendar/fullcalendar.min.js"></script>   				<!-- FullCalendar -->

<script type="text/javascript" src="'.GENERAL_DOMAIN.'/includes/assets/plugins/wijets/wijets.js"></script>     								<!-- Wijet -->

<script type="text/javascript" src="'.GENERAL_DOMAIN.'/includes/assets/plugins/charts-chartistjs/chartist.min.js"></script>               	<!-- Chartist -->
<script type="text/javascript" src="'.GENERAL_DOMAIN.'/includes/assets/plugins/charts-chartistjs/chartist-plugin-tooltip.js"></script>    	<!-- Chartist -->

<script type="text/javascript" src="'.GENERAL_DOMAIN.'/includes/assets/plugins/form-daterangepicker/moment.min.js"></script>              	<!-- Moment.js for Date Range Picker -->
<script type="text/javascript" src="'.GENERAL_DOMAIN.'/includes/assets/plugins/form-daterangepicker/daterangepicker.js"></script>     				<!-- Date Range Picker -->

<script type="text/javascript" src="'.GENERAL_DOMAIN.'/includes/assets/demo/demo-index.js"></script> 										<!-- Initialize scripts for this page-->

<script>
	//Fix since CKEditor can\'t seem to find it\'s own relative basepath
	//CKEDITOR_BASEPATH  =  "/includes/assets/plugins/form-ckeditor/";
	
</script>
<script type="text/javascript" src="'.GENERAL_DOMAIN.'/includes/assets/plugins/form-ckeditor/ckeditor.js"></script>  	<!-- CKEditor -->

  	<!-- CKFinder -->
';
    ?>
    <!--    <script src="//cdn.ckeditor.com/4.5.10/full-all/ckeditor.js"></script>-->
    <script type="text/javascript" src="'.GENERAL_DOMAIN.'/includes/assets/plugins/form-ckeditor/ckfinder/ckfinder.js"></script>
    <script>
        // Note: in this sample we use CKEditor with two extra plugins:
        // - uploadimage to support pasting and dragging images,
        // - image2 (instead of image) to provide images with captions.
        // Additionally, the CSS style for the editing area has been slightly modified to provide responsive images during editing.
        // All these modifications are not required by CKFinder, they just provide better user experience.

    </script>

    <script>
        $(document).ready(function () {
            if ( typeof CKEDITOR !== 'undefined' ) {
                CKEDITOR.addCss( 'img {max-width:100%; height: auto;}' );
                var editor = CKEDITOR.replace( 'my_notes', {
                    extraPlugins: 'uploadimage,image2,codemirror',
                    removePlugins: 'image',
                    height:350
                } );
                CKFinder.setupCKEditor( editor );
            } else {
                document.getElementById( 'editor1' ).innerHTML = '<div class="tip-a tip-a-alert">This sample requires working Internet connection to load CKEditor from CDN.</div>'
            }
    </script>

<?php
if(isset($footer)) {
    $footer = str_replace('[adding_scripts]', $adding_scripts, $footer);
    echo $footer;
}
?>