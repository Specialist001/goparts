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
                    <div class="col-6 footer_left_div1">
                        <h3>Services</h3>
                        <ul>
                            <li><a href="#">Sell</a></li>
                            <li><a href="#">Buy</a></li>
                            <li><a href="#">Search</a></li>
                        </ul>
                    </div>
                    <div class="col-6 footer_left_div2">
                        <h3>Company</h3>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Knowledgae base</a></li>
                            <li><a href="#">Story</a></li>
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Contact Us</a></li>
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
                        <p>You can pay by bank cards</p>
                        <img src="/img/visa.png" alt="">
                        <img src="/img/mastercard.png" alt="">
                    </div>
                    <div class="col-md-6 footer_left_div4">
                        <h3>Contact with Us</h3>
                        <input type="email" name="email" placeholder="Enter email" class="footer_left_div4_input">
                        <input type="button" name="button" value="Send" class="footer_left_div4_button">
                        <div class="footer_rightblock">
                            <div class="rightblock_div1">
                                <img src="/img/wallet.png" alt="">
                                <a href="#">Payment</a>
                            </div>
                            <div class="rightblock_div2">
                                <img src="/img/develry.png" alt="">
                                <a href="#">Delivery</a>
                            </div>
                            <div class="rightblock_div3">
                                <ul>
                                    <li><a href="#"><?= FA::i('vk') ?></a></li>
                                    <li><a href="#"><?= FA::i('odnoklassniki') ?></a></li>
                                    <li><a href="#"><?= FA::i('youtube-play') ?></a></li>
                                    <li><a href="#"><?= FA::i('twitter') ?></a></li>
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
                <p>© 2019  Services provided by <span>UAEparts</span></p>
            </div>
            <div class="col-md-6">
                <p class="footerbottom_right">Design and Development by QWERTY</p>
            </div>
        </div>
    </div>
</div>


