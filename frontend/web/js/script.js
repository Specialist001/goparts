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
    })
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