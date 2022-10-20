<div class="xs-content-header mx-3">
    <h2 class="xs-content-title"><?php echo esc_html($head_title); ?></h2>
    <?php  if(is_array($product_tab) && count($product_tab) > 0): ?>
        <?php $rand_id = 'xs-tabs-'.mt_rand(10000,99999).'-'; ?>
        <ul class="nav nav-tabs xs-nav-tab" role="tablist">
            <?php foreach($product_tab as $key => $product_tabs): ?>
                <?php
                $cat_name = get_term_by( 'id', $product_tabs, 'product_cat' );
                $active = ($key == 0) ? 'active' : '';
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo esc_attr($active) ?>"  data-toggle="tab" href="#<?php echo esc_attr($rand_id.$key.'-'.$cat_name->term_id); ?>" role="tab" ><?php echo esc_html($cat_name->name); ?></a>
                </li>

            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="clearfix"></div>
</div>
<div class="tab-content">
    <?php if(is_array($product_tab) && count($product_tab) > 0): ?>
        <?php foreach($product_tab as $key => $tabs_content): ?>
            <?php
            $active = ($key == 0) ? 'show active' : '';
            $tabs_id = 'xs-tabs-'.$key;
            $cat_name = get_term_by( 'id', $tabs_content, 'product_cat' );
            $args = array(
                'post_type'         => array('product'),
                'post_status'       => array('publish'),
                'posts_per_page'    => $product_count,
                'tax_query'     => array(
                    'relation'  => 'AND',

                    array(
                        'taxonomy'  => 'product_cat',
                        'field'     => 'slug',
                        'terms'     => $cat_name->slug,
                    ),
                )
            );

            $xs_query = new \WP_Query( $args );
            ?>
            <div class="tab-pane fade <?php echo esc_attr($active) ?>" id="<?php echo esc_attr($rand_id.$key.'-'.$cat_name->term_id); ?>" role="tabpanel">
                <div class="row no-gutters product-thumb-version">
                    <?php
                    if($xs_query->have_posts()):
                        while ($xs_query->have_posts()) :
                            $xs_query->the_post();
                            $xs_product = wc_get_product(get_the_id());
                            $img_link = xs_resize( get_post_thumbnail_id(), 125, 142,true );
                            ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="xs-product-widget media">
                                    <?php if(!empty($img_link)): ?>
                                    <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                                        <?php
                                            echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(125, 142), false, array(
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
                                        </div>
                                        <h4 class="product-title"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></h4>
                                        <span class="price">
                                                    <?php echo marketo_return($xs_product-> get_price_html());?>
                                                </span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>