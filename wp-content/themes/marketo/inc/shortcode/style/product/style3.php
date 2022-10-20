<div class="row product-thumb-feature style-three">
    <?php
    if($xs_query->have_posts()):
        while ($xs_query->have_posts()) :
            $xs_query->the_post();
            $xs_product = wc_get_product(get_the_id());
            $img_link = xs_resize( get_post_thumbnail_id(), 221, 221,true );
            ?>
            <div class="col-lg-6 col-md-6">
                <div class="xs-product-widget media">
                    <?php if(!empty($img_link)): ?>
                    <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                    <?php
                       echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(221, 221), false, array(
                        'alt'  =>  get_the_title()
                            ));
                    ?>
                    </a>
                    <?php endif; ?>
                    <div class="media-body align-self-center product-widget-content">
                        <div class="xs-product-header media xs-wishlist woocommerce">
                            <?php
                            if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ):
                                $average      = $xs_product->get_average_rating();
                                echo wc_get_rating_html( $average );
                            endif;
                            ?>
                            <?php if(defined('YITH_WCWL')): ?>
                                <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
                            <?php endif; ?>
                        </div><!-- .xs-product-header END -->
                        <h4 class="product-title"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></h4>
                        <span class="price color-primary">
                             <?php echo marketo_return($xs_product-> get_price_html());?>
                        </span>
                        <div class="xs-btn-wraper xs-addcart-v2 woocommerce">
                            <?php if(function_exists('woocommerce_template_loop_add_to_cart')): ?>
                                <?php echo woocommerce_template_loop_add_to_cart(); ?>
                            <?php endif; ?>
<!--                            <a href="#" class="add-to-compare">+ Add to compare</a>-->
                        </div>
                    </div><!-- .product-widget-content END -->
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</div>
