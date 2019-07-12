<?php

$this->title = Yii::t('frontend', 'Purchases');

use yii\helpers\Url;
use yii\widgets\LinkPager; ?>

<div class="container pt-3">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('//user/_usermenu.php') ?>
        </div>
        <div class="col-md-9">
            <div>
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center"><?= $this->title?></h3>
                    </div>
                </div>
                <?php if(empty($orders)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-danger">
                                No orders
                            </p>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php if(!empty($orders)) { ?>
                            <?php foreach ($orders as $order) { ?>
                                <div class="basket_table">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            Order number: <span class="text-form-style_2"><?=$order->id?></span><br>
                                            Order date: <span class="text-form-style_2"><?= date('d.m.Y H:i:s', $order->created_at)?></span>
                                        </div>
                                        <div class="col-sm-4">
                                            Cost: <span class="text-form-style_2"><?=$order->total_price ?></span> AED <br>
<!--                                            Delivery: <span class="text-form-style_2">--><?//=$order->delivery->name ?><!--</span>-->
                                        </div>
                                        <div class="col-sm-3">
                                                <?php if($order->status == 1) {?>
                                                    <span class="text-info"> Check availability</span>
                                                <?php } else if($order->status == 2) { ?>
                                                <span class="alert alert-primary"> Waiting for payment
                                                <?php } else if($order->status == 3) {?>
                                                    Order completed
                                                <?php } else { ?>
                                                    Order cancelled
                                                <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-12">
                                            <?php $counter=0;
                                                foreach ($order->storeOrderProducts as $item) { $counter++ ?>
                                                <div>
                                                    <?= $counter?> .
                                                    <?= $item->product->translate->name .' ('. $item->product->car->vendor .' '. $item->product->car->car .')' ?>
                                                    x <strong><?= $item->quantity ?></strong>
                                                </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-md-8">

                                        </div>
                                        <div class="col-md-4">
                                            <div class="float-md-right">
                                                <a href="<?=Url::to(['user/purchase', 'id' => $order->id])?>" class="btn btn-primary btn-order"> Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>

                    <div class="col-md-12">
                        <div class="text-center">
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
