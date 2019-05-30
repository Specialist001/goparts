<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StoreAttributeOption */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-attribute-option-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'attribute_id')->dropDownList($attributes) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'order')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tr_en" aria-controls="tr_en" role="tab" data-toggle="tab">English</a>
                </li>
                <li role="presentation" class="text-right">
                    <a href="#tr_ar" aria-controls="tr_ar" role="tab" data-toggle="tab">عربى</a>
                </li>
                <li role="presentation">
                    <a href="#tr_ru" aria-controls="tr_ru" role="tab" data-toggle="tab">Русский</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tr_en">
                    <p></p>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($translation_en, 'value[en]')->textInput(['value' => $translation_en->value]) ?>
                        </div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="tr_ar">
                    <p></p>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($translation_ar, 'value[ar]')->textInput(['value' => $translation_ar->value]) ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tr_ru">
                    <p></p>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($translation_ru, 'value[ru]')->textInput(['value' => $translation_ru->value]) ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::a(\rmrevin\yii\fontawesome\FA::i('long-arrow-left').' Back', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
