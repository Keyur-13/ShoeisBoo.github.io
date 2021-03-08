jQuery(document).ready(function($) {

    const cats = [];
    var ccat;
    var ccat1;
    var scat;


    function tribunalCheckValue(value,arr){
      var status = 'hasnot';
     
      for(var i=0; i<arr.length; i++){
        var name = arr[i];
        if(name == value){
          status = 'has';
          break;
        }
      }

      return status;
    }

    function TribunalCurrent_select(cval){

        cats1 = [];
        $('.tribunal-custom-cat-color').each(function(){

            ccat1 = $(this).find('select option:selected').val();
            if( ccat1 ){

                cats1.push(ccat1);

            }

        });

        $('.tribunal-custom-cat-color').each(function(){

            cscat = $(this).find('select option:selected').val();

            $(this).find('select').empty().append( tribunal_repeater.categories);

            $(this).find('select option').each( function(){
                
                if(   $(this).val() != cscat ){
                    console.log('aaa');
                    if ( $(this).val() == cval || ( tribunalCheckValue($(this).val(),cats1) == 'has' && $(this).val() != cscat ) ) {
                        
                        $(this).remove();
                    }
                    
                }

                if(  $(this).val() == cscat ){
                    $(this).attr("selected","selected");
                }

            });

        });

    }

    
    // Show Title Sections While Loadiong.
    $('.tribunal-repeater-field-control').each(function(){

        ccat = $(this).find('.tribunal-custom-cat-color select option:selected').val();
        if( ccat ){

            cats.push(ccat);

        }
        
    });

    $('.tribunal-custom-cat-color select').change(function(){

        optionSelected = $("option:selected", this);
        var ckey = optionSelected.val();
        $("option", this).removeAttr("selected");
        $(this).val(ckey).find("option[value=" + ckey +"]").attr('selected', true);
        
        TribunalCurrent_select(ckey);
    });

    // Show Title Sections While Loadiong.
    $('.tribunal-repeater-field-control').each(function(){

        var title = $(this).find('.home-section-type option:selected').text();
        $(this).find('.tribunal-repeater-field-title').text(title);
        var title_key = $(this).find('.home-section-type option:selected').val();

        $(this).find('.home-repeater-fields-hs').hide();
        $(this).find('.'+title_key+'-fields').show();

        var tabchecked = $(this).find(".ed-tabs-ac input[type='checkbox']").val();
        if( title_key == 'banner-blocks-1' ){
            if( tabchecked == 'no' ){
                $(this).find('.banner-block-1-tab-ac').hide();
            }
        }

        var ribbonbg = $(this).find(".ribbon-bg-ac input[type='checkbox']").val();
        if( title_key == 'post-list-block' || title_key == 'banner-blocks-1' || title_key == 'banner-blocks-2' || title_key == 'banner-blocks-3' || title_key == 'banner-blocks-4' || title_key == 'lead-blocks' ){
            if( ribbonbg == 'no' || ribbonbg == '' ){
                $(this).find('.ribbon-bg-option-ac').hide();
            }
        }

        scat = $(this).find('.tribunal-custom-cat-color select option:selected').val();

        $(this).find('.tribunal-custom-cat-color select option').each( function(){
            
            if ( tribunalCheckValue($(this).val(),cats) == 'has' && $(this).val() != scat ) {
              $(this).remove();
            }

        });

    });


    $(".ed-tabs-ac input[type='checkbox']").click(function(){

        if( $(this).val() == 'no' || $(this).val() == '' ){
            $(this).closest('.tribunal-repeater-field-control').find('.banner-block-1-tab-ac').show();
        }else{
            $(this).closest('.tribunal-repeater-field-control').find('.banner-block-1-tab-ac').hide();
        }

    });

    $(".ribbon-bg-ac input[type='checkbox']").click(function(){
        
        if( $(this).val() == 'no' || $(this).val() == '' ){
            $(this).closest('.tribunal-repeater-field-control').find('.ribbon-bg-option-ac').show();
        }else{
            $(this).closest('.tribunal-repeater-field-control').find('.ribbon-bg-option-ac').hide();
        }

    });

    $(".radio-labels label").click(function(){
        
        $(this).closest('.radio-labels').find('label').removeClass('radio-active');
        $(this).addClass('radio-active');

    });

    $('.tribunal-custom-cat-color').each(function(){

        var catTitle = $(this).closest('.tribunal-repeater-field-control').find('.tribunal-custom-cat-color option:selected').text();
        $(this).closest('.tribunal-repeater-field-control').find('.tribunal-repeater-field-title').text( catTitle );

    });

    $('.tribunal-custom-cat-color select').change(function(){

        var optionSelected = $("option:selected", this);
        var textSelected   = optionSelected.text();
        var title_key = optionSelected.val();

        $(this).closest('.tribunal-repeater-field-control').find('.tribunal-repeater-field-title').text( textSelected );

    });



    // Show Title After Secect Section Type.
    $('.home-section-type select').change(function(){

        var optionSelected = $("option:selected", this);
        var textSelected   = optionSelected.text();
        var title_key = optionSelected.val();

        $(this).closest('.tribunal-repeater-field-control').find('.home-repeater-fields-hs').hide();
        $(this).closest('.tribunal-repeater-field-control').find('.'+title_key+'-fields').show();

        $(this).closest('.tribunal-repeater-field-control').find('.tribunal-repeater-field-title').text( textSelected );
        if( title_key == 'banner-blocks-1' ){
            var tabchecked = $(this).closest('.tribunal-repeater-field-control').find(".ed-tabs-ac input[type='checkbox']").val();
            if( tabchecked == 'no' || tabchecked == '' ){
                $(this).closest('.tribunal-repeater-field-control').find('.banner-block-1-tab-ac').hide();
            }
        }

        if( title_key == 'post-list-block' || title_key == 'banner-blocks-1' || title_key == 'banner-blocks-2' || title_key == 'banner-blocks-3' || title_key == 'banner-blocks-4' || title_key == 'lead-blocks' ){
            var tabchecked = $(this).closest('.tribunal-repeater-field-control').find(".ribbon-bg-ac input[type='checkbox']").val();
            if( tabchecked == 'no' || tabchecked == '' ){
                $(this).closest('.tribunal-repeater-field-control').find('.ribbon-bg-option-ac').hide();
            }
        }

    });

    // Save Value.
    function tribunal_refresh_repeater_values(){

        $(".tribunal-repeater-field-control-wrap").each(function(){
            
            var values = []; 
            var $this = $(this);
            
            $this.find(".tribunal-repeater-field-control").each(function(){
            var valueToPush = {};   

            $(this).find('[data-name]').each(function(){
                var dataName = $(this).attr('data-name');
                var dataValue = $(this).val();
                valueToPush[dataName] = dataValue;
            });

            values.push(valueToPush);
            });

            $this.next('.tribunal-repeater-collector').val( JSON.stringify( values ) ).trigger('change');
        });

    }

    $("body").on("click",'.tribunal-add-control-field', function(){

        var $this = $(this).parent();
        if(typeof $this != 'undefined') {

            var field = $this.find(".tribunal-repeater-field-control:first").clone();


            if(typeof field != 'undefined'){
                
                field.find("input[type='text'][data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find("textarea[data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find("select[data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });


                field.find(".selector-labels label").each(function(){
                    var defaultValue = $(this).closest('.selector-labels').next('input[data-name]').attr('data-default');
                    var dataVal = $(this).attr('data-val');
                    $(this).closest('.selector-labels').next('input[data-name]').val(defaultValue);

                    if(defaultValue == dataVal){
                        $(this).addClass('selector-selected');
                    }else{
                        $(this).removeClass('selector-selected');
                    }
                });
                
                field.find('.tribunal-fields').show();

                $this.find('.tribunal-repeater-field-control-wrap').append(field);
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                tribunal_refresh_repeater_values();
            }

            // Show Title After Secect Section Type.
            $('.home-section-type select').change(function(){
                var optionSelected = $("option:selected", this);
                var textSelected   = optionSelected.text();
                var title_key = optionSelected.val();

                $(this).closest('.tribunal-repeater-field-control').find('.home-repeater-fields-hs').hide();
                $(this).closest('.tribunal-repeater-field-control').find('.'+title_key+'-fields').show();

                $(this).closest('.tribunal-repeater-field-control').find('.tribunal-repeater-field-title').text(textSelected);

                $(this).closest('.tribunal-repeater-field-control').find('.tribunal-repeater-field-title').text( textSelected );
                if( title_key == 'banner-blocks-1' ){
                    var tabchecked = $(this).closest('.tribunal-repeater-field-control').find(".ed-tabs-ac input[type='checkbox']").val();
                    if( tabchecked == 'no' || tabchecked == '' ){
                        $(this).closest('.tribunal-repeater-field-control').find('.banner-block-1-tab-ac').hide();
                    }
                }

                if(  title_key == 'post-list-block' || title_key == 'banner-blocks-1' || title_key == 'banner-blocks-2' || title_key == 'banner-blocks-3' || title_key == 'banner-blocks-4' || title_key == 'lead-blocks' ){
                    var tabchecked = $(this).closest('.tribunal-repeater-field-control').find(".ribbon-bg-ac input[type='checkbox']").val();
                    if( tabchecked == 'no' || tabchecked == '' ){
                        $(this).closest('.tribunal-repeater-field-control').find('.ribbon-bg-option-ac').hide();
                    }
                }

            });

            $('.tribunal-custom-cat-color select').change(function(){
                var optionSelected = $("option:selected", this);
                var textSelected   = optionSelected.text();
                var title_key = optionSelected.val();

                $(this).closest('.tribunal-repeater-field-control').find('.tribunal-repeater-field-title').text(textSelected);

            });


            $(".radio-labels label").click(function(){
        
                $(this).closest('.radio-labels').find('label').removeClass('radio-active');
                $(this).addClass('radio-active');

            });

            field.find(".tribunal-type-radio input[type='radio']").each(function(){
                    var defaultValue = $(this).closest('.radio-labels').next('input[data-name]').attr('data-default');
                $(this).closest('.radio-labels').next('input[data-name]').val(defaultValue);
                
                if($(this).val() == defaultValue){
                    $(this).prop('checked',true);
                }else{
                    $(this).prop('checked',false);
                }
            });
            
            // Active Callback
            $(".ed-tabs-ac input[type='checkbox']").click(function(){

                if( $(this).val() == 'no' ){
                    $(this).closest('.tribunal-repeater-field-control').find('.banner-block-1-tab-ac').show();
                }else{
                    $(this).closest('.tribunal-repeater-field-control').find('.banner-block-1-tab-ac').hide();
                }

            });

            $(".ribbon-bg-ac input[type='checkbox']").click(function(){

                if( $(this).val() == 'no' || $(this).val() == '' ){
                    $(this).closest('.tribunal-repeater-field-control').find('.ribbon-bg-option-ac').show();
                }else{
                    $(this).closest('.tribunal-repeater-field-control').find('.ribbon-bg-option-ac').hide();
                }

            });

            $('.tribunal-repeater-field-control-wrap li:last-child').find('.home-repeater-fields-hs').hide();
            $('.tribunal-repeater-field-control-wrap li:last-child').find('.grid-posts-fields').show();

            $('.tribunal-repeater-field-control-wrap li').removeClass('twp-sortable-active');
            $('.tribunal-repeater-field-control-wrap li:last-child').addClass('twp-sortable-active');
            $('.tribunal-repeater-field-control-wrap li:last-child .tribunal-repeater-fields').addClass('twp-sortable-active extended');
            $('.tribunal-repeater-field-control-wrap li:last-child .tribunal-repeater-fields').show();

            $('.tribunal-repeater-field-control.twp-sortable-active .title-rep-wrap').click(function(){
                $(this).next('.tribunal-repeater-fields').slideToggle();
            });

            field.find('.customizer-color-picker').each(function(){

                if( $(this).closest('.tribunal-repeater-field-control').hasClass('twp-sortable-active') ){
                    
                    $(this).closest('.tribunal-repeater-field-control').find('.wp-picker-container').addClass('old-one');
                    $(this).closest('.tribunal-repeater-field-control').find('.tribunal-type-colorpicker .description.customize-control-description').after('<input data-default="" class="customizer-color-picker" data-alpha="true" data-name="category_color" type="text" value="#d0021b">');
                    
                    $(this).closest('.tribunal-repeater-field-control').find('.customizer-color-picker').wpColorPicker({
                        defaultColor: '#d0021b',
                        change: function(event, ui){
                            setTimeout(function(){
                            tribunal_refresh_repeater_values();
                            }, 100);
                        }
                    }).parents('.customizer-type-colorpicker').find('.wp-color-result').first().remove();

                    $(this).closest('.tribunal-repeater-field-control').find('.old-one').remove();

                }
            });
            

            var cats2 = '';
            $('.tribunal-custom-cat-color').each(function(){

                cats2 = $(this).find('select option:selected').val();
                if(cats2) {
                    return false; // breaks
                }

            });

            // Category Color Code Start
            field.val(cats2).find("select option[value=" + cats2 +"]").remove();

            field.find('.tribunal-custom-cat-color select').change(function(){

                optionSelected1 = $("option:selected", this);
                var ckey1 = optionSelected1.val();
                $(this).val(ckey1).find("option[value=" + ckey1 +"]").attr('selected', true);
                
                TribunalCurrent_select(ckey1);
            });

            // Category Color Code end

            $('.tribunal-repeater-field-control-wrap li:last-child .tribunal-repeater-field-title').text(tribunal_repeater.new_section);
            $this.find(".tribunal-repeater-field-control:last .home-section-type select").empty().append( tribunal_repeater.optionns);
        }
        return false;
    });
    
    $('.tribunal-repeater-field-control .title-rep-wrap').click(function(){
        $(this).next('.tribunal-repeater-fields').slideToggle().toggleClass('extended');
    });

    //MultiCheck box Control JS
    $( 'body' ).on( 'change', '.tribunal-type-multicategory input[type="checkbox"]' , function() {
        var checkbox_values = $( this ).parents( '.tribunal-type-multicategory' ).find( 'input[type="checkbox"]:checked' ).map(function(){
            return $( this ).val();
        }).get().join( ',' );
        $( this ).parents( '.tribunal-type-multicategory' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        tribunal_refresh_repeater_values();
    });

    $('body').on('change','.tribunal-type-radio input[type="radio"]', function(){
        var $this = $(this);
        $this.parent('label').siblings('label').find('input[type="radio"]').prop('checked',false);
        var value = $this.closest('.radio-labels').find('input[type="radio"]:checked').val();
        $this.closest('.radio-labels').next('input').val(value).trigger('change');
    });

    //Checkbox Multiple Control
    $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {
        checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
            function() {
                return this.value;
            }
        ).get().join( ',' );

        $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
    });

    $('.customizer-color-picker').each(function(){
        $(this).wpColorPicker({
            defaultColor: '#d0021b',
            change: function(event, ui){
                setTimeout(function(){
                tribunal_refresh_repeater_values();
                }, 100);
            }
        }).parents('.customizer-type-colorpicker').find('.wp-color-result').first().remove();
    });

    // ADD IMAGE LINK
    $('.customize-control-repeater').on( 'click', '.twp-img-upload-button', function( event ){
        event.preventDefault();

        var imgContainer = $(this).closest('.twp-img-fields-wrap').find( '.thumbnail-image'),
        placeholder = $(this).closest('.twp-img-fields-wrap').find( '.placeholder'),
        imgIdInput = $(this).siblings('.upload-id');

        // Create a new media frame
        frame = wp.media({
            title: tribunal_repeater.upload_image,
            button: {
            text: tribunal_repeater.use_imahe
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on( 'select', function() {

        // Get media attachment details from the frame state
        var attachment = frame.state().get('selection').first().toJSON();

        // Send the attachment URL to our custom image input field.
        imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
        placeholder.addClass('hidden');

        // Send the attachment id to our hidden input
        imgIdInput.val( attachment.url ).trigger('change');

        });

        // Finally, open the modal on click
        frame.open();
    });
    // DELETE IMAGE LINK
    $('.customize-control-repeater').on( 'click', '.twp-img-delete-button', function( event ){

        event.preventDefault();
        var imgContainer = $(this).closest('.twp-img-fields-wrap').find( '.thumbnail-image'),
        placeholder = $(this).closest('.twp-img-fields-wrap').find( '.placeholder'),
        imgIdInput = $(this).siblings('.upload-id');

        // Clear out the preview image
        imgContainer.find('img').remove();
        placeholder.removeClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val( '' ).trigger('change');

    });

    $("#customize-theme-controls").on("click", ".tribunal-repeater-field-remove",function(){
        if( typeof  $(this).parent() != 'undefined'){
            $(this).closest('.tribunal-repeater-field-control').slideUp('normal', function(){
                $(this).remove();
                tribunal_refresh_repeater_values();
            });
            
        }
        return false;
    });

    $('.wp-picker-clear').click(function(){
         tribunal_refresh_repeater_values();
    });

    $('#customize-theme-controls').on('click', '.tribunal-repeater-field-close', function(){
        $(this).closest('.tribunal-repeater-fields').slideUp();
        $(this).closest('.tribunal-repeater-field-control').toggleClass('expanded');
    });

    /*Drag and drop to change order*/
    $(".tribunal-repeater-field-control-wrap").sortable({
        axis: 'y',
        orientation: "vertical",
        update: function( event, ui ) {
            tribunal_refresh_repeater_values();
        }
    });

    $("#customize-theme-controls").on('keyup change', '[data-name]',function(){
         tribunal_refresh_repeater_values();
         return false;
    });

    $("#customize-theme-controls").on('change', 'input[type="checkbox"][data-name]',function(){
        if($(this).is(":checked")){
            $(this).val('yes');
        }else{
            $(this).val('no');
        }
        tribunal_refresh_repeater_values();
        return false;
    });

});