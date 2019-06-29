<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StoreOrder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Store Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="store-order-view">

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
            'user_id',
            'delivery_id',
            'manager_id',
            'delivery_price',
            'payment_method_id',
            'status',
            'paid',
            'payment_time:datetime',
            'payment_details:ntext',
            'total_price',
            'discount',
            'coupon_discount',
            'separate_delivery',
            'name',
            'street',
            'phone',
            'email:email',
            'comment:ntext',
            'ip',
            'url:url',
            'note:ntext',
            'zipcode',
            'country',
            'city',
            'house',
            'apartment',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
