<?php

use common\models\Page;
use yii\helpers\Html;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;

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
            <div class="topheader_shop">
                <a href="#">
                    <button class="topheader_shop_button">
                        Shop <?= FA::i('chevron-right topheader_shop_button_i') ?> </button>
                </a>
            </div>
            <div class="topheader_favorites">
                <a href="#">
                    <img src="/svg/Favorites.svg" class="topheader_favorites_img" alt="">
                    <span class="topheader_favorites_number">15</span>
                    <span class="topheader_favorites_text">Favourites</span>
                </a>
            </div>
            <div class="topheader_login">
                <a data-target="#loginModal" data-toggle="modal" href="javascript:void(0)"">
                <img src="svg/Login.svg" class="topheader_login_img" alt="">
                <span class="topheader_login_text">Login</span>
                </a>
            </div>
        </div>
    </nav>
</div>


<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="header_logo">
                    <a href="#">
                        <h1><?= Yii::$app->params['appName'] ?></h1>
                        <span>Auto parts</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="header_city">
                            <div class="header_city_icon">
                                <img src="svg/loaction.svg" alt="">
                            </div>
                            <div class="header_city_text">
                                <span>Your City</span>
                                <h4>Abu Dhabi</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="header_phone">
                            <div class="header_phone_icon">
                                <img src="svg/phone.svg" alt="">
                            </div>
                            <div class="header_phone_text">
                                <span>Sa-Th 9:00-20:00</span>
                                <h4>+97155 689 22 01</h4>
                                <a href="#">Leave a request</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="header_shop">
                            <div class="header_shop_icon">
                                <img src="img/header_shop_icon.png" alt="">
                            </div>
                            <div class="header_shop_text">
                                <h4>In basket</h4>
                                <span>250 500 000 AED</span>
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
                    <img class="img-fluid" src="assets/svg/close.svg" style="width: 1rem">
                </button>
            </div>
            <div class="modal-body px-5">
                <div class="form">
                    <form accept-charset="UTF-8" action="" class="loginBox auth" method="POST">
                        <h4 class="text-center mb-3">Войти в личный кабинет</h4>
                        <div class="input-group text-muted rounded border mb-3">
                                <span class="input-group-prepend mx-2">
                                    <div class="input-group-text bg-transparent border-0">
                                        <img src="assets/svg/Grey_Phone.svg">
                                    </div>
                                </span>
                            <input class="py-2 border-0 d-block w-75" id="name-email-input"
                                   name="email" placeholder="Введите e-mail" type="text">
                        </div>
                        <div class="input-group text-muted rounded border mb-3">
                                <span class="input-group-prepend mx-1">
                                    <div class="input-group-text bg-transparent border-0">
                                        <img src="assets/svg/lock.svg">
                                    </div>
                                </span>
                            <input class="py-2 border-0 d-block w-75" id="name-password-input"
                                   name="password" placeholder="Введите пароль" type="password">
                        </div>
                        <div class="d-inline-block w-100">
                            <label class="toggle float-left">
                                <input class="toggle__input" name="check" type="checkbox">
                                <span class="toggle__label">
                                        <span class="toggle__text">Запомнить пароль</span>
                                    </span>
                            </label>
                            <a class="text-form_style_2 float-right font-weight-bold"
                               href="#">Забыли
                                пароль?</a>
                        </div>
                        <div class="text-center mt-3 mb-4">
                            <input class="btn bg-form_style text-white px-5 btn-login"
                                   type="submit" value="Войти">
                        </div>
                        <div class="w-75 text-center pt-3 m-auto text-font-pn_regular"
                             style="border-top: 2px dashed #efefef;">
                            <span class="text-center">Все еще нет аккаунта?</span>
                            <p class="d-block message">
                                <a class="text-form_style_2 reg_btn" href="#">
                                    Зарегистрироваться
                                </a>
                            </p>
                        </div>
                        <div class="text-center pt-2 m-auto">
                                <span class="text-muted" style="font-size: 0.9rem">
                                    Входя в раздел Мой профиль, Вы принимаете
                                    <a class="text-form_style_2" href=""> Условия использования сайта</a>
                                </span>
                        </div>
                    </form>

                    <form accept-charset="UTF-8" action="" class="registerBox auth" method="POST">
                        <h4 class="text-center mb-3">Регистрация</h4>
                        <div class="input-group text-muted rounded border mb-3">
                                    <span class="input-group-prepend mx-2">
                                        <div class="input-group-text bg-transparent border-0">
                                            <img src="assets/svg/Grey_Phone.svg">
                                        </div>
                                    </span>
                            <input class="py-2 border-0 d-block w-75" id=""
                                   name="email" placeholder="Введите e-mail" type="text">
                        </div>
                        <div class="input-group text-muted rounded border mb-3">
                                    <span class="input-group-prepend mx-1">
                                        <div class="input-group-text bg-transparent border-0">
                                            <img src="assets/svg/lock.svg">
                                        </div>
                                    </span>
                            <input class="py-2 border-0 d-block w-75" id=""
                                   name="password" placeholder="Введите пароль" type="password">
                        </div>
                        <div class="input-group text-muted rounded border mb-3">
                                    <span class="input-group-prepend mx-1">
                                        <div class="input-group-text bg-transparent border-0">
                                            <img src="assets/svg/lock.svg">
                                        </div>
                                    </span>
                            <input class="py-2 border-0 d-block w-75" id=""
                                   name="confirm_password" placeholder="Подтвердите пароль" type="password">
                        </div>
                        <div class="text-center mt-3 mb-4">
                            <input class="btn bg-form_style text-white px-5 btn-login" type="submit"
                                   value="Регистрация">
                        </div>
                        <div class="w-75 text-center pt-3 m-auto text-font-pn_regular"
                             style="border-top: 2px dashed #efefef;">
                            <span class="text-center">Есть аккаунт?</span>
                            <p class="d-block message">
                                <a class="text-form_style_2 reg_btn" href="#">
                                    Войти
                                </a>
                            </p>
                        </div>
                        <div class="text-center pt-2 m-auto">
                                    <span class="text-muted" style="font-size: 0.9rem">
                                        Регистрируясь, Вы принимаете
                                        <a class="text-form_style_2" href="#"> Условия использования сайта</a>
                                    </span>
                        </div>
                    </form>
                </div>

                <div class="box">
                    <div class="content forgetBox" style="display: none">
                        <div class="error"></div>
                        <div class="form forgetBox">
                            <h3>Восстановить аккаунт</h3>
                            <form accept-charset="UTF-8" action="" method="">
                                <input class="form-control" id="" name="email" placeholder="E-mail" type="text">

                                <input class="btn btn-default btn-login" onclick="forgetAjax()" type="button"
                                       value="Отправить">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="content registerBox" style="display:none;">
                        <h3>Регистрация</h3>
                        <div class="form">
                            <form accept-charset="UTF-8" action="" data-remote="true" method="">
                                <input class="form-control" id="" name="email" placeholder="E-mail" type="text">
                                <input class="form-control" id="" name="password" placeholder="Пароль"
                                       type="password">
                                <input class="form-control" id=" " name="password_confirmation"
                                       placeholder="Подтверждение пароля" type="password">
                                <input class="btn btn-default btn-register" name="commit" type="button"
                                       value="Регистрация">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Auth Form -->

