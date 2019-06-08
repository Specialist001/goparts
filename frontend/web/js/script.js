$(document).ready(function () {

    $("#signupform-role").change(function(){
        if ($("#signupform-role").val() == 1) {
            $('.legal-info').show();
        } else {
            $('.legal-info').hide();
        }
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

        // $('.car_items').prop('disabled', false);
        // $('.car_modifications').prop('disabled', true);
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
    console.log(this);
}