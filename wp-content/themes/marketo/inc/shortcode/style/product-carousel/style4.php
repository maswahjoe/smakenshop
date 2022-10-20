<div class="xs-content-header">
    <h2 class="xs-content-title"><?php echo esc_html($head_title); ?></h2>
    <div class="customNavigation xs-custom-nav">
        <a class="prev" id="prev-15"><i class="icon icon-left-arrows"></i></a>
        <a class="next" id="next-15"><i class="icon icon-right-arrow"></i></a>
    </div>
    <div class="clearfix"></div>
</div>
<div class="xs-slider-7-col owl-carousel tab-slider-center">
    <?php
    if ($xs_query->have_posts()):
        while ($xs_query->have_posts()) :
            $xs_query->the_post();
            $xs_product = wc_get_product(get_the_id());
            $img_link = xs_resize(get_post_thumbnail_id(), 135, 135);
            ?>
            <div class="xs-product-category">
                <?php if (!empty($img_link)): ?>
                <a class="xs_product_img_link" href="<?php echo esc_url(get_the_permalink()) ?>">
                  <?php
                       echo wp_get_attachment_image(get_post_thumbnail_id($xs_query->ID), array(135, 135), false, array(
                        'alt'  =>  get_the_title()
                      )); 
                    ?>
                </a>
                <?php endif; ?>
                <h4 class="product-title"><a
                            href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a>
                </h4>
                <span class="price color-primary">
                            <?php echo marketo_return($xs_product->get_price_html()); ?>
                        </span>
            </div>
        <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>