<?php

use common\models\Query;
use mdm\admin\components\Helper;
use yii\helpers\Url;

$queries = Query::find()->all();
$new_queries = 0;
$all_queries = 0;
foreach ($queries as $query) {
    $all_queries++;
    if ($query->status == 0) {
        $new_queries++;
    }
}
$counter['all_queries'] = $all_queries;
$counter['new_queries'] = $new_queries;

$orders = \common\models\StoreOrder::find()->all();
$new_orders = 0;
$all_orders = 0;
foreach ($orders as $order) {
    $all_orders++;
    if ($order->status == 1) {
        $new_orders++;
    }
}
$counter['all_orders'] = $all_orders;
$counter['new_orders'] = $new_orders;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->


        <?php  $auth = Yii::$app->getAuthManager(); ?>
        <?php if ($auth->checkAccess(Yii::$app->user->getId(), 'superAdminAccess')) { ?>

            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Main Menu</li>
                <li class="active"><a href="<?= Url::to(['/user'])?>"><i class="la la-user"></i> Users</a></li>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-universal-access"></i><span>RBAC</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/rbac/route']) ?>"><i class="fa fa-check-square-o"></i> Routes</a></li>
                        <li><a href="<?= Url::to(['/rbac/permission']) ?>"><i class="fa fa-plus-square-o"></i> Permissions</a></li>
                        <li><a href="<?= Url::to(['/rbac/menu']) ?>"><i class="fa fa-list"></i> Menu</a></li>
                        <li><a href="<?= Url::to(['/rbac/assignment']) ?>"><i class="fa fa-exchange"></i> Assignment</a></li>
                        <li><a href="<?= Url::to(['/rbac/role']) ?>"><i class="fa fa-exchange"></i> Role</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="<?= Url::to(['/query'])?>"><i class="la la-edit"></i>
                        <span>Queries</span>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-green">
                                <?= $counter['all_queries'] ?>
                            </small>
                            <small class="label pull-right bg-yellow">
                                <?= $counter['new_queries'] ?>
                            </small>
                        </span>
                    </a>
                </li>
                <li class="treeview ">
                    <a href="#">
                        <i class="la la-list-ul"></i><span> Orders</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>

                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/store-order']) ?>"><i class="fa fa-list"></i> All Orders
                                <span class="pull-right-container">
                                <small class="label pull-right bg-green">
                                    <?= $counter['all_orders'] ?>
                                </small>
                                <small class="label pull-right bg-yellow">
                                    <?= $counter['new_orders'] ?>
                                </small>
                            </span></a></li>
                        <?php if ($auth->checkAccess(Yii::$app->user->getId(), 'adminAccess')) { ?>
                        <li><a href="<?= Url::to(['/store-order/create']) ?>"><i class="fa fa-plus"></i> Create Order</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if ($auth->checkAccess(Yii::$app->user->getId(), 'managerAccess')) { ?>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i><span> News</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/news']) ?>"><i class="fa fa-list"></i> All News</a></li>
                        <li><a href="<?= Url::to(['/news/create']) ?>"><i class="fa fa-plus"></i> Create News</a></li>
                    </ul>
                </li>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-rss"></i><span> Blog</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/blog']) ?>"><i class="fa fa-list"></i> All Blogs</a></li>
                        <li><a href="<?= Url::to(['/blog/create']) ?>"><i class="fa fa-plus"></i> Create Blog</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-list"></i><span> Categories</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/store-category']) ?>"><i class="fa fa-list"></i> All Categories</a></li>
                        <li><a href="<?= Url::to(['/store-category/create']) ?>"><i class="fa fa-plus"></i> Create Category</a></li>
                    </ul>
                </li>
                <?php if ($auth->checkAccess(Yii::$app->user->getId(), 'managerAccess')) { ?>
                <li class="treeview ">
                    <a href="#">
                        <i class="la la-shopping-cart"></i><span> Products</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/store-product']) ?>"><i class="fa fa-list"></i> All Products</a></li>
                        <?php if ($auth->checkAccess(Yii::$app->user->getId(), 'superAdminAccess')) { ?>
                        <li><a href="<?= Url::to(['/store-product/create']) ?>"><i class="fa fa-plus"></i> Create Product</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-car"></i><span> Cars</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/car']) ?>"><i class="fa fa-list"></i> All Cars</a></li>
                        <li><a href="<?= Url::to(['/car/create']) ?>"><i class="fa fa-plus"></i> Create Car</a></li>
                    </ul>
                </li>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-car"></i><span> Type of Cars</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/store-type-car']) ?>"><i class="fa fa-list"></i> All Type of Cars</a></li>
                        <li><a href="<?= Url::to(['/store-type-car/create']) ?>"><i class="fa fa-plus"></i> Create Type Car</a></li>
                    </ul>
                </li>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-car"></i><span> Store Options</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/store-option']) ?>"><i class="fa fa-list"></i> All Options</a></li>
                        <li><a href="<?= Url::to(['/store-option/create']) ?>"><i class="fa fa-plus"></i> Create Option</a></li>
                    </ul>
                </li>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-car"></i><span> Store Option Values</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/store-option-value']) ?>"><i class="fa fa-list"></i> All Option Values</a></li>
                        <li><a href="<?= Url::to(['/store-option-value/create']) ?>"><i class="fa fa-plus"></i> Create Value</a></li>
                    </ul>
                </li>
                <?php if ($auth->checkAccess(Yii::$app->user->getId(), 'managerAccess')) { ?>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-globe"></i><span> Cities</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/city']) ?>"><i class="fa fa-list"></i> All Cities</a></li>
                        <?php if ($auth->checkAccess(Yii::$app->user->getId(), 'superAdminAccess')) { ?>
                        <li><a href="<?= Url::to(['/city/create']) ?>"><i class="fa fa-plus"></i> Create City</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-globe"></i><span> Stocks</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/stock']) ?>"><i class="fa fa-list"></i> All Stocks</a></li>
                        <?php if ($auth->checkAccess(Yii::$app->user->getId(), 'superAdminAccess')) { ?>
                        <li><a href="<?= Url::to(['/stock/create']) ?>"><i class="fa fa-plus"></i> Create Stock</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-globe"></i><span> Commissions</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/store-commission']) ?>"><i class="fa fa-list"></i> All Commissions</a></li>
                        <li><a href="<?= Url::to(['/store-commission/create']) ?>"><i class="fa fa-plus"></i> Create Commission</a></li>
                    </ul>
                </li>

            </ul>



        <?php } ?>



    </section>

</aside>
