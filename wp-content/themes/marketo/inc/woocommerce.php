<?php
if ( !defined( 'ABSPATH' ) )
	 wp_die( 'Direct access forbidden.' );
/**
 * ------------------------------------------------------------------------------------------------
 * Add theme support for WooCommerce
 * ------------------------------------------------------------------------------------------------
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );

	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	if ( function_exists( 'is_product' ) ) {
		if ( is_product() ) {
			add_action( 'woocommerce_before_main_content', 'marketo_main_content_wrap_start', 25 );
		}
	}
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	//add_action( 'marketo_wc_catalog_ordaring', 'woocommerce_result_count', 20 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	add_action( 'marketo_wc_related_products', 'woocommerce_output_related_products', 10 );

	add_action( 'marketo_wc_related_products', 'marketo_wc_output_related_products_wrap_start', 5 );

	function marketo_wc_output_related_products_wrap_start() {
		echo '<section class="xs-section-padding bg-gray"><div class="container">';
	}

	add_action( 'marketo_wc_related_products', 'marketo_wc_output_related_products_wrap_end', 15 );

	function marketo_wc_output_related_products_wrap_end() {
		echo '</div></section>';
	}

	add_filter( 'woocommerce_breadcrumb_defaults', 'marketo_wcc_change_breadcrumb_html' );

	function marketo_wcc_change_breadcrumb_html( $defaults ) {
// Change the breadcrumb delimeter from '/' to '>'
		$defaults[ 'delimiter' ]	 = '';
		$defaults[ 'wrap_before' ]	 = '<div class="xs-breadcumb"><div class="container"><nav aria-label="breadcrumb-shop"><ol class="breadcrumb-shop"> ';
		$defaults[ 'wrap_after' ]	 = '</ol></nav></div></div>';
		$defaults[ 'before' ]		 = '<li class="breadcrumb-item">';
		$defaults[ 'after' ]		 = '</li>';
		return $defaults;
	}

	add_action( 'marketo_wc_breadcrumb', 'marketo_wc_breadcrumb', 10 );

	function marketo_wc_breadcrumb() {
		return woocommerce_breadcrumb();
	}

	add_action( 'woocommerce_before_shop_loop', 'marketo_wc_catalog_ordaring', 30 );

	function marketo_wc_catalog_ordaring() {
		return woocommerce_catalog_ordering();
	}

	add_action( 'woocommerce_shop_loop_item_title', 'marketo_wc_before_shop_loop_item_title', 5 );

	function marketo_wc_before_shop_loop_item_title() {
		echo '<div class="xs-product-content">';
	}

//	add_action( 'woocommerce_before_shop_loop_item', 'marketo_wc_before_shop_loop_item', 5 );
//
//	function marketo_wc_before_shop_loop_item() {
//		echo '<div class="xs-product-wraper">';
//	}

	add_action( 'woocommerce_after_shop_loop_item', 'marketo_wc_after_shop_loop_item', 15 );

	function marketo_wc_after_shop_loop_item() {
		echo '</div>';
	}

	add_filter( 'woocommerce_product_description_heading', function () {
		return '';
	} );
	add_filter( 'woocommerce_product_additional_information_heading', function () {
		return '';
	} );

	if ( !function_exists( 'marketo_wc_get_product_id' ) ) {

		function marketo_wc_get_product_id( $product ) {
			if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
				return isset( $product->id ) ? $product->id : 0;
			}

			return $product->get_id();
		}

	}

	function get_ratings_counts( $product ) {
		global $wpdb;

		$product_id	 = marketo_wc_get_product_id( $product );
		$counts		 = array();
		$raw_counts	 = $wpdb->get_results( $wpdb->prepare( "
                SELECT meta_value, COUNT( * ) as meta_value_count FROM $wpdb->commentmeta
                LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
                WHERE meta_key = 'rating'
                AND comment_post_ID = %d
                AND comment_approved = '1'
                AND meta_value > 0
                GROUP BY meta_value
            ", $product_id ) );

		foreach ( $raw_counts as $count ) {
			$counts[ $count->meta_value ] = $count->meta_value_count;
		}

		return $counts;
	}

}

if ( class_exists( 'Wp_Social' ) ) {
	if (function_exists('xs_get_option')) {
	    function xs_social_login() {
    		$google_client_id	 = xs_get_option( 'google_client_id', 'google' );
    		$google_secret		 = xs_get_option( 'google_secret', 'google' );

    		$app_id		 = xs_get_option( 'app_id', 'facebook' );
    		$app_secret	 = xs_get_option( 'app_secret', 'facebook' );
    		?>

    		<div class="social-login-btn">
    			<?php if ( !empty( $google_secret ) && !empty( $google_client_id ) ): ?>
    				<a href="<?php echo add_query_arg( 'social_auth', 'google', wc_get_page_permalink( 'myaccount' ) ); ?>" class="btn btn-danger btn-block" ><?php esc_html_e( 'Login with your google+', 'marketo' ); ?></a>
    			<?php endif; ?>
    			<?php if ( !empty( $app_secret ) && !empty( $app_id ) ): ?>
    				<a href="<?php echo add_query_arg( 'social_auth', 'facebook', wc_get_page_permalink( 'myaccount' ) ); ?>" class="btn btn-info btn-block" ><?php esc_html_e( 'Login with your facebook', 'marketo' ); ?></a>
    			<?php endif; ?>
    		</div>
    		<?php
    	}

    	add_action( 'woocommerce_login_form_end', 'xs_social_login' );
	}
}




if ( class_exists( 'NextendSocialLogin' ) ) {

	function nextend_social_login() {
		return do_shortcode( '[nextend_social_login]' );
	}

	add_action( 'woocommerce_login_form_end', 'nextend_social_login' );
}


/**
 * Change number of products that are displayed per page (shop page)
 */
