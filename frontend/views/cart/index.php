<?php

$this->title = 'Cart';

use frontend\widgets\WBasket;
use yii\helpers\Url;

$this->registerCss('
    .cart_imageboxes {
        cursor: pointer;
    }
    .cart_imageboxes li.d-none {
        display: none;
    }
    .car_imageboxes li img {
        width: 100%;
    }
');
?>
<div class="basket">
    <div class="container">
        <form id="basket-form" action="<?= Url::to(['order/make']) ?>" method="post">
            <div class="row">
                <div class="col">
                    <?php if (!empty($cart_products)) { ?>
                        <div class="row basket_top">
                            <div class="col-md-5">
                                <p>Goods</p>
                            </div>
                            <div class="col-md-7">
                                <div class="row">
<!--                                    <div class="col-md-4">-->
<!--                                        <p>Quantity</p>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-4">-->
<!--                                        <p>Amount</p>-->
<!--                                    </div>-->
                                    <div class="col-md-10 text-right">
                                        <p>Price</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php foreach ($cart_products as $cart_product) { ?>
                            <div class="row basket_table" id="pr_<?= $cart_product->id ?>">
                                <div class="col-md-5">
                                    <div class="basket_table_div1">
                                        <div class="basket_table_div1_img">
                                            <?php if($cart_product->product->firstImage) { ?>
                                                <ul class="cart_imageboxes pl-0 d-inline-block">
                                                    <li class="seller-query_imagebox">
                                                        <img src="<?= $cart_product->product->firstImage->link ?>" class="img-fluid" alt="product">
                                                    </li>
                                                    <?php if ($cart_product->product->images) {
                                                        foreach ($cart_product->product->images as $image){ ?>
                                                            <li class="d-none">
                                                                <img src="<?=$image->link ?>" class="img-fluid" alt="product">
                                                            </li>
                                                    <?php }
                                                    }?>
                                                </ul>
                                            <?php }?>
                                        </div>
                                        <div class="basket_table_div1_text">
                                            <span>New !</span>
                                            <a href="<?= Url::to(['car/product', 'id' => $cart_product->product->id]) ?>">
                                                <?= $cart_product->product->translate->name . ', ' . $cart_product->product->car->vendor . ' ' . $cart_product->product->car->car . ' ' . $cart_product->product->car->modification . ' ' . $cart_product->product->car->year ?>
                                            </a>
                                            <p><a><?= $cart_product->product->car->vendor ?></a></p>
                                            <input id="vendor_<?= $cart_product->id ?>" type="hidden" name="CartProduct[<?= $cart_product->id ?>][vendor]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 basket_table_block">
                                    <div class="row">
                                        <div class="col-md-4" style="visibility: hidden;">
                                            <input type="hidden" name="CartProduct[<?= $cart_product->id ?>][product_id]"
                                            value="<?= $cart_product->product->id ?>">
                                            <input type="hidden" name="CartProduct[<?= $cart_product->id ?>][name]"
                                            value="<?= $cart_product->product->translate->name ?>">
                                            <input type="hidden" name="CartProduct[<?= $cart_product->id ?>][sku]"
                                            value="<?= $cart_product->product->sku ?>">
                                            <input type="hidden" name="CartProduct[<?= $cart_product->id ?>][price]"
                                                   value="<?= $cart_product->product->price * $commission ?>"
                                            <span><?= number_format($cart_product->product->price * $commission, Yii::$app->params['price']['decimals'], Yii::$app->params['price']['dec_pointer'], Yii::$app->params['price']['thousands_sep']); ?> AED</span>
                                        </div>
                                        <div class="col-md-4" style="visibility: hidden;">
                                            <input type="number" class="product_count" min="1"  id="product_count_<?= $cart_product->id ?>"
                                                   name="CartProduct[<?= $cart_product->id ?>][count]"
                                                   value="<?= $cart_product->count ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <span id="total-count_<?= $cart_product->id ?>">
                                            <?php $t = $cart_product->product->price * $commission * $cart_product->count;
                                            echo number_format($t, Yii::$app->params['price']['decimals'], Yii::$app->params['price']['dec_pointer'], Yii::$app->params['price']['thousands_sep']);
                                            ?>

                                            </span>
                                            <span>AED</span>
                                        </div>
                                    </div>
                                </div>
                                <a class="basket_table_exit cart_delete_button"
                                   data-target="<?= $cart_product->id ?>"
                                   data-product="<?= $cart_product->id ?>"
                                   onclick="return confirm('Are you sure?')">
                                    <span><i class="fa fa-times-circle"></i></span>
                                </a>
                            </div>
                        <?php } ?>

                        <div class="row basket_table_bottom">
                            <a href="#" class="basket_table_bottom_left">
                                <button><i class="fa fa-arrow-left"></i> Back to main page</button>
                            </a>
                            <div class="basket_table_bottom_right">
                                <a class="cart_clear_button"
                                   onclick="return confirm('Are you sure delete all products from cart?')">
                                    Clear All <i class="fa fa-times-circle"></i>
                                </a>
                            </div>
                        </div>
                        <div class="basket_table_bottom_p">
                            <p>By clicking on Checkout you <span>confirm</span> the offer and
                                <span>privacy policy</span>
                            </p>
                        </div>
                        <input type="hidden" name="_csrf-frontend"
                               value="<?= Yii::$app->request->getCsrfToken() ?>"/>

                    <?php } else { ?>
                        <div class="alert alert-warning" role="alert">
                            Your cart is currently empty
                        </div>
                        <a href="<?= Url::to(['/'])?>" class="basket_table_bottom_left">
                            <i class="fa fa-arrow-left"></i> Back to main page
                        </a>
                    <?php } ?>
                </div>
                <?php if (!empty($cart_products)) { ?>
                <div class="col-md-4">
                    <div class="sidebar">
                        <div class="sidebar_top w-100 d-inline-block">
                            <h4 class="float-md-left float-">Payment</h4>
<!--                            <a class="recount float-md-right d-inline-block">Recount</a>-->
                        </div>
                        <div class="sidebar_center">
                            <h5>Amount</h5>
                            <h6 id="cart_amount"><?= WBasket::widget(['key' => 'main']) ?> </h6><span> AED</span>
                            <input type="hidden" id="cart_amount_uf" name="TotalCount" value="<?= str_replace(" ","", WBasket::widget(['key' => 'main'])) ?>">
                            <hr>
                        </div>
                        <div class="">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i> </span>
                                </div>
                                <input type="text" class="form-control" name="User[username]" value="<?= Yii::$app->user->identity->getId() ? Yii::$app->user->identity->username : '' ?>" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" style="width:12px"></i> </span>
                                </div>
                                <input type="email" class="form-control" name="User[email]" value="<?= Yii::$app->user->identity->getId() ? Yii::$app->user->identity->email : '' ?>" placeholder="Email" aria-label="Email">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i> </span>
                                </div>
                                <input type="tel" class="form-control" name="User[phone]" value="<?= Yii::$app->user->identity->getId() ? Yii::$app->user->identity->phone : '' ?>" placeholder="Phone" aria-label="Phone">
                            </div>
                        </div>
                        <hr>
                        <div class="sidebar_bottom pb-3">
                            <div class="sidebar_bottom1">
                                <?php if(Yii::$app->user->isGuest || Yii::$app->user->identity->reg_type == 'auto' || Yii::$app->user->identity->reg_type == '') { ?>
<!--                                <h5 class="catalog_top_link" data-toggle="collapse" href="#collapseCity"-->
<!--                                    role="button"-->
<!--                                    aria-expanded="false" aria-controls="collapseCity">-->
<!--                                    Pick Up Locations  <i class="fa fa-angle-down float-right"></i>-->
<!--                                </h5>-->
<!--                                <div class="collapse show" id="collapseCity">-->
<!--                                    --><?php //foreach ($cities as $city) { ?>
<!--                                        <div class="custom-control custom-radio">-->
<!--                                            <input type="radio" class="custom-control-input" name="Location"-->
<!--                                                   id="customCheck--><?//= $city->id ?><!--" value="--><?//= $city->name ?><!--">-->
<!--                                            <label class="custom-control-label"-->
<!--                                                   for="customCheck--><?//= $city->id ?><!--">--><?//= $city->name ?><!--</label>-->
<!--                                        </div>-->
<!--                                    --><?php //} ?>
<!--                                </div>-->
                                    <h5>Pick Up Locations</h5>
                                    <div class="form-group">
                                        <label>City</label>
                                        <select class="d-block d-md-inline-block ml-md-3 form-control cities" name="City" >
                                            <option value="" selected disabled>Select City</option>
                                            <?php foreach ($cities as $city) {?>
                                                <option value="<?=$city->id?>"><?=$city->name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Location</label>
                                        <select class="d-block d-md-inline-block ml-md-3 form-control stocks" name="Stock" >
                                            <option value="" selected disabled>Select Location</option>
                                        </select>
                                    </div>
                                <? } ?>
                                <?php if(Yii::$app->user->identity->reg_type == 'manual') {?>
<!--                                    <div class="form-group">-->
<!--                                        <label>Location</label>-->
<!--                                        <input class="form-control" type="text" placeholder="Input your location" name="Location">-->
<!--                                    </div>-->
                                    <input type="hidden" name="Location" value="<?= Yii::$app->user->identity->legal_info ?>">
                                <?php } ?>
                            </div>
<!--                            <div class="sidebar_bottom2">-->
<!--                                <h5 class="catalog_top_link" data-toggle="collapse" href="#collapseDelivery"-->
<!--                                    role="button"-->
<!--                                    aria-expanded="false" aria-controls="collapseDelivery">-->
<!--                                    Delivery <i class="fa fa-angle-down float-right"></i>-->
<!--                                </h5>-->
<!--                                <div class="collapse" id="collapseDelivery">-->
<!--                                    --><?php //foreach ($deliveries as $delivery) { ?>
<!--                                        <div class="custom-control custom-radio">-->
<!--                                            <input type="radio" class="custom-control-input" name="Delivery"-->
<!--                                                   id="customCheck--><?//= $delivery->id ?><!--" value="--><?//= $delivery->id ?><!--">-->
<!--                                            <label class="custom-control-label"-->
<!--                                                   for="customCheck--><?//= $delivery->id ?><!--">--><?//= $delivery->name ?><!--</label>-->
<!--                                        </div>-->
<!--                                    --><?php //} ?>
<!--                                </div>-->
<!--                            </div>-->
<!--                            <input type="hidden" class="custom-control-input" name="Delivery"-->
<!--                                   value="1">-->
                            <div class="sidebar_bottom3">
                                <h5>Total (Vat Included)</h5>
                                <h6 id="cart_amount_vat"><?= WBasket::widget(['key' => 'main']) ?> </h6><span>AED</span>
                            </div>
                            <div class="sidebar_bottom4 text-center">
                                <button class="btn" type="submit">Checkout</button>

                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

<!--            <div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="contShopLabel">-->
<!--                <div class="modal-dialog modal-sm" role="document">-->
<!--                    <div class="modal-content">-->
<!--                        <div class="modal-header">-->
<!--                            <h4 class="m-auto w-100 text-center text-center">Checkout</h4>-->
<!--                            <button type="button" class="close float-md-right" data-dismiss="modal">&times;</button>-->
<!--                        </div>-->
<!--                        <div class="modal-body">-->
<!--                            <div class="row">-->
<!--                                <div class="col-md-9">-->
<!--                                    <div class="w-100">-->
<!--                                        <table class="table table-bordered">-->
<!--                                            <thead>-->
<!--                                                <tr>-->
<!--                                                    <th>ID</th>-->
<!--                                                    <th>Product Name</th>-->
<!--                                                    <th>Car Name</th>-->
<!--                                                    <th>SKU</th>-->
<!--                                                    <th>Price (AED)</th>-->
<!--                                                    <th>Quantity</th>-->
<!--                                                    <th>Total price (AED)</th>-->
<!--                                                </tr>-->
<!--                                            </thead>-->
<!--                                            <tbody>-->
<!--                                            --><?php //foreach ($cart_products as $cart_product) { ?>
<!--                                                <tr>-->
<!--                                                    <td>-->
<!--                                                        --><?//= $cart_product->product->id ?>
<!--                                                    </td>-->
<!--                                                    <td>-->
<!--                                                        --><?//= $cart_product->product->translate->name ?>
<!--                                                    </td>-->
<!--                                                    <td>-->
<!--                                                        --><?//= $cart_product->product->car->vendor ?>
<!--                                                    </td>-->
<!--                                                    <td>-->
<!--                                                        --><?//= $cart_product->product->sku ?>
<!--                                                    </td>-->
<!--                                                    <td>-->
<!--                                                        --><?//= $cart_product->product->purchase_price ?>
<!--                                                    </td>-->
<!--                                                    <td>-->
<!--                                                        --><?//= $cart_product->count ?>
<!--                                                    </td>-->
<!--                                                    <td>-->
<!--                                                        --><?//= $cart_product->product->purchase_price * $cart_product->count ?>
<!--                                                    </td>-->
<!--                                                </tr>-->
<!--                                            --><?php //} ?>
<!--                                            </tbody>-->
<!--                                        </table>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-12">-->
<!--                                    <div class="user_data" style="font-size: 12px!important;">-->

<!--                                        <div class="input-group mb-3">-->
<!--                                            <div class="input-group-prepend">-->
<!--                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i> </span>-->
<!--                                            </div>-->
<!--                                            <input type="text" class="form-control" name="User[username]" value="--><?//= Yii::$app->user->identity->getId() ? Yii::$app->user->identity->username : '' ?><!--" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">-->
<!--                                        </div>-->
<!--                                        <div class="input-group mb-3">-->
<!--                                            <div class="input-group-prepend">-->
<!--                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" style="width:12px"></i> </span>-->
<!--                                            </div>-->
<!--                                            <input type="email" class="form-control" name="User[email]" value="--><?//= Yii::$app->user->identity->getId() ? Yii::$app->user->identity->email : '' ?><!--" placeholder="Email" aria-label="Email">-->
<!--                                        </div>-->
<!--                                        <div class="input-group mb-3">-->
<!--                                            <div class="input-group-prepend">-->
<!--                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i> </span>-->
<!--                                            </div>-->
<!--                                            <input type="tel" class="form-control" name="User[phone]" value="--><?//= Yii::$app->user->identity->getId() ? Yii::$app->user->identity->phone : '' ?><!--" placeholder="Phone" aria-label="Phone">-->
<!--                                        </div>-->
<!--                                        <div class="form-group">-->
<!--                                            <label>Comments</label>-->
<!--                                            <textarea rows="3" class="form-control" name="User[comment]"></textarea>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->
<!--                        <div class="modal-footer">-->
<!--                            <button class="btn btn-success" type="submit">Send</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </form>
    </div>
</div>
<?php $this->registerJs('
        var $cart_images = $(\'.cart_imageboxes\');
        var options = {
            url: \'data-original\' };
        $cart_images.on({ready:  function (e) {
                console.log(e.type);
            }
        }).viewer(options);
    ');
?>

