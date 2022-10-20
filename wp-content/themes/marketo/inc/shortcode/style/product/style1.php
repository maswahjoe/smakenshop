<?php
$xs_count = 1;
if($xs_query->have_posts()):
?>
<div class="row  <?php echo isset($featured_product_img_position) && $featured_product_img_position == 'yes' ? 'xs-feature-product-img-pos' : ''?>">
    <?php
    while ($xs_query->have_posts()) :
        $xs_query->the_post();
        $xs_product = wc_get_product(get_the_id());
        $img_link = xs_resize( get_post_thumbnail_id(), 255, 260,true );
        $img_featured = xs_resize( get_post_thumbnail_id(), 540, 550,true );
        $terms = get_the_terms(get_the_ID(), 'product_cat');
        $cat = '';
        if ( $terms && ! is_wp_error($terms)) {
            foreach ($terms as $term) {
                $cat .= "<a href = '" . get_category_link($term->term_id) . "'>" . $term->name . "</a>  ";
            }
        }
        ?>
        <?php if( $featured_pos == 'left' ): ?>
        <?php if( $xs_count == 1 ): ?>
            <div class="col-lg-6">
                <div class="xs-feature-product highlight">
                    <?php if(!empty($img_featured)){
                            echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), 'full', false, array(
                                    'alt'  =>  get_the_title()
                                ));
                            }
                    ?>
                    <div class="xs-feature-product-info">
                        <h4 class="product-title-v2 large xs-cat"><?php echo marketo_return($cat); ?></h4>
                        <h4 class="product-title-v2 large"><strong><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></strong></h4>
                    </div>
                    <?php if ( $xs_product->is_on_sale() ) : ?>
                        <div class="xs-product-offer-label">
                            <span><?php echo marketo_get_sell_price(get_the_ID()); ?></span>
                            <small><?php echo esc_html__('Offer','marketo') ?></small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <?php if($xs_count == 2): ?>
                <div class="col-lg-6 xs-padding-0">
                <div class="row xs-margin-0">
            <?php endif; ?>
            <div class="col-md-6">
                <?php if($settings['extra_link']): ?>
                    <?php if( $xs_count != $post_count ): ?>
                        <div class="xs-feature-product">
                                <?php if(!empty($img_link)){
                                    echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), 'full', false, array(
                                        'alt'  =>  get_the_title()
                                    ));
                                  }
                                ?>
                            <div class="xs-feature-product-info">
                                <h4 class="product-title-v2 xs-cat"><?php echo marketo_return($cat); ?></h4>
                                <h4 class="product-title-v2"><strong><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></strong></h4>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="xs-feature-product">
                            <?php if(!empty($img_link)){
                                    echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), 'full', false, array(
                                        'alt'  =>  get_the_title()
                                    ));
                                }
                            ?>
                        <div class="xs-feature-product-info">
                            <h4 class="product-title-v2 xs-cat"><?php echo marketo_return($cat); ?></h4>
                            <h4 class="product-title-v2"><strong><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></strong></h4>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(($settings['extra_link'])): ?>
                    <?php if($xs_count == $post_count ): ?>
                        <div class="xs-feature-product">
                        <?php echo Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
                            <div class="xs-feature-product-info">
                                <a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="xs-cate-btn">
                                    <?php echo esc_html( $link_label ); ?>
                                </a>
                            </div>
                        </div>
                    <?php  endif; ?>
                <?php endif; ?>
            </div>

            <?php if($xs_count == $post_count): ?>
                </div>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    <?php else: ?>
        <?php if( $xs_count != $post_count ): ?>

            <?php if( $xs_count == 1 ): ?>
                <div class="col-lg-6 xs-padding-0">
                <div class="row xs-margin-0">
            <?php endif; ?>

            <div class="col-md-6">
                <?php if($settings['extra_link']): ?>
                    <?php if( $xs_count != $post_count - 1): ?>
                        <div class="xs-feature-product">
                               <?php if(!empty($img_link)){
                                    echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), 'full', false, array(
                                        'alt'  =>  get_the_title()
                                    ));
                                  }
                                ?>
                            <div class="xs-feature-product-info">
                                <h4 class="product-title-v2 xs-cat"><?php echo marketo_return($cat); ?></h4>
                                <h4 class="product-title-v2"><strong><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></strong></h4>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="xs-feature-product">
                            <?php if(!empty($img_link)){
                                    echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), 'full', false, array(
                                        'alt'  =>  get_the_title()
                                    ));
                                  }
                            ?>
                        <div class="xs-feature-product-info">
                            <h4 class="product-title-v2 xs-cat"><?php echo marketo_return($cat); ?></h4>
                            <h4 class="product-title-v2"><strong><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></strong></h4>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(($settings['extra_link'])): ?>
                    <?php if($xs_count == $post_count - 1 ): ?>
                        <div class="xs-feature-product">
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
                            <div class="xs-feature-product-info">
                                <a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="xs-cate-btn">
                                    <?php echo esc_html( $link_label ); ?>
                                </a>
                            </div>
                        </div>
                    <?php  endif; ?>
                <?php endif; ?>
            </div>

            <?php if($xs_count == $post_count - 1): ?>
                </div>
                </div>
            <?php endif; ?>

        <?php  else: ?>
            <div class="col-lg-6">
                <div class="xs-feature-product highlight">
                          <?php if(!empty($img_link)){
                                    echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), 'full', false, array(
                                        'alt'  =>  get_the_title()
                                    ));
                                  }
                        ?>
                    <div class="xs-feature-product-info">
                        <h4 class="product-title-v2 large xs-cat"><?php echo marketo_return($cat); ?></h4>
                        <h4 class="product-title-v2 large"><strong><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></strong></h4>
                    </div>
                    <?php if ( $xs_product->is_on_sale() ) : ?>
                        <div class="xs-product-offer-label">
                            <span><?php echo marketo_get_sell_price(get_the_ID()); ?></span>
                            <small><?php echo esc_html__('Offer','marketo') ?></small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
        <?php
        $xs_count++;
    endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>