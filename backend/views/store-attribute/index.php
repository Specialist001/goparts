<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreAttributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Attributes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-attribute-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a('Create Store Attribute', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create Filter', ['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
                'filter' => array("0" => "Not required", "1" => "Required"),
                'headerOptions' => ['style' => 'width:120px'],
            ],
            [
                'attribute' => 'order',
                'headerOptions' => ['style' => 'width:80px', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'is_filter',
                'format' => 'filter',
                'filter' => array("0" => "Not filtered", "1" => "Is Filtered"),
                'headerOptions' => ['style' => 'width:120px'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
