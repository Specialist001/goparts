<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreDelivery */

$this->title = 'Create Store Delivery';
$this->params['breadcrumbs'][] = ['label' => 'Store Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-delivery-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
