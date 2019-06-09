<?php
use frontend\widgets\WCarSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';


?>

<?= WCarSearch::widget()?>

<section class="slider">
    <!-- Set up your HTML -->
    <div class="owl-carousel owl-theme">
        <div class="slider1">
            <div class="container">
                <div class="slider1_name">
                    <h1>The single web portal <br><span>of selling auto parts</span></h1>
                    <p>Find or sell car parts, spare parts, find out about your fines<br> and pay online with a cashback <span>up to 5%</span></p>
                    <a href="<?= Url::to(['signup'])?>">Registration</a>
                </div>
            </div>
            <div class="slider1_img">
                <img src="img/car.png" alt="">
            </div>
            <div class="slider1_bg"></div>
        </div>
        <div class="slider1">
            <div class="container">
                <div class="slider1_name">
                    <h1>The single web portal <br><span>of selling auto parts</span></h1>
                    <p>Find or sell car parts, spare parts, find out about your fines<br> and pay online with a cashback <span>up to 5%</span></p>
                    <a href="<?= Url::to(['signup'])?>">Registration</a>
                </div>
            </div>
            <div class="slider1_img">
                <img src="img/car.png" alt="">
            </div>
            <div class="slider1_bg"></div>
        </div>
    </div>
</section>

<section class="working">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="img/girl.png" alt="" class="working_girl">
            </div>
            <div class="col-md-8 working_top">
                <h3>Start working with us and <br><span>build your profitable business</span></h3>
                <p><span><strong>UAEPARTS</strong> is the largest online store in UAE,</span> that offers its customers the widest range of spare auto parts and accessories. With us you will have an option to purchase a product online and pay using our secure online payment system or you can pay upon receiving the product. We also offer an express delivery to any address throughout UAE, so the product is delivered to you as soon as possible.</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="working_list">
                            <div class="working_list_item">
                                <p>Widest range of auto spare parts</p>
                                <p>Detailed information about the product</p>
                                <img src="img/ok.png" alt="">
                            </div>
                            <div class="working_list_item">
                                <p>Fast and easy way to search a product</p>
                                <p>Daily update of products</p>
                                <img src="img/ok.png" alt="">
                            </div>
                            <div class="working_list_item">
                                <p>Convenient multiple payment options</p>
                                <p>Express delivery</p>
                                <img src="img/ok.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 working_right">
                        <h3><span>Our</span> Advantages</h3>
                        <p>In addition, <span>download our APP</span> and make your business better </p>
                        <p><a href="#"><img src="img/google.png"></a><a href="#"><img src="img/store.png"></a></p>
                        <button href="<?php Url::to(['signup'])?>">Registration</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>