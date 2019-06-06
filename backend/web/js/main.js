$(document).ready(function () {

    // $("body").niceScroll({
    //     cursorcolor: "#1c1a1b",
    // });

    function getPrice(purchase_price, commission) {
        $.ajax({
            //async: true,
            type: "GET",
            url: '/admin/store-product/get-price',
            dataType: "json",
            data: {
                purchase_price: purchase_price, commission: commission
            },
            success: function (response) {
                var result = $.parseJSON(response);
                // console.log("response", response);
                if (!result.error) {
                    $('#storeproduct-price').val(response);
                    // $('#storeproduct-price').innerHTML = response;
                } else {
                    console.log('Ошибка обработки данных');
                }
            },
            error: function () {
                console.log('Ошибка обработки данных');
            },
        });
    }

    $('#storeproduct-purchase_price').change(function () {
        var purchase_price = $(this).val();
        var commission = $('#product_commission').val();
        // console.log(purchase_price);

        getPrice(purchase_price, commission);
    });

    $('#product_commission').change(function () {
        var purchase_price = $('#storeproduct-purchase_price').val();
        var commission = $(this).val();
        // console.log(commission);

        getPrice(purchase_price, commission);
    });

    function getCar(vendor) {
        $.ajax({
            type: "GET",
            url: '/admin/store-product/get-car',
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
            url: '/admin/store-product/get-modification',
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
            url: '/admin/store-product/get-year',
            dataType: "json",
            data: {
                vendor: vendor, car: car, modification: modification
            },
            success: function (response) {
                if (!response.error) {
                    $('.car_years').html(response);
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

        $('.car_items').prop('disabled', false);
        $('.car_modifications').prop('disabled', true);
        $('.car_years').prop('disabled', true);
    });

    $('.car_items').change(function () {
        var vendor = $('.vendor_select').val();
        var car = $(this).val();

        getModification(vendor, car);

        $('.car_modifications').prop('disabled', false);
        $('.car_years').prop('disabled', true);
    });

    $('.car_modifications').change(function () {
        var vendor = $('.vendor_select').val();
        var car = $('.car_items').val();
        var modification = $(this).val();

        getYear(vendor, car, modification);

        $('.car_years').prop('disabled', false);
    });

    $('#button-video-add-url').click(function () {
        var product_videos = $('#product_videos');
        var product_video = $('.product_video .hidden');
        var newVideo = $('.product_videos .product_video.hidden').clone().removeClass('hidden');
        var key = $.now();

        newVideo.appendTo(product_videos);
        newVideo.find('.video-url').attr('name', 'ProductVideo[new_' + key + '][url]');
        return true;
    });

    // $('.button-delete-video').click(function () {
    //     //$(this).parent('.form-group').remove();
    //     console.log('1');
    //     console.log($(this).parent('.form-group'));
    // });

    $('#product_videos').on('click', '.button-delete-video', function () {
        $(this).closest('.form-group').remove();
    });

    $('#button-add-image-url').click(function () {
        var product_images = $('#product_images');
        var newImage = $('.product_images .product_image.hidden').clone().removeClass('hidden');
        var key = $.now();

        newImage.appendTo(product_images);
        newImage.find('.image-url').attr('name', 'ProductImage[new_' + key + '][url]');
        return false;
    });

    $('#product_images').on('click', '.button-delete-image', function () {
        $(this).closest('.form-group').remove();
    });


// $('#storeproduct-purchase_price').focusout({
//     $.ajax({
//         url: '/admin/store-product/getPrice',
//         type: 'POST',
//         data: {},
//         success: function (f) {
//             var product_price = $('#storeproduct-price');
//         }
//     });
// });

});