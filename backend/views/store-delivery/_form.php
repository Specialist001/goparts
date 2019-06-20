<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StoreDelivery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-delivery-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'status')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'order')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'free_form')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'available_form')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'separate_payment')->textInput() ?>
        </div>
    </div>









    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
