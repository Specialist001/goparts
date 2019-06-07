<?php
/**
 * Created by ru.lexcorp.
 * User: lexcorp
 * Date: 20.09.2017
 * Time: 4:09
 */
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<section class="widgetform">
    <div class="container">
        <form method="GET" class="widgetform_form">
            <div class="widgetform_catalog">
                <span>Catalog</span>
                <a class="float-md-right" href="#"><img src="svg/Catalog.svg" alt=""></a>
            </div>
            <div class="widgetform_make">
                <a href="#">
                    <span>Select Make</span>
                    <?= FA::i('angle-down') ?>
                </a>
            </div>
            <div class="widgetform_model">
                <a href="#">
                    <span>Select Model</span>
                    <?= FA::i('angle-down') ?>
                </a>
            </div>
            <div class="widgetform_generation">
                <a href="#">
                    <span>Select a Generation</span>
                    <?= FA::i('angle-down') ?>
                </a>
            </div>
            <div class="widgetform_button">
                <button class="button"><img src="svg/search.svg" alt=""> <span>Search</span></button>
            </div>
        </form>
    </div>
</section>
