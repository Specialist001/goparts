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

    <?php if (!$car_id) { ?>
        <form action="<?= Url::current() ?>" id="cat-form">
            <h4>Select car</h4>
            <div class="row car_search">
                <div class="col-md-2">
                    <div class="position-relative">
                        <select class="form-control vendor_select" id="car_vendor" required>
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
                        <select class="form-control car_items" id="car_car" required>
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
                        <select class="form-control car_modifications" id="car_modification" required>
                            <option disabled selected>Select Generation</option>
                            <?php if (!empty(Yii::$app->request->get('car_id')) || !empty($model->car_id)) { ?>
                                <?php foreach ($mod_array as $key => $car_modification) { ?>
                                    <option value="<?= $key ?>" <?= $key == $modification_name ? 'selected' : '' ?>> <?= $car_modification ?></option>
                                <?php } ?>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative">
                        <select class="form-control car_years" id="car_year" required>
                            <option disabled selected>Year</option>
                            <?php if (!empty(Yii::$app->request->get('car_id')) || !empty($model->car_id)) { ?>
                                <?php foreach ($year_array as $key => $car_year) { ?>
                                    <option value="<?= $key ?>" <?= $key == $year_name ? 'selected' : '' ?>> <?= $car_year ?></option>
                                <?php } ?>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative">
                        <a class="btn btn-success save_car">Save</a>
                    </div>
                </div>
            </div>
            <row>
                <div class="car_name" id="car_name">

                </div>
            </row>
            <input type="hidden" name="car_id" id="car_id" value=""/>
<!--            <input type="hidden" name="QueryData[car_id]" id="car_id" value=""/>-->
            <?php if (!empty($prod_id = Yii::$app->request->get('id'))) { ?>
                <input type="hidden" name="id" value="<?= $prod_id ?>"/>
            <?php } ?>

            <!--            <div class="row pt-3">-->
            <!--                <div class="col-sm-6 col-md-4">-->
            <!--                    <div class="form-group">-->
            <!--                        <label for="category_id">Select category</label>-->
            <!--                    </div>-->
            <!--                    --><?php //if (!empty($cats)) { ?>
            <!--                        <ul class="list-unstyled category-widget-list">-->
            <!--                            --><?php //foreach ($cats as $cat) { ?>
            <!--                                <li data-id="--><? //= $cat->id ?><!--"-->
            <!--                                    data-childs="-->
            <? //= (!empty($cat->categories)) ? $cat->id : '' ?><!--"-->
            <!--                                    class="cat-widget-li">-->
            <? //= $cat->translate->title ?><!--</li>-->
            <!--                            --><?php //} ?>
            <!--                        </ul>-->
            <!--                    --><?php //} ?>
            <!--                    <input type="text" name="category" id="category_id" value="" style="visibility: hidden;"/>-->
            <!--                    --><?php //if (!empty($prod_id = Yii::$app->request->get('id'))) { ?>
            <!--                        <input type="hidden" name="id" value="--><? //= $prod_id ?><!--"/>-->
            <!--                    --><?php //} ?>
            <!--                </div>-->
            <!--            </div>-->
        </form>
    <?php } else { ?>

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'part-form']]); ?>

        <div class="row">

            <!--            <div class="col-md-4">-->
            <!--                <label>Category</label>-->
            <!--                <input type="text" readonly="readonly" id="category_id" class="form-control"-->
            <!--                       value="--><? //= $category->translate->title ?><!--"/>-->
            <!--                <a href="--><? //= Url::current(['category' => '']) ?><!--"-->
            <!--                   onclick="if(!confirm('Expected form to save. Cancel?'))return false;">Choose another category and-->
            <!--                    Car</a>-->
<!--            --><?//= $form->field($model, 'category_id')->hiddenInput()->label(false) ?>
            <!--            </div>-->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Car</label>
                    <input class="form-control" type="text"
                           value="<?= $car_name ?>" readonly>
                    <a href="<?= Url::current(['car_id' => '']) ?>"
                       onclick="if(!confirm('Expected form to save. Cancel?'))return false;">Choose another Car</a>
                </div>
            </div>
            <!--            <div class="col-md-2 float-md-right">-->
            <!--                <label class="w-100"></label>-->
            <!--                <button class="btn bg-form_style_1 px-3 py-2 text-white" id="btn_add_part" style="cursor: pointer"><i class="fa fa-plus"></i> Add Part</button>-->
            <!--            </div>-->
        </div>

