<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'category_id')->textInput([]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'user_id')->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'change_user_id')->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(['0'=>'Not published','1'=>'Published']) ?>
        </div>
    </div>
    <h3>Descriptions</h3>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($translation_en, 'title[en]')->textInput(['value' => $translation_en->title]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($translation_en, 'title_short[en]')->textInput(['value' => $translation_en->title_short]) ?>
        </div>
        <div class="col-md-12">
<!--            --><?//= $form->field($translation_en, 'body[en]')->textInput(['value' => $translation_en->body]) ?>
            <?= $form->field($translation_en, 'body[en]')->widget(TinyMce::className(), [
                'options' => ['rows' => 6],
                'language' => 'en',
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste"
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                ]
            ])->textarea(['value' => $translation_en->body])->label('Text');
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'slug')->textInput(['readonly'=>true,'maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'order')->textInput(['type'=>'number']) ?>
        </div>
    </div>

<!--        --><?//= $form->field($model, 'is_protected')->textInput() ?>



<!--        --><?//= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--        --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
