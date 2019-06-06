<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'menu_id') ?>

    <?= $form->field($model, 'regular_link') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'href') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'title_attr') ?>

    <?php // echo $form->field($model, 'before_link') ?>

    <?php // echo $form->field($model, 'after_link') ?>

    <?php // echo $form->field($model, 'target') ?>

    <?php // echo $form->field($model, 'rel') ?>

    <?php // echo $form->field($model, 'condition_name') ?>

    <?php // echo $form->field($model, 'condition_denial') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
