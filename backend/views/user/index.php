<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
<!--        --><?//= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Clear sort', ['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            'first_name',
            'middle_name',
            'last_name',
            [
                'attribute' => 'gender',
                'format' => 'gender',
                'filter' => array("0" => "Male", "1" => "Female"),
            ],
            [
                'attribute' => 'role',
                'format' => 'role',
                'filter' => array("0" => "Buyer", "1" => "Seller"),
            ],
            [
                'attribute' => 'type',
                'format' => 'type',
                'filter' => array("0" => "Individual", "1" => "Legal entity"),
            ],
            //'role',
            //'type',
            //'birth_date',
            //'site',
            //'about',
            //'location',
            //'access_level',
            //'visit_time:datetime',
            //'avatar',
            //'email_confirm:email',
            'phone',
            //'legal_info',
            //'legal_reg_certificate',
            //'legal_address',
            //'legal_bank_account',
            //'legal_vat_number',
            [
                'attribute' => 'status',
                'format' => 'activeuser',
                'filter' => array("0" => "Deleted", "10" => "Active"),
            ],
            //'created_at',
            //'updated_at',
            //'deleted_at',
            //'verification_token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
