<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

/* @var $user common\models\User */

?>
<?php if($type == 'seller') { ?>
    Your product is sold
    Hello, <?= $seller_name ?>!
    Your product <?= $product_name ?> is sold at <?= $product_price ?> AED on <?= $sale_date ?>.

<?php } ?>
<?php //if($type == 'admin') { ?>
<!--    Product addedd-->
<!--    Product added by request --><?//= ucfirst($query_name) .'  '. $query_car_name?><!-- on --><?//= date('d/m/Y',$query_date) ?><!--.-->
<!---->
<!--    For view new product, please link here-->
<!--    --><?//=$productLink?>
<?php //} ?>