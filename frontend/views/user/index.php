<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'My Profile';
//print_r($model);exit;
?>
<div class="customer">
    <div class="container">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'customer-form']]); ?>
        <div class="row">
            <div class="col-md-3">
<!--                <div class="customer_user">-->
<!--                    <img src="--><?//= Yii::$app->getUser()->identity->avatar ?><!--" class="img-fluid">-->
<!--                    <label for="exampleFormControlFile1">-->
<!--                        <div class="customer_user_change">-->
<!--                            <img src="/svg/chang_photo.svg" alt="">-->
<!--                            <span>Change Photo</span>-->
<!--                            <input type="file" class="d-none" id="exampleFormControlFile1">-->
<!--                        </div>-->
<!--                    </label>-->
<!--                </div>-->
                <div class="dashboard-profile">
                    <div class="dashboard-profile_photo">

                        <img src="<?= Yii::$app->getUser()->identity->avatar ? Yii::$app->getUser()->identity->avatar : '/uploads/site/no_avatar.png' ?>">
                    </div>
                    <div class="dashboard-profile_photo-text">
                        <a class="" id="file" style="cursor: pointer">
                            <p>
                                <img src="/svg/chang_photo.svg" alt="" class="mr-2">
                                <?= Yii::$app->getUser()->identity->avatar ? ' Change Photo' : ' Add Photo' ?>
                            </p>
                        </a>
                    </div>
                    <input type="file" class="lk-setting__file-img hidden" name="ProfileForm[avatar]" id="image" style="visibility: hidden">
                </div>
                <?= $this->render('//user/_usermenu.php') ?>
            </div>
            <div class="col-md-9 customer_cont">
                <h3>General <span>Information</span></h3>
                <div class="form-row customer_row">
                    <div class="form-group col-md-4 customer_group">
                        <?= $form->field($model, 'legal_info')->textInput(['value' => Yii::$app->getUser()->identity->legal_info ? Yii::$app->getUser()->identity->legal_info : ''])->label('Name of company') ?>
                    </div>
                    <div class="form-group col-md-4 customer_group">
                        <?= $form->field($model, 'legal_address')->textInput(['value' => Yii::$app->getUser()->identity->legal_address ? Yii::$app->getUser()->identity->legal_address : '']) ?>
                    </div>
                    <div class="form-group col-md-4 customer_group">
                        <?= $form->field($model, 'phone')->textInput(['value' => Yii::$app->getUser()->identity->phone ? Yii::$app->getUser()->identity->phone : '']) ?>
                    </div>
                </div>
                <div class="form-row customer_row">
                    <div class="form-group col-md-4 customer_group">
                        <?= $form->field($model, 'username')->textInput(['value' => Yii::$app->getUser()->identity->username ? Yii::$app->getUser()->identity->username : '']) ?>
                    </div>
                    <div class="form-group col-md-4 customer_group">
                        <?= $form->field($model, 'email')->textInput(['value' => Yii::$app->getUser()->identity->email ? Yii::$app->getUser()->identity->email : '']) ?>
                    </div>
                    <div class="form-group col-md-4 customer_group">
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <hr class="customer_hr">
                    </div>
                </div>
                <div class="form-row">
                    <!--                        <div class="col-md-4 customer_bottomleft">-->
                    <!--                            <h4>Social links</h4>-->
                    <!--                            <span>Add your social accounts<br> and use them to log in</span>-->
                    <!--                            <ul>-->
                    <!--                                <li><a href="#"><img src="/img/facebook.png"></a></li>-->
                    <!--                                <li><a href="#"><img src="/img/googleplus.png"></a></li>-->
                    <!--                                <li><a href="#"><img src="/img/twiiter.png"></a></li>-->
                    <!--                            </ul>-->
                    <!--                            <button>Delete <i class="fa fa-times-circle"></i></button>-->
                    <!--                        </div>-->
                    <div class="col-md-12 customer_bottomright float-md-right">
<!--                        <div class="custom-control custom-checkbox customer_receive">-->
<!--                            <input type="checkbox" class="custom-control-input" id="customCheck1">-->
<!--                            <label class="custom-control-label" for="customCheck1">Receive email notifications</label>-->
<!--                        </div>-->
                        <div class="form-button customer_bottombut">
<!--                            <button class="customer_bottombut_1">I want to Sell Product</button>-->
                            <button type="submit" class="customer_bottombut_2">Save Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>


<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-md-3">-->
<!--            --><? //= $this->render('//user/_usermenu.php') ?>
<!--        </div>-->
<!--        <div class="col-md-9">-->
<!--            <div>-->
<!--                --><?php //$form = ActiveForm::begin(); ?>
<!--                <div class="col-sm-12">-->
<!--                    <h4>-->
<!--                        Profile data-->
<!--                    </h4>-->
<!--                    <div class="row">-->
<!--                        --><?php //if (filter_var(Yii::$app->getUser()->identity->email, FILTER_VALIDATE_EMAIL)) { ?>
<!--                            <div class="col-md-4">-->
<!--                                <p class="">-->
<!--                                    <strong class="w-100 d-inline-block">--><? //= Yii::t('frontend', 'E-mail') ?>
<!--                                        :</strong>-->
<!--                                    <span class="d-inline-block mt-0 mt-md-3"> --><? //= Yii::$app->getUser()->identity->email ?><!--</span>-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        --><?php //} ?>
<!--                        <div class="col-md-4">-->
<!--                            <div class="form-group">-->
<!--                                --><? //= $form->field($model, 'username')->textInput(['value' => Yii::$app->getUser()->identity->username ? Yii::$app->getUser()->identity->username : '']) ?>
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-4">-->
<!---->
<!--                            <div class="form-group">-->
<!--                                --><? //= $form->field($model, 'phone')->textInput(['value' => Yii::$app->getUser()->identity->phone ? Yii::$app->getUser()->identity->phone : '', 'placeholder' => '+998']) ?>
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--                <div class="col-sm-12">-->
<!--                    <h4>-->
<!--                        --><? //= Yii::t('frontend', 'Change password') ?>
<!--                    </h4>-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-4">-->
<!--                            <div class="form-group">-->
<!--                                --><? //= $form->field($model, 'password')->passwordInput() ?>
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-4">-->
<!--                            <div class="form-group">-->
<!--                                --><? //= $form->field($model, 'passwordconfirm')->passwordInput() ?>
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-sm-12">-->
<!--                    <div class="form-group text-center">-->
<!--                        --><? //= Html::submitButton(Yii::t('frontend', 'Save'), ['class' => 'btn bg-form_style_2 btn-login text-white w-25', 'name' => 'signup-button']) ?>
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                --><?php //ActiveForm::end(); ?>
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
