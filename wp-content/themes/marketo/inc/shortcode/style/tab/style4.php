<?php

ob_start();
?><div class="col-lg-6 xs-padding-0"><div class="row xs-margin-0"><?php
        $wrapper_start_html = ob_get_clean();

        ob_start();
        ?></div></div><?php
$wrapper_end_html = ob_get_clean();

?>
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
    <?php if(is_array($product_tab) && count($product_tab) > 0): $j = 1;?>
        <?php foreach($product_tab as $key => $tabs_content): ?>
            <?php

            $active = ($key == 0) ? 'show active' : '';
            $tabs_id = 'xs-tabs-'.$key;
            $args = array(
                'post_type'         => array('product'),
                'post_status'       => array('publish'),
                'posts_per_page'    => 5,
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
                $args['post__in']   =   $product->get_related(100);
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
            $post_count = $xs_query->post_count;

            ?>
            <div class="tab-pane fade <?php echo esc_attr($active) ?>" id="<?php echo esc_attr($rand_id.$key); ?>" role="tabpanel">
                <div class="row">
                    <?php
                    $xs_count = 1;
                    if($xs_query->have_posts()):
                        while ($xs_query->have_posts()) :
                            $rand_quick = mt_rand(10000,99999).'-'.$xs_count;
                            $xs_query->the_post();
                            $xs_product = wc_get_product(get_the_id());
                            $img_link = xs_resize( get_post_thumbnail_id(), 193, 180,true );
                            $img_featured = xs_resize( get_post_thumbnail_id(), 438, 355,true );
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
                            <?php
                            ob_start();
                            ?>
                            <div class="col-lg-6">
                                <div class="xs-product-wraper highlight">
                                    <div class="product-feature-ribbon">
                                        <i class="fa fa-bolt"></i>
                                    </div>
                                    <div class="xs-product-content">
                                    <span class="product-categories">
                                        <span class="product-categories"><?php echo marketo_return($cat); ?></span>
                                    </span>
                                        <h4 class="product-title medium"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></h4>
                                        <?php if(!empty($xs_product->get_stock_quantity())): ?>
                                            <span class="product-stock"><?php echo esc_html__('Availability:','marketo'); ?><span class="color-secondary"><?php echo marketo_return($xs_product->get_stock_quantity()); ?> <?php echo esc_html__('in stock','marketo') ?></span></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!empty($img_link)): ?>
                                    <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                                       <?php
                                            echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(438, 355), false, array(
                                                'alt'  =>  get_the_title()
                                            )); 
                                        ?>
                                    </a>
                                    <?php endif; ?>
                                    <div class="media">
                                        <div class="media-body align-self-end">
                                <span class="price highlight">
                                   <?php echo marketo_return($xs_product-> get_price_html());?>
                                </span>
                                        </div>
                                        <?php if ( $xs_product->is_on_sale() ) : ?>
                                            <div class="media-body">
                                                <div class="xs-product-offer-label">
                                                    <span><?php echo marketo_get_sell_price(get_the_ID()); ?></span>
                                                    <small><?php echo esc_html__('Offer','marketo') ?></small>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $featured_html = ob_get_clean();


                            if($featured_pos == 'left'):
                                if( $xs_count == 1 ):
                                    echo marketo_return($featured_html);
                                else:
                                    if( $xs_count == 2 ):
                                        echo marketo_return($wrapper_start_html);
                                    endif;

                                    ?>
                                    <div class="col-md-6">
                                        <div class="xs-product-wraper version-3 text-center">
                                            <?php if(!empty($img_link)): ?>
                                            <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                                                <?php
                                                  echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(438, 355), false, array(
                                                    'alt'  =>  get_the_title()
                                                  )); 
                                              ?>
                                            </a>
                                            <?php endif; ?>
                                            <ul class="product-item-meta">
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
                                            <div class="xs-product-content">
                                                <span class="product-categories">
                                                    <span class="product-categories"><?php echo marketo_return($cat); ?></span>
                                                </span>
                                                <h4 class="product-title medium"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></h4>
                                                <span class="price"><?php echo marketo_return($xs_product-> get_price_html());?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php require MARKETO_SHORTCODE_DIR_STYLE.'/tab/quick-view-modal.php';?>
                                    <?php
                                    if( $xs_count == $post_count ):
                                        echo marketo_return($wrapper_end_html);
                                    endif;
                                endif;
                            else:

                                if( $xs_count != $post_count ):
                                    if( $xs_count == 1 ):
                                        echo marketo_return($wrapper_start_html);
                                    endif;
                                    ?>
                                    <div class="col-md-6">
                                        <div class="xs-product-wraper version-3 text-center">
                                            <?php if(!empty($img_link)): ?>
                                            <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                                                <?php
                                                    echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(193, 180), false, array(
                                                        'alt'  =>  get_the_title()
                                                    )); 
                                                ?>
                                            </a>
                                            <?php endif; ?>
                                            <ul class="product-item-meta">
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
                                            <div class="xs-product-content">
                                                <span class="product-categories">
                                                    <span class="product-categories"><?php echo marketo_return($cat); ?></span>
                                                </span>
                                                <h4 class="product-title medium"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></h4>
                                                <span class="price"><?php echo marketo_return($xs_product-> get_price_html());?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php require MARKETO_SHORTCODE_DIR_STYLE.'/tab/quick-view-modal.php';?>
                                    <?php
                                    if( $xs_count == ($post_count-1) ):
                                        echo marketo_return($wrapper_end_html);
                                    endif;
                                else:
                                    echo marketo_return($featured_html);
                                endif;

                            endif;

                            ?>

                            <?php
                            $xs_count++;
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>