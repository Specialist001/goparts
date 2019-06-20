<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreDelivery */

$this->title = 'Update Store Delivery: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Store Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-delivery-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
