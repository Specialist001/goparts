<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Query */

$this->title = 'Create Query';
$this->params['breadcrumbs'][] = ['label' => 'Queries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container pt-3 mb-5">
    <div class="row">
    <?php if (!Yii::$app->user->isGuest) { ?>
        <div class="col-md-3">
            <?= $this->render('//user/_usermenu.php') ?>
        </div>
    <?php } ?>

    <div class="query-create col">

        <h2><?= Html::encode($this->title) ?></h2>

        <?= $this->render('_form', [
            'model' => $model,
            'cats' => $cats,
            'category' => $category,
            'car_id' => $car_id,
            'fuel_array' => $fuel_array,
            'transmissions_array' => $transmissions_array,
            'engines_array' => $engines_array,
        ]) ?>

    </div>
    </div>
</div>
