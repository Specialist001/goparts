<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StoreOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-order-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'user_id')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(['1'=>'New','2'=>'Accepted','3'=>'Completed','4'=>'Cancelled'])?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'paid')->dropDownList(['1'=>'Paid','0'=>'Not paid']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'total_price')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <br>
    <h4>Contact info</h4>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

<!---->
<!--    --><?//= $form->field($model, 'delivery_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'manager_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'delivery_price')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'payment_method_id')->textInput() ?>




<!--    --><?//= $form->field($model, 'payment_time')->textInput() ?>

<!--    --><?//= $form->field($model, 'payment_details')->textarea(['rows' => 6]) ?>


<!--    --><?//= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'coupon_discount')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'separate_delivery')->textInput() ?>


<!--    --><?//= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>



<!--    --><?//= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>


<!--    --><?//= $form->field($model, 'house')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'apartment')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
