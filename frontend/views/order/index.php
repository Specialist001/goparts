<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\QuerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-order-index">
    <div class="container">
        <div class="row">
            <?php if (!Yii::$app->user->isGuest) { ?>
                <div class="col-md-3">
                    <?= $this->render('//user/_usermenu.php') ?>
                </div>
            <?php } ?>
            <div class="col">
                <h4><?= Html::encode($this->title) ?></h4>
                <p>

                </p>
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
//                        'user_id',
//                        'delivery_id',
//                        'manager_id',
//                        'delivery_price',
                        //'payment_method_id',
                        'status',
                        'paid',
                        //'payment_time:datetime',
                        //'payment_details:ntext',
                        'total_price',
                        //'discount',
                        //'coupon_discount',
                        //'separate_delivery',
                        'name',
                        //'street',
                        //'phone',
                        //'email:email',
                        //'comment:ntext',
                        //'ip',
                        //'url:url',
                        //'note:ntext',
                        //'zipcode',
                        //'country',
                        //'city',
                        //'house',
                        //'apartment',
//                        'created_at',
                        [
                            'attribute' => 'created_at',
                            'label' => 'Date',
                            'value' => function ($model) {
                                return date('d/m/Y H:m', $model->created_at);
                            }
                        ],
                        //'updated_at',

//                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>



<!--    <p>-->
<!--        --><?//= Html::a('Create Store Order', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->


    </div>

</div>
