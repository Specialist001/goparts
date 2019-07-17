$(document).ready(function () {

    $("#signupform-role").change(function(){
        if ($("#signupform-role").val() == 1) {
            $('.legal-info').show();
        } else {
            $('.legal-info').hide();
        }
    });




    // $('.new_request').on('click', '.send_request', function () {
    //     var seller_query_id = $(this).data('seller_query_id');
    //     var form = $('form#seller-query_'+seller_query_id);
    //
    //     var data = form.serialize();
    //
    //     // form.submit(function(e) {
    //         // e.preventDefault();
    //         $.ajax({
    //             url: "/product/add",
    //             data: data,
    //             type: "post",
    //             success: function (t) {
    //                 t = JSON.parse(t);
    //                 if (t.error !== true) {
    //                     // console.log('true-t');
    //                     var count = Object.keys(t.prices).length;
    //                     form.find('.product_id').val(t.product_id);
    //                     form.find('.add_images').html('<a href="/product/update?id='+t.product_id+'" class="d-inline-block py-2 text-form-style_2 font-weight-bold">Add Image</a>');
    //                     form.find('.new_request').addClass('green_request');
    //                     form.find('.rounded-circle').addClass('bg-form_style_1');
    //                     form.find('.send_request').removeClass('send_request').addClass('update_request').text('Update request');
    //                     form.find('textarea').attr('readonly',true).addClass('bg-light');
    //                     //form.find('.no_prices').remove();
    //                     for (var i=0; i<count; i++) {
    //                         form.find('.competitor_price_'+(i+1)).html((i+1)+')'+'<span class="text-form-style_1"> ' + t.prices[i] + ' AED</span>');
    //                     }
    //                 }
    //             }
    //         });
    //     // });
    // });

    $('.new_request').on('click', '.send_request', function (event) {
        var seller_query_id = $(this).data('seller_query_id');
        var form = $('form#seller-query_'+seller_query_id)[0];
        var form_ = $('form#seller-query_'+seller_query_id);

        //stop submit the form, we will post it manually.
        event.preventDefault();

        // Get form
        // var form = $('#fileUploadForm')[0];

        // Create an FormData object
        var data = new FormData(form);

        // If you want to add an extra field for the FormData
        data.append("CustomField", "This is some extra data, testing");

        // disabled the submit button
        // $("#btnSubmit").prop("disabled", true);

        // form.submit(function(e) {
        // e.preventDefault();
        $.ajax({
            url: "/product/add",
            enctype: 'multipart/form-data',
            data: data,
            type: "post",
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (t) {
                t = JSON.parse(t);
                if (t.error !== true) {
                    console.log(t);
                    var count = Object.keys(t.prices).length;
                    var count_images = Object.keys(t.images_json_array).length;

                    form_.find('.product_id').val(t.product_id);
                    // form.find('.add_images').html('<a href="/product/update?id='+t.product_id+'" class="d-inline-block py-2 text-form-style_2 font-weight-bold">Add Image</a>');

                    form_.find('.query_images').remove();
                    form_.find('.q_images').html('<input type="file" class="query_images" name="Query[images][]" multiple>');
                    form_.find('.img_select').html('<div class="col-12">' +
                        '<ul class="row request_imageboxes">' +
                        '</ul>' +
                        '</div>');
                    for(var j=0; j<count_images; j++) {
                        form_.find('.request_imageboxes').append('<li class="request_imagebox float-left p-1">' +
                            '<img src="'+t.images_json_array[j]+'" class="img-fluid" style="cursor: -webkit-zoom-in; cursor: zoom-in;">' +
                            '</li>');
                    }
                    form_.find('.new_request').addClass('green_request');
                    form_.find('.rounded-circle').addClass('bg-form_style_1');
                    form_.find('.send_request').removeClass('send_request').addClass('update_request').text('Update request');
                    form_.find('textarea').attr('readonly',true).addClass('bg-light');
                    //form.find('.no_prices').remove();
                    for (var i=0; i<count; i++) {
                        form_.find('.competitor_price_'+(i+1)).html((i+1)+')'+'<span class="text-form-style_1"> ' + t.prices[i] + ' AED</span>');
                    }
                    window.location.reload();
                }
            }
        });
        // });
    });


    $('.new_request').on('click', '.update_request', function (event) {
        var seller_query_id = $(this).data('seller_query_id');
        var form = $('form#seller-query_'+seller_query_id)[0];
        var form_ = $('form#seller-query_'+seller_query_id);
        // var product_id = form.find('.product_id').val();

        event.preventDefault();

        // Get form
        // var form = $('#fileUploadForm')[0];

        // Create an FormData object
        var data = new FormData(form);

        // If you want to add an extra field for the FormData
        data.append("CustomField", "This is some extra data, testing");

        // var data = form.serialize();

        $.ajax({
            url: "/product/edit",
            // contentType: 'multipart/form-data',
            enctype: 'multipart/form-data',
            data: data,
            type: "post",
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (t) {
                console.log(form);
                t = JSON.parse(t);

                if (t.error !== true) {
                    // console.log('true-t');
                    console.log(t);

                    /*form_.find('.query_images').remove();*/
                    form_.find('.q_images').html('<input type="file" class="query_images" name="Query[images][]" multiple>');
                    var count = Object.keys(t.prices).length;
                    var count_images = Object.keys(t.images_json_array).length;

                    for (var i=0; i<count; i++) {
                        form_.find('.competitor_price_'+(i+1)).html((i+1)+')'+'<span class="text-form-style_1"> ' + t.prices[i] + ' AED</span>');

                    }
                    for(var j=0; j<count_images; j++) {
                        form_.find('.request_imageboxes').append('<li class="request_imagebox float-left p-1">' +
                            '<img src="'+t.images_json_array[j]+'" class="img-fluid" style="cursor: -webkit-zoom-in; cursor: zoom-in;">' +
                            '</li>');
                    }
                    window.location.reload();
                }
            }
        });
        // });
    });

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

    $('.add_cart').on('click', function () {
        var form = $('form#cart_form');
        var data = form.serialize();
        // if(form.find('input[name="count"]').val() < 1) {
        //     form.find('input[name="count"]').focus();
        //     return false;
        // }

        form.submit(function(e){
            e.preventDefault();
            console.log('true-form');
            $.ajax({
                url: "/cart/add",
                data: data,
                type: "post",
                success: function (t) {
                    //console.log(t);
                    t = JSON.parse(t);
                    // console.log(t);
                    if (t.error !== true) {
                        console.log(t);
                        //$('.header-cart-icon').html(t.product.cart_count);
                        $('#cart_popup').html(
                            '<p class="alert alert-info">' + t.product.page_title + '</p>' +
                            '<div class="row" id="product_' + t.product.id + '">' +

                            '<div class="col-md-8"><h4>' + t.product.name + '</h4></div>' +
                            '</div>'
                        );
                        $("#cart-count").html(t.total_count);
                        $("#cartModal").modal('show');
                        //window.location.reload();
                    }
                }
            });
            return false;
        });
    });

    $('.buy_now').on('click', function () {
        var form = $('form#cart_form');
        var data = form.serialize();

        form.submit(function(e){
            e.preventDefault();
            console.log('true-form');
            $.ajax({
                url: "/cart/buy-now",
                data: data,
                type: "post",
                success: function (t) {
                    //console.log(t);
                    t = JSON.parse(t);
                    // console.log(t);
                    if (t.error !== true) {
                        console.log('t');
                        //$('.header-cart-icon').html(t.product.cart_count);
                        // $('#cart_popup').html(
                        //     '<p class="alert alert-info">' + t.product.page_title + '</p>' +
                        //     '<div class="row" id="product_' + t.product.id + '">' +
                        //     '<div class="col-md-3"><img src="' + t.product.img + '" alt="' + t.product.name + '" class="img-fluid center-block"></div>' +
                        //     '<div class="col-md-8"><h4>' + t.product.name + '</h4><p class="muted">' + t.product.cat + '</p></div>' +
                        //     '</div>'
                        // );
                        // $("#cart-count").html(t.total_count);
                        // $("#cartModal").modal('show');
                        //window.location.reload();
                    }
                }
            });
            return false;
        });
    });

    $("input.product_count").change(function () {
        if ($(this).val() <= 0) {
            alert('Minimum count is 1');
            $(this).val(1);
        }
    });

    $('.recount').on('click', function () {
        recount();
    });

    $('.cart_delete_button').on('click', function () {
        var del_button = $(this);
        $.ajax({
            url: "/cart/delete",
            data: {'product': $(this).attr('data-product')}, //data: {}
            type: "post",
            success: function (t) {
                t = JSON.parse(t);
                if (t.error !== true) {
                    console.log(t);
                    var target = $('#pr_' + del_button.attr('data-target'));
                    target.remove();
                    recount();
                    // shopSum(del_button.attr('data-shop'));
                    // $('.header-cart-icon').html(t.cart_count);
                    // if ($("#shop_" + del_button.attr('data-shop') + ' .product_details').length === 0) $("#shop_" + del_button.attr('data-shop')).remove();
                    //if ($(".cart_shop").length === 0) window.location.reload();
                    // var modal_content = $('#refuse_modal').children('.modal-dialog').children('.modal-content');
                    // modal_content.children('.modal-header').hide();
                    // modal_content.children('.modal-body').show();
                    // modal_content.children('.modal-footer').hide();
                    // var link = $('.shell_product_name').children('a').attr('data-product_url');
                    // window.location.href = link;
                }
            }
        });
    });

    $('.cart_clear_button').on('click', function () {
        $.ajax({
            url: 'cart/clear',
            type: "post",
            success: function (t) {
                t = JSON.parse(t);
                if (t.error !== true) {
                    var target = $('.basket_table');
                    if (t.error === false) {
                        target.remove();
                    }
                }
            }
        });
    });

    function recount() {
        var form = $('form#basket-form');
        var data = form.serialize();
        console.log('btn');

        $.ajax({
            url: "/cart/recount",
            data: data,
            type: "post",
            success: function (t) {
                t = JSON.parse(t);
                console.log(t);
                if (t.error !== true) {
                    var count = Object.keys(t.products).length;
                    console.log(count);
                    for (var i=0; i<count; i++) {
                        $('#total-count_'+t.products[i].id).html(t.products[i].sum);
                        $('#quantity_'+t.products[i].id).html(t.products[i].sum);
                    }

                    // $('#total-count_2').html(t.products['2'].sum);
                    $('#cart_amount').html(t.t_count);
                    $('#cart_amount_vat').html(t.t_count);
                    $('#cart_amount_uf').val(t.t_count_uf);

                    // $('#total-count_'+t.data)
                    //$('.header-cart-icon').html(t.product.cart_count);
                    // $('#cart_popup').html(
                    //     '<p class="alert alert-info">' + t.product.page_title + '</p>' +
                    //     '<div class="row" id="product_' + t.product.id + '">' +
                    //     '<div class="col-md-3"><img src="' + t.product.img + '" alt="' + t.product.name + '" class="img-fluid center-block"></div>' +
                    //     '<div class="col-md-8"><h4>' + t.product.name + '</h4><p class="muted">' + t.product.cat + '</p></div>' +
                    //     '</div>'
                    // );
                    // $("#cart-count").html(t.total_count);
                    // $("#cartModal").modal('show');
                    //window.location.reload();
                }
            }
        });
        return false;
    }



    if ($('.catalog_top_link').attr('aria-expanded','true')) {
        $('.catalog_top_link').children('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    } else if($('.catalog_top_link').attr('aria-expanded','false')){
        $('.catalog_top_link').children('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    }

    $('#open-all_menu').on('click', function () {
        var $menu = $('#all_menu');
        //var $button = $('#open-all_menu');
        if($menu.hasClass('visible')) {
            // $(this).removeClass('btn-view-active');
            $menu.slideUp(300);
            $menu.removeClass('visible');
        } else {
            // $(this).addClass('btn-view-active');
            //$button.children(children(children($('.up-down'))))
            $menu.slideDown(300);
            $menu.addClass('visible');
        }
    });

    $(document).mouseup(function (e){ // событие клика по веб-документу
        var $div_0 = $('#open-all_menu');
        var $div = $('#all_menu'); // тут указываем ID элемента
        if (!$div.is(e.target) && !$div_0.is(e.target) // если клик был не по нашему блоку
            && $div.has(e.target).length === 0 && $div_0.has(e.target).length === 0) { // и не по его дочерним элементам
            //$div_0.removeClass('btn-view-active');
            $('#all_menu').removeClass('visible');
            $div.slideUp(300);
        }
    });

    // Скролл левого меню
    $('.lcm-root-cat-scroll, .dropdown-menu-leftmenu').scrollbar();
    $('ul.lcm-root-cat, .dropdown-menu-leftmenu').on('scroll', function () {
        if(($(this).scrollTop() > 50)){
            $(this).parent().children('.scroll-x').show();
        }
        else if($(this).prop("scrollHeight") > $(this).height()) {
            $(this).parent().children('.scroll-x').hide();
        }
        if(($(this).scrollTop() + $(this).height() + 50) >= $(this).prop("scrollHeight")) {
            $(this).parent().children('.scroll-y').hide();
        }
        else if($(this).prop("scrollHeight") > $(this).height()) {
            $(this).parent().children('.scroll-y').show();
        }
    });


    function getCar(vendor) {
        $.ajax({
            type: "GET",
            url: '/product/get-car',
            dataType: "json",
            data: {
                vendor: vendor
            },
            success: function (response) {
                // var result = $.parseJSON(response);
                if (!response.error) {
                    $('.car_items').html(response);
                } else {
                    console.log('Ошибка обработки данных');
                }
            },
            error: function () {
                console.log('Ошибка обработки данных 2');
            },
        });
    }

    function getModification(vendor, car) {
        $.ajax({
            type: "GET",
            url: '/product/get-modification',
            dataType: "json",
            data: {
                vendor: vendor, car: car
            },
            success: function (response) {
                // var result = $.parseJSON(response);
                if (!response.error) {
                    $('.car_modifications').html(response);

                } else {
                    console.log('Ошибка обработки данных');
                }
            },
            error: function () {
                console.log('Ошибка обработки данных 2');
            },
        });
    }

    function getYear(vendor, car, modification) {
        $.ajax({
            type: "GET",
            url: '/product/get-year',
            dataType: "json",
            data: {
                vendor: vendor, car: car, modification: modification
            },
            success: function (response) {
                if (!response.error) {
                    $('.car_years').html(response);
                    if( $('#cat-form').is('#car_id')) {

                    }
                } else {
                    console.log('Ошибка обработки данных');
                }
            },
            error: function () {
                console.log('Ошибка обработки данных 2');
            },
        });
    }

    function getOneCar(vendor, car, modification, year) {
        $.ajax({
            type: "GET",
            url: '/product/get-one-car',
            // dataType: "json",
            data: {
                vendor: vendor, car: car, modification: modification, year: year
            },
            success: function (response) {
                if (!response.error) {
                    console.log(response);
                    $('#car_id').val(response);
                    $('.car_name').html(vendor+car+modification+year);
                } else {
                    console.log('Ошибка обработки данных');
                }
            },
            error: function () {
                console.log('Ошибка обработки данных 2');
            },
        });
    }

    $('.vendor_select').change(function () {
        var vendor = $('.vendor_select').val();

        getCar(vendor);

        // $('.car_items').prop('disabled', false);

        $('.car_modifications').empty().html('<option disabled selected>Select Generation</option>');

        // $('.car_years').prop('disabled', true);
    });

    $('.car_items').change(function () {
        var vendor = $('.vendor_select').val();
        var car = $(this).val();

        getModification(vendor, car);

        // $('.car_modifications').prop('disabled', false);
        // $('.car_years').prop('disabled', true);
    });

    $('.car_modifications').change(function () {
        var vendor = $('.vendor_select').val();
        var car = $('.car_items').val();
        var modification = $(this).val();

        getYear(vendor, car, modification);

        // $('.car_years').prop('disabled', false);
    });

    $('.car_years').change(function () {
        var vendor = $('.vendor_select').val();
        var car = $('.car_items').val();
        var modification = $('.car_modifications').val();
        var year = $(this).val();
        console.log('year');

        getOneCar(vendor, car, modification, year);

        // $('.car_years').prop('disabled', false);
    });

    var part_counter = 0;

    $('#btn_add_part').click(function () {

        var query_parts = $('#query_parts');
        var newPart = $('.query_parts .query_part.d-none').clone().removeClass('d-none');
        var key = $.now();

        newPart.appendTo(query_parts).after($('.btn_add_part'));
        part_counter++;
        // newPart.find('.image-url').attr('name', 'ProductImage[new_' + key + '][url]');
        newPart.find('.query_title').attr('name', 'Query['+part_counter+'][title]');
        newPart.find('.category_id').attr('name', 'Query['+part_counter+'][category_id]');
        newPart.find('.query_fueltype').attr('name', 'Query['+part_counter+'][fueltype]');
        newPart.find('.query_engine').attr('name', 'Query['+part_counter+'][engine]');
        newPart.find('.query_transmission').attr('name', 'Query['+part_counter+'][transmission]');
        newPart.find('.query_drivetype').attr('name', 'Query['+part_counter+'][drivetype]');
        newPart.find('.query_description').attr('name', 'Query['+part_counter+'][description]');
        // newPart.find('.query_main_image').attr('name', 'Query['+part_counter+'][mainImage]');
        // newPart.find('.query_images').attr('name', 'Query['+part_counter+'][images][]');
        newPart.find('.image').attr('name', 'Query['+part_counter+'][images][]');


        return false;
    });

    $('#query_parts').on('click', '.button-delete-part', function () {
        $(this).closest('.query_part').remove();
    });

    // $('.cat_select').click(function () {
    //     console.log('btn');
    //      $(this).next().toggleClass('d-none');
    // });

    $("#file").click(function(){
        $("#image").click();
    });


    function readURL(input, preview) {
        // console.log('123');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

    }

    $("form").on('click','.image_preview', function() {
        var preview = $(this);

        var input_btn = $(this).parent('.image_block').children('.image');
        input_btn.click();

        input_btn.change(function (){
            console.log('change');

            readURL(this, preview);
            preview.parent('form').submit();
        });
    });

    function delUrl(input, preview) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.attr('src', '/uploads/site/add_img.png');
            }
            reader.readAsDataURL(input.files[0]);
        }
        input.value = null;
    }

    $("form").on('click','.deleter', function() {
        var preview = $(this).parent('.image_block').find('.image_preview');
        var file = $(this).parent('.image_block').find('.image')[0];
        // console.log(file);
        delUrl(file, preview);
    });

    function getStocks(city_id) {
        console.log('function');
        $.ajax({
            type: "GET",
            url: '/cart/get-stocks',
            dataType: "json",
            data: {
                id: city_id
            },
            success: function (response) {
                // var result = $.parseJSON(response);
                if (!response.error) {
                    $('.stocks').html(response);

                } else {
                    console.log('Ошибка обработки данных');
                }
            },
            error: function () {
                console.log('Ошибка обработки данных 2');
            },
        });
    }

    $('.cities').change(function () {
        var city_id = $(this).val();
        var car = $(this).val();

        // getModification(city_id);
        getStocks(city_id);

        // $('.car_modifications').prop('disabled', false);
        // $('.car_years').prop('disabled', true);
    });

    // $('.sidebar_bottom4').on('click','button', function () {
    //     if ($('.cities option:selected').val() == "" || $('.cities option:selected').length == 0 ) {
    //         alert("Please select City");
    //     }
    //     return false;
    // })



});
const $left = $(".left");
const $gl = $(".gallery");
const $gl2 = $(".gallery2");
const $photosCounterFirstSpan = $(".photos-counter span:nth-child(1)");

