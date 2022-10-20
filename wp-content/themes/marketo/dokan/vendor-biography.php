<?php
/**
 * The Template for displaying all reviews.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

$store_user = get_userdata(get_query_var('author'));
$store_info = dokan_get_store_info($store_user->ID);
$map_location = isset($store_info['location']) ? esc_attr($store_info['location']) : '';
$sidebar          = marketo_option( 'shop_sidebar', marketo_defaults( 'shop_sidebar' ) );
$dcokan_sidebar = dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' );

$store_class = $sidebar == 1 ? '' : 'col-lg-8';

get_header('shop');

?>
<div class="container">
    <div class="row  <?php echo esc_attr($sidebar == 3 ? 'flex-row-reverse' : ''); ?>">
<?php
if($sidebar != 1) {
    if ( $dcokan_sidebar == 'off' ) { ?>
        <div id="dokan-secondary" class="dokan-clearfix col-lg-3 dokan-store-sidebar" role="complementary" style="margin-<?php echo esc_attr($sidebar == 3 ? 'left': 'right');?> :3%;">
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
    <div id="dokan-content" class="store-review-wrap woocommerce" role="main">
        <div class="xs_dokan_biography">
            <div id="biography">
                <div id="comments">
                    <?php do_action( 'dokan_vendor_biography_tab_before', $store_user, $store_info ); ?>
                    <?php dokan_get_template_part( 'store-header' ); ?>

                    <h2 class="headline"><?php echo apply_filters( 'dokan_vendor_biography_title', __( 'Vendor Biography', 'dokan' ) ); ?></h2>

                    <?php
                        if ( ! empty( $store_info['vendor_biography'] ) ) {
                            printf( '%s', apply_filters( 'the_content', $store_info['vendor_biography'] ) );
                        }
                    ?>

                    <?php do_action( 'dokan_vendor_biography_tab_after', $store_user, $store_info ); ?>
                    </div>
            </div>
            </div>
        </div>
    </div><!-- #content .site-content -->
</div><!-- #primary .content-area -->
</div>
</div>
<div class="clearfix"></div>
<?php get_footer(); ?>
