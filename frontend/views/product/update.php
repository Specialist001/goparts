<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreProduct */

$this->title = 'Update Store Product: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Store Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('//user/_usermenu.php') ?>
        </div>
        <div class="col-md-9">
            <div class="store-product-update">

                <!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

                <?= $this->render('_form', [
                    'model' => $model,
                    'video' => $video,
                    'cats' => $cats,
                    'category' => $category,
                    'translation_en' => $translation_en,
                    'translation_ar' => $translation_ar,
                    'translation_ru' => $translation_ru,
                    'cat_filter' => $cat_filter,
                    'type_car_filter' => $type_car_filter,
                    'cars_array' => $cars_array,
//                    'store_product_commission' => $store_product_commission,
                    //'errors' => $errors,
                ]) ?>

            </div>
        </div>
    </div>
</div>

