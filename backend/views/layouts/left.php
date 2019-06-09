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
                <input type="text" name="q" class="form-control" placeholder="Поиск..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'All users', 'icon' => 'users', 'url' => ['/user'],],
                    [
                        'label' => 'RBAC',
                        'icon' => 'universal-access',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Routes', 'icon' => 'check-square-o', 'url' => ['/rbac/route'],],
                            ['label' => 'Permissions', 'icon' => 'plus-square-o', 'url' => ['/rbac/permission'],],
                            ['label' => 'Menus', 'icon' => 'list', 'url' => ['/rbac/menu'],],
                            ['label' => 'Assignment', 'icon' => 'exchange', 'url' => ['/rbac/assignment'],],
                            ['label' => 'Roles', 'icon' => 'exchange', 'url' => ['/rbac/role'],],
                        ]
                    ],
					['label' => 'News', 'icon' => 'newspaper-o', 'url' => ['#'],
                        'items' => [
                            ['label' => 'All News', 'icon' => 'list', 'url' => ['/news'],],
                            ['label' => 'Create News', 'icon' => 'plus', 'url' => ['/news/create'],],
                        ],
                    ],
					['label' => 'Blog', 'icon' => 'rss', 'url' => ['#'],
                        'items' => [
                            ['label' => 'All Blogs', 'icon' => 'list', 'url' => ['/blog'],],
                            ['label' => 'Create Blog', 'icon' => 'plus', 'url' => ['/blog/create'],],
                        ],
                    ],
                    ['label' => 'Store Category', 'icon' => 'list', 'url' => ['#'],
                        'items' => [
                            ['label' => 'All Categories', 'icon' => 'list', 'url' => ['/store-category'],],
                            ['label' => 'Create Category', 'icon' => 'plus', 'url' => ['/store-category/create'],],
                        ],
                    ],
                    ['label' => 'Products', 'icon' => '', 'url' => ['#'],
                        'items' => [
                            ['label' => 'All Products', 'icon' => 'list', 'url' => ['/store-product'],],
                            ['label' => 'Create Product', 'icon' => 'plus', 'url' => ['/store-product/create'],],
                        ],
                    ],
                    ['label' => 'Cars', 'icon' => 'car', 'url' => ['#'],
                        'items' => [
                            ['label' => 'All Cars', 'icon' => 'list', 'url' => ['/car'],],
                            ['label' => 'Create Car', 'icon' => 'plus', 'url' => ['/car/create'],],
                        ],
                    ],
                    ['label' => 'Type of Cars', 'icon' => 'car', 'url' => ['#'],
                        'items' => [
                            ['label' => 'All Types', 'icon' => 'list', 'url' => ['/store-type-car'],],
                            ['label' => 'Create Type', 'icon' => 'plus', 'url' => ['/store-type-car/create'],],
                        ],
                    ],
                    ['label' => 'Store Attribute', 'icon' => 'car', 'url' => ['#'],
                        'items' => [
                            ['label' => 'All Attributes', 'icon' => 'list', 'url' => ['/store-attribute'],],
                            ['label' => 'Create Attribute', 'icon' => 'plus', 'url' => ['/store-attribute/create'],],
                        ],
                    ],
                    ['label' => 'Store Type', 'icon' => 'list', 'url' => ['#'],
                        'items' => [
                            ['label' => 'All Types', 'icon' => 'list', 'url' => ['/store-type'],],
                            ['label' => 'Create Type', 'icon' => 'plus', 'url' => ['/store-type/create'],],
                        ],
                    ],
                    ['label' => 'Store Attribute Option', 'icon' => 'list', 'url' => ['#'],
                        'items' => [
                            ['label' => 'All Attribute Options', 'icon' => 'list', 'url' => ['/store-attribute-option'],],
                            ['label' => 'Create Attribute Option', 'icon' => 'plus', 'url' => ['/store-attribute-option/create'],],
                        ],
                    ],
                    ['label' => 'Cities', 'icon' => 'globe', 'url' => ['#'],
                        'items' => [
                            ['label' => 'All Cities', 'icon' => 'list', 'url' => ['/city'],],
                            ['label' => 'Create City', 'icon' => 'plus', 'url' => ['/city/create'],],
                        ],
                    ],
                    ['label' => 'Stocks', 'icon' => 'globe', 'url' => ['#'],
                        'items' => [
                            ['label' => 'All Stocks', 'icon' => 'list', 'url' => ['/stock'],],
                            ['label' => 'Create Stock', 'icon' => 'plus', 'url' => ['/stock/create'],],
                        ],
                    ],
             
//                    ['label' => 'Отчеты', 'icon' => 'flag', 'url' => ['/report'],],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
