<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreProduct */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'My Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('//user/_usermenu.php') ?>
        </div>
        <div class="col-md-9">
            <div class="store-product-create">

                    <h3><?= Html::encode($this->title) ?></h3>

                <?= $this->render('_form', [
                    'model' => $model,
                    'video' => $video,
                    'cats' => $cats,
                    'category' => $category,
                    'translation_en' => $translation_en,
                    'translation_ar' => $translation_ar,
                    'translation_ru' => $translation_ru,
//                    'user_filter' => $user_filter,
                    'type_cars' => $type_cars,
                    'cars_array' => $cars_array,
                    'car_id' => $car_id,
//                    'commission' => $store_product_commission->comission,
//        'errors' => $errors,
                ]) ?>

            </div>
        </div>
    </div>
</div>

