<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SellerQuery */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seller Queries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="seller-query-view py-3">
    <div class="container">
        <h3 class="py-3">Request #<?= Html::encode($this->title) ?></h3>
        <div class="row">


            <div class="col-md-3">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" value="<?= $model->query->title ?>" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Car</label>
                    <input class="form-control" value="<?= $model->query->vendor.' '.$model->query->car.' '.$model->query->modification.' '.$model->query->year ?>" readonly>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Category</label>
                    <input class="form-control" value="<?= $model->query->category->translate->title ?>" readonly>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Fuel type</label>
                    <input class="form-control" value="<?= $model->query->fueltype ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Engine</label>
                    <input class="form-control" value="<?= $model->query->engine ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Transmission</label>
                    <input class="form-control" value="<?= $model->query->transmission ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Drive type</label>
                    <input class="form-control" value="<?= $model->query->drivetype ?>" readonly>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-4">
                <a class="btn btn-danger" href="<?= \yii\helpers\Url::to(['user/requests'])?>"><i class="fa fa-chevron-left"> Back</i> </a>
                <?php if($model->status == 0) { ?>
                <a class="btn btn-primary"
                   href="<?= \yii\helpers\Url::to(['user/product/create', 'query_id'=>$model->query->id , 'car_id'=>$model->query->car_id, 'category'=>$model->query->category_id])?>">
                    Create Product</a>
                <?php } else {?>
                    <a class="btn btn-primary"
                       href="<?= \yii\helpers\Url::to(['user/product/update', 'id'=>$model->product_id])?>">
                        Update Product</a>
                <?php }?>
            </div>
        </div>


<!--    <p>-->
<!--        --><?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
<!--    </p>-->

<!--    --><?//= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'query_id',
//            'seller_id',
//            'product_id',
//            'status',
//            'created_at',
//            'updated_at',
//        ],
//    ]) ?>



</div>
</div>
