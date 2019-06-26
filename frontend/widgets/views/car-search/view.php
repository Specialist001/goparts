<?php
/**
 * Created by ru.lexcorp.
 * User: lexcorp
 * Date: 20.09.2017
 * Time: 4:09
 */

use common\models\Cars;
use frontend\widgets\WCategory;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

//$title = 'Search';

?>

<section class="widgetform">
    <form method="GET" action="<?= Url::to(['car/search'])?>" class="widgetform_form">
        <div class="w-100">
            <!--                <div class="widgetform_catalog px-3 float-md-left d-inline-block border-top border-right border-bottom position-relative" id="open-all_menu">-->
            <!--                    <span>Catalog</span>-->
            <!--                    <div class="d-inline-block float-md-right ">-->
            <!--                    <img class="img-fluid" src="/svg/Catalog.svg" alt="">-->
            <!--                    </div>-->
            <!--                </div>-->

            <div class="widgetform_make px-3 float-md-left d-inline-block border-top border-right border-bottom position-relative">
                <select class="form-control vendor_select" name="vendor">
                    <option disabled selected>Select Car</option>
                    <!--                        --><?//= Dropdown::widget(); ?>
                    <?php foreach ($cars_array as $car) { ?>
                        <option value="<?= $car ?>" <?= $car == Yii::$app->request->get('vendor') ? 'selected' : '' ?>><?= $car ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="widgetform_model px-3 float-md-left d-inline-block border-top border-right border-bottom position-relative">
                <select class="form-control car_items" name="car">
                    <option disabled selected>Select Model</option>

                    <?php if(Yii::$app->request->get('car')) {?>
                        <?php foreach ($models_array as $car_model) {?>
                            <option value="<?= $car_model ?>" <?= $car_model == Yii::$app->request->get('car') ? 'selected' : '' ?>><?= $car_model ?></option>
                        <?php }?>
                    <? } ?>

                </select>
            </div>
            <div class="widgetform_generation px-3 float-md-left d-inline-block border-top border-right border-bottom position-relative">
                <select class="form-control car_modifications" name="modification">
                    <option disabled selected>Select Generation</option>

                    <?php if(Yii::$app->request->get('modification')) {?>
                        <?php foreach ($mod_array as $key => $car_modification) {
//                                print_r($key);
                            ?>
                            <option value="<?= $key ?>" <?= $key == Yii::$app->request->get('modification') ? 'selected' : '' ?>> <?= $car_modification ?></option>
                        <?php }?>
                    <? } ?>
                </select>
            </div>
            <!--                <div class="widgetform_year px-3 float-md-left d-inline-block border-top border-right border-bottom position-relative">-->
            <!--                    <select class="form-control car_years" name="year_name">-->
            <!--                        <option disabled selected>Year</option>-->
            <!--                    </select>-->
            <!--                </div>-->
            <div class="widgetform_button float-md-left d-inline-block">
                <button class="button"><img src="/svg/search.svg" alt=""> <span>Search</span></button>
            </div>
        </div>
        <div class="all_menu" id="all_menu" style="z-index: 1100;">
            <div class=" hidden-sm hidden-xs">
                <?= WCategory::widget(['key' => 'main']) ?>
            </div>
        </div>


    </form>
</section>
<?php $this->registerJs('
    $(document).ready(function() {
        $(\'select.form-control\').select2(
            {
                language: {
                  noResults: function () {
                    return "Nothing not found";
                  }
                }
            }
        );
    });
    $(document).on(\'ready pjax:success\', function() {
        $(\'select.form-control\').select2(
            {
                language: {
                  noResults: function () {
                    return "Nothing not found";
                  }
                }
            }
        );
    });
');?>