<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Store Category');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="store-category-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a('Create Store Category', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Clear Filters', [''], ['class' => 'btn btn-warning']) ?>
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
                    return ($model->image) ? Html::img($model->image, ['class'=>'img-thumbnail','alt'=>$model->translate->title,'width'=>'50']) : false;
                }
            ],
            [
                'label' => 'name',
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->translate->title), Url::to(['update', 'id' => $model->id]));
                }
            ],
            'slug',
            [
                'label' => 'Parent Category',
                'attribute' => 'parent_id',
                'filter' => $parent_filter,
                'value' => function ($data) {
                    return $data->parent->translate->title;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'active',
                'filter' => array("0" => "Inactive", "1" => "Ative"),
            ],
            'order',
            //'view',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<?php $this->registerJs('
    $(document).ready(function() {
        $(\'select.form-control\').select2(
            {
                language: {
                  noResults: function () {
                    return "Ничего не найдено";
                  }
                }
            }
        );
    });
    $(document).on(\'ready pjax:success\', function() {
        $(\'select.form-control\').select2(
            {
                language: {
                  noResults: function () {
                    return "Ничего не найдено";
                  }
                }
            }
        );
    });
');?>