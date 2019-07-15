<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

//$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
$this->registerCss('
    .bg-info {
        background-color: #17a2b8!important;
    }
    .text-white {
        color: #fff!important;
    }
    .header {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: start;
        align-items: flex-start;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 1rem 1rem;
        border-bottom: 1px solid #dee2e6;
        border-top-left-radius: .3rem;
        border-top-right-radius: .3rem;
    }
    .title {
        line-height: 1.5;
    }
    .m-auto {
        margin: auto!important;
    }
    .body {
        position: relative;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1rem;
    }
    .mb-0 {
        margin-bottom: 0!important;
    }

');
?>

<div>
    <div class="bg-info text-white">
        <h5 class="header title m-auto">Thank you!</h5>
    </div>
    <div class="body">
        <p class="mb-0">Dear <?= Html::encode($user->username) ?>. Thank you for leaving us order.</p>
        <p class="mb-0"> You will get best prices from more than 1000s used spare part stores within 24 hours.</p>
        <p> You will be notified to your email you have provided us.</p>
    </div>
    <hr>
    <div class="body">
        For LogIn access:<br>
        Your Login: <?= Html::encode($user->email) ?><br>
        Your Password: <?= $password ?>
    </div>
</div>