<!--        --><?//= $form->field($model, 'car_id')->hiddenInput(['value' => Yii::$app->request->get('car_id')])->label(false) ?>
<!--        --><?//= $form->field($model, 'vendor')->hiddenInput(['value' => $vendor_name])->label(false) ?>
<!---->
<!--        --><?//= $form->field($model, 'car')->hiddenInput(['value' => $model_name])->label(false) ?>
<!---->
<!--        --><?//= $form->field($model, 'modification')->hiddenInput(['value' => $modification_name])->label(false) ?>
<!---->
<!--        --><?//= $form->field($model, 'year')->hiddenInput(['value' => $year_name])->label(false) ?>

        <input type="hidden" name="QueryData[car_id]" value="<?= $car_id ?>">
        <input type="hidden" name="QueryData[vendor]" value="<?= $vendor_name ?>">
        <input type="hidden" name="QueryData[car]" value="<?= $model_name ?>">
        <input type="hidden" name="QueryData[modification]" value="<?= $modification_name ?>">
        <input type="hidden" name="QueryData[year]" value="<?= $year_name ?>">

        <div class="query_parts" id="query_parts">
            <div class="query_part py-3">
                <h4 class="pb-2 text-form-style_2">Part</h4>

                <div class="row">
                    <div class="col-md-6 col-12">
