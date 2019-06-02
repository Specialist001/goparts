<?php
/**
 * Created by ru.lexcorp.
 * User: lexcorp
 * Date: 20.09.2017
 * Time: 4:09
 */
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
/*echo '<pre>';
print_r($shops);
echo '</pre>';*/
if (!empty($shops)) {?>
    <!--<div class="bg-white">
        <div class="container">
            <div class=" shop-page-header" style="padding: 0 0 12px 0;font-weight: normal;font-family: magistral-regular, gotham-pro, Helvetica,Arial sans-serif;">
                <?/*=Yii::t('frontend', 'Shops')*/?>
                <div class="clearfix"></div>
            </div>
            <div class="shop-block">
                <?php /*for ($i = 0; $i < count($shops); $i++) { */?>
                    <a href="<?/*=Url::to(['shop/index', 'id' => $shops[$i]->url])*/?>" data-pjax="0">
                        <img src="<?/*=$shops[$i]->logo;*/?>" alt="<?/*=$shops[$i]->name;*/?>" >
                    </a>
                <?php /*} */?>
            </div>
        </div>
    </div>-->

    <!--<div class="col-md-12">
        <div class="owl-carousel owl-theme">
            <?php /*foreach ($shops as $shop) { */?>
                <div class="item">
                    <div class="owl-image">
                        <img src="<?/*= $shop->image */?>"
                             alt="<?/*= $shop->name */?>" >
                    </div>
                    <div class="owl-description">
                        <div>
                            <a href="<?/*= Url::to(['shop/index', 'id' => $shop->url]) */?>"
                               style="color: #25a69a">
                                <?/*= $shop->name */?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php /*} */?>
        </div>
    </div>-->
<?php } ?>