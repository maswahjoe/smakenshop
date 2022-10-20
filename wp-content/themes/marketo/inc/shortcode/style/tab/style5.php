<?php if($show_tab): ?>
<div class="xs-content-header">
    <h2 class="xs-content-title"><?php echo esc_html($head_title); ?></h2>
    <?php  if(is_array($product_tab) && count($product_tab) > 0): ?>
        <?php $rand_id = 'xs-tabs-'.mt_rand(10000,99999).'-'; ?>
        <ul class="nav nav-tabs xs-nav-tab" role="tablist">
            <?php foreach($product_tab as $key => $product_tabs): ?>
                <?php
                $active = ($key == 0) ? 'active' : '';
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo esc_attr($active) ?>"  data-toggle="tab" href="#<?php echo esc_attr($rand_id.$key); ?>" role="tab" ><?php echo esc_html($product_tabs['product_title']); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="clearfix"></div>
</div>
<?php else : $rand_id = 'xs-tabs-'.mt_rand(10000,99999).'-'; ?>
<?php endif; ?>
<div class="tab-content">
    <?php if(is_array($product_tab) && count($product_tab) > 0): ?>
        <?php foreach($product_tab as $key => $tabs_content): ?>
            <?php
            $active = ($key == 0) ? 'show active' : '';
            $tabs_id = 'xs-tabs-'.$key;
            $args = array(
                'post_type'         => array('product'),
                'post_status'       => array('publish'),
                'posts_per_page'    => $product_count,
                'order'             => $product_order,
                'orderby'           => $product_orderby,
            );
            if($tabs_content['product_content'] == 'featured'){
                $args['tax_query'][] = array(
                    'taxonomy'         => 'product_visibility',
                    'terms'            => 'featured',
                    'field'            => 'name',
                    'operator'         => 'IN',
                    'include_children' => false,
                );
            }
            elseif($tabs_content['product_content'] == 'related'){
                $args['post__in'] 	= 	$product->get_related(100);
            }
            elseif($tabs_content['product_content'] == 'best_sell'){
                $args['meta_key']  = 'total_sales';
                $args['orderby'] = 'meta_value_num';
            }
            elseif($tabs_content['product_content'] == 'on_sell'){
                $args['meta_query'] = array(
                    array(
                        'key' => '_sale_price',
                        'value' => '',
                        'compare' => '!='
                    ),
                );
            }elseif($tabs_content['product_content'] == 'xs_product'){
                if(!empty($tabs_content['product_content']) == 'xs_product'){
                    if(!empty($tabs_content['product_ids'])){
                        $args['post__in'] = $tabs_content['product_ids'];
                    }else{
                        $args['post__in'] = [0];
                    }
                }
            }
            $xs_query = new WP_Query( $args );
            ?>
            <div class="tab-pane fade <?php echo esc_attr($active) ?>" id="<?php echo esc_attr($rand_id.$key); ?>" role="tabpanel">
                <div class="row">
                    <?php
                    if($xs_query->have_posts()):
                        while ($xs_query->have_posts()) :
                            $xs_query->the_post();
                            $xs_product = wc_get_product(get_the_id());
                            $img_link = xs_resize( get_post_thumbnail_id(), 253, 200,true );
                            $terms = get_the_terms(get_the_ID(), 'product_cat');
                            $cat = '';
                            if ( $terms && ! is_wp_error($terms)) {
                                foreach ($terms as $term) {
                                    $cat .= "<a href = '" . get_category_link($term->term_id) . "'>" . $term->name . "</a>  ";
                                }
                            }
                            ?>
                            <div class="col-md-3">
                                <div class="xs-product-wraper version-2">
                                    <div class="xs-product-header media woocommerce xs-wishlist <?php echo esc_attr($hide); ?>">

                                        <?php if($show_review): ?>
                                            <?php
                                            if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ):
                                                $average      = $xs_product->get_average_rating();
                                                echo wc_get_rating_html( $average );
                                            endif;
                                            ?>
                                        <?php endif; ?>

                                        <?php if($show_wishlist): ?>
                                            <?php if(defined('YITH_WCWL')): ?>
                                                <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    </div>
                                    <?php if(!empty($img_link)): ?>
                                    <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                                       <?php
                                            echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(253, 200), false, array(
                                                'alt'  =>  get_the_title()
                                            )); 
                                        ?>
                                    </a>
                                    <?php endif; ?>
                                    <div class="xs-product-content">
                                        <span class="product-categories">
                                            <span class="product-categories"><?php echo marketo_return($cat); ?></span>
                                        </span>
                                        <h4 class="product-title"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></h4>
                                        <span class="price">
                                            <?php echo marketo_return($xs_product-> get_price_html());?>
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