<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StoreCommission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-commission-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true,'readonly'=>'true']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'commission')->textInput(['type'=>'number']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
