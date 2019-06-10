<?php

use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Dropdown;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StoreProduct */
/* @var $form yii\widgets\ActiveForm */
//echo '<pre>';
//print_r($errors);
//echo '</pre>';
$model->category_id = $category->id;
?>

<div class="store-product-form">
    <?php if (!$category) { ?>

        <form action="<?= Url::current() ?>" id="cat-form">
            <div class="row">
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
            <!--        <div class="col-md-3">-->
            <!--            --><? //= $form->field($model, 'type_id')->textInput() ?>
            <!--        </div>-->
            <!--        <div class="col-md-3">-->
            <!--            --><? //= $form->field($model, 'producer_id')->textInput() ?>
            <!--        </div>-->
            <div class="col-md-3">
                <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'category_id')->textInput(['readonly' => true, 'disabled' => true]); ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'type_car_id')->dropDownList($type_car_filter) ?>
            </div>
            <!--        <div class="col-md-2">-->
            <!--            --><? //= $form->field($model, 'user_id')->dropDownList($user_filter) ?>
            <!--            --><? //= $form->field($model, 'user_id')->textInput(['value'=>Yii::$app->user->identity->username, 'readonly' => true]) ?>
            <!--        </div>-->
            <div class="col-md-2">
                <?= $form->field($model, 'sku')->textInput(['maxlength' => true, 'readonly' => true, 'disabled' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'is_special')->dropDownList(['0' => 'Not special', 1 => 'Special']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'status')->dropDownList(['0' => 'Not active', 1 => 'Active']) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'order')->textInput(['type' => 'number', 'min' => 0]) ?>
            </div>
            <div class="col-md-3">

            </div>
        </div>

        <h3>Selection by car</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="">Vendor</label>
                    <select class="form-control vendor_select" name="vendor_name">
                        <option disabled selected>Select Vendor</option>
                        <?= Dropdown::widget() ?>
                        <?php foreach ($cars_array as $car) { ?>
                            <option value="<?= $car ?>"><?= $car ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 car_select">
                <div class="form-group">
                    <label>Car</label>
                    <select class="form-control car_items" name="car_name" disabled>
                        <option disabled selected>Select Car</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 modification_select">
                <div class="form-group">
                    <label>Modification</label>
                    <select class="form-control car_modifications" name="modification_name" disabled>
                        <option disabled selected>Modification</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 year_select">
                <div class="form-group">
                    <label>Year</label>
                    <select class="form-control car_years" name="year_name" disabled>
                        <option disabled selected>Year</option>
                    </select>
                </div>
            </div>
        </div>
        <h3>Product Translation</h3>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($translation_en, 'name[en]')->textInput(['value' => $translation_en->name]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($translation_en, 'short[en]')->textInput(['value' => $translation_en->short]) ?>
            </div>
            <div class="col-md-12">
                <!--                            --><? //= $form->field($translation_en, 'description[en]')->textarea(['value' => $translation_en->description, 'style' => 'resize: vertical; height: 128px;']) ?>
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
        <h3>Product Seo</h3>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($translation_en, 'meta_title[en]')->textInput(['value' => $translation_en->meta_title]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($translation_en, 'meta_description[en]')->textInput(['value' => $translation_en->meta_description]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($translation_en, 'meta_keywords[en]')->textInput(['value' => $translation_en->meta_keywords]) ?>
            </div>
        </div>
        <!--    Translation-->

        <!--    END Translation-->

        <h3 class="text-left">
            Product Price
        </h3>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'purchase_price')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <label for="product_sion">Commission</label>
                <input class="form-control" type="number"
                       value="<?= $store_product_commission->commission ? $store_product_commission->commission : '5' ?>"
                       id="product_commission" min="0"
                       name="product_commission">
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'disabled' => true]) ?>
            </div>
            <!--        <div class="col-md-3">-->
            <!--            --><? //= $form->field($model, 'discount_price')->textInput(['maxlength' => true]) ?>
            <!--        </div>-->
            <!--        --><? //= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>
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
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'length')->textInput(['type' => 'number', 'min' => 0, 'maxlength' => true])->input('length', ['placeholder' => "Length, m."]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'width')->textInput(['type' => 'number', 'min' => 0, 'maxlength' => true])->input('width', ['placeholder' => "Width, m."]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'height')->textInput(['type' => 'number', 'min' => 0, 'maxlength' => true])->input('height', ['placeholder' => "Height, m."]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'weight')->textInput(['type' => 'number', 'min' => 0, 'maxlength' => true])->input('weight', ['placeholder' => "Weight, kg"]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Product Data</h3>
                <?= $form->field($model, 'data')->widget(TinyMce::className(), [
                    'options' => ['rows' => 4],
                    'language' => 'en',
                    'clientOptions' => [
                        'plugins' => [
                            "lists link",
                            "searchreplace visualblocks",
                            "media table paste"
                        ],
//                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    ]
                ])->textarea(['value' => $model->data]) ?>
            </div>
        </div>
        <!--        --><? //= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <!--        --><? //= $form->field($model, 'average_price')->textInput(['maxlength' => true]) ?>


        <!--        --><? //= $form->field($model, 'recommended_price')->textInput(['maxlength' => true]) ?>


        <!--        --><? //= $form->field($model, 'external_id')->textInput(['maxlength' => true]) ?>

        <!--        --><? //= $form->field($model, 'view')->textInput() ?>

        <!--        --><? //= $form->field($model, 'qid')->textInput() ?>

        <!--        --><? //= $form->field($model, 'created_at')->textInput() ?>

        <!--        --><? //= $form->field($model, 'updated_at')->textInput() ?>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#pr_image" aria-controls="pr_image" role="tab" data-toggle="tab">Image</a>
                    </li>
                    <li role="presentation" class="text-right">
                        <a href="#pr_video" aria-controls="pr_video" role="tab" data-toggle="tab">Video</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="pr_image">
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <?php $fileinput_options = ['accept' => 'image/*', 'multiple' => false];
                                if ($model->image != '') {
                                    $fileinput_options = ['accept' => 'image/*', 'multiple' => false];
                                    ?>
                                    <img src="<?= $model->image ?>" alt="<?= $model->image ?>"
                                         class="img-responsive"
                                         style="width: 100px">
                                <?php } ?>
                                <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                                    'options' => $fileinput_options,
                                    'pluginOptions' => [
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => false,
                                        'browseClass' => 'btn btn-primary',
                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                        'browseLabel' => 'Select Image'
                                    ],
                                    'language' => 'en'
                                ]); ?>
                            </div>
                            <div class="col-md-8">
                                <button id="button-add-image-url" type="button" class="btn btn-default">
                                    <?= FA::i('plus') ?>
                                </button>
                                <label> Add image</label>
                                <br>
                                <label></label>
                                <div class="product_images" id="product_images">
                                    <div class="product_image hidden form-group">
                                        <div class="row">
                                            <div class="col-xs-9 col-sm-5">
                                                <input type="file" class="image-url">
                                            </div>
                                            <div class="col-xs-2 col-sm-3">
                                                <button class="btn btn-default button-delete-image" type="button">
                                                    <?= FA::i('trash-o') ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane active" id="pr_video">
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <?php $fileinput_options = ['multiple' => false, 'accept' => 'video/*'];
                                ?>

                                <?= $form->field($video, 'video')->widget(FileInput::classname(), [
                                    'options' => $fileinput_options,
                                    'pluginOptions' => [
                                        'overwriteInitial' => true,
                                        'showCaption' => true,
                                        'showRemove' => true,
                                        'showUpload' => true,
                                        'allowedFileExtensions' => ['mp4'],
                                        'initialPreviewAsData' => false,
                                        'initialPreviewFileType' => 'video',
                                        'initialPreviewConfig' => [
                                            ['filetype' => "video/mp4"]
                                        ],
                                        'browseClass' => 'btn btn-primary',
                                        'browseIcon' => '<i class="glyphicon glyphicon-video"></i> ',
//                            'browseLabel' => 'Select Video'
                                    ],
                                    'language' => 'en'
                                ]); ?>
                            </div>
                            <div class="col-md-8">
                                <button id="button-video-add-url" type="button" class="btn btn-default">
                                    <?= FA::i('plus') ?>
                                </button>
                                <label> Add video url</label>
                                <br>
                                <label>Input URL video</label>
                                <div class="product_videos" id="product_videos">
                                    <div class="product_video hidden form-group">
                                        <div class="row">
                                            <div class="col-xs-9 col-sm-5">
                                                <input type="text" class="video-url form-control">
                                            </div>
                                            <div class="col-xs-3 col-sm-3">
                                                <button class="btn btn-default button-delete-video" type="button">
                                                    <?= FA::i('trash-o') ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

<?php $this->registerJs('
    $(document).ready(function() {
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
//        $(\'#add_cat_btn\').on(\'click\', function() {
//            $($(\'#add-cat-temp\').html()).appendTo($(\'#added_cats\'));
//            $(this).hide();
//            return false;
//        });
//        $(document).on(\'click\', \'.add_cat_delete\', function () {
//            $(this).parent().remove();
//            return false;
//        });
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