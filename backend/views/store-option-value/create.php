<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreOptionValue */

$this->title = 'Create Store Option Value';
$this->params['breadcrumbs'][] = ['label' => 'Store Option Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-option-value-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'options_array' => $options_array,
    ]) ?>

</div>
