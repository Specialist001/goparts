<?php
/**
 * Created by ru.lexcorp.
 * User: lexcorp
 * Date: 20.09.2017
 * Time: 4:09
 */
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

if (!empty($news)) {
    ?>
    <div class="row" style="margin: 0;">
        <div class="col-md-12" style="padding: 0;">
            <div class="page-header" style="padding: 0 0 12px 0;">
                <h4><?=Yii::t('frontend', 'News')?>
                    <small class="pull-right"><a href="<?=Url::to(['news/list'])?>"><?=Yii::t('frontend', 'All news')?></a></small>
                </h4>
                <div class="clearfix"></div>
            </div>
            <div class="white-block">
            <div class="row" style="margin: 0;">
            <?php for ($i = 0; $i < count($news); $i++) { ?>
                <div class="col-md-3 col-sm-6" style="padding: 0;">
                    <a href="<?=Url::to(['news/index', 'id' => $news[$i]->url])?>" class="product-link">
                        <div class="product-cart">
                            <img src="<?= $news[$i]->translate->image ?>"
                                 alt="<?= $news[$i]->translate->name ?>" class="img-responsive">
                            <p class="shell_news_title text-primary"><?= $news[$i]->translate->name ?></p>
                            <p class="shell_product_cat text-muted">
                                <?= date('d.m.Y', $news[$i]->created_at) ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php } ?>
            </div>
            </div>
        </div>
    </div>
<?php } ?>