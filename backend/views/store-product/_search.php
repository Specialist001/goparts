<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'producer_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'type_car_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'serial_number') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'discount_price') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'is_special') ?>

    <?php // echo $form->field($model, 'length') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'in_stock') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'average_price') ?>

    <?php // echo $form->field($model, 'purchase_price') ?>

    <?php // echo $form->field($model, 'recommended_price') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'external_id') ?>

    <?php // echo $form->field($model, 'view') ?>

    <?php // echo $form->field($model, 'qid') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
