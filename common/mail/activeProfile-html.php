<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="verify-email">
    <p>Hello <?= Html::encode($user->username) ?>, </p>

    <p>Your profile is activated.</p>
</div>
