<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
<!---->
<!--    <p>Please fill out the following fields to login:</p>-->

    <div class="row">
        <div class="col-lg-4 m-auto">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

<!--                --><?//= $form->field($model, 'rememberMe')->checkbox() ?>
            <div class="d-inline-block w-100">
            <label class="toggle float-left">
                <input type="hidden" name="LoginForm[rememberMe]" value="0">
                <input class="toggle__input" name="LoginForm[rememberMe]" type="checkbox" value="1" checked>
                <span class="toggle__label">
                    <span class="toggle__text">Remember password</span>
                </span>
            </label>
            <a class="text-form-style_2 float-right font-weight-bold pt-1" href="<?= Url::to(['reset-password']); ?>">Forgot your password?</a>
            </div>

<!--                <div style="color:#999;margin:1em 0">-->
<!--                    If you forgot your password you can --><?//= Html::a('reset it', ['site/request-password-reset']) ?><!--.-->
<!--                    <br>-->
<!--                    Need new verification email? --><?//= Html::a('Resend', ['site/resend-verification-email']) ?>
<!--                </div>-->

                <div class="form-group text-center">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>


    </div>
<!--    <div class="row">-->
<!--        <div class="form m-auto col-lg-4">-->
<!--            <form id="login-form" accept-charset="UTF-8" action="--><?//= Url::to(['login']) ?><!--" class="loginBox auth" method="POST">-->
<!--                <input type="hidden" name="--><?//=Yii::$app->request->csrfParam; ?><!--" value="--><?//=Yii::$app->request->getCsrfToken(); ?><!--" />-->
<!--                <h4 class="text-center mb-3">Log In</h4>-->
<!--                <div class="input-group text-muted rounded border mb-3">-->
<!--                    <span class="input-group-prepend mr-1">-->
<!--                        <div class="input-group-text bg-transparent border-0">-->
<!--                            <img src="svg/Mail_.svg">-->
<!--                        </div>-->
<!--                    </span>-->
<!--                    <input class="py-2 border-0 d-block w-75" id="LoginForm[username]"-->
<!--                           name="email" placeholder="Username" type="text" required>-->
<!--                </div>-->
<!--                <div class="input-group text-muted rounded border mb-3">-->
<!--                    <span class="input-group-prepend mx-1">-->
<!--                        <div class="input-group-text bg-transparent border-0">-->
<!--                            <img src="svg/lock.svg">-->
<!--                        </div>-->
<!--                    </span>-->
<!--                    <input class="py-2 border-0 d-block w-75" id="LoginForm[password]"-->
<!--                           name="password" placeholder="Password" type="password" required>-->
<!--                </div>-->
<!--                <div class="d-inline-block w-100">-->
<!--                    <label class="toggle float-left">-->
<!--                        <input type="hidden" name="LoginForm[rememberMe]" value="0">-->
<!--                        <input class="toggle__input" name="LoginForm[rememberMe]" type="checkbox" value="1" checked>-->
<!--                        <span class="toggle__label">-->
<!--                                        <span class="toggle__text">Remember password</span>-->
<!--                                    </span>-->
<!--                    </label>-->
<!--                    <a class="text-form-style_2 float-right font-weight-bold pt-1"-->
<!--                       href="--><?//= Url::to(['reset-password']); ?><!--">Forgot your password?</a>-->
<!--                </div>-->
<!--                <div class="text-center mt-3 mb-4">-->
<!--                    <input class="btn bg-form_style_1 text-white px-5 btn-login"-->
<!--                           type="submit" value="Login">-->
<!--                </div>-->
<!--                <div class="w-75 text-center pt-3 m-auto text-font-pn_regular"-->
<!--                     style="border-top: 2px dashed #efefef;">-->
<!--                    <span class="text-center">Still no account?</span>-->
<!--                    <p class="d-block message">-->
<!--                        <a class="text-form-style_2 reg_btn" href="--><?//= Url::to(['signup']) ?><!--">-->
<!--                            Register Here-->
<!--                        </a>-->
<!--                    </p>-->
<!--                </div>-->
<!--                <div class="text-center pt-2 m-auto">-->
<!--                                <span class="text-muted" style="font-size: 0.9rem">-->
<!--                                    By entering the My Profile section, you accept the-->
<!--                                    <a class="text-form-style_2" href=""> Terms of Use.</a>-->
<!--                                </span>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
</div>
