<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
 * This is Marketo custom design.  Just update the version will work fine.
 */

if (!defined('ABSPATH')) {
    exit;
}

if ($related_products) : ?>
    <?php $i = 1; ?>
    <section class="related products">
        <div class="xs-content-header version-2">
            <?php
                $heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'marketo' ) );

                if ( $heading ) :
                ?>
                    <h2 class="xs-content-title"><?php echo esc_html( $heading ); ?></h2>
            <?php endif; ?>
            <div class="clearfix"></div>
        </div>
        <?php woocommerce_product_loop_start(); ?>
        <div class="col-lg-12">
            <div class="row">
            <?php foreach ($related_products as $related_product) : ?>
                <?php
                $post_object = get_post($related_product->get_id());

                setup_postdata($GLOBALS['post'] =& $post_object);  // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                $xs_product = wc_get_product(get_the_id());
                $img_link = get_post_thumbnail_id();
                $terms = get_the_terms(get_the_ID(), 'product_cat');
                $cat = '';
                if ($terms && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $cat .= "<a href = '" . get_category_link($term->term_id) . "'>" . $term->name . "</a>  ";
                    }
                }
                ?>
                <div class="col-md-6 col-lg-3">
                    <div class="xs-product-wraper version-2 xs-related-product">
                        <div class="xs-product-header media xs-wishlist woocommerce">
                            <?php
                            if (get_option('woocommerce_enable_review_rating') === 'yes'):
                                $average = $xs_product->get_average_rating();
                                $rating_count = $xs_product->get_rating_count();
                                echo wc_get_rating_html($average, $rating_count);
                            endif;
                            if (defined('YITH_WCWL')): ?>
                                <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($img_link)): ?>
                            <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                                <?php echo wp_get_attachment_image($img_link, 'full', false, array(
                                    'alt'       => get_the_title(),
                                    'data-echo' => esc_url($img_link)
                                ) ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="xs-product-content text-center">
                        <span class="product-categories">
                            <span class="product-categories"><?php echo marketo_return($cat); ?></span>
                        </span>
                            <h4 class="product-title"><a
                                        href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a>
                            </h4>
                            <span class="price">
                            <?php echo marketo_return($xs_product->get_price_html()); ?>
                        </span>
                        </div>
                        <div class="xs-product-hover-area clearfix">
                            <div class="xs-addcart woocommerce text-center">
                                <?php if (function_exists('woocommerce_template_loop_add_to_cart')): ?>
                                    <?php echo woocommerce_template_loop_add_to_cart(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($i == 4) break;
                $i++;
                endforeach;
                woocommerce_product_loop_end(); ?>
            </div>
        </div>
    </section>

<?php endif;

wp_reset_postdata();
