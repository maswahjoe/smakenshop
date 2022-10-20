<?php
/*
 * Display dokan content
 */
global $product;
$img_link = xs_resize( get_post_thumbnail_id(), 253, 200,true );
$terms = get_the_terms(get_the_ID(), 'product_cat');
$cat = '';
if ( $terms && ! is_wp_error($terms)) {
    foreach ($terms as $term) {
        $cat .= "<a href = '" . get_category_link($term->term_id) . "'>" . $term->name . "</a>  ";
    }
}
?>
<div class="col-md-4 xs-main-shop">
    <div class="xs-product-wraper version-2">
        <div class="xs-product-header media woocommerce xs-wishlist">
            <?php
            if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ):
                $average      = $product->get_average_rating();
                echo wc_get_rating_html( $average );
            endif;
            ?>
            <?php if(defined('YITH_WCWL')): ?>
                <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
            <?php endif; ?>
        </div>
        <?php if(!empty($img_link)): 
            echo wp_get_attachment_image(get_post_thumbnail_id(), 'medium', false, array(
                'alt'  => get_the_title()
            )); 
         endif; ?>
        <div class="xs-product-content">
            <span class="product-categories">
                <span class="product-categories"><?php echo marketo_return($cat); ?></span>
            </span>
            <h4 class="product-title"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></h4>
            <span class="price">
                <?php echo marketo_return($product-> get_price_html());?>
            </span>
        </div>
        <div class="xs-product-hover-area clearfix">
            <div class="xs-addcart woocommerce text-center">
                <?php if(function_exists('woocommerce_template_loop_add_to_cart')): ?>
                    <?php echo woocommerce_template_loop_add_to_cart(); ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>