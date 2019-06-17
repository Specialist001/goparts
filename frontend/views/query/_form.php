<?php

use common\models\Cars;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$model->category_id = $category->id;

if (!empty($model->car_id)) {
    $car = Cars::findOne(['id' => $model->car_id]);

    $car_name = $car->vendor . ' ' . $car->car . ' ' . $car->modification . ' ' . $car->year;
    echo $car_name;
    if (!empty(Yii::$app->request->get('vendor'))) {
        $vendor_name = Yii::$app->request->get('vendor');
    } else {
        $vendor_name = $car->vendor;
    }
    if (!empty(Yii::$app->request->get('car'))) {
        $model_name = Yii::$app->request->get('car');
    } else {
        $model_name = $car->car;
    }
    if (!empty(Yii::$app->request->get('modification'))) {
        $modification_name = Yii::$app->request->get('modification');
    } else {
        $modification_name = $car->modification;
    }
    if (!empty(Yii::$app->request->get('year'))) {
        $year_name = Yii::$app->request->get('year');
    } else {
        $year_name = $car->year;
    }
} else {
    $car = Cars::findOne(['id' => Yii::$app->request->get('car_id')]);

    $vendor_name = $car->vendor;
    $model_name = $car->car;
    $modification_name = $car->modification;
    $year_name = $car->year;

    $car_id = $car->id;

    $car_name = $vendor_name . ' ' . $model_name . ' ' . $modification_name . ' ' . $year_name;
//print_r($car_name);
}

$cars_array = Cars::getVendors();
//$models_array = Cars::getCar(Yii::$app->request->get('vendor')) ? Cars::getCar(Yii::$app->request->get('vendor')) : (Cars::getCar($vendor_name) ? Cars::getCar($vendor_name) : null);
$models_array = Cars::getCar(Yii::$app->request->get('vendor'))
    ? Cars::getCar(Yii::$app->request->get('vendor'))
    : (Cars::getCar($vendor_name) ? Cars::getCar($vendor_name) : null);
$modifications_array =
    Cars::getModifications(Yii::$app->request->get('vendor'), Yii::$app->request->get('car'))
        ? Cars::getModifications(Yii::$app->request->get('vendor'), Yii::$app->request->get('car'))
        : (Cars::getModifications($vendor_name, $model_name) ? Cars::getModifications($vendor_name, $model_name) : null);

$year_array =
    Cars::getYear(Yii::$app->request->get('vendor'), Yii::$app->request->get('car'), Yii::$app->request->get('modification'))
        ? Cars::getYear(Yii::$app->request->get('vendor'), Yii::$app->request->get('car'), Yii::$app->request->get('modification'))
        : (Cars::getYear($vendor_name, $model_name, $modification_name) ? Cars::getYear($vendor_name, $model_name, $modification_name) : null);
//print_r($models_array);

$cat_filter = [];
$type_car_filter = [];

if (!empty($cats)) {
    foreach ($cats as $cat) {
        $cat_filter += [$cat->id => $cat->translate->title];
    }
}

$mod_array = [];

if (!empty($modifications_array)) {
    foreach ($modifications_array as $key => $mod) {
        $mod_array[$key] = $key . ' (' . $mod['min'] . ' - ' . $mod['max'] . ')';
    }
}

if (!empty($type_cars)) {
    foreach ($type_cars as $type_car) {
//if ($model->id == $cat->id) continue;
        $type_car_filter[$type_car->id] = $type_car->translate->name;
        if ($type_car->typeCars) {
            $type_car_filter = ArrayHelper::merge($type_car_filter, getTypeCarCategoryChild($type_car->typeCars, $type_car));
        }
    }
}

function getTypeCarCategoryChild($cat, $model, $index = 1)
{
    $result = [];
    $prefix = '';
    for ($i = 0; $i < $index; $i++) {
        $prefix .= '-';
    }
    $style = false;
    if ($index == 1) $style = 'bold';
    foreach ($cat as $item) {
        if ($model->id == $item->id) continue;
        if ($style) $result[$item->id] = $prefix . $item->translate->name;
        else $result[$item->id] = $prefix . $item->translate->name;
        if ($item->typeCars) {
            $result = ArrayHelper::merge($result, getTypeCarCategoryChild($item->typeCars, $type_car, $index + 1));
        }
    }
    return $result;
}

