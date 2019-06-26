<?php
//echo '<pre>';
//print_r($products);
//echo '</pre>';
//exit;
use common\models\Cars;
use frontend\widgets\WCarSearch;

//foreach ($products as $product) {
//    echo 'product: '.$product->translate->name .'<br>';
//    echo 'purchase price: '.$product->purchase_price .'<br>';
//    echo 'car: '.$product->car->vendor .'-'.$product->car->car.'-'.$product->car->modification.'-'.$product->car->year.'<br>';
//}
//print_r($modifications_array);exit;

$this->title = 'Product Search: ' . Yii::$app->request->get('vendor') .' '. Yii::$app->request->get('car');
?>

<?= WCarSearch::widget()?>

<section class="catalog">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="catalog_top">
                    <a class="catalog_top_link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Category <i class="fa fa-chevron-down float-right"></i>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="">
                            <?php foreach ($categories as $category) { ?>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="Category" id="customCheck<?=$category->id ?>">
                                <label class="custom-control-label" for="customCheck<?=$category->id ?>"><?=$category->translate->title ?></label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="catalog_body">
<!--                    <h3>Body type</h3>-->
<!--                    <div class="catalog_body_opt">-->
<!--                        <span>Sedan</span>-->
<!--                        <i class="fa fa-times-circle"></i>-->
<!--                    </div>-->
                    <a class="catalog_top_link" data-toggle="collapse" href="#collapseBody" role="button" aria-expanded="false" aria-controls="collapseBody">
                        Body type <i class="fa fa-chevron-down float-right"></i>
                    </a>
                    <div class="collapse catalog_body_opt" id="collapseBody">
                        <div class="">
                            <?php foreach ($body_types as $body_type) { ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="BodyType" id="bodyCheck<?=$body_type->id ?>">
                                    <label class="custom-control-label" for="bodyCheck<?=$body_type->id ?>"><?=$body_type->translate->name ?></label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="catalog_radio">
                    <h3>Condition</h3>
<!--                    --><?php //foreach ($body_types as $body_type) { ?>
<!--                    <div class="custom-control custom-radio">-->
<!--                        <input type="radio" id="bodytype--><?//= $body_type->id ?><!--" name="BodyType" class="custom-control-input">-->
<!--                        <label class="custom-control-label" for="bodytype--><?//= $body_type->id ?><!--">--><?//= $body_type->translate->name ?><!--</label>-->
<!--                    </div>-->
<!--                    --><?php //} ?>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="bodytype2" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="bodytype2">Or</label>
                    </div>
                </div>
                <div class="catalog_radio">
                    <h3>Engine's type</h3>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="Engine1" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="Engine1">Toggle</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="Engine2" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="Engine2">Or</label>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <?php if ($products) {?>
                <div class="row catalog_cart">
                    <?php foreach ($products as $product) { ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="img w-100">
                                <img src="<?= $product->image?>" class="img-fluid card-img-top" alt="<?= $product->translate->name?>">
                            </div>
                            <div class="card-body card_hover">
                                <h4>Chevrolet>Impala>X>2018</h4>
                                <h5>SKU: <span>51-190326-24299</span></h5>
                                <h5>Type of car: <span>Sedan</span></h5>
                            </div>
                            <div class="card-body">
                                <a href="#" class="cat"><?= $product->car->vendor ?></a>
                                <a href="<?= \yii\helpers\Url::to(['car/product', 'id'=>$product->id]) ?>">
                                    <h5 class="card-title"><?= $product->translate->name?>,
                                        <?= $product->car->vendor .' '.$product->car->car.' '.$product->car->modification.' '.$product->car->year?>
                                    </h5>
                                </a>
                                <div class="card_price">
                                    <h4><?=$product->purchase_price ?> <span>AED</span></h4>
                                </div>
                                <div class="card_cart">
                                    <a href="#"><img src="/img/cart.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } else {?>
                    <div>Product(s) not found</div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
