<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */


?>
<?php if($type == 'seller') { ?>
    <div class="password-reset">
        <h3>Your product is sold</h3>
		<p>Hello, <?= $seller_name ?>!</p>
        <p>Your product <?= $product_name ?> is sold at <?= $product_price ?> AED on <?= $sale_date ?>.
        </p>
    </div>
<?php } ?>
<?php //if($type == 'admin') { ?>
<!--    <div class="password-reset">-->
<!--        <h3>Product addedd</h3>-->
<!--        <p>Product added by request --><?//= ucfirst($query_name) .'  '. $query_car_name?><!-- on-->
<!--            --><?//= date('d/m/Y',$query_date)?><!--.-->
<!--        </p>-->
<!--        <p>For view new product, please link <a href="--><?//=$productLink?><!--">here</a></p>-->
<!--    </div>-->
<?php //} ?>
