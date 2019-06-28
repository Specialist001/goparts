<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SellerQuery */

$this->title = 'Create Seller Query';
$this->params['breadcrumbs'][] = ['label' => 'Seller Queries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seller-query-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
