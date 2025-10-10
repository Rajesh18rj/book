$(document).ready(function() {
	$('.customToggler').click(function(){
        $('.navbar-toggler-icon').toggleClass('active');
    });
    $('.bannerSlider').owlCarousel({
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 2000,
        loop: true,
        dots:true,
        nav:false,
        margin:0,
        items: 1
    });
    $('.testiSlider').owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        dots:true,
        nav:false,
        loop: false,
        margin:0,
        items: 1
    });
    
    $('.serviceSlider').owlCarousel({
        autoplay:false,
        autoplayTimeout:5000,
        dots: true,
        loop: false,
        margin: 30,
        items: 6,
        nav: false,
        responsive:{
            0:{
                items:1
            },
            575:{
                items:2
            },
            767:{
                items:3
            }
        }
    });
    
    $('.productSlider').owlCarousel({
        autoplay:false,
        autoplayTimeout:5000,
        dots: true,
        loop: false,
        margin: 30,
        items: 6,
        nav: false,
        responsive:{
            0:{
                items:2
            },
            767:{
                items:3
            },
            991:{
                items:4
            }
        }
    });
    
    $('.brandSlider').owlCarousel({
        autoplay:false,
        autoplayTimeout:5000,
        dots: true,
        loop: false,
        margin: 0,
        items: 6,
        nav: false,
        responsive:{
            0:{
                items:2
            },
            575:{
                items:3
            },
            767:{
                items:4
            },
            991:{
                items:5
            }
        }
    });

    var containerHalfWidth = ($(window).width() - $('.container').width()) / 2;
    $('.bannerSlider .owl-dots').css('left', containerHalfWidth);
    
    $('.mFilter').click(function() {
        $(".filterWidget").addClass("active");
        $('body').css('overflow', 'hidden');
        $('body').append('<div class="backdrop"></div>');
    });
    $('.m-applyBtn span').click(function() {
        $(".filterWidget").removeClass("active");
        $('body').css('overflow', 'auto');
        $('.backdrop').remove();
    });

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav',
        autoplay: true
    });
    $('.slider-nav').slick({
        vertical: true,
        verticalSwiping: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        arrows: true,        
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-up"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-down"></i></button>',
        dots: false,
        centerMode: false,
        focusOnSelect: true
    });

    $('.picZoomer').imagezoomsl();

});