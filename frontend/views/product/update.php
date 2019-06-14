<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreProduct */

$this->title = 'Update Store Product: ' . $model->translate->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->translate->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('//user/_usermenu.php') ?>
        </div>
        <div class="col-md-9">
            <div class="store-product-update">

                    <h3><?= Html::encode($this->title) ?></h3>

                <?= $this->render('_form', [
                    'model' => $model,
                    'video' => $video,
                    'cats' => $cats,
                    'category' => $category,
                    'translation_en' => $translation_en,
                    'translation_ar' => $translation_ar,
                    'translation_ru' => $translation_ru,
                    'type_cars' => $type_cars,
                    'car_id' => $car_id,
                ]) ?>

            </div>
        </div>
    </div>
</div>

