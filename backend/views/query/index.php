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

//            'id',
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:80px'],
            ],
            'user_id',
//            'name',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a href="'.\yii\helpers\Url::to(['query/view', 'id'=>$model->id]).'">'.$model->name.'</a>';
                }
            ],
            'phone',
            'email:email',
//            [
//
//            ],

//            'car_id',
//            'vendor',
            [
                'attribute' => 'vendor',
                'value' => function ($model) {
                    return $model->vendor.' '.$model->car.' '.$model->year;
                }
            ],
//            'description',
            [
                'attribute' => 'description',
                'value' => function ($model) {
                    return \yii\helpers\StringHelper::truncate($model->description,'100');
                }
            ],
//            [
//                'attribute' => 'category_id',
//                'options' => ['style' => 'width:80px'],
//                'label' => 'Category',
//                'value' => function($model) {
//                    return $model->category->translate->title;
//                }
//            ],
            //'year',
            //'modification',
            //'fueltype',
            //'engine',
            //'transmission',
            //'drivetype',

            //'image',
            [
                'attribute'=>'image',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->image ? '<img src="'.$model->image.'" class="img-responsive" alt="query_'.$model->id.'" style="width: 80px">' : null;
                }
            ],
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
                    return date('d.m.Y', $model->created_at);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
