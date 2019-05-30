<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreType */

$this->title = 'Create Store Type';
$this->params['breadcrumbs'][] = ['label' => 'Store Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-type-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'typeAttribute' => $typeAttribute,
        'attribute_array' => $attribute_array,
    ]) ?>

</div>
