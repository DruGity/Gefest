<?php
$noImage = "/img/111.png";
?>
<a href="<?= $fullUrl ?>">
    <span class="thumb-info thumb-info-centered-info thumb-info-no-borders">
        <span class="thumb-info-wrapper">
            <?php if ($image != '') { ?>
                            <img class="img-responsive" src="<?= cropImage($image, 600, 550) ?>" alt="<?= $name ?>">
                <?php
            }
            else
            {
                ?>
              <img class="img-responsive" src="<?= cropImage($noImage, 600, 550) ?>" alt="<?= $name ?>"
                <?php
            }
            ?>
            <span class="thumb-info-title">
                <span class="thumb-info-inner">Подробнее</span>
            </span>
        </span>
    </span>
    </a>

<?php
$arrCats = explode("|", $category_id);
$catUrl = $cat = false;

if (count($arrCats)>0)
{
    foreach ($arrCats as $index)
    {
        if ($index!=$currentCat['id'])
        {

            $cat = $this->model_categories->getCategoryById($index,1);
            $catUrl = getFullUrl($cat);

        }
    }
}
?>

<h4 class="mt-md mb-none"><?=$name?></h4>
<?php
if ($cat)
{
?>
<a href="<?= $catUrl ?>">
    <p class="mb-none"><?=$cat['name']?></p>
</a>
<?php
    }
?>
