<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StoreAttributeOption */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-attribute-option-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'attribute_id')->textInput() ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
