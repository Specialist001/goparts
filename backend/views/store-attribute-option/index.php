<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreAttributeOptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Attribute Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-attribute-option-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a('Create Store Attribute Option', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:120px'],
            ],
            [
                'attribute' => 'attribute_id',
                'headerOptions' => ['style' => 'width:120px'],
            ],
            [
                'attribute' => 'value',
                'label' => 'Attribute Option Name',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a(Html::encode($model->translate->value), Url::to(['update', 'id' => $model->id]));
                }
            ],
            [
                'attribute' => 'attribute_name',
                'label' => 'Attribute Name',
                'filter' => $attribute_filter,
                'value' => function($model) {
                    return $model->attribute0->translate->title;
                }
            ],


            'order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
