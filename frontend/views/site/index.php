<?php
//use frontend\widgets\WCarSearch;

use yii\helpers\Url;
use frontend\widgets\WQuery;

/* @var $this yii\web\View */
$this->title = Yii::$app->params['appName'];
$popUp = false;
if (Yii::$app->request->get('new_query') == 'send'){
    $popUp = true;
}

?>

<?= WQuery::widget()?>

<section class="slider">
    <!-- Set up your HTML -->
    <div class="slider1">
        <div class="container">
            <div class="slider1_name">
                <h1><?= Yii::t('frontend', 'Slogan') ?> <br><span><?= Yii::t('frontend', 'Slogan Short') ?></span></h1>
                <p><?= Yii::t('frontend', 'Slogan Text') ?></p>
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
                <h3 class="pb-3 pb-md-0"><?= Yii::t('frontend', 'Slogan_2') ?> <br><span><?= Yii::t('frontend', 'Slogan_2 short') ?></span></h3>
                <p><?= Yii::t('frontend', 'Slogan_2 text') ?></p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="working_list">
                            <h3 class="py-3 py-md-0"><span>Our</span> Advantages</h3>
                            <div class="working_list_item">
                                <?= Yii::t('frontend', 'Slogan_2 child_1') ?>
                                <img src="img/ok.png" alt="">
                            </div>
                            <div class="working_list_item">
                                <?= Yii::t('frontend', 'Slogan_2 child_2') ?>
                                <img src="img/ok.png" alt="">
                            </div>
                            <div class="working_list_item">
                                <?= Yii::t('frontend', 'Slogan_2 child_3') ?>
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

<div class="modal fade" id="queryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title ml-auto">Thank you!</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Dear sir. Thank you for leaving us order.</p>
                <p class="mb-0"> You will get best prices from more than 1000s used spare part stores within 24 hours.</p>
                <p> You will be notified to your email you have provided us.</p>
            </div>
            <div class="modal-footer">
<!--                <button type="button" class="btn btn-primary">Save changes</button>-->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
    if($popUp == true) {
        $this->registerJs('$(\'#queryModal\').modal(\'show\');');
    }
?>