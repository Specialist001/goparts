<?php
use common\models\Category;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;

/**
 * Created by ru.lexcorp.
 * User: lexcorp
 * Date: 20.09.2017
 * Time: 4:09
 */

function recursiveLeftCatMenu($menu, $parent = 0)
{
    $active_ids = [];
    $root_cat = Category::findOne(Yii::$app->session->get('active_category'));

    while ($root_cat) {
        $active_ids[] = $root_cat->id;
        if (empty($root_cat->parent)) break;
        $root_cat = $root_cat->parent;
    }
    $active_ids = array_reverse($active_ids);
    $result = '<ul class="list-unstyled">';
    $class = '';
    $link = 'lcm-subLink';
    if ($parent == 0) {
        $result .= '<li class="lcm-menu-title text-secondary"><strong>' . Yii::t('frontend', 'Product catalogue')
            . '</strong>' . FA::i('folder-open')->addCssClass('pull-right text-muted') . '
        </li>';
        $class = 'lcm-title';
        $link = 'lcm-link';
    }
    for ($s = 0; $s < count($menu); $s++) {
        $fa = '';
        $img = $menu[$s]->icon? '<img src="'.$menu[$s]->icon.'" alt="'.$s.'" class="cat_icon"> ': '';
        $title = $menu[$s]->translate->name;
        if ($menu[$s]->activeCategories) {
            if ($active_ids[$parent] == $menu[$s]->id) $fa = FA::i('angle-up')->addCssClass('pull-right');
            else $fa = FA::i('angle-down')->addCssClass('pull-right');
        }
        if ($active_ids[$parent] == $menu[$s]->id) {
            $title = '<strong>' . $title . '</strong>';
        }
        $result .= '<li class="'.$class.'">
                        <a href="' . Url::to(['category/index', 'id' => $menu[$s]->url]) . '" class="'.$link.'">
                        ' . $title . '
                        ' . $fa . '
                        </a>';
        if ($active_ids[$parent] == $menu[$s]->id) {
            $result .= recursiveLeftCatMenu($menu[$s]->activeCategories, ($parent + 1));
        }
        $result .= '</li>';
    }

    $result .= '</ul>';
    return $result;
}

?>
<div id="left-category-menu">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle leftbar-toggle collapsed btn-secondary" data-toggle="collapse"
                data-target="#left-menu" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span><?=FA::i('bars')?> <?= Yii::t('frontend', 'Product catalogue') ?></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" style="padding: 0;" id="left-menu">
        <div class="white-block">
            <?= recursiveLeftCatMenu($menu) ?>
        </div>
    </div>
</div>