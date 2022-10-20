<?php

if($image_pos){

    $class_wraper_3 = 'version-5';
    $class_wraper = 'xs-product-wraper';
    $class_wraper_2 = 'xs-product-content';
}else{
    $class_wraper_3 = 'version-6';
    $class_wraper = 'xs-product-widget media';
    $class_wraper_2 = 'media-body align-self-center product-widget-content';
}
$xs_count = 1;
if ($xs_query->have_posts()):
    while ($xs_query->have_posts()) :

        $xs_count = 1;
        $rand_quick = mt_rand(10000,99999).'-'.$xs_count;
	    $rand_quick = mt_rand(10000,99999).'-'.$xs_count;
        $xs_query->the_post();
        $xs_product = wc_get_product(get_the_id());
        $img_link = xs_resize(get_post_thumbnail_id(), 168, 166, true);
        $img_featured = xs_resize( get_post_thumbnail_id(), 438, 385,true );
        $img = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
        $img_full = $img[0];
        $terms = get_the_terms(get_the_ID(), 'product_cat');
        $cat = '';
        if ( $terms && ! is_wp_error($terms)) {
            foreach ($terms as $term) {
                $cat .= "<a href = '" . get_category_link($term->term_id) . "'>" . $term->name . "</a>  ";
            }
        }
        ?>
        <div class="<?php echo esc_attr($class_wraper_3); ?>">
            <div class="<?php echo esc_attr($class_wraper); ?>">
                <?php if(!empty($img_link)): ?>
                <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                   <?php
                       echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(168, 166), false, array(
                        'alt'  =>  get_the_title()
                            ));
                    ?>
                </a>
                <?php endif; ?>
                <div class="<?php echo esc_attr($class_wraper_2); ?>">
                            <span class="product-categories">
                                <a href="#" rel="tag"><?php echo marketo_return($cat); ?></a>
                            </span>
                    <h4 class="product-title"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></h4>
                    <span class="price version-2"> <?php echo marketo_return($xs_product-> get_price_html());?></span>
                </div><!-- .xs-product-content END -->
               <?php if(!$image_pos) : ?> <!--  show product meta if pd image in lef -->
               <div class="xs-update-product-meta">
                   <ul class="xs-update-product-item-meta product-item-meta">
                       <li class="xs-cart-wrapper">
                           <?php if(function_exists('woocommerce_template_loop_add_to_cart')): ?>
                               <?php echo woocommerce_template_loop_add_to_cart(); ?>
                           <?php endif; ?>
                       </li>
                       <li><a href="#" data-toggle="modal" data-target=".xs-quick-view-modal-<?php echo esc_attr($rand_quick); ?>"><i class="icon icon-medical2"></i></a></li>
                       <?php if(defined('YITH_WCWL')): ?>
                           <li class="xs-wishlist-wrapper xs-wishlist">
                               <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
                           </li>
                       <?php endif; ?>
                   </ul>
               </div>
                   <?php require MARKETO_THEMEROOT_DIR.'/woocommerce/content-quick-view.php';?>
               <?php endif; ?>
            </div>
        </div>
    <?php
	  $xs_count++;
	endwhile; ?>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
