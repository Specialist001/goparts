<?php
/* @var $this yii\web\View */

$this->title = Yii::$app->params['appName'];

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url; ?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="info-box">
                <a href="<?= Url::to(['/query', 'QuerySearch[status]'=>0,'sort'=>'-id']) ?>" class="small-box-footer">
                <span class="info-box-icon bg-purple">
                    <i class="la la-edit"></i>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">New Queries</span>
                    <span class="info-box-number">
                        <?= $counter['query_count'] ?> <small></small>
                    </span>
                </div>
                <!--                <div class="inner">-->
                <!--                    <h3>--><? //= $counter['query_count'] ?><!--</h3>-->
                <!--                    <p>New Queries</p>-->
                <!--                </div>-->
                <!--                <div class="icon">-->
                <!--                    <i class="ion ion-bag"></i>-->
                <!--                </div>-->
                <!--                <a href="-->
                <? //= \yii\helpers\Url::to(['/query']) ?><!--" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="info-box">
                <a href="<?= Url::to(['/seller-query', 'SellerQuerySearch[status]'=>1,'sort'=>'-id']) ?>" class="small-box-footer">
                <span class="info-box-icon bg-green">
                    <i class="la la-list-ul"></i>
                    <!--                    --><?//= FA::i('facebook') ?>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">New Requests</span>
                    <span class="info-box-number">
                        <?= $counter['request_count'] ?> <small></small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <!--            <div class="small-box bg-aqua">-->
            <!--                <div class="inner">-->
            <!--                    <h3>--><? //= $counter['order_count'] ?><!--</h3>-->
            <!--                    <p>New Orders</p>-->
            <!--                </div>-->
            <!--                <div class="icon">-->
            <!--                    <i class="ion ion-bag"></i>-->
            <!--                </div>-->
            <!--                <a href="-->
            <? //= \yii\helpers\Url::to(['/store-order']) ?><!--" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
            <!--            </div>-->

            <div class="info-box">
                <a href="<?= Url::to(['/store-order', 'StoreOrderSearch[status]'=>1,'sort'=>'-id']) ?>" class="small-box-footer">
                <span class="info-box-icon bg-aqua">
                    <i class="la la-cart-arrow-down"></i>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">New Orders</span>
                    <span class="info-box-number">
                        <?= $counter['order_count'] ?> <small></small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="info-box">
                <a href="<?= Url::to(['/user','UserSearch[role]'=>1,'UserSearch[status]'=>9]) ?>" class="small-box-footer">
                <span class="info-box-icon bg-yellow">
                    <i class="la la-briefcase"></i>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">New Sellers</span>
                    <span class="info-box-number">
                        <?= $counter['new_sellers'] ?> <small></small>
                    </span>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="info-box">
                <a href="<?= Url::to(['/user','UserSearch[role]'=>0,'UserSearch[status]'=>9, 'UserSearch[reg_type]'=>'manual']) ?>" class="small-box-footer">
                <span class="info-box-icon bg-blue">
                    <i class="la la-shopping-cart"></i>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">New Shops</span>
                    <span class="info-box-number">
                        <?= $counter['new_shops'] ?> <small></small>
                    </span>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="info-box">
                <a href="<?= Url::to(['/user','UserSearch[role]'=>0,'UserSearch[status]'=>10, 'UserSearch[reg_type]'=>'auto']) ?>" class="small-box-footer">
                <span class="info-box-icon bg-yellow">
                    <i class="la la-users"></i>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">New Customers</span>
                    <span class="info-box-number">
                        <?= $counter['new_customers'] ?> <small></small>
                    </span>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <!--            <div class="small-box bg-red">-->
            <!--                <div class="inner">-->
            <!--                    <h3>--><? //= $counter['product_count'] ?><!--</h3>-->
            <!---->
            <!--                    <p>Products</p>-->
            <!--                </div>-->
            <!--                <div class="icon">-->
            <!--                    <i class="ion ion-pie-graph"></i>-->
            <!--                </div>-->
            <!--                <a href="-->
            <? //= \yii\helpers\Url::to(['/store-product']) ?><!--" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
            <!--            </div>-->

            <div class="info-box">
                <a href="<?= Url::to(['/store-product']) ?>" class="small-box-footer">
                <span class="info-box-icon bg-red">
                    <i class="la la-shopping-cart"></i>
<!--                    --><?//= FA::i('group') ?>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Products</span>
                    <span class="info-box-number">
                        <?= $counter['product_count'] ?> <small></small>
                    </span>
                </div>

            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                    <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                    <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                </div>
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Queries</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <!--                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Car</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($latest['queries'] as $query) { ?>
                                <tr>
                                    <td>
                                        <a href="<?= Url::to(['/query/view', 'id' => $query->id]) ?>"><?= $query->id ?></a>
                                    </td>

                                    <td><?= $query->title ?></td>
                                    <td><?= \yii\helpers\StringHelper::truncate($query->category->translate->title, 20)  ?></td>
                                    <td><?= $query->vendor.' '.$query->car ?></td>
                                    <td>
                                        <?php if($query->status == 0) {?>
                                        <span class="label label-warning">Moderate</span>
                                        <?php } ?>
                                        <?php if($query->status == 1) {?>
                                            <span class="label label-info">Verified</span>
                                        <?php } ?>

                                        <?php if($query->status == 2) {?>
                                            <span class="label label-success">Purchased</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= date('d/m/Y', $query->created_at) ?>
                                    </td>
                                </tr>
                            <?php } ?>


                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
<!--                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>-->
                    <a href="<?= Url::to(['/query']) ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
        <div class="col-md-4">
            <!-- PRODUCT LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Recently Added Products</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
<!--                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <?php foreach ($latest['products'] as $product) { ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="<?=$product->image ?>" alt="<?= $product->id?>">
                            </div>
                            <div class="product-info">
                                <a href="<?= Url::to(['/store-product/view', 'id'=>$product->id])?>" class="product-title">
                                    <?= $product->translate->name ?>
                                    <span class="label label-success pull-right"><?= $product->purchase_price ?> AED</span></a>
                                <span class="product-description">
                                    <?= $product->translate->short ?>
                                </span>
                            </div>
                        </li>
                        <?php } ?>
                        <!-- /.item -->
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="<?= Url::to(['/store-product'])?>" class="uppercase">View All Products</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
<?php
$this->registerJs('
var area = new Morris.Area({
    element   : \'revenue-chart\',
    resize    : true,
    data      : [
      { y: \'2017 Q1\', item1: 2666, item2: 2666 },
      { y: \'2017 Q2\', item1: 2778, item2: 2294 },
      { y: \'2017 Q3\', item1: 4912, item2: 1969 },
      { y: \'2017 Q4\', item1: 3767, item2: 3597 },
      { y: \'2018 Q1\', item1: 6810, item2: 1914 },
      { y: \'2018 Q2\', item1: 5670, item2: 4293 },
      { y: \'2018 Q3\', item1: 4820, item2: 3795 },
      { y: \'2018 Q4\', item1: 15073, item2: 5967 },
      { y: \'2019 Q1\', item1: 10687, item2: 4460 },
      { y: \'2019 Q2\', item1: 8432, item2: 5713 },
      { y: \'2019 Q3\', item1: 8496, item2: 5783 },
      { y: \'2019 Q4\', item1: 8432, item2: 5713 },
    ],
    
    
    xkey      : \'y\',
    ykeys     : [\'item1\', \'item2\'],
    labels    : [\'Query\', \'Purchase\'],
    lineColors: [\'#a0d0e0\', \'#3c8dbc\'],
    hideHover : \'auto\'
  });
'); ?>