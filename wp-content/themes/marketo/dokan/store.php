<?php
/**
 * The Template for displaying all single posts.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$store_user   = dokan()->vendor->get( get_query_var( 'author' ) );
$store_info   = $store_user->get_shop_info();
$map_location = $store_user->get_location();

get_header( 'shop' );

$sidebar          = marketo_option( 'shop_sidebar', marketo_defaults( 'shop_sidebar' ) );
$shop_grid_column = marketo_option( 'shop_grid_column', marketo_defaults( 'shop_grid_column' ) );
$column           = ( $sidebar == 1 ) ? 'col-md-12' : 'col-lg-8 col-md-12';
$dcokan_sidebar = dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' );
if(is_single()){
    $column = 'col-md-12';
}
$wrapper_class = '';
if(is_single()){
    $wrapper_class = 'xs_single_wrapper';
}

$store_class = $sidebar == 1 ? '' : ' col-lg-8 dokan-w8';

?>
    <div class="xs-section-padding <?php echo esc_attr($wrapper_class); ?>">
        <div class="shop-archive">
            <div class="container">
                <div class="row  <?php echo esc_attr($sidebar == 3 ? 'flex-row-reverse' : ''); ?>">

<?php

if($sidebar != 1) {
    if ( $dcokan_sidebar == 'off' ) { ?>
        <div id="dokan-secondary" class="dokan-clearfix dokan-w3 dokan-store-sidebar" role="complementary" style="margin-<?php echo esc_attr($sidebar == 3 ? 'left': 'right');?> :3%;">
            <div class="dokan-widget-area widget-collapse">
                <?php do_action( 'dokan_sidebar_store_before', $store_user->data, $store_info ); ?>
                <?php
                    if ( ! dynamic_sidebar( 'sidebar-store' ) ) {
                        $args = array(
                            'before_widget' => '<aside class="widget dokan-store-widget %s">',
                            'after_widget'  => '</aside>',
                            'before_title'  => '<h3 class="widget-title">',
                            'after_title'   => '</h3>',
                        );

                        if ( dokan()->widgets->is_exists( 'store_category_menu' ) ) {
                            the_widget( dokan()->widgets->store_category_menu, array( 'title' => __( 'Store Product Category', 'dokan-lite' ) ), $args );
                        }

                        if ( dokan()->widgets->is_exists( 'store_location' ) && dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on'  && ! empty( $map_location ) ) {
                            the_widget( dokan()->widgets->store_location, array( 'title' => __( 'Store Location', 'dokan-lite' ) ), $args );
                        }

                        if ( dokan()->widgets->is_exists( 'store_open_close' ) && dokan_get_option( 'store_open_close', 'dokan_general', 'on' ) == 'on' ) {
                            the_widget( dokan()->widgets->store_open_close, array( 'title' => __( 'Store Time', 'dokan-lite' ) ), $args );
                        }

                        if ( dokan()->widgets->is_exists( 'store_contact_form' ) && dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
                            the_widget( dokan()->widgets->store_contact_form, array( 'title' => __( 'Contact Vendor', 'dokan-lite' ) ), $args );
                        }
                    }
              ?>

                <?php do_action( 'dokan_sidebar_store_after', $store_user->data, $store_info ); ?>
            </div>
        </div><!-- #secondary .widget-area -->
        <?php
    } else {
        get_sidebar( 'dokan' );
    }
}
?>

    <div id="dokan-primary" class="dokan-single-store <?php echo esc_attr($store_class); ?>">
        <div id="dokan-content" class="store-page-wrap woocommerce" role="main">

            <?php dokan_get_template_part( 'store-header' ); ?>

            <?php do_action( 'dokan_store_profile_frame_after', $store_user->data, $store_info ); ?>

            <?php if ( have_posts() ) { ?>

                <div class="seller-items row">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'dokan_product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                </div>

                <?php dokan_content_nav( 'nav-below' ); ?>

            <?php } else { ?>

                <p class="dokan-info"><?php _e( 'No products were found of this vendor!', 'marketo' ); ?></p>

            <?php } ?>
        </div>

    </div><!-- .dokan-single-store -->

    <div class="dokan-clearfix"></div>
    </div>
    </div>
    </div>
    </div>
    </div>

<?php get_footer( 'shop' ); ?>