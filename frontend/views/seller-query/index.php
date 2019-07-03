<?php

use common\models\SellerQuery;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SellerQuerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'New Requests';
$this->params['breadcrumbs'][] = $this->title;

//print_r($dataProvider);
$this->registerCss('
    input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button
    {
        -webkit-appearance: none;
        margin: 0;
    }
 
    input[type="number"]
    {
        -moz-appearance: textfield;
    }
');
?>
    <div class="seller-query-index mh-100">
    <div class="container pt-3">
        <!--        <div class="row">-->
        <!--            <div class="col-md-2">-->
        <!--                --><? //= $this->render('//user/_usermenu.php') ?>
        <!--            </div>-->
        <!--            <div class="col-md-9">-->
        <!---->
        <!--                <h4>--><? //= Html::encode($this->title) ?><!--</h4>-->
        <!---->
        <!---->
        <!--                --><?php //Pjax::begin(); ?>
        <!--                --><?php //// echo $this->render('_search', ['model' => $searchModel]); ?>
        <!---->
        <!--                --><? //= GridView::widget([
        //                    'dataProvider' => $dataProvider,
        //                    'filterModel' => $searchModel,
        //                    'columns' => [
        //                        ['class' => 'yii\grid\SerialColumn'],
        ////                        [
        ////                            'attribute'=>'id',
        ////                            'headerOptions' => ['style' => 'width:80px'],
        ////                        ],
        //                        [
        //                            'attribute' => 'query_id',
        //                            'headerOptions' => ['style' => 'width:100px'],
        //                        ],
        //                        [
        //                            'label' => 'Name',
        //                            'format' => 'raw',
        //                            'headerOptions' => ['style' => 'width:100px'],
        //                            'value' => function ($model) {
        //                                return "<a href=" . Url::to(['user/request', 'id' => $model->id]) . ">" . $model->query->title . "</a>";
        //                            }
        //                        ],
        //                        [
        //                            'label' => 'Car',
        //                            'value' => function ($model) {
        //                                return $model->query->vendor . ' ' . $model->query->car;
        //                            }
        //                        ],
        //                        [
        //                            'label' => 'Category',
        //                            'value' => function ($model) {
        //                                return $model->query->category->translate->title;
        //                            }
        //                        ],
        ////                        'seller_id',
        //                        [
        //                            'attribute' => 'product_id',
        //                            'headerOptions' => ['style' => 'width:110px'],
        //                        ],
        //                        [
        //                            'attribute' => 'status',
        //                            'format' => 'sellerQuery',
        //                            'filter' => ['0' => 'Waited', '1' => 'Published', '2' => 'Purchased']
        //                        ],
        //                        [
        //                            'label' => 'Action',
        //                            'format' => 'raw',
        //                            'value' => function ($model) {
        ////                                return Url::to(['user/product/create', 'car_id'=>$model->query->car_id, 'category'=>$model->query->category_id]);
        //                                return $model->status == 0
        //                                    ? Html::a('Create Product', Url::to(['user/product/create', 'query_id' => $model->query->id, 'car_id' => $model->query->car_id, 'category' => $model->query->category_id]))
        //                                    : Html::a('Update Product', Url::to(['user/product/update', 'id' => $model->product_id]));
        //                            }
        //                        ],
        //                        //'created_at',
        //                        //'updated_at',
        //
        //                        ['class' => 'yii\grid\ActionColumn'],
        //                    ],
        //                ]); ?>
        <!---->
        <!--                --><?php //Pjax::end(); ?>
        <!--            </div>-->
        <!---->
        <!--        </div>-->
        <div class="row">
            <div class="col-md-2">
                <?= $this->render('//user/_usermenu.php') ?>
            </div>
            <div class="col-md-10 pt-4">
                <h2 class="">New Requests</h2>
                <div class="w-100 d-inline-block pt-4">
                    <div class="table_header">
                        <ul class="font-weight-bolder list-inline pl-5 d-none d-md-inline-block">
                            <li class="list-inline-item pl-3 pr-5 text-form-style_1">ID</li>
                            <li class="list-inline-item pl-3" style="width: 100px">Date</li>
                            <li class="list-inline-item pl-3" style="min-width: 150px">Make</li>
                            <li class="list-inline-item pl-3" style="min-width: 140px">Model</li>
                            <li class="list-inline-item pl-3" style="min-width: 100px">Year</li>

                        </ul>
                    </div>
                    <div class="new_requests">
                        <?php if (!empty($seller_queries)) { ?>
                            <?php foreach ($seller_queries as $seller_query) { ?>
                                <form id="seller-query_<?= $seller_query->id ?>" enctype="multipart/form-data">
                                    <input type="hidden" class="seller_query_id" name="SellerQuery[id]"
                                           value="<?= $seller_query->id ?>">
                                    <input type="hidden" class="query_id" name="SellerQuery[query_id]"
                                           value="<?= $seller_query->query_id ?>">
                                    <input type="hidden" class="car_id" name="SellerQuery[car_id]"
                                           value="<?= $seller_query->query->car_id ?>">

                                    <div class="new_request p-3 border mb-3 d-inline-block w-100 <?=$seller_query->product_id ? 'green_request' : null ?>">
                                        <div class="rounded-circle border d-none d-md-inline-block float-left mt-4 text-white <?= $seller_query->product_id ? 'bg-form_style_1' : null ?> "
                                             style="width: 30px; height: 30px; font-size: 1.3rem">
                                            <i class="la la-check pl-1"></i>
                                        </div>
                                        <ul class="list-inline pl-0 pl-md-5 mb-0">

                                            <li class="list-inline-item d-none d-md-inline-block font-weight-bolder text-form-style_1"
                                                style="width: 80px"><?= $seller_query->id ?>
                                            </li>
                                            <!--                                        <li class="list-inline-item pr-4" style="width: 130px">2019-05-09 09:30:57</li>-->
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="width: 100px"><?= date('d-m-Y H:m:i', $seller_query->created_at) ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="min-width: 150px"><?= $seller_query->query->vendor ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="min-width: 140px"><?= $seller_query->query->car ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="min-width: 100px"><?= $seller_query->query->year ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block" style="width: 10%">
                                                <img src="<?= $seller_query->query->mainImage->name ?>" class="img-fluid"
                                                     alt="product">
                                            </li>
                                            <div class="d-inline-block d-md-none w-100">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-form-style_2">ID:</td>
                                                        <td class="pl-1"><?= $seller_query->id ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Date:</td>
                                                        <td class="pl-1"><?= date('d-m-Y H:m:i', $seller_query->created_at) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Make:</td>
                                                        <td class="pl-1"><?= $seller_query->query->vendor ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Model:</td>
                                                        <td class="pl-1"><?= $seller_query->query->car ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Year:</td>
                                                        <td class="pl-1"><?= $seller_query->query->year ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <li class="list-inline-item d-md-none" style="width: 30%">
                                                <img src="<?= $seller_query->query->image ?>" class="img-fluid"
                                                     alt="product">
                                            </li>
                                            <li class="list-inline-item float-right pt-2 pr-2"
                                                style="font-size: 2.5rem!important;">
                                                <a class="open_query" data-toggle="collapse"
                                                   href="#collapseExample_<?= $seller_query->id ?>" role="button"
                                                   aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="la la-chevron-circle-down text-form-style_1"></i>
                                                </a>

                                            </li>
                                        </ul>
                                        <div class="collapse" id="collapseExample_<?= $seller_query->id ?>">
                                            <div class="p-2 pt-3 border-top mt-5 mt-md-0">
                                                <div>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-3 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Generation
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $seller_query->query->modification ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Transmission
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $seller_query->query->transmission ? $seller_query->query->transmission : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Engine CC
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $seller_query->query->engine ? $seller_query->query->engine : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Fuel type
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $seller_query->query->fueltype ? $seller_query->query->fueltype : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Drive type
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $seller_query->query->drivetype ? $seller_query->query->drivetype : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                    <!--                                                <ul class="d-inline-block pl-0 pr-3">-->
                                                    <!--                                                    <li class="pr-4 font-weight-bolder pb-md-4">Year</li>-->
                                                    <!--                                                    <li class="pr-4">-->
                                                    <? //= $seller_query->query->year ? $seller_query->query->year : '<span class="ml-5">-</span>'?><!--</li>-->
                                                    <!--                                                </ul>-->
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Description
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $seller_query->query->description ? $seller_query->query->description : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                </div>
                                                <div class="row pt-2">
                                                    <div class="col-12 col-md-3">
                                                        <div>
                                                            <i class="la la-exclamation-circle"></i>
                                                            <span class="pl-1 pb-2 font-weight-bolder">Description</span>
                                                        </div>
                                                        <?php if(!$seller_query->product->translate->description) { ?>
                                                        <div class="pl-4 font-weight-lighter">
                                                            Write a description
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col pr-5">
                                                    <textarea class="border font-weight-lighter w-100 p-2 mr-3 <?=$seller_query->product->translate->description ? 'bg-light' : null ?>" name="Product[description]"
                                                              style="resize: none" <?= $seller_query->product->translate->description ? 'readonly' : null?> ><?= $seller_query->product->translate->description ? $seller_query->product->translate->description : null ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row pt-3">
                                                    <div class="col-12 col-md-6">
                                                        <span class="font-weight-bolder d-inline-block pb-3">Competitor prices</span>
                                                        <div class="row competitor_prices">
                                                            <?php if ($seller_query->query_id) {
                                                                $get_prices = SellerQuery::find()->where(['query_id' => $seller_query->query_id])->andWhere(['not', ['product_id' => null]])->all();
                                                                $price_array = [];
                                                                foreach ($get_prices as $get_price) {
                                                                    $price_array[] += $get_price->productPrice->price;
                                                                }
                                                                sort($price_array);
                                                                $arrlength = count($price_array);
                                                                if ($arrlength > 3) $counter = 3;
                                                                else $counter = $arrlength;
                                                                ?>
                                                                <?php if ($counter > 0) { ?>
                                                                    <?php for ($x = 0; $x < $counter; $x++) { ?>
                                                                        <div class="col-12 col-md-4 font-weight-light all_prices competitor_price_<?=$x + 1?>">
                                                                            <?= $x + 1; ?>) <span
                                                                                    class="text-form-style_1"><?= $price_array[$x] ?> AED</span>
                                                                        </div>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <div class="col-12 col-md-10 font-weight-light no_prices">
                                                                        <span class="text-form-style_1">There are no competitive prices yet</span>
                                                                    </div>
                                                                <?php } ?>
                                                                <!--                                                        <div class="col-12 col-md-4 font-weight-light">-->
                                                                <!--                                                            2) <span class="text-form-style_1">440 AED</span>-->
                                                                <!--                                                        </div>-->
                                                                <!--                                                        <div class="col-12 col-md-4 font-weight-light">-->
                                                                <!--                                                            3) <span class="text-form-style_1">440 AED</span>-->
                                                                <!--                                                        </div>-->
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 pt-2 pt-md-0">
                                                        <div class="border font-weight-bold d-inline-block p-2 px-4">
                                                            <div class="pb-2">
                                                                My Price
                                                            </div>
                                                            <div class="text-form-style_1 my_price">
                                                                <input class="w-25 border-0 font-weight-bold text-form-style_1 readonly"
                                                                       name="Product[price]" type="number" value="<?= $seller_query->product->price ? $seller_query->product->price : 0?>" min="0" required> AED
                                                                <!-- <span class="text-dark ml-2 edit_price" style="cursor:pointer;"><i class="la la-pencil" style="font-size: 1.3rem"></i> </span>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($seller_query->product_id && $seller_query->product->mainImage->link) { ?>
                                                <div class="row pt-5">
                                                    <div class="col-12">
                                                        <ul class="row request_imageboxes">
                                                            <?php if ($seller_query->product_id && $seller_query->product->mainImage->link) { ?>
                                                            <li class="request_imagebox float-left p-1">
                                                                <img src="<?=$seller_query->product->mainImage->link?>" class="img-fluid" style="cursor: -webkit-zoom-in; cursor: zoom-in;">
                                                            </li>
                                                            <?php } ?>
                                                             <?php if ($seller_query->product_id && $seller_query->product->images) { ?>
                                                                 <?php foreach ($seller_query->product->images as $image) { ?>
                                                                 <li class="request_imagebox float-left p-1">
                                                                     <img src="<?= $image->link?>" class="img-fluid" style="cursor: -webkit-zoom-in; cursor: zoom-in;">
                                                                 </li>
                                                             <?php }
                                                                } ?>
<!--                                                            <div class="col">-->
<!--                                                                <div class="request_imagebox">-->
<!--                                                                    <input type="file" name="Product[image][0]" class="d-none" style="visibility: hidden">-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                            <div class="col">-->
<!--                                                                <div class="request_imagebox">-->
<!--                                                                    <input type="file" name="Product[image][1]" class="d-none" style="visibility: hidden">-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                            <div class="col">-->
<!--                                                                <div class="request_imagebox">-->
<!--                                                                    <input type="file" name="Product[image][2]" class="d-none" style="visibility: hidden">-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                            <div class="col">-->
<!--                                                                <div class="request_imagebox">-->
<!--                                                                    <input type="file" name="Product[image][3]" class="d-none" style="visibility: hidden">-->
<!--                                                                </div>-->
<!--                                                            </div>-->

                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <div class="row pt-5">
                                                    <div class="col-12 pl-0 pl-md-1 text-md-right">
<!--                                                        <div class="row">-->
<!--                                                            <div class="col-12 col-md-5 text-center">-->
                                                                <a class="add_images py-2 mx-3 text-form-style_2 font-weight-bold <?= !$seller_query->product_id ? 'd-none' : 'd-inline-block'  ?>" href="<?= Url::to(['product/update', 'id' => $seller_query->product_id]) ?>">Add Image</a>
                                                                <a
                                                                   class="mx-3 <?= !$seller_query->product_id ? 'send_request' : 'update_request'?>  d-inline-block py-2 text-form-style_1 font-weight-bold"
                                                                   style="width: 130px"
                                                                    data-seller_query_id = "<?= $seller_query->id ?>"

                                                                >
                                                                    <?= !$seller_query->product_id ? 'Send request' : 'Update request'?>
                                                                </a>
<!--                                                            </div>-->
<!--                                                            <div class="col-12 col-md-7 text-center">-->
                                                                <a class="delete_order mx-3 btn btn-outline-danger"
                                                                   style="border-radius: 20px">Remove order <i
                                                                            class="la la-times-circle"></i> </a>
<!--                                                            </div>-->
<!--                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="product_id" name="Product[product_id]" value="<?= $seller_query->product_id ? $seller_query->product_id : null?>">
                                    <input type="hidden" name="_csrf-frontend"
                                           value="<?=Yii::$app->request->getCsrfToken()?>" />
                                </form>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-12">
                        <div class="text-right float-right">
                            <?php echo LinkPager::widget([
                                'pagination' => $pages,
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->registerJs('
    jQuery(document).ready( function($) {
    
//    $(\'.request_imagebox\').click(function () {
//        $(this).children().click();
//    });
    
    $(\'.open_query\').on(\'click\', function () {
        if ($(this).children(\'i\').hasClass(\'la-chevron-circle-down\')) {
            $(this).children(\'i\').removeClass(\'la-chevron-circle-down\').addClass(\'la-chevron-circle-up\');
        } else {
            $(this).children(\'i\').removeClass(\'la-chevron-circle-up\').addClass(\'la-chevron-circle-down\');
        }        
    });   
    
    var $images = $(\'.request_imageboxes\');
    var options = {
        url: \'data-original\' };
    $images.on({ready:  function (e) {
            console.log(e.type);
        }
    }).viewer(options);
    
//    $images.viewer({
//        inline: true,
//        viewed: function() {
//            $images.viewer(\'zoomTo\', 1);
//        }
//    });

    // Get the Viewer.js instance after initialized
//    var viewer = $images.data(\'viewer\');

    // View a list of images
//    $images.viewer();
    
    
//        $(\'.edit_price\').click(function () {
//            var parent = $(this).parent();
//            parent.children(\'input\').toggleClass(\'readonly\');
//            var attr = parent.children(\'input\').attr(\'readonly\');
//            
////            if (parent.children(\'input\').is(\'[readonly="true"]\')) {
////                parent.children(\'input\').attr(\'readonly\',\'false\');
////            } else {
////                parent.children(\'input\').attr(\'readonly\',\'true\');
////            }
//            if (typeof attr !== typeof undefined && attr !== false) {
//                 parent.children(\'input\').removeAttr(\'readonly\');
//            } else {
//                parent.children(\'input\').attr(\'readonly\',\'true\');
//            }
//        });
        
//        $(\'.my_price input\').focus(function () {
////            console.log(null);
//            var attr = $(this).attr(\'readonly\');
//            $(this).toggleClass(\'readonly\');
//            if (typeof attr !== typeof undefined && attr !== false) {
//                $(this).removeAttr(\'readonly\');
//            } else {
//                $(this).attr(\'readonly\',\'true\');
//            }
//        });
 
//    // Disable scroll when focused on a number input.
//    $(\'form\').on(\'focus\', \'input[type=number]\', function(e) {
//        $(this).on(\'wheel\', function(e) {
//            e.preventDefault();
//        });
//    });
// 
//    // Restore scroll on number inputs.
//    $(\'form\').on(\'blur\', \'input[type=number]\', function(e) {
//        $(this).off(\'wheel\');
//    });
// 
//    // Disable up and down keys.
//    $(\'form\').on(\'keydown\', \'input[type=number]\', function(e) {
//        if ( e.which == 38 || e.which == 40 )
//            e.preventDefault();
//    });     
});


    

'); ?>