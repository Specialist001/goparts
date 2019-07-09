<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SellerQuerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requests';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('
    .dropdown-menu {
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
    }
    .seller-query_imageboxes {
        width: 80px;
        padding-left: 0;
        cursor: pointer;
        display: inline-block;
    }
    .seller-query_imageboxes li.d-none {
        display: none;
    }
    .seller-query_imageboxes li img {
        width: 100%;
    }
');
?>
<div class="seller-query-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
<!--        --><?//= Html::a('Create Seller Query', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Clear Sort', ['/seller-query'], ['class' => 'btn btn-warning']) ?>
    </p>

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
                'format' => 'raw',
                'value' => function ($model) {
//                    return '<a href="'.\yii\helpers\Url::to(['seller-query/view', 'id'=>$model->id]).'">'.$model->id.'</a>';
                    return
                        '<div class="dropdown">
                            <a class="btn dropdown-toggle" type="button" id="dropdownMenuId'.$model->id.'" data-toggle="dropdown">
                                '.$model->id.'
                                <span class="caret"></span>
                              </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuId'.$model->id.'">
                            <li role="presentation"><strong style="padding-left: 5px">Query ID: </strong><a href="'.\yii\helpers\Url::to(['query/view', 'id'=>$model->query_id]).'" role="menuitem" tabindex="-1">'.$model->query_id.'</a></li>
                            </ul>
                        </div>';
                }
            ],

            [
                'attribute' => 'seller_id',
                'label' => 'Seller',
                'format' => 'raw',
                'value' => function ($model) {
//                    return $model->seller_id
//                        ? '<a href="'.\yii\helpers\Url::to(['user/view', 'id'=>$model->seller->id]).'">'.$model->seller->username.'</a>'
//                        : null;
                    $seller_data = '
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" type="button" id="dropdownMenuUser'.$model->id.'" data-toggle="dropdown">
                                '.$model->seller->username.'
                                <span class="caret"></span>
                              </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuUser'.$model->id.'">
                            <li role="presentation"><strong style="padding-left: 5px">Email: </strong><a role="menuitem" href="mailto:'.$model->seller->email.'" tabindex="-1">'.$model->seller->email.'</a></li>';
                        if ($model->seller->phone) {
                            $seller_data .= '<li role="presentation"><strong style="padding-left: 5px">Phone: </strong><a role="menuitem" href="tel:'.$model->seller->phone.'" tabindex="-1">'.$model->seller->phone.'</a></li>';
                        }
                        if ($model->seller->location) {
                            $seller_data .= '<li role="presentation"><strong style="padding-left: 5px">Location: </strong><a role="menuitem" tabindex="-1">'.$model->seller->location.'</a></li>';
                        }
                        if ($model->seller->legal_info) {
                            $seller_data .= '<li role="presentation"><strong style="padding-left: 5px">Company name: </strong><a role="menuitem" tabindex="-1">'.$model->seller->legal_info.'</a></li>';
                        }
                        if ($model->seller->legal_address) {
                            $seller_data .= '<li role="presentation"><strong style="padding-left: 5px">Company address: </strong><a role="menuitem" tabindex="-1">'.$model->seller->legal_address.'</a></li>';
                        }
                        if ($model->seller->legal_bank_account) {
                            $seller_data .= '<li role="presentation"><strong style="padding-left: 5px">Bank account: </strong><a role="menuitem" tabindex="-1">'.$model->seller->legal_bank_account.'</a></li>';
                        }

                        $seller_data .='
                            <li role="presentation" class="divider"></li>
                            <li role="presentation">
                                <a tabindex="-1" target="_blank" href="'.\yii\helpers\Url::to(['user/view', 'id'=>$model->seller->id]).'">Seller Details</a>
                            </li>
                            </ul>
                        </div>';

                        return $seller_data ? $seller_data : null;
                    
                }
            ],
            [
//                'attribute' => 'id',
                'format' => 'raw',
                'label' => 'Car',
                'value' => function ($model) {
//                    return '<a href="'.\yii\helpers\Url::to(['seller-query/view', 'id'=>$model->id]).'">'.$model->id.'</a>';
                    return
                        '<div class="dropdown">
                            <a class="btn dropdown-toggle" type="button" id="dropdownMenuCar'.$model->id.'" data-toggle="dropdown">
                                '.$model->query->vendor.'
                                <span class="caret"></span>
                              </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuCar'.$model->id.'">
                                <li role="presentation"><strong style="padding-left: 5px">Model: </strong><a role="menuitem" tabindex="-1">'.$model->query->car.'</a></li>
                                <li role="presentation"><strong style="padding-left: 5px">Generation: </strong><a role="menuitem" tabindex="-1">'.$model->query->modification.'</a></li>
                                <li role="presentation"><strong style="padding-left: 5px">Year: </strong><a role="menuitem" tabindex="-1">'.$model->query->year.'</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><strong style="padding-left: 5px">Fueltype: </strong><a role="menuitem">'.$model->query->fueltype.'</a></li>
                                <li role="presentation"><strong style="padding-left: 5px">Engine CC: </strong><a role="menuitem">'.$model->query->engine.'</a></li>
                                <li role="presentation"><strong style="padding-left: 5px">Transmission: </strong><a role="menuitem">'.$model->query->transmission.'</a></li>
                                <li role="presentation"><strong style="padding-left: 5px">Drive type: </strong><a role="menuitem">'.$model->query->drivetype.'</a></li>
                            </ul>
                        </div>';
                }
            ],
            [
                'label' => 'Description',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->product_id ?
                        '<div class="dropdown">
                            <a class="btn dropdown-toggle" type="button" id="dropdownMenuDesc'.$model->id.'" data-toggle="dropdown">
                                '.substr($model->product->translate->description,0,10).'
                                <span class="caret"></span>
                              </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuDesc'.$model->id.'">
                                <li role="presentation"><strong style="padding-left: 5px">Description: </strong><a role="menuitem" tabindex="-1">'.$model->product->translate->description.'</a></li>
                            </ul>
                        </div>' :
                        null;
                }
            ],
            [
                'attribute' => 'price',
                'label' => 'Price',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->product_id ?
                        '<strong>'.$model->product->price.' AED</strong>':
                        null;
                }
            ],
            [
                'attribute'=>'image',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->product->images) {
                        $img_string = '<ul class="seller-query_imageboxes pl-0 d-inline-block">';
                        $img_string .= '<li class="seller-query_imagebox">
                                    <img src="'.$model->product->firstImage->link .'" class="img-fluid" alt="product">
                                </li>';
                        foreach ($model->product->images as $p_image) {
                            $img_string .= '<li class="d-none">
                                        <img src="'.$p_image->link .'" class="img-fluid" alt="product">
                                    </li>';
                        }
                        $img_string .= '</ul>';
                    }

