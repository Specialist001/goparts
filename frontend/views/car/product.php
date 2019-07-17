<?php

$this->title = 'Product: ' . $product->translate->name;

//print_r($product);exit;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;

$this->registerCssFile('/css/slick.css');
$this->registerCss('
    .synch-carousels {
   position: relative;
   display: flex;
   flex-wrap: wrap;
   justify-content: space-between;
 }
  
 .synch-carousels > * {
   width: 100%;
 }
  
 .synch-carousels .right {
   order: -1;
 }
  
 .synch-carousels .left {
   overflow: hidden;
 }
  
 .synch-carousels .gallery {
   display: none;
 }
  
 .synch-carousels .gallery .slick-list {
   height: auto !important;
   margin: 0 -20px;
 }
  
 .synch-carousels .gallery .slick-slide {
   margin: 0 20px;
   border: 1px solid #000;
 }
  
 @media screen and (min-width: 480px) {
   .synch-carousels .right {
     margin-bottom: 5px;
   }
  
   .synch-carousels .gallery {
     display: block;
   }
 }
  
 @media screen and (min-width: 1024px) {
   .synch-carousels .right {
     position: relative;
     width: calc(100% - 150px);
     margin-bottom: 0;
     order: 2;
   }
  
   .synch-carousels .left {
     width: 90px;
   }
  
   .synch-carousels .gallery .slick-slide {
     margin: 0 0 5px 0;
   }
  
   .synch-carousels .gallery .slick-list {
     margin: 0;
   }
 }

');
?>
<section class="product-photo">
    <div class="container">
        <form id="cart_form">
            <div class="row">
                <div class="col-xl-12">
                    <ul class="owl-carousel">
                    <?php if ($product->firstImage) { ?>
                        <?php foreach ($product->storeProductImages as $image) { ?>
                            <li>
                                <a href="<?= $image->link ?>" data-fancybox="gallery">
                                    <img src="<?= $image->link ?>" alt="<?= $product->translate->name ?>"
                                         class="img-fluid">
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    </ul>
                    <div class="heart d-none"></div>
                    <div class="photo-desc">
                        <h3><?= $product->translate->name . ', ' . $product->car->vendor . ' ' . $product->car->car . ' ' . $product->car->modification . ' ' . $product->car->year ?></h3>
                        <!--                    <h4>Vendor code <span>AED 864</span></h4>-->
<!--                        <p>SKU: <span>--><?//= $product->sku ?><!--</span></p>-->
                        <p>Date of addition: <span><?= date('d/m/Y', $product->created_at) ?></span></p>
                        <hr>
<!--                        <p>Type of car-->
<!--                            <span>--><?//= $product->car->vendor . '>' . $product->car->car . '>' . $product->car->modification . '>' . $product->car->year . ' - ' . $product->typeCar->translate->name ?><!--</span>-->
<!--                        </p>-->
                        <div class="w-100 d-inline-block">
                            <div class="price float-left w-100">
                                <h4><?= $product->price * $commission ?> <span>AED</span></h4>
                            </div>
                            <div class="count float-right w-25">
                                <input class="form-control" type="hidden"
                                       required="required" name="count"
                                       min="1" value="1">
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                        <input type="hidden" name="user_id" value="<?= !Yii::$app->user->isGuest ? Yii::$app->user->identity->getId() : null ?>">
                        <input type="hidden" name="_csrf-frontend"
                               value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                        <div class="buybuttons">
                            <button class="buybuttons1 add_cart">Add to cart <img src="/svg/White_bakset.svg"
                                                                                  alt="">
                            </button>
                            <button class="buybuttons2 buy_now mt-4 mt-md-0">Buy now</button>
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
                    <!--                    <a href="-->
                    <? //= Url::to(['user/messages', 'im' => $product->shop->id]) ?><!--"-->
                    <!--                       class="btn btn-view" target="_blank">--><? //= FA::i('wechat') ?>
                    <!--                        --><? //= Yii::t('frontend', 'Ask a question') ?>
                    <!--                    </a>-->
                </div>

            </div>
        </div>
    </div>
</div>
<!--<section class="product_description">-->
<!--    <div class="container">-->
<!--        <div class="product_description_name">-->
<!--            <h3>Description</h3>-->
<!--        </div>-->
<!--        <div class="product_description_des">-->
<!--            --><?//= $product->translate->description ?>
<!--        </div>-->
<!--        <hr>-->
<!--    </div>-->
<!--</section>-->



<div class="w-100 my-5"></div>

