<?php
//use frontend\widgets\WCarSearch;

use yii\helpers\Url;
use frontend\widgets\WQuery;

/* @var $this yii\web\View */
$this->title = Yii::$app->params['appName'];


?>

<?= WQuery::widget()?>

<section class="slider">
    <!-- Set up your HTML -->
    <div class="slider1">
        <div class="container">
            <div class="slider1_name">
                <h1>The Largest Online Store <br><span>for Used Spare Parts in U.A.E.</span></h1>
                <p>Daily users. Get more offers and opportunities<br> by registering to our webpage.</p>
                <a class="mt-2 text-center d-block d-md-inline-block" href="<?= Url::to(['signup'])?>">Register</a>
            </div>
        </div>
        <div class="slider1_img">
            <img src="img/car.png" alt="">
        </div>
        <div class="slider1_bg d-none"></div>
    </div>
<!--    <div class="owl-carousel owl-theme">-->
<!--        <div class="slider1">-->
<!--            <div class="container">-->
<!--                <div class="slider1_name">-->
<!--                    <h1>The Largest Online Store <br><span>for Used Spare Parts in U.A.E.</span></h1>-->
<!--                    <p>Daily users. Get more offers and opportunities<br> by registering to our webpage.</p>-->
<!--                    <a class="mt-2 text-center d-block d-md-inline-block" href="--><?//= Url::to(['signup'])?><!--">Register</a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="slider1_img">-->
<!--                <img src="img/car.png" alt="">-->
<!--            </div>-->
<!--            <div class="slider1_bg d-none"></div>-->
<!--        </div>-->
<!--        <div class="slider1">-->
<!--            <div class="container">-->
<!--                <div class="slider1_name">-->
<!--                    <h1>The Largest Online Store <br><span>for Used Spare Parts in U.A.E.</span></h1>-->
<!--                    <p>Daily users. Get more offers and opportunities<br> by registering to our webpage.</p>-->
<!--                    <a class="mt-2 text-center d-block d-md-inline-block" href="--><?//= Url::to(['signup'])?><!--">Register</a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="slider1_img">-->
<!--                <img src="img/car.png" alt="">-->
<!--            </div>-->
<!--            <div class="slider1_bg d-none"></div>-->
<!--        </div>-->
<!--    </div>-->
</section>

<section class="working">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="img/girl.png" alt="" class="working_girl">
            </div>
            <div class="col-md-8 working_top">
                <h3 class="pb-3 pb-md-0">Start working with us and <br><span>build your profitable business</span></h3>
                <p><span><strong>UAEPARTS</strong> is the largest online store in UAE,</span> that offers its customers the widest range of spare auto parts and accessories. With us you will have an option to purchase a product online and pay using our secure online payment system or you can pay upon receiving the product. We also offer an express delivery to any address throughout UAE, so the product is delivered to you as soon as possible.</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="working_list">
                            <h3 class="py-3 py-md-0"><span>Our</span> Advantages</h3>
                            <div class="working_list_item">
                                <p>Widest range of auto spare parts</p>
                                <p>Detailed information about the product</p>
                                <img src="img/ok.png" alt="">
                            </div>
                            <div class="working_list_item">
                                <p>Leave us an order and get prices from more</p>
                                <p>than 1000s of shops.</p>
                                <img src="img/ok.png" alt="">
                            </div>
                            <div class="working_list_item">
                                <p>Convenient multiple payment options</p>
                                <p>Express delivery</p>
                                <img src="img/ok.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 working_right pt-3 pt-md-0">
                        <p>In addition, <span>download our APP</span> and make your business better </p>
                        <p><a href="#"><img src="img/google.png"></a><a href="#"><img src="img/store.png"></a></p>
                        <a class="reg_btn" href="<?= Url::to(['signup'])?>">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>