<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreAttributeGroup */

$this->title = 'Create Store Attribute Group';
$this->params['breadcrumbs'][] = ['label' => 'Store Attribute Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-attribute-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
