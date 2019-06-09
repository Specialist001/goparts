<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StoreCategory */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="store-category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'parent_id')->dropDownList($cat_filter, ['options' => $cat_options]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'order')->textInput(['type' => 'number', 'min'=>'0', 'value' => ($model->order != '') ? $model->order : 0]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($translation_en, 'title[en]')->textInput(['value' => $translation_en->title]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($translation_en, 'short[en]')->textInput(['value' => $translation_en->short]) ?>
        </div>
        <div class="col-md-12">
            <!--                            --><?//= $form->field($translation_en, 'description[en]')->textarea(['value' => $translation_en->description, 'style' => 'resize: vertical; height: 128px;']) ?>
            <?= $form->field($translation_en, 'description[en]')->widget(TinyMce::className(), [
                'options' => ['rows' => 6],
                'value' => $translation_en->description,
                'language' => 'en',
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste"
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                ]
            ])->textarea(['value' => $translation_en->description]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($translation_en, 'meta_title[en]')->textInput(['value' => $translation_en->meta_title]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($translation_en, 'meta_description[en]')->textInput(['value' => $translation_en->meta_description]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($translation_en, 'meta_keywords[en]')->textInput(['value' => $translation_en->meta_keywords]) ?>
        </div>
    </div>

    <hr>
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
<!--        <div class="col-md-4">-->
<!--            --><?//= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
<!--        </div>-->
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
