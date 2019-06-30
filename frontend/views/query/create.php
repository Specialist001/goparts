<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Query */

$this->title = 'LEAVE ORDER';
$this->params['breadcrumbs'][] = ['label' => 'Queries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php //if (!Yii::$app->user->isGuest) { ?>
<!--    <div class="col-md-3">-->
<!--        --><?//= $this->render('//user/_usermenu.php') ?>
<!--    </div>-->
<?php //} ?>
<div class="container pt-3 mb-5">
    <div class="row">

    <div class="query-create col">

        <h2 class="text-center text-form-style_2 font-weight-bold"><?= Html::encode($this->title) ?></h2>
        <h5 class="text-center pt-2">And get prices from more than 1000s shops.</h5>

        <?= $this->render('_form', [
            'model' => $model,
            'cats' => $cats,
            'category' => $category,
            'car_id' => $car_id,
            'fuel_array' => $fuel_array,
            'transmissions_array' => $transmissions_array,
            'engines_array' => $engines_array,
            'drive_array' => $drive_array,
        ]) ?>

    </div>
    </div>
</div>
