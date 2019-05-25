<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreType */

$this->title = 'Update Store Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Store Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-type-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'typeAttribute' => $typeAttribute,
        'attribute_array' => $attribute_array,
    ]) ?>

</div>
