$(function ($) {
    "use strict";

    jQuery(document).ready(function () {


        $(function(){

            var url = window.location.pathname,
                urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
            console.log(url);
             // var currnet = window.location.origin;
            // now grab every link from the navigation
            let x = 0;
            $('.navbar-nav li a').each(function(){
                // and test its normalized href against the url pathname regexp
                if(urlRegExp.test(this.href.replace(/\/$/,''))){
                    if(x==0) {
                        $(this).addClass('active');
                        $(this).closest('ul.dropdown-menu').addClass("show");
                        $(this).parent().parent().parent().find('a.dropdown-toggle').attr("aria-expanded", "true");
                    }
                    if(url=="/"){
                        x=1;
                    }
                }
            });

        });



    //   magnific popup activation
    $('.video-play-btn, .play-video').magnificPopup({
        type: 'video'
    });
    $('.img-popup').magnificPopup({
        type: 'image'
    });

    // Serch option toggle
    $('#web-serch').on('click', function(){
        $('.search-form-area').toggleClass('open');
    });


    // Hero-area-slider
    var $hero_area_slider = $('.hero-area-slider');
    $hero_area_slider.owlCarousel({
        items:1,
        loop: true,
        nav: false,
        dots: true,
        autoplay: false,
        center: false,
        slideSpeed: 1000,
        paginationSpeed: 1000,
        smartSpeed: 800,
    });


    // Aeatured Auction
    var $featured_auction_slider = $('.featured_auction_slider');
    $featured_auction_slider.owlCarousel({
        loop: true,
        nav: true,
        dots: true,
        navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
        autoplay: false,
        margin: 30,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        center: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            993: {
                items: 3
            },
            1200: {
                items: 3
            },
            1920: {
                items: 3
            }
        }
    });




    // team-slider
    var $team_slider = $('.team-slider');
    $team_slider.owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        autoplay: false,
        margin: 30,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        center: true,
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 2
            },
            993: {
                items: 3
            },
            1200: {
                items: 4
            },
            1920: {
                items: 4
            }
        }
    });

    // testimonial-slider
    var $testimonial_slider = $('.testimonial-slider');
    $testimonial_slider.owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        autoplay: false,
        margin: 30,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            960: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });

    // blog-slider
    var $blog_slider = $('.blog-slider');
    $blog_slider.owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        autoplay: false,
        margin: 30,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 3
            }
        }
    });


    /**------------------------------
     * Product Details  carousel
     * ---------------------------**/

    $('.one-item-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.all-item-slider',
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    vertical: false,
                    horizontal: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.all-item-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.one-item-slider',
        arrows: true,
        prevArrow: '<i class="fa fa fa-chevron-left slidPrv4"></i>',
        nextArrow: '<i class="fa fa-chevron-right slidNext4"></i>',
        dots: false,
        centerMode: true,
        centerPadding: '10px',
        focusOnSelect: true
    });

});

    $(document).on('click', '.cart-remove', function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    });

    $('#carticon').on('click', function () {
        $('.my-dropdown-menu').toggleClass('show');
    });


    /*-- back to top --*/
    $(document).on('click', '.bottomtotop', function () {
        $("html,body").animate({
            scrollTop: 0
        }, 2000);
    });

    //define variable for store last scrolltop
    var lastScrollTop = '';
    $(window).on('scroll', function () {
        var $window = $(window);
        if ($window.scrollTop( ) > 0 ) {
            $(".mainmenu-area").addClass('nav-fixed');
        } else {
            $(".mainmenu-area").removeClass('nav-fixed');
        }

        /*---------------------------
            back to top show / hide
        ---------------------------*/
        var st = $(this).scrollTop();
        var ScrollTop = $('.bottomtotop');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(400);
        } else {
            ScrollTop.fadeOut(400);
        }
        lastScrollTop = st;

    });

    $(window).on('load', function () {

    /*---------------------
        Preloader
    -----------------------*/
    var preLoder = $("#preloader");
    preLoder.addClass('hide');
    var backtoTop = $('.back-to-top')
    /*-----------------------------
        back to top
    -----------------------------*/
    var backtoTop = $('.bottomtotop')
    backtoTop.fadeOut(100);
    });



});

    $(document).ready(function() {
        var owl1 = $('.about-carousel .owl-carousel');
        owl1.owlCarousel({
            items:1,
            margin: 10,
            nav: true,
            loop: true,
            dots: true,
            slideSpeed: 2000,
            paginationSpeed: 1000,
            smartSpeed: 1000
        })
        var owl2 = $('.partshow-carousel .owl-carousel');
        owl2.owlCarousel({
            items:1,
            nav: true,
            loop: true,
            dots: true,
            slideSpeed: 2000,
            paginationSpeed: 1000,
            smartSpeed: 1000
        })

        $('.hero-area-sliders').owlCarousel({
            items:1,
            nav: false,
            loop: false,
            dots: false,
            slideSpeed: 2000,
            paginationSpeed: 1000,
            smartSpeed: 1000,
            autoplay:true
        })
    })
    