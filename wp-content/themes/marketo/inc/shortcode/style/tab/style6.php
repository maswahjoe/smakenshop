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
                <div class="row no-gutters">
                        <?php
                        if($xs_query->have_posts()):
                            while ($xs_query->have_posts()) :
                                $xs_query->the_post();
                                $xs_product = wc_get_product(get_the_id());
                                $img_link = xs_resize( get_post_thumbnail_id(), 251, 251 );
                                $availability  = $xs_product->get_availability();
                                $stock_available 	= ( $stock = get_post_meta( get_the_ID(), '_stock', true ) ) ?  $stock  : 0;
                                $stock_sold 	 	= ( $total_sales = get_post_meta( get_the_ID(), 'total_sales', true ) ) ? $total_sales : 0;
                                $percentage 		= ( $stock_available > 0 ? round( $stock_sold/$stock_available * 100 ) : 0 );
                                $percentage 		= ( $stock_available > 0 ? round( $stock_sold/$stock_available * 100 ) : 0 );
                                $product_deal_date 		= get_post_meta( get_the_ID(), '_marketo_deal_date', true );
                                $product_deal_title 		= get_post_meta( get_the_ID(), '_marketo_deal_title', true );
                                ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="xs-deal-blocks deal-block-v2">
                                        <?php if(!empty($img_link)): ?>
                                        <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                                            <?php
                                                echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(251, 251), false, array(
                                                    'alt'  =>  get_the_title()
                                                )); 
                                            ?>
                                        </a>
                                        <?php endif; ?>

                                        <?php if ( $xs_product->is_on_sale() ) : ?>
                                            <div class="xs-product-offer-label">
                                                <span><?php echo marketo_get_sell_price(get_the_ID()); ?></span>
                                                <small><?php echo esc_html__('Offer','marketo') ?></small>
                                            </div>
                                        <?php endif; ?>
                                        <div class="title-and-price">
                                            <h4 class="product-title"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></h4>
                                            <span class="price">
                                                <?php echo marketo_return($xs_product-> get_price_html());?>
                                            </span>
                                        </div>
                                        <?php if($stock_available > 0) : ?>
                                            <div class="xs-deals-info">
                                                <div class="xs-deal-stock-limit clearfix">
                                                    <span class="product-sold"><?php echo esc_html__('Already Sold:','marketo'); ?> <?php echo esc_html( $stock_sold); ?></span>
                                                    <span class="product-available"><?php echo esc_html__('Available:','marketo'); ?><?php echo esc_html( $stock_available); ?></span>
                                                </div>
                                                <div class="progress xs-progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_attr($percentage) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo esc_attr($percentage) ?>%;"></div>
                                                </div>
                                            </div>
                                        <hr>
                                        <?php endif; ?>
                                        <?php if(!empty($product_deal_date)): ?>
                                            <div class="countdow-timer">
                                                <h4><?php echo wp_kses_post($product_deal_title); ?></h4>
                                                <div class="xs-countdown-timer" data-countdown="<?php echo esc_attr($product_deal_date); ?>"></div>
                                            </div>
                                        <?php endif; ?>
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