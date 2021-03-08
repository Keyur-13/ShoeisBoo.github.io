window.addEventListener("load", function(){
        
    jQuery(document).ready(function($){
        "use scrict";

        $("body").addClass("page-loaded");

    });

});

jQuery(document).ready(function ($) {
    "use strict";

    // Hide Comments
    $('.tribunal-no-comment .booster-block.booster-ratings-block, .tribunal-no-comment .comment-form-ratings, .tribunal-no-comment .twp-star-rating').hide();

    $('.tooltips').append("<span></span>");
    $(".tooltips").mouseenter(function(){
        $(this).find('span').empty().append($(this).attr('data-tooltip'));
    });

    // Content Gallery Start
    var i = 1;
    $('.entry-content .wp-block-gallery ').each(function () {

        $(this).attr('gallery-data', 'gallery-num-' + i);
        $(this).addClass('gallery-data-slick');
        $(this).addClass('gallery-data-gallery-num-' + i);
        i++;

        var k = 0;
        $(this).find('.blocks-gallery-item').each(function () {
            $(this).attr('gallery-index', k);
            k++;
        });
    });

    var j = 1;
    
    $('.gallery-data-slick .blocks-gallery-item a').click(function (event) {

        event.preventDefault();

    });

    $('.gallery-data-slick .blocks-gallery-item').click(function () {

        if (!$(this).closest('.gallery-data-slick').hasClass('columns-1')) {

            $('body').addClass('body-scroll-locked');

            var galid = $(this).closest('.gallery-data-slick').attr('gallery-data');

            $('.' + galid).closest('.footer-gallery-sec-wrap').addClass('show-close');

            $('.' + galid).addClass('gallery-show fullscreen');

            if ($('.' + galid).hasClass('tribunal-slick-dactivated')) {

                $('.' + galid + ' .blocks-gallery-grid').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    autoplay: false,
                    autoplaySpeed: 8000,
                    infinite: true,
                    nextArrow: '<button type="button" class="slide-btn slide-next-icon ion ion-ios-arrow-forward"></button>',
                    prevArrow: '<button type="button" class="slide-btn slide-prev-icon ion ion-ios-arrow-back"></button>',
                    dots: false,
                });

                $('ul.wp-block-gallery.' + galid ).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    autoplay: false,
                    autoplaySpeed: 8000,
                    infinite: true,
                    nextArrow: '<button type="button" class="slide-btn slide-next-icon ion ion-ios-arrow-forward"></button>',
                    prevArrow: '<button type="button" class="slide-btn slide-prev-icon ion ion-ios-arrow-back"></button>',
                    dots: false,
                });

            }
            var galindex = $(this).attr('gallery-index');
            $('.' + galid + ' .blocks-gallery-grid').slick('slickGoTo', galindex);
            $('ul.wp-block-gallery.' + galid).slick('slickGoTo', galindex);
            $('.' + galid).removeClass('tribunal-slick-dactivated');

        }

    });

    $('.footer-galleries figure.wp-block-gallery').each(function () {

        $(this).append('<div class="gallery-popup-close"><i class="ion ion-ios-close" aria-hidden="true"></i></div>');

        $(this).addClass('gallery-num-' + j);
        j++;

        $(this).addClass('tribunal-slick-dactivated');
    });

    $('.footer-galleries ul.wp-block-gallery').each(function () {

        $(this).closest('.footer-gallery-sec-wrap').append('<div class="gallery-popup-close"><i class="ion ion-ios-close" aria-hidden="true"></i></div>');

        $(this).addClass('gallery-num-' + j);
        j++;

        $(this).addClass('tribunal-slick-dactivated');
    });

    $('.wp-block-gallery.columns-1').append('<div class="gallery-popup"><i class="ion ion-ios-add-circle-outline" aria-hidden="true"></i></div>');
    $('.wp-block-gallery.columns-1').append('<div class="gallery-popup-close"><i class="ion ion-ios-close" aria-hidden="true"></i></div>');

    $('.gallery-popup').click(function () {
        $(this).closest('.wp-block-gallery').addClass('fullscreen');
        $('body').addClass('body-scroll-locked');
        $('.wp-block-gallery.columns-1 .blocks-gallery-grid').slick("slickSetOption", "speed", 500, !0);

    });

    $('.gallery-popup-close').click(function () {

        $(this).closest('.footer-gallery-sec-wrap').removeClass('show-close');
        $(this).closest('.footer-gallery-sec-wrap').find('.wp-block-gallery').removeClass('fullscreen gallery-show');
        $('body').removeClass('body-scroll-locked');
        $('.wp-block-gallery.columns-1 .blocks-gallery-grid').slick("slickSetOption", "speed", 500, !0);

    });

    // Content Gallery End

    // Widget Gallery Start

    $('.widget_media_gallery a').click(function (event) {

        event.preventDefault();

    });

    var k = 1;
    $('.widget_media_gallery').each(function () {

        if (!$(this).find('.gallery').hasClass('gallery-columns-1')) {

            $(this).attr('gallery-id', 'gallery-' + k);
            var gallhtml = $(this).find('.gallery').html();
            $('.widget-footer-galleries').append('<div class="footer-gallery-main"><div class="footer-gallery-' + k + '">' + gallhtml + '</div><div class="gallery-popup-close"><i class="ion ion-ios-close" aria-hidden="true"></i></div></div>');

            var l = 0;
            $(this).find('.gallery-item').each(function () {
                $(this).attr('index-item', l);
                l++;
            });

            k++;
        }

        if ($(this).find('.gallery').hasClass('gallery-columns-1')) {

            $(this).append('<div class="gallery-popup"><i class="ion ion-ios-add-circle-outline" aria-hidden="true"></i></div>');
            $(this).append('<div class="gallery-popup-close"><i class="ion ion-ios-close" aria-hidden="true"></i></div>');

        }

    });

    $('.footer-gallery-main a').click(function (event) {

        event.preventDefault();

    });

    $('figure.gallery-item').click(function () {

        if (!$(this).closest('.gallery').hasClass('gallery-columns-1')) {
            $('body').addClass('body-scroll-locked');
        }
        var clickedgal = $(this).closest('.widget_media_gallery').attr('gallery-id');
        $('.footer-' + clickedgal).closest('.footer-gallery-main').addClass('fullscreen');
        if (!$('.footer-' + clickedgal).hasClass('widget-slider-active')) {

            $('.footer-' + clickedgal).addClass('widget-slider-active');

            $('.footer-' + clickedgal).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: false,
                autoplaySpeed: 8000,
                infinite: true,
                nextArrow: '<button type="button" class="slide-btn slide-next-icon ion ion-ios-arrow-forward"></button>',
                prevArrow: '<button type="button" class="slide-btn slide-prev-icon ion ion-ios-arrow-back"></button>',
                dots: false,
            });

        }
        var galindex = $(this).attr('index-item');
        $('.footer-' + clickedgal).slick('slickGoTo', galindex);

    });

    $('.gallery-popup-close').click(function () {

        $(this).closest('.footer-gallery-main').removeClass('fullscreen gallery-show');
        $('body').removeClass('body-scroll-locked');

    });

    $('.widget.widget_media_gallery .gallery-popup').click(function () {

        $(this).closest('.widget_media_gallery').addClass('fullscreen');
        $('body').addClass('body-scroll-locked');
        $('.gallery-columns-1').slick("slickSetOption", "speed", 500, !0);

    });

    $('.widget.widget_media_gallery .gallery-popup-close').click(function () {

        $(this).closest('.widget_media_gallery').removeClass('fullscreen');
        $('body').removeClass('body-scroll-locked');
        $('.gallery-columns-1').slick("slickSetOption", "speed", 500, !0);

    });

    // Widget Gallery End

    // Scroll To
    $(".scroll-content").click(function () {
        $('html, body').animate({
            scrollTop: $(".site-content").offset().top
        }, 500);
    });

    // Rating disable
    if (tribunal_custom.single_post == 1 && tribunal_custom.tribunal_ed_post_reaction) {

        $('.tpk-single-rating').remove();
        $('.tpk-comment-rating-label').remove();
        $('.comments-rating').remove();
        $('.tpk-star-rating').remove();

    }

    // Add Class on article
    $('.twp-archive-items.post').each(function () {
        $(this).addClass('twp-article-loaded');
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() > 350) {
            $("#site-header").addClass("site-header-fixed");
        } else {
            $("#site-header").removeClass("site-header-fixed");
        }
    });

    // Aub Menu Toggle
    $('.submenu-toggle').click(function () {
        $(this).toggleClass('button-toggle-active');
        var currentClass = $(this).attr('data-toggle-target');
        $(currentClass).toggleClass('submenu-toggle-active');
    });

    // Header Search show
    $('.header-searchbar').click(function () {

        $('.header-searchbar').removeClass('header-searchbar-active');

    });

    $(".header-searchbar-inner").click(function (e) {

        e.stopPropagation(); //stops click event from reaching document

    });

    // Header Search hide
    $('#search-closer').click(function () {
        $('.header-searchbar').removeClass('header-searchbar-active');
        setTimeout(function () {
            $('.navbar-control-search').focus();
        }, 300);
        $('body').removeClass('body-scroll-locked');
    });

    // Focus on search input on search icon expand
    $('.navbar-control-search').click(function(){
        $('.header-searchbar').toggleClass('header-searchbar-active');
        setTimeout(function () {
            $('.header-searchbar .search-field').focus();
        }, 300);
        $('body').addClass('body-scroll-locked');
    });

    $( 'input, a, button' ).on( 'focus', function() {
        if ( $( '.header-searchbar' ).hasClass( 'header-searchbar-active' ) ) {

            if( $(this).hasClass('skip-link-search-top') ){
                $('.header-searchbar #search-closer').focus();
            }

            if (  ! $( this ).parents( '.header-searchbar' ).length ) {
                $('.header-searchbar .search-field').focus();
            }
        }
    } );

    $(document).keyup(function(j) {
        if (j.key === "Escape") { // escape key maps to keycode `27`
            if ( $( '.header-searchbar' ).hasClass( 'header-searchbar-active' ) ) {
                 $('.header-searchbar').removeClass('header-searchbar-active');
                 $('body').removeClass('body-scroll-locked');
                setTimeout(function () {
                    $('.navbar-control-search').focus();
                }, 300);

            }
        }
    });

    // Action On Esc Button
    $(document).keyup(function (j) {
        if (j.key === "Escape") { // escape key maps to keycode `27`

            if( $('#offcanvas-menu').hasClass('offcanvas-menu-active') ){
                $('.header-searchbar').removeClass('header-searchbar-active');
                $('#offcanvas-menu').removeClass('offcanvas-menu-active');
                $('.navbar-control-offcanvas').removeClass('active');
                $('body').removeClass('body-scroll-locked');

                setTimeout(function () {
                    $('.navbar-control-offcanvas').focus();
                }, 300);

            }
        }
    });

    // Toggle Menu
    $('.navbar-control-offcanvas').click(function () {

        $(this).addClass('active');
        $('body').addClass('body-scroll-locked');
        $('#offcanvas-menu').toggleClass('offcanvas-menu-active');
        $('.button-offcanvas-close').focus();

    });

    // Offcanvas Close
    $('.offcanvas-close .button-offcanvas-close').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');

        setTimeout(function () {
            $('.navbar-control-offcanvas').focus();
        }, 300);

    });

    // Offcanvas Close
    $('#offcanvas-menu').click(function () {

        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');

    });

    $(".offcanvas-wraper").click(function (e) {

        e.stopPropagation(); //stops click event from reaching document

    });

    // Offcanvas re focus on close button
    $('input, a, button').on('focus', function () {
        if ($('#offcanvas-menu').hasClass('offcanvas-menu-active')) {

            if( $(this).hasClass('skip-link-off-canvas') ){

                if( !$("#offcanvas-menu #social-nav-offcanvas").length == 0 ){

                    $("#offcanvas-menu #social-nav-offcanvas ul li:last-child a").focus();

                }else if( !$("#offcanvas-menu #primary-nav-offcanvas").length == 0 ){

                    $("#offcanvas-menu #primary-nav-offcanvas ul li:last-child a").focus();

                }
            }
            
            if (!$(this).parents('#offcanvas-menu').length) {
                $('.button-offcanvas-close').focus();
            }
        }
    });

    // Single Post content gallery slide
    $("ul.wp-block-gallery.columns-1, .wp-block-gallery.columns-1 .blocks-gallery-grid, .gallery-columns-1").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-next-icon ion ion-ios-arrow-forward"></button>',
            prevArrow: '<button type="button" class="slide-btn slide-prev-icon ion ion-ios-arrow-back"></button>',
            dots: false,
        });
    });

    // Footer Affix Slider
    $(".affix-carousel").each(function () {
        $(this).slick({
            autoplay: true,
            accessibility: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-next-icon ion ion-ios-arrow-forward"></button>',
            prevArrow: '<button type="button" class="slide-btn slide-prev-icon ion ion-ios-arrow-back"></button>',
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });

    $(window).scroll(function () {

        if ($(window).scrollTop() > $(window).height() / 2) {

            $(".affix-panel-content").addClass('active-scrollpanel').css({'opacity': 1});

        } else {

            $(".affix-panel-content").removeClass('active-scrollpanel').css({'opacity': 0});

        }

    });

    // Footer Affix hide and show
    $('.affix-panel-content').each(function () {
        var post_bar = $(this);
        var post_button = $(this).siblings('.drawer-handle');
        if (post_bar.hasClass("affix-panel-content")) {
            $('html').animate({'padding-bottom': 115}, 200);
        }
        $(this).on('click', '.affix-handle-close', function () {
            post_button.addClass('rec-panel-active');
            $('html').animate({'padding-bottom': 0}, 200);
            $('html').addClass('affix-panel-disabled');
        });
        post_button.on('click', function () {
            post_button.removeClass('rec-panel-active');
            $('html').animate({'padding-bottom': 115}, 200);
            $('html').removeClass('affix-panel-disabled');
        });
    });

    // Carousel Block Home
    var count = 1;
    $(".theme-carousel-slider").each(function () {

        $(this).closest('.theme-block-carousel').find('.slide-prev-1').addClass('slide-prev-1' + count);
        $(this).closest('.theme-block-carousel').find('.slide-next-1').addClass('slide-next-1' + count);
        $(this).slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplaySpeed: 8000,
            infinite: true,
            prevArrow: $('.slide-prev-1' + count),
            nextArrow: $('.slide-next-1' + count),
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        count++;

    });

    // Slider Block Home Image and content
    $(".theme-slider-main").each(function () {

        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: true,
            autoplaySpeed: 8000,
            infinite: true,
            dots: false,
            arrows: false,
            asNavFor: '.theme-slider-navigator',
        });

    });

    // Slider Block Home Navigation
    $('.theme-slider-navigator').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.theme-slider-main',
        dots: false,
        arrows: false,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // Banner Block 1
    $(".theme-slider-block").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-next-icon ion ion-ios-arrow-forward"></button>',
            prevArrow: '<button type="button" class="slide-btn slide-prev-icon ion ion-ios-arrow-back"></button>',
            dots: false,
        });
    });

    // Ticker Post Slider
    $(".ticker-slides").each(function () {
        $(this).slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            fade: false,
            draggable: true,
            autoplay: true,
            autoplaySpeed: 1000,
            infinite: true,
            nextArrow: '.slide-next-ticker',
            prevArrow: '.slide-prev-ticker',
            dots: false,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });

    // Template Carousel Slider
    $(".template-carousel-slide").each(function () {
        $(this).slick({
            autoplay: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-next-icon ion ion-ios-arrow-forward"></button>',
            prevArrow: '<button type="button" class="slide-btn slide-prev-icon ion ion-ios-arrow-back"></button>',
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });

    //Template Slide Slider
    $(".template-slide").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-next-icon ion ion-ios-arrow-forward"></button>',
            prevArrow: '<button type="button" class="slide-btn slide-prev-icon ion ion-ios-arrow-back"></button>',
            dots: false
        });
    });

    var pageSection = $(".data-bg");
    pageSection.each(function (indx) {
        if ($(this).attr("data-background")) {
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });

    // Masonry Grid
    if ($('.archive-layout-masonry').length > 0) {
        /*Default masonry animation*/
        var grid;
        var hidden = 'scale(0.5)';
        var visible = 'scale(1)';
        grid = $('.archive-layout-masonry').imagesLoaded(function () {
            grid.masonry({
                itemSelector: '.twp-archive-items',
                hiddenStyle: {
                    transform: hidden,
                    opacity: 0
                },
                visibleStyle: {
                    transform: visible,
                    opacity: 1
                }
            });
        });
    }

    // Masonry Script
    if ( $('.all-item-content').length > 0 ) {
        /*Default masonry animation*/
        var grid1;
        var hidden1 = 'scale(0.5)';
        var visible1 = 'scale(1)';
        grid1 = $('.all-item-content').imagesLoaded(function () {
            grid1.masonry({
                itemSelector: '.twp-masonary-item',
                hiddenStyle: {
                    transform: hidden1,
                    opacity: 0
                },
                visibleStyle: {
                    transform: visible1,
                    opacity: 1
                }
            });
        });
    }

    // Sticky Components
    $('.widget-area, .post-content-share').theiaStickySidebar({
        additionalMarginTop: 30
    });

    // Widget Tab
    $('.twp-nav-tabs .tab').on('click', function (event) {
        var tabid = $(this).attr('id');
        $(this).closest('.tabbed-container').find('.tab').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.tabbed-container').find('.tab-pane').removeClass('active');
        $('#content-' + tabid).addClass('active');
    });

    // Scroll TO Top Hide & show

    $(window).scroll(function () {
        
        if ($(window).scrollTop() > $(window).height() / 2) {
            $(".scroll-up").fadeIn(300);
        } else {
            $(".scroll-up").fadeOut(300);
        }

    });

    // Scroll to Top on Click
    $('.scroll-up').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 700);
        return false;
    });

});


