<?php
$i = 0;
while (have_posts()) {
    the_post();
    $xs_product = wc_get_product(get_the_id());
    $img_link = xs_resize(get_post_thumbnail_id(), 253, 200, true);
    $terms = get_the_terms(get_the_ID(), 'product_cat');
	$col = marketo_option('shop_grid_column');
    $cat = '';

    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $cat .= "<a href = '" . get_category_link($term->term_id) . "'>" . $term->name . "</a>  ";
        }
    }
    $rand_quick = mt_rand(10000, 99999) . '-' . $i;
    /**
     * Hook: woocommerce_shop_loop.
     *
     * @hooked WC_Structured_Data::generate_product_data() - 10
     */
    do_action('woocommerce_shop_loop');
    ?>
<div class="col-lg-<?php echo esc_attr($col);?> col-md-6">
        <div class="xs-single-product">
            <div class="xs-product-wraper text-center">
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
                           data-target=".xs-quick-view-modal-<?php echo esc_attr($rand_quick); ?>"><i
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
            </div>
            <div class="list-group xs-list-group xs-product-content">
                <?php echo esc_html(marketpres_content_read_more()); ?>
            </div>
        </div>
    </div>
    <?php require MARKETO_THEMEROOT_DIR . '/woocommerce/content-quick-view.php'; ?>
    <?php
    $i++;
}
wp_reset_postdata();