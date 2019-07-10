<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
//$verifyLink = Url::to(['site/verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Hello, Admin. The account <?= Html::encode($user->username) ?> is registered on <?= Yii::$app->params['appName'] ?>,</p>

    <p>Follow the link below to verify his(her) email:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
