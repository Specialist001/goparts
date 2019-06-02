<?php
/**
 * Created by ru.lexcorp.
 * User: lexcorp
 * Date: 18.09.2017
 * Time: 6:08
 */
namespace frontend\widgets;
use common\models\StaticPageCategory;
use yii\bootstrap\Widget;

class WStaticPage extends Widget
{
    public function init(){}

    public function run() {
        return $this->render('static-page/view', [
            'static_page_cats' => StaticPageCategory::getActive()
        ]);
    }
}