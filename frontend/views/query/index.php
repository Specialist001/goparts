<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\QuerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Queries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="query-index">
    <div class="container">
        <div class="row">
            <div class="col-md-12">



    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Query', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'car_id',
            'category_id',
            'vendor',
            //'car',
            //'year',
            //'modification',
            //'fueltype',
            //'engine',
            //'transmission',
            //'drivetype',
            //'name',
            //'phone',
            //'email:email',
            //'image',
            //'status',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
