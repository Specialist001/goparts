<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StoreProduct */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Store Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="store-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'type_id',
            'producer_id',
            'category_id',
            'type_car_id',
            'user_id',
            'sku',
            'serial_number',
            'slug',
            'price',
            'discount_price',
            'discount',
            'data:ntext',
            'is_special',
            'length',
            'width',
            'height',
            'weight',
            'quantity',
            'in_stock',
            'status',
            'title',
            'image',
            'average_price',
            'purchase_price',
            'recommended_price',
            'order',
            'external_id',
            'view',
            'qid',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
