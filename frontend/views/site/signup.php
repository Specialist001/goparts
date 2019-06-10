<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model SignupForm */

use frontend\models\SignupForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<h2 class="text-center mt-2">Sign Up</h2>
<div class="site-signup">
    <div class="register">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <label for="customer">
                        <input type="radio" name="SignupForm[role]" value="0" id="customer">
                        <span class="circle"></span>
                        <h4>Customer</h4>
                        <p>We offer a large selection of high quality parts at competitive prices, and all our parts are available for purchase online instantly. We take full responsibility for logistics, so we can guarantee timely delivery.</p>
                        <img src="img/best.png" alt="">
                    </label>
                </div>
                <div class="col-md-6">
                    <label for="seller">
                        <input type="radio" name="SignupForm[role]" value="1" id="seller">
                        <span class="circle"></span>
                        <h4>Seller</h4>
                        <p>Sell your entire inventory of used auto parts. Broadcast your inventory and let us take care of all payment and customer support. </p>
                        <img src="img/seller.png" alt="">
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="customer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 register_cont">
                    <h3>General <span>Information</span></h3>
                    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'class'=>'customer-form']); ?>
                        <div class="form-row customer_row">
                            <div class="form-group col-md-4 customer_group">
                                <?= $form->field($model, 'legal_info')->textInput()->input('legal_info', ['placeholder' => "Name of Company"])->label('Name of Company') ?>
                            </div>
                            <div class="form-group col-md-4 customer_group">
                                <?= $form->field($model, 'legal_address')->textInput()->input('legal_address', ['placeholder' => "Address"]) ?>
                            </div>
                            <div class="form-group col-md-4 customer_group">
                                <?= $form->field($model, 'phone')->textInput()->input('Phone', ['placeholder' => "Phone"]) ?>
                            </div>
                        </div>
                        <div class="form-row customer_row">
                            <div class="form-group col-md-4 customer_group">
                                <?= $form->field($model, 'username')->textInput()->input('login', ['placeholder' => "Login"]) ?>
                            </div>
                            <div class="form-group col-md-4 customer_group">
                                <?= $form->field($model, 'email')->input('email', ['placeholder' => "E-mail"]) ?>
                            </div>
                            <div class="form-group col-md-4 customer_group">
                                <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => "Password"]) ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <hr class="customer_hr">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 register_bottom text-center">
                                <div class="custom-control custom-checkbox register_accept">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">I do <span>Accept</span> the <span>Terms and Conditions</span> of the Site</label>
                                </div>
                                <div class="form-button register_bottombut">
                                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                </div>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

<!--    <div class="row" style="display: none">-->
<!--        <div class="col-lg-12">-->
<!--            --><?php //$form = ActiveForm::begin(['id' => 'form-signup']); ?>
<!--            <div class="row">-->
<!--                <div class="col-md-3">-->
<!--                    --><?//= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<!--                </div>-->
<!--                <div class="col-md-3">-->
<!--                    --><?//= $form->field($model, 'email') ?>
<!--                </div>-->
<!--                <div class="col-md-3">-->
<!--                    --><?//= $form->field($model, 'password')->passwordInput() ?>
<!--                </div>-->
<!--                <div class="col-md-3">-->
<!--                    --><?//= $form->field($model, 'phone')->textInput() ?>
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col-md-3">-->
<!--                    --><?//= $form->field($model, 'location')->textInput() ?>
<!--                </div>-->
<!--                <div class="col-md-3">-->
<!--                    --><?//= $form->field($model, 'role')->dropDownList(['0'=>'Buyer','1'=>'Seller']) ?>
<!--                </div>-->
<!--                <div class="col-md-3 legal-info" style="display: none">-->
<!--                    --><?//= $form->field($model, 'legal_info')->textInput() ?>
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="form-group">-->
<!--                --><?//= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
<!--            </div>-->
<!---->
<!--            --><?php //ActiveForm::end(); ?>
<!--        </div>-->
<!--    </div>-->
</div>
<script>

</script>
<?php //$this->registerJs('$("#signupform-role").change(function(){
//	if ($("#signupform-role").val() = 1) {
//		$(\'.legal-info\').show();
//	} else {
//		$(\'.legal-info\').hide();
//	}
//});'); ?>