<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreOption */

$this->title = 'Create Store Option';
$this->params['breadcrumbs'][] = ['label' => 'Store Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-option-create">

<!--    <h3>--><?//= Html::encode($this->title) ?><!--</h3>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
