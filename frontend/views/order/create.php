<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreOrder */

$this->title = 'Create Store Order';
$this->params['breadcrumbs'][] = ['label' => 'Store Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
