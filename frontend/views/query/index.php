<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\QuerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Queries';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss('
    .query_imageboxes {
        width: 80px;
        padding-left: 0;
        cursor: pointer;
        display: inline-block;
    }
    .query_imageboxes li.d-none {
        display: none;
    }
    .query_imageboxes li img {
        width: 100%;
    }
');
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
//            'user_id',
//            'car_id',
                        [
                            'attribute' => 'vendor',
                            'label' => 'Car',
                            'value' => function ($model) {
                                return $model->vendor . ' ' . $model->car . ' '.$model->year;
                            }
                        ],
//            'category_id',
//                        [
//                            'attribute' => 'category_id',
//                            'label' => 'Category',
//                            'value' => function ($model) {
//                                return $model->category->translate->title;
//                            }
//                        ],
//            'vendor',
                        //'car',
                        //'year',
                        //'modification',
                        'fueltype',
                        'engine',
                        'transmission',
                        'drivetype',
                        [
                            'attribute'=>'image',
                            'format' => 'raw',
                            'value' => function ($model) {
                                if($model->images) {
                                    $img_string = '<ul class="query_imageboxes pl-0 d-inline-block">';
                                    $img_string .= '<li class="query_imagebox">
                                    <img src="'.$model->firstImage->name .'" class="img-fluid" alt="product">
                                </li>';
                                    foreach ($model->images as $p_image) {
                                        $img_string .= '<li class="d-none">
                                        <img src="'.$p_image->name .'" class="img-fluid" alt="product">
                                    </li>';
                                    }
                                    $img_string .= '</ul>';
                                }

//                    return $model->firstImage->name ? '<img src="'.$model->firstImage->name.'" class="img-responsive" alt="query_'.$model->id.'" style="width: 80px">' : null;
                                return $model->images ? $img_string : null;
                            }
                        ],
                        [
                            'attribute'=>'status',
                            'label' => 'Status',
                            'filter' => array("0" => "Moderate", "1" => "Verified", "2"=>"Purchased", "-1"=>"Deleted"),
                            'format' => 'query',
                        ],
//                        'name',
                        //'phone',
                        //'email:email',
                        //'image',
//            'status',
                        //'created_at',
                        [
                            'attribute' => 'created_at',
                            'label' => 'Date',
                            'value' => function ($model) {
                                return date('d/m/Y', $model->created_at);
                            }
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->registerJs('
        var $query_images = $(\'.query_imageboxes\');
        var options = {
            url: \'data-original\' };
        $query_images.on({ready:  function (e) {
                console.log(e.type);
            }
        }).viewer(options);
    ');
?>