<!--                        --><?//= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="Query[0][title]">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group cat-parent">
                            <label>Category</label>
                            <input class="form-control category_id" type="hidden" name="Query[0][category_id]" value="">
                            <input class="form-control cat_select bg-gray" type="button" value="Select category">
                            <div class="position-absolute select_category d-none">
                                <?php if (!empty($cats)) { ?>
                                    <ul class="list-unstyled category-widget-list bg-white">
                                        <?php foreach ($cats as $cat) { ?>
                                            <li data-id="<?= $cat->id ?>"
                                                data-childs="<?= (!empty($cat->categories)) ? $cat->id : '' ?>"
                                                data-title="<?= $cat->translate->title ?>"
                                                class="cat-widget-li">
                                                <?= $cat->translate->title ?></li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                                <input type="text" name="category" id="category_id" value=""
                                       style="visibility: hidden;"/>
                                <?php if (!empty($prod_id = Yii::$app->request->get('id'))) { ?>
                                    <input type="hidden" name="id" value="<? //= $prod_id ?>"/>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fuel Type</label>
                            <select class="form-control" name="Query[0][fueltype]">
                                <?php foreach ($fuel_array as $key => $fuel) { ?>
                                    <option value="<?= $key ?>"><?= $fuel ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Engine Type</label>
                            <select class="form-control" name="Query[0][engine]">
                                <?php foreach ($engines_array as $key => $engine) { ?>
                                    <option value="<?= $key ?>"><?= $engine ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Transmission</label>
                            <select class="form-control" name="Query[0][transmission]">
                                <?php foreach ($transmissions_array as $key => $transmissions) { ?>
                                    <option value="<?= $key ?>"><?= $transmissions ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <?//= $form->field($model, 'drivetype')->textInput(['maxlength' => true]) ?>
                        <div class="form-group">
                            <label>Drive Type</label>
                            <input class="form-control" name="Query[0][drivetype]" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="" name="Query[0][image]" type="file">
                        </div>
<!--                        <div class="form-group">-->
<!--                            --><?php
//                            echo FileInput::widget([
//                                'name' => 'Query[0][image]',
//                                'options' => ['accept' => 'image/*', 'multiple' => false],
//                                'pluginOptions' => [
//                                    'showCaption' => false,
//                                    'showRemove' => false,
//                                    'showUpload' => false,
//                                    'browseClass' => 'btn btn-primary btn-block',
//                                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
//                                    'browseLabel' => Yii::t('frontend', 'Choose Image'),
//                                ],
//                                'language' => 'en'
//                            ]);
//                            ?>
<!--                        </div>-->
                    </div>
                </div>
            </div>

            <!-- Additional Part -->
            <div class="query_part py-3 d-none">
                <div class="row">
                    <div class="col">
                        <h4 class="pb-2 text-form-style_2">New Part</h4>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-danger button-delete-part text-white float-md-right">Delete Part</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
<!--                        --><?//= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control query_title">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group cat-parent">
                            <label>Category</label>
                            <input class="form-control category_id" type="hidden" value="">
                            <input class="form-control cat_select bg-grey" type="button" value="Select category">
                            <div class="position-absolute select_category d-none ">
                                <?php if (!empty($cats)) { ?>
                                    <ul class="list-unstyled category-widget-list bg-white">
                                        <?php foreach ($cats as $cat) { ?>
                                            <li data-id="<?= $cat->id ?>"
                                                data-childs="<?= (!empty($cat->categories)) ? $cat->id : '' ?>"
                                                data-title="<?= $cat->translate->title ?>"
                                                class="cat-widget-li">
                                                <?= $cat->translate->title ?></li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                                <?php if (!empty($prod_id = Yii::$app->request->get('id'))) { ?>
                                    <input type="hidden" name="id" value="<? //= $prod_id ?>"/>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fuel Type</label>
                            <select class="form-control query_fueltype">
                                <?php foreach ($fuel_array as $key => $fuel) { ?>
                                    <option value="<?= $key ?>"><?= $fuel ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Engine Type</label>
                            <select class="form-control query_engine">
                                <?php foreach ($engines_array as $key => $engine) { ?>
                                    <option value="<?= $key ?>"><?= $engine ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Transmission</label>
                            <select class="form-control query_transmission">
                                <?php foreach ($transmissions_array as $key => $transmissions) { ?>
                                    <option value="<?= $key ?>"><?= $transmissions ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <?//= $form->field($model, 'drivetype')->textInput(['maxlength' => true]) ?>
                        <div class="form-group">
                            <label>Drive Type</label>
                            <input class="form-control query_drivetype" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input class="query_image" type="file">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center m-auto btn_add_part">
                <button class="btn bg-form_style_1 px-3 py-2 text-white text-center" id="btn_add_part"
                        style="cursor: pointer"><i class="fa fa-plus"></i> Add Part
                </button>
            </div>
        </div>
        <h3 class="pt-5">Contacts</h3>
        <div class="row">

            <div class="col-md-4">
                <?//= $form->field($model, 'name')->textInput(['value' => Yii::$app->user->identity->username ? Yii::$app->user->identity->username : $model->name, 'maxlength' => true]) ?>
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="QueryData[name]" value="<?= Yii::$app->user->identity->username ? Yii::$app->user->identity->username : $model->name ?>">
                </div>
            </div>
            <div class="col-md-4">
                <?//= $form->field($model, 'phone')->textInput(['value' => Yii::$app->user->identity->phone ? Yii::$app->user->identity->phone : $model->phone, 'maxlength' => true]) ?>
                <div class="form-group">
                    <label>Phone</label>
                    <input class="form-control" name="QueryData[phone]" value="<?= Yii::$app->user->identity->phone ? Yii::$app->user->identity->phone : $model->phone ?>">
                </div>
            </div>
            <div class="col-md-4">
                <?//= $form->field($model, 'email')->input('email') ?>
                <div class="form-group">
                    <label>E-mail</label>
                    <input class="form-control" name="QueryData[email]" type="email">
                </div>
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
//    $(document).ready(function() {
//        $(\'select.form-control\').select2(
//            {
//                language: {
//                  noResults: function () {
//                    return "Nothing not found";
//                  }
//                }
//            }
//        );
//    });
//    $(document).on(\'ready pjax:success\', function() {
//        $(\'select.form-control\').select2(
//            {
//                language: {
//                  noResults: function () {
//                    return "Nothing not found";
//                  }
//                }
//            }
//        );
//    });
');
?>
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
        
        $(document).on(\'click\',\'.save_car\', function () {
            //getOneCar($(\'#car_vendor\').val(), $(\'#car_car\').val(), $(\'#car_modification\').val(), $(\'#$car_year\').val());
            $(\'#cat-form\').submit();
        });
        
        $(document).on(\'click\', \'.cat_select\', function () {
            //console.log(\'btn\');
            $(this).next().toggleClass(\'d-none\');
            
            var parent_form = $(this).parent(\'.cat-parent\');
//            console.log(parent_form);
            var input_btn = $(this);
            
            $(document).on(\'click\', \'.cat-widget-li\', function () {
            
                id = $(this).data(\'id\');
                title = $(this).data(\'title\');
                
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
//                    console.log(input_btn);
                    parent_form.children(\'.category_id\').val(id);
    
                    input_btn.val(title);
                    input_btn.next().addClass(\'d-none\');
                }
        });
        });
                
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



