<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreTypeCar */

$this->title = 'Update Store Type Car: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Store Type Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-type-car-update">
    <p>
        <?= Html::a('Create new', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'translation_en' => $translation_en,
        'translation_ar' => $translation_ar,
        'translation_ru' => $translation_ru,
        'cat_filter' => $cat_filter,
        'cat_options' => $cat_options,
    ]) ?>

</div>
