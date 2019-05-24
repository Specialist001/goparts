<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StoreCategory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Store Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="store-category-view">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a(\rmrevin\yii\fontawesome\FA::i('chevron-left').' Back', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'parent_id',
                'filter' => $parent_filter,
                'value' => function ($data) {
                    return $data->parent->translate->title;
                }
            ],
            [
                'label' => 'Name',
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(Html::encode($data->translate->title), Url::to(['update', 'id' => $data->id]));
                }
            ],
            'slug',
            [
                'label' => 'Image',
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($model) {
                    return ($model->image) ? Html::img($model->image, ['alt'=>$model->translate->title,'width'=>'50']) : false;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'active',
            ],
            'order',
            'view',
            [
                'label' => 'Created Date',
                'attribute' => 'created_at',
                'value' => function($model) {
                    return date('d.m.Y H:i', $model->created_at);
                }
            ],
            [
                'label' => 'Updated Date',
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return date('d.m.Y H:i', $model->updated_at);
                }
            ],
        ],
    ]) ?>

</div>
