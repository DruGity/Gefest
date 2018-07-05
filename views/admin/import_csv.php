<?php
$myType = userdata('type');
$languages = $this->model_languages->getLanguages();
$defaultLanguage = $this->model_languages->getDefaultLanguage();
$languagesCount = $this->model_languages->languagesCount(1);

?>
<?php if(isset($head)) echo $head; ?>

<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/form-select2/select2.css"
      rel="stylesheet">                        <!-- Select2 -->
<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/form-multiselect/css/multi-select.css"
      rel="stylesheet">           <!-- Multiselect -->
<!--<link type="text/css" href="--><?//=GENERAL_DOMAIN?><!--/includes/assets/plugins/form-fseditor/fseditor.css"-->
<!--      rel="stylesheet">                      <!-- FullScreen Editor -->-->
<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/form-tokenfield/bootstrap-tokenfield.css"
      rel="stylesheet">        <!-- Tokenfield -->
<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/switchery/switchery.css"
      rel="stylesheet">                            <!-- Switchery -->

<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css"
      rel="stylesheet"> <!-- Touchspin -->

<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/js/jqueryui.css"
      rel="stylesheet">                                            <!-- jQuery UI CSS -->

<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/iCheck/skins/minimal/_all.css"
      rel="stylesheet">                   <!-- Custom Checkboxes / iCheck -->
<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/iCheck/skins/flat/_all.css" rel="stylesheet">
<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/iCheck/skins/square/_all.css" rel="stylesheet">

<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/form-daterangepicker/daterangepicker-bs3.css"
      rel="stylesheet">    <!-- DateRangePicker -->
<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/iCheck/skins/minimal/blue.css"
      rel="stylesheet">                   <!-- Custom Checkboxes / iCheck -->
<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/clockface/css/clockface.css"
      rel="stylesheet">                    <!-- Clockface -->

<!--<link type="text/css" href="/includes/assets/plugins/card/lib/css/card.css" rel="stylesheet">-->                                    <!-- Card -->
<link type="text/css" href="<?=GENERAL_DOMAIN?>/includes/assets/plugins/form-select2/select2.css"
      rel="stylesheet">                        <!-- Select2 -->
<?php if(isset($header)) echo $header; ?>
<?php if(isset($error)) echo $error; ?>
<table width="100%" height="100%" cellpadding="0" cellspacing="0">
    <tr>
        
        <td width="20px"></td>
        <td valign="top">
            <div class="title_border">
                <div class="content_title"><h1><?=$title?></h1></div>
                
            </div>
            
            <div class="content">
                
                <form enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>" method="post">
                    <table>
                        <tr>
                            <td>CSV файл:</td>
                            <td><input required type="file" name="userfile" /></td>
			</tr>

                        <tr>
                            <td colspan="2"><input type="submit" value="Добавить" /></td>
                        </tr>
                    </table>
                </form>
                <?php if(isset($msg)) echo $msg;?>
		
            </div>
        </td>
    </tr>
</table>
<?php
echo $footer;
?>