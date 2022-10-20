<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

get_header( 'shop' );
do_action( 'marketo_wc_breadcrumb' );
$sidebar			 = marketo_option( 'shop_sidebar', marketo_defaults( 'shop_sidebar' ) );
$archive_desc		 = (marketo_option( 'shop_archive_desc') == '')  ? 3 : marketo_option( 'shop_archive_desc');
$shop_grid_column	 = marketo_option( 'shop_grid_column', marketo_defaults( 'shop_grid_column' ) );
$column				 = ($sidebar == 1) ? 'col-md-12' : 'col-md-12 col-lg-8';
$archive__shop_image_disply = marketo_option('shop_banner_shop_page_sho');
$archive__shop_image = marketo_option('shop_banner_global_display');


if ( (is_product_category()) && ($archive_desc == 2)) {
    ?>

    <header class="xs-shop-products-header xs-category-arichiv-desc">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php do_action('woocommerce_archive_description'); ?>
                </div>
            </div>
        </div>
    </header>

    <?php
}
if(is_shop() && ($archive__shop_image_disply == 1) && ('' !=$archive__shop_image) && ($archive_desc == 2)){
    ?>
    <header class="xs-shop-products-header xs-category-arichiv-desc">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="woo-cat-image">
                     <?php
                        echo wp_get_attachment_image(attachment_url_to_postid($archive__shop_image), 'full', false, array(
                            'alt'  => esc_attr__('Global banner', 'marketo')
                        ));
                      ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php
}

if ( woocommerce_product_loop() ) {


    /**
     * Hook: woocommerce_before_main_content.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     * @hooked WC_Structured_Data::generate_website_data() - 30
     */
    do_action( 'woocommerce_before_main_content' );

    if ( ((is_product_category()) && ($archive_desc == 3)) || (($archive_desc == 3) && defined('WCMp_PLUGIN_TOKEN'))) {

        do_action('woocommerce_archive_description');

    }
    if(is_shop() && ($archive__shop_image_disply == 1) && ('' !=$archive__shop_image) && ($archive_desc == 3)){
        ?>

        <div class="woo-cat-image">
            <?php echo wp_get_attachment_image(attachment_url_to_postid($archive__shop_image), 'full', false, array(
                            'alt'  => esc_attr__('Global banner', 'marketo')
                  )); 
            ?>
        </div>

        <?php
    }
    ?>
    <div class="media-body xs-shop-notice mb-3">
        <?php do_action( 'marketo_wc_catalog_ordaring' );  ?>
    </div>
    <div class="woocommerce-products-header">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h5 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h5>
        <?php endif; ?>
        <div class="media woocommerce-filter-content">
            <?php
            /**
             * Hook: woocommerce_before_shop_loop.
             * @hooked woocommerce_catalog_ordering - 30
             */
            do_action( 'marketo_wc_catalog_ordaring' );
            ?>

            <div class="media-body xs-before-shop-loop">
                <?php do_action( 'woocommerce_before_shop_loop' );  ?>
            </div>

            <div class="media">
                <h6><?php echo esc_html__( 'View', 'marketo' ); ?></h6>
                <ul class="nav nav-tabs shop-view-nav" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="grid-tab" data-toggle="tab" href="#grid" role="tab"
                           aria-controls="grid" aria-selected="true">
                            <i class="fa fa-th"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list"
                           aria-selected="false">
                            <i class="fa fa-align-justify"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="feature-product-v4">
    <?php
    woocommerce_product_loop_start();

    if ( wc_get_loop_prop( 'total' ) ) {
        while ( have_posts() ) {
            the_post();

            /**
             * Hook: woocommerce_shop_loop.
             */
            do_action( 'woocommerce_shop_loop' );

            wc_get_template_part( 'content', 'product' );
        }
    }


    woocommerce_product_loop_end();
    ?>
    </div>
    <?php
    /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked woocommerce_pagination - 10
     */
    do_action( 'woocommerce_after_shop_loop' );


    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );
} else {

    do_action( 'woocommerce_before_main_content' );

    if ( ((is_product_category()) && ($archive_desc == 2)) || (($archive_desc == 2 || $archive_desc == 3) && defined('WCMp_PLUGIN_TOKEN'))) {

        do_action('woocommerce_archive_description');

    }
    /**
     * Hook: woocommerce_no_products_found.
     *
     * @hooked wc_no_products_found - 10
     */
    do_action( 'woocommerce_no_products_found' );

    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );
}

get_footer( 'shop' );
