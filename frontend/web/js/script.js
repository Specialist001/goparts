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

                    form_.find('.query_images').remove();
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
                        console.log('true-t');
                        //$('.header-cart-icon').html(t.product.cart_count);
                        $('#cart_popup').html(
                            '<p class="alert alert-info">' + t.product.page_title + '</p>' +
                            '<div class="row" id="product_' + t.product.id + '">' +
                            '<div class="col-md-3"><img src="' + t.product.img + '" alt="' + t.product.name + '" class="img-fluid center-block"></div>' +
                            '<div class="col-md-8"><h4>' + t.product.name + '</h4><p class="muted">' + t.product.cat + '</p></div>' +
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
        newPart.find('.query_images').attr('name', 'Query['+part_counter+'][images][]');

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
    animateOut: 'slideOutUp',
    animateIn: 'slideInUp',
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

if($(document).width() > 768) {
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

    owlDot.css("width", 80);
    newwidth = owlDot.width();
    owlDot.css("height", 80);
}
if($(document).width() < 768) {
    $('.product-photo .owl-carousel .owl-item a').removeAttr('data-fancybox');
    // console.log(this);
}