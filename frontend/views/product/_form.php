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

/* @var $this yii\web\View */
/* @var $model common\models\StoreProduct */
/* @var $form yii\widgets\ActiveForm */
//echo '<pre>';
//print_r($models_array);
//echo '</pre>';
//exit;

$model->category_id = $category->id;

if(!empty($model->car_id)) {
    $car = Cars::findOne(['id'=>$model->car_id]);
    //$car = Cars::findOne(['id'=>Yii::$app->request->get('car_id')]);
    $car_name = $car->vendor .' '.$car->car.' '.$car->modification.' '.$car->year;
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
    $car = Cars::findOne(['id'=>Yii::$app->request->get('car_id')]);

    $vendor_name = $car->vendor;
    $model_name = $car->car;
    $modification_name = $car->modification;
    $year_name = $car->year;

    $car_id = $car->id;

    $car_name = $vendor_name .' '.$model_name.' '.$modification_name.' '.$year_name;
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
        : ( Cars::getYear($vendor_name, $model_name, $modification_name) ? Cars::getYear($vendor_name, $model_name, $modification_name) : null);
//print_r($models_array);

$cat_filter = [];
$type_car_filter = [];

if (!empty($cats)) {
    foreach ($cats as $cat) {
        $cat_filter += [$cat->id => $cat->translate->title];
    }
}

$mod_array = [];

if(!empty($modifications_array)){
    foreach ($modifications_array as $key => $mod) {
        $mod_array[$key] = $key. ' ('.$mod['min'].' - '.$mod['max'].')';
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

    <div class="store-product-form pt-3">
<!--        --><?php //if(!$car_id) {?>
<!--            <form action="--><?//= Url::current()?><!--" id="car-form">-->
<!--                -->
<!--            </form>-->
<!--        --><?php //}?>

<!--        --><?php //if (!$category) { ?>
<!--            <form action="--><?//= Url::current() ?><!--" id="cat-form">-->
<!--                <h4>Select car</h4>-->
<!--                <div class="row car_search">-->
<!--                    <div class="col-md-3">-->
<!--                        <div class="position-relative">-->
<!--                            <select class="form-control vendor_select" required>-->
<!--                                <option disabled selected>Select Car</option>-->
<!--                                                        --><?// //= Dropdown::widget(); ?>
<!--                                --><?php //foreach ($cars_array as $vendor) { ?>
<!--                                    <option value="--><?//= $vendor ?><!--" --><?//= $vendor == $vendor_name ? 'selected' : '' ?><!----><?//= $vendor ?><!--</option>-->
<!--                                --><?php //} ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-3">-->
<!--                        <div class="position-relative">-->
<!--                            <select class="form-control car_items" required>-->
<!--                                <option disabled selected>Select Model</option>-->
<!---->
<!--                                --><?php //if (!empty(Yii::$app->request->get('car_id')) || !empty($model->car_id)) { ?>
<!--                                    --><?php //foreach ($models_array as $car_model) { ?>
<!--                                        <option value="--><?//= $car_model ?><!--" --><?//= $car_model == $model_name ? 'selected' : '' ?><!----><?//= $car_model ?><!--</option>-->
<!--                                    --><?php //} ?>
<!--                                --><?// } ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-3">-->
<!--                        <div class="position-relative">-->
<!--                            <select class="form-control car_modifications" required>-->
<!--                                <option disabled selected>Select Generation</option>-->
<!--                                --><?php //if (!empty(Yii::$app->request->get('car_id')) || !empty($model->car_id)) { ?>
<!--                                    --><?php //foreach ($mod_array as $key => $car_modification) { ?>
<!--                                        <option value="--><?//= $key ?><!--" --><?//= $key == $modification_name ? 'selected' : '' ?><!-- --><?//= $car_modification ?><!--</option>-->
<!--                                    --><?php //} ?>
<!--                                --><?// } ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-3">-->
<!--                        <div class="position-relative">-->
<!--                            <select class="form-control car_years" required>-->
<!--                                <option disabled selected>Year</option>-->
<!--                                --><?php //if (!empty(Yii::$app->request->get('car_id')) || !empty($model->car_id)) { ?>
<!--                                    --><?php //foreach ($year_array as $key => $car_year) { ?>
<!--                                        <option value="--><?//= $key ?><!--" --><?//= $key == $year_name ? 'selected' : '' ?><!-- --><?//= $car_year ?><!--</option>-->
<!--                                    --><?php //} ?>
<!--                                --><?// } ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <row>-->
<!--                    <div class="car_name" id="car_name">-->
<!---->
<!--                    </div>-->
<!--                </row>-->
<!--                <input type="hidden" name="car_id" id="car_id" value="--><?//= Yii::$app->request->get('car_id')?><!--"/>-->
<!--                --><?php //if (!empty($prod_id = Yii::$app->request->get('id'))) { ?>
<!--                    <input type="hidden" name="id" value="--><?//= $prod_id ?><!--"/>-->
<!--                --><?php //} ?>
<!---->
<!--                <div class="row pt-3">-->
<!--                    <div class="col-sm-6 col-md-4">-->
<!--                        <div class="form-group">-->
<!--                            <label for="category_id">Select category</label>-->
<!--                        </div>-->
<!--                        --><?php //if (!empty($cats)) { ?>
<!--                            <ul class="list-unstyled category-widget-list">-->
<!--                                --><?php //foreach ($cats as $cat) { ?>
<!--                                    <li data-id="--><?//= $cat->id ?><!--"-->
<!--                                        data-childs="--><?//= (!empty($cat->categories)) ? $cat->id : '' ?><!--"-->
<!--                                        class="cat-widget-li">--><?//= $cat->translate->title ?><!--</li>-->
<!--                                --><?php //} ?>
<!--                            </ul>-->
<!--                        --><?php //} ?>
<!--                        <input type="text" name="category" id="category_id" value="" style="visibility: hidden;"/>-->
<!--                        --><?php //if (!empty($prod_id = Yii::$app->request->get('id'))) { ?>
<!--                            <input type="hidden" name="id" value="--><?//= $prod_id ?><!--"/>-->
<!--                        --><?php //} ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </form>-->
<!--        --><?php //} else { ?>

            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-5">
                    <label>Category</label>
                    <input type="text" readonly="readonly" id="category_id" class="form-control"
                           value="<?= $category->translate->title ? $category->translate->title : $model->category->translate->title ?>"/>
<!--                    <a href="--><?//= Url::current(['category' => '']) ?><!--"-->
<!--                       onclick="if(!confirm('Expected form to save. Cancel?'))return false;">Choose another category</a>-->
                    <?= $form->field($model, 'category_id')->hiddenInput()->label(false) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'type_car_id')->dropDownList($type_car_filter)->label('Body type') ?>
                </div>
            </div>
            <input type="hidden" name="vendor" value="<?= Yii::$app->request->get('vendor') ?>" readonly>
            <input type="hidden" name="car" value="<?= Yii::$app->request->get('car') ?>" readonly>
            <input type="hidden" name="modification" value="<?= Yii::$app->request->get('modification') ?>" readonly>
            <input type="hidden" name="year_name" value="<?= Yii::$app->request->get('year_name') ?>" readonly>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Car</label>
                        <input class="form-control" type="text"
                               value="<?=$car_name?>" readonly>
                    </div>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'sku')->textInput(['maxlength' => true, 'readonly' => true, 'disabled' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'status')->dropDownList(['0' => 'Not active', 1 => 'Active']) ?>
                </div>
                <!---->
                <!--            <div class="col-md-3">-->
                <!--                --><? //= $form->field($model, 'order')->textInput(['type' => 'number', 'min' => 0]) ?>
                <!--            </div>-->
            </div>
            <h3 class="pt-2">Product Description</h3>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($translation_en, 'name[en]')->textInput(['value' => $translation_en->name]) ?>
                </div>
                <div class="col-md-8">
                    <?= $form->field($translation_en, 'short[en]')->textInput(['value' => $translation_en->short]) ?>
                </div>
                <div class="col-md-12">

                    <?= $form->field($translation_en, 'description[en]')->widget(TinyMce::className(), [
                        'options' => ['rows' => 6],
                        'value' => $translation_en->description,
                        'language' => 'en',
                        'clientOptions' => [
                            'plugins' => [
                                "advlist autolink lists link charmap preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste"
                            ],
                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                        ]
                    ])->textarea(['value' => $translation_en->description]);
                    ?>
                </div>
            </div>
            <br>

            <h3 class="text-left">
                Product Price
            </h3>
            <div class="row">

                <div class="col-md-3">
                    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3>Product Dimensions</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'in_stock')->dropDownList([1 => 'In stock', '0' => 'Not in stock']) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'min' => 0]) ?>
                        </div>
                    </div>
                    <!--                <div class="row">-->
                    <!--                    <div class="col-md-3">-->
                    <!--                        --><? //= $form->field($model, 'length')->textInput(['type' => 'number', 'min' => 0, 'maxlength' => true])->input('length', ['placeholder' => "Length, m."]) ?>
                    <!--                    </div>-->
                    <!--                    <div class="col-md-3">-->
                    <!--                        --><? //= $form->field($model, 'width')->textInput(['type' => 'number', 'min' => 0, 'maxlength' => true])->input('width', ['placeholder' => "Width, m."]) ?>
                    <!--                    </div>-->
                    <!--                    <div class="col-md-3">-->
                    <!--                        --><? //= $form->field($model, 'height')->textInput(['type' => 'number', 'min' => 0, 'maxlength' => true])->input('height', ['placeholder' => "Height, m."]) ?>
                    <!--                    </div>-->
                    <!--                    <div class="col-md-3">-->
                    <!--                        --><? //= $form->field($model, 'weight')->textInput(['type' => 'number', 'min' => 0, 'maxlength' => true])->input('weight', ['placeholder' => "Weight, kg"]) ?>
                    <!--                    </div>-->
                    <!--                </div>-->
                </div>

            </div>

            <!--        <div class="row">-->
            <!--            <div class="col-md-12">-->
            <!--                <ul class="nav nav-tabs" role="tablist">-->
            <!--                    <li role="presentation" class="active">-->
            <!--                        <a href="#pr_image" aria-controls="pr_image" role="tab" data-toggle="tab">Image</a>-->
            <!--                    </li>-->
            <!--                    <li role="presentation" class="text-right">-->
            <!--                        <a href="#pr_video" aria-controls="pr_video" role="tab" data-toggle="tab">Video</a>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!---->
            <!--                <div class="tab-content">-->
            <!--                    <div role="tabpanel" class="tab-pane active" id="pr_image">-->
            <!--                        <br>-->
            <!--                        <div class="row">-->
            <!--                            <div class="col-md-4">-->
            <!--                                --><?php //$fileinput_options = ['accept' => 'image/*', 'multiple' => false];
