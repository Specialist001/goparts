<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
//                            'translation:html',
                            [
                                'attribute' => 'translation',
                                'format' => 'html',
                                'value' => function($model) {
                                    return \yii\helpers\StringHelper::truncate($model->translation,'60');
                                }
                            ],
                            [
                                'label'=>'Action',
                                'format' => 'raw',
                                'value' => function($model) {
//                                    return Html::a(FA::i('arrow-right')->size('2x'),'update?id='.$model->id,['class' => 'text-secondary']);
//                                    return '<a href="'.Url::to(['/message']).'"><i class="fa fa-list"></i> Messages</a>';
                                        return Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                                }
                            ],
//                            [
//                                'class' => 'yii\grid\ActionColumn',
//                                'template' => ' {update}',
//                                'buttons' => [
//                                    'update' => function ($url, $data)  {
//                                        return Html::a(
//                                            FA::i('arrow-right')->size('2x'),
//                                            $url, ['class' => 'text-secondary']);
//                                    }
//                                ]
//                            ],
                        ],
                    ]); ?>
                </div>
                <?php Pjax::end(); ?>


            </div>
        </div>
    </div>

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--    <p>-->
<!--        --><?//= Html::a('Create Message', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->



</div>