?>

<div class="query-form pt-3">
    <!--        --><?php //if(!$car_id) {?>
    <!--            <form action="--><? //= Url::current()?><!--" id="car-form">-->
    <!--                -->
    <!--            </form>-->
    <!--        --><?php //}?>

    <?php if (!$category) { ?>
        <form action="<?= Url::current() ?>" id="cat-form">
            <h4>Select car</h4>
            <div class="row car_search">
                <div class="col-md-3">
                    <div class="position-relative">
                        <select class="form-control vendor_select" required>
                            <option disabled selected>Select Car</option>
                            <!--                        --><? //= Dropdown::widget(); ?>
                            <?php foreach ($cars_array as $vendor) { ?>
                                <option value="<?= $vendor ?>" <?= $vendor == $vendor_name ? 'selected' : '' ?>><?= $vendor ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative">
                        <select class="form-control car_items" required>
                            <option disabled selected>Select Model</option>

                            <?php if (!empty(Yii::$app->request->get('car_id')) || !empty($model->car_id)) { ?>
                                <?php foreach ($models_array as $car_model) { ?>
                                    <option value="<?= $car_model ?>" <?= $car_model == $model_name ? 'selected' : '' ?>><?= $car_model ?></option>
                                <?php } ?>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative">
                        <select class="form-control car_modifications" required>
                            <option disabled selected>Select Generation</option>
                            <?php if (!empty(Yii::$app->request->get('car_id')) || !empty($model->car_id)) { ?>
                                <?php foreach ($mod_array as $key => $car_modification) { ?>
                                    <option value="<?= $key ?>" <?= $key == $modification_name ? 'selected' : '' ?>> <?= $car_modification ?></option>
                                <?php } ?>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative">
                        <select class="form-control car_years" required>
                            <option disabled selected>Year</option>
                            <?php if (!empty(Yii::$app->request->get('car_id')) || !empty($model->car_id)) { ?>
                                <?php foreach ($year_array as $key => $car_year) { ?>
                                    <option value="<?= $key ?>" <?= $key == $year_name ? 'selected' : '' ?>> <?= $car_year ?></option>
                                <?php } ?>
                            <? } ?>
                        </select>
                    </div>
                </div>
            </div>
            <row>
                <div class="car_name" id="car_name">

                </div>
            </row>
            <input type="hidden" name="car_id" id="car_id" value="<?= Yii::$app->request->get('car_id') ?>"/>
            <?php if (!empty($prod_id = Yii::$app->request->get('id'))) { ?>
                <input type="hidden" name="id" value="<?= $prod_id ?>"/>
            <?php } ?>

            <div class="row pt-3">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label for="category_id">Select category</label>
                    </div>
                    <?php if (!empty($cats)) { ?>
                        <ul class="list-unstyled category-widget-list">
                            <?php foreach ($cats as $cat) { ?>
                                <li data-id="<?= $cat->id ?>"
                                    data-childs="<?= (!empty($cat->categories)) ? $cat->id : '' ?>"
                                    class="cat-widget-li"><?= $cat->translate->title ?></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                    <input type="text" name="category" id="category_id" value="" style="visibility: hidden;"/>
                    <?php if (!empty($prod_id = Yii::$app->request->get('id'))) { ?>
                        <input type="hidden" name="id" value="<?= $prod_id ?>"/>
                    <?php } ?>
                </div>
            </div>
        </form>
    <?php } else { ?>

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">

            <div class="col-md-4">
                <label>Category</label>
                <input type="text" readonly="readonly" id="category_id" class="form-control"
                       value="<?= $category->translate->title ?>"/>
                <a href="<?= Url::current(['category' => '']) ?>"
                   onclick="if(!confirm('Expected form to save. Cancel?'))return false;">Choose another category and
                    Car</a>
                <?= $form->field($model, 'category_id')->hiddenInput()->label(false) ?>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Car</label>
                    <input class="form-control" type="text"
                           value="<?= $car_name ?>" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <input type="hidden" name="vendor" value="<?= Yii::$app->request->get('vendor') ?>" readonly>
        <input type="hidden" name="car" value="<?= Yii::$app->request->get('car') ?>" readonly>
        <input type="hidden" name="modification" value="<?= Yii::$app->request->get('modification') ?>" readonly>
        <input type="hidden" name="year_name" value="<?= Yii::$app->request->get('year_name') ?>" readonly>

        <div class="row">

            <?= $form->field($model, 'car_id')->hiddenInput(['value' => Yii::$app->request->get('car_id')])->label(false) ?>
            <?= $form->field($model, 'vendor')->hiddenInput(['value' => $vendor_name])->label(false) ?>

            <?= $form->field($model, 'car')->hiddenInput(['value' => $model_name])->label(false) ?>

            <?= $form->field($model, 'modification')->hiddenInput(['value' => $modification_name])->label(false) ?>

            <?= $form->field($model, 'year')->hiddenInput(['value' => $year_name])->label(false) ?>

            <div class="col-md-3">
                <?= $form->field($model, 'fueltype')->dropDownList($fuel_array) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'engine')->dropDownList($engines_array) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'transmission')->dropDownList($transmissions_array) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'drivetype')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <h3 class="pt-3">Contacts</h3>
        <div class="row">

            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput(['value'=> Yii::$app->user->identity->username ? Yii::$app->user->identity->username : $model->name,'maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'phone')->textInput(['value'=> Yii::$app->user->identity->phone ? Yii::$app->user->identity->phone : $model->phone, 'maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'email')->textInput(['value'=> Yii::$app->user->identity->email ? Yii::$app->user->identity->email : $model->email,'maxlength' => true]) ?>
            </div>

            <!--        --><? //= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

            <!--        --><? //= $form->field($model, 'status')->textInput() ?>

            <?php $fileinput_options = ['accept' => 'image/*', 'multiple' => false];
            if ($model->image != '') {
                $fileinput_options = ['accept' => 'image/*', 'multiple' => false];
                ?>
                <img src="<? //= $model->image ?>" alt="<? //= $model->image ?>"
                     class="img-responsive"
                     style="width: 100px">
            <?php } ?>
            <!--        --><? //= $form->field($model, 'image')->widget(FileInput::classname(), [
            //            'options' => $fileinput_options,
            //            'pluginOptions' => [
            //                'showCaption' => false,
            //                'showRemove' => false,
            //                'showUpload' => false,
            //                'browseClass' => 'btn btn-primary',
            //                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            //                'browseLabel' => 'Select Image'
            //            ],
            //            'language' => 'en'
            //        ]); ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php } ?>

</div>
<?php $this->registerJs('
    $(document).ready(function() {
        $(\'select.form-control\').select2(
            {
                language: {
                  noResults: function () {
                    return "Ничего не найдено";
                  }
                }
            }
        );
    });
    $(document).on(\'ready pjax:success\', function() {
        $(\'select.form-control\').select2(
            {
                language: {
                  noResults: function () {
                    return "Ничего не найдено";
                  }
                }
            }
        );
    });
'); ?>
<script>

</script>

<?php //$this->registerJs('
//    $(document).ready(function() {
//        $(document).on(\'click\', \'.cat-widget-li\', function () {
//            id = $(this).data(\'id\');
//            has_childs = $(this).data(\'childs\');
//
//            li = $(this);
//            if(has_childs != \'\') {
//                $.ajax({
//                    url: "/site/get-cats",
//                    data: {\'id\': li.data(\'id\')}, //data: {}
//                    type: "get",
//                    success: function (t) {
//                        $(\'.category-widget-list\').html(t);
//                    }
//                });
//            }
//            else {
//                $(\'#category_id\').val(id);
//                $(\'#cat-form\').submit();
//            }
//        });
//    });
//    });
//
////        $(\'#add_cat_btn\').on(\'click\', function() {
////            $($(\'#add-cat-temp\').html()).appendTo($(\'#added_cats\'));
////            $(this).hide();
////            return false;
////        });
////        $(document).on(\'click\', \'.add_cat_delete\', function () {
////            $(this).parent().remove();
////            return false;
////        });
//            var title = [];
//        $(document).on(\'click\', \'.add-cat-widget-li\', function () {
//            id = $(this).data(\'id\');
//            has_childs = $(this).data(\'childs\');
//            li = $(this);
//            if(has_childs != \'\') {
//                $.ajax({
//                    url: "/site/get-cats",
//                    data: {\'id\': li.data(\'id\'), \'add\': \'add-\'}, //data: {}
//                    type: "get",
//                    success: function (t) {
//                        if(li.text() != \' Назад\') {
//                            title.push(li.text() + \' > \');
//                        }
//                        else {
//                            title.splice(title.length - 1, 1);
//                        }
//                        $(\'#added_cats .add-category-widget-list\').html(t);
//                    }
//                });
//            }
//            else {
//                title.push(li.text() + \' > \');
//                title = title.join(\'\');
//                btn = \' <i class="fa fa-remove add_cat_delete btn btn-danger"></i>\';
//                input = \' <input type="hidden" name="add_cats[]" value="\' + id + \'"/>\';
//                input_title = \' <input type="hidden" name="add_cats_titles[\' + id + \']" value="\' + title.substr(0, title.length - 3) + \'"/>\';
//                $(\'#adding_cats\').html($(\'#adding_cats\').html() + \'<p>\' + title.substr(0, title.length - 3) + btn + input + input_title + \'</p>\');
//                title = [];
//                $(\'#added_cats .add-category-widget-list\').remove();
//                $(\'#add_cat_btn\').show();
//            }
//            return false;
//        });
//    });
//'); ?>

<?php $this->registerJs('
    $(document).ready(function() {
        $(\'select.form-control\').select2(
            {
                language: {
                  noResults: function () {
                    return "Ничего не найдено";
                  }
                }
            }
        );
        $(document).on(\'click\', \'.cat-widget-li\', function () {
            id = $(this).data(\'id\');
            has_childs = $(this).data(\'childs\');
            
            li = $(this);
            if(has_childs != \'\') {
                $.ajax({
                    url: "/site/get-cats",
                    data: {\'id\': li.data(\'id\')}, //data: {}
                    type: "get",
                    success: function (t) {
                        $(\'.category-widget-list\').html(t);
                    }
                });
            }
            else {
                $(\'#category_id\').val(id);
                $(\'#cat-form\').submit();
            }
        });
        $(\'#add_cat_btn\').on(\'click\', function() {
            $($(\'#add-cat-temp\').html()).appendTo($(\'#added_cats\'));
            $(this).hide();
            return false;
        });
        $(document).on(\'click\', \'.add_cat_delete\', function () {
            $(this).parent().remove();
            return false;
        });
            var title = [];
        $(document).on(\'click\', \'.add-cat-widget-li\', function () {
            id = $(this).data(\'id\');
            has_childs = $(this).data(\'childs\');
            li = $(this);
            if(has_childs != \'\') {
                $.ajax({
                    url: "/site/get-cats",
                    data: {\'id\': li.data(\'id\'), \'add\': \'add-\'}, //data: {}
                    type: "get",
                    success: function (t) {
                        if(li.text() != \' Назад\') {
                            title.push(li.text() + \' > \');
                        }
                        else {
                            title.splice(title.length - 1, 1);
                        }
                        $(\'#added_cats .add-category-widget-list\').html(t);
                    }
                });
            }
            else {
                title.push(li.text() + \' > \');
                title = title.join(\'\');
                btn = \' <i class="fa fa-remove add_cat_delete btn btn-danger"></i>\';
                input = \' <input type="hidden" name="add_cats[]" value="\' + id + \'"/>\';
                input_title = \' <input type="hidden" name="add_cats_titles[\' + id + \']" value="\' + title.substr(0, title.length - 3) + \'"/>\';
                $(\'#adding_cats\').html($(\'#adding_cats\').html() + \'<p>\' + title.substr(0, title.length - 3) + btn + input + input_title + \'</p>\');
                title = [];
                $(\'#added_cats .add-category-widget-list\').remove();
                $(\'#add_cat_btn\').show();
            }
            return false;
        });
    });
'); ?>



