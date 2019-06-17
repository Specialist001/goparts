<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Queries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="query-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

<!--    <p>-->
<!--        --><?//= Html::a('Create Query', ['create'], ['class' => 'btn btn-success']) ?>
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
            'name',
            'phone',
            'email:email',
//            'car_id',
            'vendor',
            [
                'attribute' => 'category_id',
                'label' => 'Category',
                'value' => function($model) {
                    return $model->category->translate->title;
                }
            ],            'vendor',

            //'year',
            //'modification',
            //'fueltype',
            //'engine',
            //'transmission',
            //'drivetype',

            //'image',
            [
                'attribute'=>'status',
                'label' => 'Status',
                'filter' => array("0" => "Moderate", "1" => "Verified", "2"=>"Purchased", "-1"=>"Deleted"),
                'format' => 'query',
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Create Date',
                'value' => function($model) {
                    return date('d.m.Y H:i', $model->created_at);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
