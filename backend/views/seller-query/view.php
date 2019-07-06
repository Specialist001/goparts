<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SellerQuery */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seller Queries', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Request #'.$this->title;
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


<div class="seller-query-view">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a(FA::i('chevron-left').' Back', ['/seller-query'], ['class' => 'btn btn-warning']) ?>
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
//            [
//                'attribute' => 'query_id',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return '<a href="'.\yii\helpers\Url::to(['query/view', 'id'=>$model->query_id]).'">'.$model->query_id.'</a>';
//                }
//            ],
//            [
//                'attribute' => 'seller_id',
//                'label' => 'Seller',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return $model->seller_id
//                        ? '<a href="'.\yii\helpers\Url::to(['user/view', 'id'=>$model->seller->id]).'">'.$model->seller->username.'</a>'
//                        : null;
//                }
//            ],
//            [
//                'attribute' => 'product_id',
//                'label' => 'Product Name',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return $model->product_id
//                        ? '<a href="'.\yii\helpers\Url::to(['store-product/view', 'id'=>$model->product_id]).'">'.$model->product->translate->name.' ID:'.$model->product_id.'</a>'
//                        : null;
//                }
//            ],
//            [
////                'attribute' => 'product_id',
//                'label' => 'Product Image',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return $model->product->image ?
//                        $images
//                        :
//                        null;
//                }
//            ],
//            [
//                'label' => 'Product price',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return '<strong>'.$model->product->price.' AED</strong>';
//                }
//            ],
//            [
//                'attribute' => 'status',
//                'format' =>'sellerQuery',
//            ],
//            [
//                'attribute' => 'created_at',
//                'value' => function ($model) {
//                    return date('d/m/Y', $model->created_at);
//                }
//            ],
//            [
//                'attribute' => 'updated_at',
//                'value' => function ($model) {
//                    return date('d/m/Y', $model->updated_at);
//                }
//            ],
//        ],
//    ]) ?>

</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered detail-view">
            <tbody>
            <tr>
                <th>ID</th>
                <td><?= $model->id?></td>
            </tr>
            <tr>
                <th>Query ID</th>
                <td><a href="<?= \yii\helpers\Url::to(['query/view', 'id'=>$model->query_id]) ?>"><?= $model->query_id?></a></td>
            </tr>
            <tr>
                <th>Seller</th>
                <td><a href="<?= \yii\helpers\Url::to(['user/view', 'id'=>$model->seller->id]) ?>"><?= $model->seller->username ?></a></td>
            </tr>
            <tr>
                <th>Product Description</th>
                <td><a href="<?= \yii\helpers\Url::to(['store-product/view', 'id'=>$model->product_id]) ?>"><?= $model->product->translate->name.' ID:'.$model->product_id ?></a></td>
            </tr>
            <tr>
                <th>Product Images</th>
                <td>
                    <?php if($model->product->images) {?>
                    <ul class="query_imageboxes pl-0 d-inline-block">
                        <li class="query_imagebox">
                            <img src="<?= $model->product->firstImage->link ?>" class="img-fluid" alt="product">
                        </li>
                        <?php foreach ($model->product->images as $p_image) { ?>
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
                    <?php $formatter = new \common\components\MyFormatter();
                        echo $formatter->asSellerQuery($model->status);
                    ?>
                </td>
            </tr>
            <tr>
                <th>Created Date</th>
                <td><?= date('d/m/Y H:m', $model->created_at)?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    <?php if ($model->status == 1) { ?>
    <form class="" action="<?= Url::current()?>" method="POST">
        <button type="submit" class="btn btn-success">Send to buyer</button>
            <?php echo Html :: hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []); ?>
    </form>
    <?php } elseif ($model->status == 2) { ?>
        <h4><strong class="alert text-success">Request already sent to buyer e-mail</strong></h4>
    <?php } ?>
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
