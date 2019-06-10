<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url; ?>
<div class="py-3">
<ul class="px-2 py-1  rounded border">
    <li class="py-1">
        <a class="text-form-style_2"
           href="<?= Url::to(['user/index']) ?>"><?= FA::i('user')->addCssClass('text-secondary text-form-style_2') ?>
            My Profile</a>
    </li>
    <li class="py-1">
        <a class="text-form-style_2"
           href="<?= Url::to(['user/orders']) ?>"><?= FA::i('shopping-cart')->addCssClass('text-secondary text-form-style_2') ?>
            My Orders</a>
    </li>
<?php if (Yii::$app->user->identity->role == 1) { ?>
    <li class="py-1">
        <a class="text-form-style_2"
           href="<?= Url::to(['user/products']) ?>"><?= FA::i('comment')->addCssClass('text-secondary text-form-style_2') ?>
            My Products</a>
    </li>
</ul>
<?php } ?>
</div>
