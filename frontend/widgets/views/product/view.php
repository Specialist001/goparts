<?php
/**
 * Created by ru.lexcorp.
 * User: lexcorp
 * Date: 20.09.2017
 * Time: 4:09
 */



if (!empty($products)) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php if ($title) { ?>
                <div class="page-header product-widget-header">
                    <?= $title ?>
                </div>
            <?php } ?>
            <div class="row" style="margin: 0 -5px;">
                <?php for ($i = 0; $i < count($products); $i++) {
                    if (!$products[$i]->shop->status) continue;
                    $unset = false;
                    $temp_parent = $products[$i]->category;
                    while ($temp_parent) {
                        if (!$temp_parent->status) {
                            $unset = true;
                            break;
                        }
                        if (empty($temp_parent->parent)) break;
                        $temp_parent = $temp_parent->parent;
                    }
                    if ($unset) continue;
                    ?>
                    <div class="col-md-4 col-sm-6 col-xs-12" style="padding: 0 10px;">
                        <?=$this->render('@frontend/views/product/cart.php', ['product' => $products[$i], 'new' => ($title == Yii::t('frontend', 'New'))? true: false])?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>