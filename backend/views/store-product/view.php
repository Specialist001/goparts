<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StoreProduct */

$this->title = 'Product #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Store Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCss('
    .query_imageboxes {
        width: 10%;
        padding-left: 0;
        cursor: pointer;
        display: inline-block;
    }
    .query_imageboxes li.d-none {
        display: none;
    }
    .query_imageboxes li img {
        width: 100%;
    }
');
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

<!--    --><?//= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
////            'type_id',
////            'producer_id',
//            [
//                'attribute' => 'category_id',
//                'label' => 'Category',
////                'format' => 'raw',
//                'value' => function ($model) {
//                    return $model->category->translate->title;
//                }
//            ],
//            [
//                'attribute' => 'type_car_id',
//                'label' => 'Type of Car',
////                'format' => 'raw',
//                'value' => function ($model) {
//                    return $model->typeCar->translate->name ?  $model->typeCar->translate->name : null;
//                }
//            ],
////            'user_id',
//            [
//                'attribute' => 'user_id',
//                'label' => 'User',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return '<a href="'. \yii\helpers\Url::to(['user/view','id'=>$model->user->id]).'">'. $model->user->username.'</a>';
//                }
//            ],
//            'sku',
//            [
////                'attribute' => 'title',
//                'label' => 'Product Name',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return '<strong>'.$model->translate->name.'</strong>';
//                }
//            ],
//            [
////                'attribute' => 'title',
//                'label' => 'Product Description',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return '<strong>'.$model->translate->description.'</strong>';
//                }
//            ],
//            [
//                'attribute' => 'price',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return '<strong>'.$model->price.' AED</strong>';
//                }
//            ],
//            [
//                'attribute' => 'purchase_price',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return '<strong>'.$model->purchase_price.' AED</strong>';
//                }
//            ],
//            [
//                'attribute'=>'image',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return $model->image ?
//                        '
//                                <ul id="images">
//                                    <li>
//                                    <img src="'.$model->image.'" class="img-responsive" alt="product_'.$model->id.'">
//                                    </li>
//                                </ul>
//                                '
//                        :
//                        null;
//                }
//            ],
//            [
//                'attribute' => 'status',
//                'format' => 'productStatus',
//            ],
//
//            'serial_number',
//            'slug',
//
////            'discount_price',
////            'discount',
////            'data:ntext',
////            'is_special',
////            'length',
////            'width',
////            'height',
////            'weight',
//            'quantity',
//            'in_stock',
//
//
////            'title',
////            'image',
//
////            'average_price',
////            'recommended_price',
//            'order',
////            'external_id',
//            'view',
////            'qid',
//            [
//                'attribute' => 'created_at',
//                'labe' => 'Created Date',
//                'value' => function($model) {
//                    return date('d / m / Y  H:m', $model->created_at);
//                }
//            ],
//            [
//                'attribute' => 'updated_at',
//                'labe' => 'Updated Date',
//                'value' => function($model) {
//                    return date('d / m / Y  H:m', $model->updated_at);
//                }
//            ],
//
//        ],
//    ]) ?>

</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered detail-view">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td><?= $model->id ?></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td><?= $model->category->translate->title ? $model->category->translate->title : '-' ?></td>
                </tr>
                <tr>
                    <th>Body type</th>
                    <td><?= $model->typeCar->translate->name ? $model->typeCar->translate->name : '-' ?></td>
                </tr>
                <tr>
                    <th>Seller</th>
                    <td><?= $model->user->username
                            ? '<a href="'.\yii\helpers\Url::to(['user/update','id'=>$model->user->getId()]).'">'.$model->user->username. '</a>'
                            : '-' ?>
                    </td>
                </tr>
                <tr>
                    <th>SKU</th>
                    <td><?= $model->sku ? $model->sku : '-' ?></td>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <th><?= $model->translate->name ? $model->translate->name : '-' ?></th>
                </tr>
                <tr>
                    <th>Product Description</th>
                    <th><?= $model->translate->description ? $model->translate->description : '-' ?></th>
                </tr>
                <tr>
                    <th>Price</th>
                    <th><?= $model->price ? $model->price .' AED': '-' ?></th>
                </tr>
                <tr>
                    <th>Product Images</th>
                    <td>
                        <?php if($model->images) {?>
                        <ul class="query_imageboxes pl-0 d-inline-block">
                            <li class="query_imagebox">
                                <img src="<?= $model->firstImage->link ?>" class="img-fluid" alt="product">
                            </li>
                            <?php foreach ($model->images as $p_image) { ?>
                                <li class="d-none">
                                    <img src="<?= $p_image->link ?>" class="img-fluid" alt="product">
                                </li>
                            <?php } ?>

                            <?php } else { ?>
                                (Not set)
                            <?php }?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Status
                    </th>
                    <td>
                        <?php if ($model->status==0) {
                            echo '<span class="text-warning">'.FA::i('info').' Not available'.'</span>';
                        } elseif ($model->status==1) {
                            echo '<span class="text-success">'.FA::i('check').' Available'.'</span>';
                        } elseif ($model->status==-1) {
                            echo '<span class="text-danger">'.FA::i('remove').' Blocked'.'</span>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Serial Number</th>
                    <td><?= $model->serial_number ? $model->serial_number : '-' ?></td>
                </tr>
                <tr>
                    <th>Created Date</th>
                    <td><?= date('d / m / Y  H:m', $model->created_at) ?></td>
                </tr>
                <tr>
                    <th>Updated Date</th>
                    <td><?= date('d / m / Y  H:m', $model->updated_at) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
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

<?php $this->registerJs('
        var $query_images = $(\'.query_imageboxes\');
        var options = {
            url: \'data-original\' };
        $query_images.on({ready:  function (e) {
                console.log(e.type);
            }
        }).viewer(options);
    ');
?>
