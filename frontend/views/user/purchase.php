<?php

$this->title = "Purchase #".$order->id;

use yii\helpers\Url;
use yii\widgets\LinkPager; ?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('//user/_usermenu.php') ?>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center"><?= $this->title?></h3>
                </div>
            </div>
            <?php if(empty($order)) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-danger">
                            No order
                        </p>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <?php if(!empty($order)) { ?>
                        <div class="basket_table">
                            <div class="row">
                                <div class="col-sm-5">
                                    Order number: <span class="text-form-style_2"><?=$order->id?></span><br>
                                    Order date: <span class="text-form-style_2"><?= date('d.m.Y H:i:s', $order->created_at)?></span>
                                </div>
                                <div class="col-sm-4">
                                    Cost: <span class="text-form-style_2"><?=$order->total_price ?></span> AED <br>
                                    Delivery: <span class="text-form-style_2"><?=$order->delivery->name ?></span>
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
<!--                                <div class="col-sm-12">-->
<!--                                    --><?php //$counter=0;
//                                    foreach ($order->storeOrderProducts as $item) { $counter++ ?>
<!--                                        <div>-->
<!--                                            --><?//= $counter?><!-- .-->
<!--                                            --><?//= $item->product->translate->name .' ('. $item->product->car->vendor .' '. $item->product->car->car .')' ?>
<!--                                            x <strong>--><?//= $item->quantity ?><!--</strong>-->
<!--                                        </div>-->
<!---->
<!--                                    --><?php //}?>
<!--                                </div>-->

                                <div class="col-sm-12 pt-4">
                                    <table class="table-bordered">
                                        <thead>
                                            <th class="px-2">Product ID</th>
                                            <th class="px-2">Name</th>
                                            <th class="px-2">Car</th>
                                            <th class="px-2">Price</th>
                                            <th class="px-2">Count</th>
                                            <th class="px-2">Total</th>
                                        </thead>
                                        <tbody>
                                        <?php $counter=0;
                                        foreach ($order->storeOrderProducts as $item) { $counter++ ?>
                                            <tr>
                                                <td class="px-2 text-center"><?= $item->product->id ?></td>
                                                <td class="px-2 text-center"><?= $item->product->translate->name ?></td>
                                                <td class="px-2 text-center"><?= $item->product->car->vendor .' '. $item->product->car->car.' '.$item->product->car->modification.' '.$item->product->car->year ?></td>
                                                <td class="px-2 text-center"><?= $item->product->purchase_price ?> AED</td>
                                                <td class="px-2 text-center"><?= $item->quantity ?></td>
                                                <td class="px-2 text-center"><?= $item->product->purchase_price * $item->quantity ?> AED</td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-md-4">
                                    <div class="float-md-left">
                                        <a href="<?=Url::to(['user/purchases'])?>" class="btn btn-danger"> <i class="fa fa-chevron-left"></i> Back</a>
                                    </div>
                                </div>
                                <div class="col-md-8">

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


            </div>
        </div>
    </div>
</div>
