<?php if($show_tab): ?>
<div class="xs-content-header content-header-v2">
    <?php  if(is_array($product_tab) && count($product_tab) > 0): ?>
        <?php $rand_id = 'xs-tabs-'.mt_rand(10000,99999).'-'; ?>
        <ul class="nav nav-tabs xs-nav-tab version-3" role="tablist">
            <?php foreach($product_tab as $key => $product_tabs): ?>
            <?php
            $active = ($key == 0) ? 'active' : '';
            ?>
            <li class="nav-item">
                <a class="nav-link <?php echo esc_attr($active) ?>"  data-toggle="tab" href="#<?php echo esc_attr($rand_id.$key); ?>" role="tab" ><?php echo esc_html($product_tabs['product_title']); ?></a>
                <div class="customNavigation xs-custom-nav">
                    <a class="prev" id="prev-12"><i class="icon icon-chevron-left"></i></a>
                    <a class="next" id="next-12"><i class="icon icon-chevron-right"></i></a>
                </div>
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
                    'order'             => $product_order,
                    'orderby'           => $product_orderby,
                );

                $args['posts_per_page'] = $product_count ;
                
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
                $this->add_render_attribute( 'slider-data', 'data-slider', $product_item );
            ?>
            <div class="tab-pane fade <?php echo esc_attr($active) ?>" id="<?php echo esc_attr($rand_id.$key); ?>" role="tabpanel">
                <?php
                printf(
                '<div class="xs-product-slider-11 owl-carousel" %1$s>',
                $this->get_render_attribute_string( 'slider-data' )
                );
                $count = 1;
                    if($xs_query->have_posts()):
                        while ($xs_query->have_posts()) :
                            $xs_query->the_post();
                            $xs_product = wc_get_product(get_the_id());
                            $img_link = xs_resize( get_post_thumbnail_id(), 71, 70,true );
                            $even = 3;
                            ?>
                            <?php if($count%$even == 1): ?>
                                <div class="xs-product-slider-item">
                            <?php endif; ?>
                                    <div class="xs-product-widget media version-2">
                                        <?php if(!empty($img_link)): ?>
                                        <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                                           <?php
                                                echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(71, 70), false, array(
                                                    'class' => 'd-flex',
                                                    'alt'   =>  get_the_title()
                                                )); 
                                            ?>
                                        </a>
                                            <?php endif; ?>
                                        <div class="media-body align-self-center product-widget-content">
                                            <h4 class="product-title small"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo get_the_title(); ?></a></h4>
                                            <span class="price small">
                                             <?php echo marketo_return($xs_product-> get_price_html());?>
                                        </span>
                                        </div>
                                    </div>
                            <?php if($count%$even == 0): ?>
                                </div>
                            <?php endif; ?>
                    <?php
                            $count++;
                        endwhile;
                        if ($count%$even != 1) echo "</div>";
                    endif;
                    //wp_reset_postdata();
                    ?>
                 </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>