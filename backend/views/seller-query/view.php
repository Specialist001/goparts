<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SellerQuery */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seller Queries', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Request #'.$this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="seller-query-view">

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
            [
                'attribute' => 'query_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a href="'.\yii\helpers\Url::to(['query/view', 'id'=>$model->query_id]).'">'.$model->query_id.'</a>';
                }
            ],
            [
                'attribute' => 'seller_id',
                'label' => 'Seller',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->seller_id
                        ? '<a href="'.\yii\helpers\Url::to(['user/view', 'id'=>$model->seller->id]).'">'.$model->seller->username.'</a>'
                        : null;
                }
            ],
            [
                'attribute' => 'product_id',
                'label' => 'Product Name',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->product_id
                        ? '<a href="'.\yii\helpers\Url::to(['store-product/view', 'id'=>$model->product_id]).'">'.$model->product->translate->name.' ID:'.$model->product_id.'</a>'
                        : null;
                }
            ],
            [
//                'attribute' => 'product_id',
                'label' => 'Product Image',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->product->image ?
                        '
                            <ul id="images">
                                <li>
                                <img src="'.$model->product->image.'" class="img-responsive" alt="product_'.$model->id.'">
                                </li>
                            </ul>
                        ' :
                        null;
                }
            ],
            [
                'label' => 'Product price',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<strong>'.$model->product->purchase_price.' AED</strong>';
                }
            ],
            [
                'attribute' => 'status',
                'format' =>'sellerQuery',
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('d/m/Y', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return date('d/m/Y', $model->updated_at);
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