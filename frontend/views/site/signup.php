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
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'email') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'phone')->passwordInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'location')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'role')->dropDownList(['0'=>'Buyer','1'=>'Seller']) ?>
                </div>
                <div class="col-md-3 legal-info" style="display: none">
                    <?= $form->field($model, 'legal_info')->textInput() ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
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