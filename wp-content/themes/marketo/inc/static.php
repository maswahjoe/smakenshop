<?php

if ( !defined( 'ABSPATH' ) )
	 wp_die( 'Direct access forbidden.' );
/**
 * Enqueue all theme scripts and styles
 *

  /** --------------------------------------
 * ** REGISTERING THEME ASSETS
 * ** ------------------------------------ */
/**
 * Enqueue styles.
 */
if ( !is_admin() ) {
    wp_enqueue_style( 'marketo-fonts', marketo_google_fonts_url(), null, MARKETO_VERSION );
    $rtl = marketo_option('marketo_rtl');
    if($rtl){
        wp_enqueue_style( 'bootstrap-rtl', MARKETO_CSS . '/bootstrap.min.rtl.css', null, MARKETO_VERSION );
    }else{
        wp_enqueue_style( 'bootstrap', MARKETO_CSS . '/bootstrap.min.css', null, MARKETO_VERSION );
    }
	wp_enqueue_style( 'marketo-plugins', MARKETO_CSS . '/plugins.css', null, MARKETO_VERSION );

//


	wp_enqueue_style( 'marketo-style', MARKETO_CSS . '/style.css', null, MARKETO_VERSION );
    if($rtl){
        wp_enqueue_style( 'marketo-rtl', MARKETO_CSS . '/rtl.css',null, MARKETO_VERSION );
    }
    wp_enqueue_style( 'marketo-responsive', MARKETO_CSS . '/responsive.css', null, MARKETO_VERSION );
    wp_enqueue_style( 'marketo-gutenberg', MARKETO_CSS . '/gutenberg-custom.css', null, MARKETO_VERSION );
}



/**
 * Enqueue scripts.
 */
if ( !is_admin() ) {
    $map_api_code	 = marketo_option('map_api', marketo_defaults('map_api'));
    $api_key		 = ($map_api_code != '') ? '?key=' . $map_api_code : '';

	wp_enqueue_script( 'marketo-plugins', MARKETO_SCRIPTS . '/plugins.js', array( 'jquery' ), MARKETO_VERSION, true );
	//Bootstrap Main JS
    if(function_exists('is_vendor_dashboard')){
        if(!is_vendor_dashboard()){
            wp_enqueue_script( 'bootstrap', MARKETO_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), MARKETO_VERSION, true );
        }
    }else{
        wp_enqueue_script( 'bootstrap', MARKETO_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), MARKETO_VERSION, true );
    }

    if(!empty($api_key)){
        wp_enqueue_script( 'map-googleapis', 'https://maps.googleapis.com/maps/api/js' . $api_key, array( 'jquery' ), '', TRUE );
    }
	wp_enqueue_script( 'menu-aim', MARKETO_SCRIPTS . '/jquery.menu-aim.js', array( 'jquery' ), MARKETO_VERSION, true );
    wp_enqueue_script( 'vertical-menu', MARKETO_SCRIPTS . '/vertical-menu.js', array( 'jquery' ), MARKETO_VERSION, true );
    add_action('elementskit/loaded', function(){
        echo 'loaded';
    });
	wp_enqueue_script( 'marketo-main', MARKETO_SCRIPTS . '/main.js', array( 'jquery' ), MARKETO_VERSION, true );
    wp_enqueue_script( 'marketo-ajax-setting', MARKETO_SCRIPTS . '/ajax-script.js', array('jquery'), '',TRUE );

    /*Ajax Call*/
    $params = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'product_added' => esc_html__('Product Added Succefully','marketo'),
        'marketpess_nonce' => wp_create_nonce('xs_nonce'),
    );
    wp_localize_script('marketo-ajax-setting', 'xs_ajax_obj', $params);

    $product_timer = array(
        'xs_date' => esc_html__('Days','marketo') ,
        'xs_hours' => esc_html__('Hours','marketo') ,
        'xs_minutes' => esc_html__('Minutes','marketo') ,
        'xs_secods' => esc_html__('Seconds','marketo') ,
        'xs_acc_or' => esc_html__('or','marketo') ,
    );
    wp_localize_script('marketo-ajax-setting', 'xs_product_timers', $product_timer);

	// Load WordPress Comment js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
