<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuerySearch */
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

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

<!--    <p>-->
        <?= Html::a('Clear sort', [''], ['class' => 'btn btn-warning']) ?>
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
//                    return '<a href="'.\yii\helpers\Url::to(['query/view', 'id'=>$model->id]).'">'.$model->name.'</a>';
                    return '
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" type="button" id="dropdownMenu'.$model->id.'" data-toggle="dropdown">
                            '.$model->name.'
                            <span class="caret"></span>
                          </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu'.$model->id.'">
                        <li role="presentation"><strong style="padding-left: 5px">Phone: </strong><a role="menuitem" href="tel:'.$model->phone.'" tabindex="-1">'.$model->phone.'</a></li>
                        <li role="presentation"><strong style="padding-left: 5px">E-mail: </strong><a role="menuitem" href="mailto:'.$model->email.'" tabindex="-1">'.$model->email.'</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation">
                            <a tabindex="-1" target="_blank" href="'.\yii\helpers\Url::to(['query/view', 'id'=>$model->id]).'">View Details</a>
                            </li>
                        </ul>
                    </div>';
                }
            ],
//            'phone',
//            'email:email',
//            [
//
//            ],

//            'car_id',
//            'vendor',
//            [
//                'attribute' => 'vendor',
//                'value' => function ($model) {
//                    return $model->vendor.' '.$model->car.' '.$model->year;
//                }
//            ],
            [
                'attribute' => 'vendor',
                'format' => 'raw',
                'value' => function ($model) {
//                    return '<a href="'.\yii\helpers\Url::to(['query/view', 'id'=>$model->id]).'">'.$model->name.'</a>';
                    return '
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" type="button" id="dropdownMenuCar'.$model->id.'" data-toggle="dropdown">
                            '.$model->vendor.' '.$model->car.' '.$model->year.'
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuCar'.$model->id.'">
                        <li role="presentation"><strong style="padding-left: 5px">Generation: </strong><a role="menuitem">'.$model->modification.'</a></li>
                        <li role="presentation"><strong style="padding-left: 5px">Fueltype: </strong><a role="menuitem">'.$model->fueltype.'</a></li>
                        <li role="presentation"><strong style="padding-left: 5px">Engine CC: </strong><a role="menuitem">'.$model->engine.'</a></li>
                        <li role="presentation"><strong style="padding-left: 5px">Transmission: </strong><a role="menuitem">'.$model->transmission.'</a></li>
                        <li role="presentation"><strong style="padding-left: 5px">Drive type: </strong><a role="menuitem">'.$model->drivetype.'</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation">
                            <a tabindex="-1" target="_blank" href="'.\yii\helpers\Url::to(['query/view', 'id'=>$model->id]).'">View Details</a>
                            </li>
                        </ul>
                    </div>';
                }
            ],

//            'description',
            [
                'attribute' => 'description',
                'format' => 'raw',
                'value' => function ($model) {
//                    return \yii\helpers\StringHelper::truncate($model->description,'10');
                    return $model->description ?
                    '<div class="dropdown">
                        <a class="btn dropdown-toggle" type="button" id="dropdownMenuDesc'.$model->id.'" data-toggle="dropdown">
                            '.\yii\helpers\StringHelper::truncate($model->description,'10').'
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuDesc'.$model->id.'">
                        <li role="presentation" style="padding:5px"><p>'.$model->description.'</p></li>
                      
                        </ul>
                    </div>' :
                        null;
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
            [
                'attribute' => 'created_at',
                'label' => 'Create Date',
                'value' => function($model) {
                    return date('d.m.Y', $model->created_at);
                }
            ],
            [
                'label' => 'Action',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->status == 0
                        ? '<a class="btn btn-primary seller-send" data-query_id="'.$model->id.'">Approve</a>'
                        : '<a href="#" class="btn btn-success disabled">Approved</a>';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<?php $this->registerJs('
    $(document).ready(function () {

       
//        var sellers = [];
//        $(".sellers").each(function () {
//            if($(this).is(":checked")) {
//                sellers.push($(this).val());
//            }
//        });
        
        
//         var disabled = $(\'.seller-send\').attr("disabled"); 

        $(\'.seller-send\').click(function () {
            var query_id = $(this).data("query_id");
            var btn = $(this);
            
            $.ajax({
                type: "POST",
                url: "send-sellers",
                data: {query_id: query_id, status: status},
                success: function (data) {
                    console.log(data);
                    console.log(btn);
//                        $(".sellers").prop(\'disabled\', true);
                    $(btn).attr(\'disabled\', true).removeClass(\'.seller-send\').removeClass(\'.btn-info\');
                    $(btn).text(\'Approved\');
                    $(btn).addClass(\'btn-success\');
                    $(btn).addClass(\'disabled\');
//                    $.notify(data[\'status\'], "success");
                },
                error: function (data) {
                    $.notify("Data not send", "error");
                }
            });
            
        });

    });
'); ?>
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
