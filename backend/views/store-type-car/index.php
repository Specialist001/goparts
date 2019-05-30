<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreTypeCarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Type Cars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-type-car-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a('Create Store Type Car', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Image',
                'attribute' => 'image',
                'headerOptions' => ['style' => 'width:100px'],
                'format' => 'raw',
                'value' => function($model) {
                    return ($model->image) ? Html::img($model->image, ['class'=>'img-thumbnail','alt'=>$model->translate->name,'width'=>'50']) : false;
                }
            ],
            [
                'label' => 'Name',
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(Html::encode($data->translate->name), Url::to(['update', 'id' => $data->id]));
                }
            ],
            'slug',
            [
                'label' => 'Parent Category',
                'attribute' => 'parent_id',
                'filter' => $parent_filter,
                'value' => function ($data) {
                    return $data->parent->translate->name;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'active',
                'filter' => array("0" => "Inactive", "1" => "Ative"),
            ],
            //'order',
            //'view',
            //'image',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
