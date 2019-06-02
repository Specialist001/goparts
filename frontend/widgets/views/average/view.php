<?php

use common\models\Category;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

if (!empty($category_array)) { ?>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-6 col-md-6" style="background-color: #fefefe;">
                <div class="col-md-12">
                    <div class="page-header product-widget-header">
                        <?= Yii::t('frontend', 'Average food prices') ?>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?= Yii::t('frontend', 'Title') ?></th>
                            <th><?= Yii::t('frontend', 'Average price') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($category_array as $category) { ?>
                        <tr>
                            <td>
                                <?= $category['id'] ?>
                            </td>
                            <td>
                                <a href="<?= Url::to(['category/index', 'id' => $category['url']]) ?>">
                                    <?= $category['name'] ?>
                                </a>
                            </td>
                            <td>
                                <?= $category['sum'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php } else {
    echo 'NULL';
} ?>