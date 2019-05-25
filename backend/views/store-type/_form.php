<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StoreType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-type-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($typeAttribute, 'id')->dropDownList($attribute_array)->label('Attribute') ?>
        </div>
    </div>
    <div class="row">
    </div>

    <div class="form-group">
        <?= Html::a(\rmrevin\yii\fontawesome\FA::i('long-arrow-left').' Back', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
