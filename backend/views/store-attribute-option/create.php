<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreAttributeOption */

$this->title = 'Create Store Attribute Option';
$this->params['breadcrumbs'][] = ['label' => 'Store Attribute Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-attribute-option-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'attributes' => $attributes,
        'translation_en' => $translation_en,
        'translation_ar' => $translation_ar,
        'translation_ru' => $translation_ru,
    ]) ?>

</div>
