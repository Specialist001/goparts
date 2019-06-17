<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Query */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Queries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="query-view">
    <div class="container">
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
        <div class="row">
            <div class="col-md-4">
                <h4>Contact info</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'phone',
                        'email:email',
                    ],
                ]) ?>


<!--                <table class="table table-bordered">-->
<!--                    <tbody>-->
<!--                    <tr>-->
<!--                        <td class="font-weight-bold">-->
<!--                            Name-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            --><?//= $model->name ?>
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td class="font-weight-bold">-->
<!--                            E-mail-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            --><?//= $model->email ?>
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr><i class="fa fa-crosshairs"></i>-->
<!--                        <td class="font-weight-bold">-->
<!--                            Phone-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            --><?//= $model->phone ? $model->phone : '-' ?>
<!--                        </td>-->
<!--                    </tr>-->
<!--                    </tbody>-->
<!--                </table>-->
            </div>
            <div class="col">
                <h4>Request info</h4>
<!--                <table class="table table-bordered">-->
<!--                    <tbody>-->
<!--                        <tr>-->
<!--                            <td class="font-weight-bold">Request #</td>-->
<!--                            <td>--><?//= $model->id ?><!--</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="font-weight-bold">Name</td>-->
<!--                            <td>--><?//= $model->title ?><!--</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="font-weight-bold">Car</td>-->
<!--                            <td>--><?php //if(!$model->car_id){ ?>
<!--                                    --><?//= $model->vendor.' '.$model->car.' '.$model->modification.' '.$model->year ?>
<!--                                --><?php //} else {?>
<!--                                    --><?//= \common\models\Cars::getCarName($model->car_id) ?>
<!--                                --><?php //}?>
<!--                            </td>-->
<!--                        </tr>-->
<!--                        --><?php //if($model->fueltype) { ?>
<!--                        <tr>-->
<!--                            <td class="font-weight-bold">-->
<!--                                Fueltype-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                --><?//= $model->fueltype ?>
<!--                            </td>-->
<!--                        </tr>-->
<!--                        --><?php //}?>
<!--                        --><?php //if($model->engine) { ?>
<!--                            <tr>-->
<!--                                <td class="font-weight-bold">-->
<!--                                    Engine-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    --><?//= $model->engine ?>
<!--                                </td>-->
<!--                            </tr>-->
<!--                        --><?php //}?>
<!--                        --><?php //if($model->transmission) { ?>
<!--                            <tr>-->
<!--                                <td class="font-weight-bold">-->
<!--                                    Transmission-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    --><?//= $model->transmission ?>
<!--                                </td>-->
<!--                            </tr>-->
<!--                        --><?php //}?>
<!--                        --><?php //if($model->drivetype) { ?>
<!--                            <tr>-->
<!--                                <td class="font-weight-bold">-->
<!--                                    Drivetype-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    --><?//= $model->drivetype ?>
<!--                                </td>-->
<!--                            </tr>-->
<!--                        --><?php //}?>
<!--                    </tbody>-->
<!--                </table>-->

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
//                        'user_id',
//                        'car_id',
                        [
                            'label' => 'Car',
                            'value' => function($model){
                                return $model->vendor.' '.$model->car.' '.$model->modification.' '.$model->year;
                            }
                        ],
//                        'category_id',
                        [
                            'attribute' => 'category_id',
                            'label' => 'Category',
                            'value' => function($model) {
                                return $model->category->translate->title;
                            }
                        ],
//                        'vendor',
//                        'car',
//                        'year',
//                        'modification',
                        'fueltype',
                        'engine',
                        'transmission',
                        'drivetype',
//                        'name',
//                        'phone',
//                        'email:email',
                        'image',
//                        'status',
                        [
                            'attribute'=>'status',
                            'label' => 'Status',
                            'format' => 'query',
                        ],
//                        'created_at',
                        [
                            'attribute' => 'created_at',
                            'label' => 'Create Date',
                            'value' => function($model) {
                                return date('d.m.Y H:i', $model->created_at);
                            }
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