//                                if ($model->image != '') {
//                                    $fileinput_options = ['accept' => 'image/*', 'multiple' => false];
//                                    ?>
            <!--                                    <img src="--><? //= $model->image ?><!--" alt="--><? //= $model->image ?><!--"-->
            <!--                                         class="img-responsive"-->
            <!--                                         style="width: 100px">-->
            <!--                                --><?php //} ?>
            <!--                                --><? //= $form->field($model, 'image')->widget(FileInput::classname(), [
//                                    'options' => $fileinput_options,
//                                    'pluginOptions' => [
//                                        'showCaption' => false,
//                                        'showRemove' => false,
//                                        'showUpload' => false,
//                                        'browseClass' => 'btn btn-primary',
//                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
//                                        'browseLabel' => 'Select Image'
//                                    ],
//                                    'language' => 'en'
//                                ]); ?>
            <!--                            </div>-->
            <!--                            <div class="col-md-8">-->
            <!--                                <button id="button-add-image-url" type="button" class="btn btn-default">-->
            <!--                                    --><? //= FA::i('plus') ?>
            <!--                                </button>-->
            <!--                                <label> Add image</label>-->
            <!--                                <br>-->
            <!--                                <label></label>-->
            <!--                                <div class="product_images" id="product_images">-->
            <!--                                    <div class="product_image hidden form-group">-->
            <!--                                        <div class="row">-->
            <!--                                            <div class="col-xs-9 col-sm-5">-->
            <!--                                                <input type="file" class="image-url">-->
            <!--                                            </div>-->
            <!--                                            <div class="col-xs-2 col-sm-3">-->
            <!--                                                <button class="btn btn-default button-delete-image" type="button">-->
            <!--                                                    --><? //= FA::i('trash-o') ?>
            <!--                                                </button>-->
            <!--                                            </div>-->
            <!--                                        </div>-->
            <!--                                    </div>-->
            <!--                                </div>-->
            <!---->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div role="tabpanel" class="tab-pane active" id="pr_video">-->
            <!--                        <br>-->
            <!--                        <div class="row">-->
            <!--                            <div class="col-md-4">-->
            <!--                                --><?php //$fileinput_options = ['multiple' => false, 'accept' => 'video/*'];
