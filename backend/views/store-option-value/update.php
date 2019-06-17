<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreOptionValue */

$this->title = 'Update Store Option Value: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Store Option Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-option-value-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'options_array' => $options_array,
    ]) ?>

</div>
