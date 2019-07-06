<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Query */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Queries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$seller_queries = \common\models\SellerQuery::find()->all();
$seller_seller_array = [];
$seller_query_array = [];
foreach ($seller_queries as $seller_query) {
    $seller_seller_array += [$seller_query->seller_id => $seller_query->seller_id];
    $seller_query_array+= [$seller_query->query_id => $seller_query->query_id] ;
}
//echo '<pre>';
//print_r($seller_seller_array);
//echo '</pre>';
//echo '<pre>';
//print_r($seller_query_array);
//echo '</pre>';
//exit;
//$this->registerCssFile('/admin/css/viewer/viewer.min.css');
$this->registerCss('
    .query_imageboxes {
        width: 10%;
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
<div class="query-view">
    <div class="container">
<!--        <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
        <p>
            <?= Html::a(FA::i('chevron-left').' Back', ['/query'], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <div class="row">
            <div class="col-md-4">
                <h4>Contact info</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'phone',
                        'email:email',
                    ],
                ]) ?>


                <!--                <table class="table table-bordered">-->
                <!--                    <tbody>-->
                <!--                    <tr>-->
                <!--                        <td class="font-weight-bold">-->
                <!--                            Name-->
                <!--                        </td>-->
                <!--                        <td>-->
                <!--                            --><?//= $model->name ?>
                <!--                        </td>-->
                <!--                    </tr>-->
                <!--                    <tr>-->
                <!--                        <td class="font-weight-bold">-->
                <!--                            E-mail-->
                <!--                        </td>-->
                <!--                        <td>-->
                <!--                            --><?//= $model->email ?>
                <!--                        </td>-->
                <!--                    </tr>-->
                <!--                    <tr><i class="fa fa-crosshairs"></i>-->
                <!--                        <td class="font-weight-bold">-->
                <!--                            Phone-->
                <!--                        </td>-->
                <!--                        <td>-->
                <!--                            --><?//= $model->phone ? $model->phone : '-' ?>
                <!--                        </td>-->
                <!--                    </tr>-->
                <!--                    </tbody>-->
                <!--                </table>-->
            </div>
            <div class="col-md-8">
                <h4>Request info</h4>
                <!--                <table class="table table-bordered">-->
                <!--                    <tbody>-->
                <!--                        <tr>-->
                <!--                            <td class="font-weight-bold">Request #</td>-->
                <!--                            <td>--><?//= $model->id ?><!--</td>-->
                <!--                        </tr>-->
                <!--                        <tr>-->
                <!--                            <td class="font-weight-bold">Name</td>-->
                <!--                            <td>--><?//= $model->title ?><!--</td>-->
                <!--                        </tr>-->
                <!--                        <tr>-->
                <!--                            <td class="font-weight-bold">Car</td>-->
                <!--                            <td>--><?php //if(!$model->car_id){ ?>
                <!--                                    --><?//= $model->vendor.' '.$model->car.' '.$model->modification.' '.$model->year ?>
                <!--                                --><?php //} else {?>
                <!--                                    --><?//= \common\models\Cars::getCarName($model->car_id) ?>
                <!--                                --><?php //}?>
                <!--                            </td>-->
                <!--                        </tr>-->
                <!--                        --><?php //if($model->fueltype) { ?>
                <!--                        <tr>-->
                <!--                            <td class="font-weight-bold">-->
                <!--                                Fueltype-->
                <!--                            </td>-->
                <!--                            <td>-->
                <!--                                --><?//= $model->fueltype ?>
                <!--                            </td>-->
                <!--                        </tr>-->
                <!--                        --><?php //}?>
                <!--                        --><?php //if($model->engine) { ?>
                <!--                            <tr>-->
                <!--                                <td class="font-weight-bold">-->
                <!--                                    Engine-->
                <!--                                </td>-->
                <!--                                <td>-->
                <!--                                    --><?//= $model->engine ?>
                <!--                                </td>-->
                <!--                            </tr>-->
                <!--                        --><?php //}?>
                <!--                        --><?php //if($model->transmission) { ?>
                <!--                            <tr>-->
                <!--                                <td class="font-weight-bold">-->
                <!--                                    Transmission-->
                <!--                                </td>-->
                <!--                                <td>-->
                <!--                                    --><?//= $model->transmission ?>
                <!--                                </td>-->
                <!--                            </tr>-->
                <!--                        --><?php //}?>
                <!--                        --><?php //if($model->drivetype) { ?>
                <!--                            <tr>-->
                <!--                                <td class="font-weight-bold">-->
                <!--                                    Drivetype-->
                <!--                                </td>-->
                <!--                                <td>-->
                <!--                                    --><?//= $model->drivetype ?>
                <!--                                </td>-->
                <!--                            </tr>-->
                <!--                        --><?php //}?>
                <!--                    </tbody>-->
                <!--                </table>-->

