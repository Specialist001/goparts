<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

//$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <h3>Hello, <?= Html::encode($user->username) ?></h3>

    <p>Your password:</p>

    <p><?= $password ?></p>
</div>
