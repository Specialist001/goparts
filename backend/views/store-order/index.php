<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-order-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

<!--    <p>-->
<!--        --><?//= Html::a('Create Store Order', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'user_id',
//            'delivery_id',
//            'manager_id',
//            'delivery_price',
            //'payment_method_id',
//            'status',
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
                        <li role="presentation"><strong style="padding-left: 5px">Location: </strong><a role="menuitem" tabindex="-1">'.$model->city.'</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation">
                            <a tabindex="-1" target="_blank" href="'.\yii\helpers\Url::to(['store-order/view', 'id'=>$model->id]).'">View Details</a>
                            </li>
                        </ul>
                    </div>';
                }
            ],
            [
                'label' => 'Products',
                'format' => 'raw',
                'value' => function ($model) {
                    $printer = "<div class=\"dropdown\">";
                    $printer .= "<a class=\"btn dropdown-toggle\" type=\"button\" id=\"dropdownMenuPr'.$model->id.'\" data-toggle=\"dropdown\">
                        ".count($model->storeOrderProducts)."
                        <span class=\"caret\"></span>
                      </a>";
                    $printer .= "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenuPr'.$model->id.'\">";
                    $printer .= "<li role=\"presentation\">";
                    $printer .= "<table class=\"table table-bordered\">";
                    $printer .= "<thead><tr>
                                    <th>Desc</th>
                                    <th>Car</th>
                                    <th>Price</th>
                                </tr></thead>";
                    $printer .= "<tbody>";
                    foreach ($model->storeOrderProducts as $orderProduct) {
                        $printer.= "<tr>";
                        $printer.= "<td>".substr($orderProduct->product_name,0,10) ."</td>";
                        $printer.= "<td>".$orderProduct->product->car->vendor." ".$orderProduct->product->car->car."</td>";
                        $printer.= "<td>".$orderProduct->price * 1 ." AED</td>";
                        $printer.= "</tr>";
                    }
                    $printer .= "</tbody>";
                    $printer .= "</table>";
                    $printer .= "</li>";
                    $printer .= "<li role=\"presentation\" class=\"divider text-center\"></li>";
                    $printer .= "</li>

                        <a tabindex=\"-1\" target=\"_blank\" href=".\yii\helpers\Url::to(['store-order/view', 'id'=>$model->id]).">View Details</a>
                        </li>";
                    $printer .= "</ul>";
                    $printer .= "</div>";
                    return $printer;

                }
            ],
//            [
//                'label' => 'Products',
//                'format' => 'raw',
//                'value' => function($model) {
//                    return count($model->storeOrderProducts);
//                }
//            ],
            'total_price',
            [
                'attribute' => 'status',
                'format' => 'orderStatus',
                'filter' => ['1'=>'New','2'=>'Accepted','3'=>'Delivered','4'=>'Picked Up','5'=>'Not Picked Up','6'=>'Returned'],
            ],
//            'paid',
            [
                'attribute' => 'paid',
                'format' => 'paid',
                'filter' => ['1'=>'Paid','2'=>'Not paid'],
            ],
            //'payment_time:datetime',
            //'payment_details:ntext',
            //'discount',
            //'coupon_discount',
            //'separate_delivery',
//            'name',
            //'street',
//            'phone',
//            'email:email',
            //'comment:ntext',
            //'ip',
            //'url:url',
            //'note:ntext',
            //'zipcode',
            //'country',
            //'city',
            //'house',
            //'apartment',
            [
                'attribute' => 'created_at',
                'value' => function($data) {
                    return date('d/m/Y',$data->created_at);
                }
            ],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
