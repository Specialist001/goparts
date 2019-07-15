<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreCommission */

$this->title = 'Update Store Commission: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Store Commissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-commission-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