$gl.slick({
    rows: 0,
    slidesToShow: 2,
    arrows: false,
    draggable: false,
    useTransform: false,
    mobileFirst: true,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 1023,
            settings: {
                slidesToShow: 1,
                vertical: true
            }
        }
    ]
});

$gl2.slick({
    rows: 0,
    useTransform: false,
    prevArrow: ".arrow-left",
    nextArrow: ".arrow-right",
    fade: true,
    asNavFor: $gl
});

$(window).on("load", () => {
    handleCarouselsHeight();
    setTimeout(() => {
        $(".loading").fadeOut();
        $("body").addClass("over-visible");
    }, 300);
});

function handleCarouselsHeight() {
    if (window.matchMedia("(min-width: 1024px)").matches) {
        const gl2H = $(".gallery2").height();
        $left.css("height", gl2H);
    } else {
        $left.css("height", "auto");
    }
}

$(window).on(
    "resize",
    _.debounce(() => {
        handleCarouselsHeight();
    }, 200)
);

/*you have to bind init event before slick's initialization (see demo) */
$gl2.on("init", (event, slick) => {
    $photosCounterFirstSpan.text(`${slick.currentSlide + 1}/`);
    $(".photos-counter span:nth-child(2)").text(slick.slideCount);
});

$gl2.on("afterChange", (event, slick, currentSlide) => {
    $photosCounterFirstSpan.text(`${slick.currentSlide + 1}/`);
});