/*  -----------------------------------------------------------------------------------------------
    Intrinsic Ratio Embeds
--------------------------------------------------------------------------------------------------- */

var tribunal = tribunal || {},
    $ = jQuery;

var $doc = $(document),
    $win = $(window),

viewport = {};
viewport.top = $win.scrollTop();
viewport.bottom = viewport.top + $win.height();

tribunal.instrinsicRatioVideos = {

    init: function () {

        tribunal.instrinsicRatioVideos.makeFit();

        $win.on('resize fit-videos', function () {

            tribunal.instrinsicRatioVideos.makeFit();

        });

    },

    makeFit: function () {

        var vidSelector = "iframe, object, video";

        $(vidSelector).each(function () {

            var $video = $(this),
                $container = $video.parent(),
                iTargetWidth = $container.width();

            // Skip videos we want to ignore
            if ($video.hasClass('intrinsic-ignore') || $video.parent().hasClass('intrinsic-ignore')) {
                return true;
            }

            if (!$video.attr('data-origwidth')) {

                // Get the video element proportions
                $video.attr('data-origwidth', $video.attr('width'));
                $video.attr('data-origheight', $video.attr('height'));

            }

            // Get ratio from proportions
            var ratio = iTargetWidth / $video.attr('data-origwidth');

            // Scale based on ratio, thus retaining proportions
            $video.css('width', iTargetWidth + 'px');
            $video.css('height', ($video.attr('data-origheight') * ratio) + 'px');

        });

    }

};

$doc.ready(function () {

    tribunal.instrinsicRatioVideos.init();      // Retain aspect ratio of videos on window resize

});