<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-product-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a('Create Store Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'Title',
                'value' => function ($model) {
                    return $model->translate->name;
                }
            ],
//            'type_id',
//            'producer_id',
//            'category_id',
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category->translate->title;
                }
            ],
//            'type_car_id',
            [
                'attribute' => 'type_car_id',
                'value' => function ($model) {
                    return $model->typeCar->translate->name;
                }
            ],
            //'user_id',
            'sku',
            //'serial_number',
            //'slug',
            'price',
            //'discount_price',
            //'discount',
            //'data:ntext',
            //'is_special',
            //'length',
            //'width',
            //'height',
            //'weight',
            //'quantity',
            //'in_stock',

            //'title',
            //'image',
            //'average_price',
            'purchase_price',
            'status',
            //'recommended_price',
            'order',
            //'external_id',
            //'view',
            //'qid',
            //'created_at',
            [
                'attribute' => 'created_at',
                'value' => function($data) {
                    return date('d/m/Y', $data->created_at);
                }
            ],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
