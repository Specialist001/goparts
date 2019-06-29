<?php

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
?>
<div class="query-view">
    <div class="container">
<!--        <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
        <p>
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

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
//                        'user_id',
//                        'car_id',
                        'title',
                        [
                            'label' => 'Car',
                            'value' => function($model){
                                return $model->vendor.' '.$model->car.' '.$model->modification.' '.$model->year;
                            }
                        ],
                        [
                            'attribute' => 'category_id',
                            'label' => 'Category',
                            'value' => function($model) {
                                return $model->category->translate->title;
                            }
                        ],
//                        'vendor',
//                        'car',
//                        'year',
//                        'modification',
                        'fueltype',
                        'engine',
                        'transmission',
                        'drivetype',
//                        'name',
//                        'phone',
//                        'email:email',
                        [
                            'attribute'=>'image',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->image ?
                                '
                                <ul id="images">
                                    <li>
                                    <img src="'.$model->image.'" class="img-responsive" alt="query_'.$model->id.'">
                                    </li>
                                </ul>
                                '
                                    :
                                    null;
                            }
                        ],
//                        'status',
                        [
                            'attribute'=>'status',
                            'label' => 'Status',
                            'format' => 'query',
                        ],
//                        'created_at',
                        [
                            'attribute' => 'created_at',
                            'label' => 'Create Date',
                            'value' => function($model) {
                                return date('d.m.Y H:i', $model->created_at);
                            }
                        ],
                    ],
                ]) ?>
            </div>
        </div>
        <hr>

        <div class="sellers">
            <h4>Sellers</h4>
            <div class="row">
                <?php foreach ($sellers as $seller) {?>
                    <div class="seller-list">
                        <input class="sellers" type="checkbox" name="Seller[<?=$seller->user->id?>]"
                               value="<?= $seller->user->id ?>"
                               id="seller_<?= $seller->user->id?>" checked
                                <?php if(in_array($seller->user->id, $seller_query_array) && in_array($model->id, $seller_query_array)) $disabled = 'disabled'; else $disabled=''; echo $disabled  ?>
                        >
                        <label for="seller_<?= $seller->user->id?>"><?= $seller->user->username; ?>
                    </div>
                <?php } ?>
                <a class="seller-send btn btn-success <?php echo $disabled ?>" <?php echo $disabled ?>>Send</a>
                <p></p>
                <?php if($disabled!='') { ?>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="alert alert-warning" role="alert">
                                Data already send
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
<div class="data">
    <input type="hidden" class="query_id" name="query_id"  value="<?= $model->id?>">
<!--    <input type="hidden" name="seller_id" value="--><?//= $model->id?><!--">-->
</div>
<script>
    // $(document).ready(function () {
    //
    //     var query_id = 1;
    //     var seller_id = 1;
    //
    //     $('.seller-send').click(function () {
    //         $.ajax({
    //             type: "POST",
    //             url: "admin/query/seller-send",
    //             // data: {query_id: query_id, seller_id: seller_id, status: status
    //             data: {},
    //             success: function (response) {
    //                 console.log(response)
    //             }
    //         });
    //     });
    //
    // });
</script>

<?php $this->registerJs('
    $(document).ready(function () {

        var query_id = $(".query_id").val();
        var sellers = [];
        $(".sellers").each(function () {
            if($(this).is(":checked")) {
                sellers.push($(this).val());
            }
        });
        
        
         var disabled = $(\'.seller-send\').attr("disabled"); 

        $(\'.seller-send\').click(function () {
                $.ajax({
                    type: "POST",
                    url: "send-sellers",
                    data: {query_id: query_id, sellers: sellers, status: status},
                    success: function (data) {
                        console.log(data);
                        $(".sellers").prop(\'disabled\', true);
                        $(".seller-send").attr(\'disabled\', true);
                        $(\'.seller-send\').addClass(\'disabled\');
                        $.notify(data[\'status\'], "success");
                    },
                    error: function (data) {
                        $.notify("Data not send", "error");
                    }
                });
            
        });

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