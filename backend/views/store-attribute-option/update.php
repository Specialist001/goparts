<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreAttributeOption */

$this->title = 'Update Store Attribute Option: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Store Attribute Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-attribute-option-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'attributes' => $attributes,
        'translation_en' => $translation_en,
        'translation_ar' => $translation_ar,
        'translation_ru' => $translation_ru,
    ]) ?>

</div>
