<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
//echo '<pre>';
////print_r($seller_car_1);
////print_r($seller_car_2);
////echo '</pre>';exit;
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(['0' => 'Deleted', '10' => 'Active', '9' => 'Inactive']) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'gender')->dropDownList(['0' => 'Male', '1' => 'Female']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'birth_date')->textInput(['type' => 'date']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'type')->dropDownList(['0' => 'Individual', '1' => 'Legal entity']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'role')->dropDownList(['0' => 'Buyer', '1' => 'Seller']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'access_level')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'legal_vat_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'legal_info')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'legal_reg_certificate')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'legal_address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'legal_bank_account')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'about')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Commission</label>
                <input type="number" class="form-control" name="commission" value="<?= $user_commission->commission ? $user_commission->commission : ''?>">
            </div>
        </div>
        <?php if($model->role == $model::ROLE_SELLER) {?>
        <div class="col-md-3">
            <label>Vendor 1</label>
            <select class="form-control" name="car_1">
                <option value="0">No vendor</option>
                <?php foreach ($cars as $car) { ?>
                    <option value="<?= $car ?>" <?= $car == $car_1->vendor_name ? 'selected':''?> ><?= $car ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
            <label>Vendor 2</label>
            <select class="form-control" name="car_2">
                <option value="0">No vendor</option>
                <?php foreach ($cars as $car) { ?>
                    <option value="<?= $car ?>" <?= $car == $car_2->vendor_name ? 'selected':''?> ><?= $car ?></option>
                <?php } ?>
            </select>
        </div>
        <?php } ?>
        <div class="col-md-3">
            <?= $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-12">

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

    </div>
    <?php ActiveForm::end(); ?>


</div>
