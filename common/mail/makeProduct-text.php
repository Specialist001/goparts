<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

/* @var $user common\models\User */

$userLink = Yii::$app->urlManager->createAbsoluteUrl(['user/purchases']);
//$productLink = Yii::$app->urlManager->createAbsoluteUrl(['car/product', 'id'=>$product_id]);
if ($token) {
    $productLink = 'http://goparts.ae/car/product?id=' . $product_id . '&token=' . $token;
} else {
    $productLink = 'http://goparts.ae/car/product?id=' . $product_id;
}
?>
<?php if($type == 'buyer') { ?>
        Product addedd
        Hello, <?= $buyer_name ?>!
        Product added by your request <?= ucfirst($query_name) .'  '. $query_car_name?> on <?= date('d/m/Y',$query_date) ?>.

        For view new product, please link here
        <?=$productLink?>
<?php } ?>
<?php if($type == 'admin') { ?>
    Product addedd
    Product added by request <?= ucfirst($query_name) .'  '. $query_car_name?> on <?= date('d/m/Y',$query_date) ?>.

    For view new product, please link here
    <?=$productLink?>
<?php } ?>