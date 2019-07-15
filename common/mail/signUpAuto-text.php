<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

//$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
use yii\helpers\Html; ?>
Thank you!
    Dear <?= Html::encode($user->username) ?>. Thank you for leaving us order.
        You will get best prices from more than 1000s used spare part stores within 24 hours.
        You will be notified to your email you have provided us.

        For LogIn access:
        Your Login: <?= Html::encode($user->email) ?>
        Your Password: <?= $password ?>
