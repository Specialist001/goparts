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
                        Category <i class="fa fa-chevron-down"></i>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Check</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                <label class="custom-control-label" for="customCheck2">This custom</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck3">
                                <label class="custom-control-label" for="customCheck3">Checkbox</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="catalog_body">
                    <h3>Body type</h3>
                    <div class="catalog_body_opt">
                        <span>Sedan</span>
                        <i class="fa fa-times-circle"></i>
                    </div>
                </div>
                <div class="catalog_radio">
                    <h3>Condition</h3>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="bodytype1" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="bodytype1">Toggle</label>
                    </div>
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
                <div class="row catalog_cart">
                    <?php foreach ($products as $product) { ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="img w-75">
                                <img src="<?= $product->image?>" class="img-fluid card-img-top" alt="<?= $product->translate->name?>">
                            </div>
                            <div class="card-body card_hover">
                                <h4>Chevrolet>Impala>X>2018</h4>
                                <h5>SKU: <span>51-190326-24299</span></h5>
                                <h5>Type of car: <span>Sedan</span></h5>
                            </div>
                            <div class="card-body">
                                <a href="#" class="cat"><?= Yii::$app->request->get('vendor')?></a>
                                <h5 class="card-title"><?= $product->translate->name?>,
                                    <?= $product->car->vendor .' '.$product->car->car.' '.$product->car->modification.' '.$product->car->year?> </h5>
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
            </div>
        </div>
    </div>
</section>
