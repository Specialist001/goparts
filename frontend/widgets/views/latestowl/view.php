<?php

use yii\helpers\Url;

if (!empty($products)) { ?>
    <div class="col-md-12">
        <div class="owl-carousel owl-theme">
            <?php foreach ($products as $product) {
                $wholesales = json_decode($product->wholesale);
                if (!empty($wholesales)) {
                    foreach ($wholesales as $ws_count => $sum) {
                        $ws_price = (preg_match('/\./i', $sum))? number_format($sum, Yii::$app->params['price_dec']['decimals'], Yii::$app->params['price_dec']['dec_pointer'], Yii::$app->params['price_dec']['thousands_sep']): number_format($sum, Yii::$app->params['price']['decimals'], Yii::$app->params['price']['dec_pointer'], Yii::$app->params['price']['thousands_sep']);
                        $ws_price = preg_replace('/,00$/i', '', $ws_price);
                        $ws_total_price = (preg_match('/\./i', $sum))
                            ? number_format($sum * $ws_count, Yii::$app->params['price_dec']['decimals'], Yii::$app->params['price_dec']['dec_pointer'], Yii::$app->params['price_dec']['thousands_sep'])
                            : number_format($sum * $ws_count, Yii::$app->params['price']['decimals'], Yii::$app->params['price']['dec_pointer'], Yii::$app->params['price']['thousands_sep']);
                        $ws_total_price = preg_replace('/,00$/i', '', $ws_total_price);
                    }
                }
                ?>
                <div class="item">
                    <div class="owl-image">
                        <img src="<?= $product->mainImage->image ?>"
                             alt="<?= $product->translate->name ?>" >
                    </div>
                    <div class="owl-description">
                        <div>
                            <a href="<?= Url::to(['product/index', 'id' => $product->url]) ?>"
                                style="color: #25a69a">
                                <?= $product->translate->name ?>
                            </a>
                        </div>
                        <div data-price="<?=$sum?>">
                            <?=$ws_price?>
                            <?= Yii::t('frontend', 'Currency') ?>
                            <?=(!empty($product->unit))? '/'.$product->unit->name: ''?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>

<?php } ?>