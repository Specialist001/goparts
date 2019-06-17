<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreOption */

$this->title = 'Update Store Option: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Store Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-option-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
