<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StoreAttribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-attribute-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-1">
            <?= $form->field($model, 'group_id')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'type')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'required')->dropDownList(['0'=>'Not required', '1'=>'Required']) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'order')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'is_filter')->dropDownList(['0'=>'Not Filtered', '1'=>'Is Filtered']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($translation_en, 'title[en]')->textInput(['value' => $translation_en->title]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($translation_en, 'description[en]')->textarea(['value' => $translation_en->description]) ?>
        </div>
    </div>

<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
<!--            <ul class="nav nav-tabs" role="tablist">-->
<!--                <li role="presentation" class="active">-->
<!--                    <a href="#tr_en" aria-controls="tr_en" role="tab" data-toggle="tab">English</a>-->
<!--                </li>-->
<!--                <li role="presentation" class="text-right">-->
<!--                    <a href="#tr_ar" aria-controls="tr_ar" role="tab" data-toggle="tab">عربى</a>-->
<!--                </li>-->
<!--                <li role="presentation">-->
<!--                    <a href="#tr_ru" aria-controls="tr_ru" role="tab" data-toggle="tab">Русский</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <div class="tab-content">-->
<!--                <div role="tabpanel" class="tab-pane active" id="tr_en">-->
<!--                    <p></p>-->
<!--                    -->
<!---->
<!--                </div>-->
<!--                <div role="tabpanel" class="tab-pane" id="tr_ar">-->
<!--                    <p></p>-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-4">-->
<!--                            --><?//= $form->field($translation_ar, 'title[ar]')->textInput(['value' => $translation_ar->title]) ?>
<!--                        </div>-->
<!--                        <div class="col-md-12">-->
<!--                            --><?//= $form->field($translation_ar, 'description[ar]')->textarea(['value' => $translation_ar->description]) ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div role="tabpanel" class="tab-pane" id="tr_ru">-->
<!--                    <p></p>-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-4">-->
<!--                            --><?//= $form->field($translation_ru, 'title[ru]')->textInput(['value' => $translation_ru->title]) ?>
<!--                        </div>-->
<!--                        <div class="col-md-12">-->
<!--                            --><?//= $form->field($translation_ru, 'description[ru]')->textarea(['value' => $translation_ru->description]) ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </div>-->
    <p>

    </p>
    <div class="form-group">
        <?= Html::a(\rmrevin\yii\fontawesome\FA::i('long-arrow-left').' Back', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
