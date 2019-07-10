<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SellerQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seller-query-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'query_id')->textInput(['readonly'=> true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'seller_id')->textInput(['value'=>$model->seller->id ,'readonly'=> true])->label('Seller') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'product_id')->textInput(['readonly'=> true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(['0'=>'Waited','1'=>'Moderate','2'=>'Published','3'=>'Purchased']) ?>
        </div>
    </div>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
