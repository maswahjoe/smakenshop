( function ( $ ) {
    "use strict";
    $( 'body' ).on( 'submit', 'form.cart', function ( e ) {


        if ( $( this ).parents().parents().closest( '.xs-single-products' ).find( '.product-type-external' ).hasClass( 'product-type-external' ) ) {
            return;
        }
        //console.log($(this).parents().parents().find('.product-type-external'))
        e.preventDefault();

        var $form = $( this ),
            $thisbutton = $form.find( '.button' ),
            data = $form.serialize();

        data += '&action=marketo_ajax_add_to_cart';

        if ( $thisbutton.val() ) {
            data += '&add-to-cart=' + $thisbutton.val();
        }

        $thisbutton.removeClass( 'added not-added' );
        $thisbutton.addClass( 'loading' );

        $( document.body ).trigger( 'adding_to_cart', [ $thisbutton, data ] );
        // Ajax action.
        $.post( xs_ajax_obj.ajaxurl, data, function ( response ) {

            if ( !response ) {
                return;
            }

            if ( response.error && response.product_url ) {
                window.location = response.product_url;
                return;
            }

            // Redirect to cart option
            if ( typeof ( wc_add_to_cart_params ) !== 'undefined' &&
                wc_add_to_cart_params !== null &&
                wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
                window.location = wc_add_to_cart_params.cart_url;
                return;
            } else {
                $thisbutton.removeClass( 'loading' );
                $thisbutton.addClass( 'not-added' );
                $( '.xs-sidebar-group' ).addClass( 'isActive' );
                $( '.modal' ).modal( 'hide' );

            }

            // Trigger event so themes can refresh other areas.
            $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );
        } );

    } );
    $( document ).on( 'added_to_wishlist removed_from_wishlist', function () {
        $.ajax( {
            url: xs_ajax_obj.ajaxurl,
            data: {
                action: 'marketo_wishlist_count'
            },
            method: 'POST',
            success: function ( data ) {
                $( '.xswhishlist' ).html( data );
            }
        } );
    } );

    $( 'footer' ).append( '<div class="xs_added_to_cart">' + xs_ajax_obj.product_added + '</div>' );

    $( 'body' ).on( 'added_to_cart', function () {
        $( '.xs_added_to_cart' ).addClass( 'active' );
        setTimeout( function () {
            $( '.xs_added_to_cart' ).removeClass( 'active' );
            $( '.close-side-widget' ).trigger( "click" );

        }, 3000 );

    } );





        /*Ajax Search Product*/
        var search_form = $('.xs-navbar-search-wrapper');

        var s_timeOut_search = null;
        search_form.on( 'keyup', 'input[type="search"]', function ( event ) {
            switch ( event.which ) {

                case 27:
                    $(this).parents('.xs-navbar-search-wrapper').find('.ajax-search-result').remove();
                    $( this ).val( '' );
                    break;

                default:
                    xp_search( $(this).parents('.xs-navbar-search-wrapper') );
                    break;
            }

        } );
        $( '.xs-navbar-search-wrapper' ).submit( function ( e ) {
            e.preventDefault();
            xp_search( $(this) );
        } );

        function xp_search( $this ) {
            var keyword = $this.find( 'input[type="search"]').val();

            var cat_id = $this.find('.select-styled').attr('data-value');

            if ( keyword.length > 0 || cat_id) {

                if ( $this.find('.ajax-search-result').length == 0 ) {
                    $this.append( '<div class="ajax-search-result"></div>' );
                }
                $this.find('.xs-spin').addClass( ' fa fa-spinner fa-spin' );


                $.ajax( {
                    url: xs_ajax_obj.ajaxurl,
                    data: 'action=xp_result_search_product&keyword=' + keyword + '&cate_id=' + cat_id,
                    method: 'POST',
                    success: function ( data ) {
                        // console .log(data);
                        $this.find('.xs-spin').removeClass( ' fa fa-spinner fa-spin' );
                        var html = '';
                        var sHtmlViewMore = '';
                        if ( data ) {
                            var items = $.parseJSON( data );
                            if ( items.length ) {
                                html += '<ul class="xs_search_list clearfix">';
                                if ( items[0]['id'] == -1 ) {
                                    html += '<li class="no-result">' + items[0]['title'] + '</li>';
                                } else {
                                    $.each( items, function ( index ) {
                                        if ( this['id'] == -2 ) {
                                            sHtmlViewMore = '<div class="search-view-more">' + this['title'] + '</div>';
                                        } else {
                                            html += '<li>';
                                            html += '<a class="clearfix" href="' + this['guid'] + '">';
                                            html += '<div class="img-container">' + this['thumb'] + '</div>';
                                            html += '<div class="search_price"><span class="product_title">' + this['title'] + '</span>';
                                            html += '<span class="product_price">' + this['price'] + '</span></div></a>';
                                            html += '</li>';
                                        }

                                    } );
                                }
                                html += '</ul>';
                            } else {
                                html = '';
                            }
                        }
                        if ( $this.find('.ajax-search-result').length == 0 ) {
                            $this.append( '<div class="ajax-search-result"></div>' );
                        }
                        $this.find('.ajax-search-result').html( html + sHtmlViewMore );
                    }
                } );

            }
        }

}( jQuery ) );