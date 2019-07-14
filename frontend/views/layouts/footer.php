<?php

use common\models\Page;
use yii\helpers\Html;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;

?>

<section class="topfooter">
    <div class="container">
        <div class="row">
            <div class="col topfooter_div">
                <img src="/svg/phone.svg" alt="">
                <span class="topfooter_div_span1">+97155 689 22 01</span>
            </div>
            <div class="col topfooter_div">
                <img src="/svg/schedule.svg" alt="">
                <span>Sa-Th 9:00-20:00</span>
            </div>
            <div class="col d-none topfooter_div topfooter_div3">
                <img src="/svg/loaction.svg" alt="">
                <span>Emirates Industrial City,<br> shop No. 5. , United Arab<br> Emirates , Sharjah</span>
            </div>
        </div>
    </div>
</section>

<?//= \frontend\widgets\WMap::widget(); ?>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="row">
<!--                    <div class="col-6 footer_left_div1">-->
<!--                        <h3>Services</h3>-->
<!--                        <ul>-->
<!--                            <li><a href="#">Sell</a></li>-->
<!--                            <li><a href="#">Buy</a></li>-->
<!--                            <li><a href="#">Search</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
                    <div class="col-12 col-md-6 footer_left_div2">
<!--                        <h3>Company</h3>-->
                        <ul>
                            <li><a href="<?= Url::to(['page/about_us']) ?>">About Us</a></li>
                            <li><a href="<?= Url::to(['page/terms_and_conditions']) ?>">Terms and conditions</a></li>

                            <li><a href="<?= Url::to(['contact']) ?>">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-6 footer_left_div3">
                        <h3>Download our APP</h3>
                        <img src="/img/google.png" alt="">
                        <img src="/img/store.png" alt="">
                        <p class="mb-1">You can buy with cash</p>
                        <img src="/img/wallet_i.png" alt="" style="width: 30px">
<!--                        <img src="/img/mastercard.png" alt="">-->
                    </div>
                    <div class="col-md-6 footer_left_div4 mt-4 mt-md-0">
                        <h3 class="mb-1 mb-md-4">Socials</h3>
                        <div class="footer_rightblock">
                            <div class="rightblock_div3">
                                <ul>
                                    <li><a href="#"><?= FA::i('facebook') ?></a></li>
                                    <li><a href="#"><?= FA::i('instagram') ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="footerbottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>© 2019  Services provided by <span class="text-form-style_2">GO parts</span></p>
            </div>
            <div class="col-md-6">
                <p class="footerbottom_right">Design and Development by <a class="text-form-style_2" target="_blank" href="http://qwerty.uz">QWERTY</a> </p>
            </div>
        </div>
    </div>
</div>


