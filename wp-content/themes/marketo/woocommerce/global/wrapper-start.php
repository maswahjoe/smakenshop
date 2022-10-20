<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$sidebar          = marketo_option( 'shop_sidebar', marketo_defaults( 'shop_sidebar' ) );
$shop_grid_column = marketo_option( 'shop_grid_column', marketo_defaults( 'shop_grid_column' ) );
$column           = ( $sidebar == 1 ) ? 'col-md-12' : 'col-lg-8 col-md-12';
if(is_single()){
	$column = 'col-md-12';
}
$wrapper_class = '';
if(is_single()){
    $wrapper_class = 'xs_single_wrapper';
}
?>
<div class="xs-section-padding <?php echo esc_attr($wrapper_class); ?>">
    <div class="shop-archive">
        <div class="container">
            <div class="row">
	            <?php
	            /**
	             * Hook: woocommerce_sidebar.
	             *
	             * @hooked woocommerce_get_sidebar - 10
	             */
	            if ( $sidebar == 2  && !is_single()) {
		            do_action( 'woocommerce_sidebar' );
	            }
	            ?>
                <div id="primary" class="content-area <?php echo esc_attr( $column ); ?>">
