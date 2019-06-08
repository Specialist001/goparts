<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SubscriptionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscription-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'vendor') ?>

    <?php // echo $form->field($model, 'car') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'modification') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