$(".gallery .item").on("click", function() {
    const index = $(this).attr("data-slick-index");
    $gl2.slick("slickGoTo", index);
});

$('.owl-related').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    }
})

$('.product-photo .owl-carousel').owlCarousel({
    nav:false,
    items:1,
    dots: true,
    loop:true,
    //animateOut: 'slideOutUp',
    //animateIn: 'slideInUp',
    responsive:{
        0:{
            mouseDrag: true,
            touchDrag: true
        },
        992:{
            mouseDrag: false,
            touchDrag: false
        }
    }
});

function dots(){
    let dotcount = 1;

    let owlDot = $('.product-photo .owl-carousel .owl-dot');


    owlDot.each(function() {
        $(this).addClass( 'dotnumber' + dotcount);
        $(this).attr('data-info', dotcount);
        dotcount=dotcount+1;
    });

    let slidecount = 1;

    $('.product-photo .owl-carousel .owl-item').not('.cloned').each(function() {
        $(this).addClass( 'slidenumber' + slidecount);
        slidecount=slidecount+1;
    });



    owlDot.each(function() {

        grab = $(this).data('info');

        slidegrab = $('.slidenumber'+ grab +' img').attr('src');

        $(this).css("background-image", "url("+slidegrab+")");

    });

    amount = owlDot.length;
    gotowidth = 100/amount;

    owlDot.css("width", '25%');
    newwidth = owlDot.width();
    owlDot.css("height", 80);
}

