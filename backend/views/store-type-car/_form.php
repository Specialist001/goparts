<?php

use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StoreTypeCar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-type-car-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'parent_id')->dropDownList($cat_filter, ['options' => $cat_options]) ?>
        </div>
<!--        <div class="col-md-3">-->
<!--            --><?//= $form->field($model, 'external_id')->textInput(['maxlength' => true]) ?>
<!--        </div>-->
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'order')->textInput(['type' => 'number', 'min' => '0', 'value' => ($model->order != '') ? $model->order : 0]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($translation_en, 'name[en]')->textInput(['value' => $translation_en->name]) ?>
        </div>
    </div>
<!--    <div class="row">-->
<!--        <div class="col-md-4">-->
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
<!--                        <div class="col-md-12">-->
<!--                            --><?//= $form->field($translation_ar, 'name[ar]')->textInput(['value' => $translation_ar->name]) ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div role="tabpanel" class="tab-pane" id="tr_ru">-->
<!--                    <p></p>-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12">-->
<!--                            --><?//= $form->field($translation_ru, 'name[ru]')->textInput(['value' => $translation_ru->name]) ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
    <div class="row">
        <div class="col-md-4">
            <?php $fileinput_options = ['accept' => 'image/*', 'multiple' => false];
            if ($model->image != '') {
                $fileinput_options = ['accept' => 'image/*', 'multiple' => false];
                ?>
                <img src="<?= $model->image ?>" alt="<?= $model->image ?>" class="img-responsive" style="width: 100px">
            <?php } ?>
            <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                'options' => $fileinput_options,
                'pluginOptions' => [
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseClass' => 'btn btn-primary',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' => 'Select Image'
                ],
                'language' => 'en'
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <!--    --><? //= $form->field($model, 'view')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
