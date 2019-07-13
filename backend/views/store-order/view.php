<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StoreOrder */

$this->title = 'Order #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Store Orders', 'url' => ['index?sort=-id']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="store-order-view">
    <div class="container">
        <p>
            <?= Html::a(FA::i('chevron-left').' Back', ['/store-order?sort=-id'], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <div class="row">
            <div class="col-md-4">
                <h4>Contact info</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'phone',
                        'email:email',
                        ['attribute'=>'city','label'=>'Location'],
                    ],
                ]) ?>
            </div>
            <div class="col-md-8">
                <h4>Request info</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'user_id',
//                        'delivery_id',
//                        'manager_id',
//                        'delivery_price',
//                        'payment_method_id',
//                        'status',
                        [
                            'attribute' => 'status',
                            'format' => 'orderStatus',
                        ],
//                        'paid',
                        [
                            'attribute' => 'paid',
                            'format' => 'paid',
                        ],
//                        'payment_time:datetime',
//                        'payment_details:ntext',
                        [
                            'label' => 'Total products',
                            'format' => 'raw',
                            'value' => function($model) {
                                return count($model->storeOrderProducts);
                            }
                        ],
                        [
                            'attribute' => 'total_price',
                            'format' => 'raw',
                            'value' => function($model) {
                                return '<strong>'.$model->total_price .' AED</strong>';
                            }
                        ],
//                        'discount',
//                        'coupon_discount',
//                        'separate_delivery',
//                        'name',
//                        'street',
//                        'phone',
//                        'email:email',
//                        'comment:ntext',
                        'ip',
//                        'url:url',
//                        'note:ntext',
//                        'zipcode',
//                        'country',
//                        'city',
//                        'house',
//                        'apartment',
                        [
                            'attribute' => 'created_at',
                            'value' => function($data) {
                                return date('d/m/Y',$data->created_at);
                            }
                        ],
                        [
                            'attribute' => 'updated_at',
                            'value' => function($data) {
                                return date('d/m/Y',$data->updated_at);
                            }
                        ],
                    ],
                ]) ?>
            </div>
        </div>
        <br>
        <h3>Order Products</h3>
        <div class="row">
            <div class="col-md-8">
            <?php if($model->storeOrderProducts) { ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Pr. ID</th>
                            <th>Car</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Seller</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter=0;
                            foreach ($model->storeOrderProducts as $orderProduct) { $counter++ ?>
                            <tr>
                                <td><?= $counter ?></td>
                                <td><?= $orderProduct->id ?></td>
                                <td><?= $orderProduct->product->car->vendor.' '.$orderProduct->product->car->car.' '.$orderProduct->product->car->modification.' '.$orderProduct->product->car->year ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle" type="button" id="dropdownProduct<?=$orderProduct->id?>" data-toggle="dropdown">
                                            <?= \yii\helpers\StringHelper::truncate($orderProduct->product->translate->description,'10') ?>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownProduct<?=$orderProduct->id?>">
                                            <li role="presentation" style="padding:5px">
                                                <p><?= $orderProduct->product->translate->description ?></p>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                                <td><?= $orderProduct->price ?></td>
                                <td><?= $orderProduct->product->user->username ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    <div class="alert alert-warning">
                        No products
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>






</div>
