<?php

use common\models\Query;
use common\models\SellerQuery;
use mdm\admin\components\Helper;
use yii\helpers\Url;

$queries = Query::find();
$counter['all_queries'] = $queries->where([])->count();
$counter['new_queries'] = $queries->where(['status'=>Query::STATUS_MODERATED])->count();

$requests = SellerQuery::find();
$counter['all_requests'] = $requests->count();
$counter['new_requests'] = $requests->where(['status'=>SellerQuery::STATUS_WAITED])->count();
$counter['moderated_requests'] = $requests->where(['status'=>SellerQuery::STATUS_MODERATE])->count();
$counter['published_requests'] = $requests->where(['status'=>SellerQuery::STATUS_PUBLISHED])->count();
$counter['purchased_requests'] = $requests->where(['status'=>SellerQuery::STATUS_PURCHASED])->count();

$orders = \common\models\StoreOrder::find();
$counter['all_orders'] = $orders->count();
$counter['new_orders'] = $orders->where(['status'=>1])->count();

$users = \common\models\User::find();
$counter['sellers'] = $users->where(['role'=>\common\models\User::ROLE_SELLER])->count();
$counter['new_sellers'] = $users->where(['role'=>\common\models\User::ROLE_SELLER,'status'=>\common\models\User::STATUS_INACTIVE])->count();

$counter['buyers'] = $users->where(['role'=>\common\models\User::ROLE_BUYER])->count();
$counter['new_buyers'] = $users->where(['role'=>\common\models\User::ROLE_BUYER,'status'=>\common\models\User::STATUS_INACTIVE])->count();

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
<!--                <li class="active"><a href="--><?//= Url::to(['/user'])?><!--"><i class="la la-user"></i> Users</a></li>-->
                <li class="treeview ">
                    <a href="#">
                        <i class="la la-user"></i><span> Users</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/user']) ?>"><i class="la la-user"></i> All users</a></li>
                        <li class="treeview">
                            <a href="#"><i class="la la-shopping-cart"></i> Sellers
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?= Url::to(['/user','UserSearch[role]'=>1]) ?>"><i class="la la-shopping-cart"></i> All Sellers
                                        <span class="pull-right-container">
                                            <small class="label pull-right bg-green">
                                                <?= $counter['sellers'] ?>
                                            </small>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/user','UserSearch[status]'=>9,'UserSearch[role]'=>1]) ?>"><i class="la la-shopping-cart"></i> New Sellers
                                        <span class="pull-right-container">
                                            <small class="label pull-right bg-aqua">
                                                <?= $counter['new_sellers'] ?>
                                            </small>
                                        </span>
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <li class="treeview">
                            <a href="#"><i class="la la-cart-arrow-down"></i> Buyers
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?= Url::to(['/user','UserSearch[role]'=>0]) ?>"><i class="la la-cart-arrow-down"></i> All Buyers
                                        <span class="pull-right-container">
                                            <small class="label pull-right bg-green">
                                                <?= $counter['buyers'] ?>
                                            </small>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/user','UserSearch[status]'=>9, 'UserSearch[role]'=>0]) ?>"><i class="la la-cart-arrow-down"></i> New Buyers
                                        <span class="pull-right-container">
                                            <small class="label pull-right bg-aqua">
                                                <?= $counter['new_buyers'] ?>
                                            </small>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
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
                <li class="treeview">
                    <a href="#">
                        <i class="la la-edit"></i><span> Queries</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?= Url::to(['/query']) ?>"><i class="la la-edit"></i> All Queries
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-aqua">
                                        <?= $counter['all_queries'] ?>
                                    </small>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['/query', 'QuerySearch[status]'=>0,'sort'=>'-id']) ?>"><i class="la la-edit"></i> New Queries
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-green">
                                        <?= $counter['new_queries'] ?>
                                    </small>
                                </span>
                            </a>
                        </li>
                    </ul>

<!--                    <a href="--><?//= Url::to(['/query'])?><!--"><i class="la la-edit"></i>-->
<!--                        <span>Queries</span>-->
<!--                        <span class="pull-right-container">-->
<!--                            <small class="label pull-right bg-green">-->
<!--                                --><?//= $counter['all_queries'] ?>
<!--                            </small>-->
<!--                            <small class="label pull-right bg-yellow">-->
<!--                                --><?//= $counter['new_queries'] ?>
<!--                            </small>-->
<!--                        </span>-->
<!--                    </a>-->
                </li>
                <li class="treeview">
                    <a href="#"><i class="la la-edit"></i>
                        <span>Requests</span>
                        <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
<!--                    <a href="#">-->
<!--                        <i class="la la-edit"></i><span> Queries</span>-->
<!--                        <span class="pull-right-container">-->
<!--                            <i class="fa fa-angle-left pull-right"></i>-->
<!--                        </span>-->
<!--                    </a>-->
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?= Url::to(['/seller-query'])?>"><i class="la la-edit"></i> All Requests
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-aqua">
                                        <?= $counter['all_queries'] ?>
                                    </small>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['/seller-query', 'SellerQuerySearch[status]'=>1,'sort'=>'-id']) ?>"><i class="la la-edit"></i> New Requests
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-green">
                                        <?= $counter['moderated_requests'] ?>
                                    </small>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview ">
                    <a href="#">
                        <i class="la la-list-ul"></i>
                        <span>Orders</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>

                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?= Url::to(['/store-order','sort'=>'-id']) ?>"><i class="fa fa-list"></i> All Orders
                                <span class="pull-right-container">
                                <small class="label pull-right bg-aqua">
                                    <?= $counter['all_orders'] ?>
                                </small>
                            </span></a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['/store-order', 'StoreOrderSearch[status]'=>1,'sort'=>'-id']) ?>"><i class="la la-edit"></i> New Orders
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-green">
                                        <?= $counter['new_orders'] ?>
                                    </small>
                                </span>
                            </a>
                        </li>
<!--                        --><?php //if ($auth->checkAccess(Yii::$app->user->getId(), 'adminAccess')) { ?>
<!--                        <li><a href="--><?//= Url::to(['/store-order/create']) ?><!--"><i class="fa fa-plus"></i> Create Order</a></li>-->
<!--                        --><?php //} ?>
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
                    <li class="treeview ">
                    <a href="#">
                        <i class="la la-file-o"></i><span> Pages</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/page']) ?>"><i class="fa fa-list"></i> All Pages</a></li>
                        <li><a href="<?= Url::to(['/page/create']) ?>"><i class="fa fa-plus"></i> Create Page</a></li>
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
