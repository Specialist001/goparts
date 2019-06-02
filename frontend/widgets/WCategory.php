<?php
/**
 * Created by ru.lexcorp.
 * User: lexcorp
 * Date: 18.09.2017
 * Time: 6:08
 */
namespace frontend\widgets;
use common\models\Category;
use common\models\Language;
use Yii;
use yii\bootstrap\Widget;

class WCategory extends Widget
{
    public $key;
    public $tab;
    public function init(){}

    public function run() {
        if($this->key == 'menu') {
            return $this->render('category/view', [
                'menu' => Category::find()->where(['status' => 1, 'parent_id' => null])->orderBy('order')->all()
            ]);
        }
        if($this->key == 'preview') {
            return $this->render('category/preview', [
                'menu' => Category::find()->where(['status' => 1, 'on_main' => 1])->orderBy('order')->all()
            ]);
        }
        if($this->key == 'main') {
            $lang = Language::getCurrent()->local;
            $menu_main = Yii::$app->cache->get('menu_main_'.$lang);

            if($menu_main === false) {
                $menu_main = Category::find()->with('activeCategories')->with('translate')->where(['status' => 1, 'parent_id' => null])->orderBy('order')->all();
                Yii::$app->cache->set('menu_main_'.$lang, $menu_main);
            }

            $menu_main_render = Yii::$app->cache->get('menu_main_render_'.$lang);

            if($menu_main_render === false) {
                $menu_main_render =  $this->render('category/main', [
                    'menu' => $menu_main,
                    'tab' => $this->tab
                ]);
                Yii::$app->cache->set('menu_main_render_'.$lang, $menu_main_render);
            }
            return $menu_main_render;

        }
    }
}