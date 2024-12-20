<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreAttributeGroup */

$this->title = 'Update Store Attribute Group: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Store Attribute Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-attribute-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
