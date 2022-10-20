jQuery(document).ready(function($) {
    "use strict";

    $('.elementskit-menu-wpcolor-picker').wpColorPicker();
    var IconPicker = $('.elementskit-menu-icon-picker').fontIconPicker();

    var nonce = window.elementskit_megamenu_nonce;

    $('.elementskit-menu-item-save').on( 'click', function(){
        var spinner = $(this).parent().find('.spinner');
        var data = {
            settings: {
                menu_id : $('#elementskit-menu-modal-menu-id').val(),
                menu_has_child : $('#elementskit-menu-modal-menu-has-child').val(),

                menu_enable : $('#elementskit-menu-item-enable:checked').val(),
                menu_icon : $('#elementskit-menu-icon-field').val(),
                menu_icon_color : $('#elementskit-menu-icon-color-field').val(),
                menu_badge_text : $('#elementskit-menu-badge-text-field').val(),
                menu_badge_color : $('#elementskit-menu-badge-color-field').val(),
                menu_badge_background : $('#elementskit-menu-badge-background-field').val(),
                vertical_menu_width : $('#elementskit-menu-vertical-menu-width-field').val(),

                mobile_submenu_content_type : $('#mobile_submenu_content_type input[name=content_type]:checked').val(),
                vertical_megamenu_position_type : $('#vertical_megamenu_position_type input[name=position_type]:checked').val(),
                megamenu_width_type : $('#xs_megamenu_width_type input[name=width_type]:checked').val(),
            },
            nocache: (Math.floor(Date.now() / 1000))
        }
        // console.log(data.settings);
        spinner.addClass('loading');

        $.ajax({
            url :  window.elementskit.resturl + 'megamenu/save_menuitem_settings',
            type: 'get',
            data : data,
            headers: {
                'X-WP-Nonce': nonce
            },
            dataType: 'json',
            success: function (response) {
                spinner.removeClass('loading');
                // console.log(response);
                $('#elementskit-menu-item-settings-modal').modal('hide');
            }
        });
    });


    $('#elementskit-menu-builder-trigger').on( 'click', function(){
        var menu_id = $('#elementskit-menu-modal-menu-id').val();
        var url = window.elementskit.resturl + 'dynamic-content/content_editor/megamenu/menuitem' + menu_id;

        $("#elementskit-menu-builder-iframe").attr('src', url);
    });

    $("body").on('DOMSubtreeModified', "#menu-to-edit", function() {
        setTimeout(function(){
            $('#menu-to-edit li.menu-item').each(function() {
                var menu_item = $(this);
                if(menu_item.find('.elementskit_menu_trigger').length < 1){
                    $('.item-title', menu_item).append("<a data-attr-toggle='modal' data-target='#attr_menu_control_panel_modal' href='#' class='elementskit_menu_trigger'>Mega Menu</a> ");
                    // console.log(menu_item);
                }
            });
        }, 200);
    });

    $( "#menu-to-edit" ).trigger( "DOMSubtreeModified" );


    $('#menu-to-edit').on('click', '.elementskit_menu_trigger', function(e){
        e.preventDefault();
        var modal = $('#attr_menu_control_panel_modal');
        // modal.addClass('elementskit-menu-modal-loading');
        // add your code here to open the modal by js
        var menu_item = $(this).parents('li.menu-item');
        var id = parseInt(menu_item.attr('id').match(/[0-9]+/)[0], 10);
        var title = menu_item.find('.menu-item-title').text();
        var depth = menu_item.attr('class').match(/\menu-item-depth-(\d+)\b/)[1];

        $('.ekit_menu_control_nav > li').removeClass('attr-active');
        $('.attr-tab-pane').removeClass('attr-active');

        if($(this).parents('.menu-item').hasClass('menu-item-depth-0')){
            var has_child = 0;
            modal.removeClass('elementskit-menu-has-child');
            $('#attr_content_nav').addClass('attr-active');
            $('#attr_content_tab').addClass('attr-active');
        }else{
            var has_child = 1;
            modal.addClass('elementskit-menu-has-child');
            $('#attr_icon_nav').addClass('attr-active');
            $('#attr_icon_tab').addClass('attr-active');
        }


        $('#elementskit-menu-modal-menu-id').val(id);
        $('#elementskit-menu-modal-menu-has-child').val(has_child);

        var data = {
            menu_id : id,
            nocache: (Math.floor(Date.now() / 1000))
        }

        $.ajax({
            url :  window.elementskit.resturl + 'megamenu/get_menuitem_settings',
            type: 'get',
            data : data,
            headers: {
                'X-WP-Nonce': nonce
            },
            dataType: 'json',
            success: function (response) {
                //console.log(response);
                $('#elementskit-menu-item-enable').prop('checked', false);
                $('#elementskit-menu-icon-color-field').wpColorPicker('color', response.menu_icon_color);
                $('#elementskit-menu-icon-field').val(response.menu_icon);
                $('#elementskit-menu-badge-text-field').val(response.menu_badge_text);
                $('#elementskit-menu-badge-color-field').wpColorPicker('color', response.menu_badge_color);
                $('#elementskit-menu-badge-background-field').wpColorPicker('color', response.menu_badge_background);
                $('#elementskit-menu-vertical-menu-width-field').val(response.vertical_menu_width);

                if(typeof response.menu_enable !== 'undefined' && response.menu_enable == 1){
                    $('#elementskit-menu-item-enable').prop('checked', true);
                }else{
                    $('#elementskit-menu-item-enable').prop('checked', false);
                }

                $('#mobile_submenu_content_type input').prop('checked', false);
                if(typeof response.mobile_submenu_content_type === 'undefined' || response.mobile_submenu_content_type == 'builder_content'){
                    $('#mobile_submenu_content_type input[value=builder_content]').prop('checked', true);
                }else{
                    $('#mobile_submenu_content_type input[value=submenu_list]').prop('checked', true);
                }

                $('#vertical_megamenu_position_type input').prop('checked', false);
                if(typeof response.vertical_megamenu_position_type === 'undefined' || response.vertical_megamenu_position_type == 'relative_position'){
                    $('#vertical_megamenu_position_type input[value=relative_position]').prop('checked', true);
                }else{
                    $('#vertical_megamenu_position_type input[value=top_position]').prop('checked', true);
                }

                $('#xs_megamenu_width_type input').removeAttr('checked');
                if(typeof response.megamenu_width_type === 'undefined' || response.megamenu_width_type == 'default_width'){
                    $('#xs_megamenu_width_type input[value=default_width]').attr('checked', 'checked');
                    $('#xs_megamenu_width_type input[value=default_width]').prop('checked', true);
                } else if (typeof response.megamenu_width_type === 'undefined' || response.megamenu_width_type == 'full_width') {
                    $('#xs_megamenu_width_type input[value=full_width]').prop('checked', true);
                    $('#xs_megamenu_width_type input[value=full_width]').attr('checked', 'checked');
                } else {
                    $('#xs_megamenu_width_type input[value=custom_width]').prop('checked', true);
                    $('#xs_megamenu_width_type input[value=custom_width]').attr('checked', 'checked');
                }

                $('#attr_vertical_menu_setting_tab').on('change', 'input[type="radio"]', function () {
                    if ($('#width_type_custom').is(':checked')) {
                        $('.menu-width-container').addClass('is_enabled')
                    } else {
                        $('.menu-width-container').removeClass('is_enabled')
                    }
                }).trigger('change')
                if ($('#width_type_custom').is(':checked')) {
                    $('.menu-width-container').addClass('is_enabled')
                } else {
                    $('.menu-width-container').removeClass('is_enabled')
                }

                $( "#elementskit-menu-item-enable" ).trigger( "change" );

                IconPicker.refreshPicker();
                setTimeout(function(){
                    modal.removeClass('elementskit-menu-modal-loading');
                }, 500);
            }
        });
    });

    $('#elementskit-menu-item-enable').on('change', function(){
        if($(this).is(':checked')){
            $('#elementskit-menu-builder-trigger').prop('disabled', false);
            $('#elementskit-menu-builder-warper').addClass('is_enabled');
        }else{
            $('#elementskit-menu-item-enable').prop('checked', false);
            $('#elementskit-menu-builder-warper').removeClass('is_enabled');
            $('#elementskit-menu-builder-trigger').prop('disabled', true);
        }
    });

    $('#post-body-content').on('change.ekit', '#elementskit-menu-metabox-input-is-enabled', function(){
        // console.log($(this).is(':checked'));
        if($(this).is(':checked')){
            $('body').addClass('is_mega_enabled').removeClass('is_mega_disabled');
        }else{
            $('body').removeClass('is_mega_enabled').addClass('is_mega_disabled');
        }
    });

    $('#post-body-content')
        .prepend(window.elementskit_options_megamenu_markup)
        .find('#elementskit-menu-metabox-input-is-enabled')
        .trigger("change.ekit");

    /**
     * iframeModal
     */
    var $iframeModal = $('#elementskit-menu-builder-modal'),
        iframePopupEl = document.getElementById('elementskit-menu-builder-iframe'),
        iframeWindow = (iframePopupEl.contentWindow || iframePopupEl.contentDocument);

    $iframeModal.on('hide.bs.attr-modal', function (e) {
        var isDisabled = iframeWindow.jQuery('#elementor-panel-saver-button-publish').hasClass('elementor-disabled');
        
        if (!isDisabled && !confirm('Changes you made may not be saved.')) {
            e.preventDefault();
        }

        iframeWindow.jQuery(iframeWindow).off('beforeunload');
    });

});
