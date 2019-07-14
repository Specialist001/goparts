<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'id')->textInput() ?>

<!--    --><?//= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'translation')->textarea(['rows' => 6]) ?>
<!--    --><?//= $form->field($model, 'Message[translation][en]')->widget(TinyMce::className(), [
//        'options' => ['rows' => 6],
//        'value' => $model->translation,
//        'language' => 'en',
//        'clientOptions' => [
//            'plugins' => [
//                "advlist autolink lists link charmap preview anchor",
//                "searchreplace visualblocks code fullscreen",
//                "insertdatetime media table contextmenu paste"
//            ],
//            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
//        ]
//    ])->textarea(['value' => $model->translation]);
//    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
