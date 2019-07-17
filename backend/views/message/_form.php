<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">
    <div class="container">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#perf_en" aria-controls="perf_en" role="tab" data-toggle="tab">English</a></li>
                    <li role="presentation"><a href="#perf_ar" aria-controls="perf_ar" role="tab" data-toggle="tab">Arabic</a>
                    </li>
                    <li role="presentation"><a href="#perf_ru" aria-controls="perf_ru" role="tab" data-toggle="tab">Русский</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="perf_en">
                        <p></p>
<!--                        --><?//= $form->field($model, 'translation[en]')->textarea(['style' => 'resize: none;', 'rows' => 6, 'value' => $model->translation]) ?>
                        <?= $form->field($model, 'translation[en]')->widget(TinyMce::className(), [
                            'options' => ['rows' => 6],
                            'value' => $model->translation,
                            'language' => 'en',
                            'clientOptions' => [
                                'plugins' => [
                                    "advlist autolink lists link charmap preview anchor",
                                    "searchreplace visualblocks code fullscreen",
                                    "insertdatetime media table contextmenu paste"
                                ],
                                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                            ]
                        ])->textarea(['value' => $model->translation]);
                        ?>
                    </div>
                    <div role="tabpanel" class="tab-pane " id="perf_ar">
                        <p></p>
<!--                        --><?//= $form->field($model_ar, 'translation[ar]')->textarea(['style' => 'resize: none;', 'rows' => 6, 'value' => $model_ar->translation]) ?>
                        <?= $form->field($model_ar, 'translation[ar]')->widget(TinyMce::className(), [
                            'options' => ['rows' => 6],
                            'value' => $model_ar->translation,
                            'language' => 'en',
                            'clientOptions' => [
                                'plugins' => [
                                    "advlist autolink lists link charmap preview anchor",
                                    "searchreplace visualblocks code fullscreen",
                                    "insertdatetime media table contextmenu paste"
                                ],
                                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                            ]
                        ])->textarea(['value' => $model_ar->translation]);
                        ?>
                    </div>
                    <div role="tabpanel" class="tab-pane " id="perf_ru">
                        <p></p>
<!--                        --><?//= $form->field($model_ru, 'translation[ru]')->textarea(['style' => 'resize: none;', 'rows' => 6, 'value' => $model_ru->translation]) ?>
                        <?= $form->field($model_ru, 'translation[ru]')->widget(TinyMce::className(), [
                            'options' => ['rows' => 6],
                            'value' => $model_ru->translation,
                            'language' => 'en',
                            'clientOptions' => [
                                'plugins' => [
                                    "advlist autolink lists link charmap preview anchor",
                                    "searchreplace visualblocks code fullscreen",
                                    "insertdatetime media table contextmenu paste"
                                ],
                                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                            ]
                        ])->textarea(['value' => $model_ru->translation]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>



<!--    --><?//= $form->field($model, 'id')->textInput() ?>

<!--    --><?//= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'translation')->textarea(['rows' => 6]) ?>
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





</div>
