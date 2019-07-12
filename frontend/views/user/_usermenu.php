<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;
use common\models\SellerQuery;

$requests = SellerQuery::find()->where(['seller_id'=>Yii::$app->user->identity->getId()]);
if (!empty($requests)) {
    $request = $requests->count();
}
$products = \common\models\StoreProduct::find()->where(['user_id'=>Yii::$app->user->identity->getId()]);
if (!empty($products)) {
    $product = $products->count();
}
$orders = \common\models\StoreOrder::find()->where(['user_id'=>Yii::$app->user->identity->getId()]);
if (!empty($orders)) {
    $order = $orders->count();
}

$queries = \common\models\Query::find()->where(['user_id'=>Yii::$app->user->identity->getId()]);
if (!empty($queries)) {
    $query = $queries->count();
}

?>
<div class="py-3">
<!--    <ul class="px-2 py-1  rounded border">-->
<!--        <li class="py-1">-->
<!--            <a class="text-form-style_2"-->
<!--               href="--><?//= Url::to(['user/index']) ?><!--">--><?//= FA::i('user')->addCssClass('text-secondary text-form-style_2') ?>
<!--                My Profile</a>-->
<!--        </li>-->
<!--        <li class="py-1">-->
<!--            <a class="text-form-style_2"-->
<!--               href="--><?//= Url::to(['user/orders']) ?><!--">--><?//= FA::i('shopping-cart')->addCssClass('text-secondary text-form-style_2') ?>
<!--                My Orders</a>-->
<!--        </li>-->
<!--    --><?php //if (Yii::$app->user->identity->role == 1) { ?>
<!--        <li class="py-1">-->
<!--            <a class="text-form-style_2"-->
<!--               href="--><?//= Url::to(['user/products']) ?><!--">--><?//= FA::i('comment')->addCssClass('text-secondary text-form-style_2') ?>
<!--                My Products</a>-->
<!--        </li>-->
<!--    </ul>-->
<!--    --><?php //} ?>
    <div class="customer_list">
        <ul class="customer_list_ul">
            <a href="<?= Url::to(['user/index']) ?>"><li><i class="fa fa-user"></i> Profile</li></a>
            <?php if (Yii::$app->user->identity->role == \common\models\User::ROLE_BUYER) { ?>
            <a href="<?= Url::to(['user/queries']) ?>"><li><img src="/svg/Orders_hostory.svg" alt=""> My queries (<?= $query ?>)</li></a>
            <a href="<?= Url::to(['user/orders']) ?>"><li><img src="/svg/Orders_hostory.svg" alt=""> Orders history</li></a>
            <a href="<?= Url::to(['/cart']) ?>"><li><img src="/svg/Orders_hostory.svg" alt=""> Cart </li></a>
            <a href="<?= Url::to(['user/purchases']) ?>"><li><img src="/svg/My_orders.svg" alt="">Purchases (<?= $order ?>)</li></a>
            <?php } ?>
            <?php if (Yii::$app->user->identity->role == \common\models\User::ROLE_SELLER) { ?>
            <a href="<?= Url::to(['user/requests']) ?>"><li><img src="/svg/My_orders.svg" alt=""> Requests (<?= $request ?>)</li></a>
            <a href="<?= Url::to(['user/products']) ?>"><li><img src="/svg/My_orders.svg" alt=""> My products (<?= $product ?>)</li></a>
            <?php } ?>
<!--            <a href="#"><li><img src="svg/Exit.svg" alt=""> Exit</li></a>-->
        </ul>
    </div>
</div>
