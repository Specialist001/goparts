<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreCommission */

$this->title = 'Create Store Commission';
$this->params['breadcrumbs'][] = ['label' => 'Store Commissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-commission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
