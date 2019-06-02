<?php
/**
 * Created by ru.lexcorp.
 * User: lexcorp
 * Date: 19.09.2017
 * Time: 8:04
 */
?>
<?php if(!empty($socials)) { ?>
    <div class="text-center">
        <ul class="list-inline">
            <?php for ($i = 0; $i < count($socials); $i++) { ?>
                <li><a href="<?=$socials[$i]->url?>" target="_blank" title="<?=$socials[$i]->name?>"><i class="fa fa-2x fa-<?=$socials[$i]->icon?>"></i></a></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
