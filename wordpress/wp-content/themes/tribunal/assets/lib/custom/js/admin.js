(function ($) {

    var ajaxurl = tribunal_admin_script_data.ajax_url;
    var tribunalNonce = tribunal_admin_script_data.ajax_nonce;
    var custom_theme_file_frame;

    // Remove image.
    jQuery(document).on('click', 'input.btn-image-remove', function( e ) {

        e.preventDefault();
        var $this = $(this);
        var image_field = $this.siblings('.img');
        image_field.val('');
        var image_preview_wrap = $this.siblings('.image-preview-wrap');
        image_preview_wrap.html('');
        $this.css('display','none');
        image_field.trigger('change');

    });

    $('.twp-img-upload-button').click( function(){

        event.preventDefault();
        var imgContainer = $(this).closest('.twp-img-fields-wrap').find( '.twp-thumbnail-image .twp-img-container'),
        removeimg = $(this).closest('.twp-img-fields-wrap').find( '.twp-img-delete-button'),
        imgIdInput = $(this).siblings('.upload-id');
        var frame;

        // Create a new media frame
        frame = wp.media({
            title: tribunal_admin_script_data.upload_image,
            button: {
            text: tribunal_admin_script_data.use_imahe
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on( 'select', function() {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();
            // Send the attachment URL to our custom image input field.
            imgContainer.html( '<img src="'+attachment.url+'" style="width:200px;height:auto;" />' );
            removeimg.addClass('twp-img-show');
            // Send the attachment id to our hidden input
            imgIdInput.val( attachment.url ).trigger('change');

        });

        // Finally, open the modal on click
        frame.open();

    });

    // DELETE IMAGE LINK
    $('.twp-img-delete-button').click( function(){

        event.preventDefault();
        var imgContainer = $(this).closest('.twp-img-fields-wrap').find( '.twp-thumbnail-image .twp-img-container');
        var removeimg = $(this).closest('.twp-img-fields-wrap').find( '.twp-img-delete-button');
        var imgIdInput = $(this).closest('.twp-img-fields-wrap').find( '.upload-id');
        // Clear out the preview image
        imgContainer.find('img').remove();
        removeimg.removeClass('twp-img-show');
        // Delete the image id from the hidden input
        imgIdInput.val( '' ).trigger('change');

    });

    // Remove IMAGE AFTER CATEGORY CREATED LINK
    $(document).ajaxSuccess(function(e, request, settings){

        var object = settings.data;
        if( typeof object == 'string' ){

            var object = object.split("&");

            if( object.includes( 'action=add-tag' ) && object.includes( 'screen=edit-category' ) && object.includes( 'taxonomy=category' ) ){
                
                $('.twp-img-delete-button').removeClass('twp-img-show');
                $('.upload-id').attr('value','');
                $('.twp-img-container').empty();

            }

        }

    });

    // Metabox Tab
    $('.metabox-navbar a').click(function (){
        var tabid = $(this).attr('id');
        $('.metabox-navbar a').removeClass('metabox-navbar-active');
        $(this).addClass('metabox-navbar-active');
        $('.twp-tab-content .metabox-content-wrap').hide();
        $('.twp-tab-content #'+tabid+'-content').show();
        $('.twp-tab-content .metabox-content-wrap').removeClass('metabox-content-wrap-active');
        $('.twp-tab-content #'+tabid+'-content').addClass('metabox-content-wrap-active');
    });


    // Dismiss notice
    $('.twp-custom-setup').click(function(){
        
        var data = {
            'action': 'tribunal_notice_dismiss',
            '_wpnonce': tribunalNonce,
        };
 
        $.post(ajaxurl, data, function( response ) {

            $('.twp-tribunal-notice').hide();
            
        });

    });

    // Getting Start action
    $('.twp-install-active').click(function(){

        $(this).closest('.twp-tribunal-notice').addClass('twp-installing');

        var data = {
            'action': 'tribunal_getting_started',
            '_wpnonce': tribunalNonce,
        };
 
        $.post(ajaxurl, data, function( response ) {

            window.location.href = response+'&tab=getting-started';
            
        });

    });

    $('.required-plugin-details .twp-active-deactivate').click(function(){
        
        var id = $(this).closest('.tribunal-about-col').attr('id');

        $(this).addClass('twp-activating-plugin')
        var PluginName = $(this).closest('.required-plugin-details').find('h2').text();
        var PluginStatus = $(this).attr('plugin-status');
        var PluginFile = $(this).attr('plugin-file');
        var PluginFolder = $(this).attr('plugin-folder');
        var PluginSlug = $(this).attr('plugin-slug');
        var pluginClass = $(this).attr('plugin-class');

        var data = {
            'single': true,
            'PluginStatus': PluginStatus,
            'PluginFile': PluginFile,
            'PluginFolder': PluginFolder,
            'PluginSlug': PluginSlug,
            'PluginName': PluginName,
            'pluginClass': pluginClass,
            'action': 'tribunal_getting_started',
            '_wpnonce': tribunalNonce,
        };
 
        $.post(ajaxurl, data, function( response ) {

            var active = tribunal_admin_script_data.active
            var deactivate = tribunal_admin_script_data.deactivate
            $('#'+id+' .twp-active-deactivate').empty();

            if( response == 'Deactivated' ){
                
                $('#'+id+' .required-plugin-details').removeClass('required-plugin-active');
                $('#'+id+' .twp-active-deactivate').removeClass('twp-plugin-active');
                $('#'+id+' .twp-active-deactivate').addClass('twp-plugin-deactivate');
                $('#'+id+' .twp-active-deactivate').html(active);
                $('#'+id+' .twp-active-deactivate').attr('plugin-status','deactivate');

            }else if( response == 'Activated' ){
                
                $('#'+id+' .required-plugin-details').addClass('required-plugin-active');
                $('#'+id+' .twp-active-deactivate').removeClass('twp-plugin-deactivate');
                $('#'+id+' .twp-active-deactivate').addClass('twp-plugin-active');
                $('#'+id+' .twp-active-deactivate').html(deactivate);
                $('#'+id+' .twp-active-deactivate').attr('plugin-status','active');

            }else{
                
                $('#'+id+' .required-plugin-details').removeClass('required-plugin-active');
                $('#'+id+' .twp-active-deactivate').removeClass('twp-plugin-not-install');
                $('#'+id+' .twp-active-deactivate').addClass('twp-plugin-active');
                $('#'+id+' .twp-active-deactivate').html(active);
                $('#'+id+' .twp-active-deactivate').attr('plugin-status','deactivate');

            }

            $('.twp-active-deactivate').removeClass('twp-activating-plugin');
            $('#'+id+' .twp-installation-message').empty();
            $('#'+id+' .twp-installation-message').html(response);
            
        });
    });

}(jQuery));