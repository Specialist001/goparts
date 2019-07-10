<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Hello, Admin. The account <?= $user->username ?>, is registered on <?= Yii::$app->params['appName'] ?>

Follow the link below to verify your email:

<?= $verifyLink ?>
