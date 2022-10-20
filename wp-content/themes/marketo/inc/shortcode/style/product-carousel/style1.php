<div class="xs-content-header">
    <h2 class="xs-content-title version-2"><?php echo esc_html($head_title); ?></h2>

    <div class="customNavigation xs-custom-nav">
        <a class="prev <?php echo esc_attr($settings['navigation_icon']) ?>"><i class="icon icon-chevron-left"></i></a>
        <a class="next <?php echo esc_attr($settings['navigation_icon']) ?>"><i class="icon icon-chevron-right"></i></a>
    </div>
    <div class="clearfix"></div>
</div>
<div class="xs-product-slider-1 owl-carousel">
    <?php
    $count = 1;
    if ($xs_query->have_posts()):
        while ($xs_query->have_posts()) :
            $xs_query->the_post();
            $xs_product = wc_get_product(get_the_id());
            $img_link = xs_resize(get_post_thumbnail_id(), 71, 70, true);
            $even = $product_per_column;
            ?>
            <?php if ($count % $even == 1): ?>
            <div class="xs-product-slider-item">
        <?php endif; ?>
            <div class="xs-product-widget media version-2">
                <?php if (!empty($img_link)): ?>
                <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                        <?php if(!empty($img_link)){
                                    echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(71, 70), false, array(
                                        'alt'  =>  get_the_title()
                                    ));
                                  }
                        ?>
                </a>
                <?php endif; ?>
                <div class="media-body align-self-center product-widget-content">
                    <h4 class="product-title small"><a
                                href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo get_the_title(); ?></a>
                    </h4>
                    <span class="price small"><?php echo marketo_return($xs_product->get_price_html()); ?> </span>
                </div><!-- .product-widget-content .version-2 END -->
            </div>
            <?php if ($count % $even == 0): ?>
            </div>
        <?php endif; ?>
            <?php
            $count++;
        endwhile;
        if ($count % $even != 1) echo "</div>";
        wp_reset_postdata();
    endif;
    ?>

</div>