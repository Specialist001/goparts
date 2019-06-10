<?php if (!empty($cats)) { ?>
    <?php if($cats[0]->parent_id != null) { ?>
        <li data-id="<?=($cats[0]->parent->parent_id != null)? $cats[0]->parent->parent_id: 'null'?>" data-childs="<?=$cats[0]->parent_id?>" class="<?=$add?>cat-widget-li"><i class="fa fa-chevron-left"></i> Back</li>
    <?php } ?>
        <?php foreach ($cats as $cat) { ?>
            <li data-id="<?=$cat->id?>" data-childs="<?=(!empty($cat->categories))?$cat->id:''?>" class="<?=$add?>cat-widget-li"><?=$cat->translate->title?></li>
        <?php } ?>
<?php } ?>