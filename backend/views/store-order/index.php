<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-order-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

<!--    <p>-->
<!--        --><?//= Html::a('Create Store Order', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
//            'delivery_id',
//            'manager_id',
//            'delivery_price',
            //'payment_method_id',
//            'status',
            [
                'attribute' => 'status',
                'format' => 'orderStatus',
            ],
//            'paid',
            [
                'attribute' => 'paid',
                'format' => 'paid',
            ],
            //'payment_time:datetime',
            //'payment_details:ntext',
            'total_price',
            //'discount',
            //'coupon_discount',
            //'separate_delivery',
            'name',
            //'street',
            'phone',
            'email:email',
            //'comment:ntext',
            //'ip',
            //'url:url',
            //'note:ntext',
            //'zipcode',
            //'country',
            //'city',
            //'house',
            //'apartment',
            [
                'attribute' => 'created_at',
                'value' => function($data) {
                    return date('d/m/Y',$data->created_at);
                }
            ],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
