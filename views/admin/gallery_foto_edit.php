<?php
include("header.php");
?>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="200px" bgcolor="#DDDDDD" valign="top"><?php include("menu.php"); ?></td>
        <td valign="top">
            <h1><?=$title?></h1>
            <table width="100%" cellpadding="0" cellspacing="0" height="20px" bgcolor="#DDDDDD">
                <tr>
                    <td width="11px" height="20px"><img src="/img/left-hmenu.jpg" /></td>
                    <td><a href="/admin/gallery/">Галерея</a></td>
                    <td><a href="/admin/gallery/add/">Добавить фотку</a></td>
                    <td><a href="/admin/gallery/categories/">Разделы галереи</a></td>
                    <td><a href="/admin/gallery/categories/add/">Добавить раздел галереи</a></td>
                    <td><a href="/admin/options/set_module/gallery/">Настройки</a></td>
                </tr>
            </table>
            <br />
            <strong><font color="Red"><?=$err?></font></strong>
            <form enctype="multipart/form-data" action="/admin/gallery/edit/<?=$foto['id']?>/" method="post">
                <table>
                    <tr>
                        <td>Название *:</td>
                        <td><input required type="text" name="name" size="50" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $foto['name']; ?>" /></td>
                    </tr>                    
                    <tr>
                        <td>Позиция:</td>
                        <td><input type="text" name="num" value="<?php if(isset($_POST['num'])) echo $_POST['num']; else echo $foto['num'];?>" size="3" /></td>
                    </tr>
                    <tr>
                        <td>Раздел *:</td>
                        <td>
                            <SELECT required name="category_id">
                                <option value=""></option>
                                <?php
                                if($categories)
                                {
                                    $count = count($categories);
                                    for($i = 0; $i < $count; $i++)
                                    {
                                        $c = $categories[$i];
                                        echo '<option value="'.$c['id'].'"';
                                        if($foto['category_id'] == $c['id']) echo ' selected';
                                        echo '>'.$c['name'].'</option>';
                                        $subs = $this->gallery->getSubCategories($c['id']);
                                        if($subs)
                                        {
                                            $scount = count($subs);
                                            for($j = 0; $j < $scount; $j++)
                                            {
                                                $s = $subs[$j];
                                                echo '<option value="'.$s['id'].'"';
                                                if($foto['category_id'] == $s['id']) echo ' selected';
                                                echo '>&nbsp;└&nbsp;'.$s['name'].'</option>';
                                            }
                                        }
                                    }
                                }
                                ?>
                            </SELECT>
                        </td>
                    </tr>
                    <tr>
                        <td>Фото *:</td>
                        <td>
                            <?php
                            if($foto['image'] != '')
                            {
                                $category = $this->gallery->getCategoryById($foto['category_id']);
                                $folder = '';
                                if($category['folder'] != '') $folder = 'categories/'.$category['folder'].'/';
                                
                                echo '<img src="/upload/gallery/'.$folder.'normal/'.$foto['image'].'" /><input type="hidden" name="oldfoto" value="'.$foto['image'].'" /><br />
                                    <input type="checkbox" name="del" /> Удалить<br />';
                            }
                            ?>
                            <input type="file" name="userfile" />
                        </td>
                    </tr>
                    <tr>
                        <td>title:</td>
                        <td><input type="text" name="title" size="50" value="<?php if(isset($_POST['title'])) echo $_POST['title']; else echo $foto['title']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>keywords:</td>
                        <td><textarea class="mceNoEditor" name="keywords"><?php if(isset($_POST['keywords'])) echo $_POST['keywords']; else echo $foto['keywords']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>description:</td>
                        <td><textarea class="mceNoEditor" name="description"><?php if(isset($_POST['description'])) echo $_POST['description']; else echo $foto['description']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>SEO текст:</td>
                        <td><textarea name="seo" class="tinymce"><?php if(isset($_POST['seo'])) echo $_POST['seo']; else echo $foto['seo']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="active"<?php if($foto['active'] == 1) echo ' checked'; ?> /> Активный</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="showintop"<?php if($foto['showintop'] == 1) echo ' checked'; ?> /> Учавствовать в ТОП-5</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Изменить" /></td>
                    </tr>
                </table>
            </form>
            
        </td>
    </tr>
</table>
<?php
include("footer.php");
?>