//                                ?>
            <!---->
            <!--                                --><? //= $form->field($video, 'video')->widget(FileInput::classname(), [
//                                    'options' => $fileinput_options,
//                                    'pluginOptions' => [
//                                        'overwriteInitial' => true,
//                                        'showCaption' => true,
//                                        'showRemove' => true,
//                                        'showUpload' => true,
//                                        'allowedFileExtensions' => ['mp4'],
//                                        'initialPreviewAsData' => false,
//                                        'initialPreviewFileType' => 'video',
//                                        'initialPreviewConfig' => [
//                                            ['filetype' => "video/mp4"]
//                                        ],
//                                        'browseClass' => 'btn btn-primary',
//                                        'browseIcon' => '<i class="glyphicon glyphicon-video"></i> ',
////                            'browseLabel' => 'Select Video'
//                                    ],
//                                    'language' => 'en'
//                                ]); ?>
            <!--                            </div>-->
            <!--                            <div class="col-md-8">-->
            <!--                                <button id="button-video-add-url" type="button" class="btn btn-default">-->
            <!--                                    --><? //= FA::i('plus') ?>
            <!--                                </button>-->
            <!--                                <label> Add video url</label>-->
            <!--                                <br>-->
            <!--                                <label>Input URL video</label>-->
            <!--                                <div class="product_videos" id="product_videos">-->
            <!--                                    <div class="product_video hidden form-group">-->
            <!--                                        <div class="row">-->
            <!--                                            <div class="col-xs-9 col-sm-5">-->
            <!--                                                <input type="text" class="video-url form-control">-->
            <!--                                            </div>-->
            <!--                                            <div class="col-xs-3 col-sm-3">-->
            <!--                                                <button class="btn btn-default button-delete-video" type="button">-->
            <!--                                                    --><? //= FA::i('trash-o') ?>
            <!--                                                </button>-->
            <!--                                            </div>-->
            <!--                                        </div>-->
            <!--                                    </div>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!---->
            <!--        </div>-->


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
<!--        --><?php //} ?>

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
');?>
