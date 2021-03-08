jQuery(document).ready(function($){
"use scrict";
    
    // Preloader
    $(window).load(function(){
        setTimeout(function () {
            $('.ta-preloader').fadeOut();
        }, 300);
    });

    // Menu
    $('#primary-menu .menu-item-has-children > a, #primary-menu .page_item_has_children > a').after('<button class="child-menu-toggle"><i class="fas fa-chevron-down"></i></button>');

    $('.menu-item-has-children .child-menu-toggle, .page_item_has_children .child-menu-toggle').click(function(){
        $(this).toggleClass('active');
        $(this).siblings('.sub-menu').slideToggle();
        $(this).siblings('.children').slideToggle();
    });

    // $('.menu-toggle')
    $('.menu-toggle-close, .menu-toggle').click(function(){
        $('#site-navigation').toggleClass('toggled');

        if( $('#site-navigation').hasClass('toggled') ){

            setTimeout(function () {
                $('.menu-toggle-close').focus();
            }, 100);

        }else{

            setTimeout(function () {
                $('.menu-toggle').focus();
            }, 100);

        }

    });

    // Focus on last menu
    $('.nav-focus-menu-last').focus(function(){

        $('#primary-menu li:last-child a').focus();

    });

    // Focus on First menu
    $('.nav-focus-menu-close').focus(function(){

        $('.menu-toggle-close').focus();

    });

    // Toggle Search
    $('.ta-search-toggle, a#ta-search-close ').click(function(){

        $('.ta-header-search').toggleClass('ta-search-show');
        $('.ta-header-search-main').toggleClass('show');

        if( $('.ta-header-search').hasClass('ta-search-show') ){

            setTimeout(function () {
                $('.ta-header-search input.search-field').focus();
            }, 100);

        }

    });

    // Search Focus Within Model
    $('body').keyup(function(e) {

        var code = e.keyCode || e.which;
        if (code == '9') {

            $("#ta-search-close").focusout(function () {
                $('.ta-header-search input.search-field').focus();
            });

        }
    });

    $('.nav-focus-close').focus(function(){
        $('#ta-search-close').focus();
    });

    // Escape function for search and menu
    $(document).keyup(function(e) {

        if (e.keyCode === 27){

            if( $('.ta-header-search').hasClass('ta-search-show') ){

                $('.ta-header-search').toggleClass('ta-search-show');
                $('.ta-header-search-main').toggleClass('show');

                setTimeout(function () {
                    $('.ta-search-toggle').focus();
                }, 100);

            }

            if( $('#site-navigation').hasClass('toggled') ){

                $('#site-navigation').toggleClass('toggled');

                setTimeout(function () {
                    $('.menu-toggle').focus();
                }, 100);

            }

        }

    });

    //Sickey Sidebar
    $('#secondary, #primary').theiaStickySidebar();
    
    // Masonry
    $('.archive-masonry').masonry({
        itemSelector: '.ta-archive-masonry',
    });

    // Match Height
    $('.ta-match-height').matchHeight();

    // Show and hide scroll to top button
    $(window).scroll(function(){

        if($(window).scrollTop() > 300){

            $('#ta-go-top').removeClass('ta-off');

        }else{

            $('#ta-go-top').addClass('ta-off');

        }

    });

    // Scroll To Top
    $('#ta-go-top').click(function(){

        $('html,body').animate({scrollTop:0},800);

    });

    if( $('body').hasClass('rtl') ){
        $('.action-banner-1, .ta-banner-nav-loop, .ta-banner-1-action, .ta-banner-2-action, .ta-banner-3-action, .gallery.gallery-columns-1, ul.wp-block-gallery.columns-1, .wp-block-gallery.columns-1 .blocks-gallery-grid').each(function(){
            $(this).attr('data-slick','{"rtl": true}');
        });
    }

    // Banner 1 Slider
    $('.action-banner-1').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          dots: false,
    });

    // Banner 1 Nav
    $('.ta-banner-nav-loop').click(function(){

        var goTo = $(this).closest('.ta-banner-nav-loop').attr('index-data');
        $('.action-banner-1').slick('slickGoTo', goTo);

    });

    // Banner 2 Slider
    $('.ta-banner-1-action').slick({
        slidesToShow: 1,
        arrows: true,
        dots: false,
        nextArrow: '<span class="ta-next-arrow"><svg viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-right fa-w-8 fa-3x"><path fill="currentColor" d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z" class=""></path></svg></span>',
        prevArrow: '<span class="ta-prev-arrow"><svg viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-left fa-w-8 fa-3x"><path fill="currentColor" d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z" class=""></path></svg></span>',
    });

    $('.ta-banner-2-action').slick({
        slidesToShow: 3,
        arrows: true,
        dots: false,
        nextArrow: '<span class="ta-next-arrow"><svg viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-right fa-w-8 fa-3x"><path fill="currentColor" d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z" class=""></path></svg></span>',
        prevArrow: '<span class="ta-prev-arrow"><svg viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-left fa-w-8 fa-3x"><path fill="currentColor" d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z" class=""></path></svg></span>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // Banner 2 Slider
    $('.ta-banner-3-action').slick({
        centerPadding: '150px',
        slidesToShow: 1,
        arrows: true,
        centerMode: true,
        dots: false,
        nextArrow: '<span class="ta-next-arrow"><svg viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-right fa-w-8 fa-3x"><path fill="currentColor" d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z" class=""></path></svg></span>',
        prevArrow: '<span class="ta-prev-arrow"><svg viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-left fa-w-8 fa-3x"><path fill="currentColor" d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z" class=""></path></svg></span>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    centerPadding: '50px',
                }
            },
            {
                breakpoint: 600,
                settings: {
                     centerMode: false,
                }
            }
        ]
    });

    // Sidebar Gallery Slide
    $('.gallery.gallery-columns-1, ul.wp-block-gallery.columns-1, .wp-block-gallery.columns-1 .blocks-gallery-grid').slick({
        slidesToShow: 1,
        arrows: true,
        dots: false,
        nextArrow: '<span class="ta-next-arrow"><svg viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-right fa-w-8 fa-3x"><path fill="currentColor" d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z" class=""></path></svg></span>',
        prevArrow: '<span class="ta-prev-arrow"><svg viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-left fa-w-8 fa-3x"><path fill="currentColor" d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z" class=""></path></svg></span>',
    });

});