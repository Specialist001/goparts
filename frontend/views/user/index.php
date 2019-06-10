<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = 'My Profile';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('//user/_usermenu.php') ?>
        </div>
        <div class="col-md-9">
            <div>
                <?php $form = ActiveForm::begin(); ?>
                <div class="col-sm-12">
                    <h4>
                        Profile data
                    </h4>
                    <div class="row">
                        <?php if (filter_var(Yii::$app->getUser()->identity->email, FILTER_VALIDATE_EMAIL)) { ?>
                            <div class="col-md-4">
                                <p class="">
                                    <strong class="w-100 d-inline-block"><?= Yii::t('frontend', 'E-mail') ?>
                                        :</strong>
                                    <span class="d-inline-block mt-0 mt-md-3"> <?= Yii::$app->getUser()->identity->email ?></span>
                                </p>
                            </div>
                        <?php } ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= $form->field($model, 'username')->textInput(['value' => Yii::$app->getUser()->identity->username ? Yii::$app->getUser()->identity->username : '']) ?>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <?= $form->field($model, 'phone')->textInput(['value' => Yii::$app->getUser()->identity->phone ? Yii::$app->getUser()->identity->phone : '', 'placeholder' => '+998']) ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-12">
                    <h4>
                        <?= Yii::t('frontend', 'Change password') ?>
                    </h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= $form->field($model, 'password')->passwordInput() ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= $form->field($model, 'passwordconfirm')->passwordInput() ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group text-center">
                        <?= Html::submitButton(Yii::t('frontend', 'Save'), ['class' => 'btn bg-form_style_2 btn-login text-white w-25', 'name' => 'signup-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>
