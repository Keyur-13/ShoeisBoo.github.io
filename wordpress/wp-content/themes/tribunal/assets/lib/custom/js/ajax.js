
jQuery(document).ready(function ($) {
    "use strict";

    var ajaxurl = tribunal_ajax.ajax_url;

    // Tab Posts ajax Load
    $('.tab-posts a').click( function(){

        var category = $(this).attr('cat-data');
        var sectionid = $(this).closest('.theme-block-elements-1').attr('id');
        var curentelement = $('#'+sectionid+' .tab-content-'+category);
        $('#'+sectionid+' .tab-posts a').removeClass( 'active-tab' );
        $(this).addClass('active-tab');
        $(this).closest('.theme-block-elements-1').find('.tab-contents').removeClass('content-active');
        $( curentelement ).addClass( 'content-active' );
        var currencBlock = $( curentelement ).closest('.theme-block-elements-1').attr('repeat-time');

        if( !$( curentelement ).hasClass( 'content-loaded' ) ){

            $( curentelement ).addClass( 'content-loading' );

            var data = {
                'action': 'tribunal_tab_posts_callback',
                'category': category,
                'currencBlock': currencBlock,
                '_wpnonce': tribunal_ajax.ajax_nonce,
            };

            $.post(ajaxurl, data, function( response ) {

                $( curentelement ).html( response );

                if( !$( curentelement ).closest('.theme-block-elements-1').find('tab-contents').hasClass('content-loaded') ){

                    $('.'+currencBlock + '-content-active').each(function(){

                        $(this).removeClass(currencBlock + '-content-active');

                    });

                }

                $( curentelement ).removeClass( 'content-loading' );
                $( curentelement ).addClass( 'content-loaded' );
                $( curentelement ).find( '.content-loading-status' ).remove();

            });

        }

    });

    // Masonry Posts
    $('body').on('click', '.loadmore', function() {
        
        var grid;
        var loading = tribunal_pagination.loading;
        var loadmore = tribunal_pagination.loadmore;
        var nomore = tribunal_pagination.nomore;
        var section_category = $(this).closest('.btn-loadmore').attr('section_category');
        var paged_current = $(this).closest('.btn-loadmore').attr('paged_current');
        var new_paged = paged_current;
        new_paged++;

        $(this).closest('.btn-loadmore').attr('paged_current',new_paged++);
        var current_sec = $(this).closest('.theme-block-masonry').attr('repeat-time');
        $(this).addClass('loading');
        $(this).html('<span class="ajax-loader"></span><span>'+loading+'</span>');
        var data = {
            'action': 'tribunal_masonry_posts',
            'section_category': section_category,
            'paged_current': paged_current,
            '_wpnonce': tribunal_ajax.ajax_nonce,
        };
 
        $.post(ajaxurl, data, function(response) {

            if( response ){

                var content_join = response.data.content.join('');
                var content = $(content_join);

                content.hide();
                
                grid = $('.'+current_sec+' .all-item-content');
                grid.append(content);
                grid.imagesLoaded( function() {

                    content.show();

                    var winwidth = $(window).width();
                    $(window).resize(function() {
                        winwidth = $(window).width();
                    });

                    if( winwidth > 990 ){
                        grid.masonry('appended', content).masonry();
                    }else{
                        grid.masonry('appended', content);
                    }
                });

                $('.twp-masonary-item-new').each(function(){
                    $(this).removeClass('twp-masonary-item-new');
                });
            }

            if( !$.trim(response) ){
                $('.loadmore').addClass('no-more-post');
                $('.loadmore').html(nomore);
            }else{
                $('.loadmore').html(loadmore);
            }

            $('.loadmore').removeClass('loading');
            

        });

    });

});