<?php

use common\models\City;
use common\models\Page;
use common\models\User;
use frontend\widgets\WBasket;
use frontend\widgets\WCarSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;

//print_r(Yii::$app->user->identity);exit;
?>


<div class="topheader">
    <nav class="navbar navbar-expand-lg navbar-light topheader_navbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto topheader_navbar_nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Terms and conditions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Delivery and payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacts</a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <div class="float-right">
                    <div class="header_city_icon">
                        <img src="/svg/loaction.svg" class="p-0" alt="" style="margin-top: 2px">
                    </div>
                    <div class="header_city_text float-left pt-1">
                        <span class="mb-0 pt-1 d-none">Your City</span>
                        <h4><?php $city = City::findOne(['default' => 1]);
                            echo $city->name;
                            ?></h4>
                    </div>
                </div>
            </div>
            <div class="col text-center">
                <div class="float-left">
                    <div class="header_shop_icon">
                        <img src="/svg/shopping-cart.svg" class="img-fluid" alt="" style="width: 22px">
                    </div>
                    <div class="header_shop_text float-left">
                        <h4 class="d-none">In basket</h4>
                        <span class=" font-weight-bold">
                            <div id="cart-count" class="d-inline-block"><?= WBasket::widget(['key' => 'main']) ?> </div> AED
                        </span>
                    </div>
                </div>
            </div>
            <!--            <div class="topheader_shop">-->
            <!--                <a href="#">-->
            <!--                    <button class="topheader_shop_button">-->
            <!--                        Shop -->
            <? //= FA::i('chevron-right topheader_shop_button_i') ?><!-- </button>-->
            <!--                </a>-->
            <!--            </div>-->
            <!--            --><?php //if(Yii::$app->user->identity->role == User::ROLE_BUYER || Yii::$app->user->isGuest) { ?>
            <!--            <div class="topheader_favorites">-->
            <!--                <a href="#">-->
            <!--                    <img src="/svg/Favorites.svg" class="topheader_favorites_img" alt="">-->
            <!--                    <span class="topheader_favorites_number">15</span>-->
            <!--                    <span class="topheader_favorites_text">Favourites</span>-->
            <!--                </a>-->
            <!--            </div>-->
            <!--            --><?php //} ?>

            <div class="topheader_login float-md-left pr-3 pr-md-0">
                <?php if (Yii::$app->user->isGuest) { ?>
                    <!--                <a data-target="#loginModal" data-toggle="modal" href="javascript:void(0)">-->
                    <!--                    <img src="svg/Login.svg" class="topheader_login_img" alt="">-->
                    <!--                    <span class="topheader_login_text">Login</span>-->
                    <!--                </a>-->

                    <div class="dropdown">
                        <a id="dropdown_login" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <img src="/svg/Login.svg" class="topheader_login_img" alt="">
                            <span class="topheader_login_text">Login</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right text-right mt-2" aria-labelledby="dropdown_login">
                            <li class="px-2">
                                <a class="text-form-style_2" href="<?= Url::to(['/login']) ?>"> Login</a>
                            </li>
                            <li class="px-2">
                                <a class="text-form-style_2" href="<?= Url::to(['/signup']) ?>"> Signup</a>
                            </li>
                        </ul>
                    </div>

                <?php } else { ?>
                    <div class="dropdown" style="padding-right: 5px;">
                        <a type="" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <img src="/svg/Login.svg" alt="Profile"
                                 style="width: 16px;vertical-align: middle;margin-right: 5px;">
                            Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right px-2 py-1" aria-labelledby="dropdownMenu3">
                            <li>
                                <a class="text-form-style_2"
                                   href="<?= Url::to(['user/index']) ?>"><?= FA::i('user')->addCssClass('text-secondary text-form-style_2') ?>
                                    My Profile</a>
                            </li>
                            <li>
                                <a class="text-form-style_2"
                                   href="<?= Url::to(['user/orders']) ?>"><?= FA::i('shopping-cart')->addCssClass('text-secondary text-form-style_2') ?>
                                    My Orders</a>
                            </li>
                            <?php if (Yii::$app->user->identity->role == 1) { ?>
                                <li>
                                    <a class="text-form-style_2"
                                       href="<?= Url::to(['user/requests']) ?>"><?= FA::i('comment')->addCssClass('text-secondary text-form-style_2') ?>
                                        Requests</a>
                                </li>
                                <li>
                                    <a class="text-form-style_2"
                                       href="<?= Url::to(['user/products']) ?>"><?= FA::i('comment')->addCssClass('text-secondary text-form-style_2') ?>
                                        My Products</a>
                                </li>
                            <?php } ?>
                            <hr>
                            <li>
                                <?= Html::beginForm(['/site/logout'], 'post') .
                                Html::submitButton(
                                    FA::icon('sign-out')->addCssClass('text-danger text-form-style_2') . ' Log Out',
                                    ['class' => 'btn-link logout-btn logout text-form-style_2']
                                )
                                . Html::endForm()
                                ?>
                            </li>
                        </ul>
                    </div>
                <?php } ?>

            </div>
        </div>

    </nav>
    <div class="container ">
        <div class="row">

            <div class="col text-center d-none">
                <div class="">
                    <div class="header_phone_icon">
                        <img src="/svg/phone.svg" alt="">
                    </div>
                    <div class="header_phone_text">
                        <span>Sa-Th 9:00-20:00</span>
                        <h4>+97155 689 22 01</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-auto py-2">
            <div class="col text-center">
                <div class="header_phone_text">
                    <?php if (Yii::$app->controller->route != 'query/create') { ?>
                        <?php if (Yii::$app->user->identity->role == User::ROLE_BUYER || Yii::$app->user->isGuest) { ?>
                            <a href="<?= Url::to(['query/create']) ?>">Leave a request</a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="header_logo w-75 d-inline-block">
                    <a href="<?= Url::to(['/']) ?>" class="d-inline-block">
<!--                        <h1>--><?//= Yii::$app->params['appName'] ?><!--</h1>-->
<!--                        <span>Auto parts</span>-->
                        <img src="/svg/goparts_logo_1.svg" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
<!--                --><?//= WCarSearch::widget()?>
            </div>
            <div class="col-lg-8 col-md-8 col-12 d-none">

                <div class="row">
                    <div class="col-md-4 d-none d-sm-none d-md-block">
                        <div class="header_city">
                            <div class="header_city_icon">
                                <img src="/svg/loaction.svg" alt="">
                            </div>
                            <div class="header_city_text">
                                <span>Your City</span>
                                <h4><?php $city = City::findOne(['default' => 1]);
                                    echo $city->name;
                                    ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-none d-sm-none d-md-block">
                        <div class="header_phone">
                            <div class="header_phone_icon">
                                <img src="/svg/phone.svg" alt="">
                            </div>
                            <div class="header_phone_text">
                                <span>Sa-Th 9:00-20:00</span>
                                <h4>+97155 689 22 01</h4>
                                <?php if (Yii::$app->user->identity->role == User::ROLE_BUYER || Yii::$app->user->isGuest) { ?>
                                    <a href="<?= Url::to(['query/create']) ?>">Leave a request</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="header_shop">
                            <div class="header_shop_icon">
                                <img src="/img/header_shop_icon.png" alt="">
                            </div>
                            <div class="header_shop_text">
                                <h4>In basket</h4>
                                <span><div id="cart-count"
                                           class="d-inline-block"><?= WBasket::widget(['key' => 'main']) ?> </div> AED</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
        <div class="modal-content p-3">
            <div class="modal-header border-bottom-0 pb-0 pt-1">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    <img class="img-fluid" src="/svg/close.svg" style="width: 1rem">
                </button>
            </div>
            <div class="modal-body px-5">
                <div class="form">
                    <form id="login-form" accept-charset="UTF-8" action="<?= Url::to(['login']) ?>"
                          class="loginBox auth" method="POST">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
                               value="<?= Yii::$app->request->getCsrfToken(); ?>"/>
                        <h4 class="text-center mb-3">Log In</h4>
                        <div class="input-group text-muted rounded border mb-3">
                                <span class="input-group-prepend mr-1">
                                    <div class="input-group-text bg-transparent border-0">
                                        <img src="/svg/Mail_.svg">
                                    </div>
                                </span>
                            <input class="py-2 border-0 d-block w-75" id="LoginForm[username]"
                                   name="email" placeholder="Username" type="text" required>
                        </div>
                        <div class="input-group text-muted rounded border mb-3">
                                <span class="input-group-prepend mx-1">
                                    <div class="input-group-text bg-transparent border-0">
                                        <img src="/svg/lock.svg">
                                    </div>
                                </span>
                            <input class="py-2 border-0 d-block w-75" id="LoginForm[password]"
                                   name="password" placeholder="Password" type="password" required>
                        </div>
                        <div class="d-inline-block w-100">
                            <label class="toggle float-left">
                                <input type="hidden" name="LoginForm[rememberMe]" value="0">
                                <input class="toggle__input" name="LoginForm[rememberMe]" type="checkbox" value="1"
                                       checked>
                                <span class="toggle__label">
                                        <span class="toggle__text">Remember password</span>
                                    </span>
                            </label>
                            <a class="text-form-style_2 float-right font-weight-bold pt-1"
                               href="<?= Url::to(['reset-password']); ?>">Forgot your password?</a>
                        </div>
                        <div class="text-center mt-3 mb-4">
                            <input class="btn bg-form_style_1 text-white px-5 btn-login"
                                   type="submit" value="Login">
                        </div>
                        <div class="w-75 text-center pt-3 m-auto text-font-pn_regular"
                             style="border-top: 2px dashed #efefef;">
                            <span class="text-center">Still no account?</span>
                            <p class="d-block message">
                                <a class="text-form-style_2 reg_btn" href="<?= Url::to(['signup']) ?>">
                                    Register Here
                                </a>
                            </p>
                        </div>
                        <div class="text-center pt-2 m-auto">
                                <span class="text-muted" style="font-size: 0.9rem">
                                    By entering the My Profile section, you accept the
                                    <a class="text-form-style_2" href=""> Terms of Use.</a>
                                </span>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Auth Form -->

