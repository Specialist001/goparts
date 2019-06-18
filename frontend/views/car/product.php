<?php

$this->title = 'Product: '.$product->translate->name;
//print_r($product);exit;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url; ?>
<section class="product-photo">
    <div class="container">
        <form id="cart_form">
            <div class="row">
                <div class="col-xl-12">
                    <ul class="owl-carousel">
                        <li>
                            <a href="/img/product-1.png" data-fancybox="gallery">
                                <img src="/img/product-1.png">
                            </a>
                        </li>
                        <li>
                            <a href="/img/product-2.png" data-fancybox="gallery">
                                <img src="/img/product-2.png">
                            </a>
                        </li>
                        <li>
                            <a href="/img/product-3.png" data-fancybox="gallery">
                                <img src="/img/product-3.png">
                            </a>
                        </li>
                        <li>
                            <a href="/img/product-4.png" data-fancybox="gallery">
                                <img src="/img/product-4.png">
                            </a>
                        </li>
                    </ul>
                    <div class="heart d-none"></div>
                    <div class="photo-desc">
                        <h3><?= $product->translate->name . ', ' . $product->car->vendor . ' ' . $product->car->car . ' ' . $product->car->modification . ' ' . $product->car->year ?></h3>
                        <!--                    <h4>Vendor code <span>AED 864</span></h4>-->
                        <p>SKU: <span><?= $product->sku ?></span></p>
                        <p>Date of addition: <span><?= date('d/m/Y', $product->created_at) ?></span></p>
                        <hr>
                        <p>Type of car
                            <span><?= $product->car->vendor . '>' . $product->car->car . '>' . $product->car->modification . '>' . $product->car->year . ' - ' . $product->typeCar->translate->name ?></span>
                        </p>
                        <div class="w-100 d-inline-block">
                            <div class="price float-left">
                                <h4><?= $product->purchase_price ?> <span>AED</span></h4>
                            </div>
                            <div class="count float-right w-25">
                                <input class="form-control" type="number"
                                       required="required" name="count"
                                       min="1" value="1">
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="product_id" value="<?= $product->id?>">

                        <div class="buybuttons">
                            <button class="buybuttons1 add_cart">Add to cart <img src="/svg/White_bakset.svg" alt="">
                            </button>
                            <button class="buybuttons2">Buy now</button>
                        </div>
                        <div class="star d-none">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" id="cart_popup">
            </div>

            <div class="modal-footer">
                <div class="pull-left">
                    <button type="button" class="btn btn-view" data-dismiss="modal">
                        <?= Yii::t('frontend', 'Continue Shopping') ?>
                    </button>
                </div>
                <div class="pull-left" style="margin-left: 10px">
<!--                    <a href="--><?//= Url::to(['user/messages', 'im' => $product->shop->id]) ?><!--"-->
<!--                       class="btn btn-view" target="_blank">--><?//= FA::i('wechat') ?>
<!--                        --><?//= Yii::t('frontend', 'Ask a question') ?>
<!--                    </a>-->
                </div>
                <div class="pull-right">
                <?php if ($userCart->product_id == $product->id) { ?>
                    <a href="<?= Url::to(['deal/index', 'id' => $userCart->id]) ?>" class="btn btn-secondary">
                        <?//= Yii::t('frontend', 'Interested') ?>
                        К сделку
                    </a>
                <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="product_description">
    <div class="container">
        <div class="product_description_name">
            <h3>Description</h3>
        </div>
        <div class="product_description_des">
            <?= $product->translate->description ?>
        </div>
        <hr>
    </div>
</section>


<section class="related">
    <div class="container">
        <h3>Also we recommend for this car</h3>
        <div class="owl-carousel owl-theme owl-related">
            <div class="related">
                <div class="card" style="width: 100%;">
                    <img src="/img/product.png" class="card-img-top" alt="...">
                    <div class="card-body card_hover">
                        <h4>Chevrolet>Impala>X>2018</h4>
                        <h5>SKU: <span>51-190326-24299</span></h5>
                        <h5>Type of car: <span>Sedan</span></h5>
                    </div>
                    <div class="card-body">
                        <a href="#" class="cat">Nissan</a>
                        <h5 class="card-title">Rear Door Right Side, Nissan Murano 2009</h5>
                        <div class="card_price">
                            <h4>2552 <span>AED</span></h4>
                        </div>
                        <div class="card_cart">
                            <a href="#"><img src="/img/cart.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="related">
                <div class="card" style="width: 100%;">
                    <img src="/img/product.png" class="card-img-top" alt="...">
                    <div class="card-body card_hover">
                        <h4>Chevrolet>Impala>X>2018</h4>
                        <h5>SKU: <span>51-190326-24299</span></h5>
                        <h5>Type of car: <span>Sedan</span></h5>
                    </div>
                    <div class="card-body">
                        <a href="#" class="cat">Nissan</a>
                        <h5 class="card-title"></h5>
                        <div class="card_price">
                            <h4>2552 <span>AED</span></h4>
                        </div>
                        <div class="card_cart">
                            <a href="#"><img src="/img/cart.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="related">
                <div class="card" style="width: 100%;">
                    <img src="/img/product.png" class="card-img-top" alt="...">
                    <div class="card-body card_hover">
                        <h4>Chevrolet>Impala>X>2018</h4>
                        <h5>SKU: <span>51-190326-24299</span></h5>
                        <h5>Type of car: <span>Sedan</span></h5>
                    </div>
                    <div class="card-body">
                        <a href="#" class="cat">Nissan</a>
                        <h5 class="card-title">Rear Door Right Side, Nissan Murano 2009</h5>
                        <div class="card_price">
                            <h4>2552 <span>AED</span></h4>
                        </div>
                        <div class="card_cart">
                            <a href="#"><img src="/img/cart.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

