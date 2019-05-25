<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StoreAttribute */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Store Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="store-attribute-view">

    <p>
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
//            'group_id',
            'name',
            [
                'label' => 'Title',
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(Html::encode($data->translate->title), Url::to(['update', 'id' => $data->id]));
                }
            ],
//            'type',
//            'unit',
            [
                'attribute' => 'required',
                'format' => 'required',
            ],
            'order',
            [
                'attribute' => 'is_filter',
                'format' => 'filter',
            ],
        ],
    ]) ?>
<p>
    <?= Html::a(\rmrevin\yii\fontawesome\FA::i('long-arrow-left').' Back', ['index'], ['class' => 'btn btn-warning']) ?>
</p>
</div>