dots();

if ($.fancybox) {
    $.fancybox.defaults.thumbs.autoStart = true;
    $.fancybox.defaults.thumbs.axis = 'x';
    $.fancybox.defaults.buttons = ['close'];
    $.fancybox.defaults.infobar = false;
    $.fancybox.defaults.animationEffect = 'fade';
    $.fancybox.defaults.hash = false;
    $.fancybox.defaults.toolbar = true;

    $.fancybox.defaults.backFocus = false;
    $.fancybox.defaults.loop = true;

    $.fancybox.defaults.btnTpl.close =
        `
            <button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 224.512 224.512">
                    <polygon points="224.507,6.997 217.521,0 112.256,105.258 6.998,0 0.005,6.997 105.263,112.254 0.005,217.512 6.998,224.512 112.256,119.24 217.521,224.512 224.507,217.512 119.249,112.254"/>
                </svg>
            </button>
        `;
    $.fancybox.defaults.btnTpl.arrowLeft =
        `
            <button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 15" style="transform:rotate(180deg)">
                    <path d="M19.5,7.00060457 L1.831,7.00060457 L8.829,0.876604566 C9.037,0.694604566 9.058,0.378604566 8.876,0.171604566 C8.694,-0.0373954342 8.379,-0.0583954342 8.171,0.124604566 L0.171,7.12460457 C0.166,7.12760457 0.165,7.13360457 0.16,7.13760457 C0.152,7.14560457 0.144,7.15360457 0.136,7.16160457 C0.133,7.16560457 0.127,7.16760457 0.124,7.17160457 C0.109,7.18860457 0.104,7.20960457 0.092,7.22760457 C0.076,7.25060457 0.058,7.27060457 0.047,7.29460457 C0.042,7.30560457 0.039,7.31560457 0.035,7.32560457 C0.025,7.35260457 0.022,7.37860457 0.017,7.40660457 C0.012,7.43260457 0.004,7.45760457 0.003,7.48460457 C0.003,7.49060457 0,7.49460457 0,7.50060457 C0,7.50660457 0.003,7.51060457 0.003,7.51660457 C0.004,7.54360457 0.012,7.56860457 0.017,7.59460457 C0.022,7.62260457 0.025,7.64860457 0.035,7.67560457 C0.039,7.68560457 0.042,7.69560457 0.047,7.70660457 C0.058,7.73060457 0.076,7.75060457 0.092,7.77360457 C0.104,7.79160457 0.109,7.81260457 0.124,7.82960457 C0.127,7.83360457 0.132,7.83460457 0.136,7.83860457 C0.144,7.84760457 0.152,7.85560457 0.16,7.86360457 C0.165,7.86760457 0.166,7.87360457 0.171,7.87660457 L8.171,14.8766046 C8.266,14.9596046 8.383,15.0006046 8.5,15.0006046 C8.639,15.0006046 8.777,14.9426046 8.876,14.8296046 C9.058,14.6226046 9.037,14.3066046 8.829,14.1246046 L1.831,8.00060457 L19.5,8.00060457 C19.776,8.00060457 20,7.77660457 20,7.50060457 C20,7.22460457 19.776,7.00060457 19.5,7.00060457" transform="matrix(-1 0 0 1 20 0)"></path>
                </svg>
            </button>
        `;
    $.fancybox.defaults.btnTpl.arrowRight =
        ` 
            <button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 15" style="transform:rotate(0deg)">
                    <path d="M19.5,7.00060457 L1.831,7.00060457 L8.829,0.876604566 C9.037,0.694604566 9.058,0.378604566 8.876,0.171604566 C8.694,-0.0373954342 8.379,-0.0583954342 8.171,0.124604566 L0.171,7.12460457 C0.166,7.12760457 0.165,7.13360457 0.16,7.13760457 C0.152,7.14560457 0.144,7.15360457 0.136,7.16160457 C0.133,7.16560457 0.127,7.16760457 0.124,7.17160457 C0.109,7.18860457 0.104,7.20960457 0.092,7.22760457 C0.076,7.25060457 0.058,7.27060457 0.047,7.29460457 C0.042,7.30560457 0.039,7.31560457 0.035,7.32560457 C0.025,7.35260457 0.022,7.37860457 0.017,7.40660457 C0.012,7.43260457 0.004,7.45760457 0.003,7.48460457 C0.003,7.49060457 0,7.49460457 0,7.50060457 C0,7.50660457 0.003,7.51060457 0.003,7.51660457 C0.004,7.54360457 0.012,7.56860457 0.017,7.59460457 C0.022,7.62260457 0.025,7.64860457 0.035,7.67560457 C0.039,7.68560457 0.042,7.69560457 0.047,7.70660457 C0.058,7.73060457 0.076,7.75060457 0.092,7.77360457 C0.104,7.79160457 0.109,7.81260457 0.124,7.82960457 C0.127,7.83360457 0.132,7.83460457 0.136,7.83860457 C0.144,7.84760457 0.152,7.85560457 0.16,7.86360457 C0.165,7.86760457 0.166,7.87360457 0.171,7.87660457 L8.171,14.8766046 C8.266,14.9596046 8.383,15.0006046 8.5,15.0006046 C8.639,15.0006046 8.777,14.9426046 8.876,14.8296046 C9.058,14.6226046 9.037,14.3066046 8.829,14.1246046 L1.831,8.00060457 L19.5,8.00060457 C19.776,8.00060457 20,7.77660457 20,7.50060457 C20,7.22460457 19.776,7.00060457 19.5,7.00060457" transform="matrix(-1 0 0 1 20 0)"></path>
                </svg>
            </button>
        `;

}

// if($(document).width() > 768) {
//     let dotcount = 1;
//
//     let owlDot = $('.product-photo .owl-carousel .owl-dot');
//
//     owlDot.each(function() {
//         $(this).addClass( 'dotnumber' + dotcount);
//         $(this).attr('data-info', dotcount);
//         dotcount=dotcount+1;
//     });
//
//     let slidecount = 1;
//
//     $('.product-photo .owl-carousel .owl-item').not('.cloned').each(function() {
//         $(this).addClass( 'slidenumber' + slidecount);
//         slidecount=slidecount+1;
//     });
//
//     owlDot.each(function() {
//         grab = $(this).data('info');
//         slidegrab = $('.slidenumber'+ grab +' img').attr('src');
//         $(this).css("background-image", "url("+slidegrab+")");
//     });
//
//     amount = owlDot.length;
//     gotowidth = 100/amount;
//
//     owlDot.css("width", 80);
//     newwidth = owlDot.width();
//     owlDot.css("height", 80);
// }
// if($(document).width() < 768) {
//     $('.product-photo .owl-carousel .owl-item a').removeAttr('data-fancybox');
//     // console.log(this);
// }