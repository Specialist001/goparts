<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\QuerySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'delivery_id') ?>

    <?= $form->field($model, 'manager_id') ?>

    <?= $form->field($model, 'delivery_price') ?>

    <?php // echo $form->field($model, 'payment_method_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'paid') ?>

    <?php // echo $form->field($model, 'payment_time') ?>

    <?php // echo $form->field($model, 'payment_details') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'coupon_discount') ?>

    <?php // echo $form->field($model, 'separate_delivery') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'zipcode') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'house') ?>

    <?php // echo $form->field($model, 'apartment') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
