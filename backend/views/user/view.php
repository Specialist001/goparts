<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'role',
            'type',
            'birth_date',
            'site',
            'about',
            'location',
            'access_level',
            'visit_time:datetime',
            'avatar',
            'email_confirm:email',
            'phone',
            'legal_info',
            'legal_reg_certificate',
            'legal_address',
            'legal_bank_account',
            'legal_vat_number',
            'status',
            'created_at',
            'updated_at',
            'deleted_at',
            'verification_token',
        ],
    ]) ?>

</div>
