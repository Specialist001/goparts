<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreProduct */

$this->title = 'Create Store Product';
$this->params['breadcrumbs'][] = ['label' => 'Store Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-product-create">

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
        'user_filter' => $user_filter,
        'type_car_filter' => $type_car_filter,
        'cars_array' => $cars_array,
        'commission' => $store_product_commission->comission,
//        'errors' => $errors,
    ]) ?>

</div>
