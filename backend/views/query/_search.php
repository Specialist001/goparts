<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\QuerySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="query-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'car_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'vendor') ?>

    <?php // echo $form->field($model, 'car') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'modification') ?>

    <?php // echo $form->field($model, 'fueltype') ?>

    <?php // echo $form->field($model, 'engine') ?>

    <?php // echo $form->field($model, 'transmission') ?>

    <?php // echo $form->field($model, 'drivetype') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
