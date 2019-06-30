<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StoreProduct */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Store Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="store-product-view">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

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
//            'type_id',
//            'producer_id',
            [
                'attribute' => 'category_id',
                'label' => 'Category',
//                'format' => 'raw',
                'value' => function ($model) {
                    return $model->category->translate->title;
                }
            ],
            [
                'attribute' => 'type_car_id',
                'label' => 'Type of Car',
//                'format' => 'raw',
                'value' => function ($model) {
                    return $model->typeCar->translate->name ?  $model->typeCar->translate->name : null;
                }
            ],
//            'user_id',
            [
                'attribute' => 'user_id',
                'label' => 'User',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a href="'. \yii\helpers\Url::to(['user/view','id'=>$model->user->id]).'">'. $model->user->username.'</a>';
                }
            ],
            'sku',
            [
//                'attribute' => 'title',
                'label' => 'Product Name',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<strong>'.$model->translate->name.'</strong>';
                }
            ],
            [
//                'attribute' => 'title',
                'label' => 'Product Description',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<strong>'.$model->translate->description.'</strong>';
                }
            ],
            [
                'attribute' => 'price',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<strong>'.$model->price.' AED</strong>';
                }
            ],
            [
                'attribute' => 'purchase_price',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<strong>'.$model->purchase_price.' AED</strong>';
                }
            ],
            [
                'attribute'=>'image',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->image ?
                        '
                                <ul id="images">
                                    <li>
                                    <img src="'.$model->image.'" class="img-responsive" alt="product_'.$model->id.'">
                                    </li>
                                </ul>
                                '
                        :
                        null;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'productStatus',
            ],

            'serial_number',
            'slug',

            'discount_price',
            'discount',
            'data:ntext',
            'is_special',
            'length',
            'width',
            'height',
            'weight',
            'quantity',
            'in_stock',


            'title',
//            'image',

            'average_price',
            'recommended_price',
            'order',
//            'external_id',
            'view',
//            'qid',
            [
                'attribute' => 'created_at',
                'labe' => 'Created Date',
                'value' => function($model) {
                    return date('d / m / Y  H:m', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'labe' => 'Updated Date',
                'value' => function($model) {
                    return date('d / m / Y  H:m', $model->updated_at);
                }
            ],

        ],
    ]) ?>

</div>
<?php $this->registerJs('
    var $image = $(\'#image\');

    $image.viewer({
        inline: true,
        viewed: function() {
            $image.viewer(\'zoomTo\', 1);
        }
    });
    
    // Get the Viewer.js instance after initialized
    var viewer = $image.data(\'viewer\');

    // View a list of images
    $(\'#images\').viewer();
'); ?>