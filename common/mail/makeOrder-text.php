<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$userLink = Yii::$app->urlManager->createAbsoluteUrl(['user/purchases']);
?>
<?php if($type == 'buyer') { ?>
        Your order is accepted

        Details of the order can be viewed in your account.
        <?=$userLink?>
<?php } ?>
<?php if($type == 'seller') { ?>
        New order

        Go to the control panel to view the details.
<?php } ?>