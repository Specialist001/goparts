<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$userLink = Yii::$app->urlManager->createAbsoluteUrl(['user/purchases']);
$shopLink = Yii::$app->urlManager->createAbsoluteUrl(['user/purchases']);
$productLink = Url::to(['http://goparts.ae/car/product', 'id'=>$product_id]);

?>
<?php if($type == 'buyer') { ?>
    <div class="password-reset">
        <h3>Product addedd</h3>
		<p>Product added by your request <?= ucfirst($query_name) .'  '. $query_car_name?> on
            <?= date('d/m/Y',$query_date) ?>.
        </p>
        <p>For view new product, please link <a href="<?=$productLink?>">here</a></p>
    </div>
<?php } ?>
<?php if($type == 'admin') { ?>
    <div class="password-reset">
        <h3>Product addedd</h3>
        <p>Product added by request <?= ucfirst($query_name) .'  '. $query_car_name?> on
            <?= date('d/m/Y',$query_date)?>.
        </p>
        <p>For view new product, please link <a href="<?=$productLink?>">here</a></p>
    </div>
<?php } ?>