<!--                --><?//= DetailView::widget([
//                    'model' => $model,
//                    'attributes' => [
//                        'id',
////                        'user_id',
////                        'car_id',
//                        'title',
//                        [
//                            'label' => 'Car',
//                            'value' => function($model){
//                                return $model->vendor.' '.$model->car.' '.$model->modification.' '.$model->year;
//                            }
//                        ],
//                        [
//                            'attribute' => 'category_id',
//                            'label' => 'Category',
//                            'value' => function($model) {
//                                return $model->category->translate->title;
//                            }
//                        ],
////                        'vendor',
////                        'car',
////                        'year',
////                        'modification',
//                        'fueltype',
//                        'engine',
//                        'transmission',
//                        'drivetype',
////                        'name',
////                        'phone',
////                        'email:email',
//                        [
//                            'attribute'=>'image',
//                            'format' => 'raw',
//                            'value' => function ($model) {
//                                return $model->image ?
//                                '
//                                <ul id="images">
//                                    <li>
//                                    <img src="'.$model->image.'" class="img-responsive" alt="query_'.$model->id.'">
//                                    </li>
//                                </ul>
//                                '
//                                    :
//                                    null;
//                            }
//                        ],
////                        'status',
//                        [
//                            'attribute'=>'status',
//                            'label' => 'Status',
//                            'format' => 'query',
//                        ],
////                        'created_at',
//                        [
//                            'attribute' => 'created_at',
//                            'label' => 'Create Date',
//                            'value' => function($model) {
//                                return date('d.m.Y H:i', $model->created_at);
//                            }
//                        ],
//                    ],
//                ]) ?>

                <table class="table table-striped table-bordered detail-view">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td><?= $model->id?></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><?= $model->description?></td>
                    </tr>
                    <tr>
                        <th>Car</th>
                        <td><?= $model->vendor.' '.$model->car.' '.$model->modification.' '.$model->year ?></td>
                    </tr>
                    <tr>
                        <th>Fuel type</th>
                        <td><?= $model->fueltype ? $model->fueltype : '-' ?></td>
                    </tr>
                    <tr>
                        <th>Engine CC</th>
                        <td><?= $model->engine ? $model->engine : '-' ?></td>
                    </tr>
                    <tr>
                        <th>Transmission</th>
                        <td><?= $model->transmission ? $model->transmission : '-' ?></td>
                    </tr>
                    <tr>
                        <th>Drive type</th>
                        <td><?= $model->drivetype ? $model->drivetype : '-' ?></td>
                    </tr>
                    <tr>
                        <th>Product Images</th>
                        <td>
                            <?php if($model->images) {?>
                            <ul class="query_imageboxes pl-0 d-inline-block">
                                <li class="query_imagebox">
                                    <img src="<?= $model->firstImage->name ?>" class="img-fluid" alt="product">
                                </li>
                                <?php foreach ($model->images as $p_image) { ?>
                                    <li class="d-none">
                                        <img src="<?= $p_image->name ?>" class="img-fluid" alt="product">
                                    </li>
                                <?php } ?>

                                <?php } else { ?>
                                    (Not set)
                                <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Status
                        </th>
                        <td>
                            <?php $formatter = new \common\components\MyFormatter();
                                echo $formatter->asQuery($model->status);

                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Created Date</th>
                        <td><?= date('d/m/Y H:m', $model->created_at)?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>

    </div>
</div>
<div class="data">
    <input type="hidden" class="query_id" name="query_id"  value="<?= $model->id?>">
<!--    <input type="hidden" name="seller_id" value="--><?//= $model->id?><!--">-->
</div>

<?php $this->registerJs('
    $(document).ready(function () {

//        var query_id = $(".query_id").val();
//        var sellers = [];
//        $(".sellers").each(function () {
//            if($(this).is(":checked")) {
//                sellers.push($(this).val());
//            }
//        });
//        
//        
//         var disabled = $(\'.seller-send\').attr("disabled"); 
//
//        $(\'.seller-send\').click(function () {
//                $.ajax({
//                    type: "POST",
//                    url: "send-sellers",
//                    data: {query_id: query_id, sellers: sellers, status: status},
//                    success: function (data) {
//                        console.log(data);
//                        $(".sellers").prop(\'disabled\', true);
//                        $(".seller-send").attr(\'disabled\', true);
//                        $(\'.seller-send\').addClass(\'disabled\');
//                        $.notify(data[\'status\'], "success");
//                    },
//                    error: function (data) {
//                        $.notify("Data not send", "error");
//                    }
//                });
//            
//        });

    });
'); ?>

<?php
//$this->registerJsFile('/admin/js/viewer/viewer.js');
//$this->registerJsFile('/admin/js/jquery-viewer/jquery-viewer.js');

?>

<?php $this->registerJs('
    var $image = $(\'#image\');

    $image.viewer({
        inline: true,
        viewed: function() {
            $image.viewer(\'zoomTo\', 1);
        }
    });
    
    // Get the Viewer.js instance after initialized
    var viewer = $image.data(\'viewer\');

    // View a list of images
    $(\'#images\').viewer();
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
