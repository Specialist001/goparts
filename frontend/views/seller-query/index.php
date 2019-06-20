<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SellerQuerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seller Queries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seller-query-index mh-100">
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-md-2">
                <?= $this->render('//user/_usermenu.php') ?>
            </div>
            <div class="col-md-9">

                <h4><?= Html::encode($this->title) ?></h4>

<!--                <p>-->
<!--                    --><?//= Html::a('Create Seller Query', ['create'], ['class' => 'btn btn-success']) ?>
<!--                </p>-->

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute'=>'id',
                            'headerOptions' => ['style' => 'width:80px'],
                        ],
                        [
                            'attribute'=>'query_id',
                            'headerOptions' => ['style' => 'width:100px'],
                        ],
                        [
                            'label' => 'Category',
                            'value' => function ($model) {
                                return $model->query->category->translate->title;
                            }
                        ],
                        [
                            'label' => 'Car',
                            'value' => function ($model) {
                                return $model->query->vendor . ' '.$model->query->car;
                            }
                        ],
//                        'seller_id',
                        [
                            'attribute'=>'product_id',
                            'headerOptions' => ['style' => 'width:110px'],
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'sellerQuery',
                            'filter' => ['0'=>'Waited', '1'=>'Purchased']
                        ],
                        [
                            'label'=>'Action',
                            'format' => 'raw',
                            'value' => function ($model) {
//                                return Url::to(['user/product/create', 'car_id'=>$model->query->car_id, 'category'=>$model->query->category_id]);
                                return $model->status == 0
                                    ? Html::a('Create Product', Url::to(['user/product/create', 'car_id'=>$model->query->car_id, 'category'=>$model->query->category_id]))
                                    : Html::a('Update Product', Url::to(['user/product/update', 'id'=>$model->product_id]));
                            }
                        ],
                        //'created_at',
                        //'updated_at',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