//                    return $model->firstImage->name ? '<img src="'.$model->firstImage->name.'" class="img-responsive" alt="query_'.$model->id.'" style="width: 80px">' : null;
                    return $model->product->images ? $img_string : null;
                }
            ],
            [
                'attribute' => 'status',
                'format' =>'sellerQuery',
                'filter' => ['0'=>'Waited','1'=>'Moderate','2'=>'Published','3'=>'Purchased']
            ],
            //'created_at',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('d/m/Y', $model->created_at);
                }
            ],
            [
                'label' => 'Action',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->status == 0) {
                        $btn = '<a href="#" class="btn btn-warning disabled">Waited</a>';
                    } elseif ($model->status == 1) {
                        $btn = '<a class="btn btn-primary buyer-send" data-query_id="'.$model->query_id.'" data-seller_query_id="'.$model->id.'">Send to buyer</a>';
                    } elseif ($model->status == 2) {
                        $btn = '<a href="#" class="btn btn-info disabled" data-query_id="'.$model->query_id.'" data-seller_query_id="'.$model->id.'">Sent</a>';
                    } else {
                        $btn = '<a href="#" class="btn btn-success disabled">Purchased</a>';
                    }

                    return $btn;
                }
            ],
            [
                'label' => 'Update',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->product_id ?
                        '<a target="_blank" href="'.\yii\helpers\Url::to(['store-product/update','id'=>$model->product_id]).'" class="btn btn-default bg-olive">Update</a>' :
                        null;
                }
            ],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<?php $this->registerJs('
    $(document).ready(function () {
 

        $(\'.buyer-send\').click(function () {
            var id = $(this).data("seller_query_id");
            var query_id = $(this).data("query_id");
            var btn = $(this);
            
            $.ajax({
                type: "POST",
                url: "/admin/seller-query/send-buyer",
                data: {id: id, query_id: query_id, status: status},
                success: function (data) {
                    console.log(data);
                    $(btn).attr(\'disabled\', true).removeClass(\'.buyer-send\').removeClass(\'.btn-info\');
                    $(btn).text(\'Sent\');
                    $(btn).addClass(\'btn-info\');
                    $(btn).addClass(\'disabled\');
                    $.notify(data[\'status\'], "success");
                },
                error: function (data) {
                    $.notify("Data not send", "error");
                }
            });
            
        });

    });
'); ?>
<?php $this->registerJs('
        var $seller_query_images = $(\'.seller-query_imageboxes\');
        var options = {
            url: \'data-original\' };
        $seller_query_images.on({ready:  function (e) {
                console.log(e.type);
            }
        }).viewer(options);
    ');
?>