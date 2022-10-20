<div class="xs-deal-of-the-day-section bg-xs-primary">
    <div class="xs-slider-highlight owl-carousel">
        <?php
        $args['posts_per_page'] = $product_count;

        if(!empty($product_ids)){
            $args['post__in'] = $product_ids;
        }
        $xs_query = new \WP_Query( $args );
        if($xs_query->have_posts()):
            while ($xs_query->have_posts()) :
                $xs_query->the_post();
                $xs_product = wc_get_product(get_the_id());
                $terms = get_the_terms(get_the_ID(), 'product_cat');
                $img = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
                $img_link = $img[0];
                $filtering_cat = '';
                if ( $terms && ! is_wp_error($terms)) :
                    $filtering_slugs = array();
                    foreach ( $terms as $term ) {
                        $filtering_slugs[] = $term->name;
                    }
                    $filtering_cat = join(", ", $filtering_slugs);
                endif;
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 align-self-center xs-deal-img">
                                <?php if(!empty($img_link)){
                                    echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), 'full', false, array(
                                            'alt'  =>  get_the_title())); 
                                    
                                } ?>
                        </div>
                        <div class="col-md-6 align-self-center">
                            <div class="xs-best-deal-slider-content">
                                <h2 class="best-deal-sub-title"><?php echo esc_html($filtering_cat); ?></h2>
                                <h3 class="best-deal-title"><?php echo get_the_title(); ?></h3>
                                <span class="price">
                                    <?php echo marketo_return($xs_product-> get_price_html());?>
                                </span>
                                <div class="xs-btn-wraper">
                                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-outline-secondary icon-left btn-product-slider-1">
                                        <i class="fa fa-shopping-basket"></i>
                                        <?php echo esc_html($btn_label1); ?>
                                    </a>
                                    <a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>" class="btn btn-success btn-product-slider-2"><?php echo esc_html($btn_label); ?></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- .row END -->
                </div><!-- .container END -->
            <?php
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>
    <span class="xs-watermark-text"><?php echo esc_html($water_title); ?></span>
</div>