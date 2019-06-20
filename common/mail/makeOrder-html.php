<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$userLink = Yii::$app->urlManager->createAbsoluteUrl(['user/purchases']);
$shopLink = Yii::$app->urlManager->createAbsoluteUrl(['user/purchases']);
?>
<?php if($type == 'buyer') { ?>
    <div class="password-reset">
        <h3>Your order is accepted</h3>

		<p>Details of the order can be viewed in <a href="<?=$userLink?>">your account</a>.</p>
    </div>
<?php } ?>
<?php if($type == 'seller') { ?>
    <div class="password-reset">
        <h3>New order</h3>

        <p>Go to the control panel to view the details.</p>
    </div>
<?php } ?>
