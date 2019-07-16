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

$this->title = 'Purchased Products';
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
    ul.pagination li.prev.disabled,
    ul.pagination li.next.disabled {
    padding: 0;
}
');
?>
    <div class="seller-query-index mh-100">
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-2">
                <?= $this->render('//user/_usermenu.php') ?>
            </div>
            <div class="col-md-10 pt-4">
                <h2 class="">Purchased Poducts</h2>
                <div class="w-100 d-inline-block pt-4">
                    <div class="table_header">
                        <ul class="font-weight-bolder list-inline pl-5 d-none d-md-inline-block">
                            <li class="list-inline-item pl-3 pr-5 text-form-style_1">ID</li>
                            <li class="list-inline-item pl-3" style="width: 110px">Date</li>
                            <li class="list-inline-item pl-3" style="min-width: 150px">Make</li>
                            <li class="list-inline-item pl-3" style="min-width: 140px">Model</li>
                            <li class="list-inline-item pl-3" style="min-width: 100px">Year</li>

                        </ul>
                    </div>
                    <div class="new_requests">
                        <?php if (!empty($purchased_products)) { ?>
                            <?php foreach ($purchased_products as $purchased_product) { ?>
                                <!--                                <form id="seller-query_--><? //= $purchased_product->product_id ?><!--" method="POST" enctype="multipart/form-data">-->
                                <!--                                <form id="seller-query_--><? //= $purchased_product->id ?><!--" action="--><? //= $purchased_product->product_id ? Url::to(['/user/product/edit','id'=>$purchased_product->product_id]) : Url::to(['/user/product/add']) ?><!--" method="POST" enctype="multipart/form-data">-->
                                <div>
                                    <input type="hidden" class="seller_query_id" name="SellerQuery[id]"
                                           value="<?= $purchased_product->id ?>">
                                    <input type="hidden" class="query_id" name="SellerQuery[query_id]"
                                           value="<?= $purchased_product->query_id ?>">
                                    <input type="hidden" class="car_id" name="SellerQuery[car_id]"
                                           value="<?= $purchased_product->query->car_id ?>">

                                    <div class="new_request p-3 border mb-3 d-inline-block w-100 <?= $purchased_product->product_id ? 'green_request' : null ?>">
                                        <div class="rounded-circle border d-none d-md-inline-block float-left mt-4 text-white <?= $purchased_product->product_id ? 'bg-form_style_1' : null ?> "
                                             style="width: 30px; height: 30px; font-size: 1.3rem">
                                            <i class="la la-check pl-1"></i>
                                        </div>
                                        <ul class="list-inline pl-0 pl-md-5 mb-4">

                                            <li class="list-inline-item d-none d-md-inline-block font-weight-bolder text-form-style_1"
                                                style="width: 80px"><?= $purchased_product->product_id ?>
                                            </li>
                                            <!--                                        <li class="list-inline-item pr-4" style="width: 130px">2019-05-09 09:30:57</li>-->
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="width: 110px"><?= date('d-m-Y H:m:i', $purchased_product->product->updated_at) ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="min-width: 150px"><?= $purchased_product->query->vendor ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="min-width: 140px"><?= $purchased_product->query->car ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="min-width: 100px"><?= $purchased_product->query->year ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block" style="width: 10%">
                                                <ul class="query_imageboxes pl-0 d-inline-block">
                                                    <?php if ($purchased_product->product->images) { ?>
                                                        <li class="query_imagebox">
                                                            <img src="<?= $purchased_product->product->firstImage->link ?>"
                                                                 class="img-fluid"
                                                                 alt="product">
                                                        </li>
                                                        <?php if ($purchased_product->product->images) {
                                                            foreach ($purchased_product->product->images as $q_image) {
                                                                ?>
                                                                <li class="d-none">
                                                                    <img src="<?= $q_image->link ?>" class="img-fluid"
                                                                         alt="product">
                                                                </li>
                                                            <?php }
                                                        }
                                                    } ?>
                                                </ul>
                                            </li>
                                            <div class="d-inline-block d-md-none w-100">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-form-style_2">ID:</td>
                                                        <td class="pl-1"><?= $purchased_product->product_id ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Date:</td>
                                                        <td class="pl-1"><?= date('d-m-Y H:m:i', $purchased_product->product->updated_at) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Make:</td>
                                                        <td class="pl-1"><?= $purchased_product->query->vendor ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Model:</td>
                                                        <td class="pl-1"><?= $purchased_product->query->car ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Year:</td>
                                                        <td class="pl-1"><?= $purchased_product->query->year ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <li class="list-inline-item d-md-none" style="width: 30%">
                                                <ul class="query_imageboxes pl-0 d-inline-block">
                                                    <?php if ($purchased_product->product->images) { ?>
                                                        <li class="query_imagebox">
                                                            <img src="<?= $purchased_product->product->firstImage->link ?>"
                                                                 class="img-fluid"
                                                                 alt="product">
                                                        </li>
                                                        <?php if ($purchased_product->product->images) {
                                                            foreach ($purchased_product->product->images as $q_image) {
                                                                ?>
                                                                <li class="d-none">
                                                                    <img src="<?= $q_image->link ?>" class="img-fluid"
                                                                         alt="product">
                                                                </li>
                                                            <?php }
                                                        }
                                                    } ?>
                                                </ul>
                                            </li>
                                            <li class="list-inline-item float-right pt-2 pr-2"
                                                style="font-size: 2.5rem!important;">
                                                <a class="open_query" data-toggle="collapse"
                                                   href="#collapseExample_<?= $purchased_product->product_id ?>" role="button"
                                                   aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="la la-chevron-circle-down text-form-style_1"></i>
                                                </a>

                                            </li>
                                        </ul>
                                        <div class="collapse" id="collapseExample_<?= $purchased_product->product_id ?>">
                                            <div class="p-2 pt-3 border-top mt-5 mt-md-0">
                                                <div>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-3 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Generation
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $purchased_product->query->modification ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Transmission
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $purchased_product->query->transmission ? $purchased_product->query->transmission : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Engine CC
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $purchased_product->query->engine ? $purchased_product->query->engine : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Fuel type
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $purchased_product->query->fueltype ? $purchased_product->query->fueltype : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Drive type
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $purchased_product->query->drivetype ? $purchased_product->query->drivetype : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                <div class="row pt-2">
                                                    <div class="col-12 col-md-3">
                                                        <div>
                                                            <i class="la la-exclamation-circle"></i>
                                                            <span class="pl-1 pb-2 font-weight-bolder">Description</span>
                                                        </div>
                                                    </div>
                                                    <div class="col pr-5">
                                                    <textarea
                                                            class="border font-weight-lighter w-100 p-2 mr-3 <?= $purchased_product->product->translate->description ? 'bg-light' : null ?>"
                                                            name="Product[description]"
                                                            style="resize: none" <?= $purchased_product->product->translate->description ? 'readonly' : null ?> ><?= $purchased_product->product->translate->description ? $purchased_product->product->translate->description : null ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row pt-3">

                                                    <div class="col-12 col-md-6 pt-2 pt-md-0">
                                                        <div class="border font-weight-bold d-inline-block p-2 px-4">
                                                            <div class="pb-2">
                                                                My Price
                                                            </div>
                                                            <div class="text-form-style_1 my_price">
<!--                                                                <input class="w-25 border-0 font-weight-bold text-form-style_1 readonly"-->
<!--                                                                       name="Product[price]" type="number"-->
<!--                                                                       value="--><?//= $purchased_product->product->price ? $purchased_product->product->price : 0 ?><!--"-->
<!--                                                                       min="0" required> -->
                                                            <span><?= $purchased_product->product->price ?></span> AED
                                                                <!-- <span class="text-dark ml-2 edit_price" style="cursor:pointer;"><i class="la la-pencil" style="font-size: 1.3rem"></i> </span>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="product_id" name="Product[product_id]"
                                           value="<?= $purchased_product->product_id ? $purchased_product->product_id : null ?>">
                                    <input type="hidden" name="_csrf-frontend"
                                           value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                                </div>
                                <!--                                </form>-->
                            <?php } ?>
                        <?php } else { ?>
                            <div class="alert alert-warning">
                            There are no purchased products
                            </div>
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
    
    var $query_images = $(\'.query_imageboxes\');
    var options = {
        url: \'data-original\' };
    $query_images.on({ready:  function (e) {
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