$post_per_page = marketo_option('woo_posts_per_page');

if('' != $post_per_page){
    add_filter( 'loop_shop_per_page', 'xp_new_loop_shop_per_page', 20 );
}

function xp_new_loop_shop_per_page( $cols ) {
    $post_per_page = marketo_option('woo_posts_per_page');
    global $wp_query;
    $total_posts = $wp_query->post_count;

    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = $total_posts;

    if('' != $post_per_page){

        $cols =   $post_per_page;
    }

    return $cols;
}


//  shop page

//  remove default title,  thumbnail, price,  review

remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart', 10);

//  add thumbnail

add_action('woocommerce_before_shop_loop_item_title', 'xs_shop_product_thumbnail');

function xs_shop_product_thumbnail () {
    $xs_product = wc_get_product(get_the_id());
    ?>
    <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
        <?php
        if (has_post_thumbnail()):
            echo woocommerce_get_product_thumbnail();
        endif;
        ?>
    </a>
    <ul class="product-item-meta">
        <li class="xs-cart-wrapper">
            <?php if (function_exists('woocommerce_template_loop_add_to_cart')): ?>
                <?php echo woocommerce_template_loop_add_to_cart(); ?>
            <?php endif; ?>
        </li>

        <li><a href="#" data-toggle="modal"
               data-target=".xs-quick-view-modal-<?php echo esc_attr(get_the_ID()); ?>"><i
                        class="icon icon-medical2"></i></a></li>

        <?php if (defined('YITH_WCWL')): ?>
            <li class="xs-wishlist-wrapper xs-wishlist">
                <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
            </li>
        <?php endif; ?>
        <?php if (class_exists('YITH_Woocompare')): ?>
            <li class="xs-wishlist-wrapper xs-wishlist product">
                <?php echo marketo_add_to_compare_link(); ?>
            </li>
        <?php endif; ?>
    </ul>
    <div class="xs-product-content">
        <h4 class="product-title"><a
                    href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a>
        </h4>
        <span class="price">
            <?php echo marketo_return($xs_product->get_price_html()); ?>
        </span>
    </div>
<?php
}

//  add content
    add_action('marketo_content', 'xs_shop_page_content');

function xs_shop_page_content () {
    ?>
    <div class="list-group xs-list-group xs-product-content">
        <?php echo esc_html(marketpres_content_read_more()); ?>
    </div>
<?php
    require MARKETO_THEMEROOT_DIR . '/woocommerce/content-quick-view.php';
}

// add grid view data
add_action('marketo_list_view', 'xs_shop_page_grid_view');

function xs_shop_page_grid_view() {
    $xs_product = wc_get_product(get_the_id());
    ?>
    <div class="col-md-6 xs-list-view">
        <div class="xs-product-widget media xs-md-20">
            <?php
            if ( has_post_thumbnail() ):
				echo wp_get_attachment_image(get_post_thumbnail_id(get_the_id()), array(125, 125), false, array(
					'alt' => get_the_title()
				));
            endif;
            ?>
            <div class="media-body align-self-center product-widget-content">
                <div class="xs-product-header media xs-wishlist">
                   <?php woocommerce_template_loop_rating(); ?>
                    <?php if ( defined( 'YITH_WCWL' ) ): ?>
                        <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
                    <?php endif; ?>
                </div>
                <h4 class="product-title"><a
                            href="<?php echo esc_url( get_the_permalink() ) ?>"><?php echo get_the_title(); ?></a></h4>
                <span class="price">
                    <?php echo marketo_return( $xs_product->get_price_html() ); ?>
                </span>
            </div>
        </div>
    </div>
<?php

}