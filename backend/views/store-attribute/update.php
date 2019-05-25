<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreAttribute */

$this->title = 'Update Store Attribute: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Store Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-attribute-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'translation_en' => $translation_en,
        'translation_ar' => $translation_ar,
        'translation_ru' => $translation_ru,
    ]) ?>

</div>
