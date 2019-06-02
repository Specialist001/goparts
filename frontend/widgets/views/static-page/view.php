<?php
/**
 * Created by ru.lexcorp.
 * User: lexcorp
 * Date: 19.09.2017
 * Time: 6:19
 */
use yii\helpers\Url;

?>
<?php if (!empty($static_page_cats)) { ?>
    <div class="row">
    <?php for ($i = 0; $i < count($static_page_cats); $i++) { ?>
        <?php if (empty($static_page_cats[$i]->activeStaticPages)) continue; ?>
        <div class="col-sm-4">
            <div class="hidden-sm hidden-md hidden-lg" style="margin-bottom: 20px;"></div>
            <p>
                <strong><?= $static_page_cats[$i]->translate->name ?></strong>
            </p>
            <ul class="list-unstyled">
                    <li>
                        <?php for ($p = 0; $p < count($static_page_cats[$i]->activeStaticPages); $p++) { ?>
                            <a href="<?= ($static_page_cats[$i]->activeStaticPages[$p]->external) ? $static_page_cats[$i]->activeStaticPages[$p]->url : Url::to(['site/page', 'id' => $static_page_cats[$i]->activeStaticPages[$p]->url]) ?>" <?= ($static_page_cats[$i]->activeStaticPages[$p]->external) ? 'target="_blank"' : '' ?>>
                                <?= $static_page_cats[$i]->activeStaticPages[$p]->translate->name ?>
                            </a>
                            <br/>
                        <?php } ?>
                    </li>
            </ul>
        </div>
        <?php if (($i + 1) % 3 == 0 && ($i + 1) != count($static_page_cats)) { ?>
            </div>
            <div class="row">
        <?php } ?>
    <?php } ?>
    </div>
<?php } ?>
