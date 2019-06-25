<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$userLink = Yii::$app->urlManager->createAbsoluteUrl(['user/purchases']);
$shopLink = Yii::$app->urlManager->createAbsoluteUrl(['user/purchases']);
?>
<?php if($type == 'buyer') { ?>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 2px 4px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Your request(s)</h3><br>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Car</th>
                        <th>Fueltype</th>
                        <th>Engine</th>
                        <th>Transmission</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($parts as $part) { ?>
                        <tr>
                            <td><?=$part['id'] ?></td>
                            <td><?=$part['title'] ?></td>
                            <td><?=$part['car'] ?></td>
                            <td><?=$part['fueltype'] ?></td>
                            <td><?=$part['engine'] ?></td>
                            <td><?=$part['transmission'] ?></td>
                        </tr>
                    <?php $name = $part['name']; $phone = $part['phone']; $email = $part['email'];
                    } ?>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="col-md-12">
                <div>Name: <?= $name ?></div>
                <div>E-mail: <?= $email ?></div>
                <div>Phone: <?= $phone ?></div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($type == 'buyer1') { ?>
    <div>
        Your request added to system
    </div>
<?php } ?>
