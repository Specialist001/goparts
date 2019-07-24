<?php

use common\models\SellerQuery;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
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
    
    .product_imageboxes {
        width: 80px;
        padding-left: 0;
        cursor: pointer;
        display: inline-block;
    }
    .product_imageboxes li.d-none {
        display: none;
    }
    .product_imageboxes li img {
        width: 100%;
    }
');
?>
<div class="query-index">
    <div class="container pt-3">


        <div class="row">
            <div class="col-md-2">
                <?= $this->render('//user/_usermenu.php') ?>
            </div>
            <div class="col-md-10 pt-4">
                <div class="row">
                    <div class="col-md-12">

                        <h1 class="float-left"><?= Html::encode($this->title) ?></h1>

                        <p class="float-right">
                            <?= Html::a('Create Query', ['create'], ['class' => 'btn btn-success']) ?>
                        </p>
                    </div>
                </div>
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
                        <?php if (!empty($buyer_queries)) { ?>
                            <?php foreach ($buyer_queries as $buyer_query) { ?>
                                <form id="query_<?= $buyer_query->id ?>" method="POST" enctype="multipart/form-data">
                                    <!--                                <form id="seller-query_--><?//= $buyer_query->id ?><!--" action="--><?//= $buyer_query->product_id ? Url::to(['/user/product/edit','id'=>$buyer_query->product_id]) : Url::to(['/user/product/add']) ?><!--" method="POST" enctype="multipart/form-data">-->
                                    <input type="hidden" class="query_id" name="Query[id]"
                                           value="<?= $buyer_query->id ?>">

                                    <input type="hidden" class="car_id" name="Query[car_id]"
                                           value="<?= $buyer_query->car_id ?>">

                                    <div class="new_request p-3 border mb-3 d-inline-block w-100 <?= $buyer_query->sellerProducts ? 'green_request green_request_bg' : null ?>">
                                        <div class="rounded-circle border d-none d-md-inline-block float-left mt-4 text-white <?= $buyer_query->sellerProducts ? 'bg-form_style_1' : null ?>"
                                             style="width: 30px; height: 30px; font-size: 1.3rem">
                                            <i class="la la-check pl-1"></i>
                                        </div>
                                        <ul class="list-inline pl-0 pl-md-5 mb-4">

                                            <li class="list-inline-item d-none d-md-inline-block font-weight-bolder text-form-style_1"
                                                style="width: 80px"><?= $buyer_query->id ?>
                                            </li>
                                            <!--                                        <li class="list-inline-item pr-4" style="width: 130px">2019-05-09 09:30:57</li>-->
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="width: 110px"><?= date('d-m-Y H:m:i', $buyer_query->created_at) ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="min-width: 150px"><?= $buyer_query->vendor ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="min-width: 140px"><?= $buyer_query->car ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block"
                                                style="min-width: 100px"><?= $buyer_query->year ?></li>
                                            <li class="list-inline-item d-none d-md-inline-block" style="width: 10%">
                                                <ul class="query_imageboxes pl-0 d-inline-block">
                                                    <?php if($buyer_query->images) { ?>
                                                        <li class="query_imagebox">
                                                            <img src="<?= $buyer_query->firstImage->name ?>" class="img-fluid"
                                                                 alt="product">
                                                        </li>
                                                        <?php if($buyer_query->images) {
                                                            foreach ($buyer_query->images as $q_image) {
                                                                ?>
                                                                <li class="d-none">
                                                                    <img src="<?= $q_image->name ?>" class="img-fluid"
                                                                         alt="product">
                                                                </li>
                                                            <?php } } } ?>
                                                </ul>
                                            </li>
                                            <div class="d-inline-block d-md-none w-100">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-form-style_2">ID:</td>
                                                        <td class="pl-1"><?= $buyer_query->id ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Date:</td>
                                                        <td class="pl-1"><?= date('d-m-Y H:m:i', $buyer_query->created_at) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Make:</td>
                                                        <td class="pl-1"><?= $buyer_query->vendor ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Model:</td>
                                                        <td class="pl-1"><?= $buyer_query->car ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-form-style_2">Year:</td>
                                                        <td class="pl-1"><?= $buyer_query->year ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <li class="list-inline-item d-md-none" style="width: 30%">
                                                <ul class="query_imageboxes pl-0 d-inline-block">
                                                    <?php if($buyer_query->images) { ?>
                                                        <li class="query_imagebox">
                                                            <img src="<?= $buyer_query->firstImage->name ?>" class="img-fluid"
                                                                 alt="product">
                                                        </li>
                                                        <?php if($buyer_query->images) {
                                                            foreach ($buyer_query->images as $q_image) {
                                                                ?>
                                                                <li class="d-none">
                                                                    <img src="<?= $q_image->name ?>" class="img-fluid"
                                                                         alt="product">
                                                                </li>
                                                            <?php } } } ?>
                                                </ul>
                                            </li>
                                            <li class="list-inline-item float-right pt-2 pr-2"
                                                style="font-size: 2.5rem!important;">
                                                <a class="open_query" data-toggle="collapse"
                                                   href="#collapseExample_<?= $buyer_query->id ?>" role="button"
                                                   aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="la la-chevron-circle-down text-form-style_1"></i>
                                                </a>

                                            </li>
                                        </ul>
                                        <div class="collapse" id="collapseExample_<?= $buyer_query->id ?>">
                                            <div class="p-2 pt-3 border-top mt-5 mt-md-0">
                                                <div>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-3 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Generation
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $buyer_query->modification ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Transmission
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $buyer_query->transmission ? $buyer_query->transmission : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Engine CC
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $buyer_query->engine ? $buyer_query->engine : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Fuel type
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $buyer_query->fueltype ? $buyer_query->fueltype : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Drive type
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $buyer_query->drivetype ? $buyer_query->drivetype : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                    <!--                                                <ul class="d-inline-block pl-0 pr-3">-->
                                                    <!--                                                    <li class="pr-4 font-weight-bolder pb-md-4">Year</li>-->
                                                    <!--                                                    <li class="pr-4">-->
                                                    <? //= $buyer_query->year ? $buyer_query->year : '<span class="ml-5">-</span>'?><!--</li>-->
                                                    <!--                                                </ul>-->
                                                    <ul class="d-inline-block pl-0 pr-3">
                                                        <li class="pr-4 d-inline-block d-md-block font-weight-bolder pb-md-4">
                                                            Description
                                                        </li>
                                                        <li class="pr-4 d-inline-block d-md-block"><?= $buyer_query->description ? $buyer_query->description : '<span class="ml-5">-</span>' ?></li>
                                                    </ul>
                                                </div>
                                                <div class="w-100 mt-4"></div>
                                                <?php if ($buyer_query->sellerProducts) { ?>
                                                <h4>Products</h4>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <?php
                                                        foreach ($buyer_query->sellerProducts as $sellerQuery) { ?>
                                                            <div class="w-100 border rounded p-3 mb-2 <?= $sellerQuery->status==3 ? 'green_request' : null ?>">
                                                                <div class="d-block d-md-inline-block px-2 mr-3"><strong><?= $sellerQuery->product_id ?></strong></div>
                                                                <div class="d-block d-md-inline-block px-2 mr-3"><?= $sellerQuery->product->translate->name ?></div>
                                                                <div class="d-block d-md-inline-block px-2 mr-3"><strong><?= $sellerQuery->product->price * $commission ?> AED</strong></div>
                                                                <div class="d-block d-md-inline-block px-2 mr-3">
                                                                    <?php if ($sellerQuery->product->images) { ?>
                                                                    <ul class="product_imageboxes pl-0 d-inline-block">
                                                                        <li class="product_imagebox">
                                                                            <img src="<?= $sellerQuery->product->firstImage->link ?>" class="img-fluid" alt="product">
                                                                        </li>
                                                                        <?php foreach ($sellerQuery->product->images as $p_image) { ?>
                                                                            <li class="d-none">
                                                                                <img src="<?= $p_image->link ?>" class="img-fluid" alt="product">
                                                                            </li>
                                                                    <?php } ?>
                                                                    </ul>
                                                                    <?php } ?>
                                                                </div>
                                                                <?php if($sellerQuery->status != 3) { ?>
                                                                <div class="d-inline-block px-2 mr-3"><a target="_blank" href="<?= \yii\helpers\Url::to(['car/product', 'id'=>$sellerQuery->product_id]) ?>">View</a></div>
                                                                <?php }?>
                                                                <?php if($sellerQuery->status == 3) { ?>
                                                                <div class="d-inline-block px-2 mr-3">
                                                                    <h5 class="text-form-style_1">Purchased</h5>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                            <input type="hidden" class="product_id" name="Product[product_id]" value="<?= $sellerQuery->product_id ? $sellerQuery->product_id : null?>">
                                                        <?php }  ?>
                                                    </div>
                                                </div>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">
                                                        Not yet add products
                                                    </div>
                                                <?php } ?>

<!--                                                <div class="row pt-5 img_select">-->
<!--                                                    --><?php //if ($buyer_query->product_id && $buyer_query->product->images) { ?>
<!--                                                        <div class="col-12">-->
<!--                                                            <ul class="row request_imageboxes pl-2">-->
<!--                                                                --><?php //if ($buyer_query->product_id && $buyer_query->product->firstImage->link) { ?>
<!--                                                                    <li class="request_imagebox float-left p-1">-->
<!--                                                                        <img src="--><?//=$buyer_query->product->firstImage->link?><!--" class="img-fluid" style="cursor: -webkit-zoom-in; cursor: zoom-in;">-->
<!--                                                                    </li>-->
<!--                                                                --><?php //} ?>
<!--                                                                --><?php //if ($buyer_query->product_id && $buyer_query->product->images) { ?>
<!--                                                                    --><?php //foreach ($buyer_query->product->images as $image) { ?>
<!--                                                                        <li class="request_imagebox float-left p-1">-->
<!--                                                                            <img src="--><?//= $image->link?><!--" class="img-fluid" style="cursor: -webkit-zoom-in; cursor: zoom-in;">-->
<!--                                                                        </li>-->
<!--                                                                    --><?php //}
//                                                                } ?>
<!--                                                                -->
<!--                                                            </ul>-->
<!--                                                        </div>-->
<!--                                                    --><?php //} ?>
<!--                                                </div>-->


                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="_csrf-frontend"
                                           value="<?=Yii::$app->request->getCsrfToken()?>" />
                                </form>
                            <?php } ?>
                        <?php } else { echo 'NOT';} ?>
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
</div>
<?php $this->registerJs('
        var $query_images = $(\'.query_imageboxes\');
        var options = {
            url: \'data-original\' };
        $query_images.on({ready:  function (e) {
                console.log(e.type);
            }
        }).viewer(options);
        
        var $product_images = $(\'.product_imageboxes\');
        var options = {
            url: \'data-original\' };
        $product_images.on({ready:  function (e) {
                console.log(e.type);
            }
        }).viewer(options);
    ');
?>