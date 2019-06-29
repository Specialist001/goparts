<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Html::encode($page->translate->title);

$this->registerMetaTag([
    'name' => 'description',
    'content' => Html::encode(strip_tags($page->translate->description)),
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => Html::encode(strip_tags($page->translate->keywords)),
]);
?>
<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-header text-center">
                <strong><?= $this->title ?></strong>
            </h3>
        </div>
        <div class="col-md-12">
            <div class="news_body">
                <?= $page->translate->body ?>
            </div>
        </div>
    </div>
</div>
