<?php
$this->title = 'My Products';

use yii\helpers\Url; ?>
<div class="container pt-4">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('//user/_usermenu.php') ?>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">
                        My Products
                    </h3>
                </div>
            </div>
<!--            <div class="row mb-2">-->
<!--                <div class="col-md-12">-->
<!--                    <span class="float-md-right">-->
<!--                        <a class="btn btn-info" href="--><?//= Url::to(['user/product/create']) ?><!--">Add product</a>-->
<!--                    </span>-->
<!--                </div>-->
<!--            </div>-->


            <div class="">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Car</th>
                        <th>Category</th>
                        <th>Type of Car</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? if (!empty($products)) { ?>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td><?= $product->id ?></td>
                                <td><a href="<?=Url::to(['user/product/update', 'id'=>$product->id]) ?>"><?=$product->translate->name?></a> </td>
                                <td><?= $product->storeProductToCars->car->vendor ? $product->storeProductToCars->car->vendor : $product->car->vendor ?></td>
                                <td><?= $product->category->translate->title ?></td>
                                <td><?= $product->typeCar->translate->name ?></td>
                                <td><?= $product->price ?></td>
                                <td><?= $product->status == 1 ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>' ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td class="text-center" colspan="7">No Product</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
