<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Query */
/* @var $form yii\widgets\ActiveForm */
$this->registerCss('
    .query_imageboxes {
        width: 24%;
        padding-left: 0;
        cursor: pointer;
    }
    .query_imageboxes li img {
        width: 100%;
    }
');
?>

<div class="query-form">

    <?php $form = ActiveForm::begin(); ?>
    <h3>Car</h3>
    <div class="row">
        <div class="col-md-3">
<!--            <div class="form-group">-->
<!--                <label>Car</label>-->
<!--                <input type="text" class="form-control" readonly-->
<!--                       value="--><?//=$model->vendor.' '.$model->car.' '.$model->modification.' '.$model->year ?><!--">-->
<!--            </div>-->
            <?= $form->field($model, 'vendor')->textInput(['maxlength' => true,'readonly'=>true])->label('Make') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'car')->textInput(['maxlength' => true,'readonly'=>true])->label('Model') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'modification')->textInput(['maxlength' => true, 'readonly'=>true])->label('Generation') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'year')->textInput(['maxlength' => true, 'readonly'=>true])->label('Year') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'fueltype')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'engine')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'transmission')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'drivetype')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
        </div>
    </div>
    <br>
    <h3>Descriptions</h3>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textarea(['value'=>$model->description ? $model->description : '', 'rows'=>5]) ?>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Images</label>
                <ul class="query_imageboxes pl-0 d-inline-block">
                    <li class="query_imagebox">
                        <img src="<?= $model->firstImage->name ?>" class="img-fluid"
                             alt="product">
                    </li>
                    <?php if($model->images) {
                        foreach ($model->images as $q_image) {
                            ?>
                            <li class="d-none" style="display: none">
                                <img src="<?= $q_image->name ?>" class="img-fluid"
                                     alt="product">
                            </li>
                        <?php } } ?>
                </ul>
            </div>
        </div>
<!--        <div class="col-md-3">-->
<!--            --><?//= $form->field($model, 'transmission')->textInput(['maxlength' => true]) ?>
<!--        </div>-->
<!--        <div class="col-md-3">-->
<!--            --><?//= $form->field($model, 'drivetype')->textInput(['maxlength' => true]) ?>
<!--        </div>-->
    </div>
    <br>
    <h3>Contacts</h3>
    <div class="row">
        <div class="col-md-3"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?></div>
<!--        <div class="col-md-3">--><?//= $form->field($model, 'status')->textInput() ?><!--</div>-->
    </div>

<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'car_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'category_id')->textInput() ?>


<!--    --><?//= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs('
        var $query_images = $(\'.query_imageboxes\');
        var options = {
            url: \'data-original\' };
        $query_images.on({ready:  function (e) {
                console.log(e.type);
            }
        }).viewer(options);
    ');
?>